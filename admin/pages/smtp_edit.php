
<?php 
$add = null;


if(isset($_POST['host'])){ 
$add =  $p->updateConfig($_POST,'email_config','emailcId',1);   
}  

 
$pd =  $p->getRegistro('email_config','emailcId',1);
 

 
$pd = json_decode($pd['config'],1);

?>
  

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Editar Servidor SMTP
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?smtp_edit" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   enctype="multipart/form-data">

 



<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Servidor </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="host" id="cname" value="<?=$pd['host']?>"  class="form-control ">
</div>
</div>
 
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Porta </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="porta" id="cname" value="<?=$pd['porta']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Usuário </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="usuario" id="cname" value="<?=$pd['usuario']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Senha </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="senha" id="cname" value="<?=$pd['senha']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Segurança </label>
<div class="col-lg-10">
	<select name="ssl" id="" class="form-control">
		<option value="">Não</option>
		<option value="ssl" <?php if($pd['ssl'] == 'ssl'){ echo "selected" ; } ?> >Sim (ssl)</option>
	</select>
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
 $('#icons option[value="<?=$pd['icon']?>"]').prop('selected', true)
</script>