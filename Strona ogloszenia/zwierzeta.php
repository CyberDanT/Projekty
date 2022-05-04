<?php
session_start();
$count = 16;	
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
	<title>Wszystko w zwierzęta - BezGrosika.pl serwis ogłoszeniowy</title>
	<link rel="shortcut icon" href="img/grosiky.png">
	<meta name="keywords" content="serwis ogłoszeniowy, zwierzęta, koty belgijskie, psy owczarki niemieckie, yorki, buldogi, pies ze schroniska i inne w bezgrosika"/>
	<meta name="description" content="Wszystko w kategorii zwierzęta. Koty - kociaki, psy - szczeniaki, zwierzęta z schroniska, klatki i transportery dla zwierząt, akcesoria dla zwierząt, karmy dla zwierząt i inne w ogłoszeniach BezGrosika.pl"/>
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
                <h1>Zwierzęta</h1>
                <p class="mb-0">Wszystkie ogłoszenia w zwierzętach</p>
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
            <h2 class="font-weight-light text-primary">Wszystkie w zwierzętach</h2>
          </div>
        </div>
        <div class="row mt-5">
		
		  <!-- Ogłoszenia promowane -->
		  
		  <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <a href="#" class="img d-block" style="background-image: url('images/img_7.jpg')"></a>
              <div class="lh-content">
                <span class="category" style="background-color: #f89d13;">Zwierzęta</span>
				<a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a></a>
                <h3><a href="#">Kot szuka domu</a></h3>
                <address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> 1 PLN</address>
              </div>
            </div>
		  </div>

		<!-- Ogłoszenia zwykłe -->
          <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <a href="#" class="img d-block" style="background-image: url('images/img_7.jpg')"></a>
              <div class="lh-content">
                <span class="category">Zwierzęta</span>
                <h3><a href="#">Kot szuka domu</a></h3>
                <address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> 1 PLN</address>
              </div>
            </div>
		  </div>
		  <?php
					require_once("php/connect.php");
					$uname = md5(uniqid(time(), true));
					$unsetname = $uname;
					$zapytanie = 'SELECT * FROM '.$unsetname.' WHERE dateremove > NOW() AND datepromotion > NOW()  ORDER BY refreshdate DESC';
					$zapytanie1 = 'SELECT * FROM '.$unsetname.' WHERE dateremove > NOW() AND datepromotion < NOW()  ORDER BY refreshdate DESC';
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
								// ZWIERZĘTA
								$connect->select_db($administratorbazy.'zwierzeta');
								$pytanko1 = 'SELECT * FROM zwierzeta_dlazwierzat';
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
								$pytanko1 = 'SELECT * FROM zwierzeta_koty';
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
								$pytanko1 = 'SELECT * FROM zwierzeta_pozostale';
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
								$pytanko1 = 'SELECT * FROM zwierzeta_psy';
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
								$pytanko1 = 'SELECT * FROM zwierzeta_schroniska';
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
												
												$num = 3;
												
												$Cena = $w['Cena'];
												$Tytul = mb_substr($w['Tytul'], 0, 20);
												if($w['Kategoria1'] != 'Oddam za darmo'){
													$Cena = number_format($w['Cena'],0," "," ");
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
														<address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> '.$Cena.' PLN';
														if($w['Negocjacja'] == 'on'){
															echo ' do negocjacji';
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
												
												$num = 3;
												
												$Cena = $w['Cena'];
												$Tytul = mb_substr($w['Tytul'], 0, 20);
												if($w['Kategoria1'] != 'Oddam za darmo'){
													$Cena = number_format($w['Cena'],0," "," ");
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
														<address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> '.$Cena.' PLN';
														if($w['Negocjacja'] == 'on'){
															echo ' do negocjacji';
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
									
									// <a href="search.php?page='.$pagen.'">
									echo '
									<div class="col-12 mt-5 text-center">
									  <div class="custom-pagination">';
										if($lStron != 0){
											if($showpage != 1){
												echo '<a href="zwierzeta.php?page='.$previouspage.'">'.$seepreviouspage.'</a>';
											}else{
												echo '<a href="#">_</a>';
											}
										  
											echo '<span>'.$showpage.'</span>';
											
											if($lStron == $showpage){
												echo '<a href="#">_</a>';
											}else{
												echo '<a href="zwierzeta.php?page='.$nextpage.'">'.$seepage.'</a>';
											}
											
											echo '<span class="more-page">...</span>
											<a href="#">'.$lStron.'</a>';
											
										}else{
											echo '<a href="#">_</a>
											<span>1</span>
											<a href="#">_</a>
											<span class="more-page">...</span>
											<a href="#">1</a>';
										}
										
										echo '
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