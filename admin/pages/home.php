.<?php 
//var_dump($p->countUsers());  
?>
<link href="assets/morris.js-0.4.3/morris.css" rel="stylesheet" />
<section id="main-content">
<section class="wrapper">
<!--state overview start-->


<div class="row state-overview">



<div class="col-lg-3 col-sm-3">
<section class="panel">
<div class="symbol terques">
  <i class="fa fa-book" aria-hidden="true"></i>
</div>
<div class="value">
<h1 class="chamadosf">
<?=$p->countreg('cursos')?>
</h1>
<p>Cursos</p>
</div>
</section>
</div>



<div class="col-lg-3 col-sm-3">
<section class="panel">
<div class="symbol red">
   <i class="fa fa-user" aria-hidden="true"></i>
</div>
<div class="value">
<h1 class="count">
<?=$p->countreg('alunos')?>
</h1>
<p>Alunos</p>
</div>
</section>
</div>






<div class="col-lg-3 col-sm-3">
<section class="panel">
<div class="symbol red">
   <i class="fa fa-users" aria-hidden="true"></i>
</div>
<div class="value">
<h1 class="count">
<?=$p->countreg('instrutores')?>
</h1>
<p>Instrutores</p>
</div>
</section>
</div>



<div class="col-lg-3 col-sm-3">
<section class="panel">
<div class="symbol terques">
  <i class="fa fa-star-half-o" aria-hidden="true"></i>
</div>
<div class="value">
<h1 class="chamadosf">
<?=$p->countreg('opinioes')?>
</h1>
<p>Opiniões</p>
</div>
</section>
</div>

 
  

</div>
<!--state overview end-->




<div class="row">


                    <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body">
                              <div class="task-thumb-details">
                                  <h1>Pagamentos</h1>
                                  <p>Transações recentes</p>
                              </div>

                          </div>
                          <table class="table table-hover personal-task">
                              <tbody>
                                <?php $css = $p->lista('pagamentos'," order by pagamentoId desc limit 5");  
                                foreach($css as $cs){?>
                              <tr>
                                  <td> <?php $al = $p->getRegistro('alunos','alunoId',$cs['alunoId']); echo $al['nome']; ?> </td>
                                  <td><?=$cs['produto']?></td>
                                  <td><?=$cs['tipo_pagamento']?></td>
                                  <td> <?php echo $p->statusPg($cs['status_pagamento']) ?> </td>
                                  <td><?=money($cs['valor'])?></td>
                                  <td>
                                    <div ><?=data($cs['data'])?></div>
                                  </td>
                              </tr>
                              <?php  }?>
                                  <tr>
                                  <td> </td>
                                  <td></td>
                                  <td> </td>
                                  <td></td>
                                  <td>
                                    <a href="?pagamentos_listar">ver todos</a>
                                  </td>
                              </tr>
                             
                              </tbody>
                          </table>
                      </section>
                      <!--work progress end-->
                  </div>

                  <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="panel">
                          <div class="panel-body">
                        
                              <div class="task-thumb-details">
                                  <h1><a href="#">Cursos</a></h1>
                                  <p>Mais acessados</p>
                              </div>
                          </div>
                          <table class="table table-hover personal-task">
                              <tbody>
                               <?php $css = $p->lista('cursos'," order by cursoId desc limit 5");  
                                foreach($css as $cs){?>
                                <tr>
                                    <td>
                                         
                                    </td>
                                    <td><?=($cs['titulo'])?></td>
                                    <td> 02</td>
                                </tr>
                                  <?php  } ?>
                              </tbody>
                          </table>
                      </section>
                      <!--user info table end-->
                  </div>

              </div>


 


</section>
</section>
<!--main content end-->
 

<!--<script src="js/jquery.js"></script>-->
<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>

<!--common script for all pages-->

  
    <script src="assets/morris.js-0.4.3/morris.min.js" type="text/javascript"></script>
    <script src="assets/morris.js-0.4.3/raphael-min.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>

    <!--common script for all pages-->
 

    <!-- script for this page only-->
     