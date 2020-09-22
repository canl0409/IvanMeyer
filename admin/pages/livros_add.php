  <?php 
    $add = null;
    if(isset($_POST['titulo'])){ 
      $dados['titulo'] =  $_POST['titulo'];
      $dados['link'] =  $_POST['link'];
      $dados['senha'] =  $_POST['senha'];

      if(!empty($_FILES['capa']['name'])){
        $dados['capa'] = $p->upload($_FILES['capa'],'../arquivos/capas');  
      }else{
        $dados['capa'] = "";
      }

      $add =  $p->addRegistro($dados,'arquivos');
    }
    
  ?>

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Cadastrar Livro
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?livros_add" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"    enctype="multipart/form-data">



<div class="form-group ">
<label class="control-label col-lg-2">Capa</label>
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
<input type="file" name="capa" class="default" />
</span>
<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
</div>
</div>

</div>
</div>



<div class="form-group ">
<label class="control-label col-lg-2" for="titulo">Título </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="titulo" id="titulo"   class="form-control ">
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="titulo">Link ( separar por ; )</label>
<div class="col-lg-10">
<textarea required="" minlength="2" name="link" id="link" class="form-control "></textarea>
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="titulo">Senha</label>
<div class="col-lg-10">
<input type="text" minlength="2" name="senha" id="senha"   class="form-control ">
</div>
</div>

 
<div class="form-group">
<div class="col-lg-offset-2 col-lg-10">
<button type="submit" class="btn btn-danger">Salvar</button>
<a href="?livros_listar" class="btn btn-default">Cancelar</a>
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