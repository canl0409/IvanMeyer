<?php 

if(isset($_GET['dpid'])){
$p->del('opinioes','opiniaoId',$_GET['dpid']);

}

?>   



<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Opniões
</header>
<div class="panel-body">
<div class="adv-table">
<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
<thead>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Curso</th>
<th>Opnião</th>
<th>Nota</th>
<th class="hidden-phone">Status</th>
<th></th>
</tr>
</thead>
<tbody>
<?php $q = $p->lista('opinioes' ,' ORDER by opiniaoId DESC'); 
 foreach ($q as $r) {
  $cur = $p->getRegistro('cursos','cursoId',$r['cursoId']);  
?>
<tr class="gradeX">
<?php
    if($r['alunoId']){
      $aluno = $p->getRegistro('alunos','alunoId',$r['alunoId']);  
      $nome = $aluno['nome'];
    }else{
      $nome = $r['titulo'];
    }
?>
<td><?=$r['opiniaoId']?></td>
<td><?=$nome?></td>
<td><?=$cur['titulo']?></td>
<td><?=$r['opiniao']?></td>
<td><?=$r['nota']?></td>
 
<td> <?php  if($r['status'] == 2){ $st = 'Pendente'; $cla='';}
if($r['status'] == 0){$st = 'Reprovado'; $cla='label-danger';} 
if($r['status'] == 1){$st = 'Aprovado'; $cla='label-success';} ?>

<span class="badge <?=$cla?> label-mini"><?=$st?></span>
</td>

  
<td> 
<a href="?opinioes_edit&pid=<?=$r['opiniaoId']?>" >
<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
</a>

<a href="?opinioes_listar2&dpid=<?=$r['opiniaoId']?>" onClick="return confirm('Deseja apagar?')"> 
<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> 
</a>
</td>
</tr>
<?php }   ?>
</tbody>
</table>

</div>
</div>
</section>
<!-- page end-->
</section>
</section>


<!-- js placed at the end of the document so the pages load faster -->
<!--<script src="js/jquery.js"></script>-->
<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>

<!--common script for all pages-->

<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script type="text/javascript" src="assets/advanced-datatable/media/js/buttons.html5.js"></script>
<script type="text/javascript" src="assets/advanced-datatable/media/js/buttons.print.js"></script>



<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#hidden-table-info').dataTable( {
"aaSorting": [[ 0, "desc" ]],
dom: 'Bfrtip',
"iDisplayLength": 100,
buttons: [
'csv', 'excel', 'pdf', 'print'
]
} );

 
} );
</script>  


