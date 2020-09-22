<?php 
$add = null;
$pid = null;
$sub = null;
$catId = null;
$catId2 = null;


 
 
if(isset($_GET['id'])){  
$cp =  $p->getRegistro('cupons','cuponId', $_GET['id']);
$validade = date( 'd-m-Y', strtotime($cp['validade']) );
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
Editar Cupon
</header>
<div class=" form" >
<form action="?cupons" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" novalidate="novalidate"  enctype="multipart/form-data">

<input type="hidden" name="savacuponid" value="<?=$_GET['id']?>">
<div class="form-group ">

<div class="col-lg-10">
<style>
	#tbcupom td{
padding-bottom: 10px;
	}
</style>
<table id="tbcupom" cellpadding="0" cellspacing="0">
  <tr>
    <td><label class="control-label col-lg-4" for="cname">Nome: </label></td>
    <td><input type="text" style="width:200px;" required="" minlength="1" name="codigo" value="<?=$cp['codigo']?>" id="cname" 
class=" form-control "></td>
</tr>
  <tr>
    <td><label class="control-label col-lg-4" for="cname">Desconto: </label></td>
    <td><input type="text" style="width:100px;float:left" required="" minlength="1" name="desconto" value="<?=$cp['desconto']?>" id="cname" 
class="number form-control "><b>%</b></td>
</tr>

<tr>
    <td ><label class="control-label col-lg-4" >Valido até: </label></td>
    <td><input type="text"  value="<?=$validade?>" data-mask="99-99-9999"  required="" minlength="1" name="validade" id="cname" class="form-control ">
<span class="help-inline" style="float:left">dia-mês-ano</span></td>
</tr>
<tr>
	<td></td>
    <td ><button   type="submit" class="btn btn-danger">Salvar</button></td>
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