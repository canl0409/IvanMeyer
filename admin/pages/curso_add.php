<?php
$add = null;
if (isset($_POST['titulo'])) {
    $add = $p->addRegistroImg($_POST, $_FILES, 'cursos', 'cursoId', 'imagem', '../assets/imgs/cursos');


} ?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Cadastrar Curso
            </header>
            <div class="warn"><?= $add ?></div>
            <div class="panel-body">
                <div class=" form">
                    <form action="" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"
                          enctype="multipart/form-data">

                        <div class="form-group hide">
                            <label class="control-label col-lg-2" for="cname">Nome </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="nome" id="cname" class="form-control ">
                            </div>
                        </div>


                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Título </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="titulo" id="cname"
                                       class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Categoria </label>
                            <div class="col-lg-10">
                                <?php $cats = $p->lista('categorias');
                                foreach ($cats as $cat) { ?>
                                    <input style="vertical-align: text-top;" name="categoriaId[]" type="checkbox"
                                           value="<?= $cat['categoriaId'] ?>"><label
                                            style="vertical-align: middle;font-weight: normal; margin:0px 13px 0px 5px"
                                            for=""><?= $cat['nome'] ?></label>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Categoria Principal </label>
                            <div class="col-lg-10">

                                <select name="categoria_principal" id="" class="form-control ">
                                    <?php $cats = $p->lista('categorias');
                                    foreach ($cats as $cat) { ?>
                                        <option value="<?= $cat['categoriaId'] ?>"><?= $cat['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Nivel </label>
                            <div class="col-lg-10">

                                <select name="nivel" id="" class="form-control ">
                                    <?php $nvs = $p->lista('niveis');
                                    foreach ($nvs as $nv) { ?>
                                        <option value="<?= $nv['nivelId'] ?>"><?= $nv['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Instrutor </label>
                            <div class="col-lg-10">

                                <select name="instrutorId" id="" class="form-control ">
                                    <?php $ins = $p->lista('instrutores');
                                    foreach ($ins as $in) { ?>
                                        <option value="<?= $in['instrutorId'] ?>"><?= $in['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Certificado </label>
                            <div class="col-lg-10">
                                <select name="certificado" id="" class="form-control " style="width:100px">
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Duração </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="duracao" id="cname" class="form-control"
                                       style="width:100px"> (horas)
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Valor </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="valor" id="cname" class="form-control"
                                       style="width:100px">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Plano Free </label>
                            <div class="col-lg-10">
                                <input type="radio" name="plano_free" id="cname" class="form-control"
                                       style="width:20px;display: inline-block;vertical-align: middle;" value="1">
                                <label for="">Sim</label> <br>
                                <input type="radio" name="plano_free" id="cname" class="form-control"
                                       style="width:20px;display: inline-block;vertical-align: middle;" value="0">
                                <label for="">Não</label>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Descricao </label>
                            <div class="col-lg-10">
                                <textarea name="descricao" id="descricao" class="form-control"></textarea>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label class="control-label col-lg-2">Banner <span
                                        class="tip">(1348px x 583px)</span></label>
                            <div class="col-md-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                             alt=""/>

                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px; line-height: 20px;">

                                    </div>
                                    <div>
<span class="btn btn-white btn-file">
<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagem</span>
<span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
<input type="file" name="banner" class="default"/>
</span>
                                        <a href="#" class="btn btn-danger fileupload-exists"
                                           data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Vídeo <span
                                        class="tip">Vimeo</span></label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="video" id="cname" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2">Imagem <span
                                        class="tip">(825px x 462px)</span></label>
                            <div class="col-md-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                             alt=""/>

                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px; line-height: 20px;">

                                    </div>
                                    <div>
<span class="btn btn-white btn-file">
<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagem</span>
<span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
<input type="file" name="imagem" class="default"/>
</span>
                                        <a href="#" class="btn btn-danger fileupload-exists"
                                           data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2">Imagem Miniatura <span
                                        class="tip">(260px x 190px)</span></label>
                            <div class="col-md-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                             alt=""/>

                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px; line-height: 20px;">

                                    </div>
                                    <div>
<span class="btn btn-white btn-file">
<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagem</span>
<span class="fileupload-exists"><i class="fa fa-undo"></i> Mudar</span>
<input type="file" name="thumb" class="default"/>
</span>
                                        <a href="#" class="btn btn-danger fileupload-exists"
                                           data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Permite visualizar aulas "Em Breve / Oculto" <span
                                        class="tip">Emails separados por ; </span></label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="emails_vizualiza_em_breve"
                                       id="emails_vizualiza_em_breve" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-danger">Cadastrar</button>
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
    CKEDITOR.replace('descricao', {
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
            {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
            {
                name: 'insert',
                items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
            '/',
            {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
            {name: 'colors', items: ['TextColor', 'BGColor']},
            {name: 'tools', items: ['Maximize', 'ShowBlocks']},
            {name: 'others', items: ['-']}

        ]
    });
</script>
