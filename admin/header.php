<?php include '../config.php'; 
//error_reporting(E_ALL);
include 'helper/functions.php'; 
      include 'class.php';
      
      include 'helper/routes.php'; 
      if(!isset($_SESSION['radmin'])){ header('Location:login.php');  } 

     
 
      ?>
<!DOCTYPE html>
<html lang="PT">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
     <link rel="shortcut icon" href="img/favicon.html">

    <title>Terra da Música - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
      <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />

         <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
  <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

  <link rel="stylesheet" href="dist/multi-select.dist.css" />
  
  </head>

  <body>
 
  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Menu"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><img src="../assets/imgs/logo_site.png" style="height: 26px; margin-left: 16px; margin-top: -6px;
    margin-right: 55px;"/>  <span style="font-size: 14px; color: #777; font-weight: bold;"></span></a>
            <!--logo end-->
 

 


            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                            <span class="username"><?=$_SESSION['adminnome']?></span>
                           
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                          
                            <li><a href="#"><i class="fa fa-cog"></i> Configurações</a></li>
                           
                            <li><a href="login.php?sair=1"><i class="fa fa-key"></i> Sair</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->



<?php 
if(isset($_SESSION['perms'])){
if($page != 'home'){
if(!strstr($_SESSION['perms'], $page)){
echo "<script>alert('Sem privilegios para esta página.'); window.location='index.php'; </script> ";
die;
} 
}
}

?>
<script>
  function closedel(){
$('#divdel').css('display','none'); 
$('#senhadel').val('');
$('#delitem').val(''); 
}
</script>
 