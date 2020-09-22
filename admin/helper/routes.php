<?php   
function page($page){  
	if(!key($page)){
		return 'home' ;	
	}else{
		return  key($page) ;	
	}
}
$page =  page($_GET);

if(!file_exists('pages/'.$page.'.php')){
	$page = 'conteudo';
} 
/*
if(isset($_REQUEST['todas'])){
 $page = 'listar';
}
*/
?>