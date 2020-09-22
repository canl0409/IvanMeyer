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

            & .active {
                opacity: 1;
            }

        }
    }
</style>



<section class="hero-section">
    <div class="hero-items owl-carousel">
        <?php
        $banners = $gm->lista('banners', " where sessao = 'home' ");
        foreach ($banners as $ban) {
        ?>
            <div class="single-hero-item set-bg" data-setbg="assets/imgs/<?= $ban['imagem'] ?>">
                <div class="container">
                    <div class="hero-text">
                        <h4><?= $ban['titulo'] ?></h4>
                        <h1><?= $ban['texto1'] ?><br><span><?= $ban['texto2'] ?></span></h1>
                        <a href="<?= $ban['link_botao'] ?>" class="primary-btn"><?= $ban['texto_botao'] ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</section>



<!-- Why Chose Us Section Begin -->
<section class="choseus-section set-bg spad" id="cursos">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>CATEGORIAS DE CURSOS</h2>
                    <p>Veja os nossos cursos de música online e revolucione a sua música</p>
                </div>
            </div>
        </div>
        <div class="chose-items">
            <div class="row">
                <?php
                foreach ($categoriasp as $cname) {
                ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="ci-item bcp-item">
                            <a href="<?= u ?>cursos-de-musica-online-assinaturas/<?= $cname['categoriaId'] ?>/<?= ln($cname['nome']) ?>">
                                <img src="assets/img/<?= $cname['icone'] ?>" alt="<?= $cname['nome'] ?>" title="<?= $cname['nome'] ?>">
                                <h5><?= $cname['nome'] ?></h5>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row" align="center"><a href="https://terradamusica.com.br/cart/assinar.php?plano=1" target="_blank" class="btn primary-btn btn-block">
                    <h4 style="color:#ffffff">ASSINE UM PLANO GRATUITO DE 30 DIAS E COMECE A ESTUDAR JÁ!</h4>
                </a></div>

            <div class="row" align="center"><a href="https://terradamusica.com.br/cursos-de-musica-online"  class="btn primary-btn btn-block" style="margin-top:16px;background: #bb2843;">
            <h4 style="color:#ffffff">VEJA TODOS OS CURSOS</h4>
            </a></div>
        </div>
    </div>
</section>
<!-- Why Chose Us Section End -->




<div class="cta-section set-bg spad" data-setbg="assets/img/video-bg.jpg" data-title="Turi COllura">

    <div class="play-btn col-lg-6 offset-6 d-none d-lg-block d-sm-block d-md-block d-md-none">

        <h2 style="color:#ffffff">Estude com os melhores professores </h2><br>
        <h4 style="color:#ffffff">Aprenda onde e quando quiser, sem sair de casa.</h4><br>
        <a href="https://vimeo.com/338267727" class="service-video-popup">
            <i class="far fa-play-circle fa-5x"></i></a>
    </div>
    <div class="play-btn col-xs-12 d-block d-sm-none">

        <h2 style="color:#ffffff">Estude com os melhores professores </h2><br>
        <h4 style="color:#ffffff">Aprenda onde e quando quiser, sem sair de casa.</h4><br>
        <a href="https://vimeo.com/338267727" class="service-video-popup">
            <i class="far fa-play-circle fa-5x"></i></a>
    </div>
</div>



<!-- Services Section Begin -->
<section class="services-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Por que o Terra da Música é sua melhor escolha?</h2>
                </div>

                <div class="services-items col-lg-12">
                    <div class="row">
                        <div class="single-service col-lg-6" align="center">
                            <img src="assets/img/astronauta.png" alt="aprenda música de verdade" title="aprenda música de verdade">
                            <h5 class=""><?= $bdPaginaPlanos['texto_boneco_1'] ?></h5>
                            <p><?= $bdPaginaPlanos['subtexto_boneco_1'] ?></p>
                        </div>
                        <div class="single-service col-lg-6" align="center">
                            <img src="assets/img/foguete.png" alt="Você sempre acompanhado nos estudos" title="Você sempre acompanhado nos estudos">
                            <h5 class=""><?= $bdPaginaPlanos['texto_boneco_2'] ?></h5>
                            <p><?= $bdPaginaPlanos['subtexto_boneco_2'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="single-service col-lg-6" align="center">
                            <img src="assets/img/mundo.png" alt="Profissionais qualificados com experiência" title="Profissionais qualificados com experiência">
                            <h5 class=""><?= $bdPaginaPlanos['texto_boneco_3'] ?></h5>
                            <p><?= $bdPaginaPlanos['subtexto_boneco_3'] ?></p>
                        </div>
                        <div class="single-service col-lg-6" align="center">
                            <img src="assets/img/foguete2.png" alt="escola de música sempre perto de você" title="escola de música sempre perto de você">
                            <h5 class=""><?= $bdPaginaPlanos['texto_boneco_4'] ?></h5>
                            <p><?= $bdPaginaPlanos['subtexto_boneco_4'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Cta Section Begin -->
<section class="cta-section set-bg spad" data-setbg="assets/img/cta-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Mais de 16.000 alunos já estudam no Terra da Música</h2>
                <p>Inscreva-se e comece hoje mesmo a revolucionar sua música</p>
                <a href="#" class="primary-btn">QUERO ME INSCREVER</a>
            </div>
        </div>
    </div>
</section>
<!-- Cta Section End -->

<!-- CURSOS -->


<section class="module cursos-acessados">
    <div class="container">
        <div class="module-subtitle large-text center" style="margin-bottom:30px;color:#444;margin-top: 21px;">
            Nossos cursos mais acessados: Iniciante , Intermediário e Avançado
        </div>
        <div class="row-slider-cursos">
            <div id="thim-course-archive only-desktop" class="thim-course-grid thim-course-grid-home multiple-items-curses">
                <?php $css2 = $css = $gm->lista('cursos', 'where destaque_home = 1 order by ordem limit 8');
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

<div class="only-mobile" align="center">
    <!-- mobile  -->
    <h2>Nossos cursos mais acessados: Iniciante , Intermediário e Avançado</h2>
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



<!-- DEPOIMENTOS -->
<div class="classes" id="depoimentos">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="col-12" style="margin-top: 50px;">
                    <div class="section-title" align="center">
                        <h2>Depoimentos</h2>
                        <p>Veja o que nossos alunos dizem do Terra da Música</p>
                    </div>

                </div>

                <!-- Classes Slider -->
                <div class="classes_slider_container">
                    <div class="owl-carousel owl-theme classes_slider">

                        <?php $alu = $gm->lista('depoimentos', " where status = 1");
                        foreach ($alu as $al) {
                        ?>
                            <div>
                                <div class="classes_slide_wrap">
                                    <div class="text-center">
                                        <div class="classes_title">
                                            <h3><?= $al['nome'] ?></h3>
                                        </div>
                                        <div class="classes_text">
                                            <p><?= $al['depoimento'] ?></p>
                                        </div>
                                        <div class="class_image"><a href="#"><img src="assets/img/terra.jpg" alt=""></a></div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FIM DEPOIMENTOS -->

<!-- CTA APP -->

<section class="cta-section set-bg spad" data-setbg="assets/img/cta-bg-app.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <img src="assets/img/mobile_background2x-min.png" alt="estude de onde estiver no terra da música - app" title="estude de onde estiver no terra da música - app">
            </div>
            <div class="col-lg-8">
                <h2>O Terra da música com você em todo lugar!</h2>
                <p>Baixe o APP do Terra da Música e acesse as aulas
                    online de seu dispositivo móvel.<BR>
                    JÁ É ALUNO? BAIXE JÁ!</p>
                <a href="https://play.google.com/store/apps/details?id=br.com.terradamusica.appead" target="_blank" class="primary-btn"><i class="fab fa-android"></i> ANDROID</a> <a target="_blank" href="https://apps.apple.com/br/app/terra-da-m%C3%BAsica/id1500145734" class="primary-btn"><i class="fab fa-apple"></i>IOS</a>
            </div>
        </div>
    </div>
</section>
<!-- FIM CTA APP -->


<!-- NEWSLETTER -->

<div class="col-12" align="center" style="margin-top: 50px;">
    <div class="section-title" align="center">
        <h2>Cadastre-se em nossa newsletter</h2>
    </div>
    <form id="mc4wp-form-3" class="form-inline" method="post" data-id="3101" data-name="Default sign-up form">
        <div class="col-md-4 col-md-offset-3" style="    margin: 0 auto;">
            <div class="alert alert-success" style="display:none;margin: 0 auto 3px;opacity: 0.6; width: 100%" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
                <strong></strong> <span class="warn"></span>
            </div>
        </div>
        <div class="form-group col-12" align="center">
            <div class="col-lg-3 d-none d-sm-block"></div>
            <div class="col-lg-5 col-xs-12">
                <input type="hidden" name="_mc4wp_form_id" value="1">
                <input class="form-control-plaintext form-control-lg" style="border: 1px solid #ccc; background: #fff; color: #d9534f" id="mc4wp_email" name="EMAIL" placeholder="Seu e-mail" required="" type="email">
            </div>
            <div class="col-lg-2 col-xs-12">
                <button type="submit" class="primary-btn btn-block">CADASTRAR</button>
            </div>

        </div>
    </form>
</div>

<!-- FIM NEWSLETTER -->

<!-- BLOG -->
<section class="latest-news-section spad" style="background-color: #E6E6E6; margin-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Novidades no Blog</h2>
                    <p>Veja nosso blog e fique a par das novidades do Terra da Música</p>
                </div>
            </div>
        </div>
        <div class="row">


            <?php
            $posts = getRss();
            foreach ($posts as $post) {

            ?>
                <div class="col-lg-4">
                    <div class="latest-items">
                        <div class="latest-pic" style="min-height: 242px;">
                            <img src="<?= $post['image'] ?>" alt="">
                        </div>
                        <div class="latest-text">
                            <div class="latest-tag" style="display:none">
                                <div class="tag-clock">
                                    <i class="fa fa-clock-o"></i>
                                    Dec 11, 2018
                                </div>
                                <div class="tag-comments">
                                    <i class="fa fa-comments-o"></i>
                                    6 Comments
                                </div>
                            </div>
                            <h5><a target="_blank" href="<?= $post['link'] ?>"><?= $post['title'] ?></a></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<!-- FIM BLOG -->



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


<script src="<?= u ?>assets/js/slick.js"></script>
<script>
    $('.multiple-items-curses').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
    });
</script>


<script>
    /*
   var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/player_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var tv,
    playerDefaults = {autoplay: 1, autohide: 1, modestbranding: 0, rel: 0, showinfo: 0, controls: 0, disablekb: 1, enablejsapi: 0, iv_load_policy: 3, loop:1};
var vid = [
      {'videoId': '<?= $ytcode ?>', 'startSeconds': 1, 'endSeconds': 241, 'suggestedQuality': 'hd720'}
    ],
    randomVid = Math.floor(Math.random() * vid.length),
    currVid = randomVid;
   // currVid = <?= $ytcode ?>;


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

<script type="text/javascript">
    $(document).on('click', '.openCursos', function() {
        let content = $('.' + $(this).attr('id')).html();
        console.log(content);
        $("#modal_cursos .modal-content").html(content);
        $('#modal_cursos').modal('show');
    });
</script>

<?php 
if(isset($acesso)){ ?>
<script type="text/javascript"> 

$(document).ready(function () {
$('.btlogin').trigger('click');
 });
</script>
 <?php } ?>
