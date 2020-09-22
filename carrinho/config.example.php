<?php
$currency = 'R$';

//MySql
$db_username 	= 'root';
$db_password 	= '02r0d9rmv4uyZx';
$db_name 		= 'terra_da_musica2';
$db_host 		= 'localhost';

$url_base = "https://www.terradamusica.com.br";

//paypal settings
//$PayPalMode 			= 'sandbox';
$PayPalMode 			= 'production';
$PayPalApiUsername 		= 'contato_api1.terradamusica.com.br';
$PayPalApiPassword 		= 'DTDFL4GSMXMK9LCL';
$PayPalApiSignature 	= 'ASFNsidLua8KLS1RfuLHh9gqrzXIA2thwldZZ-mQl-W92orlYTSTZZ8M';
$PayPalCurrencyCode 	= 'BRL';
$PayPalReturnURL 		= $url_base.'/carrinho/paypal-express-checkout/index_planos.php';
$PayPalCancelURL 		= $url_base.'/carrinho/paypal-express-checkout/cancel_url.html';
$PayPalReturnURLcursos	= $url_base.'/carrinho/paypal-express-checkout/index_cursos.php';


$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);
mysqli_set_charset($mysqli, 'utf8');
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}


?>
