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
<tbody>
<?php $q = $p->lista('alunos', " order by alunoId DESC LIMIT 9999"); foreach ($q as $r) {

?>
<tr class="gradeX">
<td><?=$r['nome']?></td>
<td><?=$r['email']?></td>
 
<td class="hidden-phone"><?=$r['celular']?></td>

<td class="center hidden-phone"> <?=$r['cidade']?> - <?=$r['uf']?></td>
<td class="center hidden-phone"> 
<?php
$sm = $p->getRegistro('cursos_matriculas','alunoId',$r['alunoId']);
if($sm){ ?>
<span class="label label-info label-mini">Matriculado</span>
<?php } ?>
</td>

<td class="center hidden-phone"> 
<?php
$sm = $p->getRegistro('pagamentos','alunoId',$r['alunoId'],'pagamentoId');
 
if($sm){if($sm['status'] == 1){ ?>
<span class="label label-success  label-mini">Confirmado</span>
<?php }else { ?>
<span class="label label-warning label-mini">Pendente</span>
<?php } } ?>
</td>


<td class="center hidden-phone"> <?=date( 'd/m/Y ', strtotime ($r['data_cadastro']) );?></td>

<td> 
<a style="display:none" href="?alunos_edit&pid=<?=$r['alunoId']?>" >
<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
</a>

<a href="?alunos_listar&dpid=<?=$r['alunoId']?>" onClick="return confirm('Deseja apagar?')"> 
<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> 
</a>
<a href="?alunos_edit2&pid=<?=$r['alunoId']?>"><span class="label label-primary label-mini">Detalhes</span></a>
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
"aaSorting": [[ 4, "desc" ]],
dom: 'Bfrtip',
"iDisplayLength": 100,
buttons: [
'csv', 'excel', 'pdf', 'print'
]
} );





$("input[type='checkbox']").on('click', function(){

bx = $(this).val();
var corretoras='';
$('.corretoras'+bx+':checked').each(function(){
corretoras=corretoras+$(this).attr('id')+',';

});
console.log(corretoras);
$.post('ajax.php', { vendedor:bx, corretoras:corretoras }, function(data){
// data = 0 - means that there was an error
// data = 1 - means that everything is ok
if(data == 1){
// Do something or do nothing :-)
alert('Data was saved in db!');
}
});

});



} );
</script>  


