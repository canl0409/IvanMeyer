<?php 
$add = null;
$catId = null;
$q = null;


if(isset($_GET['dpid'])){
$p->del('cursos','cursoId',$_GET['dpid']);
  
}

if(isset($_GET['categoria'])){
$q = " WHERE categoriaId='".$_GET['categoria']."'";
}

?>
   <section id="main-content">
          <section class="wrapper site-min-height">
           <div class="row">   


 

              <!-- page start-->
              <div class="col-lg-12">
              <section class="panel">


                <div class="row">
                  <div class="col-md-8">
                    <header class="panel-heading">
                      Cursos
                    </header>
                  </div>

                  <div class="col-md-4">
                    <form action="" method="GET">
                      <input type="hidden" name="cursos_listar">
                      <div class="form-group ">

                        <label class="control-label col-lg-2" for="cname" style="height: 39px;line-height: 34px;">Categoria </label>
                        <div class="col-lg-10">
                          <select style="float:right"  name="categoria" id="" class="form-control " onchange="this.form.submit()">
                            <?php $css = $p->lista('categorias'); foreach ($css as $cu) {?>
                            <option <?php   if(isset($_GET['categoria']) && $_GET['categoria'] == $cu['categoriaId']){echo "selected";}  ?> value="<?=$cu['categoriaId'] ?>"><?=$cu['nome'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>    

                  <div class="panel-body">


                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                <tr>
                                <th style="width:90px"></th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Nível</th>
                                    <th>Destaque</th>
                                    <th>Alunos</th>
                                    <th>Opiniões</th>
                                    <th>Ordem</th>
                                    <th></th>
                                  <th  style="width:90px"> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $q = $p->lista('cursos',$q); foreach ($q as $r) {
                                    
                                ?>
                                <tr class="gradeX">
                                    <td> 
                                    <?php if($r['thumb'] != ''){ ?>
                                    <img style="width:40px;" src="../assets/imgs/cursos/<?=$r['thumb']?>" />
                                    <?php }else{ ?>
                                    <img style="width:40px;" src="../assets/imgs/thumb.png" />
                                    <?php } ?>
                                     </td>
                                    <td><?=$r['titulo']?></td>

                                    <td>
                                    <?php $cur = $p->getRegistro('categorias','categoriaId',$r['categoriaId']) ?>
                                    <?=$cur['nome']?>
                                    </td>
                                     <td>
                                    <?php $ni = $p->getRegistro('niveis','nivelId',$r['nivel']) ?>
                                    <?=$ni['nome']?>
                                    </td>

                                    <td>
                                      <span class="label label-mini <?=$r['destaque_home'] ? 'label-success' : 'label-danger'?>">
                                        <?=$r['destaque_home'] ? "Sim" : "Não"?>
                                      </span>
                                    </td>

                                    <td><span class="label label-info label-mini">
<?php echo $p->countreg('cursos_matriculas'," where cursoId='$r[cursoId]' ");?>
                                    </span></td>
                                    <td><span class="label label-info label-mini">
<?php echo $p->countreg('opinioes'," where cursoId='$r[cursoId]' ");?>
                                    </span></td>

                                    <td>
                                      <span class="label label-primary label-mini">
                                        <?=$r['ordem']?>
                                      </span>
                                    </td>

                                    <td><a href="?aulas_listar&curso=<?=$r['cursoId']?>"><span class="label label-info label-mini">Listar Aulas</span></a></td>

                                    <td class="center hidden-phone"> 
                                    <a href="?curso_edit&pid=<?=$r['cursoId']?>" >
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                    </a>
                                    <a href="?cursos_listar&dpid=<?=$r['cursoId']?>" onClick="return confirm('Deseja apagar?')"> 
                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> 
                                    </a>
                                    </td>
                                </tr>
                                <?php }   ?>
                                </tbody>
                            </table>

                        </div>
                  </div>
              </section>
              </div>
              <!-- page end-->


              </div>
          </section>
      </section>


       <!-- js placed at the end of the document so the pages load faster -->
    <!--<script src="js/jquery.js"></script>-->
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>

    <!--common script for all pages-->
 
<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script type="text/javascript" src="assets/advanced-datatable/media/js/buttons.html5.js"></script>
<script type="text/javascript" src="assets/advanced-datatable/media/js/buttons.print.js"></script>



<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#hidden-table-info').dataTable( {
"aaSorting": [[ 1, "desc" ]],
dom: 'Bfrtip',
"iDisplayLength": 100,
buttons: [
'csv', 'excel', 'pdf', 'print'
]
} );
} );

      </script>  