<?php 
$add = null;
if(isset($_POST['nome'])){  
$add =  $p->addRegistroImg($_POST,$_FILES,'categorias','categoriaId','imagem','../assets/imgs/');
} ?>

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Cadastrar Categoria
</header>
<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   enctype="multipart/form-data">
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Título </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="nome" id="cname" class="form-control ">
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2">Imagem <span class="tip">(265px x 137px)</span></label>
<div class="col-md-9">
<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
 
<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
 
</div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">

</div>
<div>
<span class="btn btn-white btn-file">
<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagem</span>
<span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
<input type="file" name="imagem" class="default" />
</span>
<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
</div>
</div>

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
