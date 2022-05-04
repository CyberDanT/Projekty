<?php
require_once("php/connect.php");
session_start();
if(!isset($_SESSION['logged'])){
	header('Location: login.php');
	exit();
}

$wzor = strrpos($_GET['C'], "=");
if($wzor !== false) {
	$_SESSION['globalerrorfrom'] = '(Error 1) Wystąpił błąd, spróbuj ponownie.';
	header('Location: index.php');
	exit();
}
$wzor = strrpos($_GET['C2'], "=");
if($wzor !== false) {
	$_SESSION['globalerrorfrom'] = '(Error 2) Wystąpił błąd, spróbuj ponownie.';
	header('Location: index.php');
	exit();
}
$wzor = strrpos($_GET['ID'], "=");
if($wzor !== false) {
	$_SESSION['globalerrorfrom'] = '(Error 3) Wystąpił błąd, spróbuj ponownie.';
	header('Location: index.php');
	exit();
}

if($_GET['C'] == ''){
	$_SESSION['globalerrorfrom'] = '(Error 4) Wystąpił błąd, spróbuj ponownie.';
	header('Location: index.php');
	exit();
}
if($_GET['C2'] == ''){
	$_SESSION['globalerrorfrom'] = '(Error 5) Wystąpił błąd, spróbuj ponownie.';
	header('Location: index.php');
	exit();
}
if($_GET['ID'] == ''){
	$_SESSION['globalerrorfrom'] = '(Error 6) Wystąpił błąd, spróbuj ponownie.';
	header('Location: index.php');
	exit();
}
if(!is_numeric($_GET['ID'])){
	$_SESSION['globalerrorfrom'] = '(Error 7) Wystąpił błąd, spróbuj ponownie.';
	header('Location: index.php');
	exit();
}

if(!($_GET['C'] == 'Motoryzacja' || $_GET['C'] == 'Elektronika' || $_GET['C'] == 'Nieruchomości' || $_GET['C'] == 'Dom i ogród' || $_GET['C'] == 'Praca' || $_GET['C'] == 'Odzież'
	|| $_GET['C'] == 'Zwierzęta' || $_GET['C'] == 'Oddam za darmo' || $_GET['C'] == 'Pozostałe')){
		$_SESSION['globalerrorfrom'] = '(Error 8) Wystąpił błąd, spróbuj ponownie.';
		header('Location: index.php');
		exit();
	}else{
		// MOTORYZACJA
		if($_GET['C'] == 'Motoryzacja'){
			$db_name = 'motoryzacja';
			if($_GET['C2'] == 'audio' || $_GET['C2'] == 'felgi_opony' || $_GET['C2'] == 'motocykle_skutery' || $_GET['C2'] == 'pojazdy_rolnicze' || $_GET['C2'] == 'pozostale'
				|| $_GET['C2'] == 'samochody_ciezarowe' || $_GET['C2'] == 'samochody_dostawcze' || $_GET['C2'] == 'samochody_osobowe'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 9) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// ELEKTRONIKA
		if($_GET['C'] == 'Elektronika'){
			$db_name = 'elektronika';
			if($_GET['C2'] == 'elektronika_akcesoria' || $_GET['C2'] == 'elektronika_komputery' || $_GET['C2'] == 'elektronika_konsole' || $_GET['C2'] == 'elektronika_pozostale' 
				|| $_GET['C2'] == 'elektronika_tablety' || $_GET['C2'] == 'elektronika_telefony' || $_GET['C2'] == 'elektronika_telewizory'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 10) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// NIERUCHOMOŚCI
		if($_GET['C'] == 'Nieruchomości'){
			$db_name = 'nieruchomosci';
			if($_GET['C2'] == 'nieruchomosci_domy' || $_GET['C2'] == 'nieruchomosci_dzialki' || $_GET['C2'] == 'nieruchomosci_garaze' 
				|| $_GET['C2'] == 'nieruchomosci_mieszkania' || $_GET['C2'] == 'nieruchomosci_pozostale'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 11) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// DOM  I  OGRÓD
		if($_GET['C'] == 'Dom i ogród'){
			$db_name = 'domiogrod';
			if($_GET['C2'] == 'domogrod_meble' || $_GET['C2'] == 'domogrod_ogrod' || $_GET['C2'] == 'domogrod_oswietlenie' 
				|| $_GET['C2'] == 'domogrod_pozostale' || $_GET['C2'] == 'domogrod_rtvagd'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 12) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// PRACA
		if($_GET['C'] == 'Praca'){
			$db_name = 'praca';
			if($_GET['C2'] == 'praca_dorywcza' || $_GET['C2'] == 'praca_wkraju' || $_GET['C2'] == 'praca_zagranica' 
				|| $_GET['C2'] == 'praca_uslugi' || $_GET['C2'] == 'praca_pozostale'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 13) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// ODZIEŻ
		if($_GET['C'] == 'Odzież'){
			$db_name = 'odziez';
			if($_GET['C2'] == 'odziez_buty' || $_GET['C2'] == 'odziez_dodatki' || $_GET['C2'] == 'odziez_pozostale' 
				|| $_GET['C2'] == 'odziez_ubrania' || $_GET['C2'] == 'odziez_zegarki'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 14) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// ZWIERZĘTA
		if($_GET['C'] == 'Zwierzęta'){
			$db_name = 'zwierzeta';
			if($_GET['C2'] == 'zwierzeta_dlazwierzat' || $_GET['C2'] == 'zwierzeta_koty' || $_GET['C2'] == 'zwierzeta_pozostale' 
				|| $_GET['C2'] == 'zwierzeta_psy' || $_GET['C2'] == 'zwierzeta_schroniska'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 15) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// ODDAM ZA DARMO
		if($_GET['C'] == 'Oddam za darmo'){
			$db_name = 'oddamzadarmo';
			if($_GET['C2'] == 'oddamzadarmo'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 16) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
		// POZOSTAŁE
		if($_GET['C'] == 'Pozostałe'){
			$db_name = 'pozostale';
			if($_GET['C2'] == 'pozostale_pozostale'){
				$base = $_GET['C2'];
			}else{
				$_SESSION['globalerrorfrom'] = '(Error 17) Wystąpił błąd, spróbuj ponownie.';
				header('Location: index.php');
				exit();
			}
		}
	}	
	$zapytanie = 'SELECT * FROM '.$base.' WHERE ID='.$_GET['ID'].'';
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Potwierdzenie usunięcia ogłoszenia - BezGrosika.pl</title>
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
                <h1>Usuwanie ogłoszenia</h1>
                <p class="mb-0">Potwierdź usunięcie</p>
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
            <h2 class="font-weight-light text-primary">Potwierdź usunięcie</h2>
          </div>
        </div>
        <div class="row mt-5">
		
				<?php
					try{
						$db_name = $administratorbazy.$db_name;
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
							if($result = $connect->query($zapytanie)){
								$wyniki = $result->num_rows;
								if($wyniki>0){
									for($r = 1; $r <= $wyniki; $r++){
										$w = $result->fetch_assoc();
										
								
										if($w['user'] == $_SESSION['user'] || $_SESSION['user'] == $admin){
											$date = date('Y-m-d H:i:s');
											//echo $date;
	
											if($_GET['C'] == 'Motoryzacja'){
												if($base == 'motocykle_skutery' || $base == 'felgi_opony' || $base == 'audio'
												|| $base == 'pozostale'){
													$num = 3;
												}else{
													$num = 8;
												}
											}
											if($_GET['C'] == 'Elektronika'){
												$num = 3;
											}
											if($_GET['C'] == 'Nieruchomości'){
												$num = 8;
											}
											if($_GET['C'] == 'Dom i ogrod'){
												$num = 3;
											}
											if($_GET['C'] == 'Praca'){
												$num = 1;
											}
											if($_GET['C'] == 'Odzież'){
												$num = 3;
											}
											if($_GET['C'] == 'Zwierzęta'){
												$num = 3;
											}
											if($_GET['C'] == 'Oddam za darmo'){
												$num = 1;
											}
											if($_GET['C'] == 'Pozostałe'){
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
																	<span class="category" style="background-color: #f89d13;">'.$_GET['C'].'</span>
																	<a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a>';
															}else{
																echo '
																<a href="#" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>
																<div class="lh-content">
																	<span class="category">'.$_GET['C'].'</span>';
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
														<span class="category" style="background-color: #f89d13;">'.$_GET['C'].'</span>
														<a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a>';
												}else{
													echo '
													<a href="#" class="img d-block" style="background-image: url(\'galeria/aktywne/'.$w['Photo'.$i].'\')"></a>
													<div class="lh-content">
														<span class="category">'.$_GET['C'].'</span>';
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
											
											
											
										}else{
											$_SESSION['globalerrorfrom'] = '(Error 18) Wystąpił błąd, spróbuj ponownie.';
											header("Location: index.php");
											exit();
										}
										
										echo '<span style="font-size: 17px;">Czy jesteś pewny, że chcesz usunąć to ogłoszenie?<br>';
										echo 'Usunięcie ogłoszenia jest nieodwracalne!<span>';
										echo '<form method="post">';
											echo '<input type="submit" class="filters-input-btn" name="submitremoveit" value="Usuń to ogłoszenie">';
										echo '</form>';
										
										if(isset($_POST['submitremoveit'])){
											if($w['user'] == $_SESSION['user'] || $_SESSION['user'] == $admin){
												if($w['ID'] == $_GET['ID']){
													if($result = $connect->query($zapytanie)){
														$wyniki = $result->num_rows;
														if($wyniki>0){
															for($r = 1; $r <= $wyniki; $r++){
																$w = $result->fetch_assoc();
																for($p=1; $p<=8; $p++){
																	if(isset($w['Photo'.$p])){
																		$file = '../galeria/aktywne/'.$w['Photo'.$p];
																		if(@file_exists($file)){
																			@unlink($file);
																		}
																	}
																}
																@$connect->query('DELETE FROM '.$base.' WHERE ID='.$w['ID'].'');
																$_SESSION['globalerrorfrom'] = 'Usunięto ogłoszenie!';
																echo "<script>window.location.href = 'index.php';</script>";
															}
														}else{
															$_SESSION['globalerrorfrom'] = '(Error 19) Wystąpił błąd, spróbuj ponownie.';
															echo "<script>window.location.href = 'index.php';</script>";
															exit();
														}
														$result->free_result();
														$connect->close();
														//echo 'zamknięto';
													}else{
														throw new Exception($connect->error);
													}
												}else{
													$_SESSION['globalerrorfrom'] = '(Error 20) Wystąpił błąd, spróbuj ponownie.';
													echo "<script>window.location.href = 'index.php';</script>";
													exit();
												}
											}else{
												$_SESSION['globalerrorfrom'] = '(Error 21) Wystąpił błąd, spróbuj ponownie.';
												echo "<script>window.location.href = 'index.php';</script>";
												exit();
											}
										}
									}
								}else{
									$_SESSION['globalerrorfrom'] = 'Błąd: Ogłoszenie nie istnieje.';
									echo "<script>window.location.href = 'index.php';</script>";
									exit();
								}
								$connect->close();
								//echo '</br>Zamknięto połączenie';
							}else{
								throw new Exception($connect->error);
							}
						}
					}
					catch(Exception $error){
						//header('Refresh: 0');
						echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować ponownie.</div>';
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