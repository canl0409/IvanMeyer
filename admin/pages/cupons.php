<?php 
$add = null;
$pid = null;
$sub = null;
$catId = null;
$catId2 = null;



if(isset($_POST['savacuponid'])){ 
$add =  $p->saveCupon($_POST);
 
} 

if(isset($_GET['del'])){
$p->del('cupons','cuponId',$_GET['del'],'restauranteId');
}





if(isset($_POST['desconto'])){ 
$add =  $p->addCupon($_POST);
} 
 
?>
<section id="main-content">
<section class="wrapper site-min-height">

<section class="panel">


<div class="panel-body"  >
<header  >
Adicionar Cupon
</header>
<div class=" form" >
<form action="?cupons" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" novalidate="novalidate"  enctype="multipart/form-data">


<div class="form-group ">

<div class="col-lg-10">
<table cellpadding="0" cellspacing="0">
  <tr>
    <td><label class="control-label col-lg-4" for="cname">Desconto: </label></td>
    <td><input type="text" style="width:100px;float:left" required="" minlength="1" name="desconto" id="cname" 
class="number form-control "><b>%</b></td>
    <td style="width:135px;text-align:right"><label class="control-label" style="text-align:right;font-weight:normal;padding-right:5px">Valido até: </label></td>
    <td><input type="text"  data-mask="99-99-9999"  required="" minlength="1" name="validade" id="cname" class="form-control ">
<span class="help-inline" style="position:absolute">dia-mês-ano</span></td>
    <td style="width:200px;padding-left:20px;"><button   type="submit" class="btn btn-danger">Adicionar</button></td>
  </tr>
</table>
</div>
</div>





</div>
</form>
</div>
</div>


<style>
.by{
background: #fcb322;
}
</style>


<header class="panel-heading">
Cupons 
</header>
<div class="panel-body">
<div class="adv-table">
<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
<thead>
<tr>
<th> Cod. Cupon</th>
<th>Desconto</th>
<th>Validade</th>
<th>Status</th> 
<th> </th>
</tr>
</thead>
<tbody>
<?php $q = $p->lista('cupons'); foreach ($q as $r) {
?>

<tr class="gradeX">
<td><?=$r['codigo']?></td>
<td><?=$r['desconto']?>%</td>
<td><?=$r['validade']?></td>
<td><?php if($r['status'] == 1){echo "usado";}else{echo "disponivel";}?></td> 
<td class="center hidden-phone"> 
  <a href="?cupom_edit&id=<?=$r['cuponId']?>" >
                                    <button  data-original-title="Editar" class="tooltips btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
 </a>
<a  href="?cupons&del=<?=$r['cuponId']?>" onClick="return confirm('Deseja apagar?')"> 
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
<script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<!--common script for all pages-->

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#hidden-table-info').dataTable( {
"aaSorting": [[ 4, "desc" ]]
} );


//called when key is pressed in textbox
$(".number").keypress(function (e) {
//if the letter is not digit then display error and don't type anything
if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//display error message
$("#errmsg").html("Use apenas números").show().fadeOut("slow");
return false;
}
   
});


} );
</script>  