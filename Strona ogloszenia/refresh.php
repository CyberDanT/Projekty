<?php
include_once("footer.php");
session_start();
if(!isset($_SESSION['logged'])){
	header('Location: login.php');
	exit();
}else{
	if(!(isset($_SESSION['id']) || isset($_SESSION['category']))){
		if(!isset($_POST['refresh'])){
			unset($_POST['refresh']);
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
						$kategoria = "Motoryzacja";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'elektronika_akcesoria' || $_SESSION['category'] == 'elektronika_komputery' || $_SESSION['category'] == 'elektronika_konsole' || $_SESSION['category'] == 'elektronika_pozostale' 
						|| $_SESSION['category'] == 'elektronika_tablety' || $_SESSION['category'] == 'elektronika_telefony' || $_SESSION['category'] == 'elektronika_telewizory'){
						$db_name = 'elektronika';
						$kategoria = "Elektronika";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'nieruchomosci_domy' || $_SESSION['category'] == 'nieruchomosci_dzialki' || $_SESSION['category'] == 'nieruchomosci_garaze' 
						|| $_SESSION['category'] == 'nieruchomosci_mieszkania' || $_SESSION['category'] == 'nieruchomosci_pozostale'){
						$db_name = 'nieruchomosci';
						$kategoria = "Nieruchomości";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'domogrod_meble' || $_SESSION['category'] == 'domogrod_ogrod' || $_SESSION['category'] == 'domogrod_oswietlenie' 
						|| $_SESSION['category'] == 'domogrod_pozostale' || $_SESSION['category'] == 'domogrod_rtvagd'){
						$db_name = 'domiogrod';
						$kategoria = "Dom i ogród";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'praca_dorywcza' || $_SESSION['category'] == 'praca_pozostale' || $_SESSION['category'] == 'praca_uslugi' 
						|| $_SESSION['category'] == 'praca_wkraju' || $_SESSION['category'] == 'praca_zagranica'){
						$db_name = 'praca';
						$kategoria = "Praca";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'odziez_buty' || $_SESSION['category'] == 'odziez_dodatki' || $_SESSION['category'] == 'odziez_pozostale' 
						|| $_SESSION['category'] == 'odziez_ubrania' || $_SESSION['category'] == 'odziez_zegarki'){
						$db_name = 'odziez';
						$kategoria = "Odzież";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'zwierzeta_dlazwierzat' || $_SESSION['category'] == 'zwierzeta_koty' || $_SESSION['category'] == 'zwierzeta_pozostale' 
						|| $_SESSION['category'] == 'zwierzeta_psy' || $_SESSION['category'] == 'zwierzeta_schroniska'){
						$db_name = 'zwierzeta';
						$kategoria = "Zwierzęta";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'oddamzadarmo'){
						$db_name = 'oddamzadarmo';
						$kategoria = "Oddam za darmo";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'pozostale_pozostale'){
						$db_name = 'pozostale';
						$kategoria = "Pozostałe";
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
						$kategoria = "Motoryzacja";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'elektronika_akcesoria' || $_SESSION['category'] == 'elektronika_komputery' || $_SESSION['category'] == 'elektronika_konsole' || $_SESSION['category'] == 'elektronika_pozostale' 
						|| $_SESSION['category'] == 'elektronika_tablety' || $_SESSION['category'] == 'elektronika_telefony' || $_SESSION['category'] == 'elektronika_telewizory'){
						$db_name = 'elektronika';
						$kategoria = "Elektronika";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'nieruchomosci_domy' || $_SESSION['category'] == 'nieruchomosci_dzialki' || $_SESSION['category'] == 'nieruchomosci_garaze' 
						|| $_SESSION['category'] == 'nieruchomosci_mieszkania' || $_SESSION['category'] == 'nieruchomosci_pozostale'){
						$db_name = 'nieruchomosci';
						$kategoria = "Nieruchomości";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'domogrod_meble' || $_SESSION['category'] == 'domogrod_ogrod' || $_SESSION['category'] == 'domogrod_oswietlenie' 
						|| $_SESSION['category'] == 'domogrod_pozostale' || $_SESSION['category'] == 'domogrod_rtvagd'){
						$db_name = 'domiogrod';
						$kategoria = "Dom i ogród";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'praca_dorywcza' || $_SESSION['category'] == 'praca_pozostale' || $_SESSION['category'] == 'praca_uslugi' 
						|| $_SESSION['category'] == 'praca_wkraju' || $_SESSION['category'] == 'praca_zagranica'){
						$db_name = 'praca';
						$kategoria = "Praca";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'odziez_buty' || $_SESSION['category'] == 'odziez_dodatki' || $_SESSION['category'] == 'odziez_pozostale' 
						|| $_SESSION['category'] == 'odziez_ubrania' || $_SESSION['category'] == 'odziez_zegarki'){
						$db_name = 'odziez';
						$kategoria = "Odzież";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'zwierzeta_dlazwierzat' || $_SESSION['category'] == 'zwierzeta_koty' || $_SESSION['category'] == 'zwierzeta_pozostale' 
						|| $_SESSION['category'] == 'zwierzeta_psy' || $_SESSION['category'] == 'zwierzeta_schroniska'){
						$db_name = 'zwierzeta';
						$kategoria = "Zwierzęta";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'oddamzadarmo'){
						$db_name = 'oddamzadarmo';
						$kategoria = "Oddam za darmo";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'pozostale_pozostale'){
						$db_name = 'pozostale';
						$kategoria = "Pozostałe";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
				}
			}
		}else{
			if(is_numeric($_SESSION['id'])){
				if(isset($_SESSION['category'])){
					if($_SESSION['category'] == 'samochody_osobowe' || $_SESSION['category'] == 'samochody_ciezarowe' || $_SESSION['category'] == 'samochody_dostawcze' || $_SESSION['category'] == 'motocykle_skutery' || $_SESSION['category'] == 'pojazdy_rolnicze' || $_SESSION['category'] == 'felgi_opony'|| $_SESSION['category'] == 'audio' || $_SESSION['category'] == 'pozostale'){
						$db_name = 'motoryzacja';
						$kategoria = "Motoryzacja";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'elektronika_akcesoria' || $_SESSION['category'] == 'elektronika_komputery' || $_SESSION['category'] == 'elektronika_konsole' || $_SESSION['category'] == 'elektronika_pozostale' 
						|| $_SESSION['category'] == 'elektronika_tablety' || $_SESSION['category'] == 'elektronika_telefony' || $_SESSION['category'] == 'elektronika_telewizory'){
						$db_name = 'elektronika';
						$kategoria = "Elektronika";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'nieruchomosci_domy' || $_SESSION['category'] == 'nieruchomosci_dzialki' || $_SESSION['category'] == 'nieruchomosci_garaze' 
						|| $_SESSION['category'] == 'nieruchomosci_mieszkania' || $_SESSION['category'] == 'nieruchomosci_pozostale'){
						$db_name = 'nieruchomosci';
						$kategoria = "Nieruchomości";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'domogrod_meble' || $_SESSION['category'] == 'domogrod_ogrod' || $_SESSION['category'] == 'domogrod_oswietlenie' 
						|| $_SESSION['category'] == 'domogrod_pozostale' || $_SESSION['category'] == 'domogrod_rtvagd'){
						$db_name = 'domiogrod';
						$kategoria = "Dom i ogród";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'praca_dorywcza' || $_SESSION['category'] == 'praca_pozostale' || $_SESSION['category'] == 'praca_uslugi' 
						|| $_SESSION['category'] == 'praca_wkraju' || $_SESSION['category'] == 'praca_zagranica'){
						$db_name = 'praca';
						$kategoria = "Praca";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'odziez_buty' || $_SESSION['category'] == 'odziez_dodatki' || $_SESSION['category'] == 'odziez_pozostale' 
						|| $_SESSION['category'] == 'odziez_ubrania' || $_SESSION['category'] == 'odziez_zegarki'){
						$db_name = 'odziez';
						$kategoria = "Odzież";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'zwierzeta_dlazwierzat' || $_SESSION['category'] == 'zwierzeta_koty' || $_SESSION['category'] == 'zwierzeta_pozostale' 
						|| $_SESSION['category'] == 'zwierzeta_psy' || $_SESSION['category'] == 'zwierzeta_schroniska'){
						$db_name = 'zwierzeta';
						$kategoria = "Zwierzęta";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'oddamzadarmo'){
						$db_name = 'oddamzadarmo';
						$kategoria = "Oddam za darmo";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
					if($_SESSION['category'] == 'pozostale_pozostale'){
						$db_name = 'pozostale';
						$kategoria = "Pozostałe";
						$pytanie = 'SELECT * FROM '.$_SESSION['category'].' WHERE ID = '.$_SESSION['id'];
					}
				}
			}
		}
	}
}

unset($disabled);
unset($disabled1);
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Odświeżanie ogłoszenia na BezGrosika.pl</title>
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
                <h1>Odświeżenie ogłoszenia</h1>
                <p class="mb-0">Odśwież i zyskaj więcej odpowiedzi!</p>
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
            <h2 class="font-weight-light text-primary">Odświeżanie ogłoszenia</h2>
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
								if($result = $connect->query('SELECT refreshi FROM accounts WHERE user="'.$_SESSION['user'].'"')){
									$w = $result->fetch_assoc();
									$refreshinta = $w['refreshi'];
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
						
				   echo '<div class="col-lg-6">
							<div class="d-block d-md-flex listing">
							  <div class="lh-content">
								<div class="col-md-7 text-left border-primary">
									<h5 class="font-weight-light text-primary">W skrócie</h5>
								</div>
									<br>
									Po odświeżeniu Twoje ogłoszenie będzie na górze listy.<br>
									Będzie wyglądało jak dopiero co dodane!
								
							  </div>
							</div>
						  </div>	';
						  
					echo '	  
						 <div style="width: 99%;">
							<div class="d-block d-md-flex listing">
							  <div class="lh-content">
								<div class="col-md-7 text-left border-primary">
									<h5 class="font-weight-light text-primary">Wybierz odświeżenie</h5>
								</div>';
								
								echo '<br><b>Data usunięcia ogłoszenia</b><br> '.$usuniecie.'</br>';
								echo '<br><b>Ostatnie odświeżenie</b><br> '.$refreshdate.'</br>';
								//echo 'Wyróżnione przed zwykłymi do: '.$promowane.'</br>';
								//echo 'Wyróżnione na głównej do: '.$promowaneg.'</br>'; // nie więcej niż 7 dni
								//echo 'Ilość odświeżeń z ogłoszenia: '.$refreshint.'</br>';
								//echo 'Ilość odświeżeń z konta: '.$refreshinta.'</br>';
								
								//-----------------
								
						echo '<center>
							<div style="max-width: 300px; display: inline-flex; margin-left: 40px; margin-right: 40px;">
								<form method="post">';									
									$dzisiaj=date("Y-m-d H:i:s");
									$rezult=round((strtotime($dzisiaj)-strtotime($refreshdate))/86400);
									
									if($rezult < 14){
										if($refreshint <= 0){
											$disabled = true;
										}
									}
									
									echo '<input type="submit" class="filters-input-btn" value="Odśwież z ogłoszenia"'; if(!isset($disabled)){echo 'name="reffromogl"';}else{echo 'disabled';} echo '><br>';
									if($refreshint != 0){
										echo 'Pozostało Ci <b>'.$refreshint.'</b> <span class="icon icon-refresh" style="color: #6495ed; text-shadow: 1px 1px black;"></span>';
									}else{
										if($rezult >= 14){
											echo 'Możesz odświeżyć to ogłoszenie!</br>Wykup promowanie i zyskaj więcej możliwości!';
										}else{
											echo 'Nie możesz jeszcze odświeżyć tego ogłoszenia.</br>';
											echo 'Ogłoszenia domyślnie można odświeżać raz na dwa tygodnie.</br>';
											echo 'Wykup promowanie i zyskaj więcej możliwości!</br>';
										}
									}
									
							echo	'</form>
							</div>
							
							
							<div style="max-width: 300px; display: inline-flex; margin-left: 40px; margin-right: 40px;">
								<form method="post">';
									if($refreshinta <= 0){
										$disabled1 = true;
									}
									echo '<input type="submit" class="filters-input-btn" value="Odśwież z konta" '; if(!isset($disabled1)){echo 'name="reffromacc"';}else{echo 'disabled';} echo '></br>
									<div>';
									if($refreshinta != 0){
											echo 'Możesz odświeżyć z pakietu konta!<br>Pozostało Ci <b>'.$refreshinta.'</b> <span class="icon icon-refresh" style="color: #6495ed; text-shadow: 1px 1px black;"></span>';
										}else{
											echo 'Brak pakietu. </br>
												Wykup pakiet odświeżeń w preferencjach konta i odświeżaj swoje ogłoszenia kiedy zechcesz!</br>';
										}
									echo '</div>';
						echo		'</form>
							</div>
						</center>';
						
						
						//echo 'Data usunięcia: '.$usuniecie.'</br>';
						//echo 'Wyróżnione przed zwykłymi do: '.$promowane.'</br>';
						//echo 'Wyróżnione na głównej do: '.$promowaneg.'</br>'; // nie więcej niż 7 dni
						//echo 'Ostatnie odświeżenie: '.$refreshdate.'</br>';
						//echo 'Ilość odświeżeń z ogłoszenia: '.$refreshint.'</br>';
						//echo 'Ilość odświeżeń z konta: '.$refreshinta.'</br>';
								
								
						// czy możliwe - tak lub nie żeby wiedziec od razu
						// może przycisk zamastkowany jeśli nie ale i tak blokada musi być zrobiona w php
							if(isset($_POST['reffromogl'])){
								if($refreshint <= 0){
									if($rezult < 14){
										$ok = false;
									}
								}
								if(!isset($ok)){
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
											if($refreshint <= 0){
												$INTrefresh = 0;
											}else{
												$INTrefresh = $refreshint - 1;
											}
											$zapytanie = 'UPDATE '.$_SESSION['category'].' SET refreshi="'.$INTrefresh.'", refreshdate=NOW() WHERE ID = "'.$_SESSION['id'].'"';
											if($connect->query($zapytanie)){
												$_SESSION['globalerrorfrom'] = 'Ogłoszenie zostało odświeżone!';
												$_SESSION['refreshok'] = true;
											}else{
												throw new Exception($connect->error);
												$_SESSION['globalerrorfrom'] = 'Przepraszamy, coś poszło nie tak, prosimy spróbować później';
												echo "<script>window.location.href = 'index.php';</script>";
											}
										}
										$connect->close();
										//echo 'zamknieto';
									}
									catch(Exception $error){
										echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
										//echo '</br>Informacja developerska:</br>'.$error;
									}
								}else{
									$_SESSION['globalerrorfrom'] = 'Przepraszamy, coś poszło nie tak, prosimy spróbować ponownie.';
									echo "<script>window.location.href = 'index.php';</script>";
								}
							} 
							// promowanie z konta
							if(isset($_POST['reffromacc'])){
								if($refreshinta <= 0){
									$ok = false;
								}
								if(!isset($ok)){
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
											$INTrefresh = $refreshinta - 1;
											$zapytanie = 'UPDATE accounts SET refreshi="'.$INTrefresh.'" WHERE user = "'.$_SESSION['user'].'"';
											if($connect->query($zapytanie)){
												$_SESSION['globalerrorfrom'] = 'Ogłoszenie zostało odświeżone!';
												$_SESSION['refreshok'] = true;
											}else{
												throw new Exception($connect->error);
												$_SESSION['globalerrorfrom'] = 'Przepraszamy, coś poszło nie tak, prosimy spróbować później';
												echo "<script>window.location.href = 'index.php';</script>";
											}
										}
										$connect->close();
										//echo 'zamknieto';
									}
									catch(Exception $error){
										echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
										//echo '</br>Informacja developerska:</br>'.$error;
									}
									
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
											$zapytanie = 'UPDATE '.$_SESSION['category'].' SET refreshdate=NOW() WHERE ID = "'.$_SESSION['id'].'"';
											if($connect->query($zapytanie)){
												$_SESSION['globalerrorfrom'] = 'Ogłoszenie zostało odświeżone!';
												$_SESSION['refreshok'] = true;
											}else{
												throw new Exception($connect->error);
												$_SESSION['globalerrorfrom'] = 'Przepraszamy, coś poszło nie tak, prosimy spróbować później';
												echo "<script>window.location.href = 'index.php';</script>";
											}
										}
										$connect->close();
										//echo 'zamknieto';
									}
									catch(Exception $error){
										echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
										//echo '</br>Informacja developerska:</br>'.$error;
									}
								}else{
									$_SESSION['globalerrorfrom'] = 'Przepraszamy, coś poszło nie tak, prosimy spróbować ponownie.';
									echo "<script>window.location.href = 'index.php';</script>";
								}
							}
								
								//-------------
								
									
							echo '
							  </div>
							</div>';
						
					
						}
					}
				?>
				<?php
				if(isset($_SESSION['refreshok'])){
					unset($_SESSION['refreshok']);
					unset($_SESSION['id']);
					unset($_SESSION['category']);
					unset($_POST['id']);
					unset($_POST['category']);
					echo "<script>window.location.href = 'index.php';</script>";
				}
				?>
		
		  </div>	
			
		  <div style="width: 99%;">
            <div class="d-block d-md-flex listing">
              <div class="lh-content">
                <div class="col-md-7 text-left border-primary">
					<h5 class="font-weight-light text-primary">Czym różni się "Odśwież z ogłoszenia" od "Odśwież z konta"?</h5>
				</div>
				<br>
				<p>
					Odśwież z ogłoszenia dotyczy ogłoszeń promowanych jak i niepromowanych.<br>
					Ogłoszenia niepromowane można odświeżać raz na dwa tygodnie.<br>
					Ogłoszenia promowane mają własne pakiety odświeżeń i można je wykorzystać dowolnie.<br>
					Jeden pakiet jest przydzielany do jednego ogłoszenia.<br>
					<br>
					Odśwież z konta - są to pakiety, które umożliwiają odświeżanie ogłoszeń promowanych i niepromowanych.<br>
					Pakiet ten jest przydzielany do konta i za jego pomocą można odświeżać swoje ogłoszenia dowolnie według uznania.<br>
					<br>Nie chcesz promować ogłoszenia, ale chcesz żeby było ono na górze listy?<br> Ta opcja jest dla Ciebie! Wykup pakiet i odświeżaj kiedy zechcesz!<br>
					Pakiet można wykupić w preferencjach swojego konta.
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