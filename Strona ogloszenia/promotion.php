<?php
session_start();
if(!isset($_SESSION['logged'])){
	header('Location: login.php');
	exit();
}else{
	if(!(isset($_SESSION['id']) || isset($_SESSION['category']))){
		if(!isset($_POST['promotion'])){
			unset($_POST['promotion']);
			header("Location: index.php");
			exit();
		}else{
			if(!is_numeric($_POST['id'])){
				unset($_POST['id']);
				header('Location: index.php');
				exit();
			}else{
				if(!($_POST['category'] == 'samochody_osobowe' || $_POST['category'] == 'samochody_ciezarowe' || $_POST['category'] == 'samochody_dostawcze' || $_POST['category'] == 'motocykle_skutery' || $_POST['category'] == 'pojazdy_rolnicze' || $_POST['category'] == 'felgi_opony' || $_POST['category'] == 'audio' || $_POST['category'] == 'pozostale' 
					
				// E L E K T R O N I K A
					|| $_POST['category'] == 'elektronika_akcesoria' || $_POST['category'] == 'elektronika_komputery' || $_POST['category'] == 'elektronika_konsole' || $_POST['category'] == 'elektronika_pozostale' 
					|| $_POST['category'] == 'elektronika_tablety' || $_POST['category'] == 'elektronika_telefony' || $_POST['category'] == 'elektronika_telewizory'
				// N I E R U C H O M O Ś C I
					|| $_POST['category'] == 'nieruchomosci_domy' || $_POST['category'] == 'nieruchomosci_dzialki' || $_POST['category'] == 'nieruchomosci_garaze' 
					|| $_POST['category'] == 'nieruchomosci_mieszkania' || $_POST['category'] == 'nieruchomosci_pozostale'
				// D O M      I      O G R Ó D	
					|| $_POST['category'] == 'domogrod_meble' || $_POST['category'] == 'domogrod_ogrod' || $_POST['category'] == 'domogrod_oswietlenie' 
					|| $_POST['category'] == 'domogrod_pozostale' || $_POST['category'] == 'domogrod_rtvagd'
					
				// P R A C A
					|| $_POST['category'] == 'praca_dorywcza' || $_POST['category'] == 'praca_pozostale' || $_POST['category'] == 'praca_uslugi' 
					|| $_POST['category'] == 'praca_wkraju' || $_POST['category'] == 'praca_zagranica'
					
				// O D Z I E Ż
					|| $_POST['category'] == 'odziez_buty' || $_POST['category'] == 'odziez_dodatki' || $_POST['category'] == 'odziez_pozostale' 
					|| $_POST['category'] == 'odziez_ubrania' || $_POST['category'] == 'odziez_zegarki'
					
				// Z W I E R Z Ę T A
					|| $_POST['category'] == 'zwierzeta_dlazwierzat' || $_POST['category'] == 'zwierzeta_koty' || $_POST['category'] == 'zwierzeta_pozostale' 
					|| $_POST['category'] == 'zwierzeta_psy' || $_POST['category'] == 'zwierzeta_schroniska'
					
				// O D D A M     Z A     D A R M O
					|| $_POST['category'] == 'oddamzadarmo'
					
				// P O Z O S T A Ł E
					|| $_POST['category'] == 'pozostale_pozostale')){
					
					unset($_POST['category']);
					header('Location: index.php');
					exit();
				}else{
					require_once("php/connect.php");
					$_SESSION['id'] = $_POST['id'];
					$_SESSION['category'] = $_POST['category'];
					if($_SESSION['category'] == 'samochody_osobowe' || $_SESSION['category'] == 'samochody_ciezarowe' || $_SESSION['category'] == 'samochody_dostawcze' || $_SESSION['category'] == 'motocykle_skutery' || $_SESSION['category'] == 'pojazdy_rolnicze' || $_SESSION['category'] == 'felgi_opony' || $_SESSION['category'] == 'audio' || $_SESSION['category'] == 'pozostale'){
						$db_name = 'motoryzacja';
						$kategoria = 'Motoryzacja';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'elektronika_akcesoria' || $_SESSION['category'] == 'elektronika_komputery' || $_SESSION['category'] == 'elektronika_konsole' || $_SESSION['category'] == 'elektronika_pozostale' 
						|| $_SESSION['category'] == 'elektronika_tablety' || $_SESSION['category'] == 'elektronika_telefony' || $_SESSION['category'] == 'elektronika_telewizory'){
						$db_name = 'elektronika';
						$kategoria = 'Elektronika';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'nieruchomosci_domy' || $_SESSION['category'] == 'nieruchomosci_dzialki' || $_SESSION['category'] == 'nieruchomosci_garaze' 
						|| $_SESSION['category'] == 'nieruchomosci_mieszkania' || $_SESSION['category'] == 'nieruchomosci_pozostale'){
						$db_name = 'nieruchomosci';
						$kategoria = 'Nieruchomości';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'domogrod_meble' || $_SESSION['category'] == 'domogrod_ogrod' || $_SESSION['category'] == 'domogrod_oswietlenie' 
						|| $_SESSION['category'] == 'domogrod_pozostale' || $_SESSION['category'] == 'domogrod_rtvagd'){
						$db_name = 'domiogrod';
						$kategoria = 'Dom i ogród';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'praca_dorywcza' || $_SESSION['category'] == 'praca_pozostale' || $_SESSION['category'] == 'praca_uslugi' 
						|| $_SESSION['category'] == 'praca_wkraju' || $_SESSION['category'] == 'praca_zagranica'){
						$db_name = 'praca';
						$kategoria = 'Praca';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'odziez_buty' || $_SESSION['category'] == 'odziez_dodatki' || $_SESSION['category'] == 'odziez_pozostale' 
						|| $_SESSION['category'] == 'odziez_ubrania' || $_SESSION['category'] == 'odziez_zegarki'){
						$db_name = 'odziez';
						$kategoria = 'Odzież';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'zwierzeta_dlazwierzat' || $_SESSION['category'] == 'zwierzeta_koty' || $_SESSION['category'] == 'zwierzeta_pozostale' 
						|| $_SESSION['category'] == 'zwierzeta_psy' || $_SESSION['category'] == 'zwierzeta_schroniska'){
						$db_name = 'zwierzeta';
						$kategoria = 'Zwierzęta';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'oddamzadarmo'){
						$db_name = 'oddamzadarmo';
						$kategoria = 'Oddam za darmo';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'pozostale_pozostale'){
						$db_name = 'pozostale';
						$kategoria = 'Pozostałe';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
				}
			}
		}
	}else{
		require_once("php/connect.php");
		if(isset($_POST['category'])){
			if($_POST['category'] == 'samochody_osobowe' || $_POST['category'] == 'samochody_ciezarowe' || $_POST['category'] == 'samochody_dostawcze' || $_POST['category'] == 'motocykle_skutery' || $_POST['category'] == 'pojazdy_rolnicze' || $_POST['category'] == 'felgi_opony' || $_POST['category'] == 'audio' || $_POST['category'] == 'pozostale' 
				
				// E L E K T R O N I K A
					|| $_POST['category'] == 'elektronika_akcesoria' || $_POST['category'] == 'elektronika_komputery' || $_POST['category'] == 'elektronika_konsole' || $_POST['category'] == 'elektronika_pozostale' 
					|| $_POST['category'] == 'elektronika_tablety' || $_POST['category'] == 'elektronika_telefony' || $_POST['category'] == 'elektronika_telewizory'
				// N I E R U C H O M O Ś C I
					|| $_POST['category'] == 'nieruchomosci_domy' || $_POST['category'] == 'nieruchomosci_dzialki' || $_POST['category'] == 'nieruchomosci_garaze' 
					|| $_POST['category'] == 'nieruchomosci_mieszkania' || $_POST['category'] == 'nieruchomosci_pozostale'
				// D O M      I      O G R Ó D	
					|| $_POST['category'] == 'domogrod_meble' || $_POST['category'] == 'domogrod_ogrod' || $_POST['category'] == 'domogrod_oswietlenie' 
					|| $_POST['category'] == 'domogrod_pozostale' || $_POST['category'] == 'domogrod_rtvagd'
					
				// P R A C A
					|| $_POST['category'] == 'praca_dorywcza' || $_POST['category'] == 'praca_pozostale' || $_POST['category'] == 'praca_uslugi' 
					|| $_POST['category'] == 'praca_wkraju' || $_POST['category'] == 'praca_zagranica'
					
				// O D Z I E Ż
					|| $_POST['category'] == 'odziez_buty' || $_POST['category'] == 'odziez_dodatki' || $_POST['category'] == 'odziez_pozostale' 
					|| $_POST['category'] == 'odziez_ubrania' || $_POST['category'] == 'odziez_zegarki'
					
				// Z W I E R Z Ę T A
					|| $_POST['category'] == 'zwierzeta_dlazwierzat' || $_POST['category'] == 'zwierzeta_koty' || $_POST['category'] == 'zwierzeta_pozostale' 
					|| $_POST['category'] == 'zwierzeta_psy' || $_POST['category'] == 'zwierzeta_schroniska'
				
				// O D D A M     Z A     D A R M O
					|| $_POST['category'] == 'oddamzadarmo'
				
				// P O Z O S T A Ł E
					|| $_POST['category'] == 'pozostale_pozostale'){
				
				if(is_numeric($_POST['id'])){
					$_SESSION['id'] = $_POST['id'];
					$_SESSION['category'] = $_POST['category'];
					if($_SESSION['category'] == 'samochody_osobowe' || $_SESSION['category'] == 'samochody_ciezarowe' || $_SESSION['category'] == 'samochody_dostawcze' || $_SESSION['category'] == 'motocykle_skutery' || $_SESSION['category'] == 'pojazdy_rolnicze' || $_SESSION['category'] == 'felgi_opony' || $_SESSION['category'] == 'audio' || $_SESSION['category'] == 'pozostale'){
						$db_name = 'motoryzacja';
						$kategoria = 'Motoryzacja';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'elektronika_akcesoria' || $_SESSION['category'] == 'elektronika_komputery' || $_SESSION['category'] == 'elektronika_konsole' || $_SESSION['category'] == 'elektronika_pozostale' 
						|| $_SESSION['category'] == 'elektronika_tablety' || $_SESSION['category'] == 'elektronika_telefony' || $_SESSION['category'] == 'elektronika_telewizory'){
						$db_name = 'elektronika';
						$kategoria = 'Elektronika';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'nieruchomosci_domy' || $_SESSION['category'] == 'nieruchomosci_dzialki' || $_SESSION['category'] == 'nieruchomosci_garaze' 
						|| $_SESSION['category'] == 'nieruchomosci_mieszkania' || $_SESSION['category'] == 'nieruchomosci_pozostale'){
						$db_name = 'nieruchomosci';
						$kategoria = 'Nieruchomości';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'domogrod_meble' || $_SESSION['category'] == 'domogrod_ogrod' || $_SESSION['category'] == 'domogrod_oswietlenie' 
						|| $_SESSION['category'] == 'domogrod_pozostale' || $_SESSION['category'] == 'domogrod_rtvagd'){
						$db_name = 'domiogrod';
						$kategoria = 'Dom i ogród';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'praca_dorywcza' || $_SESSION['category'] == 'praca_pozostale' || $_SESSION['category'] == 'praca_uslugi' 
						|| $_SESSION['category'] == 'praca_wkraju' || $_SESSION['category'] == 'praca_zagranica'){
						$db_name = 'praca';
						$kategoria = 'Praca';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'odziez_buty' || $_SESSION['category'] == 'odziez_dodatki' || $_SESSION['category'] == 'odziez_pozostale' 
						|| $_SESSION['category'] == 'odziez_ubrania' || $_SESSION['category'] == 'odziez_zegarki'){
						$db_name = 'odziez';
						$kategoria = 'Odzież';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'zwierzeta_dlazwierzat' || $_SESSION['category'] == 'zwierzeta_koty' || $_SESSION['category'] == 'zwierzeta_pozostale' 
						|| $_SESSION['category'] == 'zwierzeta_psy' || $_SESSION['category'] == 'zwierzeta_schroniska'){
						$db_name = 'zwierzeta';
						$kategoria = 'Zwierzęta';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'oddamzadarmo'){
						$db_name = 'oddamzadarmo';
						$kategoria = 'Oddam za darmo';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'pozostale_pozostale'){
						$db_name = 'pozostale';
						$kategoria = 'Pozostałe';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
				}
			}
		}else{
			if(is_numeric($_SESSION['id'])){
				if(isset($_SESSION['category'])){
					if($_SESSION['category'] == 'samochody_osobowe' || $_SESSION['category'] == 'samochody_ciezarowe' || $_SESSION['category'] == 'samochody_dostawcze' || $_SESSION['category'] == 'motocykle_skutery' || $_SESSION['category'] == 'pojazdy_rolnicze' || $_SESSION['category'] == 'felgi_opony'|| $_SESSION['category'] == 'audio' || $_SESSION['category'] == 'pozostale'){
						$db_name = 'motoryzacja';
						$kategoria = 'Motoryzacja';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'elektronika_akcesoria' || $_SESSION['category'] == 'elektronika_komputery' || $_SESSION['category'] == 'elektronika_konsole' || $_SESSION['category'] == 'elektronika_pozostale' 
						|| $_SESSION['category'] == 'elektronika_tablety' || $_SESSION['category'] == 'elektronika_telefony' || $_SESSION['category'] == 'elektronika_telewizory'){
						$db_name = 'elektronika';
						$kategoria = 'Elektronika';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'nieruchomosci_domy' || $_SESSION['category'] == 'nieruchomosci_dzialki' || $_SESSION['category'] == 'nieruchomosci_garaze' 
						|| $_SESSION['category'] == 'nieruchomosci_mieszkania' || $_SESSION['category'] == 'nieruchomosci_pozostale'){
						$db_name = 'nieruchomosci';
						$kategoria = 'Nieruchomości';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'domogrod_meble' || $_SESSION['category'] == 'domogrod_ogrod' || $_SESSION['category'] == 'domogrod_oswietlenie' 
						|| $_SESSION['category'] == 'domogrod_pozostale' || $_SESSION['category'] == 'domogrod_rtvagd'){
						$db_name = 'domiogrod';
						$kategoria = 'Dom i ogród';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'praca_dorywcza' || $_SESSION['category'] == 'praca_pozostale' || $_SESSION['category'] == 'praca_uslugi' 
						|| $_SESSION['category'] == 'praca_wkraju' || $_SESSION['category'] == 'praca_zagranica'){
						$db_name = 'praca';
						$kategoria = 'Praca';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'odziez_buty' || $_SESSION['category'] == 'odziez_dodatki' || $_SESSION['category'] == 'odziez_pozostale' 
						|| $_SESSION['category'] == 'odziez_ubrania' || $_SESSION['category'] == 'odziez_zegarki'){
						$db_name = 'odziez';
						$kategoria = 'Odzież';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'zwierzeta_dlazwierzat' || $_SESSION['category'] == 'zwierzeta_koty' || $_SESSION['category'] == 'zwierzeta_pozostale' 
						|| $_SESSION['category'] == 'zwierzeta_psy' || $_SESSION['category'] == 'zwierzeta_schroniska'){
						$db_name = 'zwierzeta';
						$kategoria = 'Zwierzęta';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'oddamzadarmo'){
						$db_name = 'oddamzadarmo';
						$kategoria = 'Oddam za darmo';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'pozostale_pozostale'){
						$db_name = 'pozostale';
						$kategoria = 'Pozostałe';
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Promowanie ogłoszenia na BezGrosika.pl</title>
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
    <link rel="stylesheet" href="css/filters.css">
	
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
                <h1>Promowanie ogłoszenia</h1>
                <p class="mb-0">Wypromuj i zyskaj więcej odpowiedzi!</p>
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
            <h2 class="font-weight-light text-primary">Promowanie ogłoszenia</h2>
          </div>
        </div>
        <div class="row mt-5">
		
			<?php 
				if(isset($_SESSION['id'])){
					if(isset($_SESSION['category'])){
						try{
							$connect = new mysqli($host, $db_user, $db_password, $administratorbazy.$db_name);
							mysqli_query($connect, "SET CHARSET utf8");
							mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
							if($connect->connect_errno!=0){
								throw new Exception(mysqli_connect_errno());
							}
							if(!$connect->set_charset("utf8")){
								printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
								exit();
								
							}else{
								$date = date('Y-m-d H:i:s');
								if($result = $connect->query($pytanie)){
									$wynik = $result->num_rows;
									if($wynik > 0){
										$w = $result->fetch_assoc();
										if($_SESSION['user'] != $w['user']){
											$_SESSION['globalerrorfrom'] = 'Nie możesz wyróżnić nie swojego ogłoszenia!';
											header("Location: index.php");
											exit();
										}
										if($kategoria == 'Motoryzacja'){
												if($db_name == 'motocykle_skutery' || $db_name == 'felgi_opony' || $db_name == 'audio'
												|| $db_name == 'pozostale'){
													$num = 3;
												}else{
													$num = 8;
												}
											}
											if($kategoria == 'Elektronika'){
												$num = 3;
											}
											if($kategoria == 'Nieruchomości'){
												$num = 8;
											}
											if($kategoria == 'Dom i ogrod'){
												$num = 3;
											}
											if($kategoria == 'Praca'){
												$num = 1;
											}
											if($kategoria == 'Odzież'){
												$num = 3;
											}
											if($kategoria == 'Zwierzęta'){
												$num = 3;
											}
											if($kategoria == 'Oddam za darmo'){
												$num = 1;
											}
											if($kategoria == 'Pozostałe'){
												$num = 3;
											}
											
											echo '
											<div class="col-lg-6">
												<div class="d-block d-md-flex listing">';
										
											for($i=1; $i<=$num; $i++){
												if($w['Photo'.$i] != ''){
													$file = 'galeria/aktywne/'.$w['Photo'.$i];
													if(!isset($glowne)){
														if(@file_exists($file)){
															$glowne = $w['Photo'.$i];
															if($w['datepromotion'] > $date){
																echo '
																<a href="#" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>
																<div class="lh-content">
																	<span class="category" style="background-color: #f89d13;">'.$kategoria.'</span>
																	<a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a>';
															}else{
																echo '
																<a href="#" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>
																<div class="lh-content">
																	<span class="category">'.$kategoria.'</span>';
															}
														}
													}
												}
											}
												
											if(!isset($glowne)){
												if($w['datepromotion'] > $date){
													echo '
													<a href="#" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>
													<div class="lh-content">
														<span class="category" style="background-color: #f89d13;">'.$kategoria.'</span>
														<a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a>';
												}else{
													echo '
													<a href="#" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>
													<div class="lh-content">
														<span class="category">'.$kategoria.'</span>';
												}
											}
											
											$Cena = $w['Cena'];
											$Tytul = mb_substr($w['Tytul'], 0, 20);
											if($w['Cena'] != 'Oddam'){
												$Cena = number_format($w['Cena'],0," "," ");
												$Cena = $Cena.' PLN';
											}else{
												$Cena = 'Za darmo';
											}
											
											echo '
														<h3><a href="#" title="'.$w['Tytul'].'">'.$Tytul.'</a></h3>
														<address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> '.$Cena.'</address>
													</div>
												</div>
											</div>';
										
										$usuniecie = $w['dateremove'];
										$promowane = $w['datepromotion'];
										$promowaneg = $w['Promglowna'];
										$refreshdate = $w['refreshdate'];
										$refreshint = $w['refreshi'];
										
									}else{
										header("Location: index.php");
										$_SESSION['globalerrorfrom'] = 'Przepraszamy wystąpił błąd, nie znaleziono ogłoszenia.';
									}
									
								}else{
									throw new Exception($connect->error);
								}
							}
							$result->free_result();
							$connect->close();
							//echo 'zamknieto';
						}
						catch(Exception $error){
							echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
							//echo '</br>Informacja developerska:</br>'.$error;
						}
					}
				}
				try{
					$connect = new mysqli($host, $db_user, $db_password, $administratorbazy.'content');
					mysqli_query($connect, "SET CHARSET utf8");
					mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
					if($connect->connect_errno!=0){
						throw new Exception(mysqli_connect_errno());
					}
					if(!$connect->set_charset("utf8")){
						printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
						exit();
						
					}else{
						if($result = $connect->query('SELECT monety FROM accounts WHERE user="'.$_SESSION['user'].'"')){
							$w = $result->fetch_assoc();
							$moneys = $w['monety'];
						}else{
							throw new Exception($connect->error);
						}
					}
					$result->free_result();
					$connect->close();
					//echo 'zamknieto';
				}
				catch(Exception $error){
					echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
					//echo '</br>Informacja developerska:</br>'.$error;
				}
			?>
			
		   <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <div class="lh-content">
                <div class="col-md-7 text-left border-primary">
					<h5 class="font-weight-light text-primary">W skrócie</h5>
				</div>
			
					Wyróżnienie umieszcza Twoje ogłoszenie nad zwykłymi ogłoszeniami oraz dodaje mu specjalne kolory.
					Dzięki wyróżenieniu Twoje ogłoszenie zyskuje większe zainteresowanie.
				
              </div>
            </div>
		  </div>	
			
		  <div style="width: 99%;">
            <div class="d-block d-md-flex listing">
              <div class="lh-content">
                <div class="col-md-7 text-left border-primary">
					<h5 class="font-weight-light text-primary">Wybierz pakiet</h5>
				</div>
				<?php
				echo '<br><b>Data usunięcia ogłoszenia</b><br> '.$usuniecie.'</br>';
				echo '<br><b>Ostatnie odświeżenie</b><br> '.$refreshdate.'</br>';
				?>
				<br>
				
				<form method="post">
					<center><label><input name="pakiet" value="0" checked="" type="radio">
					<span class="spanpromotion">Brak wyróżnienia</span></label><br></center>

					<center>
						<div style="display: inline-block; margin-right: 50px; margin-left: 50px;">
							<div style="margin-left: auto; margin-right: auto; border-bottom: 1px solid #CCC; margin-top: 100px; background: #FDFDFE; padding: 10px; border-radius: 5px;">
								<label style="cursor: pointer;"><input name="pakiet" value="MINI" type="radio">
								<center style="border-bottom: 1px solid #CCC;"><span style="font-size: 20px; color: #30e3ca"><b>MINI</b></span></center>
								 - 7 dni wyróżnienia<br>
								 - 2x <span class="icon icon-refresh" style="color: #6495ed; text-shadow: 1px 1px black;"></span>
								 </br>
								 </br>
								 </br>
								 <b>Do zapłaty</b><br>
								 5 monet
								</label>
							</div>
						</div>
						
						<div style="display: inline-block; margin-right: 50px; margin-left: 50px;">
							<div style=" margin-left: auto; margin-right: auto; border-bottom: 1px solid #CCC; margin-top: 100px; background: #FDFDFE; padding: 10px; border-radius: 5px;">
								<label style="cursor: pointer;"><input name="pakiet" value="MAXI" type="radio">
								<center style="border-bottom: 1px solid #CCC;"><span style="font-size: 20px; color: #30e3ca;"><b>MAXI</b></span></center>
								 - 14 dni wyróżnienia<br>
								 - 5x <span class="icon icon-refresh" style="color: #6495ed; text-shadow: 1px 1px black;"></span>
								 </br>
								 </br>
								 </br>
								  <b>Do zapłaty</b><br>
								 10 monet
								 </label>
							</div>
						</div>
						
						<div style="display: inline-block; margin-right: 50px; margin-left: 50px;">
							<div style="border-bottom: 1px solid #CCC; margin-top: 100px; background: #FDFDFE; padding: 10px; border-radius: 5px;">
								<label style="cursor: pointer;"><input name="pakiet" value="ULTRA" type="radio">
								<center style="border-bottom: 1px solid #CCC;"><span style="font-size: 20px; color: #30e3ca"><b>ULTRA</b></span></center>
								 - 7 dni na stronie głównej<br>
								 - 30 dni wyróżnienia<br>
								 - 8x <span class="icon icon-refresh" style="color: #6495ed; text-shadow: 1px 1px black;"></span>
								 </br>
								 </br>
								  <b>Do zapłaty</b><br>
								 15 monet
								</label>
							</div>
						</div>	
							
					</center>
					
					<br><br>
					
					<center>
					<div style="border: 1px solid gray; border-radius: 15px; width: 50%; padding: 15px; margin: auto; margin-top: 10px; margin-bottom: 10px;">
						<img src="img/grosiky.png" style="width: 30px; vertical-align: bottom;"> <span style="font-size: 20px;">Masz <b><?php echo $w['monety']; ?></b> monet</span> <img src="img/grosiky.png" style="width: 30px; vertical-align: bottom;">
						<br>
						<input type="submit" name="wyroznienie" value="Wyróżnij teraz!" class="filters-input-btn">
						
						</div>
					</div>
					</center>
				</form>
				<?php
				if(isset($_SESSION['pakieterror'])){
					echo '</br><span class="erroraddogl">Wystąpił błąd: </br>'.$_SESSION['pakieterror'].'</span>';
					unset($_SESSION['pakieterror']);
				}
				?>
              </div>
            </div>
		  </div>	
			
		  <div style="width: 99%;">
            <div class="d-block d-md-flex listing">
              <div class="lh-content">
                <div class="col-md-7 text-left border-primary">
					<h5 class="font-weight-light text-primary">Czym jest promowanie?</h5>
				</div>
				<br>
				<p>
					Promowanie jest to wyróżnienie Twojego ogłoszenia.<br>
					Wyróżnienione ogłoszenia są wyświetlane nad zwykłymi oraz różnią się kolorami.<br>
					Przykłady ogłoszeń wyróżnionych można znaleźć wchodząc w dowolną kategorię na stronie.<br>
					<br>
					Dzięki promowaniu Twoje ogłoszenie zyska więcej wyświetleń,<br> czyli tym samym więcej odpowiedzi.<br><br>
					Wyróżnione ogłoszenia na stronie głównej są wyświetlane losowo. Wyróżnienie nie przedłuża ważności ogłoszenia.<br><br>
					Ogłoszenia z pakietami wyróżnień mają własną ilość odświeżeń, dzięki odświeżeniu ogłoszenie jest umieszczane na górze listy i wygląda tak jakby było dopiero dodane!<br>
					Dzięki temu możesz odświeżać swoje ogłoszenie częściej, kiedy tylko zechcesz!<br><br>
					Wyróżnienie ogłoszenia jest liczone od dnia, w którym użytkownik zdecyduje się je wyróżnić. Daty długości wyróżnień nie sumują się. 
					Wyróżnienia są ustalane według pakietów od daty ich aktywowania i nie przedłużają poprzednich pakietów. 
					<br><br>Ilości odświeżeń są sumowane z pozostałymi. 
				</p>
              </div>
            </div>
		  </div>	
		 
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
<?php
if(isset($_POST['wyroznienie'])){
	if(isset($_POST['pakiet'])){
		if($_POST['pakiet'] == 'MINI' || $_POST['pakiet'] == 'MAXI' || $_POST['pakiet'] == 'ULTRA'){
			if($_POST['pakiet'] == 'MINI'){
				$odswiezenia = $refreshint + 2;
				$cena = 5;
				$pytanie = 'UPDATE '.$_SESSION['category'].' SET datepromotion=NOW() + INTERVAL 7 DAY, refreshi='.$odswiezenia.' WHERE ID='.$_SESSION['id'].' AND user="'.$_SESSION['user'].'"';
			}
			if($_POST['pakiet'] == 'MAXI'){
				$odswiezenia = $refreshint + 5;
				$cena = 10;
				$pytanie = 'UPDATE '.$_SESSION['category'].' SET datepromotion=NOW() + INTERVAL 14 DAY, refreshi='.$odswiezenia.' WHERE ID='.$_SESSION['id'].' AND user="'.$_SESSION['user'].'"';
			}
			if($_POST['pakiet'] == 'ULTRA'){
				$odswiezenia = $refreshint + 8;
				$cena = 15;
				$pytanie = 'UPDATE '.$_SESSION['category'].' SET datepromotion=NOW() + INTERVAL 7 DAY, refreshi='.$odswiezenia.', Promglowna=NOW() + INTERVAL 7 DAY WHERE ID='.$_SESSION['id'].' AND user="'.$_SESSION['user'].'"';
			}
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
								if($w['monety'] >= $cena){
									$connect->select_db($administratorbazy.$db_name);
									if($result = @$connect->query($pytanie)){
										$connect->select_db($administratorbazy.'content');
										$monetys = $w['monety'] - $cena;
										if($result = @$connect->query('UPDATE accounts SET monety="'.$monetys.'" WHERE user="'.$_SESSION['user'].'"')){
											$_SESSION['globalerrorfrom'] = 'Wyróżniono ogłoszenie!';
											echo "<script>window.location.href = 'index.php';</script>";
											unset($_SESSION['category']);
											unset($_SESSION['id']);
										}
									}else{
										throw new Exception($connect->error);
									}
								}else{
									$_SESSION['globalerrorfrom'] = 'Nie masz na tyle monet.</br>Monety możesz dokupić w panelu konta.';
									echo "<script>window.location.href = 'index.php';</script>";
									unset($_SESSION['category']);
									unset($_SESSION['id']);
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
				echo "<script>window.location.href = 'index.php';</script>";
				unset($_SESSION['category']);
				unset($_SESSION['id']);
				exit();
			}
		}else{
			if($_POST['pakiet'] == '0'){
				$_SESSION['pakieterror'] = 'Nie wybrano pakietu wyróżnienia.';
			}else{
				$_SESSION['pakieterror'] = 'Nie poprawny pakiet wyróżnienia';
			}
		}
	}
}
?>