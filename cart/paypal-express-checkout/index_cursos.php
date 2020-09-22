<?php
include_once("../../config.php");
include_once("../../user.php");
include_once("../config.php");
include_once("paypal.class.php");

$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

function matricular($mysqli, $cursoId, $cursoName, $aluno){
	$data = date('Y-m-d H:i:s');
	$insert_row = $mysqli->query("INSERT INTO cursos_matriculas (cursoId, alunoId, data, name)
	VALUES ('$cursoId','$aluno->alunoId','$data','$cursoName')");

	if($insert_row){
		print 'Concluido! O id registrado é: ' .$mysqli->insert_id .'<br />'; 
		$_SESSION['alert'] = true;
		$_SESSION['alert-class'] = "alert alert-success";
		$_SESSION['alert-msgm'] = "Matrícula realizada com sucesso!";
		$_SESSION['tipo_item'] = 'curso';
		include_once("../../class.php");
		$gm = new gm();
		$gm->email($aluno->email,null, null, 'curso_matriculado',(array)$aluno);

		header('Location:../../boas-vindas');
	}else{
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
}

if(isset($_SESSION["cart_products"])) //Post Data received from product list page.
{
	$valorDesconto = 0;

	if(isset($_SESSION["cupom"])){
		include_once("../../class.php");
		$gm = new gm();
		$cupom = $gm->getRegistro('cupons','codigo', $_SESSION["cupom"]);

		if($cupom && ($cupom['desconto'] < 100)){
			$valorDaCompra = 0;
			foreach ($_SESSION["cart_products"] as $cart_itm)
			{
				$valorDaCompra += $cart_itm['product_price'];
			}

			$_SESSION['valor_tr'] = $valorDaCompra;


			$valorDesconto = $valorDaCompra * ($cupom['desconto'] / 100);

			$_SESSION["cart_products"][] = [
				'product_qty' => 1,
				'product_code' => $cupom['codigo'],
				'product_name' => "Cupom de Desconto ".$cupom['desconto']."%",
				'product_price' => -$valorDesconto,
			];

			unset($_SESSION["cupom"]);
		}
	}

	$paypal_data ='';
	$ItemTotalPrice = 0;
	$i = 0;
	foreach ($_SESSION["cart_products"] as $cart_itm)
    {
        $product_code 	= filter_var($cart_itm["product_code"], FILTER_SANITIZE_STRING); 
		
		$results = $mysqli->query("SELECT titulo, descricao, valor FROM cursos WHERE cursoId='$product_code' LIMIT 1");
		$obj = $results->fetch_object();
		
        $paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$i.'='.urlencode($obj ? $obj->titulo : $cart_itm["product_name"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$i.'='.urlencode($obj ? $obj->cursoId : $cart_itm["product_code"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$i.'='.urlencode($obj ? $obj->valor : $cart_itm["product_price"]);		
		$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$i.'='. urlencode($cart_itm["product_qty"]);
        
		// item price X quantity
        $subtotal = ($obj->valor*$cart_itm["product_qty"]);
		
        //total price
        $ItemTotalPrice = $ItemTotalPrice + $subtotal;
		
		//create items for session
		$paypal_product['items'][] = array('itm_name'=>$obj ? $obj->titulo : $cart_itm["product_name"],
											'itm_price'=>$obj ? $obj->valor : $cart_itm["product_price"],
											'itm_code'=>$obj ? $obj->cursoId : $cart_itm["product_code"], 
											'itm_qty'=>$cart_itm["product_qty"]
											);
		$i++;
	}
	
	$ItemTotalPrice = $GrandTotal = ($ItemTotalPrice - $valorDesconto);
	$_SESSION['valor_tr'] = $ItemTotalPrice;
								
	$paypal_product['assets'] = array(
								'grand_total'=>$GrandTotal);

	$_SESSION["paypal_products"] = $paypal_product;
	
	$padata = 	'&METHOD=SetExpressCheckout'.
				'&RETURNURL='.urlencode($PayPalReturnURLcursos ).
				'&CANCELURL='.urlencode($PayPalCancelURL).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$paypal_data.				
				'&NOSHIPPING=1'. 
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&LOCALECODE=BR'. 
				'&LOGOIMG=/dist/images/logo_site.png'. //site logo
				'&CARTBORDERCOLOR=FFFFFF'. 
				'&ALLOWNOTE=1';
		
		//We need to execute the "SetExpressCheckOut" method to obtain paypal token
		$paypal= new MyPayPal();
		$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
		
		//Respond according to message we receive from Paypal
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
		{
				unset($_SESSION["cart_products"]); 
			 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
				header('Location: '.$paypalurl);
		}
		else
		{
			//Show error message
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			var_dump($GrandTotal);
			var_dump($padata);
			print_r($httpParsedResponseAr);
			echo '</pre>';
		}

}

//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
	$token = $_GET["token"];
	$payer_id = $_GET["PayerID"];
	
	//get session variables
	$paypal_product = $_SESSION["paypal_products"];
	$paypal_data = '';
	$ItemTotalPrice = 0;

    foreach($paypal_product['items'] as $key=>$p_item)
    {		
		$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($p_item['itm_qty']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($p_item['itm_price']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($p_item['itm_name']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($p_item['itm_code']);
        
		// item price X quantity
        $subtotal = ($p_item['itm_price']*$p_item['itm_qty']);
		
        //total price
        $ItemTotalPrice = ($ItemTotalPrice + $subtotal);
    }

	$padata = 	'&TOKEN='.urlencode($token).
				'&PAYERID='.urlencode($payer_id).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$paypal_data.
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_AMT='.urlencode($paypal_product['assets']['grand_total']).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode);

	$paypal= new MyPayPal();
	$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
	
	//Check if everything went ok..
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
	{

			echo '<h2>Pronto!</h2>';
			echo 'Seu Código de Transação : '.urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
				
				if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					echo '<div style="color:green">Pagamento recebido!</div>';
					echo '<a href="/">Voltar</a>';
				}
				elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					echo '<div style="color:red">Compra efetuada. Seu pagamento está pendente! '.
					'Você precisa autorizar esse pagamento manualmente na sua <a target="_new" href="http://www.paypal.com">Conta Paypal</a></div>';
				}

				$padata = 	'&TOKEN='.urlencode($token);
				$paypal= new MyPayPal();
				$httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
				{
					
					echo '<br /><b>Compra salva no nosso banco de dados:</b><br />';
					
					echo '<pre>';
					
					$buyerName = urldecode($httpParsedResponseAr["FIRSTNAME"]).' '.urldecode($httpParsedResponseAr["LASTNAME"]);
					$buyerEmail = urldecode($httpParsedResponseAr["EMAIL"]);
					$transactionID = urldecode($httpParsedResponseAr["TRANSACTIONID"]);
					$ItemName = urldecode($httpParsedResponseAr["L_NAME0"]); 
					$ItemNumber = urldecode($httpParsedResponseAr["L_NUMBER0"]);
					$ItemTotalPrice = urldecode($httpParsedResponseAr["L_AMT0"]);
					$ItemQTY = urldecode($httpParsedResponseAr["L_QTY0"]);

					$data = date("Y-m-d H:i:s");
					$aluno = $user->user();
					$alunoId = $aluno ? $aluno->alunoId : "";

					$insert_row = $mysqli->query("INSERT INTO pagamentos 
					(email_consumidor,code,alunoId,produto,planoId, valor, data, status_pagamento)
					VALUES ('$buyerEmail','$transactionID','$alunoId','$ItemName','$ItemNumber', '$ItemTotalPrice', '$data', '4')");

					$_SESSION['valor_tr'] = $ItemTotalPrice;

					if($aluno){
						$paypal_product = $_SESSION["paypal_products"];

						foreach($paypal_product['items'] as $key=>$p_item)
						{		
							matricular($mysqli, $p_item['itm_code'], $p_item['itm_name'], $aluno);	
						}
					}

					if($insert_row){
						print 'Concluido! O id registrado é: ' .$mysqli->insert_id .'<br />'; 
					}else{
						die('Error : ('. $mysqli->errno .') '. $mysqli->error);
					}
					
					echo '<pre>';
					print_r($httpParsedResponseAr);
					echo '</pre>';
				} else  {
					echo '<div style="color:red"><b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
					echo '<pre>';
					print_r($httpParsedResponseAr);
					echo '</pre>';

				}
	
	}else{
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			print_r($httpParsedResponseAr);
			echo '</pre>';
	}
}
?>
