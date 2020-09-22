<?php include '../config.php'; 
      include 'helper/functions.php'; 
      include 'class.php'; 
 
 if(isset($_REQUEST['pd_p'])){
  $p->updatePedido($_REQUEST['pd_p'],2);
}
?>
<!DOCTYPE html>
<html lang="PT">

<head>
    <meta charset="utf-8">
<script src="js/jquery-1.8.3.min.js"></script>
<!--[if lt IE 9]>
<script src="<?=u?>js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
<![endif]-->
<title>Hora da fome - Pedido:<?=$_GET['pedido']?> </title>
</head>

<div id="printdiv">
<?php 
echo $p->mkconfmsg($_GET['pedido']);
echo $p->mkconfmsg($_GET['pedido']);
?>
</div>

<script>
$(document).ready(function(){ $.print('#printdiv');   });
</script>
<button onClick="$.print('#printdiv')" class="print-link no-print">Imprimir</button> 
<script src="<?=u?>js/jQuery.print.js"></script> 
</html>