<?php
$planoId = isset($qrs[2]) ? $qrs[2] : 1;
$qc = " and categoriaId = '" . $planoId . "' ";
$detalhesDoPlano =  $gm->getRegistro('categorias_planos', 'categoriaId', $planoId);
$banners = $gm->lista('banners', " where sessao = 'plano".$planoId."' ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Curso online de <?=$detalhesDoPlano['nome']?> - Terra da Música relovucione sua forma de aprender música</title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?=$detalhesDoPlano['description']?>">
<meta name="keywords" content="<?=$detalhesDoPlano['keywords']?>">

<meta property="og:title" content="Curso online de <?=$detalhesDoPlano['nome']?> - Terra da Música relovucione sua forma de aprender música">
<meta property="og:site_name" content="Terra da Música">
<meta property="og:image" content="<?=u?>assets/images/<?=$banners[0]['imagem']?>">
<meta property="og:description" content="<?=$detalhesDoPlano['description']?>" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="<?=u?>assets/styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="<?=u?>assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=u?>assets/plugins/OwlCarousel2-2.3.4/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?=u?>assets/plugins/OwlCarousel2-2.3.4/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?=u?>assets/plugins/OwlCarousel2-2.3.4/animate.css">
<link rel="stylesheet" type="text/css" href="<?=u?>assets/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?=u?>assets/styles/responsive.css">
<link rel="stylesheet" type="text/css" href="<?=u?>assets/styles/elements.css">
<link rel="stylesheet" type="text/css" href="<?=u?>assets/styles/elements_responsive.css">
<link rel="stylesheet" href="<?=u?>assets/css2/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="<?=u?>assets/css2/style_header_planos.css" type="text/css">

 <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142173333-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-142173333-1');
</script>


</head>
<body>

<a href="https://api.whatsapp.com/send?l=pt&amp;phone=5527988050003" target="_blank"><img src="<?=u?>assets/images/iconeWhatsapp.png" style="height:80px; position:fixed; bottom: 25px; right: 25px; z-index:100;" data-selector="img"></a>
<div class="super_container">

	<!-- Header -->

	 <header class="header-section " style="margin-top: 20px;">
            <div class="container">
                <div class="logo">
                    <a href="https://terradamusica.com.br/">
                        <img src="<?=u?>assets/img/logo.png" alt="terra da música">
                    </a>
                </div>

                <div class="nav-menu">
                    <nav class="mainmenu mobile-menu">
                        <ul>

                            <li><a href="#">Cursos</a>
                                <ul class="dropdown">
                                    <?php

                                    $categoriasp = $gm->lista("categorias_planos");

                                    foreach ($categoriasp as $cname) {
                                    ?>
                                        <li>
                                            <a href="<?= u ?>cursos-de-musica-online-assinaturas/<?= $cname['categoriaId'] ?>/<?= ln($cname['nome']) ?>">
                                                <?= $cname['nome'] ?>
                                            </a>
                                        </li>
                                        <!-- <li><a href="https://terradamusica.com.br/cursosdepianoonline/">Piano e Teclado</a></li>
                                    <li><a href="https://terradamusica.com.br/cursosdeviolaoeguitarraonline">Violão e Guitarra</a></li>
                                    <li><a href="https://terradamusica.com.br/cursosdebateriaepercussaoonline">Bateria</a></li>
                                    <li><a href="https://terradamusica.com.br/cursosdebateriaepercussaoonline">Percussão</a></li>
                                    <li><a href="https://terradamusica.com.br/cursosdeharmoniaonline">Harmonia</a></li>
                                    <li><a href="https://terradamusica.com.br/cursosdeharmoniaonline"> Teoria Musical</a></li>
                                    <li><a href="https://terradamusica.com.br/cursodeimprovisacaoonline">Improvisação</a></li>
                                    <li><a href="https://terradamusica.com.br/cursosonlinedemusica">Plano VIP</a></li> -->
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="https://terradamusica.com.br/escola-de-musica-online-quem-somos">Sobre</a></li>
                            <li><a href="http://www.terradamusicablog.com.br/">Blog</a></li>
                            <li><a href="https://terradamusica.com.br/personal-coaching">Aulas Premium</a></li>
                            <?php if (!$user->user()) { ?>
                                 
                                <li><a href="<?= u ?>acesso" class="modalbt btlogin btn btn-sm" rel="login" href="#">Área do Aluno</a></li>
                            <?php } else {  ?>
                                <li><a href="<?= u ?>minhaconta">Minha Conta</a></li>
                            <?php } ?>
                            <li><a href="https://terradamusica.com.br/#cursos" class="btn btn-outline-light">Matricule-se</a></li>

                        </ul>
                    </nav>
                </div>
            </div>
            <div id="mobile-menu-wrap" align="center"></div>
        </header>



	<header class="header" id="home" style="display:none">
		<div class="header_wrap d-flex flex-row align-items-center justify-content-center">

			<!-- Logo -->
			<div class="logo"><a href="https://www.terradamusica.com.br"><img src="<?=u?>assets/images/logo_1.png" alt="Logotipo Terra da Música" title="Lototipo Terra da Música"></a></div>

			<!-- Main Nav -->
			<nav class="main_nav">
				<ul class="d-flex flex-row align-items-center justify-content-center">
					<li><a href="#professor">professor</a></li>
					<li><a href="#planos">planos</a></li>
					<li><a href="#porque">porque o terra da música?</a></li>
					<li><a href="#planos">inscreva-se</a></li>
				</ul>
			</nav>

			<!-- Social -->
			<div class="social header_social">
				<ul class="d-flex flex-row align-items-center justify-content-start">
					<li><a href="https://www.facebook.com/terradamusica.com.br" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="https://twitter.com/terradamusicah" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="https://br.pinterest.com/terradamusica/" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
					<li><a href="https://www.instagram.com/terradamusicaead/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				</ul>
			</div>

			<!-- Hamburger -->
			<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>

		</div>

	</header>

	<!-- Fixed Header -->

	<header class="fixed_header" style="display:none !important">
		<div class="header_wrap d-flex flex-row align-items-center justify-content-center">

			<!-- Logo -->
			<div class="logo"><a href="https://www.terradamusica.com.br"><img src="<?=u?>assets/images/logo_2.png" alt=""></a></div>

			<!-- Main Nav -->
			<nav class="main_nav">
				<ul class="d-flex flex-row align-items-center justify-content-center">
					<li><a href="#professor">professor</a></li>
					<li><a href="#planos">planos</a></li>
					<li><a href="#porque">porque o terra da música?</a></li>
					<li><a href="#planos">inscreva-se</a></li>
				</ul>
			</nav>

			<!-- Social -->
			<div class="social header_social">
				<ul class="d-flex flex-row align-items-center justify-content-start">
					<li><a href="https://www.facebook.com/terradamusica.com.br" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="https://twitter.com/terradamusicah" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="https://br.pinterest.com/terradamusica/" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
					<li><a href="https://www.instagram.com/terradamusicaead/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				</ul>
			</div>

			<!-- Hamburger -->
			<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>

		</div>
	</header>

	<!-- Menu -->

	<div class="menu">
		<div class="menu_door door_left"></div>
		<div class="menu_door door_right"></div>
		<div class="menu_content d-flex flex-column align-items-center justify-content-center">
			<div class="menu_close">X</div>
			<div class="menu_nav_container">
				<nav class="menu_nav text-center">
					<ul>
					<li><a href="#professor">professor</a></li>
					<li><a href="#planos">planos</a></li>
					<li><a href="#porque">porque o terra da música?</a></li>
					<li><a href="#planos">inscreva-se</a></li>
					</ul>
				</nav>
			</div>
			<div class="social menu_social">
				<ul class="d-flex flex-row align-items-center justify-content-start">
					<li><a href="https://www.facebook.com/terradamusica.com.br" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="https://twitter.com/terradamusicah" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="https://br.pinterest.com/terradamusica/" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
					<li><a href="https://www.instagram.com/terradamusicaead/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</div>



	<!-- Home -->

	<div class="home">

		<!-- Slider -->
		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
            <?php

            foreach ($banners as $ban) {
            ?>
				<!-- Slide -->
				<div class="slide">
					<div class="background_image" style="background-image:url(<?=u?>assets/images/<?= $ban['imagem'] ?>)"></div>
					<div class="home_slider_overlay"></div>
					<div class="slide_wrap d-flex flex-column align-items-start justify-content-center">
						<div class="home_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="home_content active">
											<div class="home_subtitle"><?= $ban['titulo'] ?></div>
											<div class="home_title">
												<h1><?= $ban['texto1'] ?></h1>
												<h2 style="color:#fff"><?= $ban['texto2'] ?></h2>
											</div>
											<?php if($ban['texto_botao'] != ''){?>
											<div class="button home_button"><a href="#planos"><?= $ban['texto_botao'] ?></a></div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <?php }?>



			</div>
		</div>

	</div>


	<!-- video -->

	<div class="about" id="porque">
		<div class="container">
			<div class="row">

				<!-- About Content -->
				<div class="col-lg-5">
					<div class="about_content">
						<div class="section_title_container">
							<div class="section_subtitle">Porque o Terra da Música?</div>
							<div class="section_title"><h1>O que irei aprender?</h1></div>
						</div>
						<div class="about_text">
							<p><?=$detalhesDoPlano['description']?></p>
						</div>
						<div class="button about_button"><a href="#planos">Inscreva-se</a></div>

					</div>
				</div>

				<!-- About Image -->
				<div class="col-lg-7" align="center">
					<div class="about_image"><iframe src="<?=$detalhesDoPlano['video']?>" width="100%" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
</div>

				</div>

			</div>
		</div>
	</div>


<!-- Pricing -->
<div class="pricing" id="planos">
<div class="parallax_background parallax-window" data-parallax="scroll"
style="background-image:url(<?=u?>assets/images/pricing.jpg)"
data-image-src="<?=u?>assets/images/pricing.jpg" data-speed="0.8"></div>
<div class="container">
<div class="row">
<div class="col">
<div class="section_title_container text-center">
<div class="section_title"><h2 style="color:#ffffff">ESCOLHA O SEU PLANO DE ASSINATURA</h2></div>
</div>
<div class="pricing_slider_container">
<div class="owl-carousel owl-theme pricing_slider">
<!-- Slide -->

<?php

$qc = '';
if(isset($qrs[2])){
$qc =" and categoriaId = '".$qrs[2]."' ";
}else{
$qc =" and categoriaId = '$planoId' ";
}


$plans = $gm->lista('planos', " where exibir_pageplano = '1'  $qc");
$btnColors = ["btn-green","btn-blue","btn-red"];
$count = 0;
foreach ($plans as $pl) {
$isPlanfre = ($pl['valor'] == 0 ) ? 1 : 0;
$cursos = $gm->lista('cursos'," where cursoId in (".$pl['cursos'].") and plano_free  = $isPlanfre ");
//$cursos = $gm->lista('cursos', " where cursoId in (" . $pl['cursos'] . ") and categoriaId != '7' and plano_free  = $isPlanfre ", false);
 $allUnic .= $pl['cursos'] . ',';
?>

<?php if($pl['nome'] != 'Teste'){ ?>
<div>
<div class="pricing_box text-center">
<div class="pricing_title_box">
<div><BR>
<div><h3 style="color:#ffffff"><?=$pl['nome']?></h2></div>
	<div><h3 style="color:#ffffff; margin-top: 15px;">de <strike><?php if(isset($pl['valor_antigo'])){  ?>
		<?php echo isset($pl['valor_antigo']) ? money($pl['valor_antigo']) : ''?>

		<?php } ?></strike></h3></div>
		<div class="pricing_name">em <b>OFERTA</b> por apenas</div>
		<div class="pricing_price"><?php echo money($pl['valor']); ?></div>
		<div class="pricing_per"><?php if($pl['valor'] > 0){
			echo money($pl['valor'] / $pl['parcelas']). ' ao mês';
		}
		?> </div>
		<p class="periodo"><?php if($pl['valor'] == 0){ echo $pl['dias']; }?></p>
		<div class="pricing_per">
			<?php if($pl['valor'] == 0){  ?>
				Comece a estudar agora!
			<?php }else{
				echo $pl['parcelas']."x de ". money($pl['valor'] / $pl['parcelas']);
			}
			?></div>
		</div>
	</div>
	<div class="pricing_content">
		<div class="pricing_list">
			<ul>
				<a class="btn btn-danger btn-plan btn-lg <?=$btnColors[$count]?>" rel="<?=$pl['planoId']?>" href="/cart/assinar.php?plano=<?=$pl['planoId']?>">Escolher</a><br><br>
				<?php $count++ ?>
				<ul class="price-details">

					<li class="maior">
						<?php if($pl['caracteristicas']){ ?><i class="fa fa-video-camera"></i><?php }  ?>
						<?=$pl['caracteristicas']?></li>
						<li class="black">
							<?php if($pl['caracteristica2']){ ?><i class="fa fa-address-card"></i><?php }  ?>
							<?=$pl['caracteristica2']?></li>
							<li>
								<?php if($pl['caracteristica3']){ ?> <i class="fa fa-desktop"></i> <?php }  ?>
								<?=$pl['caracteristica3']?></li>

								<li>
									<?php if($pl['valor'] <> 0){  ?>
										<a href="#todoscursos" title="Ver Cursos" id="cursosp_<?= $pl['planoId'] ?>"
                                        class=" openCursos btn btn-dark btn-md">
                                            <?=count($cursos)?> cursos <i class="fa fa-eye"></i>
                                            </a>
									<?php } ?>

								</li>

							</ul>
                             <div class="d-none cursosp_<?= $pl['planoId'] ?>">
                                    <?php $ccb = 1;
                                    foreach ($cursos as $cursosPlano) {
                                        echo "<div class='line-lista-cursos'>" . $cursosPlano['titulo'] . "</div>";
                                    } ?>
                             </div>
						</div>

					</ul>
				</div>


			</div>
		</div>
	<?php }  // if ?>
<?php } // foreach ?>
</div>
</div>
</div>
</div>
</div>
</div>


	<!-- Cursos -->

<div id="todoscursos" class="quote" align="center" style="background-color: #e3e3e3;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="text-center" style="margin-top: 100px;">
                    <h2>VEJA TODOS OS CURSOS DESTE PLANO </h2>
                    <br>
                    <div class="row">
                        <?php

                        $numIds2 = array_unique(array_map('intval', explode(',', $allUnic)));
                        $inId2 = implode("','", $numIds2);

                        $chcktfre = null;
                        $cat_name = null;
                        $categoriaId = $planoId;

                        $banner = $gm->getRegistro('banners', "sessao", "nossoscursos");
                        $bdPaginaCursos = $gm->getRegistro('pagina_cursos', 'id', 1);

                        if (!$banner) {
                            $banner['imagem'] = "slide-tdm-1.jpg";
                        }

                        if ($csfree) {
                            $css = $gm->obj('cursos', 'plano_free', 1);

                            if (strpos($_SERVER['HTTP_REFERER'], "checkout/plano")) {
                                $chcktfre = 1;
                            }

                        } else {

                            $categoriaId = isset($categoriaId) ? $categoriaId : null;

                            $planfilter = " and plano_free = 0";

                            if ($user->user()) {
                                if ($gm->isFreeUser()) {
                                    $planfilter = '';
                                }
                            }

                            if (isset($categoriaId)) {
//$css = $gm->obj('cursos','categoriaId',$categoriaId,null,1);
                            $css2 = $css = $gm->lista('cursos', "where cursoId in ('" . $inId2 . "') and plano_free = 0 and categoriaId != '7'");
                                //$css = (object)$gm->lista('cursos', " WHERE find_in_set( $categoriaId , categoriaId ) <> 0 $planfilter order by ordem");
                            } else {
                                $css = (object)$gm->lista('cursos', " WHERE cursoId <> 0 and categoriaId <> 7 $planfilter order by ordem");
                            }

                            $catcat = $gm->getRegistro('categorias', 'categoriaId', $categoriaId);
                            if ($catcat) {
                                $cat_name = "" . $catcat['nome'];
                            }
                        }

                        ?>

                        <?php
                        $css2 = $css;
                        foreach ($css as $cs) {

                            $inst = $gm->obj('instrutores', 'instrutorId', $cs['instrutorId'], 1);
                            $cursoImg = $cs['thumb'] == '' ? '../assets/imgs/thumb.png' : "../assets/imgs/cursos/" . $cs['thumb']; ?>
                            <div class="col-lg-3">
                                <div class="card" style="width: 100%; background: #DCDCDC; margin-top: 20px">
                                    <a href="<?= u ?>curso-de-musica-online/<?= ln($cs['titulo']) ?>">
                                        <img style="margin: 0; z-index: -99" class="card-img-top"
                                        src="<?= u . $cursoImg ?>" width="100%">
                                    </a>
                                    <div class="card-body">
                                        <div style="width: 40px; margin: -20px auto 0 auto; display: block; z-index: 9999">
                                            <img style="border-radius: 50%; border: 2px solid #fff; margin: 0"
                                            src="<?= u ?>../assets/imgs/team/<?= $inst->foto ?>"
                                            class="avatar avatar-40 photo" width="40" height="40">
                                        </div>
                                        <p style="text-align: center"><?= $inst->nome ?></p>
                                        <a href="<?= u ?>curso-de-musica-online/<?= ln($cs['titulo']) ?>">
                                            <h5 style="font-weight: 800; text-align: center"><?= $cs['titulo'] ?></h5>
                                        </a>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Videos -->

		<div class="quote" align="center" style="background-color: #ffffff">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="text-center" style="margin-top: 100px;">
						<h2>ASSISTA ALGUNS VÍDEOS </h2><br>
						<div class="row">						<div class="col-lg-4">
							<iframe src="<?=$detalhesDoPlano['video1']?>" width="100%" height="260" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
						</div>
						<div class="col-lg-4">
							<iframe src="<?=$detalhesDoPlano['video2']?>" width="100%" height="260" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
						</div>
						<div class="col-lg-4">
							<iframe src="<?=$detalhesDoPlano['video3']?>" width="100%" height="260" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
						</div>
							</div>

				</div>

				</div>
			</div>
		</div>
	</div>


        <!-- CTA -->
    <?php
    if($detalhesDoPlano['professores']){
	?>
	<div class="container">
	<h2 style="text-align: center;">Professores</h2>
	<br>
	<div class="row d-flex justify-content-center">
	<?php
      $countProf = 1;
      $professores = explode(',',$detalhesDoPlano['professores']) ;
    foreach($professores as $professor){
        $nprof = $countProf++;
        $prof = $gm->getRegistro('instrutores', 'instrutorId', $professor);
      #  if($nprof % 2 != 0){
			if( 1 == 1 ){
    ?>


            <div class="our-team-item our-team-item-pf col-sm-3">
                <a href="<?= u ?>professor/<?= ln($prof['nome']) ?>">
                    <div class="our-team-image our-team-image-pf ">
                        <img src="<?= u ?>assets/imgs/team/<?= $prof['foto'] ?>" alt="team-7" title="team-7" width="200"
                             height="200">
                    </div>
                </a>
                <div class="content-team">
                    <h4 class="title"><?= $prof['nome'] ?></h4>
                    <div class="regency"><?= $prof['descricao'] ?></div>
                </div>
            </div>


	<div class="cta" id="professor" style="display:none">
		<div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">

			<!-- CTA Image -->
			<div class="cta_image align-self-stretch">
				<div class="background_image" style="background-image:url(<?=u?>assets/images/<?=$prof['foto_grande']?>)"></div>
			</div>

			<!-- CTA Content -->
			<div class="cta_content">
				<div class="section_title_container">
					<div class="section_subtitle">
                     <?=($prof['instrutorId'] == 1)?'Professor e Mestre em Música':'Professor'?>
                        </div>
					<div class="section_title"><h1><?=$prof['nome']?></h1></div>
				</div>
				<div class="cta_list">
					<ul>
                        <?php
                        $frases= explode('|',$prof['descricao_plano']);
                        foreach($frases as $frase){
                            if(trim($frase) != ''){
                        ?>
					    <li class="d-flex flex-row align-items-center justify-content-start">
							<img src="<?=u?>assets/images/check.png" alt="">
							<span><?=trim($frase)?></span>
						</li>
                        <?php }} ?>
                        <?php if($prof['instrutorId'] != 1){  ?>
                        <br>
 				        <a href="<?=$prof['video']?>" target="_blank" class="btn btn-danger">SAIBA MAIS SOBRE <?=$prof['nome']?></a>
                         <?php }?>
					</ul>
				</div>
                <?php if($prof['instrutorId'] == 1){  ?>
				    <div class="col-lg-6">
                    <a href="http://turicollura.com.br/categorias/blog/livros/" target="_blank">
                    <img src="<?=u?>assets/images/livros.png"></a>
                    </div>
                <?php }?>

				</div>
			</div>

		</div>
        <?php }else{ ?>
	<!-- CTA Content -->
			<div class="cta_content" style="background-color:#0B0032">
				<div class="section_title_container">
					<div class="section_title"><br><br><h2 style="color:#ffffff"><?=$prof['nome']?></h2></div>
				</div>
				<div class="cta_list">
					<ul>
                        <?php
                        $frases= explode('|',$prof['descricao_plano']);
                        foreach($frases as $frase){
                            if(trim($frase) != ''){
                        ?>
					    <li class="d-flex flex-row align-items-center justify-content-start">
							<img src="<?=u?>assets/images/check.png" alt="">
							<span><?=trim($frase)?></span>
						</li>
                        <?php }} ?>
                        <?php if($prof['instrutorId'] != 1){  ?>
                        <br>
 				        <a href="<?=$prof['video']?>" target="_blank" class="btn btn-danger">SAIBA MAIS SOBRE <?=$prof['nome']?></a>
                         <?php }?>
					</ul>
				</div>
                <?php if($prof['instrutorId'] == 1){  ?>
				    <div class="col-lg-6">
                    <a href="http://turicollura.com.br/categorias/blog/livros/" target="_blank">
                    <img src="<?=u?>assets/images/livros.png"></a>
                    </div>
                <?php }?>
			</div>
			<!-- CTA Image -->
			<div class="cta_image align-self-stretch">
				<div class="background_image" style="background-image:url(<?=u?>assets/images/<?=$prof['foto_grande']?>)"></div>
			</div>
		</div>

	</div>


        <?php }  }
        }else{  ?>

        <div id="professor" style="background-color: #F1F1F1;">
        <div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">

        <div class="container">
        <div class="row">
        <div class="text-center" style="margin-top: 100px;">
        <h2>PROFESSORES </h2><br>
        </div>
        </div>
        <div class="row">
        <?php $ins = $gm->lista('instrutores', " where tipo = 'professor' ");
        foreach ($ins as $in) {
             ?>
        <div class="our-team-item our-team-item-pf col-lg-3">
        <a href="<?= u ?>professor/<?= ln($in['nome']) ?>" target="_blank">
        <div class="our-team-image our-team-image-pf ">
        <img src="<?= u ?>assets/imgs/team/<?= $in['foto'] ?>" alt="team-7" title="team-7" width="200"
        height="200">
        </div>
        </a>
        <div class="content-team">
        <h4 class="title"><?= $in['nome'] ?></h4>
        <div class="regency"><?= $in['descricao'] ?><br><br></div>
        </div>
        </div>
        <?php } ?>
        </div>
        </div>

        </div>
        </div>
        <?php  } ?>
		</div>
		</div>

		<div class="about" id="sobre">
		<div class="container">
			<div class="row">

				<!-- About Content -->
				<div class="col-lg-7">
					<div class="about_content">
						<div class="section_title_container">
							<div class="section_subtitle">Sobre</div>
							<div class="section_title"><h1>Terra da Música</h1></div>
						</div>
						<div class="about_text">
							<p>Nós revolucionamos a maneira de se fazer e de se aprender música!<br>

Somos um time de profissionais com experiência nacional e internacional em palcos e salas de aula, lecionando nas melhores instituições de música do Brasil. Unimos no Terra da Música uma consolidada formação acadêmica com a experiência de músicos, compositores, arranjadores e solistas.
<br>
 Visando a otimização da relação tempo de estudo/resultados e do desenvolvimento de habilidades/competências lançamos o Terra da Música para auxiliar pessoas iniciantes à profissionais a ampliarem e melhorarem suas capacidades musicais.<br>
					Nosso compromisso com a educação e a difusão de conhecimento musical é o que nos move. Venha fazer parte conosco desta família musical</p>
						</div>

					</div>
				</div>

				<!-- About Image -->
				<div class="col-lg-5" align="center">
					<div class="about_image"><iframe src="https://player.vimeo.com/video/338267727?color=f02626&title=0" width="100%" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div>
					<div class="button about_button"><a href="#planos">Inscreva-se</a></div>
				</div>

			</div>
		</div>
	</div>



	<div class="container">

<!-- Milestones -->
					<div class="milestones">
					<div class="elements_title">Nossos números</div>
						<div class="row milestones_row">

							<!-- Milestone -->
							<div class="col-xl-3 col-md-6 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="<?=u?>assets/images/facebook-icone.png"></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="44459">0</div>
										<div class="milestone_text">Seguidores</div>
									</div>
								</div>
							</div>

							<!-- Milestone -->
							<div class="col-xl-3 col-md-6 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="<?=u?>assets/images/icone-video.png"></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="1919">0</div>
										<div class="milestone_text">Vídeos disponíveis</div>
									</div>
								</div>
							</div>

							<!-- Milestone -->
							<div class="col-xl-3 col-md-6 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="<?=u?>assets/images/estudantes-icon.png"></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="16285">0</div>
										<div class="milestone_text">Estudantes matriculados</div>
									</div>

								</div>
							</div>

							<!-- Milestone -->
							<div class="col-xl-3 col-md-6 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="<?=u?>assets/images/assistidosIcone.png"></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="23897">0</div>
										<div class="milestone_text">Vídeos assistidos mensalmente</div>
									</div>
								</div>
							</div>

						</div>
					</div>
	</div>

<!--intro-->
		<div class="intro">
		<div class="intro_boxes_wrap">
			<div class="d-flex flex-row align-items-start justify-content-start flex-wrap">

				<!-- Intro Box -->
				<div class="intro_box d-flex flex-column align-items-center justify-content-center text-center">
					<div class="intro_box_icon"><img src="<?=u?>assets/images/icon_1.svg" alt=""></div>
					<div class="intro_box_title"><h3>Acompanhamento integral</h3></div>
					<div class="intro_box_text">
						<p>Você é sempre acompanhado nos estudos. Tire suas dúvidas participando dos grupos de discussão no Fórum do site e no Facebook. E você, também, pode marcar sua Aula Premium com o professor, um momento especial somente seu!<br><b>Todos os curso possuem certificados</b></p>
					</div>
				</div>

				<!-- Intro Box -->
				<div class="intro_box d-flex flex-column align-items-center justify-content-center text-center">
					<div class="intro_box_icon"><img src="<?=u?>assets/images/icon_2.png" alt=""></div>
					<div class="intro_box_title"><h3>O aprendizado no seu tempo</h3></div>
					<div class="intro_box_text">
						<p>Você define o melhor horário para seus estudos e encontrará cursos teóricos e práticos, de instrumento, de harmonia, improvisação, teoria musical e muito mais. Todo o conteúdo estará disponível sem restrições, exceto nos planos gratuítos.</p>
					</div>
				</div>

				<!-- Intro Box -->
				<div class="intro_box d-flex flex-column align-items-center justify-content-center text-center">
					<div class="intro_box_icon"><img src="<?=u?>assets/images/icon_3.png" alt=""></div>
					<div class="intro_box_title"><h3>Mais de 16 mil alunos</h3></div>
					<div class="intro_box_text">
						<p>Uma das maiores escolas online de música, o Terra da Música entrega cursos e aperfeiçoamento profissional a milhares de músicos em todo o Brasil e no Mundo. Participe você também e comece hoje mesmo a revolucionar sua música!</p>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Classes -->

	<div class="classes" id="depoimentos">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_subtitle">Venha fazer parte</div>
						<div class="section_title"><h3>Depoimentos de nossos alunos</h3></div>
					</div>

					<!-- Classes Slider -->
					<div class="classes_slider_container">
						<div class="owl-carousel owl-theme classes_slider">
		                 <!-- Slide -->
                        <?php $alu = $gm->lista('depoimentos', " where status = 1");
                        foreach ($alu as $al) {
                        ?>
                            <div>
                                <div class="classes_slide_wrap">
                                    <div class="text-center">
                                        <div class="classes_title">
                                            <h3><?= $al['nome'] ?></h3>
                                        </div>
                                        <div class="classes_text">
                                            <p><?= $al['depoimento'] ?></p>
                                        </div>
                                        <div class="class_image"><a href="#"><img src="<?=u?>assets/img/terra.jpg" alt=""></a></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
							<div>
								<div class="classes_slide_wrap">
									<div class="text-center">
										<div class="classes_title"><h3>Maurício Wanda</h3></div>
										<div class="classes_text">
											<p>	Sempre tive a percepção muito ruim , mas depois desse curso melhorou tive uma melhora bem notável. Os exercícios interativos ajudam muito.</p>
										</div>
										<div class="class_image"><a href="#"><img src="<?=u?>assets/images/terra.jpg" alt=""></a></div>
										</div>
									</div>
								</div>


							<!-- Slide -->
							<div>
								<div class="classes_slide_wrap">
									<div class="text-center">
										<div class="classes_title"><h3>Maria Alice</h3></div>
										<div class="classes_text">
											<p>Excelentes cursos, fontes ricas de informações. Com o plano ilimitado estou estudando sabendo que vou aprender mais.</p>
										</div>
										<div class="class_image"><a href="#"><img src="<?=u?>assets/images/terra.jpg" alt=""></a></div>
									</div>
								</div>
							</div>


							<!-- Slide -->
							<div>
								<div class="classes_slide_wrap">
									<div class="text-center">
										<div class="classes_title"><h3>Marco Antônio Junior</h3></div>
										<div class="classes_text">
											<p>Material de primeira e com técnicas inovadoras. Parabéns!</p>
										</div>
										<div class="class_image"><a href="#"><img src="<?=u?>assets/images/terra.jpg" alt=""></a></div>
										</div>
									</div>
								</div>


								<!-- Slide -->
							<div>
								<div class="classes_slide_wrap">
									<div class="text-center">
										<div class="classes_title"><h3>Marcelo Cruz Vilhena</h3></div>
										<div class="classes_text">
											<p>Excelente módulo do curso, se você fizer ele bem feito com certeza ficará rapidamente com todas as tríades maiores e menores embaixo dos dedos!</p>
										</div>
										<div class="class_image"><a href="#"><img src="<?=u?>assets/images/terra.jpg" alt=""></a></div>
										</div>
									</div>
								</div>


						<!-- Slide -->
							<div>
								<div class="classes_slide_wrap">
									<div class="text-center">
										<div class="classes_title"><h3>Luci Fantato</h3></div>
										<div class="classes_text">
											<p>	Acompanho desde 2015 os cursos, faço todos. São uma fonte muito rica de informações para nós professores de música</p>
										</div>
										<div class="class_image"><a href="#"><img src="<?=u?>assets/images/terra.jpg" alt=""></a></div>
										</div>
									</div>
								</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- Pricing -->

<?php //include 'planos.php'; ?>

	<!-- garantia -->

	<div class="about" style="margin-top: 50px;">
		<div class="container">
			<div class="row">

				<!-- About Content -->
				<div class="col-lg-8">
					<div class="about_content">
						<div class="section_title_container">
							<div class="section_subtitle">GARANTIA 100% DE SATISFAÇÃO!</div>
							<div class="section_title"><h1 style="color:#000F32"> Você sempre protegido! </h1></div>
						</div>
						<div class="about_text">
							<p>Temos a certeza de que irá adorar estudar conosco!! Mas, se por qualquer razão, não quiser mais estudar, nós devolvemos 100% do seu investimento, de forma simples e sem burocracia. Você tem 7 dias para isso. Já estudaram conosco mais de <b>16.000</b> alunos que comprovaram a qualidade de nossos cursos. Ajudamos você a revolucionar a sua música!</p>
						</div>
						<div class="button about_button"><a href="#planos">Inscreva-se Já!</a></div>

					</div>
				</div>

				<!-- About Image -->
				<div class="col-lg-4" align="center">
					<div class="about_image"><img src="<?=u?>assets/images/satisfacao.png" alt=""></div>

				</div>

			</div>
		</div>
	</div>


	<!-- Footer -->

	<footer class="footer" style="margin-bottom: 0px;">
		<div class="footer_content">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_logo text-center"><a href="#"><img src="<?=u?>assets/images/logo_3.png" alt=""></a></div>
					</div>
				</div>
				<div class="row footer_row">
					<div class="col-lg-4 footer_col">
						<div class="footer_item text-center">
							<div class="footer_icon d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
								<div><img src="<?=u?>assets/images/phone.png" alt=""></div>
							</div>
							<div class="footer_title">Fale Conosco</div>
							<div class="footer_list">
								<ul>
									<li>+55 11 93349-9993 <i class="fa fa-whatsapp" aria-hidden="true"></i></li>


								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4 footer_col">
						<div class="footer_item text-center">
							<div class="footer_icon d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
								<div><img src="<?=u?>assets/images/mail.png" alt=""></div>
							</div>
							<div class="footer_title">e-mail</div>
							<div class="footer_list">
								<ul>
									<li><a href="https://terradamusica.com.br/contato" target="_blank">Envie-nos um email</a></li>
									<li><img src="<?=u?>assets/images/ssl.png" width="150px"></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4 footer_col">
						<div class="footer_item text-center">
							<div class="footer_icon d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
								<div><img src="<?=u?>assets/images/pagamento.png" alt=""></div>
							</div>
							<div class="footer_title">Formas de Pagamento</div>
							<div class="footer_list">
								<ul>
									<li><img src="<?=u?>assets/images/paypal.png"></li>

								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="footer_bar d-flex flex-row align-items-center justify-content-center">
			<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados Terra da Música | by <a href="https://www.ar2coaching.com.br" target="_blank">AR2 Marketing e Web</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
		</div>
	</footer>
</div>


<div  id="modal_cursos" class=" modal fade" role="dialog" style="z-index:9999999;">
<div class="modal-dialog">
<div class="modal-content content-modal-lista-cursos">
</div>
</div>
</div>


    <script src="<?= u ?>assets/lib/jquery/dist/jquery.js"></script>
 <script src="<?= u ?>assets/js2/jquery.slicknav.js"></script>
  <script>
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });
    $(".header-section.header-normal .nav-menu .mainmenu ul li").on('mousehover', function() {
        $(this).addClass('active');
    });
    $(".header-section.header-normal .nav-menu .mainmenu ul li").on('mouseleave', function() {
        $('.header-section.header-normal .nav-menu .mainmenu ul li').removeClass('active');
    });

	$.noConflict();
  </script>


 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="<?=u?>assets/styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="<?=u?>assets/styles/bootstrap-4.1.2/popper.js"></script>
<script src="<?=u?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?=u?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?=u?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?=u?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?=u?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?=u?>assets/plugins/OwlCarousel2-2.3.4/owl.carousel.js"></script>
<script src="<?=u?>assets/plugins/easing/easing.js"></script>
<script src="<?=u?>assets/plugins/progressbar/progressbar.min.js"></script>
<script src="<?=u?>assets/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?=u?>assets/js/custom.js"></script>
<script src="<?=u?>assets/js/elements.js"></script>



<script type="text/javascript">
        $(document).on('click', '.openCursos', function() {
            let content = $('.' + $(this).attr('id')).html();
            $("#modal_cursos .modal-content").html(content);
            $('#modal_cursos').modal('show');
        });
    </script>

</body>
</html>
