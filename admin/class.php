<?php
class hf extends Config
{

	public $invalid_numbers_accounts_ids = array();
	public $fixed_numbers = array();

	protected $mysqli;
	public $data;
	function __construct()
	{
		parent::__construct();
	}

	public function generateHash($plainText, $salt = null)
	{
		if ($salt === null) {
			$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		} else {
			$salt = substr($salt, 0, 9);
		}

		return $salt . sha1($salt . $plainText);
	}

	public function senhamaster($senha)
	{
		$result = $this->mysqli->query("SELECT * FROM admin WHERE senhamaster='" . $senha . "' and senhamaster != '' ");
		if (mysqli_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function saveCupon($dados)
	{
		$ndata = date('Y-m-d', strtotime($dados['validade']));
		$xx = $this->mysqli->query("UPDATE cupons set codigo='$dados[codigo]', desconto='$dados[desconto]' ,  validade='$ndata'  WHERE cuponId='$dados[savacuponid]' ");
		if ($xx) {
			return "Cupon atualizado!";
		} else {
			return "Erro";
		}
	}

	public function addCupon($dados)
	{
		$ndata = date('Y-m-d', strtotime($dados['validade']));
		$pfix = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5);
		$cp = $pfix . uniqid();
		$xx = $this->mysqli->query("INSERT INTO cupons set codigo='$cp', desconto='$dados[desconto]' , data = now() , validade='$ndata'   ");
		if ($xx) {
			return "Registro Adicionado!";
		} else {
			return "Erro";
		}
	}

	public function delBanner($banner)
	{
		$result = $this->mysqli->query("SELECT * FROM banners WHERE bannerId='$banner' ");
		if (mysqli_num_rows($result) > 0) {
			$r = $result->fetch_array();
			$this->mysqli->query("DELETE FROM banners WHERE bannerId='$banner'  ");
			unlink('../assets/imgs/' . $r['imagem']);
		}
	}

	public function fileDelete($fileName, $dir)
	{
		$file = $dir . $fileName;
		if (file_exists($file)) {
			unlink($file);
		}
		return "Arquivo excluído com sucesso!";
	}

	public function senhamasterpriv($senha)
	{
		$result = $this->mysqli->query("SELECT * FROM admin WHERE senhamaster='" . $senha . "' and senhamaster != '' ");
		if (mysqli_num_rows($result) > 0) {
			$r = $result->fetch_array();
			if ($r['perms_rest']) {
				$_SESSION['perms'] = $r['perms_rest'];
			}
			return true;
		} else {
			return false;
		}
	}

	public function vfboleto()
	{
		$result = $this->mysqli->query("SELECT * FROM boletos WHERE  doc_situacao_pagamento = 'PENDENTE' and restaurante_id ='$_SESSION[radmin]' ");
		//var_dump(mysqli_num_rows($result)); die;
		if (mysqli_num_rows($result) >= 1) {
			$r = $result->fetch_array();

			return $r;
		} else {
			return false;
		}
	}



	public function clientecep($clienteId)
	{
		$c = $this->cliente($clienteId);
		return $this->taxaentrega($c['cep']);
	}

	public function login($var)
	{
		$result = $this->mysqli->query("SELECT * FROM admin WHERE email='" . $var['email2'] . "' and senha ='" . $var['senha'] . "' ");
		if (mysqli_num_rows($result) == 1) {
			$r = $result->fetch_array();
			$_SESSION['radmin'] = $r['adminId'];
			$_SESSION['adminnome'] =  $r['nome'];
			header('Location: index.php');
		} else {
			return "Dados incorretos";
		}
	}

	public function vflogin()
	{
	}

	public function sair()
	{
		session_destroy();
		session_unset();
		session_destroy();

		unset($_COOKIE['radmin']);
		unset($_SESSION['radmin']);
		unset($_SESSION['adminnome']);

		unset($_SESSION['vendedor']);
		unset($_SESSION['vendedornome']);
		unset($_SESSION['corretoraId']);

		unset($_SESSION['corretora']);
		unset($_SESSION['vendedornome']);


		setcookie('radmin', '000');
		header('Location: login.php');
	}

	public function esqueci($req)
	{
		$vcm = $this->mysqli->query("SELECT * FROM vendedores WHERE email='$req[email]'  ");
		if (mysqli_num_rows($vcm) == 0) {
			return 'Este e-mail não esta cadastrado conosco.';
		} else {
			//$row = $vcm->fetch_array();
			$nsenha = 'P' . uniqid();
			$this->mysqli->query("UPDATE vendedores set senha='" . $nsenha . "' WHERE email='$req[email]'  ");
			$this->email($req['email'], 'Nova Senha SAMP', 'Sua nova senha é: ' . $nsenha);
			return 'ok';
		}
	}

	public function i()
	{
		$result = $this->mysqli->query("SELECT * FROM restaurantes WHERE  restauranteId='" . $_SESSION["radmin"] . "'  ");
		$r = $result->fetch_array();
		return $r;
	}

	public function lista($table, $where = null)
	{
		$row = array();
		$result = $this->mysqli->query("SELECT * FROM $table $where");
		while ($rows = $result->fetch_array()) {
			$row[] = $rows;
		}
		return $row;
	}






	public function addComunicado($dados, $files)
	{
		$esc = array('produtoId', 'ppequena', '_wysihtml5_mode', 'pmedia', 'pgrande', 'preco');
		$data = null;
		$titulo   =   $dados['nome'];
		$categoriaId   =   $dados['categoriaId'];



		if (isset($dados['corretora'])) {
			$corretoraId  =   implode(',', $dados['corretora']);
		} else {
			$dados['corretora'] = '';
			$corretoraId  = '';
		}


		if (trim($corretoraId) == 'todas') {
			$corretoraId  = '';
		}



		$texto    =   $dados['descricao'];

		$notifica_corretora = $dados['notifica_corretora'];
		$notifica_admin = $dados['notifica_admin'];

		$data = substr($data, 0, strlen($data) - 1);

		$xx = $this->mysqli->query("INSERT INTO comunicados set titulo='$titulo', corretoraId='$corretoraId', categoriaId='$categoriaId', texto='$texto' , data = now(), notifica_corretora='$notifica_corretora', notifica_admin='$notifica_admin'");
		$pid = mysqli_insert_id($this->mysqli);

		//NOTIFICA VENDEDORES
		$lu  = $this->lista('vendedores');
		foreach ($lu as $us) {
			if (isset($dados['corretora'])) {
				$vfg = in_array($us['corretoraId'], $dados['corretora']);
			} else {
				$vfg = false;
			}
			if ($vfg or $dados['corretora'] == '') {
				$this->email($us['email'], 'Nova publicação Samp cadastrada', "Uma nova publicação foi cadastrada: <br> <b>$titulo</b> <br> Acesse o nosso <a href='https://www.samp.com.br/es/portaldoscorretores'>sistema</a> para visualizar.");
			}
		}

		//NOTIFICA CORRETORAS
		$lc  = $this->lista('corretoras');
		foreach ($lc as $co) {
			if (isset($dados['corretora'])) {
				$vfg = in_array($co['corretoraId'], $dados['corretora']);
			} else {
				$vfg = false;
			}
			if ($vfg or $dados['corretora'] == '') {
				$this->email($co['email'], 'Nova publicação Samp cadastrado', "Uma nova publicação foi cadastrada: <br> <b>$titulo</b> <br> Acesse o nosso <a href='https://www.samp.com.br/es/portaldoscorretores'>sistema</a> para visualizar.");
			}
		}


		if ($files['imagem']['tmp_name'][0] != '') {

			$i = 0;
			foreach ($files['imagem']['tmp_name']  as $file) {
				$x = $i++;

				$filename = $files['imagem']['name'][$x];

				$path_info = pathinfo($filename);

				$extensao =  $path_info['extension'];

				$nome = uniqid() . '.' . $extensao;

				$mv =  move_uploaded_file($file, 'uploads/' . $nome);
				if ($mv) {
					$this->mysqli->query("INSERT INTO arquivos set comunicadoId ='$pid', arquivo ='$nome'  ");
				}
			}
		}

		if ($xx) {
			return "Publicação cadastrada!";
		} else {
			return "Erro";
		}
	}


	public function updateComunicado($dados, $files)
	{
		$esc = array('produtoId', 'ppequena', '_wysihtml5_mode', 'pmedia', 'pgrande', 'preco');
		$data = null;
		$titulo   =   $dados['titulo'];
		$categoriaId   =   $dados['categoriaId'];
		$pid           =   $dados['upid'];
		if (isset($dados['corretora'])) {
			$corretoraId  =   implode(',', $dados['corretora']);
		} else {
			$dados['corretora'] = '';
			$corretoraId  = '';
		}

		if (trim($corretoraId) == 'todas') {
			$corretoraId  = '';
		}


		if (isset($dados['delfile'])) {
			foreach ($dados['delfile'] as $arq) {
				$this->mysqli->query("DELETE from arquivos where arquivo ='$arq'");
				unlink('uploads/' . $arq);
			}
		}


		$texto    =     		$dados['descricao'];

		$notifica_corretora = 	$dados['notifica_corretora'];
		$notifica_admin = 		$dados['notifica_admin'];

		$data = substr($data, 0, strlen($data) - 1);

		$xx = $this->mysqli->query("UPDATE comunicados set titulo='$titulo', corretoraId='$corretoraId', categoriaId='$categoriaId', texto='$texto' , data = now(), notifica_corretora='$notifica_corretora', notifica_admin='$notifica_admin' WHERE comunicadoId='$pid'");


		if ($files['imagem']['tmp_name'][0] != '') {

			$i = 0;
			foreach ($files['imagem']['tmp_name']  as $file) {
				$x = $i++;

				$filename = $files['imagem']['name'][$x];

				$path_info = pathinfo($filename);

				$extensao =  $path_info['extension'];

				$nome = uniqid() . '.' . $extensao;

				$mv =  move_uploaded_file($file, 'uploads/' . $nome);
				if ($mv) {
					$this->mysqli->query("INSERT INTO arquivos set comunicadoId ='$pid', arquivo ='$nome'  ");
				}
			}
		}

		if ($xx) {
			return "Publicação atualizada!";
		} else {
			return "Erro";
		}
	}

	public function addRegistroImg($dados, $file, $table, $chave, $fieldfoto, $dir)
	{
		$esc = array('upid', '_wysihtml5_mode', 'Id', 'preco');
		$data = null;

		if (isset($dados['valor'])) {
			$dados['valor'] = str_replace(',', '.', $dados['valor']);
		}

		if (isset($dados['categoriaId'])) {
			$dados['categoriaId'] =  implode(',', $dados['categoriaId']);
		}

		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
		}


		$data = substr($data, 0, strlen($data) - 1);
		$xx = $this->mysqli->query("INSERT INTO $table set  $data     ");
		#echo "INSERT INTO $table set  $data     " ; die;
		$pid = mysqli_insert_id($this->mysqli);




		if ($file) {
			include 'upload.php';
			foreach ($file as $campo => $image) {


				$handle = new Upload($image);
				if ($handle->uploaded) {
					$handle->image_resize = false;
					$handle->image_ratio_x = true;
					// $handle->image_x                = 100;
					//$handle->image_y = 205;
					$handle->image_watermark = false;
					$handle->Process("$dir");

					if ($handle->processed) {
						$img = $handle->file_dst_name;
						$this->mysqli->query("UPDATE $table set $campo ='$img' WHERE $chave ='$pid' ");
					} else {
						$msgx .= 'errooooooooo';
					}
				}
			}
		}
		if ($xx) {
			return "Registro adicionado!";
		} else {
			return "Erro";
		}
	}

	public function updateRegistroImg($dados, $file,  $table, $chave, $id, $fieldfoto, $dir)
	{
		$esc = array('upid', '_wysihtml5_mode', 'Id', 'preco');
		$data = null;

		if (isset($dados['valor'])) {
			$dados['valor'] = str_replace(',', '.', $dados['valor']);
		}

		if (isset($dados['categoriaId'])) {
			$dados['categoriaId'] =  implode(',', $dados['categoriaId']);
		}

		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
		}

		$data = substr($data, 0, strlen($data) - 1);
		$xx = $this->mysqli->query("UPDATE $table set  $data  WHERE $chave='$id'  ");

		if ($file) {

			include 'upload.php';
			foreach ($file as $campo => $image) {

				if ($campo == 'foto_grande') {
					$dir = '../assets/images/';
				}

				$handle = new Upload($image);
				if ($handle->uploaded) {
					$handle->image_resize = false;
					$handle->image_ratio_x = true;
					// $handle->image_x                = 100;
					//$handle->image_y = 205;
					$handle->image_watermark = false;
					$handle->Process("$dir");

					if ($handle->processed) {
						//$pd =  $this->getRegistro($table,$chave,$id);
						//unlink($dir.''.$pd[$fieldfoto]);
						$img = $handle->file_dst_name;
						$this->mysqli->query("UPDATE $table set $campo ='$img' WHERE $chave='$id' ");
					} else {
						//$msgx .= 'errooooooooo';
					}
				}
			}
		}
		if ($xx) {
			return "Registro atualizado!";
		} else {
			return "Erro";
		}
	}


	public function updateRegistroUpload($dados, $file,  $table, $chave, $id, $dir)
	{
		$esc = array('upid', '_wysihtml5_mode', 'Id', 'preco');
		$data = null;

		if (isset($dados['valor'])) {
			$dados['valor'] = str_replace(',', '.', $dados['valor']);
		}

		if (isset($dados['categoriaId'])) {
			$dados['categoriaId'] =  implode(',', $dados['categoriaId']);
		}

		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
		}

		$data = substr($data, 0, strlen($data) - 1);
		$xx = $this->mysqli->query("UPDATE $table set  $data  WHERE $chave='$id'  ");


		if ($file) {

			include 'upload.php';
			foreach ($file as $campo => $image) {


				$handle = new Upload($image);
				if ($handle->uploaded) {
					$handle->image_resize = false;
					$handle->image_ratio_x = true;
					// $handle->image_x                = 100;
					//$handle->image_y = 205;
					$handle->image_watermark = false;
					$handle->Process("$dir");

					if ($handle->processed) {
						//$pd =  $this->getRegistro($table,$chave,$id);
						//unlink($dir.''.$pd[$fieldfoto]);
						$img = $handle->file_dst_name;
						$this->mysqli->query("UPDATE $table set $campo ='$img' WHERE $chave='$id' ");
					} else {
						//$msgx .= 'errooooooooo';
					}
				}
			}
		}
		if ($xx) {
			return "Registro atualizado!";
		} else {
			return "Erro";
		}
	}

	public function upload($file, $dir)
	{
		if ($file) {
			include_once 'upload.php';
			$handle = new Upload($file);
			if ($handle->uploaded) {
				$handle->Process("$dir");
				if ($handle->processed) {
					return $handle->file_dst_name;
				} else {
					//return $handle->error;
					return "";
				}
			}
		}
	}


	public function addImages($file, $table, $sessao)
	{
		if ($file['banner']['name']) {
			include_once 'upload.php';
			$i = 0;
			$nfiles = $this->ra($file["banner"]);
			foreach ($nfiles as $filex) {


				$handle = new Upload($filex); //var_dump($handle);
				if ($handle->uploaded) {
					//$handle->image_resize = true;
					//	$handle->image_ratio_x = false;
					//$handle->image_x = 1019;
					//$handle->image_y = 300;
					$handle->image_watermark = false;
					$handle->Process("../assets/imgs/");

					if ($handle->processed) {
						$img = $handle->file_dst_name;
						$this->mysqli->query("INSERT INTO  $table  set sessao='{$sessao}', imagem ='$img'  ");
					} else {
						$msgx .= 'errooooooooo';
					}
				}

				$i++;
			} ////
		}
	}

	public function addQuery($q)
	{
		$xx = $this->mysqli->query($q);
		if ($xx) {
			return true;
		} else {
			return false;
		}
	}



	public function clientes()
	{
		$row = array();
		$result = $this->mysqli->query("SELECT t.* FROM clientes t WHERE FIND_IN_SET( '" . $_SESSION['radmin'] . "', t.restaurantesId ) >0 ");
		while ($rows = $result->fetch_array()) {
			$row[] = $rows;
		}
		return $row;
	}


	public function ra(&$file_post)
	{
		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);
		for ($i = 0; $i < $file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}

	public function cliente($cid)
	{
		$result = $this->mysqli->query("SELECT * FROM clientes WHERE  clienteId='$cid' ");
		$row = $result->fetch_array();
		return $row;
	}

	public function getEndereco($enderecoId)
	{
		$result = $this->mysqli->query("SELECT * FROM enderecos WHERE enderecoId='$enderecoId'  ");
		$r = $result->fetch_array();
		return $r['endereco'];
	}

	public function getCat($id)
	{
		$result = $this->mysqli->query("SELECT * FROM  categorias WHERE Id='$id' and RestId='$_SESSION[radmin]'");
		$row = $result->fetch_array();
		return $row;
	}

	public function categorias()
	{
		$result = $this->mysqli->query("SELECT * FROM  categorias WHERE RestId='$_SESSION[radmin]'");
		while ($rows = $result->fetch_array()) {
			$row[] = $rows;
		}
		return $row;
	}

	public function getConfig($c)
	{
		$result = $this->mysqli->query("SELECT * FROM config WHERE configId='$c'");
		$r = $result->fetch_array();
		return $r['valor'];
	}

	public function del($table, $chave, $id, $protect = NULL)
	{

		//echo "DELETE FROM $table  WHERE $chave = '$id'  "; die;
		$xx = $this->mysqli->query("DELETE FROM $table  WHERE $chave = '$id'  ");
	}

	public function updateRegistro($dados, $table, $chave, $protect = NULL)
	{
		$qp = null;

		if ($protect) {
			$qp = "  and  $protect = '" . $_SESSION['radmin'] . "' ";
		}

		$esc = array('produtoId', 'upid', '_wysihtml5_mode', 'Id', 'multi', 'editassinatura');
		$data = null;

		if ($table == 'planos') {
			if (isset($dados['exibir_home'])) {
				$dados['exibir_home'] = 1;
			} else {
				$dados['exibir_home'] = 0;
			}

			if (isset($dados['exibir_pageplano'])) {
				$dados['exibir_pageplano'] = 1;
			} else {
				$dados['exibir_pageplano'] = 0;
			}

			if (isset($dados['cursos'])) {
				$dados['cursos'] = implode(',', $dados['cursos']);
			}
		}

		if (isset($dados['professores'])) {
			$dados['professores'] =  implode(',', $dados['professores']);
		}

		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
		}

		$data = substr($data, 0, strlen($data) - 1);

		$xx = $this->mysqli->query("UPDATE $table set  $data  WHERE $chave = '$dados[upid]'    ");
		//echo "UPDATE $table set  $data  WHERE $chave = '$dados[upid]'    ";
		if ($xx) {
			return "Registro atualizado!";
		} else {
			return "Erro";
		}
	}

	public function updateConfig($dados, $table, $chave, $id)
	{
		$config = json_encode($dados);
		//echo "UPDATE $table set config= '$config'  WHERE $chave = '$id'    "; die;
		$xx = $this->mysqli->query("UPDATE $table set config= '$config'  WHERE $chave = '$id'    ");
		if ($xx) {
			return "Registro atualizado!";
		} else {
			return "Erro";
		}
	}

	public function atualizaMatricula($dados)
	{
		$this->updateRegistro($dados, 'cursos_matriculas', 'cmId');

		$hoje = new DateTime(date('Y-m-d'));
		$vencimento = new DateTime(date('Y-m-d', strtotime($dados['expira'])));
		if ($hoje > $vencimento) {  // matricula expirada
			$query = "SELECT * FROM alunos where alunoId = " . $dados['alunoId'];
			$result = $this->mysqli->query($query);
			$aluno = (array) $result->fetch_array();

			if ($aluno) {
				$aluno['cursoId'] = $dados['cursoId'];
				$aluno['data_expiracao'] = $vencimento->format('d/m/Y');
				include_once('../vars.php');
				include_once('../class.php');
				$gm = new gm();
				$gm->email($aluno['email'], null, null, 'curso_expirado', $aluno);
			}
		}
	}

	public function atualizaAssinatura($assinatura)
	{
		$this->updateRegistro($assinatura, 'assinaturas', 'assinaturaId');

		$hoje = new DateTime(date('Y-m-d'));
		$vencimento = new DateTime(date('Y-m-d', strtotime($assinatura['vencimento'])));
		if ($hoje > $vencimento) {  // assinatura expirada
			$query = "SELECT * FROM alunos where alunoId = " . $assinatura['alunoId'];
			$result = $this->mysqli->query($query);
			$aluno = (array) $result->fetch_array();

			if ($aluno) {
				$query = "SELECT * FROM planos where planoId = " . $assinatura['planoId'];
				$result = $this->mysqli->query($query);
				$plano = (array) $result->fetch_array();

				$aluno['assinatura_expirada_id'] = $assinatura['upid'];
				include_once('../vars.php');
				include_once('../class.php');
				$gm = new gm();
				$tipoEmail = $plano['valor'] > 0 ? 'assinatura_expirada' : 'assinatura_expirada_free';
				$gm->email($aluno['email'], null, null, $tipoEmail, $aluno);
			}
		}
	}

	public function addMatricula($dados, $table)
	{
		$data = '';
		$result = $this->mysqli->query("SELECT * FROM  $table WHERE alunoId='$dados[alunoId]' and cursoId='$dados[cursoId]' ");
		if (mysqli_num_rows($result) >= 1) {
			return "Este aluno já esta matrículado neste curso, <a href='index.php?alunos_edit2&pid=" . $dados['alunoId'] . "&tab=2'>voltar</a> ";
		}

		$esc = array('upid', '_wysihtml5_mode', 'preco');
		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
		}

		$data = substr($data, 0, strlen($data) - 1);
		$xx = $this->mysqli->query("INSERT INTO $table set  $data    ");
		if ($xx) {
			$query = "SELECT * FROM alunos where alunoId = " . $dados['alunoId'];
			$result = $this->mysqli->query($query);
			$aluno = (array) $result->fetch_array();

			if ($aluno) {
				include_once('../vars.php');
				include_once('../class.php');
				$gm = new gm();
				$gm->email($aluno['email'], null, null, 'curso_matriculado', $aluno);
			}
			return "Registro Adicionado/Atualizado!  <a href='index.php?alunos_edit2&pid=" . $dados['alunoId'] . "&tab=2'>voltar</a>";
		} else {
			return "Erro";
		}
	}



	public function addAssinatura($dados, $table)
	{
		/** $table = assinaturas */
		$dados['data_inicio'] = date("Y-m-d");
		$data = '';
		$this->mysqli->query("DELETE FROM $table WHERE alunoId='$dados[alunoId]'"); // apagando assinaturas antigas
		/*$result = $this->mysqli->query("SELECT * FROM  $table WHERE alunoId='$dados[alunoId]'");
        if(mysqli_num_rows($result) >= 1){
          return "Este aluno já possui uma assinatura, <a href='index.php?alunos_edit2&pid=".$dados['alunoId']."&tab=3'>voltar</a> ";
        }*/

		$esc = array('upid', '_wysihtml5_mode', 'preco');
		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
		}

		$data = substr($data, 0, strlen($data) - 1);
		$xx = $this->mysqli->query("INSERT INTO $table set  $data    ");
		if ($xx) {
			$query = "SELECT * FROM alunos where alunoId = " . $dados['alunoId'];
			$result = $this->mysqli->query($query);
			$aluno = (array) $result->fetch_array();

			if ($aluno) {
				$query = "SELECT * FROM planos where planoId = " . $dados['planoId'];
				$result = $this->mysqli->query($query);
				$plano = (array) $result->fetch_array();

				include_once('../vars.php');
				include_once('../class.php');
				$gm = new gm();
				$tipoEmail = $plano['valor'] > 0 ? 'assinatura_plano' : 'assinatura_plano_free';
				$gm->email($aluno['email'], null, null, $tipoEmail, $aluno);
			}
			return "Registro Adicionado/Atualizado!  <a href='index.php?alunos_edit2&pid=" . $dados['alunoId'] . "&tab=3'>voltar</a>";
		} else {
			return $this->mysqli->error;
		}
	}

	public function addRegistro($dados, $table, $files = null, $campo = null, $chave = null, $update = null)
	{
		$esc = array('upid', '_wysihtml5_mode', 'preco');
		$data = null;

		if (isset($dados['valor'])) {
			$dados['valor'] = str_replace(',', '.', $dados['valor']);
		}

		if ($table == 'aulas') {
			if (isset($dados['free'])) {
				$dados['free'] = 1;
			} else {
				$dados['free'] = 0;
			}

			if (isset($dados['email'])) {
				$dados['email'] = 1;
			} else {
				$dados['email'] = 0;
			}
		}

		if ($table == 'planos') {
			if (isset($dados['exibir_home'])) {
				$dados['exibir_home'] = 1;
			} else {
				$dados['exibir_home'] = 0;
			}

			if (isset($dados['exibir_pageplano'])) {
				$dados['exibir_pageplano'] = 1;
			} else {
				$dados['exibir_pageplano'] = 0;
			}


			if (isset($dados['cursos'])) {
				$dados['cursos'] = implode(',', $dados['cursos']);
			}
		}

		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
			if ($key == 'preco') {
				$data .= "preco = '" . str_replace(',', '.', $value) . "',";
			}
		}

		$data = substr($data, 0, strlen($data) - 1); //echo "INSERT INTO $table set  $data    "; die;

		if ($update) {
			$xx = $this->mysqli->query("UPDATE $table set  $data  WHERE $chave = '$dados[upid]'    ");
			// echo "UPDATE $table set  $data  WHERE $chave = '$dados[upid]'    "; die;
			$pid = $dados['upid'];

			$pd =  $this->getRegistro($table, $chave, $dados['upid']);

			$a_files = array();
			$a_audio = array();
			if (isset($pd['files'])) {
				$a_files = json_decode($pd['files'], 1);
			}
			if (isset($pd['audio'])) {
				$a_audio = json_decode($pd['audio'], 1);
			}
		} else {
			$xx = $this->mysqli->query("INSERT INTO $table set  $data    ");
			//echo "INSERT INTO $table set  $data    "; die;
			$pid = mysqli_insert_id($this->mysqli);

			$a_files = array();
			$a_audio = array();
		}





		if ($files) {
			$namefiles = array();
			$jsfiles = array();
			foreach ($files as $campo => $arquivo) {

				if ($files[$campo]['tmp_name'][0] != '') {

					$file = $files[$campo]['tmp_name'];



					$filename = $files[$campo]['name'];
					//if file name is array
					if (is_array($filename)) {


						$xf = 0;
						foreach ($filename as $fff) {

							$filename = $files[$campo]['name'][$xf];
							$file = $files[$campo]['tmp_name'][$xf];
							$nome = ur($filename);
							$mv =  move_uploaded_file($file, '../assets/' . $campo . '/' . $nome);

							//if($campo == 'files'){
							$namefiles[uniqid()] = ur($filename);
							//}
							$xf = $xf + 1;
						}

						if ($campo == 'files') {
							if (is_array($a_files)) {
								$all_files = array_merge($namefiles, $a_files);
							} else {
								$all_files	= $namefiles;
							}
						}

						if ($campo == 'audio') {
							if (is_array($a_audio)) {
								$all_files = array_merge($namefiles, $a_audio);
							} else {
								$all_files	= $namefiles;
							}
						}

						$nome = json_encode($all_files);


						if ($mv) {
							$this->mysqli->query("UPDATE $table set $campo ='$nome' where $chave = '$pid' ");
						}
					} else {

						//$path_info = pathinfo($filename);
						//$extensao =  $path_info['extension'];
						//$nome = uniqid().'.'.$extensao;
						$nome = ur($filename);

						$mv =  move_uploaded_file($file, '../assets/' . $campo . '/' . $nome);

						//if($campo == 'files'){
						$namefiles[uniqid()] = ur($filename);
						$nome = json_encode($namefiles);
						//}

						if ($mv) {
							$this->mysqli->query("UPDATE $table set $campo ='$nome' where $chave = '$pid' ");
						}
					}
				}
			}
		}


		if ($xx) {
			return "Registro Adicionado/Atualizado!";
		} else {
			return $this->mysqli->error;
		}
	}



	public function getRegistro($table, $chave, $id,  $pk = null)
	{
		$qk = '';

		if ($pk) {
			$qk = "  order by $pk desc ";
		}

		$result = $this->mysqli->query("SELECT * FROM $table WHERE  $chave='" . $id . "'   $qk");
		$row = $result->fetch_array();
		return $row;
	}


	public function countreg($table, $q = null)
	{
		$result = $this->mysqli->query("SELECT * FROM  $table $q");
		return mysqli_num_rows($result);
	}

	public function updateOrdem($table, $chave, $orden)
	{

		foreach ($orden as $itempos) {
			$psd =  explode(':', $itempos);
			$idchave = $psd[0];
			$pos = $psd[1];
			$res = $this->mysqli->query("UPDATE $table SET orden='$pos'  WHERE $chave = '$idchave' ");
		}
	}

	public function email($to, $assunto, $msg)
	{

		$from = 'noreply@terradamusica.com.br';
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8\n";
		$headers .= "From: Terra da Musica <$from>";
		$lay = '';
		$lay .= '<table  cellpadding="0" cellspacing="0" border="0" width="700px" style="color:#555;margin:0 auto;border-bottom:solid 2px #f39243; padding-bottom:12px"><tr><td style="background:#fff; height:54px;text-align:center"><img src="' . u . 'assets/imgs/logo_site.png" /></td>
</tr><tr><td  style="padding-top:20px;">' . $msg . '</td></tr></table>';

		$envia = mail($to, $assunto, $lay, $headers);


		if (($envia) == false) {
			$ret = "Ops! Ocorreu um erro!";
		} else {
			$ret = "Mensagem enviada";
		}
		return $ret;
	}

	public function statusPg($n)
	{
		if ($n == 1) {
			return '<span class="label label-primary label-mini">Pago (Agd. Autorização)</span>';
		}
		if ($n == 2) {
			return '<span class="label label-warning label-mini">Abandonado</span>';
		}
		if ($n == 3) {
			return '<span class="label label-info label-mini">Boleto Impresso</span>';
		}
		if ($n == 4) {
			return '<span class="label label-success label-mini">Confirmado</span>';
		}
		if ($n == 5) {
			return '<span class="label label-danger label-mini">Cancelado</span>';
		}
		if ($n == 6) {
			return '<span class="label label-info label-mini">Em Análise</span>';
		}
		if ($n == 7) {
			return '<span class="label label-info label-mini">Estornado</span>';
		}
		if ($n == '') {
			return '<span class="label label-info label-mini">Incompleto</span>';
		}
	}
}


$p = new hf();
