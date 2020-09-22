<?php $banners = $gm->getRegistro('banners', 'bannerId', 1);
$home_video = $gm->getRegistro('banners', 'bannerId', 4);
$bdPaginaPlanos = $gm->getRegistro('pagina_planos', 'id', 1);
?>

<style>
    .tv {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;

        width: 100%;
        height: 100%;

        overflow: hidden;

    .screen {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;

        margin: auto;

        opacity: 0;
        transition: opacity .5s;

    &
    .active {
        opacity: 1;
    }

    }
    } </style>


<?php if ($banners['video']){
$ytcode = ytcode($banners['video']);
?>

<section class="home-section home-parallax home-fade bg-dark-30" id="home"
         data-background="https://img.youtube.com/vi/<?= $ytcode ?>/maxresdefault.jpg">

    <div class="video-player"
         data-property="{videoURL:'<?= $banners['video'] ?>', containment:'.home-section', startAt:1, mute:false, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}"></div>


    <div class="tv" style="display:none">
        <div class="screen mute" id="tv"></div>
    </div>


    <div class="video-controls-box">
        <div class="container">
            <div class="video-controls" style="display:none"><a class="fa fa-volume-up" id="video-volume" href="#">&nbsp;</a><a
                        class="fa fa-pause" id="video-play" href="#">&nbsp;</a></div>
        </div>
    </div>
    <?php }else{ ?>
    <section class="home-section home-parallax home-fade bg-dark-30" id="home"
             data-background="assets/imgs/<?= $banners['imagem'] ?>">

        <?php } ?>

        <div class="titan-caption container">
            <div class="caption-content container">
                <div class="font-alt mb-80 titan-title-size-1"></div>
                <div class="font-alt mb-20 titan-title-size-4"><h1>Curso online<br> revolucione a sua forma de aprender
                        música!</h1></div>
                <a class="section-scroll btn btn-danger btn-lg btn-round pull-left mb-60" href="#about">Saiba Mais +</a>
                <a class="section-scroll btn btn-danger btn-lg btn-round pull-left mb-60"
                   href="<?= u ?>cursos-de-musica-online">Conheça nossos cursos</a>
                <ul class="list-inline iconsbanner mt-20 only-desktop">
                    <li>
                        <a href="<?= u ?>cursos-de-musica-online/2/piana_e_teclado"><img src="assets/imgs/piano.png"
                                                                                         alt="">
                            <span>Piano e Teclado</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= u ?>cursos-de-musica-online/1/violao_e_guitarra"><img src="assets/imgs/violao.png"
                                                                                           alt="">
                            <span>Violão e Guitarra</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= u ?>cursos-de-musica-online/3/bateria_e_percucao"><img
                                    src="assets/imgs/bateria.png" alt="">
                            <span>Bateria e Percussão</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= u ?>cursos-de-musica-online/4/harmonia_e_teoria"><img
                                    src="assets/imgs/harmonia.png" alt="">
                            <span> Harmonia e Teoria</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= u ?>cursos-de-musica-online/5/improvisacao"><img src="assets/imgs/improvisacao.png"
                                                                                      alt="">
                            <span>Improvisação</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </section>
    <div class="main">
        <section class="module" id="about" style="padding: 0">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2" style="display:none">
                        <h2 class="module-title font-alt">Cursos Online de Música</h2>
                        <div class="module-subtitle  large-text">Conheça as categorias e níveis dos cursos.</div>
                    </div>
                </div>
            </div>
            <div class="row cursos-online center" style="margin: 0 -17px;">
                <?php if ($home_video['video']) { ?>
                    <div class="col-md-8 col-md-offset-2">
                        <iframe id="iframeVideoHome" src="<?= $home_video['video'] ?>" width="100%" class="home-video"
                                style="margin: 20px auto; border: none" frameborder="0" webkitallowfullscreen
                                mozallowfullscreen allowfullscreen></iframe>
                    </div>
                <?php } ?>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2" style="display:none">
                        <h2 class="module-title font-alt">Nossos cursos online mais acessados:</h2>
                        <div class="module-subtitle  large-text" style="margin-bottom:0px;">Iniciante , Intermediário e
                            Avançado
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="module cursos-acessados">
            <div class="container">
                <div class="module-subtitle large-text center" style="margin-bottom:30px;color:#444;margin-top: 21px;">
                    Nossos cursos mais acessados: Iniciante , Intermediário e Avançado
                </div>
                <div class="row">
                    <div id="thim-course-archive only-desktop"
                         class="thim-course-grid thim-course-grid-home multiple-items-curses">
                        <?php $css2 = $css = $gm->lista('cursos', 'where destaque_home = 1 order by ordem limit 8');
                        foreach ($css as $cs) {
                            include 'includes/box-curso.php';
                        }
                        ?>
                    </div>

                    <div class="only-mobile"> <!-- mobile  -->
                        <?php
                        foreach ($css2 as $cs) {
                            $inst = $gm->obj('instrutores', 'instrutorId', $cs['instrutorId'], 1);
                            $cursoImg = $cs['thumb'] == '' ? 'assets/imgs/thumb.png' : "assets/imgs/cursos/" . $cs['thumb']; ?>
                            <div class="col-sm-12">
                                <div class="card" style="width: 100%; background: #fff; margin-top: 20px">
                                    <a href="<?= u ?>curso-de-musica-online/<?= ln($cs['titulo']) ?>">
                                        <img style="margin: 0; z-index: -99" class="card-img-top"
                                             src="<?= u . $cursoImg ?>" width="100%">
                                    </a>
                                    <div class="card-body">
                                        <div style="width: 40px; margin: -20px auto 0 auto; display: block; z-index: 9999">
                                            <img style="border-radius: 50%; border: 2px solid #fff; margin: 0"
                                                 src="<?= u ?>assets/imgs/team/<?= $inst->foto ?>"
                                                 class="avatar avatar-40 photo" width="40" height="40">
                                        </div>
                                        <p style="text-align: center"><?= $inst->nome ?></p>
                                        <a href="<?= u ?>curso-de-musica-online/<?= ln($cs['titulo']) ?>">
                                            <h5 style="font-weight: 800; text-align: center"><?= $cs['titulo'] ?></h5>
                                        </a>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <hr class="divider-w">

        <section class="module" id="planos" style="padding-bottom: 0">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h2 class="module-title font-alt">Tenha acesso ilimitado a todos os cursos de música
                            online!</h2>
                        <div class="module-subtitle large-text">Escolha seu plano de assinatura</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="module div-plans" style="padding: 0">
            <div class="container">
                <div class="row multi-columns-row div-plans">

                    <?php $plans = $gm->lista('planos');
                    $btnColors = ["btn-green", "btn-blue", "btn-red"];
                    $count = 0;
                    foreach ($plans as $pl) {
                        ?>

                        <?php if ($pl['nome'] != 'Teste') { ?>
                            <div class="col-sm-6 col-xs-12 col-md-3 col-lg-2 <?php if ($pl['valor'] == 0) { ?> col-sm-offset-3 col-md-offset-2 col-lg-offset-3 <?php } ?> np">
                                <div class="price-table font-alt">
                                    <h4><?= $pl['nome'] ?></h4>

                                    <p class="price">
                                        <?php if ($pl['valor'] > 0) {
                                            echo money($pl['valor'] / $pl['parcelas']);
                                        } else {
                                            echo money($pl['valor']);
                                        }
                                        ?>
                                    </p>
                                    <p class="periodo"><?= $pl['dias'] ?></p>
                                    <p class="pagamento lower">
                                        <?php if ($pl['valor'] == 0) { ?>
                                            Comece a estudar agora!
                                        <?php } else {
                                            echo $pl['parcelas'] . "x de " . money($pl['valor'] / $pl['parcelas']);
                                        }
                                        ?>
                                    </p>
                                    <a class="btn btn-danger btn-plan <?= $btnColors[$count] ?>"
                                       rel="<?= $pl['planoId'] ?>" href="/cart/assinar.php?plano=<?= $pl['planoId'] ?>">Escolher</a>
                                    <?php $count++ ?>
                                    <ul class="price-details">

                                        <li class="maior">
                                            <?php if ($pl['caracteristicas']) { ?><i class="fas fa-video"></i><?php } ?>
                                            <?= $pl['caracteristicas'] ?></li>
                                        <li class="black">
                                            <?php if ($pl['caracteristica2']) { ?><i
                                                    class="far fa-address-card"></i><?php } ?>
                                            <?= $pl['caracteristica2'] ?></li>
                                        <li>
                                            <?php if ($pl['caracteristica3']) { ?> <i
                                                    class="fas fa-desktop"></i> <?php } ?>
                                            <?= $pl['caracteristica3'] ?></li>

                                    </ul>
                                </div>
                            </div>

                        <?php }  // if ?>
                    <?php } // foreach ?>

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

        <section class="module apps-stores">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 center">
                        <img src="<?= u ?>/assets/imgs/mobile_background2x.png" alt="" width="400px">
                    </div>
                    <div class="col-sm-6 app-col">
                        <h2>Estude em qualquer <br> lugar com o App</h2>
                        <p>Em breve disponibilizaremos aos nossos alunos o novo APP do Terra da Música. Sendo possível
                            praticar suas aulas online a partir do seu smartphone.</p>
                        <ul class="list-inline">
                            <li>
                                <button class="btn"><i class="fab fa-android"></i> ANDROID</button>
                            </li>
                            <li>
                                <button class="btn"><i class="fab fa-apple"></i> IOS</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section class="module" id="team">
            <div class="container mt-40">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h2 class="module-title font-alt">Mais de 10.000 alunos já estudam no Terra da Música</h2>
                        <!--<div class="module-subtitle large-text" style="margin-bottom:0px;">Depoimentos dos alunos do Terra da Música</div>-->
                    </div>
                </div>

            </div>
        </section>
        <section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial"
                 data-background="assets/imgs/slide-tdm-1.jpg">
            <div class="testimonials-slider pt-50 pb-140">
                <div class="caption-testimonial">O que nossos alunos dizem:</div>
                <ul class="slides">
                    <?php $alu = $gm->lista('depoimentos', " where status = 1");
                    foreach ($alu as $al) {
                        ?>
                        <li>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="user-name-dep"><?= $al['nome'] ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <blockquote
                                                class="testimonial-text font-alt"><?= $al['depoimento'] ?></blockquote>
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


        <section class="module">
            <div class="testimonials-slider pt-20 pb-40 newsletter">

                <h3 class="module-title">Cadastre-se em nossa newsletter</h3>
                <form id="mc4wp-form-3" method="post" data-id="3101" data-name="Default sign-up form">

                    <div class="col-md-4 col-md-offset-3">
                        <div class="alert alert-success"
                             style="display:none;margin: 0 auto 3px;opacity: 0.6; width: 100%" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong></strong> <span class="warn"></span>
                        </div>
                    </div>
                    <div class="col-md-4"></div>

                    <div class="col-md-4 col-md-offset-3">
                        <input class="form-control" style="border: 1px solid #ccc; background: #fff; color: #d9534f"
                               id="mc4wp_email" name="EMAIL" placeholder="Seu e-mail" required="" type="email">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn-danger">CADASTRAR</button>
                    </div>

                    <label style="display: none !important;">Leave this field empty if you're human:
                        <input name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" type="text"></label>
                    <input name="_mc4wp_timestamp" value="1523490570" type="hidden"><input name="_mc4wp_form_id"
                                                                                           value="3101" type="hidden">
                    <input name="_mc4wp_form_element_id" value="mc4wp-form-3" type="hidden">
            </div>
            <div class="mc4wp-response"></div>
            </form>

    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $('.slide').hover(
            function () {
                $(this).find('.caption').slideDown(250);
            },
            function () {
                $(this).find('.caption').slideUp(250);
            }
        );
    });
</script>


<script src="<?= u ?>assets/js/slick.js"></script>
<script>
    $('.multiple-items-curses').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
    });
</script>


<script> /*
   var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/player_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var tv,
    playerDefaults = {autoplay: 1, autohide: 1, modestbranding: 0, rel: 0, showinfo: 0, controls: 0, disablekb: 1, enablejsapi: 0, iv_load_policy: 3, loop:1};
var vid = [
      {'videoId': '<?=$ytcode?>', 'startSeconds': 1, 'endSeconds': 241, 'suggestedQuality': 'hd720'}
    ],
    randomVid = Math.floor(Math.random() * vid.length),
    currVid = randomVid;
   // currVid = <?=$ytcode?>;


$('.hi em:last-of-type').html(vid.length);

function onYouTubePlayerAPIReady(){
  tv = new YT.Player('tv', {events: {'onReady': onPlayerReady, 'onStateChange': onPlayerStateChange}, playerVars: playerDefaults});
}

function onPlayerReady(){
  tv.loadVideoById(vid[currVid]);
  tv.mute();
}

function onPlayerStateChange(e) {
  if (e.data === 1){
    $('#tv').addClass('active');
    $('.hi em:nth-of-type(2)').html(currVid + 1);
  } else if (e.data === 2){
    $('#tv').removeClass('active');
    if(currVid === vid.length - 1){
      currVid = 0;
    } else {
      currVid++;
    }
    tv.loadVideoById(vid[currVid]);
    tv.seekTo(vid[currVid].startSeconds);
  }
}

function vidRescale(){

  var w = $(window).width()+200,
    h = $(window).height()+200;

  if (w/h > 16/9){
    tv.setSize(w, w/16*9);
    $('.tv .screen').css({'left': '0px'});
  } else {
    tv.setSize(h/9*16, h);
    $('.tv .screen').css({'left': -($('.tv .screen').outerWidth()-w)/2});
  }
}

$(window).on('load resize', function(){
  vidRescale();
});

$('#video-volume').on('click', function(){
  $('#tv').toggleClass('mute');
  $('.hi em:first-of-type').toggleClass('hidden');
  if($('#tv').hasClass('mute')){
    tv.mute();
  } else {
    tv.unMute();
  }
});

$('.hi span:last-of-type').on('click', function(){
  $('.hi em:nth-of-type(2)').html('~');
  tv.pauseVideo();
});
*/
</script>


<script src="<?= u ?>assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
