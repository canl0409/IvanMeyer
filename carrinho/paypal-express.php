                    <h6 class="text-center">Ou</h6>
                    <div class="text-center" id="paypal-button-container">
                    </div>

    <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            client: {
                sandbox:    'AVgLLKkriKvCl9xwoKcl62ZyO-wHEYlJ_5ErDCXzM12DgvgOOFM1y3Nnz4FGTQIIhaGtGoczbKIU8Zc2',
                production: '<insert production client id>'
            },

            style: {
            label: 'pay',
                size:  'small',    // small | medium | large | responsive
                shape: 'pill',     // pill | rect
                color: 'blue'      // gold | blue | silver | black
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?= $plano['valor']; ?>', currency: 'BRL' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                     window.alert("pagamento realizado com sucesso.");
                });
            }

        }, '#paypal-button-container');

    </script>