<?php include 'config.php';  
     include 'helper/functions.php';
	  include 'user.php'; 
	 include 'class.php';



if(isset($_REQUEST['id_transacao'])){ 
echo $gm->statusPay($_REQUEST);
}






$output = print_r($_REQUEST, true);
file_put_contents('log.txt', $output);
?>

                        