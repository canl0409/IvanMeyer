
<?php 
$dsn = $gm->getRegistro('quem_somos','id',1);



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
      <div class="font-alt mb-20 titan-title-size-4"><?=$pgd['titulo']?></div>
    </div>
  </div>
</section>

<div class="main mb-40">

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="post-meta"><a href="<?=u?>">Home</a>  <?=$pgd['titulo']?></div>
      </div>
    </div>

 

 

    <div class="row mb-40">
      <div class="col-md-12">
      <h2 class="module-title module-title-inside font-alt mb-10"><?=$pgd['titulo']?></h2>
      
      <p><?=$pgd['conteudo']?></p>
      </div>
 
    </div>





</div>
</div>
 