<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aulas de Sax">
    <link rel="icon" href="<?= URL_IMG ?>/icon.png">
    <link rel="stylesheet" href="<?= URL_CSS ?>/style.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&display=swap">
    <title>Ivan Meyer</title>
</head>

<body>
    <div class="navigation-wrap bg-white start-header start-style">
        <div class="container">
            <!-- <div class="row"> -->
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <a class="navbar-brand" href="<?= URL_SITE ?>"><img src="<?= URL_IMG ?>/IvanMeyer.webp" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto py-4 py-md-0">
                        <li class="nav-item pl-0 ml-0 ml-md-4 <?= $page === '' || $page === 'home' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= URL_SITE ?>">Início</a>
                        </li>
                        <li class="nav-item pl-0 ml-0 ml-md-4 <?= $page === 'aulas' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= URL_SITE ?>/aulas">Aulas</a>
                        </li>
                        <li class="nav-item pl-0 ml-0 ml-md-4 <?= $page === 'sobre' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= URL_SITE ?>/sobre">Sobre</a>
                        </li>
                        <li class="nav-item pl-0 ml-0 ml-md-4 <?= $page === 'contato' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= URL_SITE ?>/contato">Contato</a>
                        </li>
                        <li class="nav-item pl-0 ml-0 ml-md-4 <?= $page === 'area-aluno' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= URL_SITE ?>/area-aluno">Área do aluno</a>
                        </li>
                        <li class="pt-4 pt-md-3 pl-0 ml-0 ml-md-4">
                            <button type="button" class="btn-tema btn-modal-login">Login</button>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- </div> -->
        </div>
    </div>

    <section class="banner d-none d-md-block" id="banner">
        <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= URL_IMG ?>/banner1.webp" alt="Banner 1">
                    <div class="carousel-caption">
                        <p class="mb-0">Material didático e acompanhamento incluso</p>
                        <h5>AS MELHORES AULAS DE SAX</h5>
                        <button type="button" class="btn-branco mt-4">Matricule-se</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= URL_IMG ?>/banner3.webp" alt="Banner 2">
                    <div class="carousel-caption text-left">
                        <p class="mb-0">Material didático e acompanhamento incluso</p>
                        <h5>AS MELHORES AULAS DE SAX</h5>
                        <button type="button" class="btn-branco mt-4">Matricule-se</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= URL_IMG ?>/banner2.webp" alt="Banner 3">
                    <div class="carousel-caption text-right">
                        <p class="mb-0">Material didático e acompanhamento incluso</p>
                        <h5>AS MELHORES AULAS DE SAX</h5>
                        <button type="button" class="btn-branco mt-4">Matricule-se</button>
                    </div>
                </div>
            </div>
            <div class="container-indicator">
                <ol class="carousel-indicators">
                    <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselIndicators" data-slide-to="2"></li>
                </ol>
                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <main role="main" class="py-5">
