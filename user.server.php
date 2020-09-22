<?php
require_once("blog/wp-includes/class-phpass.php");
class user extends Config {

	public $invalid_numbers_accounts_ids = array();
	public $fixed_numbers = array();

	protected $mysqli;
	public $data;
	function __construct() {
		parent::__construct();
	}


	public function esqueci($req) { 
		$vcm = $this->mysqli->query("SELECT * FROM alunos WHERE email='$req'  ");
		if (mysqli_num_rows($vcm) == 0) {
			return 'Este e-mail não esta cadastrado conosco.';
		} else {
			$dados = $vcm->fetch_array();
			$dados['nova_senha'] = 
			$nsenha = 'P' . uniqid();
			$dados['nova_senha'] = $nsenha ;
			$this->mysqli->query("UPDATE alunos set senha='" . $nsenha . "' WHERE email='$req'  ");
			include_once('class.php');
			$gm = new gm();
			//$gm::email($req, 'Nova senha - '.site_nome, 'Sua nova senha é: ' . $nsenha, null, null);
			$gm::email($dados['email'],null, null, 'esqueci_senha',$dados);
			return 'Uma nova senha foi enviada para seu e-mail.';
		}
	}

	public function login($var) {
		$result = $this->mysqli->query("SELECT * FROM alunos WHERE email='" . $var['lemail'] . "' and senha ='" . $var['lsenha'] . "' LIMIT 1");
		if (mysqli_num_rows($result) == 1) {
			$r = $result->fetch_array();
			$diff = strtotime(date('Y-m-d H:i:s')) - strtotime($r['ping']);
      /*
			 if($diff < 60){
          $re['status'] = 0;
          $re['msg'] = "Você parece estar logado em outro dispositivo, deslogue dos outros dispositivos e tente novamente em alguns segundos!";
          return json_encode($re);
          die;
			 }
      */
			$_SESSION['aluno'] = $r['alunoId'];
			$_SESSION['nome'] =  $r['nome'];
			$re['status'] = 1;
			$re['redirect'] = $_SESSION['redirect'];
			$_SESSION['session'] = $this->updateSession();

			return json_encode($re);
		} else {
      $result = $this->mysqli->query("SELECT * FROM alunos WHERE email='" . $var['lemail'] . "' LIMIT 1");
      
        if(mysqli_num_rows($result) == 1) {
          $r = $result->fetch_array();
          $stored_hash = $r['senha'];
          
          $hash = new PasswordHash( 8, true ); // criptografia do WordPress
          $check = $hash->CheckPassword( $var['lsenha'], $stored_hash); // Comparar as senhas
          
          if($check == true){ 
            $_SESSION['aluno'] = $r['alunoId'];
            $_SESSION['nome'] =  $r['nome'];
            $re['status'] = 1;
            $re['redirect'] = $_SESSION['redirect'];
            $_SESSION['session'] = $this->updateSession();
            return json_encode($re);
          }
        }
      
			$re['msg'] = "Dados incorretos";
			return json_encode($re);
		}
	}

	public function user($uid=null) {
		if($uid){
         return (object)$this->getRegistro('alunos','alunoId',$uid);
		}

		if(isset($_SESSION['aluno'])){
			return (object)$this->getRegistro('alunos','alunoId',$_SESSION['aluno']);
		}else{
			return false;
		}
	}

	public function planoAluno(){
		if($this->user()){
			$result = $this->mysqli->query("SELECT * FROM assinaturas left join planos ON assinaturas.planoId = planos.planoId  WHERE assinaturas.alunoId= '" . $_SESSION['aluno'] . "'");
			return (object)$result->fetch_array();
		}
	}




    public function isSignExpired(){

    }

    public function isEnrolled($curso){
		$res1 = $this->mysqli->query("SELECT * FROM cursos_matriculas   WHERE cursoId='$curso' and alunoId= '" . $_SESSION['aluno'] . "'");
			if (mysqli_num_rows($res1) == 1) {
               return true;
			}else{
			   return false;	
			}
    }

    public function isCursoExpired($curso){
		$res1 = $this->mysqli->query("SELECT * FROM cursos_matriculas   WHERE cursoId='$curso' and alunoId= '" . $_SESSION['aluno'] . "'");
			if (mysqli_num_rows($res1) == 1) {
				$dc = $res1->fetch_array();
				if($dc['expira']){
                 if($dc['expira'] < date('Y-m-d')){
              		return true;
                 }else{
                 	return false;
                 }
				}
		 	}
    }

	public function accessPermission($curso){
		$ret = array();
		if($this->user()){

			//se plano / se plano free ou se plano pago

			//se curso avulso
			$res1 = $this->mysqli->query("SELECT * FROM assinaturas left join planos ON assinaturas.planoId = planos.planoId  WHERE assinaturas.alunoId= '" . $_SESSION['aluno'] . "'");





			if (mysqli_num_rows($res1) == 1) {
               $sig = $res1->fetch_array();

               if(strtotime(date('Y-m-d H:i:s')) > strtotime($sig['vencimento'])){ 
                 $ret['ret'] = false;
                 $ret['reason'] = 'expired';
                 return $ret;
               }
               
                if($this->isEnrolled($curso)){
                 $ret['ret'] = true;
                 $ret['reason'] = 'enrolled';
                 return $ret;
               }


               if($sig['planoId'] == 1){
                   $res2 = $this->mysqli->query("SELECT * FROM cursos  WHERE cursoId= '" . $curso. "'");
                   $cs = $res2->fetch_array(); 
	                   if($cs['plano_free'] == 1){
		                 $ret['ret'] = true;
		                 $ret['reason'] = '';
		                 return $ret;
	                   }else{
	                   	 $ret['ret'] = false;
		                 $ret['reason'] = 'Para acessar as aulas, é necessário comprar este curso ou um plano!';
		                 return $ret;
	                   }
               }else{

               }
			}else{
				if($this->isEnrolled($curso)){

					if($this->isCursoExpired($curso)){
						$ret['ret'] = false;
						$ret['reason'] = 'Sua matrícula, nesse curso venceu. Agora você tem acesso apenas à aulas free.';
						return $ret;
					}else{
						$ret['ret'] = true;
						$ret['reason'] = 'enrolled';
						return $ret;
					}

				}
			}
            

            $res3 = $this->mysqli->query("SELECT * FROM pagamentos  WHERE cursoId= '$curso' and alunoId= '" . $_SESSION['aluno'] . "' and (status_pagamento = '1' or status_pagamento = '4')");

	       if(mysqli_num_rows($res3) >= 1){
             $ret['ret'] = true;
             $ret['reason'] = '';
             return $ret;
           }

			
		}
	}


    public function courseButton($curso){
      if(!$this->user()){
        return '<button rel="'.$curso.'" class="button purchase-button thim-enroll-course-button buy-course">COMPRAR CURSO</button>  <a href="'.u.'#services">  <button rel="2" class="button  thim-enroll-course-button ">ASSINAR PLANO</button></a>';
      }else{
         $mp = $this->accessPermission($curso);
          
         if($mp['reason'] == 'expired'){
          return '<button rel="'.$curso.'" class="button purchase-button thim-enroll-course-button renew-course">RENOVAR</button>';
         }

         if($this->isEnrolled($curso)){
          return '<button rel="'.$curso.'" class="button purchase-button thim-enroll-course-button access-course">ACESSAR</button>';
         }
 
         if($mp['ret'] == true){
          return '<button rel="'.$curso.'" class="button purchase-button thim-enroll-course-button enroll-course">MATRICULAR</button>';
         }
         if($mp['ret'] == false){
          return '<button rel="'.$curso.'" class="button purchase-button thim-enroll-course-button buy-course">COMPRAR CURSO</button>  <a href="'.u.'#services">  <button rel="2" class="button  thim-enroll-course-button ">ASSINAR PLANO</button></a>';
         }
      }
    }


	public function matricular($curso){
     	if($this->user()){
          if(!$this->isEnrolled($curso)){
          	 $mp = $this->accessPermission($curso);
          	 if($mp['ret'] == true){
          	 	 $this->mysqli->query("INSERT INTO cursos_matriculas  set cursoId='$curso', alunoId= '" . $_SESSION['aluno'] . "'");
          	 }
          }
     	}
	}

	public function isloged_old(){
		if(!$this->user()){    header('Location:login');  die;}
	}

	public function isloged(){
		if($this->user()){ return true;}else{return false;}
	}

	public function sair($noredir=null) {
		session_destroy();
		session_unset();

		unset($_COOKIE['aluno']);
		unset($_SESSION['aluno']);
		unset($_SESSION['aluno']);
		unset($_SESSION['session']);

		setcookie('aluno', '000');
		if(!$noredir){
         header('Location: /');
		}
		
	}


	public function getRegistro($table, $chave, $id, $protect = NULL) {
		$q = '';
		if ($protect) {
			$q = "  and  $protect = '" . $_SESSION['radmin'] . "' ";
		} 

		$result = $this->mysqli->query("SELECT * FROM $table WHERE  $chave='" . $id . "' $q ");
		$row = $result->fetch_array();
		return $row;
	}


   public function novaOpiniao($dados){
    if($this->countreg('opinioes',' WHERE cursoId = "'.$dados['cursoId'].'" and alunoId = "'.$_SESSION['aluno'].'" ') > 0){
       return "Obrigado! Você já opinou neste curso!";
     }else{
       $this->mysqli->query("INSERT INTO opinioes set alunoId='".$_SESSION['aluno']."', cursoId='$dados[cursoId]', opiniao='$dados[opiniao]', nota='$dados[nota]' ");
        return "Obrigado! opinião recebida!";
     }
   }


	public function newsletter($d){
		if($this->countreg('newsletter',' WHERE email = "'.$d['EMAIL'].'"  ') > 0){
			return "Obrigado! Você já é cadastrado!";
			}else{
			$this->mysqli->query("INSERT INTO newsletter set  email='$d[EMAIL]' ");
			return "Obrigado! seu cadastro em nossa newsletter foi realizado!";
		}
	}


	public function updatePing(){
		if($this->isloged()){
           $ping = date('Y-m-d H:i:s');
           $ip = $_SERVER['REMOTE_ADDR'];
           $this->mysqli->query("UPDATE alunos set ping = '$ping' , ip ='$ip' WHERE alunoId='".$_SESSION['aluno']."' ");
		}
	}



	public function updateSession(){
		if($this->isloged()){
           $session = md5(uniqid(rand(), true));
           $this->mysqli->query("UPDATE alunos set session = '$session'   WHERE alunoId='".$_SESSION['aluno']."' ");
           return $session;
		}
	}
   

   public function vfsession(){
   

   		$result = $this->mysqli->query("SELECT * FROM alunos WHERE  session = '".$_SESSION['session']."' and  alunoId='".$_SESSION['aluno']."'   ");
		if (mysqli_num_rows($result) == 0) {
		  $this->sair(1);
          return 0;
		}

		return 1;
   }

    public function updateUserpgto($dados){

    	$ret = array('.','-');
		$dados['pagador_cpf'] = str_replace($ret,'',$dados['pagador_cpf']);

		if(!$this->valida_cpf($dados['pagador_cpf'])){
			return 'CPF Inválido';
		}

		if($this->countreg('alunos',' WHERE cpf = "'.$dados['pagador_cpf'].'" and alunoId != "'.$_SESSION['aluno'].'" ') > 0){
			return 'CPF já esta cadastrado para outro aluno';
		}

		if($this->countreg('alunos',' WHERE email = "'.$dados['pagador_email'].'" and alunoId != "'.$_SESSION['aluno'].'" ') > 0){
		return 'email ja cadastrado';
		}

        $this->mysqli->query("UPDATE alunos set  

		nome='".$dados['pagador_nome']."',
		cpf='".$dados['pagador_cpf']."',
		cidade='".$dados['pagador_cidade']."',
		uf='".$dados['pagador_estado']."',
		endereco='".$dados['pagador_logradouro']."',
		bairro='".$dados['pagador_bairro']."',
		cep='".$dados['pagador_cep']."',
		celular='".$dados['pagador_telefone']."' 

         where alunoId = '".$_SESSION['aluno']."'  ");

        return 0 ;

    }

	public function newuser($dados, $update = null) {  
		$esc = array('upid', '_wysihtml5_mode', 'preco','senha2','updateuser');
		$data = null;


		$ret = array('.','-');
		$dados['cpf'] = str_replace($ret,'',$dados['cpf']);

		if(!$this->valida_cpf($dados['cpf'])){
			return 'CPF Inválido';
		}



		if(!$update){
			if($this->countreg('alunos',' WHERE cpf = "'.$dados['cpf'].'" ') > 0){
				return 'CPF já esta cadastrado';
			}

			if($this->countreg('alunos',' WHERE email = "'.$dados['email'].'" ') > 0){
				return 'email ja cadastrado';
			}
		}

       if($dados['senha']){
		if( $dados['senha'] != $dados['senha2']){
			return 'Senhas diferentes';
		}
       }

		$containsLetter  = preg_match('/[a-zA-Z]/',    $dados['senha']);
		$containsDigit   = preg_match('/\d/',          $dados['senha']);

		if($dados['senha']){
		if($containsDigit == false or $containsLetter == false or strlen($dados['senha']) < 8 ){
			return 'Sua senha precisa conter letras e números, e ter mais de 8 caracteres';
		}
		}else{
			array_push($esc, "senha");
		}

		if(!$update){
        $dados['data_cadastro'] = date('Y-m-d');
        }

		foreach ($dados as $key => $value) {
			if (!in_array($key, $esc)) {
				$data .= "$key = '" . $value . "',";
			}
			if ($key == 'preco') {
				$data .= "preco = '" . str_replace(',', '.', $value) . "',";
			}
		}

		$data = substr($data, 0, strlen($data) - 1); 
		if($update){
			$xx = $this->mysqli->query("UPDATE alunos set  $data  where alunoId = '".$_SESSION['aluno']."'  ");
		}else{
      $data2 = "
         user_login = '".$dados['nome']."',
         display_name = '".$dados['nome']."',
         user_pass = '".md5($dados['senha'])."',
         user_nicename = '".$dados['nome']."',
         user_email = '".$dados['email']."',
         user_registered = '".$dados['data_cadastro']."',
         provider = '',
         identifier = ''
      ";
      
      $bdForum = new mysqli("localhost", "root", "02r0d9rmv4uyZx", "wp_forum");
      $bdBlog = new mysqli("localhost", "root", "02r0d9rmv4uyZx", "wp_blog");
      
      $xx = $this->mysqli->query("INSERT INTO alunos set  $data    ");	//echo "INSERT INTO alunos set  $data    ";
      $xx1 = $bdForum->query("INSERT INTO wptm_users set  $data2");
      $xx2 = $bdBlog->query("INSERT INTO wptm_users set  $data2");
      
      //return json_encode($bdForum->error_list);
      
			include_once('class.php');
			$gm = new gm();
			$gm::email($dados['email'],null, null, 'cadastro',$dados);
		}

		if ($xx && $xx1 && $xx2) {return 1;} else {return 'Erro ao inserir dados no banco de dados.';}
	}

    
     public function countreg($table, $where = null) {
 		if($where){$w = $where; }else{$w = '';}
		$result = $this->mysqli->query("SELECT * FROM  $table $w ");
		return mysqli_num_rows($result);
	} 

	public function email($to, $assunto, $msg) { 
		$from = email_remetente;
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8\n";
		$headers .= "From: ".site_nome." <".email_remetente.">";
		$lay = '';
		$lay .= '<table  cellpadding="0" cellspacing="0" border="0" width="700px" style="color:#555;margin:0 auto;border-bottom:solid 2px #f39243; padding-bottom:12px"><tr><td style="background:#fff; height:54px;text-align:center"><img src="'.u.'/imgs/logo.png" /></td>
	</tr><tr><td  style="padding-top:20px;">' . $msg . '</td></tr></table>';

	$envia = mail($to, $assunto, $lay, $headers);


	if (($envia) == false) {
		$ret = "Ops! Ocorreu um erro!";
	} else {
		$ret = "Mensagem enviada";
	}
	return $ret;
}



public function valida_cpf( $cpf = false ) {

/**
*  
*
* @param  
* @param  
* @param  
* @return  
*
*/
$ret = array('.','-');
$cpf = str_replace($ret,'',$cpf);

if ( ! function_exists('calc_digitos_posicoes') ) {
	function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
		for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
			$soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );
			$posicoes--;
		}

		$soma_digitos = $soma_digitos % 11;

		if ( $soma_digitos < 2 ) {
			$soma_digitos = 0;
		} else {
			$soma_digitos = 11 - $soma_digitos;
		}

		$cpf = $digitos . $soma_digitos;

		return $cpf;
	}
}

if ( ! $cpf ) {
	return false;
}

$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
if ( strlen( $cpf ) != 11 ) {
	return false;
}   

$digitos = substr($cpf, 0, 9);
$novo_cpf = calc_digitos_posicoes( $digitos );
$novo_cpf = calc_digitos_posicoes( $novo_cpf, 11 );
if ( $novo_cpf === $cpf ) {
	return true;
} else {
	return false;
}
}

}



$user = new user();

?>