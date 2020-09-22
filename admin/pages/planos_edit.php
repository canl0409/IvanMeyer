
<?php 
$add = null;


if(isset($_POST['upid'])){ 
$add =  $p->updateRegistro($_POST,'planos','planoId',$_POST['upid']);   
}  

if(isset($_GET['pid'])){  
$pd =  $p->getRegistro('planos','planoId',$_GET['pid']);
} 


?>
  
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Editar Plano
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?planos_edit&pid=<?=$_GET['pid']?>" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   enctype="multipart/form-data">
<input type="hidden" value="<?=$pd['planoId']?>" name="upid">

 



<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Nome </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="nome" id="cname" value="<?=$pd['nome']?>"  class="form-control ">
</div>
</div>
 
<div class="form-group ">
  <label class="control-label col-lg-2" for="cname">Categoria </label>
  <div class="col-lg-10">
    <select name="categoriaId" id="" class="form-control ">
      <?php $css = $p->lista('categorias_planos'); foreach ($css as $cu) {?>
      <option <?php   if($pd['categoriaId'] == $cu['categoriaId']){echo "selected";}  ?> value="<?=$cu['categoriaId'] ?>"><?=$cu['nome'] ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Valor</label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="valor" id="cname" value="<?=$pd['valor']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Valor Cortado</label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="valor_antigo" id="cname" value="<?=$pd['valor_antigo']?>"  class="form-control ">
</div>
</div>

 
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Dias </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="dias" id="cname"   value="<?=$pd['dias']?>" class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Parcelamento/Info </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="label_dias" id="cname"   value="<?=$pd['label_dias']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Parcelas Sugeridas </label>
<div class="col-lg-10">
<input type="number" required="" minlength="2" name="parcelas" id="cname"   value="<?=$pd['parcelas']?>" class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Texto 1 </label>
<div class="col-lg-10">
<div class="iconic-input">
    <i class="fa fa-video-camera"></i>
    <input class="form-control"  name="caracteristicas" type="text"   value="<?=$pd['caracteristicas']?>">
</div>
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Texto 2 </label>
<div class="col-lg-10">
<div class="iconic-input">
    <i class="fa fa-id-card"></i>
    <input class="form-control"  name="caracteristica2" type="text"   value="<?=$pd['caracteristica2']?>">
</div>
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Texto 3 </label>
<div class="col-lg-10">
<div class="iconic-input">
    <i class="fa fa-television"></i>
    <input class="form-control"  name="caracteristica3" type="text"  value="<?=$pd['caracteristica3']?>">
</div>
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Duração (número de meses) </label>
<div class="col-lg-10">
<div class="iconic-input">
    <i class="fa fa-television"></i>
    <input class="form-control"  name="meses_duracao" type="text"  value="<?=$pd['meses_duracao']?>">
</div>
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Exibir Home </label>
<div class="col-lg-4">
    <input  name="exibir_home" type="checkbox"  <?php if($pd['exibir_home']){echo 'checked';} ?> >
</div>

<label class="control-label col-lg-2" for="cname">Exibir Em Planos </label>
<div class="col-lg-4">
    <input  name="exibir_pageplano" type="checkbox"  <?php if($pd['exibir_pageplano']){echo 'checked';} ?> >
</div>

</div>
 

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Cursos
<br>
<br>
<button id="select-all" class="btn-danger">Selecionar Todos</button>
<br>
 

</label>
<div class="col-lg-10">
	<select multiple="multiple" name="cursos[]" id="cursos">
	<?php  
	$cursos = array();
    if($pd['cursos']){ $cursos = explode(',',$pd['cursos']); }

	foreach ($p->lista('cursos') as  $curso) {
	?>
	<option  <?php if(in_array($curso['cursoId'],$cursos) ){ echo " selected= 'selected'";} ?>  value="<?=$curso['cursoId']?>"><?=$curso['titulo']?></option>
	<?php }  ?>
	</select>

</div>
</div>
 
<div class="form-group">
<div class="col-lg-offset-2 col-lg-10">
<button type="submit" class="btn btn-danger">Salvar</button>
<button type="button" class="btn btn-default">Cancelar</button>
</div>
</div>
</form>
</div>

</div>
</section>
<!-- page end-->
</section>
</section>


<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script src="js/respond.min.js" ></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>

<!--script for this page-->
<script src="js/form-validation-script.js"></script>

<script src="dist/jquery.multi-select.js"></script>
<script src="dist/jquery.quicksearch.js"></script>

<script>
 

$('#cursos').multiSelect({
 selectableHeader: "<input type='text' class=' form-control search-input' autocomplete='off' placeholder='pesquisar..'>",
  selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='pesquisar..'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});

 $('#select-all').click(function(){
  $('#cursos').multiSelect('select_all');
  return false;
});

$('#deselect-all').click(function(){
  $('#cursos').multiSelect('deselect_all');
  $('#cursos').multiSelect('refresh');
  return false;
});
 
</script>