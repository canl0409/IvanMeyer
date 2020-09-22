<?php
$add = null;
$bid = ($_POST['upid']) ? $_POST['upid'] : $_GET['pid'];

if (isset($_POST['upid'])) {
    $folder = ($_POST['sessao'] != 'home') ? '../assets/images/' : '../assets/imgs/';
    //$add =  $p->updateRegistro($_POST,'admin','adminId',$_SESSION['radmin']);
    $add =  $p->updateRegistroImg($_POST, $_FILES, 'banners', 'bannerId', $_POST['upid'], 'imagem', $folder);
}

if (isset($_SESSION['radmin'])) {
    $pd =  $p->getRegistro('banners', 'bannerId', $bid);
    $folder = ($pd['sessao'] != 'home') ? 'images' : 'imgs';
}


?>


<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Editar Banner
            </header>

            <div class="warn"><?= $add ?></div>
            <div class="panel-body">
                <div class=" form">
                    <form action="?banner_home_edit" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" novalidate="novalidate" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $pd['bannerId'] ?>" name="upid">


                        <div class="form-group hide">
                            <label class="control-label col-lg-2" for="cname">Vídeo <span class="tip">(Youtube)</span> </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="video" id="cname" value="<?= $pd['video'] ?>" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Sessão</label>
                            <div class="col-lg-10">
                                <select name="sessao" id="" class="form-control ">
                                    <option <?php if ($pd['sessao'] == 'home') {
                                                echo "selected='selected'";
                                            } ?> value="home">Home</option>
                                    <?php $cps = $p->lista('categorias_planos');
                                    foreach ($cps as $cp) {
                                    ?>
                                        <option <?php if ($pd['sessao'] == 'plano' . $cp['categoriaId']) {
                                                    echo "selected='selected'";
                                                } ?>value="plano<?= $cp['categoriaId'] ?>"><?= $cp['nome'] ?> (plano<?= $cp['categoriaId'] ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2">Imagem <span class="tip">(1348px x 583px)</span></label>
                            <div class="col-md-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                        <?php if ($pd['imagem']) { ?>
                                            <img src="../assets/<?= $folder ?>/<?= $pd['imagem'] ?>" alt="" style="max-width: 200px; max-height: 150px; line-height: 20px;">
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
                                            <input type="file" name="imagem" class="default" />
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Titulo</span> </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="titulo" id="cname" value="<?= $pd['titulo'] ?>" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Texto 1</span> </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="texto1" id="cname" value="<?= $pd['texto1'] ?>" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Texto 2</span> </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="texto2" id="cname" value="<?= $pd['texto2'] ?>" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Texto Botão</span> </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="texto_botao" id="cname" value="<?= $pd['texto_botao'] ?>" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Link Botão</span> </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="link_botao" id="cname" value="<?= $pd['link_botao'] ?>" class="form-control ">
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

<!--script for this page-->
<script src="js/form-validation-script.js"></script>


<script>
    $('#catId').change(
        function() {
            console.log(this.value);


            $('#catId #' + this.value).filter(':contains(Pizza)').each(function() {
                console.log('tem pzizza');
                $('#atributos').css('display', 'block');
            });

            $('#catId #' + this.value).not(':contains(Pizza)').each(function() {
                $('#atributos').css('display', 'none');
                console.log('nott pzizza');
                $('.atprecos').val('');
            });

        });
</script>
