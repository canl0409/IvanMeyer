<?php $banners =  $gm->getRegistro('banners','bannerId',1); ?>


 


      <section class="home-section home-parallax home-fade bg-dark-30" id="home" data-background="assets/imgs/<?=$banners['imagem']?>">

        <?php if($banners['video']){ ?>
        <div class="video-player"  data-property="{videoURL:'<?=$banners['video']?>', containment:'.home-section', startAt:20, mute:false, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}"></div>
        <div class="video-controls-box">
        <div class="container">
        <div class="video-controls"><a class="fa fa-volume-up" id="video-volume" href="#">&nbsp;</a><a class="fa fa-pause" id="video-play" href="#">&nbsp;</a></div>
        </div>
        </div>
        <?php }?>

        <div class="titan-caption container">
          <div class="caption-content container">
            <div class="font-alt mb-80 titan-title-size-1"></div>
            <div class="font-alt mb-20 titan-title-size-4">Dê um passo à frente, <br> revolucione a sua música!</div>
            <a class="section-scroll btn btn-danger btn-lg btn-round pull-left mb-60" href="#about">Saiba Mais +</a>
             <a class="section-scroll btn btn-danger btn-lg btn-round pull-left mb-60" href="<?=u?>cursos">Conheça nossos cursos</a>
            <ul class="list-inline iconsbanner mt-20">
              <li>
              <a href="<?=u?>cursos-de-musica-online/2/piana_e_teclado"><img src="assets/imgs/piano.png" alt="">
              <span>Piano e Teclado</span>
              </a>
              </li>
              <li>
              <a href="<?=u?>cursos-de-musica-online/1/violao_e_guitarra"><img src="assets/imgs/violao.png" alt="">
              <span>Violao e Guitarra</span>
              </a>
              </li>
              <li>
              <a href="<?=u?>cursos-de-musica-online/3/bateria_e_percucao"><img src="assets/imgs/bateria.png" alt="">
              <span>Bateria e Percussão</span>
              </a>
              </li>
              <li>
              <a href="<?=u?>cursos-de-musica-online/4/harmonia_e_teoria"><img src="assets/imgs/harmonia.png" alt="">
              <span>Harmonia e Teoria</span>
              </a>
              </li>
              <li>
              <a href="<?=u?>cursos-de-musica-online/5/improvisacao"><img src="assets/imgs/improvisacao.png" alt="">
              <span>Improvisação</span>
              </a>
              </li>
            </ul>

          </div>
        </div>
      </section>
      <div class="main">
        <section class="module" id="about">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2 class="module-title font-alt">Cursos Online de Música</h2>
                <div class="module-subtitle  large-text">Conheça as categorias e níveis dos cursos.</div>
              </div>
            </div>

            <div class="row cursos-online">
            <div class="col-sm-6 npr curso-main">
            <a href="<?=u?>cursos-de-musica-online/2/piano_e_teclado" style="position:absolute">
              <img  class="img-responsive"  src="assets/imgs/curso1.jpg" alt="">
            </a>
            <a href="<?=u?>cursos/2/piano_e_teclado">
              <div class="caption-big">
                <img src="assets/imgs/piano.png" alt="">
                <h4>Curso de Piano & Teclado</h4>
                <span>Iniciante | Intermediário | Avançado</span>
                <a href="<?=u?>cursos/2/piano_e_teclado">Saiba mais +</a>
              </div>
            </a>
            </div>
            <div class="col-sm-6 sec-cursos np">

              <div  class="grid-block slide"> 
              <a href="<?=u?>cursos-de-musica-online/4/harmonia_e_teoria">
                <div class="caption">
                <img class="icon-cat" src="assets/imgs/harmonia.png" alt="">
                <h3>Harmonia e Teoria</h3>
                <p>Iniciante | Intermediário | Avançado</p>
                <p><a href="#" class="learn-more">Saiba mais+</a></p>
                </div>
                   <div class="imgb" style="background-image: url('<?=u?>assets/imgs/curso2.jpg')"></div>
              </a>
              </div>

              <div  class="grid-block slide"> 
              <a href="<?=u?>cursos-de-musica-online/1/violao_e_guitarra">
                <div class="caption">
                <img class="icon-cat" src="assets/imgs/violao.png" alt="">
                <h3>Violão e Guitarra</h3>
                <p>Iniciante | Intermediário | Avançado</p>
                <p><a href="#" class="learn-more">Saiba mais+</a></p>
                </div>
                   <div class="imgb" style="background-image: url('<?=u?>assets/imgs/curso3.jpg')"></div>
              </a>
              </div>

              <div  class="grid-block slide"> 
              <a href="<?=u?>cursos-de-musica-online/5/improvisacao">
                <div class="caption">
                <img class="icon-cat" src="assets/imgs/improvisacao.png" alt="">
                <h3>Improvisação</h3>
                <p>Iniciante | Intermediário | Avançado</p>
                <p><a href="#" class="learn-more">Saiba mais+</a></p>
                </div>
                   <div class="imgb" style="background-image: url('<?=u?>assets/imgs/curso4.jpg')"></div>
              </a>
              </div>

              <div  class="grid-block slide"> 
              <a href="<?=u?>cursos-de-musica-online/3/bateria_e_percucao">
                <div class="caption">
                <img class="icon-cat" src="assets/imgs/bateria.png" alt="">
                <h3>Bateria e Percussão</h3>
                <p>Iniciante | Intermediário | Avançado</p>
                <p><a href="#" class="learn-more">Saiba mais+</a></p>
                </div>
                   <div class="imgb" style="background-image: url('<?=u?>assets/imgs/curso5.jpg')"></div>
              </a>
              </div>

            </div>
            </div>



            <div class="row" style="display:none">
              <div class="col-sm-2 col-sm-offset-5">
                <div class="large-text align-center"><a class="section-scroll" href="#services"><i class="fa fa-angle-down"></i></a></div>
              </div>
            </div>

            <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
            <h2 class="module-title font-alt">Nossos cursos mais acessados:</h2>
            <div class="module-subtitle  large-text" style="margin-bottom:0px;">Iniciante , Intermediario e Avançado</div>
            </div>
            </div>

          </div>
        </section>

        <section class="module cursos-acessados">
        <div class="container">



          <div class="row ">
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-harmonia-2.jpg" alt=""></a></div>
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-improvisacao.jpg" alt=""></a></div>
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-harmonia.jpg" alt=""></a></div>
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-linguagem.jpg" alt=""></a></div>
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-violao.jpg" alt=""></a></div>
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-chorinho.jpg" alt=""></a></div>
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-piano-blues.jpg" alt=""></a></div>
          <div class="col-md-3 col-sm-6 col-xs-12"> 
          <a href="<?=u?>curso/1/viola_e_guitarra"><img src="assets/imgs/mod-guitarra.jpg" alt=""></a></div>
          </div>
        </div>
        </section>



        <hr class="divider-w">
        <section class="module" id="services">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2 class="module-title font-alt">Tenha acesso ilimitado a todos os cursos!</h2>
                <div class="module-subtitle  large-text">Escolha seu plano de assinatura</div>
              </div>
            </div>



            <div class="row multi-columns-row">


<?php $plans = $gm->lista('planos'); 
foreach ($plans as $pl) {
?>

              <div class="col-sm-6 col-xs-12 col-md-2 col-lg-2 <?php if($pl['valor'] == 0){  ?> col-sm-offset-3 <?php } ?> np">
                <div class="price-table font-alt">
                  <h4><?=$pl['nome']?></h4>
                  
                  <p class="price"> 
                    <?php if($pl['valor'] > 0){ 
                      echo money($pl['valor'] / $pl['parcelas']);
                      }else{
                      echo money($pl['valor']);
                      } 
                      ?>
                  </p>
                       <p class="periodo"><?=$pl['dias']?></p>
                  <p class="pagamento lower">
                  <?php if($pl['valor'] == 0){  ?>
                  Comece a estudar agora!
                  <?php }else{ 
                   echo $pl['parcelas']."x de ". money($pl['valor'] / $pl['parcelas']);
                  }
                  ?>
                  </p>
                  <a class="btn btn-danger btn-round purchase-button" rel="<?=$pl['planoId']?>" href="#">Escolher</a>

                  <ul class="price-details">
                    
                    <li class="bgl">
                      <?php if($pl['caracteristicas']){ ?><i class="fas fa-video"></i><?php }  ?>
                       <?=$pl['caracteristicas']?></li>
                    <li style="padding-top: 16px;">
                      <?php if($pl['caracteristica2']){ ?><i class="far fa-address-card"></i><?php }  ?>
                      <?=$pl['caracteristica2']?></li>
                    <li class="bgl">
                     <?php if($pl['caracteristica3']){ ?> <i class="fas fa-desktop"></i> <?php }  ?>
                      <?=$pl['caracteristica3']?></li>

                  </ul>
                </div>
              </div>

<?php } ?>

              </div>



          </div>
        </section>
 
        


      
        <section class="module" id="team">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">O que as pessoas dizem:</h2>
                <div class="module-subtitle large-text" style="margin-bottom:0px;">Depoimentos dos alunos do Terra da Música</div>
              </div>
            </div>
         
          </div>
        </section>
        <section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial" data-background="assets/imgs/slide-tdm-1.jpg">
          <div class="testimonials-slider pt-50 pb-140">
          <div class="caption-testimonial">Mais de 10.000 alunos já estudam no Terra da Música</div>
            <ul class="slides">
            <?php $alu = $gm->lista('depoimentos'," where status = 1");
            foreach($alu as $al){?>
              <li>
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="user-name-dep"><?=$al['nome']?></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                      <blockquote class="testimonial-text font-alt"><?=$al['depoimento']?></blockquote>
                      <?php $cur = $gm->getRegistro('cursos','cursoId',$al['cursoId']); ?>
                      <div class="testimonial-curso"><?=$cur['titulo']?></div>
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
    function(){
      $(this).find('.caption').slideDown(250);
    },
    function(){
      $(this).find('.caption').slideUp(250);
    }
  );
});
</script>
 <script src="<?=u?>assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>