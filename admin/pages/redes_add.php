   <?php 
    $add = null;
    if(isset($_POST['nome'])){  
     $add =  $p->addRegistro($_POST,'redes');
    } ?>

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Cadastrar Rede Social
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?redes_add" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"    enctype="multipart/form-data">


 


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Nome </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="nome" id="cname"   class="form-control ">
</div>
</div>

 
 <div class="form-group ">
<label class="control-label col-lg-2" for="cname">Link </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="url" id="cname"   class="form-control ">
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Icone </label>
<div class="col-lg-10">
<select name="icon" id="" class="form-control ">
<option value="">Selecione</option>
<option value="fab fa-twitter">Twitter</option>
<option value="fab fa-facebook-square">Facebook</option>
<option value="fab fa-pinterest">Pinterest</option>
<option value="fab fa-instagram">Instagram</option>
<option value="fab fa-google-plus">Google Plus</option>
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


 