<?php if($cs){ 
$css2 = $gm->lista('cursos', " where plano_free <> 1 and categoriaId = '".$cs['categoriaId']."' ");
	?>
<aside id="course-categories-3" class="widget widget_course-categories" style="padding: 0;border-left: 2px solid #fee;">
	<div class="list-group">
    <h4 class="widget-title" style="padding-left: 15px">Cursos Relacionados</h4>
		 <?php foreach ($css2 as $cs2){ ?>
			<a href="<?=u?>curso-de-musica-online/<?=ln($cs2['titulo'])?>" class="list-group-item" style="border-left: none; border-color: #eee">
        <?=$cs2['titulo']?>
      </a>
			<?php  } ?>
  </div>
</aside>

<aside id="course-categories-3" class="widget widget_course-categories" style="padding: 0;border-left: 2px solid #fee;">
	<div class="list-group">
		<h4 class="widget-title" style="padding-left: 15px">Outros Cursos</h4>
		 <?php $css2 = $gm->lista('cursos', " where plano_free <> 1 and categoriaId != '".$cs['categoriaId']."' ");
		 foreach ($css2 as $cs2){ ?>
			<a href="<?=u?>curso-de-musica-online/<?=ln($cs2['titulo'])?>" class="list-group-item" style="border-left: none; border-color: #eee">
        <?=$cs2['titulo']?>
      </a>
			<?php  } ?>
	</div>
</aside>
<?php  } ?>