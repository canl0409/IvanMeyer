<?php 
include '../config.php';
include '../user.php';
include '../class.php';
include 'header.php';

$error = false;
$errorMessage = '';
$cupom = false;
$cupomCode = "";

if(!empty($_POST['cupom'])){
  $resultCupom = $gm->validaCupom($_POST['cupom']);
  $cupom = true;
  $cupomCode = $_POST['cupom'];
  $_SESSION["cupom"] = $cupomCode;
}
unset($_POST['cupom']);

if(isset($_POST['nome']) && isset($_POST['email'])){  // FORMULÁRIO DE CADASTRO
  $aluno = $user->user(); 
  if($aluno){ // está logado
      $result = $user->newuser($_POST, true); 
  }else{
      $result = $user->newuser($_POST);

      $dados['lemail'] = $_POST['email'];
      $dados['lsenha'] = $_POST['senha'];
      $user->login($dados);
  }

  if($result == 1){
    if($cupom){
      if($resultCupom == 1){
        header('Location:paypal-express-checkout/index_cursos.php');
      }else{
        $error = true;
        $errorMessage = $resultCupom;
      }
    }else{
      header('Location:paypal-express-checkout/index_cursos.php');
    }
  }else{
    $error = true;
    $errorMessage = $result;
  }
}

if(isset($_POST['lemail']) && isset($_POST['lsenha'])){  // FORMULÁRIO DE LOGIN
  $dados = [];
  $dados['lemail'] = $_POST['lemail'];
  $dados['lsenha'] = $_POST['lsenha'];

  $result = $user->login($dados);
  $result = json_decode($result);
  $result = (Array)$result;

  if(isset($result['status'])){
    // LOGOU
  }else{
    $error = true;
    $errorMessage = $result['msg'];
  }
}
?>

<body>

<?php 
include 'navbar.php';
?>
	<div class="container">
	<div clas="row">

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div style="width: 300px; margin: 0 auto; text-align: center;">
          <h2>Entrar</h2>
          <form method="post">
        
            <div class="form-group row">
              <div class='col-md-12'>
                <input type="email" class='form-control'  name="lemail" placeholder="E-mail" required="required">
              </div>
            </div>
            <div class="form-group row">
              <div class='col-md-12'>
                <input type="password" class='form-control'  name="lsenha" placeholder="Senha" required="required">
              </div>
            </div>
            <div class="form-group row">
              <div class='col-md-12'>
                <input type="submit" class='btn btn-danger form-control' value="ENTRAR">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<?php $aluno = $user->user(); ?>


<?php if($error){  ?>
    <div class="alert alert-danger" role="alert">
      <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Oops... </strong> <span class="warn"><?=$errorMessage?></span>
    </div>
<?php }  ?>

		<div class="formulario col-md-6 col-offset-3">

			<div class="container-fluid">
			  <br /><br />
			  <ul class="list-unstyled multi-steps">
			    <li class="is-active">Suas informações</li>
                <li>Informações de pagamento</li>
			    <li>Acesse os cursos</li>
			  </ul>
			</div>

			<?php if(!$aluno){  // não está logado ?>
				<div class="col-md-6"><p>Já possui cadastro?</p></div>
				<div class="col-md-6"><button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Faça seu login</button></div>
			<?php } ?>

			<div class="col-md-12">
				<hr>
				<section class="form-cadastro">
					<?php include 'form-cadastro.php'; ?>
        </section>

        <?php if($plano['valor'] > 0){ // não é free , insere botão de pagar com paypal?>
          <section class="pagamento-paypal">
            <?php //include 'paypal-express.php'; ?>
          </section>
        <?php }?>

			</div>
            <div class="col-md-6 col-offset-3">
        <form method="post" action="cart_update.php">
                                <div class="card-header text-center" style="background-color: white;">
                        <h4>Informações da sua compra<h4>
        </div>


    <?php
    if(isset($_SESSION["cart_products"]))
    {
        $total = 0;
        foreach ($_SESSION["cart_products"] as $cart_itm)
        {

            $product_name = $cart_itm["product_name"];
            $product_qty = $cart_itm["product_qty"];
            $product_price = $cart_itm["product_price"];
            $product_code = $cart_itm["product_code"];
            $preco = $product_price/12; 
            $subtotal = ($product_price * $product_qty);

            $total = ($total + $subtotal); 
        ?>


                <div class="card">

                        <hr>
                        <div class="planoInfo text-center">
                        <h4><?php echo $product_name; ?></h4>
                        <span class="security-product-price"><strong class="product-price-portion">R$ <?php echo $product_price; ?></strong></span>


                        <ul>
                            <input type="hidden" class="quantidade" maxlength="1" name="product_qty[<?php echo $product_code; ?>]" value="<?php echo $product_qty; ?>" />
                            Remover <input type="checkbox" name="remove_code[]" value="<?php echo $product_code; ?>" />
                        </ul>

                        </div>

                </div>


        
        <?php

        }
    }
    ?>


                <div class="text-center total">

                <button class="btn btn-danger" type="submit">Atualizar</button>
                <a class="btn btn-danger" href="<?=u?>cursos-de-musica-online" class="button">Continuar comprando</a>

                <h4 class="text-center">Total a pagar: R$ <?php echo sprintf("%01.2f", $total);?></h4>
                </div>



        <input type="hidden" name="return_url" value="<?php $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); echo $current_url; ?>" />

        </form>
                    </div>
    </div>
</div>

<div class="text-center" id="paypal-button">

</body>

<script>
paypal.Button.render({

    env: '<?php echo $PayPalMode; ?>',

    client: {
        sandbox: 'AVgLLKkriKvCl9xwoKcl62ZyO-wHEYlJ_5ErDCXzM12DgvgOOFM1y3Nnz4FGTQIIhaGtGoczbKIU8Zc2',
        production: ''
    },

    locale: 'pt_BR',
    style: {
        label: 'pay',
        size: 'small',
        color: 'blue',
        shape: 'pill',
    },

    commit: true,

    payment: function (data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total: '<?php echo $total; ?>',
                    currency: '<?php echo $PayPalCurrencyCode; ?>'
                }
            }]
      });
    },
    // Executa o pagamento
    onAuthorize: function (data, actions) {
        return actions.payment.execute()
        .then(function () {
        	window.alert('Pagamento realizado com sucesso!');
        });
    }
}, '#paypal-button');

</script>

</html>


 <?php 
include 'footer.php';
 ?>
