
<?php 
 

 $add = null;
 if(isset($_POST['alunoId'])){  
 //$add =  $p->addRegistro($_POST,'cursos_matriculas');
 } 
 
 if(isset($_POST['editassinatura'])){
	 $add =  $p->atualizaAssinatura($_POST); 
 }else{
 
	 if(isset($_POST['upid']) && isset($_POST['alunoId'])){ 
		  $add =  $p->atualizaMatricula($_POST);   
	 } else if(isset($_POST['upid'])){ 
		 $add =  $p->updateRegistro($_POST,'alunos','alunoId');   
	 } 
 
 }
 
   
 
 if(isset($_GET['pid'])){  
 $pd =  $p->getRegistro('alunos','alunoId',$_GET['pid']);
 } 
 
 
 if(isset($_GET['dcmId'])){
 $p->del('cursos_matriculas','cmId',$_GET['dcmId']);
 }
 
 if(isset($_GET['dAssId'])){
 $p->del('assinaturas','assinaturaId',$_GET['dAssId']);
 }
 
 ?>
   
 
 
 
 
 <section id="main-content">
 <section class="wrapper site-min-height">
 <!-- page start-->
 <section class="panel">
 <header class="panel-heading">
 Dados do  Aluno
 </header>
 
 <div class="warn"><?=$add?></div>
 
 
 <div class="panel-body">
 
 
 
 
 
 <section class="panel">
 <header class="panel-heading tab-bg-dark-navy-blue tab-right ">
   <ul class="nav nav-tabs pull-right">
	   <li class="active">
		   <a data-toggle="tab" href="#home-3" aria-expanded="true">
			   <i class="fa fa-home"></i>
		   </a>
	   </li>
	   <li class="">
		   <a data-toggle="tab" href="#about-3" aria-expanded="false">
			   <i class="fa fa-book"></i>
			   Cursos
		   </a>
	   </li>
	   <li class="">
		   <a data-toggle="tab" href="#contact-3" aria-expanded="false">
			   <i class="fa fa-money"></i>
			   Pagamentos
		   </a>
	   </li>
	   <li class="">
		   <a data-toggle="tab" href="#assinatura-3" aria-expanded="false">
			   <i class="fa fa-archive"></i>
			   Assinaturas
		   </a>
	   </li>
   </ul>
   <span class="hidden-sm wht-color"><?=$pd['nome']?></span>
 </header>
 <div class="panel-body">
   <div class="tab-content">
	   <div id="home-3" class="tab-pane active">
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
			 <input type="text" required="" minlength="2" name="sobrenome" id="csobrenome" value="<?=$pd['sobrenome']?>"  class="form-control ">
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
 
	   <div id="about-3" class="tab-pane">
			 <table class="table table-striped table-advance table-hover">
			 <thead>
			 <tr>
			 <th><i class="fa fa-user"></i> Aluno</th>
			 <th><i class="fa fa-book"></i> Curso</th>
			 <th><i class="fa fa-bullhorn"></i> Data Matrícula</th>
			 <th><i class="fa fa-bullhorn"></i> Data Expiração</th>
			 <th></th>
			 </tr>
			 </thead>
			 <tbody>
			 <?php 
			 		include_once("../class.php");
			 		$q = $gm->getMeusCursosAlunoAdm($pd['alunoId']);
			 		//$q = $p->lista('cursos_matriculas'," where alunoId ='$pd[alunoId]' "); 
				   foreach ($q as $cm) {
			 ?>
			 <tr class="gradeX">
			 <td><?php echo $pd['nome']; ?> </td>
			 <td class="col-md-3" ><?=$cm['titulo']?></td>
			 <td class="center hidden-phone"> <?= isset($cm['data']) ? date( 'd/m/Y H:i ', strtotime ($cm['data'])) : "" ?></td>
			 <td class="center hidden-phone"> <?=$gm->vencimento($cm['cursoId'], null, $pd['alunoId'])?></td>
			 <td>
			 
				<?=$gm->cursoProgresso($cm['cursoId'], $pd['alunoId'])."% Concluído"; ?>
							  
			 	<a data-toggle="modal" href="#mod<?=$pd['alunoId'].$cm['cursoId']?>">
				 	<button type="button" class="btn btn-info btn-xs">Ver Progresso</button>
				</a>
				
				<?php if(isset($cm['cmId'])){ ?>
			 	<a href="?matricula_edit&pid=<?=$cm['cmId']?>" >
			 		<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
				 </a>
				<?php } ?>
			 </td>
			 </tr>
  
			 <?php include 'pages/modal_aulasvistas.php';
			  }   ?>
			 </tbody>
			 </table>
 
			 <a href="?matricula_add&alunoid=<?=$pd['alunoId']?>"><button style="margin-top:20px;" type="button" class="btn btn-success btn-sm">Adicionar Matrícula</button></a>
	   </div>
 
	   <div id="assinatura-3" class="tab-pane">
			 <table class="table table-striped table-advance table-hover">
			 <thead>
			 <tr>
			 <th><i class="fa fa-bullhorn"></i> Aluno</th>
			 <th class="hidden-phone"><i class="fa fa-question-circle"></i> Plano</th>
			 <th><i class="fa fa-bookmark"></i> Data Expiração</th>
			 <th><i class="fa fa-bookmark"></i> Status</th>
			 <th></th>
			 </tr>
			 </thead>
			 <tbody>
			 <?php $q = $p->lista('assinaturas'," where alunoId ='$pd[alunoId]' "); 
				   foreach ($q as $cm) {
				   $cs =  $p->getRegistro('planos','planoId',$cm['planoId']);

					$hoje = new DateTime(date('Y-m-d'));
					$vencimento = new DateTime('22-01-1990');
					$vencimento = $cm['vencimento'] ? new DateTime(date('Y-m-d',strtotime($cm['vencimento']))) : $vencimento;;
			
					$status = $cm['status'];
					$classStatus = "label-warning";
					
					if($cm['vencimento']){
						$labelVencimento = $vencimento->format("d/m/Y");
						if($hoje > $vencimento){
							$status = "expirado";
							$classStatus = "label-danger";
						}else{
							$status = "ativo";
							$classStatus = "label-success";
						}
					}else{
						$status = "Nenhum";
						$labelVencimento = "";
					}
			 ?>
			 <tr class="gradeX">
			 <td><?php echo $pd['nome']; ?> </td>
			 <td class="col-md-3" ><?=$cs['nome']?></td>
			 <td class="center hidden-phone"> <?=$labelVencimento;?></td>
			 <td class="col-md-3" >
				 <span class="label label-mini <?=$classStatus?>">
					 <?=$status?>
				 </span>
			 <td>
			 <a href="?assinatura_edit&pid=<?=$cm['assinaturaId']?>" >
			 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
			 </a>
			 </td>
			 </tr>
  
			 <?php  }   ?>
			 </tbody>
			 </table>
 
			 <a href="?assinatura_add&alunoid=<?=$pd['alunoId']?>"><button style="margin-top:20px;" type="button" class="btn btn-success btn-sm">Adicionar Assinatura</button></a>
	   </div>
 
	   <div id="contact-3" class="tab-pane">
		 <table class="table table-striped table-advance table-hover">
		 <thead>
		 <tr>
		 <th><i class="fa fa-bullhorn"></i> Aluno</th>
		 <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descricao</th>
		 <th><i class="fa fa-bookmark"></i> Data</th>
		 <th><i class=" fa fa-edit"></i> Status</th>
		 <th></th>
		 </tr>
		 </thead>
		 <tbody>
		 <?php $q = $p->lista('pagamentos'," where alunoId ='$pd[alunoId]' ORDER BY pagamentoId DESC"); foreach ($q as $cs) {
 
		 ?>
		 <tr class="gradeX">
		 <td><?php $al = $p->getRegistro('alunos','alunoId',$cs['alunoId']); echo $al['nome']; ?> </td>
		 <td class="col-md-3" ><?=$cs['produto']?></td>
		 <td class="center hidden-phone"> <?=date( 'd/m/Y H:i ', strtotime ($cs['data']) );?></td>
		 <td> <?php echo $p->statusPg($cs['status_pagamento']) ?> </td>
		 <td><?=money($cs['valor'])?></td>
		 </tr>
		 <?php }   ?>
		 </tbody>
		 </table>
	   </div>
 
   </div>
 </div>
 </section>
 
  
 
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
  
 
 <?php  if(isset($_POST['alunoId']) or $_GET['tab'] == 2 or isset($_GET['dcmId'])){  ?>
 <script>$( document ).ready(function() {
	$("a[href$='#about-3']").click();
 });</script>
 <?php } ?>
 
 <?php  if(  $_GET['tab'] == 3 or isset($_POST['editassinatura'])){  ?>
 <script>$( document ).ready(function() {
	$("a[href$='#assinatura-3']").click();
 });</script>
 <?php } ?>