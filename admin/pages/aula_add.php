<?php 
$add = null;
if(isset($_POST['titulo'])){    

  $add =  $p->addRegistro($_POST,'aulas',$_FILES,'audio','aulaId');
} ?>

<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <section class="panel">
      <header class="panel-heading">
        Cadastrar Aula
      </header>
      <div class="warn"><?=$add?></div>
      <div class="panel-body">
        <div class=" form">
          <form action="" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   enctype="multipart/form-data">
            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Título </label>
              <div class="col-lg-10">
                <input type="text" required="" minlength="2" name="titulo" id="titulo" class="form-control ">
              </div>
            </div>

            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Curso </label>
              <div class="col-lg-10">
                <select name="cursoId" id="cursoId" class="form-control ">
                  <?php $css = $p->lista('cursos'); foreach ($css as $cu) {?>
                  <option <?php if(isset($_POST['cursoId'])){ if($_POST['cursoId'] == $cu['cursoId']){echo "selected";}  }?> value="<?=$cu['cursoId'] ?>"><?=$cu['titulo'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>


           <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Módulo </label>
              <div class="col-lg-10">
                <select name="moduloId" id="moduloId" class="form-control ">

                </select>
              </div>
            </div> 


            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Vídeo </label>
              <div class="col-lg-10">
                <input type="text"  minlength="2" name="video" id="cname" class="form-control ">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Áudio (mp3)</label>
              <div class="controls col-md-10">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <span class="btn btn-white btn-file">
                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i>Escolher arquivo</span>
                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
                    <input type="file" name="audio[]" class="default" multiple/>
                  </span>
                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                </div>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-2">Arquivos PDF</label>
              <div class="controls col-md-10">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <span class="btn btn-white btn-file">
                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i>Escolher arquivos</span>
                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
                    <input type="file" name="files[]" class="default" multiple/>
                  </span>
                  <span class="fileupload-preview" style="margin-left:5px;display:none"></span>
                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                </div>
              </div>
            </div>   

            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Duração </label>
              <div class="col-lg-10">
                <input type="text" required="" minlength="2" name="duracao" id="cname" class="form-control "  style="width:100px">  (minutos)
              </div>
            </div>

            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Grátis </label>
              <div class="col-lg-10">
                <input type="checkbox" name="free" id="cname" class="form-control " style="width:20px" >
              </div>
            </div>            

           <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Descricao </label>
              <div class="col-lg-10">
                <textarea name="texto" id="descricao" class="form-control ckeditor"></textarea>
              </div>
          </div>

          <div class="form-group ">
              <label class="control-label col-lg-2" for="email">Envia Email</label>
              <div class="col-lg-10">
                <input type="checkbox" name="email" id="email" class="form-control " style="width:20px" >
              </div>
            </div>            

            <div class="form-group" id="div-titulo-email" style="display: none">
              <label class="control-label col-lg-2" for="email_titulo">Titulo Email</label>
              <div class="col-lg-10">
                <input type="text" name="email_titulo" id="email_titulo" class="form-control ckeditor" />
              </div>
            </div>

           <div class="form-group" id="div-conteudo-email" style="display: none">
              <label class="control-label col-lg-2" for="email_conteudo">Conteúdo Email</label>
              <div class="col-lg-10">
                <textarea name="email_conteudo" id="email_conteudo" class="form-control ckeditor"></textarea>
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
<script type="text/javascript" src="https://sdk.ckeditor.com/vendor/ckeditor/4.9.2/ckeditor.js"></script>

<!--script for this page-->
<script src="js/form-validation-script.js"></script>

  <script>

$(document).ready(function() {

    $( "#email" ).change(function() {
        if(this.checked){

          var aula_titulo = $( "#titulo" ).val();
          var email_titulo =  $( "#email_titulo" ).val();

          if(aula_titulo != '' && email_titulo == ''){
            $( "#email_titulo" ).val(aula_titulo);
          }

          $( "#div-titulo-email" ).show();
          $( "#div-conteudo-email" ).show();
        }else{
          $( "#div-titulo-email" ).hide();
          $( "#div-conteudo-email" ).hide();
        }
    });

    $( "#cursoId" ).change(function() {
      $.post("ajax.php", {'loadModulobyCuso':this.value},
      function(data) {  
        $('#moduloId').html(data);
      });
    });


    CKEDITOR.config.allowedContent = false;
    CKEDITOR.config.extraAllowedContent = 'iframe[*]';

    CKEDITOR.replace( 'descricao', {
    filebrowserUploadUrl: "ckupload.php" ,
    toolbar: [

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
      
    ]
        } );

    CKEDITOR.replace( 'email_conteudo', {
    filebrowserUploadUrl: "ckupload.php" ,
    toolbar: [

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
      
    ]
        } );

    });
 
 
 
setTimeout(function(){ $("#cursoId").trigger("change"); }, 1000);
 
  </script>