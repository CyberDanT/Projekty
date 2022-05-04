<?php
session_start();
if(!isset($_SESSION['logged'])){
	header('Location: login.php');
	exit();
}else{
	if(isset($_POST['submit'])){
	}else{
		if(!isset($_POST['zgloszenie'])){
			header('Location: index.php');
			exit();
		}else{
			if(!is_numeric($_POST['id'])){
				unset($_POST['id']);
				header('Location: index.php');
				exit();
			}
			if(!($_POST['category'] == 'samochody_osobowe' || $_POST['category'] == 'samochody_ciezarowe' || $_POST['category'] == 'samochody_dostawcze' 
				|| $_POST['category'] == 'motocykle_skutery' || $_POST['category'] == 'pojazdy_rolnicze' || $_POST['category'] == 'motoryzacja_pozostale' 
				//elektronika
				|| $_POST['category'] == 'elektronika_akcesoria' || $_POST['category'] == 'elektronika_komputery' || $_POST['category'] == 'elektronika_konsole' || $_POST['category'] == 'elektronika_pozostale' 
				|| $_POST['category'] == 'elektronika_tablety' || $_POST['category'] == 'elektronika_telefony' || $_POST['category'] == 'elektronika_telewizory'
				//nieruchomości
				|| $_POST['category'] == 'nieruchomosci_domy' || $_POST['category'] == 'nieruchomosci_dzialki' || $_POST['category'] == 'nieruchomosci_garaze' 
				|| $_POST['category'] == 'nieruchomosci_mieszkania' || $_POST['category'] == 'nieruchomosci_pozostale'
				//dom i ogród
				|| $_POST['category'] == 'domogrod_meble' || $_POST['category'] == 'domogrod_ogrod' || $_POST['category'] == 'domogrod_oswietlenie' 
				|| $_POST['category'] == 'domogrod_pozostale' || $_POST['category'] == 'domogrod_rtvagd'
				//praca
				|| $_POST['category'] == 'praca_dorywcza' || $_POST['category'] == 'praca_pozostale' || $_POST['category'] == 'praca_uslugi' 
				|| $_POST['category'] == 'praca_wkraju' || $_POST['category'] == 'praca_zagranica'
				//odzież
				|| $_POST['category'] == 'odziez_buty' || $_POST['category'] == 'odziez_dodatki' || $_POST['category'] == 'odziez_pozostale' 
				|| $_POST['category'] == 'odziez_ubrania' || $_POST['category'] == 'odziez_zegarki'
				//zwierzęta
				|| $_POST['category'] == 'zwierzeta_dlazwierzat' || $_POST['category'] == 'zwierzeta_koty' || $_POST['category'] == 'zwierzeta_pozostale' 
				|| $_POST['category'] == 'zwierzeta_psy' || $_POST['category'] == 'zwierzeta_schroniska'
				//oddam za darmo
				|| $_POST['category'] == 'oddamzadarmo'
				//pozostale
				|| $_POST['category'] == 'pozostale_pozostale')){
				unset($_POST['category']);
				echo $_POST['category'];
				header('Location: index.php');
				exit();
			}
			
			if($_POST['category'] == 'samochody_osobowe' || $_POST['category'] == 'samochody_ciezarowe' || $_POST['category'] == 'samochody_dostawcze' 
				|| $_POST['category'] == 'motocykle_skutery' || $_POST['category'] == 'pojazdy_rolnicze' || $_POST['category'] == 'motoryzacja_pozostale'){
				$kategoria = "Motoryzacja";
			}
			if($_POST['category'] == 'elektronika_akcesoria' || $_POST['category'] == 'elektronika_komputery' || $_POST['category'] == 'elektronika_konsole' || $_POST['category'] == 'elektronika_pozostale' 
				|| $_POST['category'] == 'elektronika_tablety' || $_POST['category'] == 'elektronika_telefony' || $_POST['category'] == 'elektronika_telewizory'){
				$kategoria = "Elektronika";
			}
			if($_POST['category'] == 'nieruchomosci_domy' || $_POST['category'] == 'nieruchomosci_dzialki' || $_POST['category'] == 'nieruchomosci_garaze' 
				|| $_POST['category'] == 'nieruchomosci_mieszkania' || $_POST['category'] == 'nieruchomosci_pozostale'){
				$kategoria = "Nieruchomości";
			}
			if($_POST['category'] == 'domogrod_meble' || $_POST['category'] == 'domogrod_ogrod' || $_POST['category'] == 'domogrod_oswietlenie' 
				|| $_POST['category'] == 'domogrod_pozostale' || $_POST['category'] == 'domogrod_rtvagd'){
				$kategoria = "Dom i ogród";
			}
			if($_POST['category'] == 'praca_dorywcza' || $_POST['category'] == 'praca_pozostale' || $_POST['category'] == 'praca_uslugi' 
				|| $_POST['category'] == 'praca_wkraju' || $_POST['category'] == 'praca_zagranica'){
				$kategoria = "Praca";
			}
			if($_POST['category'] == 'odziez_buty' || $_POST['category'] == 'odziez_dodatki' || $_POST['category'] == 'odziez_pozostale' 
				|| $_POST['category'] == 'odziez_ubrania' || $_POST['category'] == 'odziez_zegarki'){
				$kategoria = "Odzież";
			}
			if($_POST['category'] == 'oddamzadarmo'){
				$kategoria = "Oddam za darmo";
			}
			if($_POST['category'] == 'pozostale_pozostale'){
				$kategoria = "Pozostałe";
			}
		
		}
	}
}
if(isset($_POST['id'])){
	$_SESSION['id'] = $_POST['id'];
}
if(isset($_POST['category'])){
	$_SESSION['category'] = $_POST['category'];
}

?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Zgłoś naruszenie na BezGrosika.pl</title>
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
                <h1>Zgłoś nadużycie</h1>
                <p class="mb-0">Zgłoś niepoprawność ogłoszenia</p>
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
            <h2 class="font-weight-light text-primary">Zgłoś ogłoszenie</h2>
          </div>
        </div>
        <div class="row mt-5">
		
		  <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <div class="lh-content">
                <h5 class="font-weight-light text-primary">Wiadomość</h5>
				<form method="post">
					<textarea style="resize: none; width: 100%; max-width: 500px; height: 200px;" class="filters-input-select" placeholder="Ewentualny krótki opis naruszenia (Max. 200 znaków)" name="Opis" maxlength="200"></textarea>
					<div>
						<center>
							<input type="submit" style="margin-top: 50px;" class="filters-input-btn" name="submit" value="Zgłoś!"></input></br>
							<?php
							if(isset($_SESSION['eogl_opis'])){
								echo '<span style="color: red; font-size: 15px;">'.$_SESSION['eogl_opis'].'</span>';
								unset($_SESSION['eogl_opis']);
							}
							?>
						</center>
					</div>
				</form>			
              </div>
            </div>
		  </div>

          <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <div class="lh-content">
                <h5 class="font-weight-light text-primary">Dziękujemy za zgłoszenie</h5><br>
				<p><b>Kategoria ogłoszenia:</b> <?php echo $_SESSION['category']; ?></p>
				<p><b>ID ogłoszenia:</b> <?php echo $_SESSION['id']; ?></p><br><br>
				<p><b>Zgłaszający:</b> <?php echo $_SESSION['user']; ?></p><br>
              </div>
            </div>
		  </div>
		</div>
		 
      </div>
    </div>
	
	<?php 
				if(isset($_POST['submit'])){
					if(isset($_SESSION['id'])){
						if(isset($_POST['Opis']) && $_POST['Opis'] != ''){
							$opis = addslashes($_POST['Opis']);
							$opis = strip_tags($opis);
							if((strlen($opis) > 200)){
								$ok = false;
								$_SESSION['eogl_opis'] = "Opis nie może mieć więcej niż 200 znaków";
							}
							$opis = strrpos($opis, "=");
							if($opis !== false) {
								$ok = false;
								$_SESSION['eogl_opis'] = "Opis zawiera niedozwolone znaki!";
							}
						}

						if(!isset($ok)){
							$date = date("Y/m/d");
							$time = date("H:i:s");
							
							//$plik = fopen('zgloszenia/zgloszenia.txt','a');
							//fwrite($plik, "-----------------------------------------------------\n");
							//$zawartosc = $date.' '.$time;
							//fwrite($plik, $zawartosc."\n");
							//$zawartosc = 'Dodał użytkownik: '.$_SESSION['user'];
							//fwrite($plik, $zawartosc."\n");
							//if(isset($opis)){
							//	$zawartosc = 'Opis od użytkownika: '.$_POST['Opis'];
							//	fwrite($plik, $zawartosc."\n");
							//}
							//$zawartosc = 'Kategoria ogłoszenia: '.$_SESSION['category'];
							//fwrite($plik, $zawartosc."\n");
							//$zawartosc = 'ID ogłoszenia: '.$_SESSION['id'];
							//fwrite($plik, $zawartosc."\n");
							//fclose($plik);

							$full_name='BezGrosika.pl';
							$from = $full_name.'<admin@bezgrosika.pl>';
							$to = 'daniel39@onet.pl';

							$subject = 'Przyjeliśmy Twoje zgłoszenie!';
							$message = '<span style="color: red; text-shadow: 1px 1px black; font-size: 30px;"><i>BezGrosika</span></br><span style="font-size: 15px;">Ogłoszenia dla Ciebie</i></span>
							</br></br>Dziękujemy za Twoje zgłoszenie!
							</br></br>Zajmiemy się Twoim zgłoszeniem jak najszybciej będzie to możliwe.
							</br>Data przesłania zgłoszenia: '.$date.' '.$time.'
							</br>Zgłoszenie wysłano z konta: '.$_SESSION['user'];
								if(isset($opis)){
									$message = $message.'</br>Treść zgłoszenia: '.$_POST['Opis'];
								}
							$message = $message.'
							</br>
							<hr>
							Wiadomość została wygenerowana automatycznie, prosimy na nią nie odpowiadać.</br>
							Pozdrawiamy, serwis ogłoszeniowy BezGrosika.pl
							';

							$headers = "From: " . $from . "\r\n";
							$headers .= "Reply-To: ". $from . "\r\n";
							$headers .= "MIME-Version: 1.0\r\n";
							$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

							if(mail($to, $subject, $message, $headers, "-f ".$from)){
								echo 'Wiadomość została wysłana';
							}
						   
						   
							$subject = 'Zgłoszenie od '.$_SESSION['user'].' (MAIL: '.$_SESSION['useremail'].')';
							$full_name='Zgłoszenie';
							$from = $full_name.'<admin@bezgrosika.pl>';
							$to = 'admin@bezgrosika.pl';
							$message = $message.'<hr></br>Kategoria: '.$_SESSION['category'].'</br>ID ogłoszenia: '.$_SESSION['id'];
							if(mail($to, $subject, $message, $headers, "-f ".$from)){
								echo 'Wiadomość została wysłana';
							}

							unset($_SESSION['category']);
							unset($_SESSION['id']);
						   
							$_SESSION['globalerrorfrom'] = 'Dziękujemy za zgłoszenie, zostanie ono sprawdzone jak najszybciej będzie to możliwe.';
							sleep(1);
							header("Location: index.php");
						}
					}
				}
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