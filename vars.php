<?php
class vars extends Config {

	public $invalid_numbers_accounts_ids = array();
	public $fixed_numbers = array();

	protected $mysqli;
	public $data;
	function __construct() {
		parent::__construct();
	}

  	public function getData() {

		$result = $this->mysqli->query("SELECT * FROM contato WHERE contatoId='1'  ");
		$row = $result->fetch_array();
		return (object)$row;
	}
 

}
$site = new vars();
$vs = $site->getData();

define('site_url', 'nome.com.br');
define('site_nome',  $vs->titulo);
define('site_title', $vs->titulo);
define('email_remetente', $vs->email);
define('email_destino', $vs->email);

 
?>