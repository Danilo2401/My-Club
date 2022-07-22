<?php

require_once "../baza/baza.php";
require_once "../objekti/rezervacije.php";


//istanca klase Baza 
$baza = new Baza();

//konekcija Baze
$db = $baza->PostaviKonekciju();

//istanca klase Rezervacije
$rezervacija = new Rezervacije($db);


$rezervacija->Upisi($_POST["ime"],$_POST["prezime"],$_POST["email"],$_POST["datum_zurke"],$_POST["vreme_zurke_od"],$_POST["vreme_zurke_do"],$_POST["vrsta_zurke"]);


?>