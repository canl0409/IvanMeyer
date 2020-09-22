<?php
$banner = $gm->getRegistro('banners', "sessao", "mylibrary");

if(!$banner){
  $banner['imagem'] = "slide-tdm-1.jpg";
}
?>

<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?=u."assets/imgs/".$banner['imagem']?>">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Biblioteca / Library</div>
    </div>
  </div>
</section>

<div class="main mb-40">

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="post-meta"><a href="<?=u?>">Home</a>  MyLibrary</div>
      </div>
    </div>



    <section class="module"  >
        <div class="row">
            <h2 class="module-title module-title-inside font-alt mb-10">Livros / Books</h2>
            <p class="subtitle mb-40">Escolha o livro / Choose the book</p>
            <?php
              $livros = $gm->lista('arquivos', "where tipo = 1");
              foreach($livros as $livro){  ?>

              <div class="col-md-3">
                <div class="card" style="width: 100%;">
                <?php if($livro['capa'] != ""){ ?>
                  <img src="<?=u.'arquivos/capas/'.$livro['capa']?>" alt="capa livro" width="100%" style="height: 200px">
                <?php }else{ ?>
                  <img src="<?=u?>arquivos/capas/no-image.png" alt="capa livro" width="100%" style="height: 200px">
                <?php } ?>
                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center;"><?=$livro['titulo']?></h5>
                    <a href="library/download.php?downloadId=<?=$livro['id']?>" class="btn btPadrao" style="margin: 0 auto; display: block">Download</a>
                  </div>
                </div>
              </div>

              <?php
              }
            ?>
          </div>

        </section>

      </div>
    </div>
