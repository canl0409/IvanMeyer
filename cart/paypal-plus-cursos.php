<?php

if(!$aluno){
    die("Aluno não encontrado!");
}

include 'config.php';
require __DIR__  . '/vendor/autoload.php';

include_once 'paypal-api-context.php';

$cursosIds = "";
$cupom = false;
$totalDaCompra = 0;
$valorDesconto = 0;
$itens = [];

if(isset($_SESSION["cart_products"])) //Post Data received from product list page.
{
	if(isset($_SESSION["cupom"])){
		include_once("../class.php");
		$gm = new gm();
		$cupom = $gm->getRegistro('cupons','codigo', $_SESSION["cupom"]);

		if($cupom && ($cupom['desconto'] < 100)){
			$valorDaCompra = 0;
			foreach ($_SESSION["cart_products"] as $cart_itm)
			{
				$valorDaCompra += $cart_itm['product_price'];
			}

			$valorDesconto = $valorDaCompra * ($cupom['desconto'] / 100);

			$_SESSION["cart_products"][] = [
				'product_qty' => 1,
				'product_code' => $cupom['codigo'],
				'product_name' => "Cupom de Desconto ".$cupom['desconto']."%",
				'product_price' => -$valorDesconto
			];

            unset($_SESSION["cupom"]);
        }
    }

    foreach($_SESSION["cart_products"] as $cart_itm)
    {
        $product_code 	= filter_var($cart_itm["product_code"], FILTER_SANITIZE_STRING);

		$results = $mysqli->query("SELECT cursoId, titulo, descricao, valor FROM cursos WHERE cursoId='$product_code' LIMIT 1");
		$obj = $results->fetch_object();

        $cursosIds = $cursosIds.$cart_itm['product_code'].",";

        $item = new \PayPal\Api\Item();
        $item->setName($obj ? $obj->titulo : $cart_itm["product_name"])
        ->setSku($obj ? $obj->cursoId : $cart_itm["product_code"])
        ->setCurrency($PayPalCurrencyCode)
        ->setQuantity($cart_itm["product_qty"])
        ->setPrice($obj ? $obj->valor : $cart_itm["product_price"]);

        $subtotal = ($obj->valor*$cart_itm["product_qty"]);

        $totalDaCompra += $subtotal;

        $itens[] = $item;
    }
}

$cursoId = null;
$cursoName = "Cursos Diversos";

if(!$cupom && (count($_SESSION["cart_products"]) == 1)){
    reset($_SESSION["cart_products"]);
    $itemCurrent = current($_SESSION["cart_products"]);
    $cursoId = $itemCurrent['product_code'];
    $cursoName = $itens[0]->getName();
}

if($cupom && (count($_SESSION["cart_products"]) == 2)){
    reset($_SESSION["cart_products"]);
    $itemCurrent = current($_SESSION["cart_products"]);
    $cursoId = $itemCurrent['product_code'];
    $cursoName = $itens[0]->getName();
}

$totalDaCompra = ($totalDaCompra - $valorDesconto);

$itemList = new \PayPal\Api\ItemList();
$itemList->setItems($itens);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setCurrency($PayPalCurrencyCode);
$amount->setTotal($totalDaCompra);

$size = strlen($cursosIds);
$cursosIds = substr($cursosIds,0, $size-1);

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);
$transaction->setItemList($itemList);

$redirectUrl = new \PayPal\Api\RedirectUrls();
$redirectUrl->setReturnUrl($PayPalReturnURL);
$redirectUrl->setCancelUrl($PayPalCancelURL);

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale');
$payment->setPayer($payer);
$payment->setRedirectUrls($redirectUrl);
$payment->setTransactions(array($transaction));

include "paypal-webprofile-create.php";  // cria WebProfile

$payment->setExperienceProfileId($webProfileId);

try{
    $payment = $payment->create($apiContext);
    $approvalUrl = $payment->getApprovalLink();
    // echo $approvalUrl;
}catch(\Exception $ex){
    echo $ex->getData();
    //throw $ex;
}

?>


<div id="ppplus"></div>
<button type="submit" class="btn btn-danger btn-block" onclick="buy()">Finalizar Compra</button>
<br/> <br/>
<br/> <br/>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="bower_components/jquery-loading/dist/jquery.loading.min.js"></script>
<link href="bower_components/jquery-loading/dist/jquery.loading.min.css" rel="stylesheet">
<script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js"></script>
<script type="text/javascript">
    loadingStart();
    $(".loading-overlay").hide();
    var ppp = PAYPAL.apps.PPP({approvalUrl: "<?php echo $approvalUrl ?>",
        placeholder: 'ppplus',
        mode: "<?php echo $PayPalMode ?>",
        country: 'BR',
        language: 'pt_BR',
        payerFirstName: "<?php echo $aluno->nome ?>",
        payerLastName: "<?php echo $aluno->sobrenome ?>",
        payerEmail: "<?php echo $aluno->email ?>",
        payerTaxId: "<?php echo $aluno->cpf ?>",
        payerTaxIdType: 'BR_CPF',
        onContinue(cardToken, payerId){
            $(".loading-overlay").show();
            console.log("PAGAMENTO CONCLUÍDO");

            var data = {
                cardToken: cardToken,
                payerId: payerId,
                paymentId: "<?= $payment->getId();?>",
                alunoId: "<?= $aluno->alunoId ?>",
                buyerEmail: "<?= $aluno->email ?>",
                cursoName: "<?= $cursoName ?>",
                cursoId: "<?= $cursoId ?>",
                itemTotalPrice: "<?= $amount->getTotal(); ?>",
                cursosIds: "<?= $cursosIds ?>"
            }

            $.post("api/index.php/payment/cursos/success", data, function(response){
                console.log("PAGAMENTO ENVIADO PARA A API");
                console.log(response);
                <?php
                    $_SESSION['alert'] = true;
                    $_SESSION['alert-class'] = "alert alert-success";
                    $_SESSION['alert-msgm'] = "Matrícula realizada com sucesso!";
                    $_SESSION['tipo_item'] = 'curso';
                    $_SESSION['valor_tr'] = $amount->getTotal();
                ?>

                window.location = "<?php echo $url_base.'/boas-vindas' ?>";
            })
            .fail(function(error) {
                console.log("ERRO: "+error.responseJSON);
                $(".loading-overlay").hide();
                alert("Erro ao processar requisição.. Entre em contato! Erro:"+error.responseJSON);
            });
        }
    });

    function buy(){
        btnFinalizarCompra();
        ppp.doContinue();
    }

    function loadingStart(){
        $("body").loading({
            theme: 'dark',
            message: 'Processando...'
        });
    }

</script>
