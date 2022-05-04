<?php
session_start();
require_once("php/connect.php");
if(!isset($_SESSION['logged'])){
	header('Location: mojekonto.php');
	exit();
}
if(!isset($_SESSION['addogl_title'])){
	header('Location: dodaj-ogloszenie.php');
	exit();
}
if(!($_SESSION['addogl_category'] == 'Motoryzacja' || $_SESSION['addogl_category'] == 'Elektronika' || $_SESSION['addogl_category'] == 'Nieruchomosci' || $_SESSION['addogl_category'] == 'Dom i ogrod' 
	|| $_SESSION['addogl_category'] == 'Praca' || $_SESSION['addogl_category'] == 'Odziez' || $_SESSION['addogl_category'] == 'Zwierzeta' || $_SESSION['addogl_category'] == 'Pozostale' 
	|| $_SESSION['addogl_category'] == 'Oddam za darmo')){
		header('Location: dodaj-ogloszenie.php');
		exit();
	}

if($_SESSION['accept'] != true){
	header('Location: dodaj-ogloszenie.php');
}

?>
 
<?php
if($_SESSION['addogl_category'] == 'Motoryzacja'){
	if($_SESSION['addogl_category2'] == 'Samochody osobowe' || $_SESSION['addogl_category2'] == 'Samochody dostawcze' || $_SESSION['addogl_category2'] == 'Samochody ciezarowe'){
		if($_SESSION['addogl_cena'] <= 5000){
			$_SESSION['platnosc'] = 20;
		}
		if($_SESSION['addogl_cena'] > 5000 && $_SESSION['addogl_cena'] <= 15000){
			$_SESSION['platnosc'] = 25;
		}
		if($_SESSION['addogl_cena'] > 15000 && $_SESSION['addogl_cena'] <= 30000){
			$_SESSION['platnosc'] = 30;
		}
		if($_SESSION['addogl_cena'] > 30000){
			$_SESSION['platnosc'] = 35;
		}
	}
	if($_SESSION['addogl_category2'] == 'Motocykle i skutery'){
		$_SESSION['platnosc'] = 10;
	}
	if($_SESSION['addogl_category2'] == 'Pojazdy rolnicze'){
		$_SESSION['platnosc'] = 25;
	}
	if($_SESSION['addogl_category2'] == 'Felgi i opony' || $_SESSION['addogl_category2'] == 'Sprzet audio' || $_SESSION['addogl_category2'] == 'Pozostale'){
		$_SESSION['platnosc'] = 1;
	}
}
if($_SESSION['addogl_category'] == 'Elektronika'){
	if($_SESSION['addogl_cena'] <= 500){
		$_SESSION['platnosc'] = 1;
	}
	if($_SESSION['addogl_cena'] > 500){
		$_SESSION['platnosc'] = 2;
	}
}
if($_SESSION['addogl_category'] == 'Nieruchomosci'){
	if($_SESSION['addogl_category2'] == 'Mieszkania' || $_SESSION['addogl_category2'] == 'Dzialki' || $_SESSION['addogl_category2'] == 'Domy'){
		$_SESSION['platnosc'] = 30;
	}
	if($_SESSION['addogl_category2'] == 'Garaze' || $_SESSION['addogl_category2'] == 'Pozostale'){
		$_SESSION['platnosc'] = 15;
	}
}
if($_SESSION['addogl_category'] == 'Dom i ogrod'){
	$_SESSION['platnosc'] = 1;
}
if($_SESSION['addogl_category'] == 'Praca'){
	if($_SESSION['addogl_category2'] == 'Dorywcza'){
		$_SESSION['platnosc'] = 5;
	}
	if($_SESSION['addogl_category2'] == 'Za granica'){
		$_SESSION['platnosc'] = 50;
	}
	if($_SESSION['addogl_category2'] == 'W kraju'){
		$_SESSION['platnosc'] = 30;
	}
	if($_SESSION['addogl_category2'] == 'Uslugi' || $_SESSION['addogl_category2'] == 'Pozostale'){
		$_SESSION['platnosc'] = 10;
	}
}
if($_SESSION['addogl_category'] == 'Odziez'){
	if($_SESSION['addogl_cena'] <= 500){
		$_SESSION['platnosc'] = 1;
	}
	if($_SESSION['addogl_cena'] > 500){
		$_SESSION['platnosc'] = 2;
	}
}
if($_SESSION['addogl_category'] == 'Zwierzeta'){
	$_SESSION['platnosc'] = 1;
}
if($_SESSION['addogl_category'] == 'Pozostale'){
	$_SESSION['platnosc'] = 1;
}
if($_SESSION['addogl_category'] == 'Oddam za darmo'){
	$_SESSION['platnosc'] = 0;
}

 // ---------------------------------- PROMOCJA (niżej druga część zapisu)
	$_SESSION['platnosc'] = 0;
// --------------------------

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Potwierdzenie dodania ogłoszenia na BezGrosika.pl</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,=1"/>
	<link rel="shortcut icon" href="img/grosiky.png">
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
      
    </header>


	<?php
	echo '
							<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(\'images/hero_1.jpg\');" data-aos="fade" data-stellar-background-ratio="0.5">
							  <div class="container">
								<div class="row align-items-center justify-content-center text-center">

								  <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
									
									
									<div class="row justify-content-center mt-5">
									  <div class="col-md-8 text-center">
										<h1>';
										if($_SESSION['addogl_category'] == 'Motoryzacja'){
											if($_SESSION['addogl_category2'] == 'Samochody osobowe'){
												echo $_SESSION['addogl_category3'].' '.$_SESSION['addogl_category4'];
											}else{
												if($_SESSION['addogl_category2'] == 'Samochody ciezarowe'){
													echo $_SESSION['addogl_category3'];
												}else{
													if($_SESSION['addogl_category2'] == 'Samochody dostawcze'){
														echo $_SESSION['addogl_category3'];
													}else{
														if($_SESSION['addogl_category2'] == 'Motocykle i skutery'){
															echo $_SESSION['addogl_category4'];
														}else{
															echo $_SESSION['addogl_category2'];
														}
													}
												}
											}
										}else{
											echo $_SESSION['addogl_category2'];
										}
										
										echo '
										</h1>
										<p class="mb-0">'.$_SESSION['addogl_title'].'</p>
									  </div>
									</div>

									
								  </div>
								</div>
							  </div>
							</div>';
							
							if($_SESSION['addogl_category'] == 'Motoryzacja'){
								if($_SESSION['addogl_category2'] == 'Motocykle i skutery'){
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
							
							echo '<div class="site-section">
							  <div class="container">
								<div class="row">
								  <div class="col-lg-8">
									
									<div class="mb-4">
									  <div class="slide-one-item home-slider owl-carousel">';
										for($i=1; $i<=$num; $i++){
											if(isset($_SESSION['Photo'.$i])){
												$file = 'galeria/tymczasowe/'.$_SESSION['Photo'.$i];
												if(@file_exists($file)){
													if(!isset($glowne)){
														$glowne = $_SESSION['Photo'.$i];
													}
													echo '<div><img src="'.$file.'" alt="Image" class="img-fluid"></div>';
												}
											}
											
										}
										if(!isset($glowne)){
											echo '<div><img src="img/camera.png" alt="Image" class="img-fluid"></div>';
										}
										
										echo '
									  </div>
										<center>
											<div class="ogl-icons-div">
												<label style="cursor: pointer;"><span class="icon-magic" id="ogl-icons-promotion"> Wyróżnij ogłoszenie</span></label>
											</div>
											
											<div class="ogl-icons-div">
												<label style="cursor: pointer;"><span class="icon-refresh" id="ogl-icons-refresh"> Odśwież</span></label>
											</div>
											
											<div class="ogl-icons-div">
												<label style="cursor: pointer;"><span class="icon-block" id="ogl-icons-zglos"> Zgłoś nadużycie</span></label>
											</div>
										</center>
									</div>';
									
									echo '<hr>';

						
							if($_SESSION['addogl_category'] == 'Motoryzacja'){
								if(isset($_SESSION['addogl_stanuzytkowy']) && $_SESSION['addogl_stanuzytkowy'] == "Uzywany"){
									$Stanuzytkowy = 'Używany';
								}else{
									$Stanuzytkowy = $_SESSION['addogl_stanuzytkowy'];
								}
								
								if($_SESSION['addogl_category2'] == 'Pojazdy rolnicze' || $_SESSION['addogl_category2'] == 'Motocykle i skutery' || $_SESSION['addogl_category2'] == 'Samochody osobowe'
									|| $_SESSION['addogl_category2'] == 'Samochody ciezarowe' || $_SESSION['addogl_category2'] == 'Samochody dostawcze'){
									if($_SESSION['addogl_category2'] == 'Pojazdy rolnicze'){
										echo '<div>';
										echo '<div><b>Kategoria</b></div> <div>'.$_SESSION['addogl_category'].' <span style="font-size: 10px;">●</span> '.$_SESSION['addogl_category2'].'</div><br>';
										echo '<div><b>Stan techniczny</b></div> <div>'.$_SESSION['addogl_stantechniczny'].'</div><br>';
										echo '<div><b>Stan użytkowy</b></div> <div>'.$Stanuzytkowy.'</div>';
										echo '</div>';
									}
									if($_SESSION['addogl_category2'] == 'Motocykle i skutery'){
										//Katerogia marka itd lewa strona
										echo '<div style="display: inline-block;">';
										echo '<div><b>Kategoria</b></div> <div>Motoryzacja <span style="font-size: 10px;">●</span> Motocykle i skutery</div><br>';
										echo '<div><b>Typ</b></div> <div>'.$_SESSION['addogl_category3'].'</div><br>';
										echo '<div><b>Marka</b></div> <div>'.$_SESSION['addogl_category4'].'</div><br>';
										echo '<div><b>Moc silnika</b></div> <div>'.$_SESSION['addogl_mocsilnika'].' KM</div><br>';
										$Pojemnosc = number_format($_SESSION['addogl_pojsilnika'],0," "," ");
										echo '<div><b>Poj. silnika</b></div> <div>'.$Pojemnosc.' cm³</div><br>';
										echo '</div>';
										// Druga
										echo '<div style="display: inline-block;">';
										echo '<div><b>Rok produkcji</b></div> <div>'.$_SESSION['addogl_rok'].'</div><br>';
										$Przebieg = number_format($_SESSION['addog_przebieg'],0," "," ");
										echo '<div><b>Przebieg</b></div> <div>'.$Przebieg.' km</div><br>';
										
										echo '<div><b>Stan techniczny</b></div> <div>'.$_SESSION['addogl_stantechniczny'].'</div><br>';
										echo '<div><b>Stan użytkowy</b></div> <div>'.$Stanuzytkowy.'</div>';
										echo '</div>';
									}
									if($_SESSION['addogl_category2'] == 'Samochody osobowe'){
										//Katerogia marka itd lewa strona
										echo '<div style="display: inline-block;">';
										echo '<div><b>Kategoria</b></div> <div>Motoryzacja <span style="font-size: 10px;">●</span> Samochody osobowe</div><br>';
										echo '<div><b>Marka</b></div> <div>'.$_SESSION['addogl_category3'].'</div><br>';
										echo '<div><b>Model</b></div> <div>'.$_SESSION['addogl_category4'].'</div><br>';
										echo '<div><b>Moc silnika</b></div> <div>'.$_SESSION['addogl_mocsilnika'].' KM</div><br>';
										$Pojemnosc = number_format($_SESSION['addogl_pojsilnika'],0," "," ");
										echo '<div><b>Poj. silnika</b></div> <div>'.$Pojemnosc.' cm³</div><br>';
										echo '<div><b>Rok produkcji</b></div> <div>'.$_SESSION['addogl_rok'].'</div><br>';
										$Przebieg = number_format($_SESSION['addogl_przebieg'],0," "," ");
										echo '<div><b>Przebieg</b></div> <div>'.$Przebieg.' km</div><br>';
										echo '</div>';
										// Druga
										echo '<div style="display: inline-block;">';
										echo '<div><b>Nadwozie</b></div> <div>'.$_SESSION['addogl_nadwozie'].'</div><br>';
										echo '<div><b>Paliwo</b></div> <div>'.$_SESSION['addogl_paliwo'].'</div><br>';
										echo '<div><b>Skrzynia biegów</b></div> <div>'.$_SESSION['addogl_skrzynia'].'</div><br>';
										echo '<div><b>Kolor</b></div> <div>'.$_SESSION['addogl_kolor'].'</div><br>';
										echo '<div><b>Stan techniczny</b></div> <div>'.$_SESSION['addogl_stantechniczny'].'</div><br>';
										echo '<div><b>Stan użytkowy</b></div> <div>'.$Stanuzytkowy.'</div>';
										echo '</div>';
										if($_SESSION['addogl_wyposazenie'] != ''){
											echo '<br><br>';
											echo '<hr>';
											echo '<br><span style="font-size: 18px;"><b>Wyposażenie</b></span><br><br>';
											//Co ma w wyposażeniu
											echo '<div>';
											$dane = $_SESSION['addogl_wyposazenie'];
											$dane1 = explode(", ", $dane);
												$loop = count($dane1);
												$loop = $loop - 1;
												$div1 = false;
												$div2 = false;
												for($l=0; $l<=$loop; $l++){
													if($dane1[$l] != ''){
														if($l <= $loop / 2){
															if($div1 == false){
																echo '<div style="display: inline-block;">';
																$div1 = true;
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}else{
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}
														}else{
															if($div2 == false){
																echo '</div>';
																echo '<div style="display: inline-block;">'; 
																$div2 = true;
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}else{
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}
														}
													}
												}
											echo '</div>';
											echo '</div>';
										}
									}
									if($_SESSION['addogl_category2'] == 'Samochody ciezarowe'){
										//Katerogia marka itd lewa strona
										echo '<div style="display: inline-block;">';
										echo '<div><b>Kategoria</b></div> <div>Motoryzacja <span style="font-size: 10px;">●</span> Samochody ciężarowe</div><br>';
										echo '<div><b>Marka</b></div> <div>'.$_SESSION['addogl_category3'].'</div><br>';
										echo '<div><b>Moc silnika</b></div> <div>'.$_SESSION['addogl_mocsilnika'].' KM</div><br>';
										$Pojemnosc = number_format($_SESSION['addogl_pojemnosc'],0," "," ");
										echo '<div><b>Poj. silnika</b></div> <div>'.$Pojemnosc.' cm³</div><br>';
										echo '<div><b>Rok produkcji</b></div> <div>'.$_SESSION['addogl_rok'].'</div><br>';
										$Przebieg = number_format($_SESSION['addogl_przebieg'],0," "," ");
										echo '<div><b>Przebieg</b></div> <div>'.$Przebieg.' km</div><br>';
										echo '</div>';
										// Druga
										echo '<div style="display: inline-block;">';
										echo '<div><b>Paliwo</b></div> <div>'.$_SESSION['addogl_paliwo'].'</div><br>';
										echo '<div><b>Skrzynia biegów</b></div> <div>'.$w['addogl_skrzynia'].'</div><br>';
										echo '<div><b>Kolor</b></div> <div>'.$_SESSION['addogl_kolor'].'</div><br>';
										echo '<div><b>Stan techniczny</b></div> <div>'.$_SESSION['addogl_stantechniczny'].'</div><br>';
										echo '<div><b>Stan użytkowy</b></div> <div>'.$Stanuzytkowy.'</div>';
										echo '</div>';
										if($_SESSION['addogl_wyposazenie'] != ''){
											echo '<br><br>';
											echo '<hr>';
											echo '<br><span style="font-size: 18px;"><b>Wyposażenie</b></span><br><br>';
											//Co ma w wyposażeniu
											echo '<div>';
											$dane = $_SESSION['addogl_wyposazenie'];
											$dane1 = explode(", ", $dane);
												$loop = count($dane1);
												$loop = $loop - 1;
												$div1 = false;
												$div2 = false;
												for($l=0; $l<=$loop; $l++){
													if($dane1[$l] != ''){
														if($l <= $loop / 2){
															if($div1 == false){
																echo '<div style="display: inline-block;">';
																$div1 = true;
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}else{
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}
														}else{
															if($div2 == false){
																echo '</div>';
																echo '<div style="display: inline-block;">'; 
																$div2 = true;
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}else{
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}
														}
													}
												}
											echo '</div>';
											echo '</div>';
										}
										
									}
									if($_SESSION['addogl_category2'] == 'Samochody dostawcze'){
										echo '<div style="display: inline-block;">';
										echo '<div><b>Kategoria</b></div> <div>Motoryzacja <span style="font-size: 10px;">●</span> Samochody ciężarowe</div><br>';
										echo '<div><b>Marka</b></div> <div>'.$_SESSION['addogl_category3'].'</div><br>';
										echo '<div><b>Moc silnika</b></div> <div>'.$_SESSION['addogl_mocsilnika'].' KM</div><br>';
										$Pojemnosc = number_format($_SESSION['addogl_pojsilnika'],0," "," ");
										echo '<div><b>Poj. silnika</b></div> <div>'.$Pojemnosc.' cm³</div><br>';
										echo '<div><b>Rok produkcji</b></div> <div>'.$_SESSION['addogl_rok'].'</div><br>';
										$Przebieg = number_format($_SESSION['addogl_przebieg'],0," "," ");
										echo '<div><b>Przebieg</b></div> <div>'.$Przebieg.' km</div><br>';
										echo '</div>';
										// Druga
										echo '<div style="display: inline-block;">';
										echo '<div><b>Paliwo</b></div> <div>'.$_SESSION['addogl_paliwo'].'</div><br>';
										echo '<div><b>Skrzynia biegów</b></div> <div>'.$_SESSION['addogl_skrzynia'].'</div><br>';
										echo '<div><b>Kolor</b></div> <div>'.$_SESSION['addogl_kolor'].'</div><br>';
										echo '<div><b>Stan techniczny</b></div> <div>'.$_SESSION['addogl_stantechniczny'].'</div><br>';
										echo '<div><b>Stan użytkowy</b></div> <div>'.$Stanuzytkowy.'</div>';
										echo '</div>';
										if($_SESSION['addogl_wyposazenie'] != ''){
											echo '<br><br>';
											echo '<hr>';
											echo '<br><span style="font-size: 18px;"><b>Wyposażenie</b></span><br><br>';
											//Co ma w wyposażeniu
											echo '<div>';
											$dane = $_SESSION['addogl_wyposazenie'];
											$dane1 = explode(", ", $dane);
												$loop = count($dane1);
												$loop = $loop - 1;
												$div1 = false;
												$div2 = false;
												for($l=0; $l<=$loop; $l++){
													if($dane1[$l] != ''){
														if($l <= $loop / 2){
															if($div1 == false){
																echo '<div style="display: inline-block;">';
																$div1 = true;
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}else{
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}
														}else{
															if($div2 == false){
																echo '</div>';
																echo '<div style="display: inline-block;">'; 
																$div2 = true;
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}else{
																echo '<div class="oglci4"><span class="icon-check" id="icon-check-style"> </span><span style="margin-left: 15px;">'.$dane1[$l].'</span></div>';
															}
														}
													}
												}
											echo '</div>';
											echo '</div>';
										}
									}
								}else{
									echo '<div>';
									echo '<div><b>Kategoria</b></div> <div>'.$_SESSION['addogl_category'].' <span style="font-size: 10px;">●</span> '.$_SESSION['addogl_category2'].'</div><br>';
									echo '</div>';
								}
							}else{
								echo '<div>';
								echo '<div><b>Kategoria</b></div> <div>'.$_SESSION['addogl_category'].' <span style="font-size: 10px;">●</span> '.$_SESSION['addogl_category2'].'</div><br>';
								echo '</div>';
							}
								
							echo '<br><br>';
							echo '<hr>';
							
							if($_SESSION['addogl_category2'])
							
							echo '<span style="font-size: 18px;"><b>Opis ogłoszenia</b></span><br><br>';
							$_SESSION['addogl_opis'] = nl2br($_SESSION['addogl_opis']);
							echo $_SESSION['addogl_opis'].'<br><br><hr><br>';

							
							echo '<br>
								  </div>';
								  
								  echo '<div class="col-lg-3 ml-auto">

									<div class="mb-5">';
									   $Cena = number_format($_SESSION['addogl_cena'],0," "," ");
									   echo '
									  <h2>'.$Cena.' PLN';
									  if($_SESSION['addogl_negocjacja'] == 'on'){
										echo '<div style="font-size: 12px;">do negocjacji</div>';
									  }
									   echo '</div></h2><hr>';
								
										
										// Telefon
										if($_SESSION['addogl_telefon'] != ''){
											$str=$_SESSION['addogl_telefon'];
											$strlen=mb_strlen($str,'UTF-8');
											$newStr='';
											$x=0;
											while ($x!==$strlen){
												$newStr.=($x%3===0?' ':'').$str[$x++];
											}
											echo '<b>Telefon kontaktowy</b><br><span class="icon-phone"> </span>'.$newStr.'<br>';
										}
										if($_SESSION['addogl_email'] != ''){
											echo '<br><b>Adres email</b><br><span class="icon-mail_outline"> </span>'.$_SESSION['addogl_email'].'<br>';
										}
										
										echo '<br><b>Lokalizacja</b><br>
										<span class="icon-location-arrow"> </span>';
										echo $_SESSION['addogl_woj'];
										if($_SESSION['addogl_miej'] != ''){
											echo ', '.$_SESSION['addogl_miej'];
										}
										echo '
										<br><br>
										<span class="icon-user"> </span>'.$_SESSION['user'].'<br>
										<a href="#">Ogłoszenia użytkownika</a>';
										
										echo '<hr><div style="margin-top: 50px;"><p>Po dodaniu ogłoszenia możesz je wypromować i zyskać większe zainteresowanie! Wystarczy odszukać ogłoszenie, wejść w nie i nacisnąć ,,Wyróżnij ogłoszenie``</p>
										<form method="post" action="platnosc.php">
											<center><input type="submit" name="platnosc" class="filters-input-btn" value="Dodaj ogłoszenie!"/></center>
										</form>
										<hr></div>';
										
										/*	try{
												$connect = new mysqli($host, $db_user, $db_password, $db_name);
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
																if($w['monety'] >= $_SESSION['platnosc']){
																	echo '<div style="border: 1px solid gray; border-radius: 15px; width: 20%; padding: 15px; margin: auto; margin-top: 10px; margin-bottom: 10px;">
																		<img src="img/grosiky.png" style="width: 50px; vertical-align: bottom; margin-right: 5px;"><span style="font-size: 25px;">Masz '.$w['monety'].' monet</br>Do zapłaty '.$_SESSION['platnosc'].' monet</span>
																		<div style="margin-top: 25px;">
																		<form method="post" action="platnosc.php">
																			<label><input type="submit" name="platnosc" style="display: none;"><span class="petext">Płacę!</span></label>
																		</form>
																		</div>
																	</div>';
																}else{
																	echo '<div style="border: 1px solid gray; border-radius: 15px; width: 20%; padding: 15px; margin: auto; margin-top: 10px; margin-bottom: 10px;">
																		<img src="img/grosiky.png" style="width: 50px; vertical-align: bottom; margin-right: 5px;"><span style="font-size: 25px;">Masz '.$w['monety'].' monet</br>Do zapłaty '.$_SESSION['platnosc'].' monet</span>
																		<div style="margin-top: 25px;">
																		<a href="mojekonto.php" target="_blank" style="font-size: 20px;">Nie masz tyle monet, doładuj je tutaj, a później odśwież tę stronę.</a>
																		</div>
																	</div>';
																}
															}
															$result->free_result();
														}else{
															throw new Exception($connect->error);
														}
														$connect->close();
													}
												}
											}
											catch(Exception $error){
												echo '<div class="servererror">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
												//echo '</br>Informacja developerska:</br>'.$error;
											}
										*/
									 
									echo '</div>';
								  
								  
								
							echo '</div>
							  </div>
							  </div>
							</div>';
							
								
					?>
	
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