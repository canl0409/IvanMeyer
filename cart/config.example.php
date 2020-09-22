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
$PayPalMode 			= 'live';

$PayPalAccount 	    = 'contato-facilitator@terradamusica.com.br';
$PayPalClientId 	= 'AXaHrjoFGqFnKTzT3s_3SQlV8Llc4VnFPOmj3lYHBrLD3CGsEAcXaFq3l_sShIaG0D07IxyMUBXzo_z4';
$PayPalClientSecret     = 'EOj1dcTY67GKBqjFFlxpLc-zka49BA3gqiMJOBnVIOMCxwSv_ykeCfFwNg2oM3--ICUIOj7iwWGtJ4NK';

if($PayPalMode == 'live'){
    $PayPalAccount 		    = 'contato@terradamusica.com.br';
    $PayPalClientId 		= 'Ad_TTra7dBkBw5DxjNrtDj7XeIwvBCTj7gc5ZvtqydzyKC_viEWY8i0nOPTS1wCFXjlwDO2ukN-eo_QO';
    $PayPalClientSecret     = 'EGM5tDEI0_tBwZ9w-BRM8b8Ptuw-0wWg2S8nw3steZmBSQb07qMnjLq1loRoTULHJWJHpnLZuoSaqimp';
}

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
