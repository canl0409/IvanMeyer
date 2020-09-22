<?php 
$add = null;

if(isset($_GET['pid'])){  
$pd =  $p->getRegistro('cursos_matriculas','cmId',$_GET['pid']);
$alunoid = $pd['alunoId'];
} 

 

?>

<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
<script> 
function validateForm() {
if($('#expira').val() == ''){
$('.warn').html('Inserir data de expiração');
return false;
}
}

</script>

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Nova Matricula
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?alunos_edit2&pid=<?=$alunoid?>" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   onsubmit="return validateForm()"    enctype="multipart/form-data">


 
<input type="hidden"  value="<?=$alunoid?>" name="alunoId"    >
<input type="hidden"  value="<?=$_GET['pid']?>" name="upid"    >


<div class="form-group ">
  <label class="control-label col-lg-2" for="cname">Curso </label>
  <div class="col-lg-10">
    <select name="cursoId" id="" class="form-control ">
      <?php $css = $p->lista('cursos'); foreach ($css as $cu) {?>
      <option <?php   if($pd['cursoId'] == $cu['cursoId']){echo "selected";}  ?> value="<?=$cu['cursoId'] ?>"><?=$cu['titulo'] ?></option>
      <?php } ?>
    </select>
  </div>
</div>

 
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Data Expira </label>
<div class="col-lg-10">
<input type="text" readonly  minlength="2" name="expira" id="expira" value="<?=$pd['expira']?>"  class="form-control default-date-picker ">
</div>
</div>

 
<div class="form-group">
<div class="col-lg-offset-2 col-lg-8">
<button type="submit" class="btn btn-danger">Salvar</button>
</div>
<div class=" col-lg-2">
<a href="?alunos_edit2&pid=<?=$alunoid?>&dcmId=<?=$pd['cmId']?>" ><button type="button" class="btn btn-warning">Excluir</button></a>
</div>
</div>
</form>
</div>

</div>
</section>
<!-- page end-->
</section>
</section>


<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script src="js/respond.min.js" ></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>

<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>

<!--script for this page-->
<script src="js/form-validation-script.js"></script>


<script>

   $('.default-date-picker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });


$('#catId').change(
function(){
console.log(this.value);


$('#catId #'+this.value).filter(':contains(Pizza)').each(function() {
console.log('tem pzizza');
$('#atributos').css('display','block');
});

$('#catId #'+this.value).not(':contains(Pizza)').each(function() {
$('#atributos').css('display','none');
console.log('nott pzizza');
$('.atprecos').val('');
});

});
</script>