<?php
$add = null;


if (isset($_POST['upid'])) {
  //$add =  $p->updateRegistro($_POST,'categorias','categoriaId',$_POST['upid']);
  $add =  $p->updateRegistroImg($_POST, $_FILES, 'instrutores', 'instrutorId', $_POST['upid'], 'foto', '../assets/imgs/team/');
}



if (isset($_GET['pid'])) {
  $pd =  $p->getRegistro('instrutores', 'instrutorId', $_GET['pid']);
}


?>


<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <section class="panel">
      <header class="panel-heading">
        Editar instrutor
      </header>

      <div class="warn"><?= $add ?></div>
      <div class="panel-body">
        <div class=" form">
          <form action="?instrutor_edit&pid=<?= $_GET['pid'] ?>" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" enctype="multipart/form-data">
            <input type="hidden" value="<?= $pd['instrutorId'] ?>" name="upid">


            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Categoria </label>
              <div class="col-lg-10">
                <select required="" name="tipo" class="form-control ">
                  <option value="professor" <?php if ($pd['tipo'] == 'professor') {
                                              echo "selected";
                                            } ?>>Professor</option>
                  <option value="colaborador" <?php if ($pd['tipo'] == 'colaborador') {
                                                echo "selected";
                                              } ?>>Colaborador</option>
                </select>
              </div>
            </div>


            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Nome </label>
              <div class="col-lg-10">
                <input type="text" required="" minlength="2" name="nome" id="cname" value="<?= $pd['nome'] ?>" class="form-control ">
              </div>
            </div>

            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Vídeo (vimeo) </label>
              <div class="col-lg-10">
                <input type="text" minlength="2" name="video" id="cname" value="<?= $pd['video'] ?>" class="form-control ">
              </div>
            </div>

            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Descricao </label>
              <div class="col-lg-10">
                <textarea name="descricao" class="form-control "><?= $pd['descricao'] ?></textarea>
              </div>
            </div>

            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Itens página de plano. (separador = |) </label>
              <div class="col-lg-10">
                <textarea name="descricao_plano" class="form-control "><?= $pd['descricao_plano'] ?></textarea>
              </div>
            </div>

            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Descricao Completa </label>
              <div class="col-lg-10">
                <textarea name="descricao_m" class="form-control "><?= $pd['descricao_m'] ?></textarea>
              </div>
            </div>


            <div class="form-group ">
              <label class="control-label col-lg-2">Foto <span class="tip">(270px x 270px)</span></label>
              <div class="col-md-9">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                    <?php if ($pd['foto']) { ?>
                      <img src="../assets/imgs/team/<?= $pd['foto'] ?>" alt="" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                    <?php } else {  ?>
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                    <?php } ?>
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">

                  </div>
                  <div>
                    <span class="btn btn-white btn-file">
                      <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagem</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
                      <input type="file" name="foto" class="default" />
                    </span>
                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
                  </div>
                </div>

              </div>
            </div>



            <div class="form-group ">
              <label class="control-label col-lg-2">Foto página de plano. <span class="tip"></span></label>
              <div class="col-md-9">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                    <?php if ($pd['foto_grande']) { ?>
                      <img src="../assets/images/<?= $pd['foto_grande'] ?>" alt="" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                    <?php } else {  ?>
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                    <?php } ?>
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">

                  </div>
                  <div>
                    <span class="btn btn-white btn-file">
                      <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagem</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
                      <input type="file" name="foto_grande" class="default" />
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
<script src="js/respond.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="https://ckeditor.com/latest/ckeditor.js"></script>
<!--script for this page-->
<script src="js/form-validation-script.js"></script>


<script>
  CKEDITOR.config.allowedContent = false;
  CKEDITOR.config.extraAllowedContent = 'iframe[*]';

  CKEDITOR.replace('descricao_m', {
    // Define the toolbar groups as it is a more accessible solution.
    filebrowserUploadUrl: "ckupload.php",
    //htmlEncodeOutput: true,


    toolbar: [

      {
        name: 'document',
        groups: ['mode', 'document', 'doctools'],
        items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']
      },
      {
        name: 'clipboard',
        groups: ['clipboard', 'undo'],
        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
      },
      {
        name: 'editing',
        groups: ['find', 'selection', 'spellchecker'],
        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
      },
      {
        name: 'forms',
        items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']
      },
      '/',
      {
        name: 'basicstyles',
        groups: ['basicstyles', 'cleanup'],
        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
      },
      {
        name: 'paragraph',
        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
      },
      {
        name: 'links',
        items: ['Link', 'Unlink', 'Anchor']
      },
      {
        name: 'insert',
        items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
      },
      '/',
      {
        name: 'styles',
        items: ['Styles', 'Format', 'Font', 'FontSize']
      },
      {
        name: 'colors',
        items: ['TextColor', 'BGColor']
      },
      {
        name: 'tools',
        items: ['Maximize', 'ShowBlocks']
      },
      {
        name: 'others',
        items: ['-']
      }

    ]
  });
</script>
