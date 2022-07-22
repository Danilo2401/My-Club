<?php 

require_once "../baza/baza.php";
require_once "../objekti/komentari.php";

use Komentari\Komentari;

if(isset($_POST["prosledi"])){
	$prosledi = $_POST["prosledi"];
}else{
	echo "Greska!";
}

//istanca baze
$baza = new Baza();

//konekcija baze
$db = $baza->PostaviKonekciju();

//istanca klase Komentari
$prikaz = new Komentari($db);

//zovemo funkciju
$procitaj = $prikaz->PrikaziKomentar();

switch($prosledi){
	
	case "citaj":
	
	$XMLfajl = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?><poruka></poruka>");
	
	if(isset($prosledi)){
		
		while($kom = $procitaj->fetch(PDO::FETCH_ASSOC)){
			$poruka = $XMLfajl->addChild("poruke");
            $poruka->addChild("ime_korisnika",$kom["ime_korisnika"]);
			$poruka->addChild("naslov",$kom["naslov"]);
			$poruka->addChild("opis",$kom["opis"]);
		}
	}
	break;
	default:"Greska!";
	break;	
}


Header('Content-type: text/xml');
echo $XMLfajl->asXML();

?>