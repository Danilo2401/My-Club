<?php 

namespace Komentari;

Class Komentari{

    public $konekcija;
    public $naslov;
    public $opis;
    public $ime_korisnika;

    public function __construct($konekcija){
        $this->konekcija = $konekcija;
    }

    function DodajKomentar(){

        $prikazi = "INSERT INTO baza_klub.komentari(ime_korisnika,naslov,opis) VALUES (:ime_korisnika,:naslov,:opis)";

        $upis = $this->konekcija->prepare($prikazi);

        $upis->bindParam(":ime_korisnika",$this->ime_korisnika);
        $upis->bindParam(":naslov",$this->naslov);
		$upis->bindParam(":opis",$this->opis);
		
		$upis->execute();
		
		return $upis;
    }

    public function PrikaziKomentar(){
		
		$pogledaj = "SELECT ime_korisnika,naslov,opis FROM baza_klub.komentari ORDER BY ime_korisnika";
		
		$prikaz = $this->konekcija->prepare($pogledaj);
		
		$prikaz->execute();
	
		return $prikaz;
		
	}


}


?>