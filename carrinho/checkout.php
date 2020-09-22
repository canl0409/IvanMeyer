<?php 
include 'header.php';

?>

<body>

<?php 
include 'navbar.php';
?>

<?php
// Redirect to the home page if id parameter not found in URL
if(empty($_GET['id'])){
    header("Location: index.php");
}

// Include and initialize database class
include 'DB.class.php';
$db = new DB;

// Include and initialize paypal class
include 'PaypalExpress.class.php';
$paypal = new PaypalExpress;

// Get product ID from URL
$productID = $_GET['id'];

// Get product details
$conditions = array(
    'where' => array('id' => $productID),
    'return_type' => 'single'
);
$productData = $db->getRows('products', $conditions);

$preco = $productData['price']/12; 

// Redirect to the home page if product not found
if(empty($productData)){
    header("Location: index.php");
}
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
                    <h6 class="text-center">Ou</h6>
                    <div class="text-center" id="paypal-button">
                    </div>
                </section>

            </div>

        </div>

            <div class="col-md-6 col-offset-3">
                <div class="card">
                    <div class="card-header text-center" style="background-color: white;">
                        <h5>Informações da sua compra<h5>
                        <hr>
                        <h4><?php echo $productData['name']; ?></h4>
                        <span class="security-product-price">Até <strong class="product-price-portion">12x R$ <?php echo $preco; ?></strong> (ou <?php echo $productData['price']; ?> à vista)</span>

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

</body>

 <?php 
include 'footer.php';
 ?>


<script>
paypal.Button.render({

    env: '<?php echo $paypal->paypalEnv; ?>',

    client: {
        sandbox: '<?php echo $paypal->paypalClientID; ?>',
        production: '<?php echo $paypal->paypalClientID; ?>'
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
                    total: '<?php echo $productData['price']; ?>',
                    currency: 'BRL'
                }
            }]
      });
    },
    // Executa o pagamento
    onAuthorize: function (data, actions) {
        return actions.payment.execute()
        .then(function () {

            window.location = "process.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid=<?php echo $productData['id']; ?>";
        });
    }
}, '#paypal-button');

</script>