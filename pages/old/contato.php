<?php 
$banner = $gm->getRegistro('banners', "sessao", "contato"); 

if(!$banner){
  $banner['imagem'] = "slide-tdm-1.jpg";
}
?>

<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?=u."assets/imgs/".$banner['imagem']?>">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Contato</div>
    </div>
  </div>
</section>

<div class="main mb-40">

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="post-meta"><a href="<?=u?>">Home</a>  Contato</div>
      </div>
    </div>



    <section class="module"  >
      

        <div class="row">
          <div class="col-sm-6 ">
            <h2 class="module-title module-title-inside font-alt mb-10">Nossas Redes</h2>
            <p class="subtitle mb-40">Bem vindo ao nosso site, estamos felizes de ve-lo por aqui. </p>

       
 

            <div class="row contact-row">
              <div class="col-md-12">
                <ul class="social_link">
                  <?php $rds = $gm->lista('redes'); foreach ($rds as $rd) {
                  ?>
                  <li><a class="facebook hasTooltip" href="<?=$rd['url']?>" target="_blank"><i class="<?=$rd['icon']?>"></i></a></li>
                  <?php   } ?>
                </ul>
              </div>
            </div>

          </div>

          <div class="col-sm-6">
            <h2 class="module-title font-alt mb-10 module-title-inside">Nos envie uma mensagem</h2>
            <p class="subtitle mb-40">Seu endereço de e-mail não será publicado. </p>



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

          </form><div class="ajax-response font-alt" id="contactFormResponse"></div> 

        </section>

      </div>
    </div> 


    <section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial" data-background="assets/imgs/slide-tdm-1.jpg">
      <div class="testimonials-slider pt-50 pb-140 newsletter">
        <div class="caption-testimonial">Cadastre-se em nossa newsletter</div>

          <form id="mc4wp-form-3" method="post" data-id="3101" data-name="Default sign-up form">

          <div class="col-md-4 col-md-offset-3">
            <div class="alert alert-success" style="display:none;margin: 0 auto 3px;opacity: 0.6; width: 100%" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong></strong> <span class="warn"></span>
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

   