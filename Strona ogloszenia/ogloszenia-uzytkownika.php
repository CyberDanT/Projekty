<?php
session_start();
$count = 16;
if(isset($_POST['submit'])){
	if(isset($_POST['searchitem'])){
		if(strrpos($_POST['searchitem'], "=")){
			unset($_POST['searchloc']);
			$_POST['globalerrorfrom'] = 'Przepraszamy wystąpił bląd.';
			header("Location: index.php");
			exit();
		}
	}
	if(isset($_POST['searchloc'])){
		if(strrpos($_POST['searchloc'], "=")){
			unset($_POST['searchloc']);
			$_POST['globalerrorfrom'] = 'Przepraszamy wystąpił bląd.';
			header("Location: index.php");
			exit();
		}
	}
//	echo $_POST['searchitem'];
//	echo $_POST['searchloc'];
}
if(isset($_POST['searchitem']) && $_POST['searchitem'] !=''){
	$_SESSION['searchitem'] = $_POST['searchitem'];
}

if(isset($_POST['searchloc']) && $_POST['searchloc'] !=''){
	$_SESSION['searchloc'] = $_POST['searchloc'];
}
	
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Ogłoszenia użytkownika <?php echo @$_GET['user']; ?> - BezGrosika.pl</title>
    <meta name="keywords" content="Ogłoszenia użytkownika, ogłoszenia w serwisie ogłoszeniowym bez grosika"/>
    <meta name="description" content="Ogłoszenia użytkownika <?php echo $_GET['user']; ?> w serwisie BezGrosika.pl"/>
    <link rel="shortcut icon" href="images/grosiky.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/rangeslider.css">

    <link rel="stylesheet" href="css/style.css">
	
	<style>
	.remove_this_here{
	color: darkred;
	}
	.remove_this_here:hover{
	color: red;
	}
	</style>
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar container py-0 bg-white" role="banner">

      <!-- <div class="container"> -->
        <div class="row align-items-center">
          
          <img src="images/grosiky.png" style="height: 50px;"/><div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="index.php" class="text-black mb-0">Bez<span class="text-primary">Grosika</span>.pl</a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.php">Strona główna</a></li>
                <li><a href="reklama.php">Reklama</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>

                <li class="ml-xl-3 login">
					<?php
						if(isset($_SESSION['user'])){
							echo '<a href="mojekonto.php"><span class="border-left pl-xl-4"></span>'.$_SESSION['user'].'<b><span class="icon-arrow_drop_down"></span></b></a>';
						}else{
							echo '<a href="login.php"><span class="border-left pl-xl-4"></span>Login</a>';
						}
					?>
				</li>
                <li>
					<?php
						if(isset($_SESSION['logged'])){
							echo '<a href="logout.php">Wyloguj się';
						}else{
							echo '<a href="register.php">Rejestracja</a>';
						}
					?>
				</li>

                <li><a href="dodaj-ogloszenie.php" class="cta"><span class="bg-primary text-white rounded">+ Ogłoszenie</span></a></li>
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>

        </div>
      <!-- </div> -->
      
    </header>

  
    
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1><?php echo @$_GET['user']; ?></h1>
                <p class="mb-0">Ogłoszenia użytkownika</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

	<div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 text-left border-primary">
			<p2>Wszystkie ogłoszenia użytkownika</p2>
            <h2 class="font-weight-light text-primary"><span class="icon-user"> <?php echo @$_GET['user']; ?></span></h2>
          </div>
        </div>
        <div class="row mt-5">
		
		  <!-- Ogłoszenia promowane -->
          <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <a href="#" class="img d-block" style="background-image: url('images/img_2.jpg')"></a>
              <div class="lh-content">
                <span class="category" style="background-color: #f89d13;">Nieruchomości</span>
                <a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a></a>
                <h3><a href="#">Dom z basenem (przykład promowane)</a></h3>
                <address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> 420 000 PLN</address>
              </div>
            </div>
          </div>

		<!-- Ogłoszenia zwykłe -->
          <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <a href="#" class="img d-block" style="background-image: url('images/img_1.jpg')"></a>
              <div class="lh-content">
                <span class="category">Motoryzacja</span>
                <h3><a href="#">Samochód na sprzedaż (przykład)</a></h3>
                <address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> 185 500 PLN</address>
              </div>
            </div>
		  </div>
		  
			
			<?php
					require_once("php/connect.php");
					// POSIADANE BAZY DANYCH
					// elektronika
					// nieruchomosci
					// domiogrod
					// praca
					// odziez
					// zwierzeta
					// oddamzadarmo
					// pozostale
					$uname = md5(uniqid(time(), true));
					$unsetname = $uname;
					$zapytanie = 'SELECT * FROM '.$unsetname.' WHERE dateremove > NOW() AND datepromotion > NOW()';
					$zapytanie1 = 'SELECT * FROM '.$unsetname.' WHERE dateremove > NOW() AND datepromotion < NOW()';
					if(isset($_SESSION['searchitem'])){
						$zapytanie = $zapytanie.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%"';
						$zapytanie1 = $zapytanie1.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%"';
						$pytanko = ' WHERE Tytul LIKE "%'.$_SESSION['searchitem'].'%"';
					}
					
					if(isset($_SESSION['searchloc'])){
						if($_SESSION['searchloc'] != ''){
							$zapytanie = $zapytanie.' AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
							$zapytanie1 = $zapytanie1.' AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
							$pytanko = ' WHERE Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
						}
					}
					
					if(isset($_SESSION['searchitem'])){
						if(@$_SESSION['searchloc'] != ''){
							$zapytanie = $zapytanie.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%" AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
							$zapytanie1 = $zapytanie1.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%" AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
							$pytanko = ' WHERE Tytul LIKE "%'.$_SESSION['searchitem'].'%" AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
						}
					}
					$zapytanie = $zapytanie.' ORDER BY refreshdate DESC';
					$zapytanie1 = $zapytanie1.' ORDER BY refreshdate DESC';
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
															  `user` text COLLATE utf8_polish_ci NOT NULL,
															  
															  `Kategoria1` text COLLATE utf8_polish_ci NOT NULL,
															  `Kategoria2` text COLLATE utf8_polish_ci NOT NULL,
															  `Kategoria3` text COLLATE utf8_polish_ci NOT NULL,
															  `Odnosnik` text COLLATE utf8_polish_ci NOT NULL,
															  `ID` int(11) NOT NULL,
															  `Typ` text COLLATE utf8_polish_ci NOT NULL,
															  `Marka` text COLLATE utf8_polish_ci NOT NULL,
															  `Model` text COLLATE utf8_polish_ci NOT NULL,
															  `Stanuzytkowy` text COLLATE utf8_polish_ci NOT NULL,
															  `Stantechniczny` text COLLATE utf8_polish_ci NOT NULL,
															  `Przebieg` text COLLATE utf8_polish_ci NOT NULL,
															  `Rokprodukcji` text COLLATE utf8_polish_ci NOT NULL,
															  `Paliwo` text COLLATE utf8_polish_ci NOT NULL,
															  `Skrzynia` text COLLATE utf8_polish_ci NOT NULL,
															  `Icon` text COLLATE utf8_polish_ci NOT NULL,
															  
															  `dateremove` datetime NOT NULL,
															  `datepromotion` datetime NOT NULL,
															  `refreshdate` datetime NOT NULL,
															  `refreshi` int(11) NOT NULL,
															  `Tytul` text COLLATE utf8_polish_ci NOT NULL,
															  `Opis` text COLLATE utf8_polish_ci NOT NULL,
															  `Cena` int(11) NOT NULL,
															  `Negocjacja` text COLLATE utf8_polish_ci NOT NULL,
															  `Lokalizacja` text COLLATE utf8_polish_ci NOT NULL,
															  `Wojewodztwo` text COLLATE utf8_polish_ci NOT NULL,
															  `Miejscowosc` text COLLATE utf8_polish_ci NOT NULL,
															  `Promglowna` datetime NOT NULL,
															  `Ktelefon` text COLLATE utf8_polish_ci NOT NULL,
															  `Kemail` text COLLATE utf8_polish_ci NOT NULL,
															  `Kemailserwis` text COLLATE utf8_polish_ci NOT NULL,
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
								//if(!isset($pytanko)){
								//	echo '<div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">';
								//	echo 'Nie znaleziono ogłoszeń w podanych kryteriach wyszukiwania.</br>Wyświetlono wszystkie ogłoszenia, może znajdziesz to co szukasz?';
								//	echo '</div>';
								//}
								// MOTORYZACJA
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM samochody_osobowe WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM samochody_ciezarowe WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM samochody_dostawcze WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM motocykle_skutery WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM pojazdy_rolnicze WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM felgi_opony WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM audio WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'motoryzacja');
								if($result = $connect->query('SELECT * FROM pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM elektronika_komputery WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'elektronika');
								if($result = $connect->query('SELECT * FROM elektronika_telewizory WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'elektronika');
								if($result = $connect->query('SELECT * FROM elektronika_telefony WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'elektronika');
								if($result = $connect->query('SELECT * FROM elektronika_tablety WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'elektronika');
								if($result = $connect->query('SELECT * FROM elektronika_konsole WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'elektronika');
								if($result = $connect->query('SELECT * FROM elektronika_akcesoria WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'elektronika');
								if($result = $connect->query('SELECT * FROM elektronika_pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM nieruchomosci_domy WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'nieruchomosci');
								if($result = $connect->query('SELECT * FROM nieruchomosci_dzialki WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'nieruchomosci');
								if($result = $connect->query('SELECT * FROM nieruchomosci_garaze WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'nieruchomosci');
								if($result = $connect->query('SELECT * FROM nieruchomosci_mieszkania WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'nieruchomosci');
								if($result = $connect->query('SELECT * FROM nieruchomosci_pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM domogrod_meble WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'domiogrod');
								if($result = $connect->query('SELECT * FROM domogrod_ogrod WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'domiogrod');
								if($result = $connect->query('SELECT * FROM domogrod_oswietlenie WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'domiogrod');
								if($result = $connect->query('SELECT * FROM domogrod_pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'domiogrod');
								if($result = $connect->query('SELECT * FROM domogrod_rtvagd WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM praca_dorywcza WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'praca');
								if($result = $connect->query('SELECT * FROM praca_pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'praca');
								if($result = $connect->query('SELECT * FROM praca_uslugi WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'praca');
								if($result = $connect->query('SELECT * FROM praca_wkraju WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'praca');
								if($result = $connect->query('SELECT * FROM praca_zagranica WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM odziez_buty WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'odziez');
								if($result = $connect->query('SELECT * FROM odziez_dodatki WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'odziez');
								if($result = $connect->query('SELECT * FROM odziez_pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'odziez');
								if($result = $connect->query('SELECT * FROM odziez_ubrania WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'odziez');
								if($result = $connect->query('SELECT * FROM odziez_zegarki WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM zwierzeta_dlazwierzat WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'zwierzeta');
								if($result = $connect->query('SELECT * FROM zwierzeta_koty WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'zwierzeta');
								if($result = $connect->query('SELECT * FROM zwierzeta_pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'zwierzeta');
								if($result = $connect->query('SELECT * FROM zwierzeta_psy WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

											}else{
												throw new Exception($connect->error);
											}
										}
									}
								}else{
									throw new Exception($connect->error);
								}
								
								$connect->select_db($administratorbazy.'zwierzeta');
								if($result = $connect->query('SELECT * FROM zwierzeta_schroniska WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM oddamzadarmo WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
								if($result = $connect->query('SELECT * FROM pozostale_pozostale WHERE dateremove > NOW() AND user="'.$_GET['user'].'"')){
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
											if($connect->query("INSERT INTO $unsetname(bazad,user,Kategoria1,Kategoria2,Kategoria3,Odnosnik,ID,Typ,Marka,Model,Stanuzytkowy,Stantechniczny,Przebieg,Rokprodukcji,Paliwo,Skrzynia,Icon,dateremove,datepromotion,refreshdate,refreshi,Tytul,Opis,Cena,Negocjacja,Lokalizacja,Wojewodztwo,Miejscowosc,Promglowna,Ktelefon,Kemail,Kemailserwis,Photo1,Photo2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8) VALUES ('".@$Bazad."','".@$_GET['user']."','".@$Kategoria1."'
												,'".@$Kategoria2."','".@$Kategoria3."','".@$Odnosnik."','".@$w['ID']."','".@$w['Typ']."','".@$w['Marka']."','".@$w['Model']."','".@$w['Stanuzytkowy']."','".@$w['Stantechniczny']."','".@$w['Przebieg']."','".@$w['Rokprodukcji']."','".@$w['Paliwo']."','".@$w['Skrzynia']."','".$Icon."','".@$w['dateremove']."','".@$w['datepromotion']."','".@$w['refreshdate']."','".@$w['refreshi']."','".@$w['Tytul']."','".@$w['Opis']."','".@$w['Cena']."','".@$w['Negocjacja']."','".@$w['Lokalizacja']."','".@$w['Wojewodztwo']."','".@$w['Miejscowosc']."','".@$w['Promglowna']."','".@$w['Ktelefon']."','".@$w['Kemail']."','".@$w['Kemailserwis']."','".@$w['Photo1']."','".@$w['Photo2']."','".@$w['Photo3']."','".@$w['Photo4']."','".@$w['Photo5']."','".@$w['Photo6']."','".@$w['Photo7']."','".@$w['Photo8']."'   )")){

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
										
									
										$page = 0;
										if(isset($_GET['page'])){
											if(is_numeric($_GET['page'])){
												$page = $_GET['page'];
											}
										}
										
										$wszystkich = $result->num_rows;
										//echo 'Wszystkich: '.$wszystkich.'</br>';
										$stronywszystkich = ceil($wszystkich/$count);
										//echo 'Wszystkich - strony: '.$stronywszystkich.'</br>';
										
										if($result = $connect->query($zapytanie)){
											$promowanych = $result->num_rows;
											if($promowanych != 0){
												//echo 'Promowanych: '.$promowanych.'</br>';
												$stronypromowanych = ceil($promowanych/$count);
												//echo 'Promowanych - strony: '.$stronypromowanych.'</br>';
											}else{
												$promowanych = 0;
											}
										}else{
											throw new Exception($connect->error);
										}
										
										$zwyklych = $wszystkich - $promowanych;
										//echo 'Zwykłych: '.$zwyklych.'</br>';
										$stronyzwyklych = ceil($zwyklych/$count);
										//echo 'Zwykłych - strony: '.$stronyzwyklych.'</br>';
										
									
										
										if($wszystkich != 0){
											if($promowanych != 0){

											$a = $page;
											for($i = 0; $i <= $stronypromowanych; $i++){
												if($i == $a){
													$a = $i;
													break;
												}
											}
												
												if($a == $stronypromowanych-1){
													$zap = " LIMIT ".($a*$count).",$count";
													$zapytanie = $zapytanie.$zap;
													if($result = $connect->query($zapytanie)){
														$a = $result->num_rows;
														//echo 'promowanych wyświetlanych: '.$a.'</br>';
													}else{
														throw new Exception($connect->error);
													}
												}
											
											
												if($page < $stronypromowanych-1){
													$zapytanie = $zapytanie.' LIMIT '.($page*$count).','.$count;
													unset($zapytanie1);
												}
												
												$b = $count - $a;
												if($page == $stronypromowanych-1){
													if($a == $count){
														unset($zapytanie1);
													}else{
														$b = $count - $a;
														$zap = ' LIMIT '.($page*$count).','.$b;
														$zapytanie1 = $zapytanie1.$zap;
													}
												}
												
												if($page > $stronypromowanych-1){
													$zap = ' LIMIT '.($page*$count - $a).','.$count;
													$zapytanie1 = $zapytanie1.$zap;
													unset($zapytanie);
												}
												
											}else{
												$zap = ' LIMIT '.($page*$count).','.$count;
												$zapytanie1 = $zapytanie1.$zap;
												unset($zapytanie);
											}
										}			
									}else{
										echo '<div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">';
											if(isset($_SESSION['user']) && $_SESSION['user'] == $_GET['user']){
												echo 'Nie masz jeszcze żadnych ogłoszeń!</br>Aby dodać ogłoszenie kliknij na górze przycisk "dodaj ogłoszenie"';
											}
										echo '</div>';
									}
									
								}else{
									throw new Exception($connect->error);
								}

						// wyciągnięcie  z   bazy promowanych ogloszeń
								if(isset($zapytanie)){
									if($result = $connect->query($zapytanie)){
										$wyniki = $result->num_rows;
										if($wyniki>0){
											for($r = 1; $r <= $wyniki; $r++){
												$w = $result->fetch_assoc();
												$date = date('Y-m-d H:i:s');
												//echo $date;
												
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
												
												$Cena = $w['Cena'];
												//$Tytul = mb_substr($w['Tytul'], 0, 20);
												$Tytul = $w['Tytul'];
												if($w['Kategoria1'] != 'Oddam'){
													$Cena = number_format($w['Cena'],0," "," ");
													$Cena = $Cena.' PLN';
												}else{
													$Cena = 'Za darmo';
												}
											
												echo '
												<div class="col-lg-6">
													<div class="d-block d-md-flex listing">
												';
												
												for($i=1; $i<=$num; $i++){
													if($w['Photo'.$i] != ''){
														$file = 'galeria/aktywne/'.$w['Photo'.$i];
														if(!isset($glowne)){
															if(@file_exists($file)){
																$glowne = $w['Photo'.$i];
																echo '<a href="'.$w['Odnosnik'].'?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<a href="'.$w['Odnosnik'].'?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'img/camera.png\')"></a>';
												}
												
												echo '
													  <div class="lh-content">
														<span class="category" style="background-color: #f89d13;">'.$w['Kategoria1'].'</span>
														<a href="'.$w['Odnosnik'].'?id='.$w['ID'].'" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a></a>
														<h3><a href="'.$w['Odnosnik'].'?id='.$w['ID'].'">'.$Tytul.'</a></h3>
														<address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> '.$Cena;
														if($w['Negocjacja'] == 'on'){
															echo ' do negocjacji';
														}
														if(isset($_SESSION['user'])){
															if($_SESSION['user'] == $admin || $_SESSION['user'] == $_GET['user']){
																echo '<a class="remove_this_here" href="usun-ogloszenie.php?C='.$w['Kategoria1'].'&C2='.$w['bazad'].'&ID='.$w['ID'].'"><br><br><div><span>Usuń ogłoszenie</span></div></a>';
															}
														}
														echo '</address>
													  </div>
													</div>
												</div>';
												
												unset($glowne);
											}
										}
									}else{
										throw new Exception($connect->error);
									}
								}
								
				// wyciągnięcie zwykłych ogłoszeń
								sleep(0.5);
								if(isset($zapytanie1)){
									if($result = $connect->query($zapytanie1)){
										$wyniki = $result->num_rows;
										if($wyniki>0){
											for($r = 1; $r <= $wyniki; $r++){
												$w = $result->fetch_assoc();
												$date = date('Y-m-d H:i:s');
												//echo $date;
												
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
												$Cena = $w['Cena'];
												//$Tytul = mb_substr($w['Tytul'], 0, 20);
												$Tytul = $w['Tytul'];
												if($w['Kategoria1'] != 'Oddam'){
													$Cena = number_format($w['Cena'],0," "," ");
													$Cena = $Cena.' PLN';
												}else{
													$Cena = 'Za darmo';
												}
											
												echo '
												<div class="col-lg-6">
													<div class="d-block d-md-flex listing">
												';
												
												for($i=1; $i<=$num; $i++){
													if($w['Photo'.$i] != ''){
														$file = 'galeria/aktywne/'.$w['Photo'.$i];
														if(!isset($glowne)){
															if(@file_exists($file)){
																$glowne = $w['Photo'.$i];
																echo '<a href="'.$w['Odnosnik'].'?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<a href="#" class="img d-block" style="background-image: url(\'img/camera.png\')"></a>';
												}
												
												
												
												echo '
													  <div class="lh-content">
														<span class="category">'.$w['Kategoria1'].'</span>
														<h3><a href="'.$w['Odnosnik'].'?id='.$w['ID'].'">'.$Tytul.'</a></h3>
														<address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> '.$Cena;
														if($w['Negocjacja'] == 'on'){
															echo ' do negocjacji';
														}
														if(isset($_SESSION['user'])){
															if($_SESSION['user'] == $admin || $_SESSION['user'] == $_GET['user']){
																echo '<a class="remove_this_here" href="usun-ogloszenie.php?C='.$w['Kategoria1'].'&C2='.$w['bazad'].'&ID='.$w['ID'].'"><br><br><div><span>Usuń ogłoszenie</span></div></a>';
															}
														}
														echo '</address>
													  </div>
													</div>
												</div>';
												unset($glowne);
											} 
										}
									}else{
										throw new Exception($connect->error);
									}
								}				
								
		echo '</div>';
								
								if(isset($_GET['page'])){
									if(is_numeric($_GET['page'])){
										$page = $_GET['page'];
									}else{
										$page = 0;
									}
								}else{
									$page = 0;
								}
								$pytanie = 'SELECT * FROM '.$unsetname;
								if($result = @$connect->query($pytanie)){
									$wyniki = $result->num_rows;
									$lStron = ceil($wyniki / $count);
									$result->free_result();
								}else{
									throw new Exception($connect->error);
								}
									$pagep = $page -1;
									if($pagep <= 0){
										$pagep = 0;
									}									
									$pagen = $page + 1;
									if($pagen >= $lStron -1){
										$pagen = $lStron -1;
									}									
									if(isset($_GET['page'])){
										if(is_numeric($_GET['page'])){
											$showpage = $_GET['page']+1;
										}else{
											$showpage = 1;
										}
									}else{
										$showpage = 1;
									}
									
									$seepage = $showpage+1;
									$nextpage = $page + 1;
									$seepreviouspage = $showpage-1;
									$previouspage = $page - 1;
									$all = $lStron - 1;
									
									// <a href="search.php?page='.$pagen.'">
									echo '
									<div class="col-12 mt-5 text-center">
									  <div class="custom-pagination">';
									  
										if($showpage != 1){
											echo '<a href="ogloszenia-uzytkownika.php?user='.@$_GET['user'].'&page='.$seepreviouspage.'">';
										}else{
											echo '<a href="#">_</a>';
										}
									  
										echo '<span>'.$showpage.'</span>';
										
										if($lStron == $showpage){
											echo '<a href="#">_</a>';
										}else{
											echo '<a href="ogloszenia-uzytkownika.php?user='.@$_GET['user'].'&page='.$nextpage.'">'.$seepage.'</a>';
										}
										
										echo '<span class="more-page">...</span>
										<a href="ogloszenia-uzytkownika.php?user='.@$_GET['user'].'&page='.$all.'">'.$lStron.'</a>
									  </div>
									</div>';

								$connect->close();
								//echo '<span style="color:red;"></br>Zamknięto połączenie';
							}else{
								throw new Exception($connect->error);
							}
						}
					}
					catch(Exception $error){
						//echo "<script>window.location.href = 'search.php';</script>";
						//header('Refresh: 0');
						echo "<script>window.location.reload(false);</script>";
						echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy odświeżyć stronę.</div>';
						//$_SERVER['HTTP_REFERER']
						//echo '</br>Informacja developerska:</br>'.$error;
					}
					
			?>
			
      </div>
    </div>	
	

    <?php
		include_once("footer.php");
		footer();
	?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/rangeslider.min.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>