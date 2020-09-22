<?php
$add = null;
if (isset($_POST['nome'])) {
  $add =  $p->addRegistro($_POST, 'categorias_planos');
} ?>


<?php

$catId = null;
$catId2 = null;


if (isset($_GET['dpid'])) {
  $p->del('categorias_planos', 'categoriaId', $_GET['dpid']);
}

if (isset($_GET['catId'])) {
  $catId = "and catId='" . $_GET['catId'] . "'";
  $catId2 = $_GET['catId'];
}
?>

<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <section class="panel">
      <header class="panel-heading">
        Cadastrar Categoria de plano
      </header>
      <div class="warn"><?= $add ?></div>


      <div class="panel-body">
        <div class=" form">
          <form action="" method="POST" id="commentForm" class="cmxform form-horizontal tasi-form" enctype="multipart/form-data">
            <div class="form-group ">
              <label class="control-label col-lg-2" for="cname">Nome </label>
              <div class="col-lg-6">
                <input type="text" required="" minlength="2" name="nome" id="cname" class="form-control ">
              </div>
              <div class="col-lg-4">
                <button type="submit" class="btn btn-danger">Salvar</button>

              </div>
          </form>
        </div>
      </div>



      <div class="panel-body">
        <div class="adv-table">
          <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
            <thead>
              <tr>

                <th>Título</th>
                <th style="width:90px"> </th>
              </tr>
            </thead>
            <tbody>
              <?php $q = $p->lista('categorias_planos');
              foreach ($q as $r) {

              ?>
                <tr class="gradeX">
                  <td><?= $r['nome'] ?></td>

                  <td class="center hidden-phone">
                    <a href="?categoria_plano_edit&pid=<?= $r['categoriaId'] ?>">
                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                    </a>
                    <a href="?categoria_plano_add&dpid=<?= $r['categoriaId'] ?>" onClick="return confirm('Deseja apagar?')">
                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </a>
                  </td>
                </tr>
              <?php }   ?>
            </tbody>
          </table>
        </div>
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
<script src="js/respond.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>

<!--script for this page-->
<script src="js/form-validation-script.js"></script>
