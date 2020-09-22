<div class="lesson-content" style="text-align:center; height: 100%; z-index: 9999">

    <h1><?=$a->titulo?></h1>
  
 <?php $tipoa = tipoMidia($a->video,$a->texto,$a->audio);  

 if($a->video != ''){ ?>
<div class="cvideo">
 <iframe id="iframeVideoHome" src="<?=str_replace('vimeo.com/','player.vimeo.com/video/',$a->video)?>" width="95%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<?php } ?>


 <?php
 if(isset($a->audio)){
 ?>

<div class="content audiobox" style="display:none">
<?php   $afiles = (array)json_decode($a->audio);
        foreach($afiles as $codefile => $aff){ ?>
  <div class="row cursos-audio">
    <div class="col-md-10"><audio src="<?=u?>assets/audio/<?=$aff?>" preload="auto" controls></audio></div>
    <div class="col-md-2"> <a download href="<?=u?>assets/audio/<?=$aff?>"> <button class='btn btn-info btn-xs'> <i class="fa fa-download" aria-hidden="true"></i> Download</button></a></div>
  </div>
 <?php }  ?>
</div>

<script>
  $(document).ready(function() {
    $( 'audio' ).audioPlayer(
    {
    classPrefix: 'audioplayer',
    strPlay: 'Play',
    strPause: 'Pause',
    strVolume: 'Volume'
    });
  });
</script>
<?php } ?>



  <div class="content content-aula">
  <div>
    
<?php 

$pattern = "/\[audio ([\s\w\.\(\)\-]+)\]/i";
$rpl     = '<div class="row cursos-audio">
    <div class="col-md-10"><audio src="'.u.'assets/audio/${1}" preload="auto" controls></audio></div>
    <div class="col-md-2"> <a download href="'.u.'assets/audio/${1}"> <button class="btn btn-info btn-xs"> <i class="fa fa-download" aria-hidden="true"></i> Download</button></a></div>
  </div>';
$ntext =  preg_replace($pattern, $rpl, $a->texto);
echo $ntext;
 ?>


  </div>

 
    <?php if($a->files){  ?>
   <h3 style="border-top: dashed 1px #eee;">Arquivos:</h3>
    <?php    
    $afiles = (array)json_decode($a->files);
    foreach($afiles as $codefile => $aff){
    ?>
    <div style="padding-bottom: 5px;">
    <i class="fa fa-file" aria-hidden="true"></i>
    <span style="width: 300px;display: inline-table;padding-left: 10px;"><?=$aff?></span>
    <a target="_blank" href="<?=u?>assets/files/<?=$aff?>"><i class="fa fa-download" aria-hidden="true"></i>
    </a>
    </div>

    <?php  } } ?>

    <div class="nexprelesson">
      <div class="pull-left">
        <span><button id="pnamebt" class="btn btn-sm course-item-flip"><i class="fa fa-caret-left" aria-hidden="true"></i> Anterior</button></span>
        <p id="pname" style="font-size: 10px"></></p>
      </div>
      <div class="pull-right">
        <span><button  id="nnamebt"  class="btn btn-sm course-item-flip">Próxima <i class="fa fa-caret-right" aria-hidden="true"></i></button></span>
        <p id="nname" style="font-size: 10px"></p>
      </div>
    </div>
  </div>
</div>