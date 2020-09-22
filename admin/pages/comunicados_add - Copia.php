<?php 
$add = null;
if(isset($_POST['nome'])){  
$add =  $p->addComunicado($_POST,$_FILES);

} 



?>

<style>
.btn-file {
width: 50%;
text-align: left;
font-weight: bold;
}
</style>
<script>
function remove(id){
console.log(id);
$('#'+id).remove();
}

function prevfiles(input) {

var uniq = 'id' + (new Date()).getTime();
if (input.files) {
var filesAmount = input.files.length;

for (i = 0; i < filesAmount; i++) {
var reader = new FileReader();

reader.onload = function(event) {
// $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
console.log(input.files[0].name);
var ul = $(input).closest('ul').attr('id');
$('#'+ul+' .fnae').text(input.files[0].name);
$('#'+ul+' .rmfile').show();

$('.filesbox').append('<ul id="f'+uniq+'" class="fileupload"  ><span  class="btn btn-white btn-file"> <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <span class="fnae">Selecionar arquivo</span></span><input onchange="javascript:prevfiles(this)" type="file" name="imagem[]"  class="default akives " /></span><a href="javascript:remove(\'f'+uniq+'\')" style="display:none"   class="btn btn-danger rmfile"><i class="fa fa-trash"></i> Remover</a></ul>');
}

reader.readAsDataURL(input.files[i]);
}
}

}




</script>
<link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

<style>
#atributos{
margin-top: 19px;
}
#atributos td{
height: 30px;
}
#atributos td input{
border: 1px solid #ddd;
border-radius: 4px;
padding: 2px 3px;
margin-left: 8px;
width: 100px;
}
.ms-container {
	width: 100%;
}
</style>

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Cadastrar nova publicação
</header>
<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   enctype="multipart/form-data">
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Titulo </label>
<div class="col-lg-10">
<input type="text" required minlength="2" name="nome" id="cname" class="form-control error"><label for="cname" class="error">campo requerido.</label>
</div>
</div>


<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Categoria </label>
<div class="col-lg-10">
<select  required   class="form-control " name="categoriaId" > 
<option  value=""  >Selecione uma categoria</option>
<?php 
$g = $p->lista('categorias'); 
foreach ($g as $rg) {  ?>
<option value="<?=$rg['categoriaId']?>"  ><?=$rg['nome']." "?></option>
<?php } ?>
</select>
</div>
</div>




<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Searchable</label>
<div class="col-md-10">
<select name="country" class="multi-select" multiple="" id="my_multi_select3" >
<option value="">Todas</option>
<?php 
$g = $p->lista('corretoras'); 
$i = 0;
foreach ($g as $rg) { $y = $i++;   ?>
<option value="<?=$rg['corretoraId']?>" id="<?=$rg['corretoraId']?>"> <?=$rg['nome']?> </option>
<?php } ?>
</select>
</div>

</div>



<div class="form-group" id="ckcorretoras">
<label class="control-label col-lg-2" for="cname">Selecione as corretoras que deseja enviar:</label>
<div class="row">
<div class="col-md-2">
<input class="corretoras todasco  form-control" style="width:18px;display: inline-block;vertical-align: middle;" name="corretora[]" value="" id="" type="checkbox" checked/> Todas  
</div>
<?php 
$g = $p->lista('corretoras'); 
$i = 0;
foreach ($g as $rg) { $y = $i++;   ?>
<div class="col-md-2 ">
<input class="corretoras corr   form-control" style="width:18px;display: inline-block;vertical-align: middle;"  name="corretora[]" value="<?=$rg['corretoraId']?>" id="<?=$rg['corretoraId']?>" type="checkbox" /> <?=$rg['nome']." "?>  
</div>
<?php } ?>
</div>
</div>



<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Notificação:</label>
<div class="row">
<div class="col-md-2">
<input class="corretoras  form-control" style="width:18px;display: inline-block;vertical-align: middle;" name="notifica_admin" value="1"  type="checkbox"  checked="checked" /> Admin Receber Notificação  
</div>

<div class="col-md-3">
<input class="corretoras  form-control" style="width:18px;display: inline-block;vertical-align: middle;" name="notifica_corretora" value="1" type="checkbox" checked="checked" /> Corretora Receber Notificação  
</div>
</div>
</div>



<div class="form-group ">
<label class="control-label col-lg-2">Arquivos:</label>
<div class="col-md-9 filesbox ">
<ul id="f1" class="fileupload"  >
<span  class="btn btn-white btn-file">
<span class="fileupload-new"><i class="fa fa-paper-clip"></i> <span class="fnae">Selecionar arquivo</span></span>
<input onchange="javascript:prevfiles(this)" type="file" name="imagem[]"  class="default akives "  />
</span>
<a style="display:none" href="javascript:remove('f1')" class="btn btn-danger rmfile"><i class="fa fa-trash"></i> Remover</a>
</ul>
</div>
</div>


 

<div class="form-group ">
<label class="control-label col-lg-2" for="ccomment">Descrição</label>
<div class="col-lg-10">
<textarea  name="descricao" id="ccomment" class="wysihtml5  form-control"></textarea>
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
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script src="js/respond.min.js" ></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>

  <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

<!--script for this page-->
<script src="js/form-validation-script.js"></script>
 
 

<script>



$('.wysihtml5').wysihtml5({
"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
"emphasis": true, //Italics, bold, etc. Default true
"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
"html": false, //Button which allows you to edit the generated HTML. Default false
"link": true, //Button to insert a link. Default true
"image": true, //Button to insert an image. Default true,
"color": false //Button to change color of font  
});


$("#ckcorretoras :checkbox").click(function () {
if($(this).val() == ''){
$('.corr').prop("checked", false);
$(this).prop("checked", true);
}else{
$('.todasco').prop("checked", false);
}

});




    $('#my_multi_select3').multiSelect({
        selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        afterInit: function (ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function (e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function (e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
</script>