<html>
<?php
require_once("php/connect.php");
session_start();
$days = 30;
$opis = addslashes($_SESSION['addogl_opis']);
$Lokalizacja = $_SESSION['addogl_woj'].', '.$_SESSION['addogl_miej'];
if($_SESSION['addogl_negocjacja'] != ''){
	$negocjacja = 'on';
}else{
	$negocjacja = '';
}

if($_SESSION['addogl_category'] == 'Motoryzacja'){
	if($_SESSION['addogl_category2'] == 'Motocykle i skutery' || $_SESSION['addogl_category2'] == 'Felgi i opony' || $_SESSION['addogl_category2'] == 'Sprzet audio'
	|| $_SESSION['addogl_category2'] == 'Pozostale'){
		$num = 3;
	}else{
		$num = 8;
	}
}
if($_SESSION['addogl_category'] == 'Elektronika'){
	$num = 3;
}
if($_SESSION['addogl_category'] == 'Nieruchomosci'){
	$num = 8;
}
if($_SESSION['addogl_category'] == 'Dom i ogrod'){
	$num = 3;
}
if($_SESSION['addogl_category'] == 'Praca'){
	$num = 1;
}
if($_SESSION['addogl_category'] == 'Odziez'){
	$num = 3;
}
if($_SESSION['addogl_category'] == 'Zwierzeta'){
	$num = 3;
}
if($_SESSION['addogl_category'] == 'Oddam za darmo'){
	$num = 1;
}
if($_SESSION['addogl_category'] == 'Pozostale'){
	$num = 3;
}

for($i=1; $i<=$num; $i++){
	if(isset($_SESSION['Photo'.$i])){
		$file = 'galeria/tymczasowe/'.$_SESSION['Photo'.$i];
		if(@file_exists($file)){
			$_SESSION['Photon'.$i] = $_SESSION['Photo'.$i];
		}else{
			$_SESSION['Photon'.$i] = ' ';
		}
	}else{
		$_SESSION['Photon'.$i] = ' ';
	}
}

if($_SESSION['addogl_category'] == 'Motoryzacja'){
	$db_name = $administratorbazy."motoryzacja";
	if($_SESSION['addogl_category2'] == 'Samochody osobowe' || $_SESSION['addogl_category2'] == 'Samochody dostawcze' || $_SESSION['addogl_category2'] == 'Samochody ciezarowe'){
		if($_SESSION['addogl_category2'] == 'Samochody osobowe'){
			$base = 'samochody_osobowe';
			$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Marka, Model, Mocsilnika, Pojsilnika, Rokprodukcji, Przebieg, Nadwozie, Paliwo, Skrzynia, Kolor, Stantechniczny,
			Stanuzytkowy, Wyposazenie, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8';
			$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", "'.$_SESSION['addogl_category3'].'", 
			"'.$_SESSION['addogl_category4'].'", '.$_SESSION['addogl_mocsilnika'].', '.$_SESSION['addogl_pojsilnika'].', '.$_SESSION['addogl_rok'].', '.$_SESSION['addogl_przebieg'].', "'.$_SESSION['addogl_nadwozie'].'", "'.$_SESSION['addogl_paliwo'].'", "'.$_SESSION['addogl_skrzynia'].'", 
			"'.$_SESSION['addogl_kolor'].'", "'.$_SESSION['addogl_stantechniczny'].'", "'.$_SESSION['addogl_stanuzytkowy'].'", "'.$_SESSION['addogl_wyposazenie'].'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
			"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'"
			, "'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'", "'.$_SESSION['Photon4'].'", "'.$_SESSION['Photon5'].'", "'.$_SESSION['Photon6'].'", "'.$_SESSION['Photon7'].'", "'.$_SESSION['Photon8'].'"';
		}
		if($_SESSION['addogl_category2'] == 'Samochody dostawcze'){
			$base = 'samochody_dostawcze';
			$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Marka, Mocsilnika, Pojsilnika, Rokprodukcji, Przebieg, Paliwo, Skrzynia, Kolor, Stantechniczny,
			Stanuzytkowy, Wyposazenie, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8';
			$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", "'.$_SESSION['addogl_category3'].'", 
			'.$_SESSION['addogl_mocsilnika'].', '.$_SESSION['addogl_pojsilnika'].', '.$_SESSION['addogl_rok'].', '.$_SESSION['addogl_przebieg'].', "'.$_SESSION['addogl_paliwo'].'", "'.$_SESSION['addogl_skrzynia'].'", 
			"'.$_SESSION['addogl_kolor'].'", "'.$_SESSION['addogl_stantechniczny'].'", "'.$_SESSION['addogl_stanuzytkowy'].'", "'.$_SESSION['addogl_wyposazenie'].'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
			"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'"
			, "'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'", "'.$_SESSION['Photon4'].'", "'.$_SESSION['Photon5'].'", "'.$_SESSION['Photon6'].'", "'.$_SESSION['Photon7'].'", "'.$_SESSION['Photon8'].'"';
		}
		if($_SESSION['addogl_category2'] == 'Samochody ciezarowe'){
			$base = 'samochody_ciezarowe';
			$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Marka, Mocsilnika, Pojsilnika, Rokprodukcji, Przebieg, Paliwo, Skrzynia, Kolor, Stantechniczny,
			Stanuzytkowy, Wyposazenie, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8';
			$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", "'.$_SESSION['addogl_category3'].'", 
			'.$_SESSION['addogl_mocsilnika'].', '.$_SESSION['addogl_pojsilnika'].', '.$_SESSION['addogl_rok'].', '.$_SESSION['addogl_przebieg'].', "'.$_SESSION['addogl_paliwo'].'", "'.$_SESSION['addogl_skrzynia'].'", 
			"'.$_SESSION['addogl_kolor'].'", "'.$_SESSION['addogl_stantechniczny'].'", "'.$_SESSION['addogl_stanuzytkowy'].'", "'.$_SESSION['addogl_wyposazenie'].'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
			"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'"
			, "'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'", "'.$_SESSION['Photon4'].'", "'.$_SESSION['Photon5'].'", "'.$_SESSION['Photon6'].'", "'.$_SESSION['Photon7'].'", "'.$_SESSION['Photon8'].'"';
		}
		if($_SESSION['addogl_cena'] <= 5000){
			$platnosc1 = 20;
		}
		if($_SESSION['addogl_cena'] > 5000 && $_SESSION['addogl_cena'] <= 15000){
			$platnosc1 = 25;
		}
		if($_SESSION['addogl_cena'] > 15000 && $_SESSION['addogl_cena'] <= 30000){
			$platnosc1 = 30;
		}
		if($_SESSION['addogl_cena'] > 30000){
			$platnosc1 = 35;
		}
	}
	if($_SESSION['addogl_category2'] == 'Motocykle i skutery'){
		$base = 'motocykle_skutery';
		$platnosc1 = 10;
		$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Typ, Marka, Mocsilnika, Pojsilnika, Rokprodukcji, Przebieg, Stantechniczny,
		Stanuzytkowy, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3';
		$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", "'.$_SESSION['addogl_category3'].'", 
		"'.$_SESSION['addogl_category4'].'", '.$_SESSION['addogl_mocsilnika'].', '.$_SESSION['addogl_pojsilnika'].', '.$_SESSION['addogl_rok'].', '.$_SESSION['addogl_przebieg'].', "'.$_SESSION['addogl_stantechniczny'].'", "'.$_SESSION['addogl_stanuzytkowy'].'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
		"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
		"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'"';
	}
	if($_SESSION['addogl_category2'] == 'Pojazdy rolnicze'){
		$base = 'pojazdy_rolnicze';
		$platnosc1 = 25;
		$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Stantechniczny,
		Stanuzytkowy, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8';
		$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", "'.$_SESSION['addogl_stantechniczny'].'", "'.$_SESSION['addogl_stanuzytkowy'].'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
		"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
		"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'", "'.$_SESSION['Photon4'].'", "'.$_SESSION['Photon5'].'", "'.$_SESSION['Photon6'].'", "'.$_SESSION['Photon7'].'", "'.$_SESSION['Photon8'].'"';
	}
	if($_SESSION['addogl_category2'] == 'Felgi i opony' || $_SESSION['addogl_category2'] == 'Sprzet audio' || $_SESSION['addogl_category2'] == 'Pozostale'){
		$platnosc1 = 1;
		if($_SESSION['addogl_category2'] == 'Felgi i opony'){
			$base = 'felgi_opony';
		}
		if($_SESSION['addogl_category2'] == 'Sprzet audio'){
			$base = 'audio';
		}
		if($_SESSION['addogl_category2'] == 'Pozostale'){
			$base = 'pozostale';
		}
		$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3';
		$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
		"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
		"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'"';
	}
}

if($_SESSION['addogl_category'] == 'Elektronika'){
	$db_name = $administratorbazy."elektronika";
	if($_SESSION['addogl_cena'] <= 500){
		$platnosc1 = 1;
	}
	if($_SESSION['addogl_cena'] > 500){
		$platnosc1 = 2;
	}
	if($_SESSION['addogl_category2'] == 'Akcesoria'){
		$base = 'elektronika_akcesoria';
	}
	if($_SESSION['addogl_category2'] == 'Komputery'){
		$base = 'elektronika_komputery';
	}
	if($_SESSION['addogl_category2'] == 'Konsole'){
		$base = 'elektronika_konsole';
	}
	if($_SESSION['addogl_category2'] == 'Pozostale'){
		$base = 'elektronika_pozostale';
	}
	if($_SESSION['addogl_category2'] == 'Tablety'){
		$base = 'elektronika_tablety';
	}
	if($_SESSION['addogl_category2'] == 'Telefony'){
		$base = 'elektronika_telefony';
	}
	if($_SESSION['addogl_category2'] == 'Telewizory'){
		$base = 'elektronika_telewizory';
	}
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'"';
}

if($_SESSION['addogl_category'] == 'Nieruchomosci'){
	$db_name = $administratorbazy."nieruchomosci";
	if($_SESSION['addogl_category2'] == 'Mieszkania' || $_SESSION['addogl_category2'] == 'Dzialki' || $_SESSION['addogl_category2'] == 'Domy'){
		$platnosc1 = 30;
	}
	if($_SESSION['addogl_category2'] == 'Garaze' || $_SESSION['addogl_category2'] == 'Pozostale'){
		$platnosc1 = 15;
	}
	if($_SESSION['addogl_category2'] == 'Domy'){
		$base = 'nieruchomosci_domy';
	}
	if($_SESSION['addogl_category2'] == 'Dzialki'){
		$base = 'nieruchomosci_dzialki';
	}
	if($_SESSION['addogl_category2'] == 'Garaze'){
		$base = 'nieruchomosci_garaze';
	}
	if($_SESSION['addogl_category2'] == 'Mieszkania'){
		$base = 'nieruchomosci_mieszkania';
	}
	if($_SESSION['addogl_category2'] == 'Pozostale'){
		$base = 'nieruchomosci_pozostale';
	}
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Kategoria, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", "'.$_SESSION['addogl_category3'].'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'", "'.$_SESSION['Photon4'].'", "'.$_SESSION['Photon5'].'", "'.$_SESSION['Photon6'].'", "'.$_SESSION['Photon7'].'", "'.$_SESSION['Photon8'].'"';
}

if($_SESSION['addogl_category'] == 'Dom i ogrod'){
	$db_name = $administratorbazy."domiogrod";
	$platnosc1 = 1;
	if($_SESSION['addogl_category2'] == 'Sprzet RTV/AGD'){
		$base = 'domogrod_rtvagd';
	}
	if($_SESSION['addogl_category2'] == 'Oswietlenie'){
		$base = 'domogrod_oswietlenie';
	}
	if($_SESSION['addogl_category2'] == 'Ogrod'){
		$base = 'domogrod_ogrod';
	}
	if($_SESSION['addogl_category2'] == 'Meble'){
		$base = 'domogrod_meble';
	}
	if($_SESSION['addogl_category2'] == 'Pozostale'){
		$base = 'domogrod_pozostale';
	}
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'"';
}

if($_SESSION['addogl_category'] == 'Praca'){
	$db_name = $administratorbazy."praca";
	if($_SESSION['addogl_category2'] == 'Dorywcza'){
		$platnosc1 = 5;
		$base = 'praca_dorywcza';
	}
	if($_SESSION['addogl_category2'] == 'Za granica'){
		$platnosc1 = 50;
		$base = 'praca_zagranica';
	}
	if($_SESSION['addogl_category2'] == 'W kraju'){
		$platnosc1 = 30;
		$base = 'praca_wkraju';
	}
	if($_SESSION['addogl_category2'] == 'Uslugi' || $_SESSION['addogl_category2'] == 'Pozostale'){
		$platnosc1 = 10;
	}
	if($_SESSION['addogl_category2'] == 'Uslugi'){
		$base = 'praca_uslugi';
	}
	if($_SESSION['addogl_category2'] == 'Pozostale'){
		$base = 'praca_pozostale';
	}
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'"';
}

if($_SESSION['addogl_category'] == 'Odziez'){
	$db_name = $administratorbazy."odziez";
	if($_SESSION['addogl_cena'] <= 500){
		$platnosc1 = 1;
	}
	if($_SESSION['addogl_cena'] > 500){
		$platnosc1 = 2;
	}
	if($_SESSION['addogl_category2'] == 'Ubrania'){
		$base = 'odziez_ubrania';
	}
	if($_SESSION['addogl_category2'] == 'Dodatki'){
		$base = 'odziez_dodatki';
	}
	if($_SESSION['addogl_category2'] == 'Buty'){
		$base = 'odziez_buty';
	}
	if($_SESSION['addogl_category2'] == 'Zegarki'){
		$base = 'odziez_zegarki';
	}
	if($_SESSION['addogl_category2'] == 'Pozostale'){
		$base = 'odziez_pozostale';
	}
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'"';
}

if($_SESSION['addogl_category'] == 'Zwierzeta'){
	$db_name = $administratorbazy."zwierzeta";
	$platnosc1 = 1;
	if($_SESSION['addogl_category2'] == 'Schroniska'){
		$base = 'zwierzeta_schroniska';
	}
	if($_SESSION['addogl_category2'] == 'Koty'){
		$base = 'zwierzeta_koty';
	}
	if($_SESSION['addogl_category2'] == 'Psy'){
		$base = 'zwierzeta_psy';
	}
	if($_SESSION['addogl_category2'] == 'Pozostale zwierzeta'){
		$base = 'zwierzeta_pozostale';
	}
	if($_SESSION['addogl_category2'] == 'Dla zwierzat'){
		$base = 'zwierzeta_dlazwierzat';
	}
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'"';
}

if($_SESSION['addogl_category'] == 'Pozostale'){
	$db_name = $administratorbazy."pozostale";
	$base = 'pozostale_pozostale';
	$platnosc1 = 1;
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1, Photo2, Photo3';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", '.$_SESSION['addogl_cena'].', "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'", "'.$_SESSION['Photon2'].'", "'.$_SESSION['Photon3'].'"';
}

if($_SESSION['addogl_category'] == 'Oddam za darmo'){
	$db_name = $administratorbazy."oddamzadarmo";
	$base = 'oddamzadarmo';
	$platnosc1 = 0;
	$values = 'ID, user, dateremove, datepromotion, refreshdate, refreshi, Tytul, Opis, Cena, Negocjacja, Lokalizacja, Wojewodztwo, Miejscowosc, Promglowna, Ktelefon, Kemail, Kemailserwis, Photo1';
	$pytanie = 'INSERT INTO '.$base.' ('.$values.') VALUES (NULL, "'.$_SESSION['user'].'", NOW() + INTERVAL '.$days.' DAY, 0000-00-00, NOW(), 0, "'.$_SESSION['addogl_title'].'", "'.$opis.'", "'.$_SESSION['addogl_cena'].'", "'.$negocjacja.'", "'.$Lokalizacja.'", 
	"'.$_SESSION['addogl_woj'].'", "'.$_SESSION['addogl_miej'].'", 0000-00-00, "'.$_SESSION['addogl_telefon'].'", "'.$_SESSION['addogl_email'].'", "'.$_SESSION['useremail'].'",
	"'.$_SESSION['Photon1'].'"';
}

 // ---------------------------------- PROMOCJA (niżej druga część zapisu)
	$platnosc1 = 0;
// --------------------------


if($_SESSION['platnosc'] != $platnosc1){
	$_SESSION['globalerrorfrom'] = 'Przepraszamy wystąpił błąd, prosimy spróbować ponownie.';
	unset($_SESSION['platnosc']);
	header("Location: index.php");
	exit();
}

$pytanie = $pytanie.')';
//echo $pytanie;


try{
	$connect = new mysqli($host, $db_user, $db_password, $administratorbazy.'content');
	if($connect->connect_errno!=0){
		throw new Exception(mysqli_connect_errno());
	}else{
		if(!$connect->set_charset("utf8")){
			printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
			exit();
		}else{
			if($result = @$connect->query('SELECT monety FROM accounts WHERE user="'.$_SESSION['user'].'"')){
				$wyniki = $result->num_rows;
				if($wyniki>0){
					$w = $result->fetch_assoc();
					if($w['monety'] >= $platnosc1){
						$connect->select_db($db_name);
						if($result = @$connect->query($pytanie)){
							// przechodzi motoryzacja samochody osobowe
							$connect->select_db($administratorbazy.'content');
							$monetys = $w['monety'] - $platnosc1;
							if($result = @$connect->query('UPDATE accounts SET monety="'.$monetys.'" WHERE user="'.$_SESSION['user'].'"')){
								$_SESSION['globalerrorfrom'] = 'Dziękujemy za umieszczenie ogłoszenia!';
								header("Location: index.php");
							}
							for($i=1; $i<=$num; $i++){
								if(isset($_SESSION['Photo'.$i])){
									$file = 'galeria/tymczasowe/'.$_SESSION['Photo'.$i];
									if(@file_exists($file)){
										rename('galeria/tymczasowe/'.$_SESSION['Photo'.$i].'', 'galeria/aktywne/'.$_SESSION['Photo'.$i].'');
									}
								}
							}
							unset($_SESSION['platnosc']);
							unset($_SESSION['addogl_title']);
							unset($_SESSION['addogl_telefon']);
							unset($_SESSION['addogl_email']);
							unset($_SESSION['addogl_opis']);
							unset($_SESSION['addogl_cena']);
							unset($_SESSION['addogl_negocjacja']);
							unset($_SESSION['addogl_woj']);
							unset($_SESSION['addogl_miej']);
							unset($_SESSION['addogl_cena']);
							unset($_SESSION['addogl_negocjacja']);
							unset($_SESSION['addogl_category']);
							unset($_SESSION['addogl_category2']);
							unset($_SESSION['addogl_category3']);
							unset($_SESSION['addogl_category4']);
							unset($_SESSION['addogl_mocsilnika']);
							unset($_SESSION['addogl_pojsilnika']);
							unset($_SESSION['addogl_rok']);
							unset($_SESSION['addogl_przebieg']);
							unset($_SESSION['addogl_nadwozie']);
							unset($_SESSION['addogl_paliwo']);
							unset($_SESSION['addogl_skrzynia']);
							unset($_SESSION['addogl_kolor']);
							unset($_SESSION['addogl_stantechniczny']);		
							unset($_SESSION['addogl_stanuzytkowy']);
							unset($_SESSION['addogl_wyposazenie']);
							unset($_SESSION['Photo1']);
							unset($_SESSION['Photo2']);
							unset($_SESSION['Photo3']);
							unset($_SESSION['Photo4']);
							unset($_SESSION['Photo5']);
							unset($_SESSION['Photo6']);
							unset($_SESSION['Photo7']);
							unset($_SESSION['Photo8']);
							unset($_SESSION['Photon1']);
							unset($_SESSION['Photon2']);
							unset($_SESSION['Photon3']);
							unset($_SESSION['Photon4']);
							unset($_SESSION['Photon5']);
							unset($_SESSION['Photon6']);
							unset($_SESSION['Photon7']);
							unset($_SESSION['Photon8']);
							unset($_SESSION['accept']);
						}else{
							throw new Exception($connect->error);
						}
					}else{
						$_SESSION['globalerrorfrom'] = 'Przepraszamy wystąpił błąd, prosimy spróbować ponownie.';
						header("Location: index.php");
						exit();
					}
				}
			}else{
				throw new Exception($connect->error);
			}
			//$result->free_result();
			$connect->close();
		}
	}
}
catch(Exception $error){
	//echo '<div class="servererror">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
	//echo '</br>Informacja developerska:</br>'.$error;
	$_SESSION['globalerrorfrom'] = 'Przepraszamy wystąpił błąd, prosimy spróbować ponownie.';
	header("Location: index.php");
	exit();
}
?>
</html>