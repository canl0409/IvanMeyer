
<?php 
$add = null;

if(isset($_GET['banner_del'])){ 
$p->delBanner($_GET['banner_del']);   
}

if(isset($_POST['upid'])){ 
$add =  $p->updateRegistro($_POST,'pagina_planos','id',1);   
$add2 =  $p->addImages($_FILES,'banners','pagina_planos');  
}  

if(isset($_SESSION['radmin'])){  
$pd =  $p->getRegistro('pagina_planos','id',1);
} 


?>
  

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Página Planos
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?paginaplanos_edit" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" novalidate="novalidate"  enctype="multipart/form-data">
	<input type="hidden" value="<?=$pd['id']?>" name="upid">

	<div class="form-group ">
	<label class="control-label col-lg-2">Banners  <span class="tip">(1170px x 550px) <br> Segure 'Ctrl' para selecionar varias imagens.</label>
	<div class="col-md-9">
	<div class="fileupload fileupload-new" data-provides="fileupload2">


	<?php 
	$bnrs = $p->lista('banners',"where sessao='pagina_planos' ");
	if($bnrs){ 
	foreach ($bnrs as $va) {
	?>
	<div class="fileupload-new thumbnail" style="width:150px; " class="inline">
	<img src="../assets/imgs/<?=$va['imagem']?>" alt="" style="max-width: 140px; max-height: 150px; line-height: 20px;" class="inline"> 

	<a href="../assets/imgs/<?=$va['imagem']?>" download>
	<span style="margin-top:5px;" class="btn btn-info  btn-xs"><i class="fa fa-download "></i> Download</span>
	</a>

	<a href="?paginaplanos_edit&banner_del=<?=$va['bannerId']?>" onClick="return confirm('Deseja apagar?')"> 
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
		<label class="control-label col-lg-2" for="cname">Video url</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="video_url" id="video_url"   class="form-control "><?=$pd['video_url']?></textarea>
		</div>
	</div>
	
	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto 1</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto1" id="textoedit1"   class="form-control "><?=$pd['texto1']?></textarea>
		</div>
	</div>
	
	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto 2</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto2" id="textoedit2"   class="form-control "><?=$pd['texto2']?></textarea>
		</div>
	</div>

		<hr/>

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Titulo Boneco 1</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto_boneco_1" id="texto_boneco_1"   class="form-control "><?=$pd['texto_boneco_1']?></textarea>
		</div>
	</div>
	

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto Boneco 1</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="subtexto_boneco_1" id="subtexto_boneco_1"   class="form-control "><?=$pd['subtexto_boneco_1']?></textarea>
		</div>
	</div>
	

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Titulo Boneco 2</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto_boneco_2" id="texto_boneco_2"   class="form-control "><?=$pd['texto_boneco_2']?></textarea>
		</div>
	</div>
	

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto Boneco 2</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="subtexto_boneco_2" id="subtexto_boneco_2"   class="form-control "><?=$pd['subtexto_boneco_2']?></textarea>
		</div>
	</div>
	

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Titulo Boneco 3</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto_boneco_3" id="texto_boneco_3"   class="form-control "><?=$pd['texto_boneco_3']?></textarea>
		</div>
	</div>
	

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto Boneco 3</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="subtexto_boneco_3" id="subtexto_boneco_3"   class="form-control "><?=$pd['subtexto_boneco_3']?></textarea>
		</div>
	</div>
	

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Titulo Boneco 4</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto_boneco_4" id="texto_boneco_4"   class="form-control "><?=$pd['texto_boneco_4']?></textarea>
		</div>
	</div>
	

	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto Boneco 4</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="subtexto_boneco_4" id="subtexto_boneco_4"   class="form-control "><?=$pd['subtexto_boneco_4']?></textarea>
		</div>
	</div>
	
	<hr/>


	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto 3</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto3" id="textoedit3"   class="form-control "><?=$pd['texto3']?></textarea>
		</div>
	</div>
	


	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto 4</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto4" id="textoedit4"   class="form-control "><?=$pd['texto4']?></textarea>
		</div>
	</div>
	


	<div class="form-group ">
		<label class="control-label col-lg-2" for="cname">Texto 5</label>
		<div class="col-lg-10">
			<textarea type="text" required="" minlength="2" name="texto5" id="textoedit5"   class="form-control "><?=$pd['texto5']?></textarea>
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

<script type="text/javascript" src="https://ckeditor.com/latest/ckeditor.js"></script>

<!--script for this page-->
<script src="js/form-validation-script.js"></script>

	<?php $ckvars = "	toolbar: [

	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
	'/',
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	{ name: 'others', items: [ '-' ] }

	]"; ?>

 	<script>

 		CKEDITOR.config.allowedContent = false;
        CKEDITOR.config.extraAllowedContent = 'iframe[*]';

		CKEDITOR.replace( 'textoeditx', {
		filebrowserUploadUrl: "ckupload.php" ,
	   <?=$ckvars?>
		} );

 


 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                 
                id = input.id;
                reader.onload = function (e) {
                if( input.files && input.files.length > 1 ){

					 $('.text-prev-'+id).html(input.files.length+' arquivos selecionados');
					 $('#prev_'+id).attr('src','');
                }else{
                	$('#prev_'+id).attr('src', e.target.result);
                }

                    


                };

                reader.readAsDataURL(input.files[0]);
            }
        }


	</script>