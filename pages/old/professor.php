
<?php 
//$dsn = $gm->getRegistro('quem_somos','id',1);



?>

<style>
.frase p{
  text-align: center !important;
}
</style>
<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?=u?>assets/imgs/slide-tdm-1.jpg">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Sobre Nós</div>
    </div>
  </div>
</section>

<div class="main mb-40">

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="post-meta"><a href="<?=u?>">Home</a>  Sobre Nós</div>
      </div>
    </div>

    <div class="row mt-50">
      <div class="col-sm-12">
        <h2 class="module-title pull-left font-alt" style='text-transform: uppercase;'><?=$cs['nome']?></h2>
      </div>
    </div>






    <div class="row mb-40">
      <div class="col-md-6">
        <?php if($cs['video']){  

          if (strpos($cs['video'], 'youtu') !== false) {

  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $cs['video'], $matches);
            ?>

            <iframe width="100%" style="margin:0 auto; min-height: 400px;"   src="https://www.youtube.com/embed/<?=$matches[1]?>" frameborder=\"0\" allowfullscreen></iframe>

          <?php }else{ ?>
            <iframe src="<?=$cs['video']?>" width="100%" class="home-video" style="margin:0 auto; min-height: 310px;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          <?php } ?>


        <?php }else{ ?>
          <img src="<?=u?>assets/imgs/team/<?=$cs['foto']?>" alt="team-7" title="team-7" width="100%">
        <?php } ?>
      </div>
      <div class="col-md-6" style="font-size:15px">
        <?=$cs['descricao_m']?>

      </div>
    </div>





  </div>
</div>








