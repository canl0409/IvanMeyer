<?php header("Access-Control-Allow-Origin: *");
include '../config.php';
include '../vars.php';
include '../helper/functions.php';
include '../class.php';
include '../user.php';
include 'api.php';

function js($r){
	echo json_encode($r,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

//Requisição da nova senha
if($_REQUEST['tipo'] == 'esqueci_senha'){
        
    $nsenha = $user->esqueci($_REQUEST['rsenha_email']);
        
    $api['resposta'] = $nsenha;
    echo js($api);
}

//Requisição LOGIN
if($_REQUEST['tipo'] == 'login'){

	$data['lemail'] = $_REQUEST['email'];
	$data['lsenha'] = $_REQUEST['senha'];

	$res = $user->login($data);
	$res = json_decode($res);

	if($res->status == 1){
		$apitoken  = md5(uniqid(rand(), true));
		$gm->addQuery("UPDATE alunos set apitoken = '$apitoken ' where alunoId = '".$_SESSION['aluno']."' ");
		$aluno = $user->user();

		$api['autenticado'] = 1;
		$api['token'] = $apitoken;
		$api['id_usuario'] = $aluno->alunoId;
		$api['nome'] = $aluno->nome;
		$api['email'] = $aluno->email;

		$plano = $user->planoAluno($aluno->alunoId);

		if($plano){

			$hoje = new DateTime(date('Y-m-d'));

			$api['plano'] = $plano->nome;
			$api['expiracao_plano'] = $plano->vencimento;
			$api['plano_caracteristica1'] = trim($plano->caracteristicas);
			$api['plano_caracteristica2'] = trim($plano->caracteristica2);
			$api['plano_caracteristica3'] = trim($plano->caracteristica3);

			$vencimento = new DateTime('22-01-1990');
			$vencimento = $plano->vencimento ? new DateTime(date('Y-m-d',strtotime($plano->vencimento))) : $vencimento;

			$api['expira_dias'] = floor((strtotime($plano->vencimento) - strtotime($hoje->format('Y-m-d H:i:s'))) / (60 * 60 * 24));

			if($plano->vencimento){
				if($hoje > $vencimento){
					$api['status_conta'] = "expirado";
				}else{
					$api['status_conta'] = "ativo";
				}
			}
		}

		echo js($api);

	}else{
		$api['autenticado'] = 0;
		echo js($api);
	}

}





//CURSOS MATRICULADOS
if( $_REQUEST['tipo'] == 'cursos'){

	$vt = $ap->validaToken($_REQUEST['token'],$_REQUEST['id_usuario']);

	if($vt){
		//$cm = $gm->obj('cursos_matriculas','alunoId',$_REQUEST['id_usuario']);

        $cm = $gm->getMeusCursosAluno($_REQUEST['id_usuario']);

		foreach ($cm as $css){
			$cs = $gm->obj('cursos','cursoId',$css['cursoId'], 1);
			$instrutor = $gm->obj('instrutores','instrutorId',$css['instrutorId'], 1);
			$categoria = $gm->obj('categorias','categoriaId',$css['categoriaId'], 1);

			$cr[] = [
				'id_curso' =>  $cs->cursoId,
				'nome_curso' => $cs->titulo,
				'andamento_porcentagem' =>   $gm->cursoProgresso($cs->cursoId, $_REQUEST['id_usuario']),
				'vencimento' =>   $gm->vencimento($cs->cursoId, null, $_REQUEST['id_usuario']),
				'instrutor' => $instrutor->nome,
				'instrutorId' => $cs->instrutorId,
				'categoria' => $categoria->nome,
				'categoriaId' => $cs->categoriaId,
				'nivel' => $cs->nivel,
				'certificado' => $cs->certificado,
				'duracao' => $cs->duracao,
				'imagem' => $cs->imagem,
				'thumb' => $cs->thumb,
				'banner' => $cs->banner,
				'descricao' => $cs->descricao,
			];
		}

		$x['cursos'] = $cr;
		echo js($x);
	}else{
		$api['autenticado'] = 0;
		echo js($api);
	}

}


//AULAS
//Requisição aulas
if( $_REQUEST['tipo'] == 'aulas'){

	$vt = $ap->validaToken($_REQUEST['token'],$_REQUEST['id_usuario']);

	if($vt){
		$cm = $gm->obj('aulas','cursoId',$_REQUEST['id_curso']);
		foreach ($cm as $cs){
			$modulo = $gm->obj('modulos','moduloId',$cs['moduloId'], 1);
			$cr[] = [
				'id_aula' =>  $cs['aulaId'],
				'nome_aula' => $cs['titulo'],
				'video' => str_replace('vimeo.com/','player.vimeo.com/video/',$cs['video']),
				'moduloId' => $cs['moduloId'],
				'modulo' => $modulo->nome,
				'modulo_orden' => $modulo->orden,
				'audio' => $cs['audio'],
				'files' => $cs['files'],
				'duracao' => $cs['duracao'],
				'aula_orden' => $cs['orden'],
				'free' => $cs['free'],
				'aula_visualizada' => $gm->viwedAula($cs['aulaId'], $_REQUEST['id_usuario']),
				'texto' => $cs['texto'],
			];
		}
		$x['aulas'] = $cr;
		echo js($x);
	}else{
		$api['autenticado'] = 0;
		echo js($api);
	}

}



//CONTEÚDO AULA

//Requisição aula
if($_REQUEST['tipo'] == 'aula'){

	$vt = $ap->validaToken($_REQUEST['token'],$_REQUEST['id_usuario']);

	if($vt){

		$a = $gm->obj('aulas','aulaId',$_REQUEST['id_aula'],1);

		$filesf = json_decode($a->files,1);

		if($filesf){
			foreach ($filesf as $file) {
				$files[] = u.'assets/files/'.$file;
		   }
		}else{
			$files = [];
		}

        $cx['id_aula'] = $a->aulaId;
        $cx['id_curso'] = $a->cursoId;
        $cx['nome_aula'] = $a->titulo;
        $cx['video'] = str_replace('vimeo.com/','player.vimeo.com/video/',$a->video);
        $cx['conteudo_texto'] = $a->texto;
        $cx['arquivos'] = $files;
        $cx['aula_free'] = $a->free;
		$cx['status'] = $ap->isCursoExpired($a->cursoId,$_REQUEST['id_usuario']);
		$cx['moduloId'] = $a->moduloId;
		$cx['audio'] = $a->audio;
		$cx['duracao'] = $a->duracao;
		$cx['orden'] = $a->orden;
		$cx['aula_visualizada'] = $gm->viwedAula($a->aulaId, $_REQUEST['id_usuario']);

		echo js($cx);
	}else{
		$api['autenticado'] = 0;
		echo js($api);
	}

}



//Registro de  AULA VISUALIZADA

//Requisição para registrar visualização de aula
if($_REQUEST['tipo'] == 'aula_visualizada'){

	$vt = $ap->validaToken($_REQUEST['token'],$_REQUEST['id_usuario']);

	if($vt){
		$gm->regAula($_REQUEST['id_aula'],$_REQUEST['id_usuario']);

        $cx['msgm'] ="Aula {$_REQUEST['id_aula']} registrada como visualizada com sucesso para o aluno {$_REQUEST['id_usuario']}!";

		echo js($cx);
	}else{
		$api['autenticado'] = 0;
		echo js($api);
	}

}

?>
