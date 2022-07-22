<?php

Class BazaAdmin{
	public $konekcijaBaze;
	private $lozinka = "";
	private $ImeKorisnika = "root";
	private $imeServera = "localhost";
	private $db = "admin_panel";
	
	function PoveziBazu(){
	
		$this->konekcijaBaze = null;

		try{
			$this->konekcijaBaze = new PDO("mysql:host=$this->imeServera;dbanme=$this->db",$this->ImeKorisnika,$this->lozinka);
		}catch(PDOException $e){
			echo "Greska:" . $e->getMessage();
		}
		
		return $this->konekcijaBaze;
		
	}
	
}




?>