<?php

class Rezervacije{
	
	private $konekcija;
	public $ime;
	public $prezime;
	public $email;
	public $datum_zurke;
	public $vreme_zurke_od;
	public $vreme_zurke_do;
	public $vrsta_zurke;
	
	public function __construct($konekcija){
		$this->konekcija = $konekcija;
	}

	public function Upisi($ime,$prezime,$email,$datum_zurke,$vreme_zurke_od,$vreme_zurke_do,$vrsta_zurke){
		
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->email = $email;
		$this->datum_zurke = $datum_zurke;
		$this->vreme_zurke_od = $vreme_zurke_od;
		$this->vreme_zurke_do = $vreme_zurke_do;
		$this->vrsta_zurke = $vrsta_zurke;

		$ispis = "INSERT INTO baza_klub.podaci_o_zurci(ime,prezime,email,datum_zurke,vreme_zurke_od,vreme_zurke_do,vrsta_zurke) 
		VALUES (:ime,:prezime,:email,:datum_zurke,:vreme_zurke_od,:vreme_zurke_do,:vrsta_zurke)";
		
		$upis = $this->konekcija->prepare($ispis);
		

		$mojXML = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?><poruke></poruke>");

		if(!isset($this->ime) || empty($this->ime)){
			$poruka = $mojXML->addChild("poruka","Podaci nisu tacni ili nisu uneseni!");
		}else if(!isset($this->prezime) || empty($this->prezime)){
			$poruka = $mojXML->addChild("poruka","Podaci nisu tacni ili nisu uneseni!");
		}else if(!isset($this->email) || empty($this->email) || !filter_var($this->email,FILTER_VALIDATE_EMAIL)){
			$poruka = $mojXML->addChild("poruka","Podaci nisu tacni ili nisu uneseni!");
		}else if(!isset($this->datum_zurke) || empty($this->datum_zurke)){
			$poruka = $mojXML->addChild("poruka","Podaci nisu tacni ili nisu uneseni!");
		}else if(!isset($this->vreme_zurke_od) || empty($this->vreme_zurke_od)){
			$poruka = $mojXML->addChild("poruka","Podaci nisu tacni ili nisu uneseni!");
		}else if(!isset($this->vreme_zurke_do) || empty($this->vreme_zurke_do)){
			$poruka = $mojXML->addChild("poruka","Podaci nisu tacni ili nisu uneseni!");
		}else if(empty($this->vrsta_zurke)){
			$poruka = $mojXML->addChild("poruka","Podaci nisu tacni ili nisu uneseni!");
		}else if($this->PostojiXY()){
			$poruka = $mojXML->addChild("poruka","Postovani,postoji rezervacija za taj termin!");
		}else{

			$upis->bindParam(":ime",$this->ime);
			$upis->bindParam(":prezime",$this->prezime);
			$upis->bindParam(":email",$this->email);
			$upis->bindParam(":datum_zurke",$this->datum_zurke);
			$upis->bindParam(":vreme_zurke_od",$this->vreme_zurke_od);
			$upis->bindParam(":vreme_zurke_do",$this->vreme_zurke_do);
			$upis->bindParam(":vrsta_zurke",$this->vrsta_zurke);

			$upis->execute();

			$poruka = $mojXML->addChild("poruka","Uspesno ste uneli podatke,dobicete poruku na email o daljem dogovoranju.");
		}
		

		Header('Content-type: text/xml');
		echo $mojXML->asXML();

		
	}

	public function PostojiXY(){
		
		$pregled = "SELECT * FROM  baza_klub.podaci_o_zurci WHERE vreme_zurke_od  BETWEEN 
		:vreme_zurke_od AND :vreme_zurke_do OR vreme_zurke_do BETWEEN  :vreme_zurke_od AND :vreme_zurke_do";
		
		$datum = "SELECT * FROM  baza_klub.podaci_o_zurci WHERE datum_zurke = '".$this->datum_zurke."'";
		
		$datumi = $this->konekcija->prepare($datum);
		
		$vreme = $this->konekcija->prepare($pregled);
		
		$vreme->bindParam(":vreme_zurke_od",$this->vreme_zurke_od);
		$vreme->bindParam(":vreme_zurke_do",$this->vreme_zurke_do);
		
		$vreme->execute();
		
		$datumi->execute();
		
		if($vreme->rowCount() > 0 && $datumi->rowCount() > 0){
			return true;
		}else{
			return false;
		}
			
	}

	public function PrikaziPodatke(){
		
		$vidi = "SELECT id_podaci,ime,prezime,email,datum_zurke,vreme_zurke_od,vreme_zurke_do,vrsta_zurke FROM baza_klub.podaci_o_zurci";
		
		$pokazi = $this->konekcija->prepare($vidi);
		
		$pokazi->execute();
		
		return $pokazi;
		
	}

	public function IzbrisiRezervaciju($id_podaci){
		
		$ispali = "DELETE FROM baza_klub.podaci_o_zurci WHERE id_podaci = " .$id_podaci. "";
		
		$izbrisi = $this->konekcija->prepare($ispali);
		
		$izbrisi->execute();
		
		return $izbrisi;
		
	}

	

}	


?>