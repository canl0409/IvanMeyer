<?php

if(!isset($_GET['plano'])){
  die("Plano não encontrado");
}

include_once '../config.php';
include_once '../user.php';
include_once '../class.php';
include_once 'header.php';

$plano = $gm->getRegistro('planos','planoId', $_GET['plano']);

if(!$plano){
  die("Plano não encontrado!");
}

$_SESSION["planos"] = $plano['planoId'];

$error = false;
$errorMessage = '';
$cupom = false;
$cupomCode = "";
$formPaypal = false;
$completeRegister = 0;

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
    $completeRegister = 1;
      if($cupom){
        if($resultCupom == 1){
          if($plano['valor'] == 0){ // plano free
            header('Location:paypal-express-checkout/index_planos.php');
          }
          $formPaypal = true;
        }else{
          $error = true;
          $errorMessage = $resultCupom;
        }
      }else{
        if($plano['valor'] == 0){ // plano free
          header('Location:paypal-express-checkout/index_planos.php');
        }
        $formPaypal = true;
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
                    <div class="col-md-12">
        <a href="#" rel="recsenha" class="modalbt" style="float: right">Esqueci minha senha</a>
      </div>
              <div class='col-md-12'>
                <input type="submit" class='btn btn-danger form-control' value="ENTRAR">
              </div>
            </div>
          </form>
        </div>
      </div>


 
<div class="modal-body" style="display:none" id="cmregister" rel="600px">

<h2 class="text-center">Recuperação de senha</h2>



<form id="frecuperasenha" class="fregistro" method="POST" " style="padding: 2px 40px;"  >

  <div class="alert alert-danger" style="display:none" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong></strong> <span class="warn"></span>
  </div>

<div class="row">
<div class="col-md-12">
  <div class="form-group row">
    <div class="col-sm-12">
      <input type="email" required  name="reqmail" class="form-control" id="reqmail" placeholder="E-mail de cadastro" >
    </div>
  </div>
    <div class="form-group row">
      <div class="col-md-12">
        <a href="#" rel="recsenha" class="modalbt" style="float: right">Login</a>
      </div>

   <div class="col-sm-12">
   <input type="submit" value="recuperar" class="form-control subm btn btn-danger" style="float:right; margin-top:20px;"/>
   </div>
   </div>
</div>
</div>
</form>
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
			    <li class="<?= !$formPaypal ? 'is-active' : ''?>">Suas informações</li>
          <?php if($plano['valor'] > 0){ // não é free?>
            <li class="<?= $formPaypal ? 'is-active' : ''?>">Informações de pagamento</li>
          <?php } ?>
			    <li>Acesse os cursos</li>
			  </ul>
			</div>

			<?php if(!$aluno){  // não está logado ?>
				<div class="col-md-6"><p>Já possui cadastro?</p></div>
				<div class="col-md-6"><button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Faça seu login</button></div>
			<?php } ?>

				<hr>

        <?php if(!$formPaypal){ ?>
            <section class="form-cadastro">
              <?php include 'form-cadastro.php'; ?>
            </section>
        <?php }?>

        <?php if($formPaypal and ($plano['valor'] > 0)){ ?>
          <section class="pagamento-paypal">
            <?php include 'paypal-plus-plano.php'; ?>
          </section>
        <?php }?>

			</div>

            <div class="col-md-6 col-offset-3">
                <div class="card">
                    <div class="card-header text-center" style="background-color: white;">
                        <h5>Informações da sua compra<h5>
						<hr>
						<h4>
              <?php
                $duracao = $plano['meses_duracao'] ? $plano['meses_duracao'] : "0";
                $mesLabel = $plano['meses_duracao'] > 1 ? "meses" : "mês";
                $free = $plano['valor'] == 0;

                if($free){
                  echo "Gratuito por ".$duracao." ".$mesLabel;
                }else{
                  echo "Plano ".$plano['nome'];
                } ?>
            </h4>

                        <span class="security-product-price">
                            <?php if($free){
                                  echo "Comece a estudar agora!";
                                }else{
                                    echo "Até <strong class='product-price-portion'>".$plano['parcelas']."x R$ ".$plano['valor']/$plano['parcelas']."</strong> (ou R$ ".$plano['valor']." à vista)";
                                } ?>
                        </span>

                        <?php   if($valorDesconto > 0){  ?>
                        <div class="planoInfo">
                          <span style="font-size:12px;">Desconto de: <?='R$' . number_format($valorDesconto, 2)?>  , aplicado.</span>
                        </div>
                        <?php  }  ?>

                        <div class="planoInfo">
                          <ul>
                            <li class="planoInfo-item">
                              <?=$plano['caracteristicas']?>
                            </li>
                            <li class="planoInfo-item">
                              <?=$plano['caracteristica2']?>
                            </li>
                            <li class="planoInfo-item">
                              <?=$plano['caracteristica3']?>
                            </li>
                          </ul>
						            </div>
                    </div>
                </div>
                <div style="margin-top: 60px; text-align: center">
                    <p>Sua compra segura com Paypal em <b>até 12X sem juros</b> no cartão de crédito.<p>
                    <p>Se preferir <b>boleto</b> ou <b>transferência</b> entre em <a href="<?=u?>contato">contato</a>. </p>
                    <img src="../assets/imgs/paypal.png" width="50%" style="margin-top: 10px"/>
                </div>
            </div>

	</div>
</div>

</body>
<?php if(!$_SESSION['assinar_view']){ ?>
<script type="text/javascript">
   gtag('event', 'cartScreen', {
        'event_category': 'cart',
        'event_label': 'labelCart',
        'value': <?=$plano['valor'] ?>
  });
</script>
<?php  $_SESSION['assinar_view'] = 1; } ?>


<?php if($completeRegister == 1){   ?>
  <script type="text/javascript">    fbq('track', 'CompleteRegistration'); </script>
<?php } ?>

<?php if(empty($_POST)){ ?>
<script type="text/javascript">  fbq('track', 'AddToCart'); </script>
<?php } ?>
 
 <?php
include 'footer.php';
 ?>

 <script>

  $(function(){
    $('.modalbt').on('click',function(){
        $('.modal-body').toggle();
    });
  });

  $(function(){

    $('#frecuperasenha').on('submit', function(e){
       $('.alert').show();
       $('.alert span').html('<div style="text-align:center"><p><img src="'+U+'assets/loader.gif" /></p></div>');

      e.preventDefault();
      $.post(U+'ajax.php', 
          {reqmail:$('#reqmail').val()},  
         function(data, status, xhr){
               $('.alert').show();
              $('.alert span').html(data);
            
         });
    });

});
</script>