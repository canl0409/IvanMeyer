<?php
session_start();
include_once("config.php");

include_once("header.php");
?>

<body>

<?php include ("navbar.php") ?>


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
                        <span class="security-product-price">Até <strong class="product-price-portion">12x de R$ <?php echo $preco; ?></strong> (ou <?php echo $product_price; ?> à vista)</span>


                        <ul>
                        Quantidade
                        <input type="number" class="quantidade" maxlength="1" name="product_qty[<?php echo $product_code; ?>]" value="<?php echo $product_qty; ?>" />
                        <li class="planoInfo-item">
                        <strong class="planoInfo-numero">134</strong>
                        Cursos
                        </li>
                        <li class="planoInfo-item">
                        <strong class="planoInfo-numero">3678</strong>
                        Atividades
                        </li>
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
                <a class="btn btn-danger" href="index.php" class="button">Continuar comprando</a>

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
