<?php
include_once "../config.php";

class Export extends Config
{
    protected $mysqli;

    public function __construct()
    {
        parent::__construct();
    }

    public function exportAV()
    {
        $columns = [
            'Email',
            'Nome',
            'Sobrenome',
            'Plano',
           'Curso',
            'Aula',
           // 'Plano Semestral',
           // 'Plano Gratuito',
            'Data Acesso',
        ];

        $data = [];

        $this->mysqli->set_charset("utf8");
        $alunos = $this->mysqli->query("
SELECT 
     alunos.alunoId, alunos.nome, alunos.sobrenome, alunos.email,
    planos.nome as Plano,
    cursos.titulo as Curso,
    aulas.titulo as Aula,
    aulas_vistas.data as DataAcesso
FROM alunos
  
    left join aulas_vistas on alunos.alunoId = aulas_vistas.alunoId
    left join cursos on  aulas_vistas.cursoId = cursos.cursoId
    left join aulas on aulas.aulaId = aulas_vistas.aulaId
    left join assinaturas  on assinaturas.alunoId = alunos.alunoId
    left join planos on assinaturas.planoId = planos.planoId
 
");
        //$alunos = $alunos->fetch_assoc();



       while ($aluno = $alunos->fetch_assoc()) {
 

/*
            $planoAnual = $this->mysqli->query("select assinaturas.data_inicio from assinaturas inner join planos on (assinaturas.planoId = planos.planoId) where assinaturas.vencimento >= now() and alunoId = {$aluno['alunoId']} and assinaturas.planoId = 4");
            $planoAnual = $planoAnual ? $planoAnual->fetch_object() : false;
            $planoAnual = $planoAnual ? $planoAnual->data_inicio : "";

            $planoSemestral = $this->mysqli->query("select assinaturas.data_inicio from assinaturas inner join planos on (assinaturas.planoId = planos.planoId) where assinaturas.vencimento >= now() and alunoId = {$aluno['alunoId']} and assinaturas.planoId = 3");
            $planoSemestral = $planoSemestral ? $planoSemestral->fetch_object() : false;
            $planoSemestral = $planoSemestral ? $planoSemestral->data_inicio : "";

            $planoGratuito = $this->mysqli->query("select assinaturas.data_inicio from assinaturas inner join planos on (assinaturas.planoId = planos.planoId) where assinaturas.vencimento >= now() and alunoId = {$aluno['alunoId']} and assinaturas.planoId = 1");
            $planoGratuito = $planoGratuito ? $planoGratuito->fetch_object() : false;
            $planoGratuito = $planoGratuito ? $planoGratuito->data_inicio : "";

            SELECT  concat( 
titulo ,' ', ROUND((
(select count(*) from aulas_vistas avs where avs.cursoId = c.cursoId and avs.alunoId = 4) /
(select count(*) from aulas al where al.cursoId = c.cursoId  )) * 100) pct
) asd
FROM aulas_vistas auv
inner join cursos c on (auv.cursoId = c.cursoId) 
where alunoId = 4 group by auv.cursoId order by titulo
*/

/*
            $cursos = $this->mysqli->query("SELECT  group_concat(sbQ.cursos_pct separator ', ') cs_progresso from (
            SELECT  concat( 
            c.titulo ,' ', ROUND((
            (select count(*) from aulas_vistas avs where avs.cursoId = c.cursoId and avs.alunoId = {$aluno['alunoId']}) /
            (select count(*) from aulas al where al.cursoId = c.cursoId  )) * 100),'%' ) cursos_pct
            FROM aulas_vistas auv
            inner join cursos c on (auv.cursoId = c.cursoId) 
            where auv.alunoId = {$aluno['alunoId']}  group by auv.cursoId order by titulo

            ) as sbQ ");

            $cursos =  $cursos->fetch_assoc();
           */
            $data[] = [
                    $aluno['email'],
                    $aluno['nome'],
                    $aluno['sobrenome'],
                    $aluno['Plano'],
                    $aluno['Curso'],
                    $aluno['Aula'],
                    $aluno['DataAcesso'],
                  //  $planoAnual,
                   // $planoSemestral,
                    //$planoGratuito,
                   # $cursos['cs_progresso'],
            ];
 
        }

        $this->exportArrayData($data, $columns, 'aulasvistas');
    }


    public function exportTdm()
    {
        $columns = [
            'Email',
            'Nome',
            //'Sobrenome',
            //'Telefone',
           // 'Data Cadastro',
           // 'Plano Anual',
           // 'Plano Semestral',
           // 'Plano Gratuito',
            'Cursos Realizados',
        ];

        $data = [];

        $this->mysqli->set_charset("utf8");
        $alunos = $this->mysqli->query("SELECT a.alunoId, a.email, a.nome
                                        from alunos a
                                        inner join aulas_vistas av on a.alunoId = av.alunoId
                                        group by a.alunoId  ");
        //$alunos = $alunos->fetch_assoc();



       while ($aluno = $alunos->fetch_assoc()) {
 

/*
            $planoAnual = $this->mysqli->query("select assinaturas.data_inicio from assinaturas inner join planos on (assinaturas.planoId = planos.planoId) where assinaturas.vencimento >= now() and alunoId = {$aluno['alunoId']} and assinaturas.planoId = 4");
            $planoAnual = $planoAnual ? $planoAnual->fetch_object() : false;
            $planoAnual = $planoAnual ? $planoAnual->data_inicio : "";

            $planoSemestral = $this->mysqli->query("select assinaturas.data_inicio from assinaturas inner join planos on (assinaturas.planoId = planos.planoId) where assinaturas.vencimento >= now() and alunoId = {$aluno['alunoId']} and assinaturas.planoId = 3");
            $planoSemestral = $planoSemestral ? $planoSemestral->fetch_object() : false;
            $planoSemestral = $planoSemestral ? $planoSemestral->data_inicio : "";

            $planoGratuito = $this->mysqli->query("select assinaturas.data_inicio from assinaturas inner join planos on (assinaturas.planoId = planos.planoId) where assinaturas.vencimento >= now() and alunoId = {$aluno['alunoId']} and assinaturas.planoId = 1");
            $planoGratuito = $planoGratuito ? $planoGratuito->fetch_object() : false;
            $planoGratuito = $planoGratuito ? $planoGratuito->data_inicio : "";

            SELECT  concat( 
titulo ,' ', ROUND((
(select count(*) from aulas_vistas avs where avs.cursoId = c.cursoId and avs.alunoId = 4) /
(select count(*) from aulas al where al.cursoId = c.cursoId  )) * 100) pct
) asd
FROM aulas_vistas auv
inner join cursos c on (auv.cursoId = c.cursoId) 
where alunoId = 4 group by auv.cursoId order by titulo
*/

            $cursos = $this->mysqli->query("SELECT  group_concat(sbQ.cursos_pct separator ', ') cs_progresso from (
            SELECT  concat( 
            c.titulo ,' ', ROUND((
            (select count(*) from aulas_vistas avs where avs.cursoId = c.cursoId and avs.alunoId = {$aluno['alunoId']}) /
            (select count(*) from aulas al where al.cursoId = c.cursoId  )) * 100),'%' ) cursos_pct
            FROM aulas_vistas auv
            inner join cursos c on (auv.cursoId = c.cursoId) 
            where auv.alunoId = {$aluno['alunoId']}  group by auv.cursoId order by titulo

            ) as sbQ ");

            $cursos =  $cursos->fetch_assoc();
           
            $data[] = [
                    $aluno['email'],
                    $aluno['nome'],
                    //$aluno['sobrenome'],
                   // $aluno['celular'],
                   // $aluno['data_cadastro'],
                  //  $planoAnual,
                   // $planoSemestral,
                    //$planoGratuito,
                    $cursos['cs_progresso'],
            ];
 
        }

        $this->exportArrayData($data, $columns, 'tdm');
    }

    public function exportAssinantes()
    {
        $query = "select {$this->alunosFields()},
        planos.nome plano,
        assinaturas.vencimento vencimento_plano
        from alunos
        inner join assinaturas on (alunos.alunoId = assinaturas.alunoId)
        inner join planos on (assinaturas.planoId = planos.planoId)
        order by alunos.nome";
        $fileName = 'alunos_assinantes';
        $this->export($query, $fileName);
    }

    public function exportAssinantesAtivos()
    {
        $query = "select {$this->alunosFields()},
        planos.nome plano,
        assinaturas.vencimento vencimento_plano
        from alunos
        inner join assinaturas on (alunos.alunoId = assinaturas.alunoId)
        inner join planos on (assinaturas.planoId = planos.planoId)
        where assinaturas.vencimento >= now()
        order by alunos.nome";
        $fileName = 'alunos_assinantes_ativos';
        $this->export($query, $fileName);
    }

    public function exportAssinantesInativos()
    {
        $query = "select {$this->alunosFields()},
        planos.nome plano,
        assinaturas.vencimento vencimento_plano
        from alunos
        inner join assinaturas on (alunos.alunoId = assinaturas.alunoId)
        inner join planos on (assinaturas.planoId = planos.planoId)
        where assinaturas.vencimento < now()
        order by alunos.nome";
        $fileName = 'alunos_assinantes_inativos';
        $this->export($query, $fileName);
    }

    public function exportMatriculados()
    {
        $query = "select {$this->alunosFields()},
        cursos.titulo curso,
        cursos_matriculas.expira vencimento_curso
        from cursos_matriculas
        inner join cursos on (cursos_matriculas.cursoId = cursos.cursoId) 
        inner join alunos on (cursos_matriculas.alunoId = alunos.alunoId)
        order by alunos.nome";
        $fileName = 'alunos_matriculados';
        $this->export($query, $fileName);
    }

    public function exportInscritos()
    {
        $query = "select {$this->alunosFields()}
        from alunos
        where alunoId not in (select alunoId from cursos_matriculas)
        and alunoId not in (select alunoId from assinaturas)
        order by alunos.nome";
        $fileName = 'alunos_inscritos';
        $this->export($query, $fileName);
    }

    public function export($query, $fileName)
    {
        $fileName = "{$fileName}_export_" . date('d-m-Y') . ".csv";
        $csv_export = '';

        $this->mysqli->set_charset("utf8");
        if ($result = $this->mysqli->query($query)) {
            $fieldCount = $this->mysqli->field_count;
            for ($i = 0; $i < $fieldCount; $i++) {
                $csv_export .= $result->fetch_field_direct($i)->name . ';';
            }

            $csv_export .= '
            ';

            while ($row = $result->fetch_array()) {
                for ($i = 0; $i < $fieldCount; $i++) {
                    $csv_export .= $row[$result->fetch_field_direct($i)->name] . ';';
                }
                $csv_export .= '
            ';
            }

            //header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header("Content-Disposition: attachment; filename=" . $fileName . "");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            echo($csv_export);
        }
    }

    public function exportArrayData(array $data, $columns, $fileName)
    {
        $fileName = "{$fileName}_export_" . date('d-m-Y') . ".csv";
        $csv_export = '';

        foreach ($columns as $column) {
            $csv_export .= "{$column};";
        }

        $csv_export .= '
            ';

        foreach ($data as $row) {
            foreach ($row as $item) {
                $csv_export .= "{$item};";
            }
            $csv_export .= '
            ';
        }

        //header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=" . $fileName . "");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo($csv_export);
    }

    private function alunosFields()
    {
        return "
            alunos.nome, 
            alunos.sobrenome, 
            alunos.cpf, 
            alunos.email, 
            alunos.endereco, 
            alunos.cidade, 
            alunos.uf, 
            alunos.bairro, 
            alunos.cep, 
            alunos.data_cadastro
        ";
    }
}
