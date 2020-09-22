
<?php 
$add = null;


if(isset($_POST['upid'])){ 
$add =  $p->updateRegistro($_POST,'duvidas','duvidaId',$_POST['upid']);   
}  

if(isset($_GET['pid'])){  
$pd =  $p->getRegistro('duvidas','duvidaId',$_GET['pid']);
} 


?>
  
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Editar Dúvida
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">

	
<div class=" form">
<form action="?duvidas_edit&pid=<?=$_GET['pid']?>" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   enctype="multipart/form-data">
<input type="hidden" value="<?=$pd['duvidaId']?>" name="upid">

 



<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Dúvida </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="duvida" id="cname" value="<?=$pd['duvida']?>"  class="form-control ">
</div>
</div>
 
 

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Resposta</label>
<div class="col-lg-10">
<textarea name="resposta" id="resposta"  class="form-control ckeditor"><?=$pd['resposta']?></textarea>
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
<script type="text/javascript" src="https://sdk.ckeditor.com/vendor/ckeditor/4.9.2/ckeditor.js"></script>

<!--script for this page-->
<script src="js/form-validation-script.js"></script>


 	<script>
		CKEDITOR.replace( 'resposta', {
			// Define the toolbar groups as it is a more accessible solution.
			toolbarGroups: [
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list","blocks","align",'bidi' ]},
				{"name":"document","groups":["mode"]},
				{"name":"insert","groups":["insert"]},
				{"name":"styles","groups":["styles"]},
				{"name":"about","groups":["about"]}
			],
			// Remove the redundant buttons from toolbar groups defined above.
			removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
		} );


	</script>