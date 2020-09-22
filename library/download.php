<?php
include '../config.php';
include '../vars.php';
include '../helper/functions.php';
include '../class.php';
include '../user.php';
require_once '../includes/header.php';

$baixar = false;
$livroFree = false;
$banner = $gm->getRegistro('banners', "sessao", "mylibrary");

if (!$banner) {
  $banner['imagem'] = "slide-tdm-1.jpg";
}

if (isset($_GET['downloadId'])) {
  $id = $_GET['downloadId'];
} else {
  $msgm = "Arquivo não encontrado!";
}

$livro = $gm->getRegistro('arquivos', "id", $id);


if (!$livro['senha']) {
  $livroFree = true;
}

if (isset($_POST['senha'])) {
  if ($_POST['senha'] == $livro['senha']) {
    $baixar = true;
  } else {
    $msgm = "Senha incorreta";
  }
}
?>

<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?= u . "assets/imgs/" . $banner['imagem'] ?>">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Download</div>
    </div>
  </div>
</section>

<div class="main mb-40">

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="post-meta"><a href="<?= u ?>">Home</a> <a href="<?= u ?>mylibrary">MyLibrary</a> Download</div>
      </div>
    </div>

    <section class="module">
      <div class="row">
        <?php if (!$baixar) {  ?>
          <h2 class="module-title module-title-inside font-alt mb-10">Download</h2>
          <p class="subtitle mb-40">Encontre o código na última página do livro.
            <br />Find the code on the last book's page.</p>
        <?php }  ?>

        <?php if ($baixar && !$livroFree) {  ?>
          <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-success" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>SENHA CORRETA! <br /> </strong>
              Clique no(s) link(s) abaixo para baixar o(s) arquivo(s).
            </div>
            <div class="row">
              <ul>
                <?php foreach (explode(";", $livro['link']) as $link) { ?>
                  <li>
                    <a href="<?= $link ?>" target="_blank"><?= $link ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        <?php }  ?>


        <?php if ($livroFree) {  ?>
          <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-success" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>LIVRO GRATUITO! <br /> </strong>
              Clique no(s) link(s) abaixo para baixar o(s) arquivo(s).
            </div>
            <div class="row">
              <ul>
                <?php foreach (explode(";", $livro['link']) as $link) { ?>
                  <li>
                    <a href="<?= $link ?>" target="_blank"><?= $link ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        <?php }  ?>


        <?php if ($msgm) {  ?>
          <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-danger" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Opss.. <br /> </strong> <?= $msgm ?></div>
          </div>
        <?php }  ?>

        <?php if (!$baixar && !$livroFree) {  ?>
          <div class="col-md-4 col-md-offset-4">
            <div class="card" style="width: 100%;">
              <?php if ($livro['capa'] != "") { ?>
                <img src="<?= u . 'arquivos/capas/' . $livro['capa'] ?>" alt="capa livro" width="100%" style="height: 250px">
              <?php } else { ?>
                <img src="<?= u ?>arquivos/capas/no-image.png" alt="capa livro" width="100%" style="height: 200px">
              <?php } ?>
              <div class="card-body">
                <h5 class="card-title" style="text-align: center;"><?= $livro['titulo'] ?></h5>
                <!--<form method="post" action="?id=<?= $id ?>">-->
                <form method="post">
                  <div class="form-group ">
                    <label class="control-label">Senha / Password</label>
                    <input type="password" name="senha" class="form-control" />
                  </div>
                  <button type="submit" class="btn btPadrao" style="margin: 0 auto; display: block">Download</button>
                </form>
              </div>
            </div>
          </div>

        <?php }  ?>

      </div>

    </section>

  </div>
</div>
