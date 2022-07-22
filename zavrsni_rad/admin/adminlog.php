<?php

require_once "../admin/baza/baza_admin.php";

require_once "objekat_admin.php";

$XmlFajl = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8'?><odgovori></odgovori>");

$baza = new BazaAdmin();

$db = $baza->PoveziBazu();

$ulogujAdmina = new Uloguj($db);

$ulogujAdmina->ime = $_POST["ime"];

$ulogujAdmina->lozinka = $_POST["lozinka"];


if(!isset($ulogujAdmina->ime) || empty($ulogujAdmina->ime)){
	$odgovor = $XmlFajl->addChild("odgovor","Niste uneli tacno podatke ili ih niste uneli!");
}elseif(!isset($ulogujAdmina->lozinka) || empty($ulogujAdmina->lozinka)){
	$odgovor = $XmlFajl->addChild("odgovor","Niste uneli tacno podatke ili ih niste uneli!");
}elseif($ulogujAdmina->ime != "Admin" || $ulogujAdmina->lozinka != "admin123"){
	$odgovor = $XmlFajl->addChild("odgovor","Niste uneli tacno podatke ili ih niste uneli!");
}elseif($ulogujAdmina->LogovanjeAdmina()){
	$odgovor = $XmlFajl->addChild("odgovor","Uspesno ste uneli podatke!");
}

//Header('Content-type: text/xml');
echo $XmlFajl->asXML();

?>




