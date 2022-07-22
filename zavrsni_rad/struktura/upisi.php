<?php 

require_once "../baza/baza.php";
require_once "../objekti/komentari.php";

use Komentari\Komentari;

$DokumentXML = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8'?><pisma></pisma>");

//istanca baze
$baza = new Baza();

//istanca konekcije
$db = $baza->PostaviKonekciju();

//istanca Komentari
$komentari = new Komentari($db);

$komentari->ime_korisnika = $_POST["ime_korisnika"];

$komentari->naslov = $_POST["naslov"];

$komentari->opis = $_POST["opis"];

if(!isset($komentari->ime_korisnika) || empty($komentari->ime_korisnika)){
    $pismo = $DokumentXML->addChild("pismo","Neispravni podaci!");
}elseif(!isset($komentari->naslov) || empty($komentari->naslov)){
	$pismo = $DokumentXML->addChild("pismo","Neispravni podaci!");
}elseif(!isset($komentari->opis) || empty($komentari->opis) || strlen($komentari->opis) > 400 || strlen($komentari->opis) < 12){
	$pismo = $DokumentXML->addChild("pismo","Neispravni podaci!");
}elseif($komentari->DodajKomentar()){
	$pismo = $DokumentXML->addChild("pismo","Uspesno ste uneli komentar.");
}

Header("Content-type:text/xml");
echo $DokumentXML->asXML();


?>