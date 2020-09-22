<?php 
include 'config.php'; 
include 'class.php';

$add = null;
if(isset($_POST['email'])){
$add = 	$p->esqueci($_POST);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Mosaddek">
<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<link rel="shortcut icon" href="img/favicon.html">

<title>Esqueci a senha</title>

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

<form class="form-signin" action="forgot.php" method="POST">
<h2 class="form-signin-heading">Esqueci a senha</h2>
<div class="login-wrap">






<div class="limites layout-978">  
 
<div id="pagecontent">
 
<?php 
if($add == 'ok'){ 
$add = "Uma nova senha foi gerada e enviada para seu e-mail!";
} ?>

<div class="succes">
	<?=$add?>
</div>
 
 
 <form id="formesqueci" method="POST" action="">
 	<label for="">Digite seu e-mail de cadastro:</label>
 	<input type="text" name="email">
 	<button>Redefinir Senha</button>
 </form>
<p><a style="font-size:12px; color:#555;" href="login.php">< Login</a></p>
</div>
</div>

 







</div>
</form>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
