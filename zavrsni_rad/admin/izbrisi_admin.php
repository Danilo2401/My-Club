<?php

require_once "../baza/baza.php";

require_once "../objekti/rezervacije.php";

$XMLbrisi = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?><obrisi></obrisi>");
	
$baza = new Baza();

$db = $baza->PostaviKonekciju();

$brisanje = new Rezervacije($db);

$brisanje->id = $_POST["id"];

$del = $brisanje->IzbrisiRezervaciju($brisanje->id);

if(isset($del)){
	$brisi = $XMLbrisi->addChild("brisi","Uspesno ste obrisali!");
}else if(!isset($brisanje->id)){
	$brisi = $XMLbrisi->addChild("brisi","Greska!");
}


Header('Content-type: text/xml');
echo $XMLbrisi->asXML();	
?>