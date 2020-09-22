<?php 
session_start();
include 'header.php';

?>

<body>

<?php 
include 'navbar.php';
include 'config.php';

$url = str_replace("/carrinho/", "", $_SERVER["REQUEST_URI"]);
$code = substr($url, 0, strpos($url, ".php"));

		$results = $mysqli->query("SELECT * FROM planos WHERE planoId='$code' LIMIT 1");
		$obj = $results->fetch_object();

$_SESSION["planos"] = $code;

?>

	<div class="container">
	<div clas="row">

		<div class="formulario col-md-6 col-offset-3">

			<div class="container-fluid">
			  <br /><br />
			  <ul class="list-unstyled multi-steps">
			    <li class="is-active">Suas informações</li>
			    <li>Informações de pagamento</li>
			    <li>Acesse os cursos</li>
			  </ul>
			</div>

			<div class="col-md-6"><p>Já possui cadastro?</p></div>
			<div class="col-md-6"><button class="btn btn-danger">Faça seu login</button></div> 

			<div class="col-md-12">
				<hr>
				<section class="form-cadastro">
					<?php include 'form-cadastro.php'; ?>
				</section>

				<section class="pagamento-paypal">
					<?php include 'paypal-premium.php'; ?>

				</section>

			</div>

		</div>

            <div class="col-md-6 col-offset-3">
                <div class="card">
                    <div class="card-header text-center" style="background-color: white;">
                        <h5>Informações da sua compra<h5>
						<hr>
						<h4>Plano Anual</h4>
                        <span class="security-product-price">Até <strong class="product-price-portion">12x R$ 49,90</strong> (ou R$ 500,00 à vista)</span>

                        <div class="planoInfo">
                        <ul>
                        <li class="planoInfo-item">
                        <strong class="planoInfo-numero">134</strong>
                        Cursos
                        </li>
                        <li class="planoInfo-item">
                        <strong class="planoInfo-numero">3678</strong>
                        Atividades
                        </li>
                        <li class="planoInfo-item planoInfo-item--checked">
                        Estude por 12 meses
                        </li>
                        </ul>
						</div>
                    </div>
                </div>
            </div>
	</div>
</div>

            <a href="paypal-express-checkout/index_planos.php" >PAGAR</a>

</body>

 <?php 
include 'footer.php';
 ?>