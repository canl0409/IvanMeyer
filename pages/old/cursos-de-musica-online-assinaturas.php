<?php $banner =  $gm->getRegistro('banners', 'bannerId', 13);
$bdPaginaPlanos =  $gm->getRegistro('pagina_planos', 'id', 1);
?>


<style type="text/css">
    @media only screen and (max-width: 480px) {

        .cursos-acessados .module-subtitle {
            margin-bottom: -10px !important;
        }

        .multiple-items-curses {
            display: none;
        }
    }
</style>
<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?= u ?>assets/imgs/<?= $banner['imagem'] ?>">
    <div class="titan-caption container">
        <div class="caption-content container">
            <div class="font-alt mb-80 titan-title-size-1"></div>
            <div class="font-alt mb-20 titan-title-size-4">
                <h1>Cursos Online: Planos e Preços<h1>
            </div>
        </div>
    </div>
</section>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="post-meta"><a href="<?= u ?>">Home</a> Planos</div>
            </div>
        </div>
    </div>

    <section class="module " style="padding: 20px 0px">
        <div class="container">
            <div class="col-xs-12 col-md-7" align="center">
                <h2 class="module-title font-alt mt-10" style="font-size:32px">ESCOLHA A CATEGORIA E VEJA OS PLANOS</h2>
                <div class="module-subtitle large-text mt-20">Tenha acesso ILIMITADO a TODOS os<br> cursos
                    da escola ou apenas <br> àqueles de uma categoria da sua escolha.</div>
            </div>

            <div class="col-xs-12 col-md-5" align="center">
                <iframe width="100%" style="margin:0 auto; min-height: 290px" src="<?= $bdPaginaPlanos['video_url'] ?>" frameborder=\"0\" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section class="module" style="margin-top: -5px; background-color: #191631;padding: 20px 0px">
        <div class="container">
            <div class="col-lg-12" align="center" style="background-color: #191631">
                <ul class="list-inline iconsbanner mt-20 row">
                    <li class="col-xs-6 col-md-2">
                        <a href="<?= u ?>cursos-de-musica-online-assinaturas/6/todos"><img src="<?= u ?>assets/imgs/todoscursos.png" alt="">
                            <span>Todos os cursos</span>
                        </a>
                    </li>
                    <li class="col-xs-6 col-md-2">
                        <a href="<?= u ?>cursos-de-musica-online-assinaturas/1/piano_e_teclado"><img src="<?= u ?>assets/imgs/piano.png" alt="">
                            <span>Piano e Teclado</span>
                        </a>
                    </li>
                    <li class="col-xs-6 col-md-2">
                        <a href="<?= u ?>cursos-de-musica-online-assinaturas/2/violao_e_guitarra"><img src="<?= u ?>assets/imgs/violao.png" alt="">
                            <span>Violão e Guitarra</span>
                        </a>
                    </li>
                    <li class="col-xs-6 col-md-2">
                        <a href="<?= u ?>cursos-de-musica-online-assinaturas/3/bateria_e_percucao"><img src="<?= u ?>assets/imgs/bateria.png" alt="">
                            <span>Bateria e Percussão</span>
                        </a>
                    </li>
                    <li class="col-xs-6 col-md-2">
                        <a href="<?= u ?>cursos-de-musica-online-assinaturas/4/harmonia_e_teoria"><img src="<?= u ?>assets/imgs/harmonia.png" alt="">
                            <span> Harmonia e Teoria</span>
                        </a>
                    </li>
                    <li class="col-xs-6 col-md-2">
                        <a href="<?= u ?>cursos-de-musica-online-assinaturas/5/improvisacao"><img src="<?= u ?>assets/imgs/improvisacao.png" alt="">
                            <span>Improvisação</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </section>



    <section class="module hide" id="about" style="padding-bottom: 0">
        <div class="container">
            <div class="row cursos-online center">
                <div class="col-md-8 col-md-offset-2">
                    <iframe width="100%" style="margin:0 auto; min-height: 400px;" src="<?= $bdPaginaPlanos['video_url'] ?>" frameborder=\"0\" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <?php

    $planoId = isset($qrs[2]) ? $qrs[2] : 1;
    $qc = " and categoriaId = '" . $planoId . "' ";
    $detalhesDoPlano =  $gm->getRegistro('categorias_planos', 'categoriaId', $planoId);

    ?>

    <section class="module" id="planos" style="padding-bottom: 0">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <h2 class="module-title font-alt"><? //=$bdPaginaPlanos['texto1']
                                                        ?></h2>
                    <div class="module-subtitle large-text">Veja todos os planos da categoria <b><?= $detalhesDoPlano['nome'] ?></b> <? //=$bdPaginaPlanos['texto2']
                                                                                                                                        ?></div>
                </div>
            </div>
        </div>
    </section>

    <section class="module div-plans" style="padding: 0">
        <div class="container">
            <div class="row multi-columns-row div-plans">

                <?php

                $plans = $gm->lista('planos', " where exibir_pageplano = '1'  $qc");
                $btnColors = ["btn-green", "btn-blue", "btn-red"];
                $count = 0;
                foreach ($plans as $pl) {
                    $isPlanfre = ($pl['valor'] == 0) ? 1 : 0;
                    $cursos = $gm->lista('cursos', " where cursoId in (" . $pl['cursos'] . ") and categoriaId != '7' and plano_free  = $isPlanfre ", false);
                    $allUnic .= $pl['cursos'] . ',';
                ?>

                    <?php if ($pl['nome'] != 'Teste') { ?>
                        <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4
                        <?php if (count($plans) < 2 && $count == 0) {  ?> col-sm-offset-3 col-md-offset-2 col-lg-offset-2 <?php } ?> np">
                            <div class="price-table font-alt">

                                <h4><?= $pl['nome'] ?></h4>
                                <div class="priceInner">
                                    <?php if (isset($pl['valor_antigo'])) {  ?>
                                        <div class="oldprice">
                                            <span>de</span>
                                            <?php echo isset($pl['valor_antigo']) ? money($pl['valor_antigo']) : '' ?>
                                            <p>em oferta por apenas:</p>
                                        </div>
                                    <?php } ?>


                                    <p class="price">
                                        <?php
                                        echo money($pl['valor']);
                                        ?>
                                    </p>

                                    <p class="price price2">
                                        <?php if ($pl['valor'] > 0) {
                                            echo money($pl['valor'] / $pl['parcelas']) . ' ao mês';
                                        }
                                        ?>
                                    </p>


                                    <p class="periodo"><?php if ($pl['valor'] == 0) {
                                                            echo $pl['dias'];
                                                        } ?></p>


                                    <p class="pagamento lower">
                                        <?php if ($pl['valor'] == 0) {  ?>
                                            Comece a estudar agora!
                                        <?php } else {
                                            echo $pl['parcelas'] . "x de " . money($pl['valor'] / $pl['parcelas']);
                                        }
                                        ?>
                                    </p>
                                    <a class="btn btn-danger btn-plan <?= $btnColors[$count] ?>" rel="<?= $pl['planoId'] ?>" href="/cart/assinar.php?plano=<?= $pl['planoId'] ?>">Escolher</a>
                                    <?php $count++ ?>
                                </div>


                                <ul class="price-details">

                                    <li class="maior">
                                        <?php if ($pl['caracteristicas']) { ?><i class="fas fa-video"></i><?php }  ?>
                                        <?= $pl['caracteristicas'] ?></li>
                                    <li class="black">
                                        <?php if ($pl['caracteristica2']) { ?><i class="far fa-address-card"></i><?php }  ?>
                                        <?= $pl['caracteristica2'] ?></li>
                                    <li>
                                        <?php if ($pl['caracteristica3']) { ?> <i class="fas fa-desktop"></i> <?php }  ?>
                                        <?= $pl['caracteristica3'] ?></li>

                                    <li>
                                        <button title="Ver Cursos" id="cursosp_<?= $pl['planoId'] ?>" class="openCursos btn-blue"> <?= count($cursos) ?> cursos <i class="fas fa-eye"></i> </button>
                                    </li>

                                </ul>

                                <div class="hide cursosp_<?= $pl['planoId'] ?>">
                                    <?php $ccb = 1;
                                    foreach ($cursos as $cursosPlano) {
                                        echo "<div class='line-lista-cursos'>" . $cursosPlano['titulo'] . "</div>";
                                    } ?>
                                </div>

                            </div>
                        </div>

                    <?php }  // if
                    ?>
                <?php } // foreach
                ?>

            </div>
        </div>
    </section>

    <?php

    $numIds2 = array_unique(array_map('intval', explode(',', $allUnic)));
    $inId2 = implode("','", $numIds2);

    ?>
    <section class="module cursos-acessados">
        <div class="container">
            <div class="module-subtitle large-text center" style="margin-bottom:30px;color:#444;margin-top: 21px;">
                Veja todos os cursos dessa categoria:
            </div>
            <div class="row">
                <div id="thim-course-archive only-desktop" class="thim-course-grid thim-course-grid-home multiple-items-curses">
                    <?php $css2 = $css = $gm->lista('cursos', "where cursoId in ('" . $inId2 . "') and plano_free = 0 and categoriaId != '7'");
                    foreach ($css as $cs) {
                        include 'includes/box-curso.php';
                    }
                    ?>
                </div>

                <div class="only-mobile">
                    <!-- mobile  -->
                    <?php
                    foreach ($css2 as $cs) {
                        $inst = $gm->obj('instrutores', 'instrutorId', $cs['instrutorId'], 1);
                        $cursoImg = $cs['thumb'] == '' ? 'assets/imgs/thumb.png' : "assets/imgs/cursos/" . $cs['thumb']; ?>
                        <div class="col-sm-12">
                            <div class="card" style="width: 100%; background: #fff; margin-top: 20px">
                                <a href="<?= u ?>curso-de-musica-online/<?= ln($cs['titulo']) ?>">
                                    <img style="margin: 0; z-index: -99" class="card-img-top" src="<?= u . $cursoImg ?>" width="100%">
                                </a>
                                <div class="card-body">
                                    <div style="width: 40px; margin: -20px auto 0 auto; display: block; z-index: 9999">
                                        <img style="border-radius: 50%; border: 2px solid #fff; margin: 0" src="<?= u ?>assets/imgs/team/<?= $inst->foto ?>" class="avatar avatar-40 photo" width="40" height="40">
                                    </div>
                                    <p style="text-align: center"><?= $inst->nome ?></p>
                                    <a href="<?= u ?>curso-de-musica-online/<?= ln($cs['titulo']) ?>">
                                        <h5 style="font-weight: 800; text-align: center"><?= $cs['titulo'] ?></h5>
                                    </a>
                                    <br />
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="module" id="banner-landpage">
        <div class="container">
            <div class="row"><a href="<?= $detalhesDoPlano['landpage'] ?>">
                    <div class="aviso">
                        <p>Saiba mais sobre o plano e suas vantagens!</p>
                        <a href="<?= $detalhesDoPlano['landpage'] ?>">CLIQUE AQUI</a>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="module" id="text-box-home">
        <div class="container">
            <div class="row">

                <div class="col-sm-6">
                    <img src="<?= u ?>assets/imgs/astronauta.jpeg" alt="">
                    <h2 class=""><?= $bdPaginaPlanos['texto_boneco_1'] ?></h2>
                    <p><?= $bdPaginaPlanos['subtexto_boneco_1'] ?></p>
                </div>

                <div class="col-sm-6">
                    <img src="<?= u ?>assets/imgs/foguete.jpeg" alt="">
                    <h2 class=""><?= $bdPaginaPlanos['texto_boneco_2'] ?></h2>
                    <p><?= $bdPaginaPlanos['subtexto_boneco_2'] ?></p>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-6">
                    <img src="<?= u ?>assets/imgs/mundo.jpeg" alt="">
                    <h2 class=""><?= $bdPaginaPlanos['texto_boneco_3'] ?></h2>
                    <p><?= $bdPaginaPlanos['subtexto_boneco_3'] ?></p>
                </div>

                <div class="col-sm-6">
                    <img src="<?= u ?>assets/imgs/foguete2.jpeg" alt="">
                    <h2 class=""><?= $bdPaginaPlanos['texto_boneco_4'] ?></h2>
                    <p><?= $bdPaginaPlanos['subtexto_boneco_4'] ?></p>
                </div>

            </div>

        </div>
    </section>

    <section class="module" id="team">
        <div class="container mt-40">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt"><?= $bdPaginaPlanos['texto3'] ?></h2>
                    <div class="module-subtitle large-text" style="margin-bottom:0px;"><?= $bdPaginaPlanos['texto4'] ?></div>
                </div>
            </div>

        </div>
    </section>
    <section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial" data-background="assets/imgs/slide-tdm-1.jpg">
        <div class="testimonials-slider pt-50 pb-140">
            <div class="caption-testimonial"><?= $bdPaginaPlanos['texto5'] ?></div>
            <ul class="slides">
                <?php $alu = $gm->lista('depoimentos', " where status = 1");
                foreach ($alu as $al) { ?>
                    <li>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="user-name-dep"><?= $al['nome'] ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <blockquote class="testimonial-text font-alt"><?= $al['depoimento'] ?></blockquote>
                                    <?php $cur = $gm->getRegistro('cursos', 'cursoId', $al['cursoId']); ?>
                                    <div class="testimonial-curso"><?= $cur['titulo'] ?></div>
                                </div>
                            </div>

                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.slide').hover(
                function() {
                    $(this).find('.caption').slideDown(250);
                },
                function() {
                    $(this).find('.caption').slideUp(250);
                }
            );
        });
    </script>

    <script src="<?= u ?>assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="<?= u ?>assets/js/slick.js"></script>
    <script>
        $('.multiple-items-curses').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4
        });
    </script>


    <script type="text/javascript">
        $(document).on('click', '.openCursos', function() {
            let content = $('.' + $(this).attr('id')).html();
            $("#modal_cursos .modal-content").html(content);
            $('#modal_cursos').modal('show');
        });
    </script>
