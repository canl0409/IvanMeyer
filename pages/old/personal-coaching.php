<?php
$dsn = $gm->getRegistro('personal_coach','id',1);
$banner = $gm->getRegistro('banners', "sessao", "personal_coach");

if(!$banner){
  $banner['imagem'] = "slide-tdm-1.jpg";
}
?>

<style>
  .price-table{
    padding-bottom: 19px;
  }
</style>
<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?=u."assets/imgs/".$banner['imagem']?>">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Personal-Coaching</div>
    </div>
  </div>
</section>

<div class="main">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="post-meta"><a href="<?=u?>">Home</a>  Personal Coaching</div>
      </div>
    </div>

    <section class="module">
        <div class="row">
          <div class="col-sm-12 ">
            <?=$dsn['texto1']?>
          </div>
        </div>
      </section>
  </div>
</div>

<section  class="module" style="padding: 0">
  <div class="container">
     <div class="row center">
      <?php if($dsn['video']){ ?>
        <div class="col-md-8 col-md-offset-2">
          <iframe id="iframeVideoHome" src="<?=$dsn['video']?>" width="100%" class="home-video" style="margin:0 auto; border: none" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
      <?php  } ?>
     </div>
  </div>
</section>

<section  class="module" >
  <div class="container">
    <div class="row">

      <div class="col-md-4">
       <?=$dsn['box1']?>
      </div>

      <div class="col-md-4">
       <?=$dsn['box2']?>
      </div>

      <div class="col-md-4">
      <?=$dsn['box3']?>
      </div>

    </div>
  </div>
</section>

<section class="module" style="background: #d9534f">
  <div class="container">
    <h2 class="module-title font-alt mb-0" style="color: #fff">Entre em contato para solicitar seu serviço personalizado</h2>
  </div>
</section>

<section class="module">
  <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <form id="contactForm" role="form" method="post" action="#">

                <div class="alert alert-danger" style="display:none" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Oops... </strong> <span class="warn"></span>
                </div>

            <div class="form-group row">
              <div class="col-md-6">
                <input type="hidden" name="contato" value="1">
                <input class="form-control" id="name" name="name" placeholder="Seu Nome*" required="required" data-validation-required-message="Please enter your name." type="text">
                <p class="help-block text-danger"></p>
              </div>

              <div class="col-md-6">
                <input class="form-control" id="email" name="email" placeholder="Seu Email*" required="required" data-validation-required-message="Informe seu endereço de e-mail." type="email">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="form-group">
              <input class="form-control" id="assunto" name="assunto" placeholder="Seu assunto*" required="required" data-validation-required-message="Informe um assunto" type="text">
              <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
              <textarea style="max-height: 150px;" class="form-control" rows="7" id="message" name="message" placeholder="Sua Mensagem*" required="required" data-validation-required-message="Informe Sua mensagem"></textarea><p class="help-block text-danger"></p></div>
                <div class="form-group row">
                <div class="col-md-6">
                <div class="g-recaptcha" data-sitekey="6Lf5lmIUAAAAACLYhn0reqg2ozdMBfMwefpoBBBR"></div>
            </div>
              <div class="col-md-6">
                <button class="btn btn-round pull-right" id="cfsubmit" type="submit">Enviar</button>
              </div>
            </div>

          </form>
      </div>

          <div class="ajax-response font-alt" id="contactFormResponse"></div>
        </div>
    </section>


    <section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial" data-background="assets/imgs/slide-tdm-1.jpg">
      <div class="testimonials-slider pt-50 pb-50">
        <div class="caption-testimonial"> <?=$dsn['texto2']?></div>


      </div>
    </section>

