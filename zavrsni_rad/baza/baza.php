<?php

class Baza{
	private $korisnickoIme = "root";
	private $server = "localhost";
	private $lozinka = "";
	private $db = "baza_klub";
	public $BazaKonekcija;
	
	public function PostaviKonekciju(){
		
		try{
		$this->BazaKonekcija = new PDO("mysql:host=$this->server;dbname=$this->db",$this->korisnickoIme,$this->lozinka);
		}catch(PDOException $e){
			echo "Konekcija nije uspela:" . $e->getMessage();
		}
		return $this->BazaKonekcija;
	}
	
}



?>