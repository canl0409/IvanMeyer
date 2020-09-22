<?php 

if(isset($_GET['dpid'])){
$p->del('pagamentos','pagamentoId',$_GET['dpid']);
}
 ?>



<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <section class="panel">
      <header class="panel-heading">
      Pagamentos
      </header>
      <div class="panel-body">
        <div class="adv-table">
          <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
            <thead>
              <tr>
                <th class="col-md-3">Aluno</th>
                <th>Email</th>
                <th>Produto</th>
                <th class="hidden-phone">Data </th>
                <th>Status</th>
                <th>Valor</th>
                  <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $q = $p->lista('pagamentos',"ORDER BY pagamentoId DESC"); foreach ($q as $cs) {

                ?>
                <tr class="gradeX">
                  <td><?php $al = $p->getRegistro('alunos','alunoId',$cs['alunoId']); echo $al['nome']; ?> </td>
                  <td><?=$cs['email_consumidor']?></td>
                  <td class="col-md-3" ><?=$cs['produto']?></td>
                  <td class="center hidden-phone"> 
                    <p style="height:0px; overflow: hidden;"><?=date( 'Ymd ', strtotime ($cs['data']) );?></p>

                    <?=date( 'd/m/Y H:i ', strtotime ($cs['data']) );?></td>

           <td> <?php echo $p->statusPg($cs['status_pagamento']) ?> </td>

                    <td><?=money($cs['valor'])?></td>
           
                    <td>
                     <a href="?pagamentos_listar&dpid=<?=$cs['pagamentoId']?>" onClick="return confirm('Deseja apagar?')"> 
                    <button  data-original-title="Deletar" class=" tooltips btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> 
                    </a></td>

                    
                  </tr>
                  <?php }   ?>
                </tbody>
              </table>

            </div>
          </div>
        </section>
        <!-- page end-->
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
<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/date-eu.js"></script>


<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#hidden-table-info').dataTable( {


"aaSorting": [[ 4, "desc" ]],
dom: 'Bfrtip',
"iDisplayLength": 100,
buttons: [
'csv', 'excel', 'pdf', 'print'
]
} );






        $("input[type='checkbox']").on('click', function(){

          bx = $(this).val();
          var corretoras='';
          $('.corretoras'+bx+':checked').each(function(){
            corretoras=corretoras+$(this).attr('id')+',';

          });
          console.log(corretoras);
          $.post('ajax.php', { vendedor:bx, corretoras:corretoras }, function(data){
// data = 0 - means that there was an error
// data = 1 - means that everything is ok
if(data == 1){
// Do something or do nothing :-)
alert('Data was saved in db!');
}
});

        });



      } );
    </script>  