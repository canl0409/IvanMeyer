<?php session_start();
// error_reporting(0);   // in production
session_regenerate_id();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
ini_set("date.timezone","America/Sao_Paulo");

// in development
error_reporting(E_ERROR | E_WARNING | E_PARSE);  // in development
error_reporting(E_ALL);                         // in development
ini_set('display_errors', 1);       // in development

class Config {
	function __construct() {
		$this->mysqli = new mysqli("localhost", "root", "02r0d9rmv4uyZx", "terra_da_musica2");

		$this->mysqli->set_charset("utf8");
	}
}
$phps = dirname($_SERVER['PHP_SELF']);
if ($phps == '/') {$phps = '';} $phps = '';
$protocol = 'http://';
define('u', $protocol . $_SERVER['SERVER_NAME'] . $phps . ':' . $_SERVER['SERVER_PORT'] . '/');
//define('u','http://musicaead.com/terra_da_musica/');

?>
