<?php
include_once("../footer.php");
@session_start();

if(isset($_GET['id'])){
	if(is_numeric($_GET['id'])){
		$ID = $_GET['id'];
		//echo "ID ogłoszenia przeszło: ".$_GET['id'];
	}else{
		$ID = '';
		//header("Location ../index.php");
	}
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Praca za granicą - Ogłoszenia BezGrosika.pl</title>
	<meta name="keywords" content="ogłoszenia, BezGrosika, .pl, sprzedam, kupie, za, granicą, brukarz, tynkarz, mechanik samochodowy, hydraulik, spawacz, zbiory, praca"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,=1"/>
	<link rel="shortcut icon" href="../img/grosiky.png">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/rangeslider.css">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/filters.css">
    
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
          
          <img src="../images/grosiky.png" style="height: 50px;"/><div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="../index.php" class="text-black mb-0">Bez<span class="text-primary">Grosika</span>.pl</a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="../index.php">Strona główna</a></li>
                <li><a href="../reklama.php">Reklama</a></li>
                <li><a href="../kontakt.php">Kontakt</a></li>

                <li class="ml-xl-3 login">
					<?php
						if(isset($_SESSION['user'])){
							echo '<a href="../mojekonto.php"><span class="border-left pl-xl-4"></span>'.$_SESSION['user'].'<b><span class="icon-arrow_drop_down"></span></b></a>';
						}else{
							echo '<a href="../login.php"><span class="border-left pl-xl-4"></span>Login</a>';
						}
					?>
				</li>
                <li>
					<?php
						if(isset($_SESSION['logged'])){
							echo '<a href="../logout.php">Wyloguj się';
						}else{
							echo '<a href="../register.php">Rejestracja</a>';
						}
					?>
				</li>

                <li><a href="../dodaj-ogloszenie.php" class="cta"><span class="bg-primary text-white rounded">+ Ogłoszenie</span></a></li>
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>

        </div>
      
    </header>


<?php
	$_SESSION['info_ogl'] = 'praca';
	$_SESSION['info_ogl2'] = 'zagranica';
	require_once("../php/connect.php");
	$db_name = $administratorbazy."praca";
	$zapytanie = 'SELECT * FROM praca_zagranica WHERE ID="'.$ID.'"';
	
	// zapytania może w pliku albo każdy ma przypisane zapytanie do siebie pod $_SESSION i zmienia je podczas zmiany na górze parametrów
	// w wyszukiwarce

	for($i = 1; $i<=8; $i++){
		unset($_SESSION['Photo'.$i]);
	}

	mysqli_report(MYSQLI_REPORT_STRICT);
	try{
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		if($connect->connect_errno!=0){
			throw new Exception(mysqli_connect_errno());
		}//else{
			//$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		//}
				
		if (!$connect->set_charset("utf8")) {
			printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
			exit();
			
		}else{
			if(is_numeric($ID)){
				if($result = @$connect->query(sprintf($zapytanie))){
					$wyniki = $result->num_rows;
					if($wyniki>0){
						//echo "</br>Oddane wyniki: ".$wyniki;
						$w = $result->fetch_assoc();
						
						if($w['ID'] != ''){
							for($i = 1; $i<=1; $i++){
								if($w['Photo'.$i] != ''){
									$_SESSION['Photo'.$i] = $w['Photo'.$i];
								}
							}
							echo '
							<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(\'../images/hero_1.jpg\');" data-aos="fade" data-stellar-background-ratio="0.5">
							  <div class="container">
								<div class="row align-items-center justify-content-center text-center">

								  <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
									
									
									<div class="row justify-content-center mt-5">
									  <div class="col-md-8 text-center">
										<h1>Pozostałe</h1>
										<p class="mb-0">'.$w['Tytul'].'</p>
									  </div>
									</div>

									
								  </div>
								</div>
							  </div>
							</div>  

							<div class="site-section">
							  <div class="container">
								<div class="row">
								  <div class="col-lg-8">
									
									<div class="mb-4">
									  <div class="slide-one-item home-slider owl-carousel">';
										$num = 1; // Maksymalna ilość zdjęć w danej kategorii
										$stop = false;
										$number = 1;
										for($p = 1; $p<=$num; $p++){
											if(isset($_SESSION['Photo'.$p])){
												$file = '../galeria/aktywne/'.$_SESSION['Photo'.$p];
												if(@file_exists($file)){
													$exists = true;
													if($stop == false){
														echo '<div><img src="../galeria/aktywne/'.$_SESSION['Photo'.$p].'" alt="Image" class="img-fluid"></div>';
														$number = $number + 1; 
														$stop = true;
													}else{
														echo '<div><img src="../galeria/aktywne/'.$_SESSION['Photo'.$p].'" alt="Image" class="img-fluid"></div>';
														$number = $number + 1; 
														$stop = true;
													}
												}
											}
										}
										if(@$exists != true){
											echo '<div><img src="../img/camera.png" alt="Image" class="img-fluid"></div>';
										}
										echo '
									  </div>
										<center>
											<div class="ogl-icons-div">
												<form method="post" target = "_blank" action="../promotion.php">
													<input type="hidden" name="category" value="praca_zagranica">
													<input type="hidden" name="id" value="'.$ID.'">
													<label style="cursor: pointer;"><span class="icon-magic" id="ogl-icons-promotion"> Wyróżnij ogłoszenie</span><input type="submit" name="promotion" style="display: none;"</label>
												</form>
											</div>
											
											<div class="ogl-icons-div">
												<form method="post" target = "_blank" action="../refresh.php">
													<input type="hidden" name="category" value="praca_zagranica">
													<input type="hidden" name="id" value="'.$ID.'">
													<label style="cursor: pointer;"><span class="icon-refresh" id="ogl-icons-refresh"> Odśwież</span><input type="submit" name="refresh" style="display: none;"</label>
												</form>
											</div>
											
											<div class="ogl-icons-div">
												<form method="post" target = "_blank" action="../zglosnaduzycie.php">
													<input type="hidden" name="category" value="praca_zagranica">
													<input type="hidden" name="id" value="'.$ID.'">
													<label style="cursor: pointer;"><span class="icon-block" id="ogl-icons-zglos"> Zgłoś nadużycie</span><input type="submit" name="zgloszenie" style="display: none;"></label>
												</form>
											</div>
										</center>
									</div>';
									
									echo '<hr>';
									//Katerogia marka itd lewa strona
									echo '<div>';
									echo '<div><b>Kategoria</b></div> <div>Praca <span style="font-size: 10px;">●</span> Za granicą</div><br>';
									echo '</div>';
									
									echo '<hr>';
								
									echo '<br>';
									echo '<span style="font-size: 18px;"><b>Opis ogłoszenia</b></span><br><br>';
									echo $w['Opis'].'<br><br><hr><br>';
									
									
									echo '
									</div>
								  
								  <div class="col-lg-3 ml-auto">

									<div class="mb-5">';
									   $Cena = number_format($w['Cena'],0," "," ");
									   echo '
									  <h2>'.$Cena.' PLN';
									  if($w['Negocjacja'] == 'on'){
										echo '<div style="font-size: 12px;">do negocjacji</div>';
									  }
									   echo '</div></h2><hr>';
									

										
										// Telefon
										if($w['Ktelefon'] != ''){
											$str=$w['Ktelefon'];
											$strlen=mb_strlen($str,'UTF-8');
											$newStr='';
											$x=0;
											while ($x!==$strlen){
												$newStr.=($x%3===0?' ':'').$str[$x++];
											}
											echo '<b>Telefon kontaktowy</b><br><span class="icon-phone"> </span>'.$newStr.'<br>';
										}
										if($w['Kemail'] != ''){
											echo '<br><b>Adres email</b><br><span class="icon-mail_outline"> </span>'.$w['Kemail'].'<br>';
										}
										
										echo '<br><b>Lokalizacja</b><br>
										<span class="icon-location-arrow"> </span>';
										echo $w['Wojewodztwo'];
										if($w['Miejscowosc'] != ''){
											echo ', '.$w['Miejscowosc'];
										}
										echo '
										<br><br>
										<span class="icon-user"> </span>'.$w['user'].'<br>
										<a href="../ogloszenia-uzytkownika.php?user='.$w['user'].'">Ogłoszenia użytkownika</a>
									 
									 
									</div>
									
								  </div>
								</div>
							  </div>
							</div>';
							
							$result->free_result();
						}else{
							header("Location: ../index.php");
						}
						$connect->close();
						//echo '<span style="color:red;"></br>Zamknięto połączenie';
					}else{
						throw new Exception($connect->error);
					}
				}else{
					$connect->close();
					header("Location: ../index.php");
				}
			}
		}
	}
	catch(Exception $error){
		echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
		// echo '</br>Informacja developerska:</br>'.$error;
	}
	?>
	
    <?php
	include_once("../footer.php");
	footer();
	?>
  </div>

  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/jquery.countdown.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/bootstrap-datepicker.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/rangeslider.min.js"></script>

  <script src="../js/main.js"></script>
    
  </body>
</html>