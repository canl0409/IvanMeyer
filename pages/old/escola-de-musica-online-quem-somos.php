<?php
$dsn = $gm->getRegistro('quem_somos', 'id', 1);
$banner = $gm->getRegistro('banners', "sessao", "sobrenos");

if (!$banner) {
    $banner['imagem'] = "slide-tdm-1.jpg";
}
?>

<style>
    .frase p {
        text-align: center !important;
    }
</style>
<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home"
         data-background="<?= u . "assets/imgs/" . $banner['imagem'] ?>">
    <div class="titan-caption container">
        <div class="caption-content container">
            <div class="font-alt mb-80 titan-title-size-1"></div>
            <div class="font-alt mb-20 titan-title-size-4"><h1>Sobre Nós</h1></div>
        </div>
    </div>
</section>

<div class="main mb-20">

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="post-meta"><a href="<?= u ?>">Home</a> Sobre Nós</div>
            </div>
        </div>

        <div class="row mt-50">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="module-title font-alt">Nossa Historia na música</h2>
                <div class="module-subtitle  large-text">Conheça nossos números.</div>
            </div>
        </div>

        <div class="row who-numbers">
            <div class="col-md-3">
                <h3 class="counter">44.459</h3>
                <span>Seguidores</span>
            </div>
            <div class="col-md-3">
                <h3 class="counter"><?= $gm->countVideos() + 500 ?></h3>
                <span>Vídeos diponíveis</span>
            </div>
            <div class="col-md-3">
                <h3 class="counter"><?= $gm->countUser() + 10000 ?></h3>
                <span>Estudantes Matriculados</span>
            </div>
            <div class="col-md-3">
                <h3 class="counter">23.897</h3>
                <span>Vídeos assistidos por mês</span>
            </div>
        </div>

        <div class="row mt-30">
            <div class="col-md-12">
                <div class="flexslider" style="margin-bottom: 20px;">
                    <ul class="slides">
                        <li>
                            <img src="<?= u ?>assets/imgs/terra-da-musica-cursos-online-equipe.jpg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if ($dsn['frase']) { ?>
            <div class="row mt-60 mb-40 frase">
                <div class="col-sm-8 col-sm-offset-2">
                    <h2 style="text-align:center" class="module-title font-alt"><?= $dsn['frase'] ?></h2>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-6">
                <h4 class="bl">Quem Somos</h4>
                <p><?= $dsn['texto_1'] ?></p>
            </div>
            <div class="col-md-6">
                <h4 class="bl">O que Fazemos</h4>
                <p><?= $dsn['texto_2'] ?> </p>

            </div>
        </div>


    </div>
</div>

<div class="container">

    <hr/>

    <div class="row mt-30 mb-70">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt">Conheça nossa Equipe</h2>
            <div class="module-subtitle large-text" style="margin-bottom:0px;">Time Terra da Música</div>
            <h2 class="text-center">Professores</h2>
        </div>
    </div>


    <div class="row">

        <?php $ins = $gm->lista('instrutores', " where tipo = 'professor' ");
        foreach ($ins as $in) { ?>
            <div class="our-team-item our-team-item-pf col-sm-3">
                <a href="<?= u ?>professor/<?= ln($in['nome']) ?>">
                    <div class="our-team-image our-team-image-pf ">
                        <img src="<?= u ?>assets/imgs/team/<?= $in['foto'] ?>" alt="team-7" title="team-7" width="200"
                             height="200">
                    </div>
                </a>
                <div class="content-team">
                    <h4 class="title"><?= $in['nome'] ?></h4>
                    <div class="regency"><?= $in['descricao'] ?></div>
                </div>
            </div>
        <?php } ?>


        <div class="row mt-70 mb-70">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center">Colaboradores</h2>
            </div>
        </div>

        <?php $ins = $gm->lista('instrutores', " where tipo = 'colaborador' ");
        foreach ($ins as $in) { ?>
            <div class="our-team-item col-sm-3">
                <div class="our-team-image">
                    <img src="<?= u ?>assets/imgs/team/<?= $in['foto'] ?>" alt="team-7" title="team-7" width="200"
                         height="200">
                    <div style="display:none" class="social-team"><a target="_blank" href="#">
                            <i class="fab fa-facebook"></i></a><a target="_blank" href="#">
                            <i class="fab fa-twitter"></i></a><a target="_blank" href="#">
                            <i class="fab fa-dribbble"></i></a><a target="_blank" href="#">
                            <i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="content-team">
                    <h4 class="title"><?= $in['nome'] ?></h4>
                    <div class="regency"><?= $in['descricao'] ?></div>
                </div>
            </div>
        <?php } ?>


    </div>
</div>


<section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial" data-background="assets/imgs/slide-tdm-1.jpg">
    <div class="testimonials-slider pt-50 pb-140 newsletter">
        <div class="caption-testimonial">Cadastre-se em nossa newsletter</div>

        <form id="mc4wp-form-3" method="post" data-id="3101" data-name="Default sign-up form">

            <div class="col-md-4 col-md-offset-3">
                <div class="alert alert-success" style="display:none;margin: 0 auto 3px;opacity: 0.6; width: 100%"
                     role="alert">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong></strong> <span class="warn"></span>
                </div>
            </div>
            <div class="col-md-4"></div>

            <div class="col-md-4 col-md-offset-3">
                <input class="form-control" style="background: #fff; color: #d9534f" id="mc4wp_email" name="EMAIL"
                       placeholder="Seu e-mail" required="" type="email">
            </div>
            <div class="col-md-2">
                <button type="submit" class="form-control btn-danger">CADASTRAR</button>
            </div>

            <label style="display: none !important;">Leave this field empty if you're human:
                <input name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" type="text"></label>
            <input name="_mc4wp_timestamp" value="1523490570" type="hidden"><input name="_mc4wp_form_id" value="3101"
                                                                                   type="hidden">
            <input name="_mc4wp_form_element_id" value="mc4wp-form-3" type="hidden">
    </div>
    <div class="mc4wp-response"></div>
    </form>

    </div>
</section>


<script>
    jQuery(document).ready(function ($) {

        $(".flexslider").flexslider({
            animation: "slide",
            touch: true,
            directionNav: true,
            prevText: '',
            nextText: ''
        });

        $('.counter').each(function () {
            var $this = $(this),
                countTo = $this.text();

            $({countNum: 0}).animate({
                    countNum: countTo
                },

                {

                    duration: 4000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
//alert('finished');
                    }

                });
        });
    });
</script>
