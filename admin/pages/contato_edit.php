
<?php 
$add = null;
$sessao = "contato";

if(isset($_GET['banner_del'])){ 
$p->delBanner($_GET['banner_del']);   
}

if(isset($_POST['upid'])){ 
$add =  $p->updateRegistro($_POST,'contato','contatoId',1);    
$add2 =  $p->addImages($_FILES,'banners', $sessao);  
}  

if(isset($_SESSION['radmin'])){  
$pd =  $p->getRegistro('contato','contatoId',1);
} 


?>
  

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Editar Dados de Contato
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?contato_edit" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" novalidate="novalidate"  enctype="multipart/form-data">
<input type="hidden" value="<?=$pd['contatoId']?>" name="upid">

 


<div class="form-group ">
<label class="control-label col-lg-2">Banners  <span class="tip">(1170px x 550px) <br> Segure 'Ctrl' para selecionar varias imagens.</label>
<div class="col-md-9">
<div class="fileupload fileupload-new" data-provides="fileupload2">


<?php 
$bnrs = $p->lista('banners',"where sessao='".$sessao."' ");
if($bnrs){ 
foreach ($bnrs as $va) {
?>
<div class="fileupload-new thumbnail" style="width:150px; " class="inline">
<img src="../assets/imgs/<?=$va['imagem']?>" alt="" style="max-width: 140px; max-height: 150px; line-height: 20px;" class="inline"> 

<a href="../assets/imgs/<?=$va['imagem']?>" download>
<span style="margin-top:5px;" class="btn btn-info  btn-xs"><i class="fa fa-download "></i> Download</span>
</a>

<a href="?contato_edit&banner_del=<?=$va['bannerId']?>" onClick="return confirm('Deseja apagar?')"> 
<span  style="margin-top:5px;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></span> 
</a>
</div>
<?php } 
}else{  ?>
<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
<img src="" id="prev_banners"   class="img-prev" style="width:90px"> 
<p  class="text-prev-banners"></p>
<?php } ?>



<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">

</div>
<div>
<span class="btn btn-white btn-file">
<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagens</span>
<span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
<input type="file" name="banner[]" id="banners" class="default" multiple="multiple"  onchange="readURL(this);"   />
<img src="" id="prev_banners"   class="img-prev"> 
<p  class="text-prev-banners"></p>
</span>

<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload2"><i class="fa fa-trash"></i> Remover</a>
</div>
</div>

</div>
</div>



<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Título</label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="titulo" id="cname" value="<?=$pd['titulo']?>"  class="form-control ">
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Telefone 1 </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="telefone1" id="cname" value="<?=$pd['telefone1']?>"  class="form-control ">
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Telefone 2 </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="telefone2" id="cname" value="<?=$pd['telefone2']?>"  class="form-control ">
</div>
</div>
 

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">E-mail(Contato) </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="email" id="cname" value="<?=$pd['email']?>"  class="form-control ">
</div>
</div>
 


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Endereço</label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="endereco" id="cname" value="<?=$pd['endereco']?>"  class="form-control ">
</div>
</div>
 
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Texto Rodape</label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="texto_rodape" id="cname" value="<?=$pd['texto_rodape']?>"  class="form-control ">
</div>
</div>
 
 
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Texto Copyright</label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="copyright" id="cname" value="<?=$pd['copyright']?>"  class="form-control ">
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