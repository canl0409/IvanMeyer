<?php

$page = $_SERVER['REQUEST_URI'] == "/" ? "home" :  $_SERVER['REQUEST_URI'];
$exp = explode("?", $page);
$page = $exp[0];
//$queryString = $exp[1];
if ($page == "/") {
    $page = 'home';
}
// echo "<script type='text/javascript'>console.log('{$page}')</script>";

// $title = site_title;
// $r2 = null;
// $imgog = 'https://terradamusica.com.br:443/assets/imgs/logo_site.png';
// $ogdescription = "Aqui você encontra cursos teóricos e práticos, de instrumento, de harmonia, improvisação, teoria e muito mais.";
// $catname = null;
// $esporteId = null;
// $leagueId = null;

if (isset($_GET['q']) == 1) {
    $reqq = trim($_SERVER['REQUEST_URI'], '/');
    $qrs = explode('/', $reqq);
    $pagex = end($qrs);
    $terms = explode('?', $pagex);
    $pagex = $terms[0];

    $revreq = array_reverse($qrs);

    if ($revreq[0] == 'sair') {
        $user->sair();
        die;
    }

    if (file_exists('pages/' . $revreq[0] . '.php')) {
        $page = $pagex;
    } else {
        $page = '404';
    }
    // header('Location:' . URL_SITE);
}

// echo "<script type='text/javascript'>console.log('Final: {$page}')</script>";
