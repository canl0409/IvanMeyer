<?php 
$banner = $gm->getRegistro('banners', "sessao", "duvidas"); 

if(!$banner){
  $banner['imagem'] = "slide-tdm-1.jpg";
}
?>

<section class="home-section curso-section  home-fade bg-dark-30" id="home" data-background="<?=u?>assets/imgs/<?=$banner['imagem']?>">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Dúvidas Frequentes</div>

    </div>
  </div>
</section>


<section>
  <div class="container">

<div class="row mb-40">
<div class="col-md-12">
  <div class="post-meta"><a href="<?=u?>">Home</a> Dúvidas Frequentes</div>
</div>
</div>

    <div class="row">

      <div class="col-md-9">

        <h4 class="font-alt mb-30 ">Tire as suas dúvidas conosco</h4>


        <div class="panel-group" id="accordion">



<?php $dv = $gm->lista('duvidas');

foreach($dv as $d){ ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title font-alt"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?=$d['duvidaId']?>"><?=$d['duvida']?></a></h4>
            </div>
            <div class="panel-collapse collapse" id="<?=$d['duvidaId']?>">
              <div class="panel-body"><?=$d['resposta']?></div>
            </div>
          </div>
<?php } ?>
    


  </div>


</div>

<div class="col-sm-4 col-md-3">
<?php require_once ('includes/right-cursos.php'); ?>
</div>


</div>
</div>
</div>
</section>