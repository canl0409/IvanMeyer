
<?php 
$add = null;

if(isset($_POST['upid'])){ 
$add =  $p->updateRegistro($_POST,'downloads','id',1);   
}  

if(isset($_SESSION['radmin'])){  
$pd =  $p->getRegistro('downloads','id',1);
} 


?>
  

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Editar dados para downloads
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?downloads_edit" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" novalidate="novalidate"  enctype="multipart/form-data">
<input type="hidden" value="<?=$pd['id']?>" name="upid">

 

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Senha para Downloads</label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="senhageral" id="senhageral" value="<?=$pd['senhageral']?>"  class="form-control ">
</div>
</div>

 
 
<div class="form-group">
<div class="col-lg-offset-2 col-lg-10">
<button type="submit" class="btn btn-danger">Salvar</button>
<button type="button" class="btn btn-default">Cancelar</button>
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

<!--script for this page-->
<script src="js/form-validation-script.js"></script>


<script>
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