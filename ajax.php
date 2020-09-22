<?php include 'config.php';
include 'vars.php';
include 'helper/functions.php';
include 'user.php';
include 'class.php';


if (isset($_REQUEST['updateuser'])) {
	echo $user->newuser($_REQUEST, 1);
	die;
}


if (isset($_REQUEST['senha2'])) {
	echo $user->newuser($_REQUEST);
}

if (isset($_REQUEST['lemail'])) {
	echo $user->login($_REQUEST);
}

if (isset($_REQUEST['infocupom'])) {
	$valida = $gm->validaCupom($_REQUEST['infocupom']);
	if ($valida == 1) {
		$desconto = $gm->getRegistro('cupons', 'codigo', $_REQUEST['infocupom']);
		echo 'Um desconto de ' . ($desconto['desconto']) . '% será aplicado!';
	} else {
		echo  $valida;
	}
}

if (isset($_REQUEST['updatePgbar'])) {
	echo $gm->cursoProgresso($_REQUEST['updatePgbar']);
}

if (isset($_REQUEST['contato'])) {

	$captcha = null;

	if ($_REQUEST['g-recaptcha-response']) {

		$data = array(
			'secret' => "6Lf5lmIUAAAAADJW5suzMeKPE8dnxFGesB6z0SC3",
			'response' => $_REQUEST['g-recaptcha-response']
		);

		$verify = curl_init();
		curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($verify, CURLOPT_POST, true);
		curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($verify), 1);


		if ($response['success'] == true) {
			$captcha = 1;
		}
	}

	if ($captcha == null) {
		echo "Prove que você não é um robô";
		die;
	} else {

		$msg = 'Nome: ' . $_REQUEST['name'] . '<br><br>';
		$msg .= 'E-mail: ' . $_REQUEST['email'] . '<br><br>';
		$msg .= 'Assunto: ' . $_REQUEST['assunto'] . '<br><br>';
		$msg .= 'Mensagem: ' . $_REQUEST['message'] . '<br><br>';

		$gm->email(email_destino, 'Fale Conosco ' . site_nome, $msg, null, null);
		echo "Obrigado! Sua mensagem foi enviada!";
	}
	//echo $gm->login($_REQUEST);
}


if (isset($_REQUEST['reqmail'])) {
	echo $user->esqueci($_REQUEST['reqmail']);
}


if (isset($_REQUEST['pagador_cpf'])) {
	echo $user->updateUserpgto($_REQUEST);
	die;
}

if (isset($_REQUEST['ping'])) {
	echo $user->updatePing();
	die;
}

if (isset($_REQUEST['vfsession'])) {
	echo $user->vfsession();
	die;
}



if (isset($_REQUEST['opiniao'])) {
	echo $user->novaOpiniao($_REQUEST);
	die;
}

if (isset($_REQUEST['_mc4wp_form_id'])) {
	echo $user->newsletter($_REQUEST);
	die;
}

if (isset($_REQUEST['isloged'])) {
	if ($user->isloged()) {
		echo 1;
	} else {
		echo 0;
	}
}


if (isset($_REQUEST['checkout'])) {
	if (!$user->isloged()) {
		echo json_encode($ret['res'] = 0);
		die;
	}

	$c = $gm->checkout($_REQUEST);
	echo json_encode($c);
}


if (isset($_REQUEST['defRedir'])) {
	$_SESSION['redirect'] = u . $_REQUEST['defRedir'];
	echo  $_SESSION['redirect'];
}

if (isset($_REQUEST['loadAula'])) {

	$a = $gm->obj('aulas', 'aulaId', $_REQUEST['loadAula'], 1);

	$curso = $gm->obj('cursos', 'cursoId', $a->cursoId, 1);

	if ($curso) {
		if ($curso->categoriaId == 6 || $curso->categoriaId == 7) { // Categoria EM BREVE ou OCULTO
			if ($user->isloged()) {
				if ($curso->emails_vizualiza_em_breve) {
					$emailsInstrutores = explode(';', $curso->emails_vizualiza_em_breve);
					if (!in_array($user->user()->email, $emailsInstrutores)) {
						$res['res'] = "<p><b>Acesso negado!</b></p>
						<p>Este curso ainda não foi lançado. Em breve você poderá visualizar os seus conteúdos.</p>
						";
						echo json_encode($res);
						die;
					}
				} else {
					$res['res'] = "<p><b>Acesso negado!</b></p>
						<p>Este curso ainda não foi lançado. Em breve você poderá visualizar os seus conteúdos.</p>
						";
					echo json_encode($res);
					die;
				}
			} else {
				$res['res'] = "<p><b>Acesso negado!</b></p>
						<p>Este curso ainda não foi lançado. Em breve você poderá visualizar os seus conteúdos.</p>
						";
				echo json_encode($res);
				die;
			}
		}
	}


	if ($user->isloged() == false &&  $a->free != 1) {
		$res['res'] = "<p><b>Ação Necessária!</b></p>
		<p>Para ter acesso a esta aula você precisa estar logado em nosso sistema.</p>
		";
		echo json_encode($res);;
		die;
	}

	$per = $user->accessPermission($a->cursoId);

	if ($a->free == 1) {
		include 'includes/page_aula.php';
		$gm->regAula($_REQUEST['loadAula']);
	} else if ($per['ret'] == true) {
		include 'includes/page_aula.php';
		$gm->regAula($_REQUEST['loadAula']);
	} else {

		if ($per['ret'] == true) {
			$res['res'] = "<p><b>Ação Necessária</b></p>
		<p>Para ter acesso a esta aula você precisa adquirir a compra deste curso ou então realizar a assinatura de um plano.</p>
		";
			echo json_encode($res);
		} else {


			if ($per['reason'] == 'expired') {
				$res['res'] = "<p><b>Parece que sua assinatura está expirada!</b><p/>
			<p>Você pode renovar sua matrícula ou assinar um plano para ter acesso à todos os cursos.</p>
			<a href='" . u . "cursos-de-musica-online-assinaturas' class='btn btn-danger' style='background-color: #d9534f'>RENOVAR</a>";
			} else {
				$res['res'] = $per['reason'];
			}
			if ($per['reason'] == 'Curso indisponivel no seu plano!') {
				$res['res'] = "<p><b>Ação Necessária</b></p>
		        <p>Para ter acesso a esta aula você precisa adquirir a compra deste curso ou então realizar a assinatura de um plano.</p>
		         ";
			}

			echo json_encode($res);
		}
	}
}

if (isset($_REQUEST['matricular'])) {
	if ($user->isloged()) {
		$user->matricular($_REQUEST['matricular']);
	}
}
