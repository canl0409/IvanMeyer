<?php
$add = null;


if (isset($_POST['upid'])) {

    $add =  $p->updateRegistro($_POST, 'categorias_planos', 'categoriaId', $_POST['upid']);
}



if (isset($_GET['pid'])) {
    $pd =  $p->getRegistro('categorias_planos', 'categoriaId', $_GET['pid']);
}


?>
<style>
    .icones-planos div {
        display: inline-block;
        margin-right: 20px;
        border: solid 1px #eee;
        border-radius: 5px;
        padding: 10px;
    }

    .icones-planos div img {
        width: 35px;
    }
</style>

<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Editar categoria de plano

                <a href="index.php?categoria_plano_add"><button class="btn pull-right btn-danger">Voltar</button></a>
            </header>

            <div class="warn"><?= $add ?></div>
            <div class="panel-body">
                <div class=" form">
                    <form action="?categoria_plano_edit&pid=<?= $_GET['pid'] ?>" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $pd['categoriaId'] ?>" name="upid">
                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Nome </label>
                            <div class="col-lg-10">
                                <input type="text" required="" minlength="2" name="nome" id="cname" value="<?= $pd['nome'] ?>" class="form-control ">
                            </div>
                        </div>



                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Keywords </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="keywords" value="<?= $pd['keywords'] ?>" class="form-control ">
                            </div>
                        </div>


                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Descricao </label>
                            <div class="col-lg-10">
                                <textarea name="description" class="form-control "><?= $pd['description'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Vídeo descrição </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="video" value="<?= $pd['video'] ?>" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Mais Vídeos 1 </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="video1" value="<?= $pd['video1'] ?>" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Mais Vídeos 2 </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="video2" value="<?= $pd['video2'] ?>" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Mais Vídeos 3 </label>
                            <div class="col-lg-10">
                                <input type="text" minlength="2" name="video3" value="<?= $pd['video3'] ?>" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Professores </label>
                            <div class="col-lg-10">
                                <?php $cats = $p->lista('instrutores');

                                $eprofs = explode(',', $pd['professores']);
                                foreach ($cats as $cat) { ?>
                                    <input <?php if (in_array($cat['instrutorId'], $eprofs)) {
                                                echo 'checked ="checked"';
                                            } ?> style="vertical-align: text-top;" name="professores[]" type="checkbox" value="<?= $cat['instrutorId'] ?>"><label style="vertical-align: middle;font-weight: normal; margin:0px 13px 0px 5px" for=""><?= $cat['nome'] ?></label>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label class="control-label col-lg-2" for="cname">Imagem(Icone) </label>
                            <div class="col-lg-10 icones-planos">
                                <div>
                                    <input <?= ($pd['icone'] == 'pianoPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="pianoPrimary.png">
                                    <img src="../assets/img/pianoPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'violaoPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="violaoPrimary.png">
                                    <img src="../assets/img/violaoPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'harmoniaPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="harmoniaPrimary.png">
                                    <img src="../assets/img/harmoniaPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'improvisacaoPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="improvisacaoPrimary.png">
                                    <img src="../assets/img/improvisacaoPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'bateriaPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="bateriaPrimary.png">
                                    <img src="../assets/img/bateriaPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'percussaoPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="percussaoPrimary.png">
                                    <img src="../assets/img/percussaoPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'teoriaPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="teoriaPrimary.png">
                                    <img src="../assets/img/teoriaPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'todoscursosPrimary.png') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="todoscursosPrimary.png">
                                    <img src="../assets/img/todoscursosPrimary.png" alt="">
                                </div>
                                <div>
                                    <input <?= ($pd['icone'] == 'baixo.jpg') ? 'checked="checked"' : '' ?> type="radio" id="icone" name="icone" value="baixo.jpg">
                                    <img src="../assets/img/baixo.jpg" alt="">
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

<!--script for this page-->
<script src="js/form-validation-script.js"></script>
