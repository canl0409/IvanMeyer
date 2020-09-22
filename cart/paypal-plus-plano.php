<?php

if(!$plano){
    die("Plano não encontrado!");
}

if(!$aluno){
    die("Aluno não encontrado!");
}

include 'config.php';
require __DIR__  . '/vendor/autoload.php';

include_once 'paypal-api-context.php';

$valorDesconto = 0;
$itens = [];

$item1 = new \PayPal\Api\Item();
$item1->setName("Plano ".$plano['nome'])
->setSku($plano['planoId'])
->setCurrency($PayPalCurrencyCode)
->setQuantity(1)
->setPrice($plano['valor']);

$itens[] = $item1;

if(isset($_SESSION["cupom"])){
    include_once("../class.php");
    $gm = new gm();
    $cupom = $gm->getRegistro('cupons','codigo', $_SESSION["cupom"]);

    if($cupom && ($cupom['desconto'] < 100)){
        $valorDesconto = $plano['valor'] * ($cupom['desconto'] / 100);

        $item2 = new \PayPal\Api\Item();
        $item2->setName("Cupom de Desconto ".$cupom['desconto']."%")
        ->setSku($cupom['codigo'])
        ->setCurrency($PayPalCurrencyCode)
        ->setQuantity(1)
        ->setPrice(-$valorDesconto);

        $itens[] = $item2;
    }
    unset($_SESSION["cupom"]);
}

$totalDaCompra = ($plano['valor'] - $valorDesconto);

$itemList = new \PayPal\Api\ItemList();
$itemList->setItems($itens);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setCurrency($PayPalCurrencyCode);
$amount->setTotal($totalDaCompra);

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);
$transaction->setItemList($itemList);
//$transaction->setInvoiceNumber(uniqid());
//$transaction->setDescription('Description');

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
    //echo $ex->getData();
    throw $ex;
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
    var ppp = PAYPAL.apps.PPP({
        approvalUrl: "<?php echo $approvalUrl ?>",
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
                paymentId: "<?php echo $payment->getId();?>",
                alunoId: "<?php echo $aluno->alunoId ?>",
                buyerEmail: "<?php echo $aluno->email ?>",
                itemName: "<?php echo $item1->getName() ?>",
                itemNumber: "<?php echo $plano['planoId'] ?>",
                itemTotalPrice: "<?php echo $amount->getTotal(); ?>"
            }

            $.post("api/index.php/payment/success", data, function(response){
                console.log("PAGAMENTO ENVIADO PARA A API");
                <?php
                    $_SESSION['alert'] = true;
                    $_SESSION['alert-class'] = "alert alert-success";
                    $_SESSION['alert-msgm'] = "Assinatura de plano {$plano['nome']} realizada com sucesso!";
                    $_SESSION['tipo_item'] = 'plano';
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
