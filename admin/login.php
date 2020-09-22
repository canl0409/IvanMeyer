<?php include '../config.php'; 
include 'class.php';



if(isset($_GET['sair'])){  
$ms = $p->sair();
}


$p->vflogin();
$ms = null;
if(isset($_POST['email2'])){ 
$ms = $p->login($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">

<title>Admin - Terra da Música</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-reset.css" rel="stylesheet">
<!--external css-->
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet" />

<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>

<body class="login-body">

<div class="container">

<form class="form-signin" action="login.php" method="POST">
<h2 class="form-signin-heading"> <img src="../assets/imgs/logo_site.png" /></h2>
<div class="login-wrap">
<input name="email2" id="email2" type="text" class="form-control" placeholder="Login" autofocus>
<input name="senha" type="password" class="form-control" placeholder="Senha">

<button class="btn btn-lg btn-login btn-block" type="submit">Entrar</button>

<p><a style="font-size:12px; color:#555;" href="forgot.php">Esqueceu a senha?</a></p>
<h3 style="font-size:12px;text-align:center"><?=$ms?></h3>

</div>

<!-- Modal -->

<!-- modal -->

</form>

</div>



<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>

 
</html>
