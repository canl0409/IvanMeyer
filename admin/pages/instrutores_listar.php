<?php 
$add = null;
$catId = null;
$catId2 = null;


if(isset($_GET['dpid'])){
$p->del('instrutores','instrutorId',$_GET['dpid']);
  
}

if(isset($_GET['catId'])){
$catId = "and catId='".$_GET['catId']."'";
$catId2 = $_GET['catId'];
}
?>
   <section id="main-content">
          <section class="wrapper site-min-height">
           <div class="row">   


 

              <!-- page start-->
              <div class="col-lg-12">
              <section class="panel">
                  <header class="panel-heading">
                   Intrutores
                  </header>
                  <div class="panel-body">


                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                <tr>
                                <th style="width:90px"></th>
                                    <th>Nome</th>
                                  <th  style="width:90px"> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $q = $p->lista('instrutores'); foreach ($q as $r) {
                                    
                                ?>
                                <tr class="gradeX">
                                    <td> <img style="width:40px;" src="../assets/imgs/team/<?=$r['foto']?>" /> </td>
                                    <td><?=$r['nome']?></td>

                                    <td class="center hidden-phone"> 
                                    <a href="?instrutor_edit&pid=<?=$r['instrutorId']?>" >
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                    </a>
                                    <a href="?instrutores_listar&dpid=<?=$r['instrutorId']?>" onClick="return confirm('Deseja apagar?')"> 
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