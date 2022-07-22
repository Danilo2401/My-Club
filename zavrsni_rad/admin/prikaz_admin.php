<?php

require_once "../baza/baza.php";

require_once "../objekti/rezervacije.php";

if(isset($_POST["prenos"])){
	$prenos = $_POST["prenos"];
}else{
	echo "Greska!";
}

$baza = new Baza();

$db = $baza->PostaviKonekciju();

$dodavanje = new Rezervacije($db);

$gledaj = $dodavanje->PrikaziPodatke();

$brojac = $gledaj->rowCount();

switch($prenos){
	
	case "citanje":
	
	$XMLdokument = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?><prikazi></prikazi>");
	
	if($brojac > 0){
		
		while($vidi = $gledaj->fetch(PDO::FETCH_ASSOC)){
			$prikazi = $XMLdokument->addChild("prikaz");
			$prikazi->addChild("id_podaci",$vidi["id_podaci"]);
			$prikazi->addChild("ime",$vidi["ime"]);
			$prikazi->addChild("prezime",$vidi["prezime"]);
			$prikazi->addChild("email",$vidi["email"]);
			$prikazi->addChild("datum_zurke",$vidi["datum_zurke"]);
			$prikazi->addChild("vreme_zurke_od",$vidi["vreme_zurke_od"]);
			$prikazi->addChild("vreme_zurke_do",$vidi["vreme_zurke_do"]);
			$prikazi->addChild("vrsta_zurke",$vidi["vrsta_zurke"]);
		}
		
	}
	break;
	
}	

Header('Content-type: text/xml');
echo $XMLdokument->asXML();	
		
?>