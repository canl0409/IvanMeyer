<?php

include '../config.php';
include 'class.php';



function echoifnull($teste){
if($teste){
return json_encode($teste);
}else{
return 1;
}
}


 if(isset($_REQUEST['alunos'])){
$start = $_GET['start'];
$tamanho = $_GET['length'];
$draw = $_GET['draw'];


/*
$colunas = array('nome','email','sobrenome','celular','cpf','cidade','bairro');

$order = null;
if(isset($_GET['order'][0]['dir']) && isset($_GET['order'][0]['column'])){
$order = " ORDER BY ".$colunas[$_GET['order'][0]['column']]." ".$_GET['order'][0]['dir'];
}
*/


$qy = '';

if(isset($_GET['search']['value'])){
	$qs = $_GET['search']['value'];
$qy = " WHERE nome LIKE '%$qs%' or sobrenome LIKE '%$qs%'  or email LIKE '%$qs%' or celular LIKE '%$qs%'  or cpf LIKE '%$qs%' or cidade LIKE '%$qs%' ";
}

$count = $p->countreg('alunos');

echo '{"draw":'.$draw.',"recordsTotal":'.$count.',"recordsFiltered":'.$count.',"data":';


$q = $p->lista('alunos', " $qy order by alunoId DESC  LIMIT $start , $tamanho");

foreach ($q as $r) {

$sm = $p->getRegistro('cursos_matriculas','alunoId',$r['alunoId']);
if($sm){
$infom = '<span class="label label-info label-mini">Matriculado</span>';
}else{
$infom = '';
}

$sm = $p->lista('pagamentos'," where alunoId ='$r[alunoId]' ORDER BY pagamentoId DESC limit 1");
$infopg = '';
if($sm){
	if($sm[0]['status_pagamento'] == 4){
		$infopg = '<span class="label label-success  label-mini">Confirmado</span>';
	}else {
		$infopg = '<span class="label label-warning label-mini">Pendente</span>';
	}
}

$tbl[] = array($r['nome'],
$r['email'],
$r['celular'],
$r['cidade']." ".$r['uf'],
$infom ,
$infopg,
$r['data_cadastro'],

'<a href="?alunos_listar&dpid='.$r['alunoId'].'" onClick="return confirm(\'Deseja apagar?\')"> 
<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> 
</a>
<a href="?alunos_edit2&pid='.$r['alunoId'].'"><span class="label label-primary label-mini">Detalhes</span></a>'
);
}






echo echoifnull($tbl);

echo '}';


 }





if(isset($_REQUEST['orden_aulas'])){

$orden = $_REQUEST['orden_aulas'];

$orden = json_decode($orden);

$p->updateOrdem('aulas', 'aulaId', $orden) ;
}

if(isset($_REQUEST['orden_modulos'])){

$orden = $_REQUEST['orden_modulos'];

$orden = json_decode($orden);

$p->updateOrdem('modulos', 'moduloId', $orden) ;
}


if(isset($_REQUEST['loadModulobyCuso'])){
$curso_id = $_REQUEST['loadModulobyCuso'] ;
$mds = $p->lista('modulos', " WHERE cursoId='$curso_id' ");
echo "<option value='0'>Sem Módulo</option>";
foreach ($mds as $md) {
echo "<option value='".$md['moduloId']."'>".$md['nome']."</option>";
}
}

if(isset($_REQUEST['clearfeed'])){
 $p->clearFeed();
}

if(isset($_REQUEST['destaquevd'])){
echo $p->destacarvideo($_REQUEST);
}

if(isset($_REQUEST['catId'])){
echo $p->ordenaCat($_REQUEST);
}

if(isset($_REQUEST['exibecat'])){
echo $p->exibecat($_REQUEST);
}

if(isset($_REQUEST['email2'])){
echo $p->login($_REQUEST);
}



?>

