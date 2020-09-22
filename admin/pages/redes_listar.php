<?php 

if(isset($_GET['dpid'])){
$p->del('redes','redeId',$_GET['dpid']);

}

?>   



<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Redes sociais
</header>
<div class="panel-body">
<div class="adv-table">
<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
<thead>
<tr>
<th>Nome</th>
<th>link</th>
<th></th>
</tr>
</thead>
<tbody>
<?php $q = $p->lista('redes'); 
 foreach ($q as $r) {
?>
<tr class="gradeX">
<td><?=$r['nome']?></td>
<td><?=$r['url']?></td>
  
<td> 
<a href="?redes_edit&pid=<?=$r['redeId']?>" >
<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
</a>

<a href="?redes_listar&dpid=<?=$r['redeId']?>" onClick="return confirm('Deseja apagar?')"> 
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


