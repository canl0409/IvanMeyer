<?php


function data($d){
return date('d-m-Y', strtotime($d));
}

function money($num){
return   'R$' . number_format($num, 2); // retorna R$100,000.50
}


function uspace($tx){
$text = str_replace(" ", '_', $tx);
return $text;
}
function space($tx){
$text = str_replace("_", ' ', $tx);
return $text;
}
function ta($tx){
$bad = array('À','à','Á','á','Â','â','Ã','ã','Ä','ä','Å','å','Ă','ă','Ą','ą','Ć','ć','Č','č','Ç','ç','Ď','ď','Đ','đ','È','è','É','é','Ê','ê','Ë','ë','Ě','ě','Ę','ę','Ğ','ğ','Ì','ì','Í','í','Î','î','Ï','ï','Ĺ','ĺ','Ľ','ľ','Ł','ł','Ñ','ñ','Ň','ň','Ń','ń','Ò','ò','Ó','ó','Ô','ô','Õ','õ','Ö','ö','Ø','ø','ő','Ř','ř','Ŕ','ŕ','Š','š','Ş','ş','Ś','ś', 'Ť','ť','Ť','ť','Ţ','ţ','Ù','ù','Ú','ú','Û','û','Ü','ü','Ů','ů','Ÿ','ÿ','ý','Ý','Ž','ž','Ź','ź','Ż','ż','Þ','þ','Ð','ð','ß','Œ','œ','Æ','æ','µ','”','“','‘','’',"'","\n","\r",'_');
$good = array('A','a','A','a','A','a','A','a','Ae','ae','A','a','A','a','A','a','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','E','e','G','g','I','i','I','i','I','i','I','i','L','l','L','l','L','l','N','n','N','n','N','n','O','o','O','o','O','o','O','o','Oe','oe','O','o','o','R','r','R','r','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','Ue','ue','U','u','Y','y','Y','y','Z','z','Z','z','Z','z','TH','th','DH','dh','ss','OE','oe','AE','ae','u','','','','','','','','-');
$text = str_replace($bad, $good, $tx);
return $text;
}

function ur($t){ return uspace(ta(trim($t)));
$text = uspace(ta(trim($t)));
return strtolower($text);
}
function debug($io){
if($io == 1){
error_reporting(E_ALL);
}else{
error_reporting(0);
}
}

function debug2($io){
if($io == 1){
error_reporting(E_ERROR | E_WARNING | E_PARSE );
}else{
error_reporting(0);
}
}

function checaEmail($email) { 
$e = explode("@",$email); 
if(count($e) <= 1) { 
return FALSE; 
} elseif(count($e) == 2) { 
$ip = gethostbyname($e[1]); 
if($ip == $e[1]) { 
return FALSE; 
} elseif($ip != $e[1]) { 
return TRUE; 
} 
} 
} 
function asset(){
$r = null;
$a = array('js','css');
foreach ($a as $f ) {  
foreach (glob("$f/*.$f") as $file){  

if($f =='css'){ $r.= '<link rel="stylesheet" type="text/css" href="'.$file.'" media="screen"/>';}
if($f =='js') {$r.= '<script type="text/javascript" src="'.$file.'"></script>';}
}
}
return $r;
}  

function loged(){
if($_SESSION['user']){
return true ;
}else{ 
return false;
}
}

function filtro($text)
{

$s = mysql_query("select * from filtro where id='1'");
$r = mysql_fetch_array($s);

$bw =  explode(',', $r['words']);  
$filtered_text = $text;//srttolower($text);
$filtered_text = str_replace($bw, '***', $filtered_text); 
// ... and so on
return $filtered_text;
}


// Função que valida o CPF
function cpf($cpf)
{	// Verifiva se o número digitado contém todos os digitos


$cpf = "$cpf";
if (strpos($cpf, "-") !== false)
{
$cpf = str_replace("-", "", $cpf);
}
if (strpos($cpf, ".") !== false)
{
$cpf = str_replace(".", "", $cpf);
}
$sum = 0;
$cpf = str_split( $cpf );
$cpftrueverifier = array();
$cpfnumbers = array_splice( $cpf , 0, 9 );
$cpfdefault = array(10, 9, 8, 7, 6, 5, 4, 3, 2);
for ( $i = 0; $i <= 8; $i++ )
{
$sum += $cpfnumbers[$i]*$cpfdefault[$i];
}
$sumresult = $sum % 11;  
if ( $sumresult < 2 )
{
$cpftrueverifier[0] = 0;
}
else
{
$cpftrueverifier[0] = 11-$sumresult;
}
$sum = 0;
$cpfdefault = array(11, 10, 9, 8, 7, 6, 5, 4, 3, 2);
$cpfnumbers[9] = $cpftrueverifier[0];
for ( $i = 0; $i <= 9; $i++ )
{
$sum += $cpfnumbers[$i]*$cpfdefault[$i];
}
$sumresult = $sum % 11;
if ( $sumresult < 2 )
{
$cpftrueverifier[1] = 0;
}
else
{
$cpftrueverifier[1] = 11 - $sumresult;
}
$returner = false;
if ( $cpf == $cpftrueverifier )
{
$returner = true;
}


$cpfver = array_merge($cpfnumbers, $cpf);

if ( count(array_unique($cpfver)) == 1 || $cpfver == array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0) )

{

$returner = false;

}
return $returner;



}

?>