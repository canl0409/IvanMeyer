<?php
$cs = $gm->getRegistro('cursos', 'cursoId', 7183, 1);

//$cs = $gm->getRegistro('cursos', 'cursoId', 53, 1);  // curso EM BREVE
$inst = $gm->getRegistro('instrutores', 'instrutorId', $cs['instrutorId']);
$cat = $gm->getRegistro('categorias', 'categoriaId', $cs['categoria_principal'] ? $cs['categoria_principal'] : $cs['categoriaId']);
$opinions = $gm->lista('opinioes', " where cursoId = '" . $cs['cursoId'] . "' ");
$qvd = count($gm->lista('aulas', " where video != '' and  cursoId = '" . $cs['cursoId'] . "' "));
$qads = count($gm->lista('aulas', " where audio != '' and  cursoId = '" . $cs['cursoId'] . "' "));
$qlei = count($gm->lista('aulas', " where texto != '' and  cursoId = '" . $cs['cursoId'] . "' "));

$qaulas = count($gm->lista('aulas', " where cursoId = '$cs[cursoId]'"));
$qfiles = $gm->countFiles($cs['cursoId']);

$countfree = count($gm->lista('aulas', " where cursoId = '$cs[cursoId]' and free='1' "));

$nivel = $gm->obj('niveis', 'nivelId', $cs['nivel'], 1)->nome;

foreach ($opinions as $opiniao) {
    $sum = $opiniao['nota'] + $sum;
}

if (count($opinions) > 0) {
    $nota = $sum / count($opinions);
}

?>

<?php if ($cs['banner'] != ''){ ?>
<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home"
         data-background="<?= u ?>assets/imgs/cursos/<?= $cs['banner'] ?>">
    <?php }else{ ?>
    <section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home"
             data-background="<?= u ?>assets/imgs/banner.png">
        <?php } ?>

        <div class="titan-caption container">
            <div class="caption-content container">
                <div class="font-alt mb-80 titan-title-size-1"></div>
                <div class="font-alt mb-20 titan-title-size-4"><?= $cs['titulo'] ?><br> <?= $nivel ?></div>
            </div>
        </div>
    </section>

    <div class="main">
        <section class="">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="post-meta"><a href="<?= u ?>">Home</a> <a href="#">Cursos</a> <?= $cs['titulo'] ?>
                        </div>
                    </div>
                </div>

                <div class="row curso-box">
                    <div class="col-sm-8 col-md-9">

                        <h1><?= $cs['titulo'] ?>
                            <?php if ($countfree > 0) { ?> <a class="csfreebt btn-primary btn-sm btn-success">Este curso
                                possui Aulas Free</a> <?php } ?>
                        </h1>


                        <div class="course-meta">
                            <div class="course-author" itemscope="" itemtype="http://schema.org/Person"><img alt=""
                                                                                                             src="<?= u ?>assets/imgs/team/<?= $inst['foto'] ?>"
                                                                                                             class="avatar avatar-40 photo"
                                                                                                             width="40"
                                                                                                             height="40">
                                <div class="author-contain">
                                    <label itemprop="jobTitle">Instrutor</label>
                                    <div class="value" itemprop="name"><a href="#"> <?= $inst['nome'] ?> </a></div>
                                </div>
                            </div>

                            <div class="course-categories">
                                <label>Categoria</label>
                                <div class="value"><span class="cat-links"><a href="#" rel="tag"><?= $cat['nome'] ?></a></span>
                                </div>
                            </div>

                            <div class="course-categories">
                                <label>Investimento</label>
                                <div class="value"><span class="cat-links"><a href="#"
                                                                              rel="tag"><?= money($cs['valor']) ?></a></span>
                                </div>
                            </div>

                            <div class="course-review">
                                <label>Opiniões</label>
                                <div class="value">
                                    <div class="starrr" rel="<?= $nota ?>"></div>
                                </div>
                            </div>
                        </div>

                        <div class="course-payment">
                            <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                <meta itemprop="priceCurrency" content="$">
                            </div>


                            <?php if ($cs['categoriaId'] != '6')/* em breve */ {
                                echo $user->courseButton($cs);
                            } ?>

                        </div>


                        <?php if ($cs['video']) { ?>
                            <div class="cvideo">
                                <iframe id="iframeVideoHome"
                                        src="<?= str_replace('vimeo.com/', 'player.vimeo.com/video/', $cs['video']) ?>"
                                        width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen
                                        allowfullscreen></iframe>
                            </div>
                        <?php } else {

                            if ($cs['imagem'] == '') { ?>
                                <div class="image-course"
                                     style="background-image: url('<?= u ?>assets/imgs/image.png')"></div>
                            <?php } else { ?>
                                <div class="image-course"
                                     style="background-image: url('<?= u ?>assets/imgs/cursos/<?= $cs['imagem'] ?>')"></div>
                            <?php } ?>


                        <?php } ?>

                        <div role="tabpanel" class="mt-30 mb-30" id="tabscurso">
                            <ul class="nav nav-tabs font-alt" role="tablist">
                                <li class="active"><a href="#descricao" data-toggle="tab"><span
                                                class="fas fa-bookmark"></span>Descrição</a></li>
                                <li><a href="#estrutura" id="tabstruture" data-toggle="tab"><span
                                                class="fab fa-codepen"></span> Conteúdo</a></li>
                                <li><a href="#instrutores" data-toggle="tab"><span class="fas fa-user"></span>Instrutores</a>
                                </li>
                                <li><a href="#opinioes" data-toggle="tab"><span class="fas fa-comments"></span>Opiniões</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="descricao">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?= $cs['descricao'] ?>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="detalhes-curso">
                                                <h3>Detalhes do curso</h3>

                                                <ul>
                                                    <li><i class="fas fa-copy"></i>
                                                        <div>Tópicos</div>
                                                        <span><?= $qaulas ?></span></li>
                                                    <li><i class="fas fa-caret-square-right"></i>
                                                        <div>Videos</div>
                                                        <span><?= $qvd ?></span></li>
                                                    <li><i class="fas fa-volume-down"></i>
                                                        <div>Áudios</div>
                                                        <span><?= $qads ?></span></li>
                                                    <li><i class="far fa-file-pdf"></i>
                                                        <div>Leituras</div>
                                                        <span><?= $qfiles ?></span></li>
                                                    <li><i class="fas fa-stopwatch"></i>
                                                        <div>Duração</div>
                                                        <span><?= $cs['duracao'] ?> horas</span></li>
                                                    <li><i class="fas fa-certificate"></i>
                                                        <div>Certificado</div>
                                                        <span><?= $cs['certificado'] ?></span></li>
                                                    <li><i class="fas fa-level-up-alt"></i>
                                                        <div>Nivel</div>
                                                        <span><?= $nivel ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="estrutura">
                                    <p class="info-aulas">Clique sobre cada aula para visualizar os seus conteúdos</p>

                                    <?php
                                    $modulos = $gm->lista('modulos', "  WHERE cursoId ='" . $cs['cursoId'] . "' order by orden ASC ");

                                    foreach ($modulos as $mod) {
                                        $modId = $mod['moduloId'];

                                        ?>
                                        <h2 class="modulotitle" rel="<?= $mod['moduloId'] ?>"><span
                                                    class="glyphicon glyphicon-plus btModuloPlus"></span> <?= $mod['nome'] ?>
                                        </h2>
                                        <ul class="section-content mod-content mod-<?= $mod['moduloId'] ?>">
                                            <?php $aulas = $gm->lista('aulas', " WHERE cursoId ='" . $cs['cursoId'] . "' and moduloId='$modId' order by orden ASC ");
                                            $aut = 0;
                                            foreach ($aulas as $au) {
                                                $aut = $aut + 1;
                                                ?>
                                                <li class="course-lesson course-item free-item preview-item "
                                                    rel="<?= $au['aulaId'] ?>"
                                                    data-course="<?= ln($cs['titulo']) ?>">
                                                    <div class="meta-left">
  <span class="course-format-icon"><i class="fas <?= tipoMidia($au['video'], $au['texto'], $au['audio'], 1) ?>"></i>
  </span>
                                                        <div class="index">
                                                            <span class="label"
                                                                  style="width:40px;"><?= tipoMidia($au['video'], $au['texto'], $au['audio']) ?></span><?= $aut ?>
                                                        </div>
                                                    </div>
                                                    <a style="display: inline"
                                                       class="lesson-title course-item-title button-load-item"
                                                       href="javascript:void(0)"><?= $au['titulo'] ?></a>
                                                    <div class="course-item-meta">

                                                        <?php if ($au['free'] == 1) { ?>
                                                            <a id="free" title="Previews"
                                                               class="  lesson-preview button-load-item tag-free"
                                                               href="javascript:void(0)">Free </a>
                                                        <?php } ?>


                                                        <a title="Previews" rel="au-<?= $au['aulaId'] ?>"
                                                           class="indviewed <?php if ($gm->viwedAula($au['aulaId'])) {
                                                               echo "aviwed";
                                                           } ?> lesson-preview button-load-item"
                                                           href="javascript:void(0)"> <i class="fas fa-check-circle"
                                                                                         aria-hidden="true"></i>
                                                        </a>


                                                        <span class="lp-icon item-status"></span></div>
                                                    <div class="meta only-desktop"><?= $au['duracao'] ?>minutos
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>

                                    <ul class="section-content" style="display: block;">
                                        <?php $aulas = $gm->lista('aulas', " WHERE cursoId ='" . $cs['cursoId'] . "' and moduloId='0' order by orden ASC ");
                                        $aut = 0;
                                        foreach ($aulas as $au) {
                                            $aut = $aut + 1;
                                            ?>
                                            <li class="course-lesson course-item free-item preview-item "
                                                rel="<?= $au['aulaId'] ?>" data-course="<?= ln($cs['titulo']) ?>">
                                                <div class="meta-left">
  <span class="course-format-icon"><i class="fas <?= tipoMidia($au['video'], $au['texto'], $au['audio'], 1) ?>"></i>
  </span>
                                                    <div class="index">
                                                        <span class="label"
                                                              style="width:40px;"><?= tipoMidia($au['video'], $au['texto'], $au['audio']) ?></span><?= $aut ?>
                                                    </div>
                                                </div>
                                                <a class="lesson-title course-item-title button-load-item"
                                                   href="javascript:void(0)"><?= $au['titulo'] ?></a>
                                                <div class="course-item-meta">
                                                    <?php if ($au['free'] == 1) { ?>
                                                        <a title="Previews"
                                                           class=" tag-free lesson-preview button-load-item"
                                                           href="javascript:void(0)">Free </a>
                                                    <?php } ?>


                                                    <a title="Previews" rel="au-<?= $au['aulaId'] ?>"
                                                       class="indviewed <?php if ($gm->viwedAula($au['aulaId'])) {
                                                           echo "aviwed";
                                                       } ?> lesson-preview button-load-item"
                                                       href="javascript:void(0)">
                                                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                                                    </a>


                                                    <span class="lp-icon item-status"></span></div>
                                                <div class="meta"><?= $au['duracao'] ?> minutos</div>
                                            </li>
                                        <?php } ?>
                                    </ul>


                                </div>

                                <div class="tab-pane" id="instrutores">
                                    <?php $inst = $gm->obj('instrutores', 'instrutorId', $cs['instrutorId'], 1); ?>
                                    <div class="thim-about-author">
                                        <div class="author-wrapper">
                                            <div class="author-avatar">
                                                <img alt="Admin bar avatar"
                                                     src="<?= u ?>assets/imgs/team/<?= $inst->foto ?>"
                                                     class="avatar avatar-110 photo" width="110" height="110">
                                            </div>
                                            <div class="author-bio">
                                                <div class="author-top">
                                                    <a class="name" href="#"> <?= $inst->nome ?> </a>
                                                    <p class="job">Professor(a)</p>
                                                </div>

                                                <div class="author-description"> <?= $inst->descricao ?></div>
                                            </div>
                                            <div class="author-description"> <?= $inst->descricao_m ?></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane content-review" id="opinioes">


                                    <ul class="course-reviews-list">
                                        <?php foreach ($opinions as $opn) { ?>
                                            <li>
                                                <div class="review-container" itemprop="itemReviewed" itemscope=""
                                                     itemtype="http://schema.org/Review">
                                                    <div class="review-author">
                                                        <img alt="avatar" src="<?= u ?>assets/imgs/avatar.png"
                                                             class="avatar avatar-70 photo" width="70" height="70">
                                                    </div>
                                                    <div class="review-text">
                                                        <h4 class="author-name" itemprop="author">
                                                            <?= $user->user($opn['alunoId']) ? $user->user($opn['alunoId'])->nome : $opn['titulo'] ?>
                                                        </h4>
                                                        <div class="review-star starrr" rel="<?= $opn['nota'] ?>">
                                                        </div>
                                                        <div class="description" itemprop="reviewBody">
                                                            <p><?= $opn['opiniao'] ?></p>
                                                        </div>
                                                    </div>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                    <input type='hidden' id='cursoUR' value="<?= ln($cs['titulo']) ?>"/>
                                    <?php if (isset($_SESSION['aluno'])) { ?>

                                        <form action="" class="form-control" style="height: auto;" id="opiniao">
                                            <h2>Deixe sua opinião</h2>

                                            <div class="alert alert-danger" style="display:none" role="alert">
                                                <button class="close" type="button" data-dismiss="alert"
                                                        aria-hidden="true">×
                                                </button>
                                                <strong></strong> <span class="warn"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Nota:</label>
                                                <div id="starate"></div>
                                                <input type='hidden' name='nota' id='valnota'/>
                                                <input type='hidden' name='cursoId' value="<?= $cs['cursoId'] ?>"/>


                                            </div>

                                            <div class="form-group">
                                                <textarea style="max-height: 150px;" class="form-control" rows="7"
                                                          id="message" name="opiniao" placeholder="Sua avaliação*"
                                                          required="required"
                                                          data-validation-required-message="Informe Sua mensagem"></textarea>
                                                <p class="help-block text-danger"></p>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="form-control btn " value="Enviar"
                                                       style="color:#fff">
                                            </div>

                                        </form>
                                        <script>
                                            $('#starate').starrr({
                                                change: function (e, value) {

                                                    $('#valnota').val(value);

                                                }
                                            });
                                        </script>
                                    <?php } ?>

                                </div>

                            </div>
                        </div>


                    </div>


                    <div class="col-sm-4 col-md-3">
                        <?php require_once('includes/right-cursos.php'); ?>
                    </div>

                </div>

            </div>
        </section>
    </div>


    <script>
        $(".starrr").each(function () {
            $($(this)).starrr({
                rating: $(this).attr('rel'),
                readOnly: true
            });
        });


        $('.csfreebt').click(function () {
            $("#tabstruture").click();

            $('html, body').animate({
                scrollTop: $("#tabscurso").offset().top - 50
            }, 2000);

        });

    </script>


    <div id="course-curriculum-popup" class="sidebar-hide" data-item-id="5431">
        <div id="popup-header">
            <div class="courses-searching">

            </div>
            <a class="popup-close"><i class="fa fas fa-times"></i></a>
        </div>
        <div id="popup-main">
            <div id="popup-content">
                <div id="popup-content-inner">
                </div>
            </div>
        </div>
        <div id="popup-sidebar">
            <nav class="thim-font-heading learn-press-breadcrumb" itemprop="breadcrumb">
                <a href="<?= u ?>cursos">Cursos</a> >
                <a href="<?= u ?>cursos/<?= $cat['categoriaId'] ?>/<?= ln($cat['nome']) ?>"><?= $cat['nome'] ?></a> >
                <span class="item-name"><?= $cs['titulo'] ?></span>
                <?php if ($user->isloged()) { ?>
                    <div class="pbar">
                        <?php $pgrss = $gm->cursoProgresso($cs['cursoId']); ?>
                        <div class="meter">
                            <div><?= $pgrss ?>%</div>
                            <span style="width: <?= $pgrss ?>%"></span>
                        </div>
                    </div>
                <?php } ?>
            </nav>
            <div class="course-curriculum" id="learn-press-course-curriculum">
                <div class="thim-curriculum-buttons"></div>
                <ul class="curriculum-sections">
                    <li class="section" id="section-222" data-id="222">
                        <ul class="section-content">
                            <?php
                            foreach ($modulos as $mod) { ?>
                                <h2 class="modulotitle" rel="<?= $mod['moduloId'] ?>"><?= $mod['nome'] ?></h2>
                                <?php
                                $modId = $mod['moduloId'];
                                $aulas = $gm->lista('aulas', " WHERE cursoId ='" . $cs['cursoId'] . "' and moduloId='$modId' order by orden ASC ");
                                $aut = 0;
                                foreach ($aulas as $au) {
                                    $aut = $aut + 1;
                                    ?>

                                    <li class="course-lesson course-item  free-item preview-item viewable  mod-content mod-<?= $mod['moduloId'] ?>"
                                        data-type="lp_lesson" id="au<?= $au['aulaId'] ?>" rel="<?= $au['aulaId'] ?>">
                                        <div class="meta-left"> <span class="course-format-icon">
  <i class="fas <?= tipoMidia($au['video'], $au['texto'], $au['audio'], 1) ?>"></i>
  </span>
                                            <div class="index">
                                                <span class="label"><?= tipoMidia($au['video'], $au['texto'], $au['audio']) ?></span>1.<?= $aut ?>
                                            </div>
                                        </div>
                                        <a class="lesson-title course-item-title button-load-item"
                                           href="javascript:void(0)"><?= $au['titulo'] ?>

                                        </a>
                                        <div class="course-item-meta">


                                            <a title="Previews" rel="au-<?= $au['aulaId'] ?>"
                                               class="indviewed <?php if ($gm->viwedAula($au['aulaId'])) {
                                                   echo "aviwed";
                                               } ?> lesson-preview button-load-item" href="javascript:void(0)"> <i
                                                        class="fas fa-check-circle" aria-hidden="true"></i>
                                            </a>


                                            <span class="lp-icon item-status"></span>
                                        </div>
                                        <div class="meta"><?= $au['duracao'] ?> minutos</div>
                                    </li>
                                    <?php
                                }
                                ?>

                            <?php } ?>



                            <?php
                            $aulas = $gm->lista('aulas', " WHERE cursoId ='" . $cs['cursoId'] . "' and moduloId='0' order by orden ASC ");
                            $aut = 0;
                            foreach ($aulas as $au) {
                                $aut = $aut + 1;
                                ?>

                                <li class="course-lesson course-item  free-item preview-item viewable"
                                    data-type="lp_lesson" id="au<?= $au['aulaId'] ?>" rel="<?= $au['aulaId'] ?>">
                                    <div class="meta-left"> <span class="course-format-icon">
  <i class="fas <?= tipoMidia($au['video'], $au['texto'], $au['audio'], 1) ?>"></i>
  </span>
                                        <div class="index">
                                            <span class="label"><?= tipoMidia($au['video'], $au['texto'], $au['audio']) ?></span>1.<?= $aut ?>
                                        </div>
                                    </div>
                                    <a class="lesson-title course-item-title button-load-item"
                                       href="javascript:void(0)"><?= $au['titulo'] ?>

                                    </a>
                                    <div class="course-item-meta">


                                        <a title="Previews" rel="au-<?= $au['aulaId'] ?>"
                                           class="indviewed <?php if ($gm->viwedAula($au['aulaId'])) {
                                               echo "aviwed";
                                           } ?> lesson-preview button-load-item" href="javascript:void(0)"> <i
                                                    class="fas fa-check-circle" aria-hidden="true"></i>
                                        </a>


                                        <span class="lp-icon item-status"></span>
                                    </div>
                                    <div class="meta"><?= $au['duracao'] ?> minutos</div>
                                </li>
                                <?php
                            }
                            ?>


                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <button style="display:none" class="modalbt btavisos" rel="avisos"></button>

    <script type="text/javascript">
        $('.modulotitle').click(function () {
            $(this).find('span').toggleClass('glyphicon-plus').toggleClass('glyphicon-minus');
        });
    </script>
