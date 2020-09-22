<?php

if(isset($_GET['dpid'])){
$p->del('alunos','alunoId',$_GET['dpid']);

}

?>



<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Alunos
</header>
<div class="panel-body">

<a href="<?=u.'admin/export_assinantes.php'?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-external-link-square"></i> Exportar Assinantes TODOS</a>
<a href="<?=u.'admin/export_assinantes_ativos.php'?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-external-link-square"></i> Exportar Assinantes ATIVOS</a>
<a href="<?=u.'admin/export_assinantes_inativos.php'?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-external-link-square"></i> Exportar Assinantes INATIVOS</a>
<a href="<?=u.'admin/export_matriculados.php'?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-external-link-square"></i> Exportar Matriculados</a>
<a href="<?=u.'admin/export_inscritos.php'?>" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-external-link-square"></i> Exportar Inscritos</a>
<a href="<?=u.'admin/export_tdm.php'?>" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-external-link-square"></i> Exportar TDM</a>

<a href="<?=u.'admin/export_aulasvistas.php'?>" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-external-link-square"></i> Exportar Aulas Vistas</a>

<div class="adv-table">
<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
<thead>
<tr>
<th>Nome</th>
<th>E-mail</th>

<th class="hidden-phone">Celular</th>
<th>Cidade</th>
<th>Status</th>
<th>Pagamentos</th>
<th class="hidden-phone">Data de Cadastro </th>
<th></th>
</tr>
</thead>

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
$('#hidden-table-infox').dataTable( {
"aaSorting": [[ 4, "desc" ]],
dom: 'Bfrtip',
"iDisplayLength": 100,
buttons: [
'csv', 'excel', 'pdf', 'print'
]
} );




$('#hidden-table-info').dataTable( {
"processing": true,
"serverSide": true,
"search": true,
"ordering": false,
"order": [[ 0, "desc" ]],
"iDisplayLength": 25,
"ajax": "ajax.php?alunos=1"
} );




} );
</script>


