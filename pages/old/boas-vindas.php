
<?php 
if(!$user->isloged()){ ?>
<meta http-equiv="refresh" content="0; url=<?=u?>" />
<?php 
die;
}

if(isset($_SESSION["cart_products"])){
  unset($_SESSION["cart_products"]);
  ?>
  <meta http-equiv="refresh" content="0; url=<?=u.'minhaconta'?>" /> 
  <?php
}

$alert = false;
$alertClass = "";
$alertMsgm = "";

if(isset($_SESSION["alert"]))
{
  $alert = true;
  $alertClass = $_SESSION["alert-class"];
  $alertMsgm = $_SESSION["alert-msgm"];
}else{
  $alert = false;
}

function limpaAlert(){
  unset($_SESSION["alert"]);
  unset($_SESSION["alert-class"]);
  unset($_SESSION["alert-msgm"]);
}

if(!isset($_SESSION['tipo_item'])){
?>
<script type="text/javascript">window.location = "<?php echo u.'/minhaconta' ?>";</script>
<?php  die; } ?>


<section class="home-section int-section  home-fade bg-dark-30" id="home" data-background="<?=u?>assets/imgs/slide-tdm-1.jpg">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Bem Vindo</div>

    </div>
  </div>
</section>

        <section >
          <div class="container">
            <div class="row mb-60">
            <div class="col-md-12">
            <div class="post-meta"><a href="<?=u?>">Home</a> Boas Vindas</div>
            </div>
            </div>

            <div class="row">
              <div class="col-sm-9 col-sm-offset-3">
                <?php if($alert){ ?>
                  <div class="<?=$alertClass?>" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
                    <?=$alertMsgm?>
                  </div>
                <?php limpaAlert(); } ?>  
              </div>
            </div>

            <div class="row mb-40">
              <div class="col-sm-3">
               <h4 class="font-alt mb-10">Olá, <?=$_SESSION['nome']?></h4>
                <p>A partir do <a href="<?=u?>minhaconta">painel de controle</a> de sua conta, você pode ver suas compras recentes, gerenciar seus endereços de entrega e cobrança, e edite sua senha e detalhes da conta.
                </p>
                <p style="padding-top: 10px; border-top: solid 1px #ddd;">
                  <?php echo $gm->plano() ?>
                </p>
              </div>

              <div class="col-sm-9">

<?php if( isset($_SESSION['tipo_item']) && $_SESSION['tipo_item'] == 'plano' ){ ?>
                  <div style="background-color:#b40431; margin-bottom:15px; padding:15px; width:700px">
                  <h1><span style="color:#ffffff;font-size: 32px;">Parab&eacute;ns pela assinatura do plano  <?php echo $gm->plano(true) ?>!</span></h1>
                  </div>

                  <p>&nbsp;</p>

                  <p>Ol&aacute; <?=$_SESSION['nome']?>,<br />
                  <br />
                  Obrigado pela sua assinatura do plano <span style="color:red"><strong><?php echo $gm->plano(true) ?></strong></span>. Clique no v&iacute;deo abaixo para as primeiras informa&ccedil;&otilde;es sobre o acesso &agrave; Plataforma de Ensino, Conte&uacute;dos, etc.</p>

<?php } ?>


<?php if( isset($_SESSION['tipo_item']) && $_SESSION['tipo_item'] == 'curso' ){ ?>
                  <div style="background-color:#b40431; margin-bottom:15px; padding:15px; width:700px">
                  <h1><span style="color:#ffffff;font-size: 32px;">Parab&eacute;ns por adquirir este novo curso!</span></h1>
                  </div>

                  <p>&nbsp;</p>

                  <p>Ol&aacute; <?=$_SESSION['nome']?>,<br />
                  <br />
                  Obrigado por adquirir este curso. Clique no v&iacute;deo abaixo para as primeiras informa&ccedil;&otilde;es sobre o acesso &agrave; Plataforma de Ensino, Conte&uacute;dos, etc.</p>
<?php } ?>


                  <p>

                    <a style="display:none" href="https://youtu.be/FTYx_oB3STQ" target="_blank"><img alt="Assista ao video com as informações de acesso à plataforma de estudos." dir="ltr" src="https://www.terradamusica.com.br:443/assets/imgs/aulas/boas-vindas-cursos-terra-da-musica.jpg" style="height:337px; width:600px" /></a>

                     <iframe id="iframeVideoHome"
                                        src="https://player.vimeo.com/video/409880626"
                                        width="600" frameborder="0" webkitallowfullscreen mozallowfullscreen
                                        allowfullscreen></iframe>


                  </p>

                  <p>D&ecirc; uma olhada nos cursos e planeje o seu programa de desenvolvimento, conforme seus interesses e o n&iacute;vel dos cursos.<br />
                  <br />
                  Se precisar de uma ajuda a mais, de um <u>suporte personalizado</u>, entre em contato.<br />
                  <br />
                  Clique em <strong><span style="background-color:#ffff99">LOGIN</span></strong> (na parte superior da tela, ao lado DIREITO). Feito isso voc&ecirc; est&aacute;&nbsp;em&nbsp;<strong><a href="<?=u?>minhaconta">
                    <span style="background-color:#ffff99">MINHA CONTA</span></a>
                  </strong>, onde encontra todos os&nbsp;cursos&nbsp;em que est&aacute; matriculado e suas informa&ccedil;&otilde;es.<br />
                  <br />
                  Aproveite os <strong>F&oacute;runs</strong> e o <strong>Social</strong> do site, compartilhe suas d&uacute;vidas, sua m&uacute;sica, suas conquistas!<br />
                  <br />
                  Bons estudos!!<br />
                  Turi Collura, coordenador dos cursos</p>

                  <p><a href="http://www.terradamusica.com.br">www.terradamusica.com.br</a></p>



           
              </div>
            </div>
          </div>
        </section>




<div id="modal-certificado" class="modal fade" role="dialog" style="z-index: 99999;" >
<div class="modal-dialog"  style="width:842px;">
<div class="modal-content"  >
<div class="modal-header" style="padding: 0px 15px;margin-bottom: -21px;z-index: 99;position: absolute; right:0px;border: none !important;">
<button type="button" style="opacity: 0.7;color: red;margin-right: -10px;" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body" id=""  style="height: 589px;padding:0px">
   <iframe id="i-modal-certificado" style="width:100%; height: 100%;" src="" frameborder="0"></iframe>
</div>
</div>
</div>
</div>
<?php  unset($_SESSION["tipo_item"]); ?>


<!-- Event snippet for Compra conversion page -->
<script>
  setTimeout(function(){

  gtag('event', 'conversion', {
      'send_to': 'UA-142173333-1/bT8QCKahwtUBEOvajN0C',
      'value': <?=$_SESSION["valor_tr"]?>,
      'currency': 'BRL'
  });
 
 
   }, 2000);
</script>
<?php  unset($_SESSION["valor_tr"]); ?>