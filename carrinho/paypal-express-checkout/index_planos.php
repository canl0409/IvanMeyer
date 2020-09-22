<?php
include_once("../../config.php");
include_once("../../user.php");
include_once("../config.php");
include_once("paypal.class.php");

$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

function assinaPlano($mysqli, $plano, $aluno){
	$mesesDuracao = $plano->meses_duracao < 1 ? 1 : $plano->meses_duracao;
	$dataInicio = date('Y-m-d H:i:s');
	$vencimento = date('Y-m-d H:i:s', strtotime("+".$mesesDuracao." month", strtotime($dataInicio)));

	$qry = "SELECT  p.valor FROM assinaturas a
	left join planos p on p.planoId = a.planoId
	where alunoId = $aluno->alunoId"; 
	$assinados = $mysqli->query($qry);
	$rowAssinados = $assinados->fetch_array();

	if ( (mysqli_num_rows($assinados) == 1 && $rowAssinados['valor'] == 0) || $plano->valor > 0) {
	 $deleteOlders = $mysqli->query("DELETE from assinaturas where alunoId = {$aluno->alunoId}");
	}
 

	$insert_row = $mysqli->query("INSERT INTO assinaturas (alunoId, planoId, data_inicio, vencimento)
	VALUES ('$aluno->alunoId','$plano->planoId','$dataInicio','$vencimento')");

	if($insert_row){
		print 'Concluido! O id registrado é: ' .$mysqli->insert_id .'<br />'; 
		$_SESSION['alert'] = true;
		$_SESSION['alert-class'] = "alert alert-success";
		$_SESSION['alert-msgm'] = "Assinatura do plano <strong>".$plano->nome."</strong> realizada com sucesso!";
		$_SESSION['tipo_item'] = 'plano';
		$tipoEmail = $plano->valor > 0 ? 'assinatura_plano' : 'assinatura_plano_free';
		include_once("../../class.php");
		$gm = new gm();
		//$gm->email($aluno->email,null, null, $tipoEmail,(array)$aluno);

		header('Location:../../boas-vindas');
	}else{
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
}

$code = $_SESSION["planos"];

if(isset($_SESSION["planos"]))
{
	$paypal_data ='';
	$valorDesconto = 0;
		
	$plano = $mysqli->query("SELECT * FROM planos WHERE planoId='$code' LIMIT 1");
	$plano = $plano->fetch_object();

	if($plano->valor == 0){ // plano free
		$aluno = $user->user();
		if($aluno){
			assinaPlano($mysqli, $plano, $aluno);	
		}
	} 
		
    $paypal_data .= '&L_PAYMENTREQUEST_0_NAME0='.urlencode($plano->nome);
    $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($plano->planoId);
	$paypal_data .= '&L_PAYMENTREQUEST_0_AMT0='.urlencode($plano->valor);

	$paypal_product['items'][] = array('itm_name'=>$plano->nome,
											'itm_price'=>$plano->valor,
											'itm_code'=>$plano->planoId, 
											);

	if(isset($_SESSION["cupom"])){
		include_once("../../class.php");
		$gm = new gm();
		$cupom = $gm->getRegistro('cupons','codigo', $_SESSION["cupom"]);

		if($cupom && ($cupom['desconto'] < 100)){
			$valorDesconto = $plano->valor * ($cupom['desconto'] / 100);

			$paypal_data .= '&L_PAYMENTREQUEST_0_NAME1='.urlencode("Cupom de Desconto ".$cupom['desconto']."%");
			$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER1='.urlencode($cupom['codigo']);
			$paypal_data .= '&L_PAYMENTREQUEST_0_AMT1='.urlencode(-$valorDesconto);

			$paypal_product['items'][] = array('itm_name'=>"Cupom de Desconto ".$cupom['desconto']."%",
											'itm_price'=> -$valorDesconto,
											'itm_code'=>$cupom['codigo'], 
											);
		}
		unset($_SESSION["cupom"]);
	}    
		
	$totalDaCompra = ($plano->valor - $valorDesconto);
	
	$paypal_product['assets'] = array(
								'grand_total'=>$totalDaCompra);
	
	$_SESSION["paypal_products"] = $paypal_product;
	
	$padata = 	'&METHOD=SetExpressCheckout'.
				'&RETURNURL='.urlencode($PayPalReturnURL ).
				'&CANCELURL='.urlencode($PayPalCancelURL).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$paypal_data.				
				'&NOSHIPPING=1'. 
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($totalDaCompra).
				'&PAYMENTREQUEST_0_AMT='.urlencode($totalDaCompra).
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
				unset($_SESSION["planos"]); 
			 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
				header('Location: '.$paypalurl);
		}
		else
		{
			//Show error message
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			var_dump($paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode));
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
        $paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($p_item['itm_price']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($p_item['itm_name']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($p_item['itm_code']);
        
		// item price X quantity
        $subtotal = ($p_item['itm_price']);
		
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
					
					$plano = $mysqli->query("SELECT * FROM planos WHERE planoId='$ItemNumber' LIMIT 1");
					$plano = $plano->fetch_object();

					$data = date("Y-m-d H:i:s");
					$aluno = $user->user();
					$alunoId = $aluno ? $aluno->alunoId : "";

					$insert_row = $mysqli->query("INSERT INTO pagamentos 
					(email_consumidor,code,alunoId,produto,planoId, valor, data, status_pagamento)
					VALUES ('$buyerEmail','$transactionID','$alunoId','$ItemName','$ItemNumber', '$ItemTotalPrice', '$data', '4')");

					if($aluno){
						assinaPlano($mysqli, $plano, $aluno);	
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
