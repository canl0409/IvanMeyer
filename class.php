<?php

class gm extends Config
{

    public $invalid_numbers_accounts_ids = array();
    public $fixed_numbers = array();

    protected $mysqli;
    public $data;

    function __construct()
    {
        parent::__construct();
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

    public function countMatriculados($cursoId)
    {
        $result = $this->mysqli->query("SELECT COUNT(*)  as res FROM cursos_matriculas where cursoId = $cursoId");
        $r = $result->fetch_array();
        return $r['res'];
    }

    public function countOpnioes($cursoId)
    {
        $result = $this->mysqli->query("SELECT COUNT(*)  as res FROM opinioes where cursoId = $cursoId");
        $r = $result->fetch_array();
        return $r['res'];
    }

    public function countUser()
    {
        $result = $this->mysqli->query("SELECT COUNT(*) as res FROM alunos");
        $r = $result->fetch_array();
        return $r['res'];
    }

    public function countVideos()
    {
        $result = $this->mysqli->query("SELECT COUNT(*)  as res FROM aulas where video != '' ");
        $r = $result->fetch_array();
        return $r['res'];
    }

    public function countFiles($curso)
    {
        $countfiles = 0;
        $cs = $this->lista('aulas', " where cursoId = '$curso'");


        foreach ($cs as $cur) {
            if ($cur['files']) {
                $countfiles = count(explode(',', $cur['files'])) + $countfiles;
            }
        }

        return $countfiles;
    }

    public function isPage($page)
    {
        $page = str_replace('-', ' ', $page);

        $result = $this->mysqli->query("SELECT * FROM paginas WHERE titulo LIKE '%$page%'   ");

        if (mysqli_num_rows($result) == 1) {
            $r = $result->fetch_array();
            return $r;
        } else {
            return false;
        }
    }

    public function regAula($aula, $alunoId = null)
    {
        $alunoId = $alunoId ? $alunoId : $_SESSION['aluno'];

        $au = $this->getRegistro('aulas', 'aulaId', $aula);
        $cursoId = $au['cursoId'];

        $var = $this->mysqli->query("SELECT * FROM aulas_vistas WHERE aulaId='$aula' and alunoId='" . $alunoId . "'  ");

        if (mysqli_num_rows($var) == 0) { // aula ainda não foi foi vista
            $this->mysqli->query("INSERT INTO aulas_vistas set cursoId='$cursoId', alunoId='" . $alunoId . "' , aulaId='$aula', data = now()");
            if ($au['email'] == '1') {
                $aluno = $this->mysqli->query("SELECT * FROM alunos WHERE alunoId='$alunoId' LIMIT 1");
                $aluno = $aluno->fetch_object();

                if ($aluno) {
                    $this->email($aluno->email, $au['email_titulo'], $au['email_conteudo'], null, (array) $aluno);
                }
            }
        }
    }

    public function viwedAula($aula, $alunoId = null)
    {
        $aluno = null;
        if(isset($_SESSION['aluno'])){
          $aluno =  $_SESSION['aluno'];
        }

        if($alunoId){
          $aluno = $alunoId;
        }

        if(!$aluno){
          return false;
        }

        $var = $this->mysqli->query("SELECT * FROM aulas_vistas WHERE aulaId='$aula' and alunoId='" . $aluno . "'  ");
        if (mysqli_num_rows($var) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function cursoProgresso($cursoId, $alunoId = null)
    {
        $aluno = $alunoId ? $alunoId : $_SESSION['aluno'];
        $qav = $this->lista('aulas_vistas', " where cursoId='$cursoId' and alunoId = '" . $aluno . "' ");
        $countQav = count($qav);
        $qat = $this->lista('aulas', " where cursoId='$cursoId' ");
        $countQat = count($qat);

        return $countQat > 0 ? round(($countQav / $countQat) * 100) : 0;
    }

    public function isFreeUser($alunoId = null)
    {
        $aluno = $alunoId ? $alunoId : $_SESSION['aluno'];

        $vcm = $this->mysqli->query("SELECT * FROM assinaturas a
                                        left join planos p on p.planoId = a.planoId
                                        where vencimento > now() and p.valor = 0
                                        and  alunoId = " . $aluno);
        if (mysqli_num_rows($vcm) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function ehAssinante()
    {
        $vcm = $this->mysqli->query("SELECT * FROM assinaturas where  alunoId = '" . $_SESSION['aluno'] . "'  ");
        if (mysqli_num_rows($vcm) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function ehAssinanteAtivo($alunoId = null)
    {
        $aluno = $alunoId ? $alunoId : $_SESSION['aluno'];

        $vcm = $this->mysqli->query("SELECT * FROM assinaturas where vencimento > now() and  alunoId = " . $aluno);
        if (mysqli_num_rows($vcm) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function ehAssinanteExpirado($alunoId = null)
    {
        $aluno = $alunoId ? $alunoId : $_SESSION['aluno'];

        $vcm = $this->mysqli->query("SELECT * FROM assinaturas where vencimento < now() and  alunoId = " . $aluno);
        if (mysqli_num_rows($vcm) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function registraPagamento($paymentId, $alunoId, $buyerEmail, $ItemName, $ItemNumber, $ItemTotalPrice, $status = 1)
    {
        $data = date("Y-m-d H:i:s");

        return $insert_row = $this->mysqli->query("INSERT INTO pagamentos
					(email_consumidor,code,alunoId,produto,planoId, valor, data, status_pagamento)
					VALUES ('$buyerEmail','$paymentId','$alunoId','$ItemName','$ItemNumber', '$ItemTotalPrice', '$data', '$status')");
    }

    public function registraPagamentoCurso($paymentId, $alunoId, $buyerEmail, $produtoNome, $cursoId, $ItemTotalPrice, $status = 1)
    {
        $data = date("Y-m-d H:i:s");
        if ($cursoId == "") {
            $cursoId = 0;
        }

        $result = $this->mysqli->query("INSERT INTO pagamentos
					(email_consumidor,code,alunoId,produto,cursoId, valor, data, status_pagamento)
					VALUES ('$buyerEmail','$paymentId','$alunoId','$produtoNome','$cursoId', '$ItemTotalPrice', '$data', '$status')");
        return $result ? "Pagamento ok" : $this->mysqli->error;
    }

    public function matriculaCurso($alunoId, $cursoId, $sendEmail = true)
    {
        $data = date('Y-m-d H:i:s');
        $expiraTimeStamps = strtotime("+12 months", strtotime($data));
        $expira = date('Y-m-d', $expiraTimeStamps);

        $curso = $this->mysqli->query("SELECT * FROM cursos WHERE cursoId='$cursoId' LIMIT 1");
        $curso = $curso->fetch_object();

        $aluno = $this->mysqli->query("SELECT * FROM alunos WHERE alunoId='$alunoId' LIMIT 1");
        $aluno = $aluno->fetch_object();

        $insert_row = $this->mysqli->query("INSERT INTO cursos_matriculas (cursoId, alunoId, data, name, expira)
        VALUES ('$curso->cursoId','$aluno->alunoId','$data','$curso->titulo','$expira')");

        if ($insert_row) {
            if ($sendEmail) {
                $this->email($aluno->email, null, null, 'curso_matriculado', (array) $aluno);
            }
        } else {
            return false;
        }
    }

    public function confirmaPagamentoBd($paymentId)
    {
        return $this->mysqli->query("UPDATE pagamentos SET status_pagamento = 4 where code = '{$paymentId}'");
    }

    public function assinaPlano($planoId, $alunoId)
    {
        $plano = $this->mysqli->query("SELECT * FROM planos WHERE planoId='$planoId' LIMIT 1");
        $plano = $plano->fetch_object();

        $aluno = $this->mysqli->query("SELECT * FROM alunos WHERE alunoId='$alunoId' LIMIT 1");
        $aluno = $aluno->fetch_object();

        $mesesDuracao = $plano->meses_duracao < 1 ? 1 : $plano->meses_duracao;
        $dataInicio = date('Y-m-d H:i:s');
        $vencimento = date('Y-m-d H:i:s', strtotime("+" . $mesesDuracao . " month", strtotime($dataInicio)));

        $deleteOlders = $this->mysqli->query("DELETE from assinaturas where alunoId = {$aluno->alunoId}");
        $insert_row = $this->mysqli->query("INSERT INTO assinaturas (alunoId, planoId, data_inicio, vencimento)
		VALUES ('$aluno->alunoId','$plano->planoId','$dataInicio','$vencimento')");

        if ($insert_row) {
            $tipoEmail = $plano->valor > 0 ? 'assinatura_plano' : 'assinatura_plano_free';
            include_once "../../config.php";
            include_once "../../class.php";
            $gm = new gm();
            $gm->email($aluno->email, null, null, $tipoEmail, (array) $aluno);
        } else {
            die('Error : (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
    }

    public function validaCupom($codigoCupom)
    {
        $cupom = $this->getRegistro('cupons', 'codigo', $codigoCupom);

        if (!$cupom) {
            return "Cupom {$codigoCupom} não encontrado!";
        }

        $hoje = new DateTime(date('Y-m-d'));
        $vencimento = new DateTime('22-01-1990');
        $vencimento = $cupom['validade'] ? new DateTime(date('Y-m-d', strtotime($cupom['validade']))) : $vencimento;;

        if ($hoje > $vencimento) {
            return "Cupom {$codigoCupom} expirado em: " . $vencimento->format("d/m/Y");
        }

        return 1;
    }

    public function getMeusCursosAlunoAdm($alunoId = null)
    {

        $aluno = $alunoId;


        $cursosMatriculados = $this->listaQuery("SELECT c.*, cm.* FROM cursos_matriculas cm left join cursos c on (cm.cursoId = c.cursoId) where alunoId = " . $aluno);


        if ($this->isFreeUser($aluno)) {
            $cursosFree = $this->lista('cursos', " where plano_free = 1 and categoria_principal != '7' and cursoId in (" . $this->idCursosPlano($aluno) . ") ");

            return array_merge($cursosMatriculados, $cursosFree);
        } else if ($this->idCursosPlano($aluno) != false) {

            return $gc = $this->lista('cursos', " where plano_free = 0 and categoriaId not like '%6%' and categoria_principal != '7' and cursoId in (" . $this->idCursosPlano($aluno) . "  )  "); // categoria não pode ser EM Breve
        } else {
            $cursosMatriculados = $this->listaQuery("SELECT c.*, cm.* FROM
            cursos_matriculas cm left join cursos c on (cm.cursoId = c.cursoId) where alunoId = " . $aluno);
        }


        /*
        // $cursosMatriculados = $this->listaQuery("SELECT c.*, cm.* FROM
        //cursos_matriculas cm left join cursos c on (cm.cursoId = c.cursoId) where alunoId = " . $aluno);

        $cursosMatriculados = $this->listaQuery("SELECT c.*, cm.* FROM aulas_vistas cm left join cursos c on
          (cm.cursoId = c.cursoId) where alunoId = $aluno group by cm.cursoId");

*/
        return $cursosMatriculados;
    }


    public function acessoCursoOculto($curso){
     $user = $this->user();
     $cursosPermitidos = $this->listaQuery("SELECT  * FROM  cursos  
        where cursoId = '$curso' and  emails_vizualiza_em_breve LIKE '%$user->email%'");
     return (count($cursosPermitidos) == 1) ? true : false;
    }


    public function getMeusCursosAluno($alunoId = null)
    {

        $user = $this->user();

        $aluno = $alunoId ? $alunoId : $_SESSION['aluno'];

        $cursosMatriculados = $this->listaQuery("SELECT c.*, cm.* FROM cursos_matriculas cm left join cursos c on (cm.cursoId = c.cursoId) where alunoId = " . $aluno);

        $cursosPermitidos = $this->listaQuery("SELECT  * FROM  cursos c  
        where   c.emails_vizualiza_em_breve LIKE '%$user->email%'");
 
        $cursosMatriculados = array_merge($cursosMatriculados, $cursosPermitidos);


        if ($this->ehAssinanteAtivo($aluno)) {
            if ($this->isFreeUser($aluno)) {
                $cursosFree = $this->lista('cursos', " where plano_free = 1 and categoria_principal != '7' and cursoId in (" . $this->idCursosPlano($aluno) . ") ");

                return array_merge($cursosMatriculados, $cursosFree);
            } else {

                 $gc = $this->lista('cursos', " where plano_free = 0 and categoriaId not like '%6%' and categoria_principal != '7' and cursoId in (" . $this->idCursosPlano($aluno) . "  )  ");
                 // categoria não pode ser EM Breve
                return array_merge($cursosMatriculados, $gc);
            }
        }
        return $cursosMatriculados;
    }


    public function idCursosPlano($aluno = null)
    {
        $result = $this->lista("assinaturas", " where  alunoId = '" . $aluno . "'  ");
        if (count($result) == 0) {
            return false;
        }
        $planoId = $result[0]['planoId'];

        $plano = $this->getRegistro('planos', 'planoId', $planoId);

        return  $plano['cursos'];
    }

    public function plano($nome = false)
    {
        $result = $this->lista("assinaturas", " where  alunoId = '" . $_SESSION['aluno'] . "'  ");

        if (count($result) > 0) { // tem assinatura
            $assinatura = $result['0'];
            $plano = $this->getRegistro('planos', 'planoId', $assinatura['planoId']);

            if ($nome) {
                return $plano['nome'];
            }

            $hoje = new DateTime(date('Y-m-d'));
            $vencimento = new DateTime('22-01-1990');
            $vencimento = $assinatura['vencimento'] ? new DateTime(date('Y-m-d', strtotime($assinatura['vencimento']))) : $vencimento;;
            $status = $assinatura['status'];
            $classStatus = "label-warning";

            if ($assinatura['vencimento']) {
                if ($hoje > $vencimento) {
                    $status = "expirado";
                    $classStatus = "label-danger";
                } else {
                    $status = "ativo";
                    $classStatus = "label-success";
                }
            } else {
                $status = "Nenhum";
                $labelVencimento = "";
            }

            return "Seu plano: <b>" . $plano['nome'] .
                "</b><br>Plano expira em: <b>" . $vencimento->format("d/m/Y") . "</b>" .
                "</b><br>Status: <b><span class='label " . $classStatus . "'>" . $status . "</span></b>";
        } else {
            return "Você não tem assinatura";
        }
    }

    public function vencimento($cursoId = null, $plano = null, $alunoId = null)
    {
        $aluno = $alunoId ? $alunoId : $_SESSION['aluno'];

        $gc = $this->lista('cursos_matriculas', " where cursoId='$cursoId' and alunoId = '" . $aluno . "' ");

        if(count($gc) == 0){
            $ga = $this->lista('assinaturas', " where alunoId = '" . $aluno . "' ");
            $pl = $this->getRegistro('planos', 'planoId', $ga[0]['planoId']);
            if ($pl['nome'] && $pl['planoId'] != 1) {
                return "Seu plano: <b>$pl[nome]</b><br>Vencimento: <b>" . data($ga[0]['vencimento']) . "</b>";
            }
        }
        

        if (!$gc or $gc[0]['expira'] == '' or $plano == 1) {
            if ($cursoId == null) {
                if ($pl['nome']) {
                    return "Seu plano: <b>$pl[nome]</b><br>Vencimento: <b>" . data($ga[0]['vencimento']) . "</b>";
                }
            }

            if ($ga && $ga[0]['vencimento']) {
                return 'Plano expira em: ' . data($ga[0]['vencimento']);
            }
        } else {
            $hoje = strtotime(date('Y-m-d'));
            $vencimento = $gc[0]['expira'] ? strtotime($gc[0]['expira']) : "";
            $classStatus = "label-warning";
            $expirado = false;

            if ($gc[0]['expira']) {
                $labelVencimento = date('d/m/Y', strtotime($gc[0]['expira']));
                if ($hoje > $vencimento) {
                    $expirado = true;
                    $status = "expirado";
                    $classStatus = "label-danger";
                } else {
                    $status = "ativo";
                    $classStatus = "label-success";
                }
            } else {
                $status = "Nenhum";
                $labelVencimento = "";
            }

            if ($expirado) {
                return "</b>Curso expira em: <b>" . $labelVencimento . "</b>" .
                    " <span class='label " . $classStatus . "'>" . $status . "</span>";
            }
            return 'Curso expira em: ' . $labelVencimento;
        }
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

    public function listaQuery($query)
    {
        $row = array();
        $result = $this->mysqli->query($query);
        if ($result) {
            while ($rows = $result->fetch_array()) {
                $row[] = $rows;
            }
        }

        return $row;
    }

    public function obj($table, $chave = null, $id = null, $limit = null, $in = null)
    {
        $rows = array();
        $row = array();
        $aq = '';
        $aql = '';

        if ($limit != null) {
            $aql = " LIMIT $limit ";
        }

        if (($chave != null) && ($id != null)) {
            $aq = " WHERE  $chave='" . $id . "' ";
        }

        if (($chave != null) && ($id != null) && ($in != null)) {
            $aq = " WHERE find_in_set( $id ,$chave) <> 0    ";
        }

        $result = $this->mysqli->query("SELECT * FROM $table $aq $aql  "); //return "SELECT * FROM {$table} {$aq} {$aql}";

        if ($limit == 1) {
            $row = $result->fetch_array();
            return (object) $row;
        }

        while ($rowsl = $result->fetch_array()) {
            $rows[] = $rowsl;
        }


        return (object) $rows;
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


    public function getConfig($c)
    {
        $result = $this->mysqli->query("SELECT * FROM config WHERE configId='$c'");
        $r = $result->fetch_array();
        return $r['valor'];
    }

    public function del($table, $chave, $id, $protect = NULL)
    {
        $q = null;
        if ($protect) {
            $q = "  and  $protect = '" . $_SESSION['radmin'] . "' ";
        }

        $xx = $this->mysqli->query("DELETE FROM $table  WHERE $chave = '$id' $q ");
    }

    public function updateRegistro($dados, $table, $chave, $protect = NULL)
    {
        $qp = null;

        if ($protect) {
            $qp = "  and  $protect = '" . $_SESSION['radmin'] . "' ";
        }

        $esc = array('produtoId', 'upid', '_wysihtml5_mode', 'Id', 'multi');
        $data = null;

        foreach ($dados as $key => $value) {
            if (!in_array($key, $esc)) {
                $data .= "$key = '" . $value . "',";
            }
        }

        $data = substr($data, 0, strlen($data) - 1);

        $xx = $this->mysqli->query("UPDATE $table set  $data  WHERE $chave = '$dados[upid]'    ");
        if ($xx) {
            return "Registro atualizado!";
        } else {
            return "Erro";
        }
    }


    public function addRegistro($dados, $table)
    {
        $esc = array('upid', '_wysihtml5_mode', 'preco');
        $data = null;
        foreach ($dados as $key => $value) {
            if (!in_array($key, $esc)) {
                $data .= "$key = '" . $value . "',";
            }
        }

        $data = substr($data, 0, strlen($data) - 1); //echo "INSERT INTO $table set  $data "; die;
        $xx = $this->mysqli->query("INSERT INTO $table set  $data    ");
        if ($xx) {
            return "Registro Adicionado!";
        } else {
            return "Erro";
        }
    }

    public function getRegistro($table, $chave, $id, $like = null)
    {
        $q = '';
        if ($like) {
            $result = $this->mysqli->query("SELECT * FROM $table WHERE  $chave  LIKE '" . $id . "'   ");
        } else {
            $result = $this->mysqli->query("SELECT * FROM $table WHERE  $chave='" . $id . "' $q ");
        }

        $row = $result->fetch_array();

        return $row;
    }

    public function email($to, $assunto, $msg, $tipo, $dados = null)
    {
        $smc = $this->getRegistro('email_config', 'emailcId', 1);
        $smc = json_decode($smc['config'], 1);

        if (isset($dados['nome'])) {
            $msg = str_replace('#aluno#', $dados['nome'], $msg);
        }

        if ($tipo) {
            $mailcfg = $this->getRegistro('email_config', 'tipo', $tipo);
            $assunto = $mailcfg['assunto'];
            $msg = $mailcfg['config'];
            $msg = str_replace('#aluno#', $dados['nome'], $msg);

            $msg = str_replace('#cod_validacao#', $dados['email_confirmed'], $msg);

            if ($tipo == 'esqueci_senha') {
                $msg = str_replace('#nova_senha#', $dados['nova_senha'], $msg);
            }

            if ($tipo == 'assinatura_plano' || $tipo == 'assinatura_plano_free') {
                $query = "SELECT p.* FROM assinaturas a
				left join alunos al on (a.alunoId = al.alunoId)
				left join planos p on  (a.planoId = p.planoId)
				where al.email = '" . $dados['email'] . "'
				order by assinaturaId desc limit 1;";

                $result = $this->mysqli->query($query);
                $plano = $result->fetch_object();

                if ($plano) {
                    $msg = str_replace('#plano#', $plano->nome, $msg);
                }
            }

            if (($tipo == 'assinatura_expirada' || $tipo == 'assinatura_expirada_free') && isset($dados['assinatura_expirada_id'])) {
                $idAssinatura = $dados['assinatura_expirada_id'];

                $query = "SELECT * FROM assinaturas a
				left join planos p on  (a.planoId = p.planoId)
				where a.assinaturaId = " . $idAssinatura;

                $result = $this->mysqli->query($query);
                $result = $result->fetch_object();

                if ($result) {
                    $msg = str_replace('#plano#', $result->nome, $msg);
                    $msg = str_replace('#data_vencimento#', date('d/m/Y', strtotime($result->vencimento)), $msg);
                }
            }

            if ($tipo == 'curso_expirado' && isset($dados['cursoId']) && isset($dados['data_expiracao'])) {
                $curso = $this->mysqli->query("SELECT * FROM cursos where cursoId = " . $dados['cursoId']);
                $curso = $curso->fetch_object();

                if ($curso) {
                    $msg = str_replace('#curso#', $curso->titulo, $msg);
                    $msg = str_replace('#data_expiracao#', $dados['data_expiracao'], $msg);
                }
            }

            if ($tipo == 'curso_matriculado') {
                $query = "SELECT c.* FROM cursos_matriculas cm
				left join alunos al on (cm.alunoId = al.alunoId)
				left join cursos c on  (cm.cursoId = c.cursoId)
				where al.email = '" . $dados['email'] . "'
				order by cmId desc limit 1;";

                $result = $this->mysqli->query($query);
                $curso = $result->fetch_object();

                if ($curso) {
                    $msg = str_replace('#curso#', $curso->titulo, $msg);
                }
            }
        }

        include("helper/src/SMTP.php");
        include("helper/src/PHPMailer.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = $smc['host'];
        $mail->Port = $smc['porta'];
        $mail->SMTPSecure = $smc['ssl'];
        $mail->SMTPDebug = false;
        $mail->SMTPAuth = true;
        $mail->Username = $smc['usuario'];
        $mail->Password = $smc['senha'];

        //$mail->setFrom(email_remetente, site_nome);
        $mail->setFrom("contato@terradamusica.com.br", "Terra da Música");

        //$mail->SMTPDebug = 2;
        $mail->AddAddress($to, isset($dados['nome']) ? $dados['nome'] : null);
        $mail->AddBCC('junior@idera.com.br');
        $mail->AddBCC('contato@terradamusica.com.br');
        $mail->IsHTML(true);
        $mail->Subject = $assunto;

        $siteUrl = "www.terradamusica.com.br";
        $lay = '';
        $lay .= '<table  cellpadding="0" cellspacing="0" border="0" width="700px" style="color:#555;margin:0 auto;"><tr><td style="background:#ddd; height:54px;text-align:center;padding-bottom: 20px"><img src="' . u . 'assets/imgs/logo2.png"/></td>
		</tr><tr><td  style="padding:20px;">' . $msg . '</td></tr><tr><td style="background:#ddd;color:#999; height:44px;text-align:center">' . $siteUrl . '</td>
		</tr></table>';

        $mail->Body = $lay;
        $mail->CharSet = "utf-8";

        $mail->AltBody = "";
        $enviado = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        if ($enviado) {
            $er = "E-mail enviado com sucesso !!";
            $envia = true;
        } else {
            $envia = false;
            $er = "N&#227;o foi possível enviar o e-mail.<br /><br />";
            $er .= "<b>Informa&#231;&#245;es do erro:</b> <br />" . $mail->ErrorInfo;
        }

        return $er;
    }


    public function makeSignature($alunoId, $plano, $vencimento)
    {

        $result = $this->mysqli->query("SELECT * FROM assinaturas WHERE alunoId='$alunoId' and planoId='$plano'   ");
        if (mysqli_num_rows($result) == 0) {
            $this->mysqli->query("INSERT INTO assinaturas set   alunoId='$alunoId', planoId='$plano', vencimento='$vencimento' ");
            return 1;
        } else {
            return "Não é possivel se inscrever no plano grátis novamente, contrate outro plano <a href='" . u . "#services'>clicando aqui</a>";
        }
    }

    public function checkout($r)
    {
        $ret = array();

        $code = uniqid();

        if ($r['tipo'] == 'curso') {
            $q = " cursoId='" . $r['checkout'] . "' ";
            $dp = $this->getRegistro('cursos', 'cursoId', $r['checkout']);
            $cvalor = $dp['valor'];
            $produto = $dp['titulo'];
        } else {
            $q = " planoId='" . $r['checkout'] . "' ";
            $dp = $this->getRegistro('planos', 'planoId', $r['checkout']);
            $cvalor = $dp['valor'];
            $produto = "Plano " . $dp['nome'];

            if ($dp['valor'] == 0) {

                $this->mysqli->query("INSERT INTO pagamentos set code='$code', alunoId='" . $_SESSION['aluno'] . "', $q , produto='$produto', data = now(), status_pagamento='4', valor='$cvalor' ");

                $vencimento = time();
                $vencimento = date('Y-m-d H:i:s', strtotime('+30 day', $vencimento));


                $sigret = $this->makeSignature($_SESSION['aluno'], $dp['planoId'], $vencimento);
                $ret['sigmsg'] = $sigret;
                $ret['res'] = 'free';
                return $ret;
            }
        }


        $result = $this->mysqli->query("INSERT INTO pagamentos set code='$code', alunoId='" . $_SESSION['aluno'] . "', $q , produto='$produto', data = now(), valor='$cvalor' ");

        //echo "INSERT INTO pagamentos set code='$code', alunoId='".$_SESSION['aluno']."', $q , produto='$produto', data = now(), valor='$cvalor' "; die;

        $pid = mysqli_insert_id($this->mysqli);

        if (!$result) {
            $ret['res'] = 'erro';
            return $ret;
        } else {
            $ret['res'] = '<input type="hidden" name="id_carteira" value="contato@terradamusica.com.br">
<input type="hidden" name="nome" value="' . $produto . '"><br />
<input type="hidden" name="valor" value="' . str_replace('.', '', $cvalor) . '">
<input type="hidden" name="id_transacao" value="' . $code . '">';
            return $ret;
        }
    }

    public function statusPay($r)
    {

        $forma_pagamento = isset($r['forma_pagamento']) ? $r['forma_pagamento'] : 0;
        $status_pagamento = isset($r['status_pagamento']) ? $r['status_pagamento'] : 0;


        $result = $this->mysqli->query("SELECT * FROM pagamentos where code = '" . $r['id_transacao'] . "' ");
        if (mysqli_num_rows($result) >= 1) {
            $b = $result->fetch_array();

            if (str_replace('.', '', $b['valor']) == $r['valor']) {
                $this->mysqli->query("UPDATE pagamentos set
                email_consumidor='" . $r['email_consumidor'] . "',
                cod_moip='" . $r['cod_moip'] . "',
                tipo_pagamento='" . $r['tipo_pagamento'] . "',
                forma_pagamento='$forma_pagamento',
                status_pagamento='$status_pagamento'

                where code = '" . $r['id_transacao'] . "' ");

                //$this->updateMatriculas();

            } else {
                $this->mysqli->query("UPDATE pagamentos set
                email_consumidor='" . $r['email_consumidor'] . "',
                valor_error='" . $r['valor'] . "',
                cod_moip='" . $r['cod_moip'] . "',
                tipo_pagamento='" . $r['tipo_pagamento'] . "',
                forma_pagamento='$forma_pagamento',
                status_pagamento='$status_pagamento',
                log='Fraude'
                where code = '" . $r['id_transacao'] . "' ");
            }
        }
    }
}

$gm = new gm();
