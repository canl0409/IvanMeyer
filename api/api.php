<?php
class api extends Config {

	public $invalid_numbers_accounts_ids = array();
	public $fixed_numbers = array();

	protected $mysqli;
	public $data;
	function __construct() {
		parent::__construct();
	}

 
  
  	public function validaToken($token,$aluno) { 
		$vcm = $this->mysqli->query("SELECT * FROM alunos WHERE alunoId='$aluno' and apitoken = '$token'  ");
		if (mysqli_num_rows($vcm) == 0) {
			return false;
		} else { 
			return true;
		}
	}

	public function isCursoExpired($curso,$aluno){
 
		$res1 = $this->mysqli->query("SELECT * FROM cursos_matriculas   WHERE cursoId='$curso' and alunoId= '$aluno'");
		if (mysqli_num_rows($res1) >= 1) {
			$dc = $res1->fetch_array();
			if($dc['expira']){
				if($dc['expira'] < date('Y-m-d')){
					return 0;
				}else{
					return 1;
				}
			}
		}
	}



}
$ap = new api();

?>