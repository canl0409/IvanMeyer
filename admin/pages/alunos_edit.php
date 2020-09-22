
<?php 
$add = null;


if(isset($_POST['upid'])){ 
$add =  $p->updateRegistro($_POST,'alunos','alunoId',$_POST['upid']);   
}  

if(isset($_GET['pid'])){  
$pd =  $p->getRegistro('alunos','alunoId',$_GET['pid']);
} 


?>
  

<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
<header class="panel-heading">
Editar Aluno
</header>

<div class="warn"><?=$add?></div>
<div class="panel-body">
<div class=" form">
<form action="?alunos_edit&pid=<?=$_GET['pid']?>" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form"   enctype="multipart/form-data">
<input type="hidden" value="<?=$pd['alunoId']?>" name="upid">

 
<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Nome </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="nome" id="cname" value="<?=$pd['nome']?>"  class="form-control ">
</div>
</div>
 

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Sobrenome </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="sobrenome" id="cname" value="<?=$pd['sobrenome']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">E-mail </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="email" id="cname" value="<?=$pd['email']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">CPF </label>
<div class="col-lg-10">
<input type="text" required="" minlength="2" name="cpf" id="cname" value="<?=$pd['cpf']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Senha </label>
<div class="col-lg-10">
<input type="password" required="" minlength="2" name="senha" id="cname" value="<?=$pd['senha']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Celular </label>
<div class="col-lg-10">
<input type="text"   minlength="2" name="celular" id="cname" value="<?=$pd['celular']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Cidade </label>
<div class="col-lg-10">
<input type="text"  minlength="2" name="cidade" id="cname" value="<?=$pd['cidade']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Estado </label>
<div class="col-lg-10">

<select name="uf" class="form-control ">
    <option selected value="<?=$pd['uf']?>"><?=$pd['uf']?></option>
	<option value="AC">Acre</option>
	<option value="AL">Alagoas</option>
	<option value="AP">Amapá</option>
	<option value="AM">Amazonas</option>
	<option value="BA">Bahia</option>
	<option value="CE">Ceará</option>
	<option value="DF">Distrito Federal</option>
	<option value="ES">Espírito Santo</option>
	<option value="GO">Goiás</option>
	<option value="MA">Maranhão</option>
	<option value="MT">Mato Grosso</option>
	<option value="MS">Mato Grosso do Sul</option>
	<option value="MG">Minas Gerais</option>
	<option value="PA">Pará</option>
	<option value="PB">Paraíba</option>
	<option value="PR">Paraná</option>
	<option value="PE">Pernambuco</option>
	<option value="PI">Piauí</option>
	<option value="RJ">Rio de Janeiro</option>
	<option value="RN">Rio Grande do Norte</option>
	<option value="RS">Rio Grande do Sul</option>
	<option value="RO">Rondônia</option>
	<option value="RR">Roraima</option>
	<option value="SC">Santa Catarina</option>
	<option value="SP">São Paulo</option>
	<option value="SE">Sergipe</option>
	<option value="TO">Tocantins</option>
</select>
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">Endereco </label>
<div class="col-lg-10">
<input type="text"   minlength="2" name="endereco" id="cname" value="<?=$pd['endereco']?>"  class="form-control ">
</div>
</div>

 <div class="form-group ">
<label class="control-label col-lg-2" for="cname">Bairro </label>
<div class="col-lg-10">
<input type="text"  minlength="2" name="bairro" id="cname"    value="<?=$pd['bairro']?>"  class="form-control ">
</div>
</div>

<div class="form-group ">
<label class="control-label col-lg-2" for="cname">CEP </label>
<div class="col-lg-10">
<input type="text"  minlength="2" name="cep" id="cname" value="<?=$pd['cep']?>"  class="form-control ">
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

 