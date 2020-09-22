<?php 
$add = null;
$catId = null;
$catId2 = null;
if(isset($_POST['upid'])){ 
$add =  $p->updateProduto($_POST,$_FILES,$_POST['upid']);   
}  

if(isset($_GET['dpid'])){
$p->del('aulas','aulaId',$_GET['dpid']);
  
}

$q = '';

if(isset($_GET['curso'])){
$q = " WHERE cursoId='".$_GET['curso']."' order by orden ASC";

if(isset($_GET['modulo'])){
$q = " WHERE cursoId='".$_GET['curso']."' and moduloId = '".$_GET['modulo']."' order by orden ASC";
}
}
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.3/css/rowReorder.dataTables.min.css">
   <section id="main-content">
          <section class="wrapper site-min-height">
           <div class="row">   


 

              <!-- page start-->
              <div class="col-lg-12">
              <section class="panel">

                <div class="row">
                  <div class="col-md-4">
                    <header class="panel-heading">
                      Aulas
                    </header>
                  </div>

                  <div class="col-md-4">
                    <form action="" method="GET">
                      <input type="hidden" name="aulas_listar">
                      <div class="form-group ">

                        <label class="control-label col-lg-2" for="cname" style="height: 39px;line-height: 34px;">Curso </label>
                        <div class="col-lg-10">
                          <select style="float:right"  name="curso" id="" class="form-control " onchange="this.form.submit()">
                            <?php $css = $p->lista('cursos'); foreach ($css as $cu) {?>
                            <option <?php   if(isset($_GET['curso']) && $_GET['curso'] == $cu['cursoId']){echo "selected";}  ?> value="<?=$cu['cursoId'] ?>"><?=$cu['titulo'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>

<?php if(isset($_GET['curso'])){ ?>
                  <div class="col-md-4">
                    <form action="" method="GET">
                      <input type="hidden" name="aulas_listar">
                      <input type="hidden" name="curso" value="<?=$_GET['curso']?>">
                      <div class="form-group ">

                        <label class="control-label col-lg-2" for="cname" style="height: 39px;line-height: 34px;">Modulos </label>
                        <div class="col-lg-10">
                          <select style="float:right"  name="modulo" id="" class="form-control " onchange="this.form.submit()">
                            <option value="">Selecionar Modulo</option>
                            <?php $css = $p->lista('modulos', " WHERE cursoId='".$_GET['curso']."'"); foreach ($css as $cu) {?>
                            <option <?php   if(isset($_GET['modulo']) && $_GET['modulo'] == $cu['moduloId']){echo "selected";}  ?> value="<?=$cu['moduloId'] ?>"><?=$cu['nome'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </form>
                    
                  </div>   
<?php } ?>



                </div>              


                  <div class="panel-body">

 


                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                <tr>
                                  <th>Orden</th>
                                  <th>Título</th>
                                  <th>Curso</th>
                                   <th>Modulo</th>
                                   <th>Envia Email?</th>
                                  <th  style="width:90px"> </th>
                                </tr>
                                </thead>
                                <tbody>

                                  <?php if(!isset($_GET['curso'])){ ?>
                                  <tr class="odd"><td colspan="4" class="dataTables_empty" valign="top">Selecione um curso</td></tr>
                                  <?php }else{ ?>

                                <?php $c =0; $q = $p->lista('aulas', $q); foreach ($q as $r) {
                                    $c = 1+$c;
                                ?>
                                <tr class="gradeX row-aulas">
                                   <td rel="<?=$r['aulaId']?>"><?=$c?></td>
                                    
                                    <td><?=$r['titulo']?></td>
                                    <td>
                                    <?php $cur = $p->getRegistro('cursos','cursoId',$r['cursoId']) ?>
                                    <?=$cur['titulo']?>
                                    </td>

                                    <td>
                                    <?php $cur = $p->getRegistro('modulos','moduloId',$r['moduloId']) ?>
                                    <?=$cur['nome']?>
                                    </td>

                                    <td><?= $r['email'] ? "Sim" : "Não" ?></td>

                                    <td class="center hidden-phone"> 
                                    <a href="?aula_edit&pid=<?=$r['aulaId']?>" >
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                    </a>
                                    <a href="?aulas_listar&dpid=<?=$r['aulaId']?>" onClick="return confirm('Deseja apagar?')"> 
                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> 
                                    </a>
                                    </td>
                                </tr>
                                <?php }   } ?>
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

 

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
  

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
  var table = $('#hidden-table-info').DataTable( {
    rowReorder: true,
    dom: 'Bfrtip',
    buttons: [
    'csv', 'excel', 'pdf', 'print'
    ],
    "iDisplayLength": 50,
  } );

  table.on( 'row-reorder', function ( e, diff, edit ) {
    var result = 'Reorder started on row: '+edit.triggerRow.data()[1]+'<br>';

    for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
      var rowData = table.row( diff[i].node ).data();

      result += rowData[1]+' updated to be in position '+
      diff[i].newData+' (was '+diff[i].oldData+')<br>';
    }

    setTimeout(function(){
    orden =[];
    $('.row-aulas').each(function() {
    aid = $(this).find('td.sorting_1').attr('rel');
    pos = $(this).find('td.sorting_1').text();
    orden.push(aid+":"+pos);
    });
    console.log(orden);

    $.post("ajax.php", {'orden_aulas':JSON.stringify(orden)}, function(data) {  
    //console.log(data);
    });
    }, 2000);

    console.log(result);
  } );
} );
      </script>  