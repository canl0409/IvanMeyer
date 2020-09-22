<?php 

if(!isset($_GET['plano'])){
  die("Plano não encontrado");
}

include '../config.php';
include '../user.php';
include '../class.php';
include 'header.php';

$plano = $gm->getRegistro('planos','planoId', $_GET['plano']);

if(!$plano){
  die("Plano não encontrado!");
}

$_SESSION["planos"] = $plano['planoId'];

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
          header('Location:paypal-express-checkout/index_planos.php');
        }else{
          $error = true;
          $errorMessage = $resultCupom;
        }
      }else{
        header('Location:paypal-express-checkout/index_planos.php');
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
          <?php if($plano['valor'] > 0){ // não é free?>
            <li>Informações de pagamento</li>
          <?php } ?>  
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
                  <p>Oferecemos pagamento à vista com boleto ou transferência. 
                  Basta entrar em <a href="<?=u?>contato">contato</a>. </p>
                </div>
            </div>

	</div>
</div>

</body>
  
 <?php 
include 'footer.php';
 ?>