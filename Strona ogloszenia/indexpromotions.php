<?php	
function indexpromotions(){
	require_once("php/connectd.php");
	$uname = md5(uniqid(time(), true));
	$unsetname = $uname;
	$zapytanie = 'SELECT * FROM '.$unsetname.' WHERE dateremove > NOW() AND Promglowna > NOW() ORDER BY RAND() LIMIT 15';
	$pytanko = ' WHERE dateremove != 0 AND Promglowna > NOW() ORDER BY RAND() LIMIT 15';
	try{
		$db_name = $administratorbazy.'temporary';
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		mysqli_query($connect, "SET CHARSET utf8");
		mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
		if($connect->connect_errno!=0){
			throw new Exception(mysqli_connect_errno());
		}

		if(!$connect->set_charset("utf8")){
			printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
			exit();
			
		}else{
			
			$pytanietymczasowa = 'CREATE TEMPORARY TABLE `'.$unsetname.'` (
											  `bazad` text COLLATE utf8_polish_ci NOT NULL,
											  
											  `Kategoria1` text COLLATE utf8_polish_ci NOT NULL,
											  `Kategoria2` text COLLATE utf8_polish_ci NOT NULL,
											  `Kategoria3` text COLLATE utf8_polish_ci NOT NULL,
											  `Odnosnik` text COLLATE utf8_polish_ci NOT NULL,
											  `ID` int(11) NOT NULL,
											  `Typ` text COLLATE utf8_polish_ci NOT NULL,
											  `Icon` text COLLATE utf8_polish_ci NOT NULL,
											  
											  `dateremove` datetime NOT NULL,
											  `Tytul` text COLLATE utf8_polish_ci NOT NULL,
											  `Cena` int(11) NOT NULL,
											  `Negocjacja` text COLLATE utf8_polish_ci NOT NULL,
											  `Promglowna` datetime NOT NULL,
											  `Photo1` text COLLATE utf8_polish_ci NOT NULL,
											  `Photo2` text COLLATE utf8_polish_ci NOT NULL,
											  `Photo3` text COLLATE utf8_polish_ci NOT NULL,
											  `Photo4` text COLLATE utf8_polish_ci NOT NULL,
											  `Photo5` text COLLATE utf8_polish_ci NOT NULL,
											  `Photo6` text COLLATE utf8_polish_ci NOT NULL,
											  `Photo7` text COLLATE utf8_polish_ci NOT NULL,
											  `Photo8` text COLLATE utf8_polish_ci NOT NULL
											)';
			if($result = $connect->query($pytanietymczasowa)){
				//echo 'utworzono bazę';
				if(!isset($pytanko)){
					echo '<div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">';
					echo 'Nie znaleziono ogłoszeń w podanych kryteriach wyszukiwania.</br>Wyświetlono wszystkie ogłoszenia, może znajdziesz to co szukasz?';
					echo '</div>';
				}
				// MOTORYZACJA
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM samochody_osobowe';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z motoryzacji: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Samochody osobowe';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-samochody-osobowe.php';
							$Icon = 'img/caricon1.png';
							
							$Bazad = 'samochody_osobowe';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM samochody_ciezarowe';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Samochody ciężarowe';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-samochody-ciezarowe.php';
							$Icon = 'img/truck.png';
							
							$Bazad = 'samochody_ciezarowe';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM samochody_dostawcze';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Samochody dostawcze';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-samochody-dostawcze.php';
							$Icon = 'img/truck.png';
							
							$Bazad = 'samochody_dostawcze';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM motocykle_skutery';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Motocykle i skutery';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-motocykle-skutery.php';
							$Icon = 'img/motorcycle.png';
							
							$Bazad = 'motocykle_skutery';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM pojazdy_rolnicze';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Pojazdy rolnicze';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-pojazdy-rolnicze.php';
							$Icon = 'img/truck.png';
							
							$Bazad = 'pojazdy_rolnicze';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM felgi_opony';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Felgi i opony';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-felgi-opony.php';
							$Icon = 'img/wrench.png';
							
							$Bazad = 'felgi_opony';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM audio';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Sprzęt audio';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-audio.php';
							$Icon = 'img/wrench.png';
							
							$Bazad = 'audio';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'motoryzacja');
				$pytanko1 = 'SELECT * FROM pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Motoryzacja';
							$Kategoria2 = 'Pozostałe';
							$Kategoria3 = 'none';
							$Odnosnik = 'motoryzacja/ogloszenia-pozostale.php';
							$Icon = 'img/wrench.png';
							
							$Bazad = 'pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}

				
				// ELEKTRONIKA
				$connect->select_db($administratorbazy.'elektronika');
				$pytanko1 = 'SELECT * FROM elektronika_komputery';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Elektronika';
							$Kategoria2 = 'Komputery';
							$Kategoria3 = 'none';
							$Odnosnik = 'elektronika/ogloszenia-komputery.php';
							$Icon = 'img/computericon1.png';
							
							$Bazad = 'elektronika_komputery';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'elektronika');
				$pytanko1 = 'SELECT * FROM elektronika_telewizory';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Elektronika';
							$Kategoria2 = 'Telewizory';
							$Kategoria3 = 'none';
							$Odnosnik = 'elektronika/ogloszenia-telewizory.php';
							$Icon = 'img/computericon1.png';
							
							$Bazad = 'elektronika_telewizory';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'elektronika');
				$pytanko1 = 'SELECT * FROM elektronika_telefony';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Elektronika';
							$Kategoria2 = 'Telefony';
							$Kategoria3 = 'none';
							$Odnosnik = 'elektronika/ogloszenia-telefony.php';
							$Icon = 'img/computericon1.png';
							
							$Bazad = 'elektronika_telefony';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'elektronika');
				$pytanko1 = 'SELECT * FROM elektronika_tablety';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Elektronika';
							$Kategoria2 = 'Tablety';
							$Kategoria3 = 'none';
							$Odnosnik = 'elektronika/ogloszenia-tablety.php';
							$Icon = 'img/computericon1.png';
							
							$Bazad = 'elektronika_tablety';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'elektronika');
				$pytanko1 = 'SELECT * FROM elektronika_konsole';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Elektronika';
							$Kategoria2 = 'Konsole';
							$Kategoria3 = 'none';
							$Odnosnik = 'elektronika/ogloszenia-konsole.php';
							$Icon = 'img/computericon1.png';
							
							$Bazad = 'elektronika_konsole';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'elektronika');
				$pytanko1 = 'SELECT * FROM elektronika_akcesoria';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Elektronika';
							$Kategoria2 = 'Akcesoria';
							$Kategoria3 = 'none';
							$Odnosnik = 'elektronika/ogloszenia-akcesoria.php';
							$Icon = 'img/computericon1.png';
							
							$Bazad = 'elektronika_akcesoria';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'elektronika');
				$pytanko1 = 'SELECT * FROM elektronika_pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Elektronika';
							$Kategoria2 = 'Pozostałe';
							$Kategoria3 = 'none';
							$Odnosnik = 'elektronika/ogloszenia-pozostale.php';
							$Icon = 'img/computericon1.png';
							
							$Bazad = 'elektronika_pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				// NIERUCHOMOŚCI
				$connect->select_db($administratorbazy.'nieruchomosci');
				$pytanko1 = 'SELECT * FROM nieruchomosci_domy';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Nieruchomości';
							$Kategoria2 = 'Domy';
							
							if($w['Kategoria'] == 'Wynajme'){
								$Kategoria3 = 'Wynajmę';
							}else{
								$Kategoria3 = $w['Kategoria'];
							}
							
							$Odnosnik = 'nieruchomosci/ogloszenia-domy.php';
							$Icon = 'img/homeicon1.png';
							
							$Bazad = 'nieruchomosci_domy';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'nieruchomosci');
				$pytanko1 = 'SELECT * FROM nieruchomosci_dzialki';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Nieruchomości';
							$Kategoria2 = 'Działki';
							
							if($w['Kategoria'] == 'Wynajme'){
								$Kategoria3 = 'Wynajmę';
							}else{
								$Kategoria3 = $w['Kategoria'];
							}
							
							$Odnosnik = 'nieruchomosci/ogloszenia-dzialki.php';
							$Icon = 'img/homeicon1.png';
							
							$Bazad = 'nieruchomosci_dzialki';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'nieruchomosci');
				$pytanko1 = 'SELECT * FROM nieruchomosci_garaze';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Nieruchomości';
							$Kategoria2 = 'Garaże';
							
							if($w['Kategoria'] == 'Wynajme'){
								$Kategoria3 = 'Wynajmę';
							}else{
								$Kategoria3 = $w['Kategoria'];
							}
							
							$Odnosnik = 'nieruchomosci/ogloszenia-garaze.php';
							$Icon = 'img/homeicon1.png';
							
							$Bazad = 'nieruchomosci_garaze';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'nieruchomosci');
				$pytanko1 = 'SELECT * FROM nieruchomosci_mieszkania';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Nieruchomości';
							$Kategoria2 = 'Mieszkania';
							
							if($w['Kategoria'] == 'Wynajme'){
								$Kategoria3 = 'Wynajmę';
							}else{
								$Kategoria3 = $w['Kategoria'];
							}
							
							$Odnosnik = 'nieruchomosci/ogloszenia-mieszkania.php';
							$Icon = 'img/homeicon1.png';
							
							$Bazad = 'nieruchomosci_mieszkania';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'nieruchomosci');
				$pytanko1 = 'SELECT * FROM nieruchomosci_pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Nieruchomości';
							$Kategoria2 = 'Pozostałe';
							
							if($w['Kategoria'] == 'Wynajme'){
								$Kategoria3 = 'Wynajmę';
							}else{
								$Kategoria3 = $w['Kategoria'];
							}
							
							$Odnosnik = 'nieruchomosci/ogloszenia-pozostale.php';
							$Icon = 'img/homeicon1.png';
							
							$Bazad = 'nieruchomosci_pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				// DOM I OGRÓD
				$connect->select_db($administratorbazy.'domiogrod');
				$pytanko1 = 'SELECT * FROM domogrod_meble';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Dom i ogród';
							$Kategoria2 = 'Meble';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'dom-ogrod/ogloszenia-meble.php';
							$Icon = 'img/homeandicon1.png';
							
							$Bazad = 'domogrod_meble';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'domiogrod');
				$pytanko1 = 'SELECT * FROM domogrod_ogrod';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Dom i ogród';
							$Kategoria2 = 'Ogród';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'dom-ogrod/ogloszenia-ogrod.php';
							$Icon = 'img/homeandicon1.png';
							
							$Bazad = 'domogrod_ogrod';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'domiogrod');
				$pytanko1 = 'SELECT * FROM domogrod_oswietlenie';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Dom i ogród';
							$Kategoria2 = 'Oświetlenie';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'dom-ogrod/ogloszenia-oswietlenie.php';
							$Icon = 'img/homeandicon1.png';
							
							$Bazad = 'domogrod_oswietlenie';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'domiogrod');
				$pytanko1 = 'SELECT * FROM domogrod_pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Dom i ogród';
							$Kategoria2 = 'Pozostałe';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'dom-ogrod/ogloszenia-pozostale.php';
							$Icon = 'img/homeandicon1.png';
							
							$Bazad = 'domogrod_pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'domiogrod');
				$pytanko1 = 'SELECT * FROM domogrod_rtvagd';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Dom i ogród';
							$Kategoria2 = 'Sprzęt RTV/AGD';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'dom-ogrod/ogloszenia-rtvagd.php';
							$Icon = 'img/homeandicon1.png';
							
							$Bazad = 'domogrod_rtvagd';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				// PRACA
				$connect->select_db($administratorbazy.'praca');
				$pytanko1 = 'SELECT * FROM praca_dorywcza';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Praca';
							$Kategoria2 = 'Dorywcza';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'praca/ogloszenia-dorywcza.php';
							$Icon = 'img/jobicon1.png';
							
							$Bazad = 'praca_dorywcza';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'praca');
				$pytanko1 = 'SELECT * FROM praca_pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Praca';
							$Kategoria2 = 'Pozostałe';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'praca/ogloszenia-pozostale.php';
							$Icon = 'img/jobicon1.png';
							
							$Bazad = 'praca_pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'praca');
				$pytanko1 = 'SELECT * FROM praca_uslugi';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Praca';
							$Kategoria2 = 'Usługi';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'praca/ogloszenia-uslugi.php';
							$Icon = 'img/jobicon1.png';
							
							$Bazad = 'praca_uslugi';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'praca');
				$pytanko1 = 'SELECT * FROM praca_wkraju';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Praca';
							$Kategoria2 = 'W kraju';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'praca/ogloszenia-wkraju.php';
							$Icon = 'img/jobicon1.png';
							
							$Bazad = 'praca_wkraju';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'praca');
				$pytanko1 = 'SELECT * FROM praca_zagranica';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Praca';
							$Kategoria2 = 'Za granicą';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'praca/ogloszenia-zagranica.php';
							$Icon = 'img/jobicon1.png';
							
							$Bazad = 'praca_zagranica';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				// ODZIEŻ
				$connect->select_db($administratorbazy.'odziez');
				$pytanko1 = 'SELECT * FROM odziez_buty';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Odzież';
							$Kategoria2 = 'Buty';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'odziez/ogloszenia-buty.php';
							$Icon = 'img/clothesicon1.png';
							
							$Bazad = 'odziez_buty';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'odziez');
				$pytanko1 = 'SELECT * FROM odziez_dodatki';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Odzież';
							$Kategoria2 = 'Dodatki';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'odziez/ogloszenia-dodatki.php';
							$Icon = 'img/clothesicon1.png';
							
							$Bazad = 'odziez_dodatki';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'odziez');
				$pytanko1 = 'SELECT * FROM odziez_pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Odzież';
							$Kategoria2 = 'Pozostałe';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'odziez/ogloszenia-pozostale.php';
							$Icon = 'img/clothesicon1.png';
							
							$Bazad = 'odziez_pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'odziez');
				$pytanko1 = 'SELECT * FROM odziez_ubrania';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Odzież';
							$Kategoria2 = 'Ubrania';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'odziez/ogloszenia-ubrania.php';
							$Icon = 'img/clothesicon1.png';
							
							$Bazad = 'odziez_ubrania';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'odziez');
				$pytanko1 = 'SELECT * FROM odziez_zegarki';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Odzież';
							$Kategoria2 = 'Zegarki';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'odziez/ogloszenia-zegarki.php';
							$Icon = 'img/clothesicon1.png';
							
							$Bazad = 'odziez_zegarki';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				
				// ZWIERZĘTA
				$connect->select_db($administratorbazy.'zwierzeta');
				$pytanko1 = 'SELECT * FROM zwierzeta_dlazwierzat';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Zwierzęta';
							$Kategoria2 = 'Dla zwierząt';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'zwierzeta/ogloszenia-dlazwierzat.php';
							$Icon = 'img/peticon1.png';
							
							$Bazad = 'zwierzeta_dlazwierzat';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'zwierzeta');
				$pytanko1 = 'SELECT * FROM zwierzeta_koty';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Zwierzęta';
							$Kategoria2 = 'Koty';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'zwierzeta/ogloszenia-koty.php';
							$Icon = 'img/peticon1.png';
							
							$Bazad = 'zwierzeta_koty';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'zwierzeta');
				$pytanko1 = 'SELECT * FROM zwierzeta_pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Zwierzęta';
							$Kategoria2 = 'Pozostałe';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'zwierzeta/ogloszenia-pozostale.php';
							$Icon = 'img/peticon1.png';
							
							$Bazad = 'zwierzeta_pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'zwierzeta');
				$pytanko1 = 'SELECT * FROM zwierzeta_psy';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Zwierzęta';
							$Kategoria2 = 'Psy';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'zwierzeta/ogloszenia-psy.php';
							$Icon = 'img/peticon1.png';
							
							$Bazad = 'zwierzeta_psy';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				$connect->select_db($administratorbazy.'zwierzeta');
				$pytanko1 = 'SELECT * FROM zwierzeta_schroniska';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Zwierzęta';
							$Kategoria2 = 'Schroniska';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'zwierzeta/ogloszenia-schroniska.php';
							$Icon = 'img/peticon1.png';
							
							$Bazad = 'zwierzeta_schroniska';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				
				// ODDAM ZA DARMO
				$connect->select_db($administratorbazy.'oddamzadarmo');
				$pytanko1 = 'SELECT * FROM oddamzadarmo';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Oddam za darmo';
							$Kategoria2 = 'none';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'oddam-za-darmo/ogloszenia-oddamzadarmo.php';
							$Icon = 'img/freeicon1.png';
							
							$Bazad = 'oddamzadarmo';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				
				// POZOSTAŁE
				$connect->select_db($administratorbazy.'pozostale');
				$pytanko1 = 'SELECT * FROM pozostale_pozostale';if(isset($pytanko)){$pytanko1 = $pytanko1.$pytanko;}
				if($result = $connect->query($pytanko1)){
					//echo 'wybrano samochody_osobowe';
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br>Wyników z ciężarowych: '.$wyniki;
						for($r = 1; $r <= $wyniki; $r++){
							$w = $result->fetch_assoc();
							
							$connect->select_db($administratorbazy.'temporary');
							$Kategoria1 = 'Pozostałe';
							$Kategoria2 = 'none';
							$Kategoria3 = 'none';
							
							$Odnosnik = 'pozostale/ogloszenia-pozostale.php';
							$Icon = 'img/othersicon1.png';
							
							$Bazad = 'pozostale_pozostale';
							if($connect->query("INSERT INTO $unsetname(bazad,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Icon,dateremove,Tytul,Cena,Negocjacja,Promglowna,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$Kategoria1."'
								,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".$Icon."','".@$w['dateremove']."','".@$w['Tytul']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Promglowna']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

							}else{
								throw new Exception($connect->error);
							}
						}
					}
				}else{
					throw new Exception($connect->error);
				}
				

				// ------------------- wyświetlanie ----------------------------------

				$connect->select_db($administratorbazy.'temporary');
				if($result = $connect->query('SELECT * FROM '.$unsetname)){
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo '</br> WYNIKI OSTATECZNE '.$wyniki;
						$wyniki = $result->num_rows;

					}else{
						echo '<div style="max-width: 33.3%; height: 33.3%;">Dodaj swoje ogłoszenie i wypromuj je tutaj!<br><br>
							Dzięki wyróżenieniu Twoje ogłoszenie szybciej zyska na popularności, oraz zobaczy je więcej osób.<br><br>
							Wyróżenienie ogłoszenia to szybki i łatwy sposób, aby zwiększyć widoczność ogłoszenia a tym samym zyskać większą ilość potencjalnie zainteresowanych Twoim ogłoszeniem.<br>							
							</div>';
					}
					
				}else{
					throw new Exception($connect->error);
				}

		// wyciągnięcie  z   bazy ogloszeń
				if(isset($zapytanie)){
					if($result = $connect->query($zapytanie)){
						$wyniki = $result->num_rows;
						if($wyniki>0){
							for($r = 1; $r <= $wyniki; $r++){
								$w = $result->fetch_assoc();
								$date = date('Y-m-d H:i:s');
								//echo $date;
								
								$Cena = $w['Cena'];
								//$Tytul = mb_substr($w['Tytul'], 0, 20);
								$Tytul = $w['Tytul'];
								if($w['Kategoria1'] != 'Oddam za darmo'){
									$Cena = number_format($w['Cena'],0," "," ");
									$Cena = $Cena.' PLN';
								}else{
									$Cena = 'Za darmo';
								}
								
								if($w['Kategoria1'] == 'Motoryzacja'){
									if($w['Kategoria2'] == 'Motocykle i skutery' || $w['Kategoria2'] == 'Felgi i opony' || $w['Kategoria2'] == 'Sprzęt audio'
									|| $w['Kategoria2'] == 'Pozostałe'){
										$num = 3;
									}else{
										$num = 8;
									}
								}
								if($w['Kategoria1'] == 'Elektronika'){
									$num = 3;
								}
								if($w['Kategoria1'] == 'Nieruchomości'){
									$num = 8;
								}
								if($w['Kategoria1'] == 'Dom i ogród'){
									$num = 3;
								}
								if($w['Kategoria1'] == 'Praca'){
									$num = 1;
								}
								if($w['Kategoria1'] == 'Odzież'){
									$num = 3;
								}
								if($w['Kategoria1'] == 'Zwierzęta'){
									$num = 3;
								}
								if($w['Kategoria1'] == 'Oddam za darmo'){
									$num = 1;
								}
								if($w['Kategoria1'] == 'Pozostałe'){
									$num = 3;
								}
								
								// -------------
								echo '<div class="col-md-6 mb-4 mb-lg-4 col-lg-4">
									<div class="listing-item" style="border-bottom: 5px solid #f89d13;">
									  <div class="listing-image">';
								
								for($i=1; $i<=$num; $i++){
									if($w['Photo'.$i] != ''){
										$file = 'galeria/aktywne/'.$w['Photo'.$i];
										if(!isset($glowne)){
											if(@file_exists($file)){
												$glowne = $w['Photo'.$i];
												echo '<img src="galeria/aktywne/'.$w['Photo'.$i].'" alt="Image" class="img-fluid">';
											}
										}
									}
								}
								if(!isset($glowne)){
									echo '<img src="img/camera.png" alt="Image" class="img-fluid">';
								}
								
								echo '
									  </div>
									  <div class="listing-item-content">
										<a href="'.$w['Odnosnik'].'?id='.$w['ID'].'" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;" title="Ogłoszenie promowane"></span></a>
										<a class="px-3 mb-3 category" style="background-color: #f89d13;" href="'.$w['Odnosnik'].'?id='.$w['ID'].'">'.$w['Kategoria1'].'</a>
										<h2 class="mb-1"><a href="'.$w['Odnosnik'].'?id='.$w['ID'].'">'.$Tytul.'</a></h2>
										<span style="display: inline-block;" class="icon-tags"></span> <span class="address" style="display: inline-block;">'.$Cena;
										  if($w['Negocjacja'] == 'on'){
											echo ' do negocjacji';
										  }
										  echo '</span>
									  </div>
									</div>
								  </div>';
								  
								  
								  
								
								if(isset($glowne)){
									unset($glowne);
								}
							}
						}
					}else{
						throw new Exception($connect->error);
					}
				}
				$connect->close();
				//echo '<span style="color:red;"></br>Zamknięto połączenie';
			}else{
				throw new Exception($connect->error);
			}
		}
	}
	catch(Exception $error){
		echo "<script>window.location.href = 'index.php';</script>";
		echo '<div style="color: red; font-size: 15px;">Przepraszamy wystąpił błąd, prosimy spróbować ponownie.</div>';
		//$_SERVER['HTTP_REFERER']
		//echo '</br>Informacja developerska:</br>'.$error;
	}
}
?>