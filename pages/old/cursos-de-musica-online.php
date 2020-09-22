<?php

$chcktfre = null;
$cat_name = null;

$banner = $gm->getRegistro('banners', "sessao", "nossoscursos");
$bdPaginaCursos = $gm->getRegistro('pagina_cursos', 'id', 1);

if (!$banner) {
    $banner['imagem'] = "slide-tdm-1.jpg";
}

if ($csfree) {
    $css = $gm->obj('cursos', 'plano_free', 1);

    if (strpos($_SERVER['HTTP_REFERER'], "checkout/plano")) {
        $chcktfre = 1;
    }
} else {

    $categoriaId = isset($categoriaId) ? $categoriaId : null;

    $planfilter = " and plano_free = 0";

    if ($user->user()) {
        if ($gm->isFreeUser()) {
            $planfilter = '';
        }
    }

    if (isset($categoriaId)) {
        //$css = $gm->obj('cursos','categoriaId',$categoriaId,null,1);
        $css = (object) $gm->lista('cursos', " WHERE find_in_set( $categoriaId , categoriaId ) <> 0 $planfilter order by ordem");
    } else {
        $css = (object) $gm->lista('cursos', " WHERE cursoId <> 0 and categoriaId <> 7 $planfilter order by ordem");
    }

    $catcat = $gm->getRegistro('categorias', 'categoriaId', $categoriaId);
    if ($catcat) {
        $cat_name = "" . $catcat['nome'];
    }
}

?>

<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?= u ?>assets/imgs/<?= $banner['imagem'] ?>">
    <div class="titan-caption container">
        <div class="caption-content container">
            <div class="font-alt mb-80 titan-title-size-1"></div>
            <div class="font-alt mb-20 titan-title-size-4">
                <h1><?= $bdPaginaCursos['titulo'] ?></h1>
            </div>
        </div>
    </div>
</section>

<div class="main">
    <section class="">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="post-meta"><a href="<?= u ?>">Home</a> <a href="<?= u ?>cursos-de-musica-online">Cursos Online</a> <?= $cat_name ?> </div>
                </div>
            </div>


            <div class="row curso-box">
                <div class="col-sm-12 col-md-12">


                    <div class=" thim-course-top switch-layout-container mt-30" style="background: #c9302c;font-weight: bold">
                        <div style="display:none" class="thim-course-switch-layout switch-layout">
                            <a href="#" class="list switchToGrid switch-active"><i class="fa fa-th-large"></i></a>
                            <a href="#" class="grid switchToList"><i class="fa fa-list-ul"></i></a>
                        </div>
                        <div class="course-index">
                            <span style="color: #fff">Exibindo <?= count((array) $css) ?> de <?= count((array) $css) ?> resultados</span>
                        </div>
                        <div class="courses-searching" style="margin-left: 5px;">
                            <form method="get" action=" ">
                                <style>
                                    .custom-select {
                                        background: #c9302c;
                                        color: #fff;
                                        height: 35px;
                                        font-weight: bold;
                                        width: 100%;
                                        border: 1px solid #ff675b;
                                        border-radius: 0;
                                        padding-left: 10px;

                                        /* Removes the default <select> styling */
                                        -webkit-appearance: none;
                                        -moz-appearance: none;
                                        appearance: none;

                                        background-image:
                                            linear-gradient(45deg, transparent 50%, white 50%),
                                            linear-gradient(135deg, white 50%, transparent 50%);

                                        background-position:
                                            calc(100% - 20px) calc(1em + 2px),
                                            calc(100% - 15px) calc(1em + 2px),
                                            100% 0;

                                        background-size:
                                            5px 5px,
                                            5px 5px,
                                            2.5em 2.5em;
                                        background-repeat: no-repeat;


                                    }
                                </style>
                                <select name="" id="cat_filter" class="custom-select">
                                    <option value="">Categorias</option>
                                    <option value="todos">Todos os cursos</option>
                                    <?php foreach ($gm->obj('categorias') as $cat) {
                                        if ($cat['categoriaId'] != 7) { ?>
                                            <option rel="<?= ln($cat['nome']) ?>" value="<?= $cat['categoriaId'] ?>"><?= $cat['nome'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </form>
                            <ul class="courses-list-search list-unstyled"></ul>
                        </div>
                    </div>


                    <?php if ($chcktfre) { ?>
                        <div class="alert alert-success alert-block fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <h4>
                                <i class="fa fa-ok-sign"></i>
                                Inscrição realizada!
                            </h4>
                            <p>Veja aqui os cursos disponíveis para o seu plano, com vencimento
                                em: <?= data($user->planoAluno()->vencimento) ?></p>
                        </div>
                    <?php } ?>


                    <div class="row">
                        <div id="thim-course-archive" class=" thim-course-grid only-desktop">
                            <?php
                            $css2 = $css;
                            foreach ($css as $cs) {
                                include 'includes/box-curso.php';
                            } ?>
                        </div>

                        <div class="only-mobile">
                            <!-- mobile  -->
                            <?php
                            foreach ($css2 as $cs) {
                                $inst = $gm->obj('instrutores', 'instrutorId', $cs['instrutorId'], 1);
                                $cursoImg = $cs['thumb'] == '' ? 'assets/imgs/thumb.png' : "assets/imgs/cursos/" . $cs['thumb']; ?>
                                <div class="col-sm-12">
                                    <div class="card" style="width: 100%; background: #DCDCDC; margin-top: 20px">
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
            </div>
        </div>
    </section>


</div>

<section class="module bg-dark-60 mt-50 pt-0 pb-0 parallax-bg testimonial" data-background="assets/imgs/slide-tdm-1.jpg">
    <div class="testimonials-slider pt-50 pb-140 newsletter">
        <div class="caption-testimonial">Cadastre-se em nossa newsletter</div>

        <form id="mc4wp-form-3" method="post" data-id="3101" data-name="Default sign-up form">

            <div class="col-md-4 col-md-offset-3">
                <div class="alert alert-success" style="display:none;margin: 0 auto 3px;opacity: 0.6; width: 100%" role="alert">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong></strong> <span class="warn"></span>
                </div>
            </div>
            <div class="col-md-4"></div>

            <div class="col-md-4 col-md-offset-3">
                <input class="form-control" style="background: #fff; color: #d9534f" id="mc4wp_email" name="EMAIL" placeholder="Seu e-mail" required="" type="email">
            </div>
            <div class="col-md-2">
                <button type="submit" class="form-control btn-danger">CADASTRAR</button>
            </div>

            <label style="display: none !important;">Leave this field empty if you're human:
                <input name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" type="text"></label>
            <input name="_mc4wp_timestamp" value="1523490570" type="hidden"><input name="_mc4wp_form_id" value="3101" type="hidden">
            <input name="_mc4wp_form_element_id" value="mc4wp-form-3" type="hidden">
    </div>
    <div class="mc4wp-response"></div>
    </form>

    </div>
</section>
