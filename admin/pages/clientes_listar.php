   <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Clientes
                  </header>
                  <div class="panel-body">
                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th class="hidden-phone">Telefone</th>
                                 
                                    <th class="hidden-phone">Cidade </th>
                                    <th class="hidden-phone">Endereço </th>
                                    <th class="hidden-phone">Cep </th>
                                     <th class="hidden-phone">Data de Cadastro </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $q = $p->clientes(); foreach ($q as $r) {
                                    
                                ?>
                                <tr class="gradeX">
                                    <td><?=$r['nome']?></td>
                                    <td><?=$r['email']?></td>
                                    <td class="hidden-phone"><?=$r['telefone']?></td>
                                     
                                    <td class="center hidden-phone"> <?=$r['cidade']?> - <?=$r['uf']?></td>
                                     <td class="center hidden-phone"> <?=$r['endereco']?></td>
                                      <td class="center hidden-phone">  <?=$r['cep']?></td>
                                         <td class="center hidden-phone"> <?=date( 'd/m/Y ', strtotime ($r['inscricao']) );?></td>
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
 
       <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#hidden-table-info').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
      </script>  