<?php

Class Uloguj{
	
	public $konekcija;
	public $ime;
	public $lozinka;
	
	function __construct($konekcija){
		$this->konekcija = $konekcija;
	}
	
	function LogovanjeAdmina(){
		
		$prikaz = "SELECT * FROM admin_panel.admin_log WHERE ime = :ime and lozinka = :lozinka";
		
		$pregled = $this->konekcija->prepare($prikaz);

		$pregled->bindParam(":ime",$this->ime);
		$pregled->bindParam(":lozinka",$this->lozinka);	
		
		$pregled->execute();
		
		if($pregled->rowCount() == 1){
			return true;
		}else{
			return false;
		}
		
	}
	
}		




?>