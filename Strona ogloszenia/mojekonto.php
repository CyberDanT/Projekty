<!DOCTYPE html>
<?php
	session_start();
	require_once  "php/connect.php";
	if(!isset($_SESSION['logged'])){
		header('Location: login.php');
		exit();
	}
	try{
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		if($connect->connect_errno!=0){
			throw new Exception(mysqli_connect_errno());
		}else{
			if(!$connect->set_charset("utf8")){
				printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
				exit();
			}else{
				if($result = @$connect->query('SELECT refreshi,monety FROM accounts WHERE user="'.$_SESSION['user'].'"')){
					$wyniki = $result->num_rows;
					if($wyniki>0){
						$w = $result->fetch_assoc();
						$userrefresh = $w['refreshi'];
						$usermoneys = $w['monety'];
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
		echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
		//echo '</br>Informacja developerska:</br>'.$error;
	}
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
	<title>BezGrosika.pl - moje konto</title>
	<meta name="description" content="Preferencje Twojego konta. Ustawienia, zmiana hasła, promowanie ogłoszeń."/>
	<meta name="keywords" content="motoryzacja, samochody, osobowe, moje, konto"/>		
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
                <h1>Cześć, <?php echo $_SESSION['user']; ?></h1>
                <p class="mb-0">Preferencje Twojego konta</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  

	<div class="site-section bg-light">
      <div class="container">

		<?php
			if(isset($_POST['chpasswordsubmit'])){
				if(isset($_POST['spassword']) && $_POST['spassword'] != ''){
					if(!((strlen($_POST['npassword'])<5) || (strlen($_POST['npassword'])>20))){
						if($_POST['npassword'] == $_POST['rnpassword']){
							mysqli_report(MYSQLI_REPORT_STRICT);
							try{
								$connect = new mysqli($host, $db_user, $db_password, $db_name);
								if($connect->connect_errno!=0){
									throw new Exception(mysqli_connect_errno());
								}else{
									if(!$connect->set_charset("utf8")){
										printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
										exit();
									}else{
										if($result = @$connect->query('SELECT password FROM accounts WHERE user="'.$_SESSION['user'].'"')){
											$wyniki = $result->num_rows;
											if($wyniki>0){
												$w = $result->fetch_assoc();
												if(password_verify($_POST['spassword'], $w['password'])){
													$password = password_hash($_POST['rnpassword'], PASSWORD_DEFAULT);
													$zapytanie = 'UPDATE accounts SET password="'.$password.'" WHERE user="'.$_SESSION['user'].'"';
													if($connect->query($zapytanie)){
														$_SESSION['globalerrorfrom'] = '<div class="erroraddogl" style="color: green;">Hasło zostało zmienione prawidłowo!</div>';
														@header('Location: index.php');
														echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
														echo "<script>window.location.href = 'index.php';</script>";
														exit();
													}else{
														throw new Exception($connect->error);
													}
													$result->free_result();
												}else{
													$_SESSION['globalerrorfrom'] = '<div class="erroraddogl">Stare hasło jest nie prawidłowe!</div>';
													@header('Location: index.php');
													echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
													echo "<script>window.location.href = 'index.php';</script>";
													exit();
												}
											}else{
												echo '<div class="erroraddogl">Stare hasło jest nie prawidłowe!</div>';
												@header('Location: index.php');
												echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
												echo "<script>window.location.href = 'index.php';</script>";
												exit();
											}
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
						}else{
							$_SESSION['globalerrorfrom'] = '<div class="erroraddogl">Padane nowe hasła nie są identyczne!</div>';
							@header('Location: index.php');
							echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
							echo "<script>window.location.href = 'index.php';</script>";
							exit();
						}
					}else{
						$_SESSION['globalerrorfrom'] = '<div class="erroraddogl">Długość nowego hasła powinna mieć od 5 do 20 znaków!</div>';
						@header('Location: index.php');
						echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
						echo "<script>window.location.href = 'index.php';</script>";
						exit();
					}
				}
			}
			
			
			if(isset($_POST['chrefreshssubmit'])){
				if(isset($_POST['refreshsvalue']) && $_POST['refreshsvalue'] != ''){
					$cena = $_POST['refreshsvalue'];
					if((strlen($_POST['refreshsvalue']) == 0)){
						$ok = false;
						$_SESSION['globalerrorfrom'] = 'Odświeżenia: Podaj prawidłową liczbę do odświeżenia!</div>';
						@header('Location: index.php');
						echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
						echo "<script>window.location.href = 'index.php';</script>";
						exit();
					}
					if(!(preg_match('/^[0-9]+$/', $cena))){
						$ok = false;
						$_SESSION['globalerrorfrom'] = 'Odświeżenia: Podana liczba musi być całkowita, dodatnia!</div>';
						@header('Location: index.php');
						echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
						echo "<script>window.location.href = 'index.php';</script>";
						exit();
					}
					if((int)$cena <= 0){
						$ok = false;
						$_SESSION['globalerrorfrom'] = 'Odświeżenia: Podana liczba musi być większa od 0!</div>';
						@header('Location: index.php');
						echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
						echo "<script>window.location.href = 'index.php';</script>";
						exit();
					}
					if($usermoneys < $cena){
						$ok = false;
						$_SESSION['globalerrorfrom'] = 'Odświeżenia: Nie masz wystarczająco monet!';
						@header('Location: index.php');
						echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
						echo "<script>window.location.href = 'index.php';</script>";
						exit();
					}
					
					if(!isset($ok)){
						$monety = $cena;
						$refresh = $monety / 2;
						mysqli_report(MYSQLI_REPORT_STRICT);
						try{
							$connect = new mysqli($host, $db_user, $db_password, $db_name);
							if($connect->connect_errno!=0){
								throw new Exception(mysqli_connect_errno());
							}else{
								if(!$connect->set_charset("utf8")){
									printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
									exit();
								}else{
									if($result = @$connect->query('SELECT refreshi,monety FROM accounts WHERE user="'.$_SESSION['user'].'"')){
										$wyniki = $result->num_rows;
										if($wyniki>0){
											$w = $result->fetch_assoc();
											$liczmonet = $w['monety'] - $monety;
											$zapytanie = 'UPDATE accounts SET monety="'.$liczmonet.'" WHERE user="'.$_SESSION['user'].'"';
											
											$refreshs = $w['refreshi'] + $refresh;
											$zapytanie1 = 'UPDATE accounts SET refreshi="'.$refreshs.'" WHERE user="'.$_SESSION['user'].'"';
											if($connect->query($zapytanie)){
												if($connect->query($zapytanie1)){
													$_SESSION['globalerrorfrom'] = 'Dodano odświeżenia do Twojego konta!';
													@header('Location: index.php');
													echo 'Jeśli nie nastąpi przekierowanie, prosimy przejść na stronę główną';
													echo "<script>window.location.href = 'index.php';</script>";
													exit();
												}else{
													throw new Exception($connect->error);
												}
											}else{
												throw new Exception($connect->error);
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
					}
				}
			}
		?>
	  
        <div class="row mt-5">
			<!-- Monety -->
			<div class="col-lg-6">
				<div class="filters-myacnt-d2">
					<div class="col-md-7 text-left border-primary">
						<h2 class="font-weight-light text-primary">Monety</h2>
					</div>
					<div style="margin-left: 10px;">
						Za pomocą monet możesz wypromować dodane ogłoszenia, lub też kupić pakiet odświeżeń. Żeby wyróżnić ogłoszenie, należy wejść na dane ogłoszenie i nacisnąć ``Wyróżnij ogłoszenie,,<br><br>
						<div style="text-align: center;">
							<img src="img/grosiky.png" style="width: 30px;"> Aktualnie masz <b><?php echo $usermoneys ?></b> monet <img src="img/grosiky.png" style="width: 30px;"><br>
							<a href="platnosc-sms.php">Doładuj monety przez SMS</a><br>
							<a href="platnosc-przelew.php">Doładuj monety przelewem online</a>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Pakiety odświeżeń -->
			<div class="col-lg-6">
				<div class="filters-myacnt-d2">
					<div class="col-md-7 text-left border-primary">
						<h2 class="font-weight-light text-primary">Pakiety odświeżeń</h2>
					</div>
					<div style="margin-left: 10px;">
						Za ich pomocą możesz odświeżać swoje ogłoszenia kiedy zechcesz!
						W dowolnym czasie i bez ograniczeń. Poprawi to widoczność Twojego
						ogłoszenia, a dzięki temu zyskasz więcej odpowiedzi.<br><br>
						<div style="text-align: center;">
							<span class="icon icon-refresh" style="font-size: 20px; color: #6495ed; text-shadow: 1px 1px black;"></span> 
							Aktualnie masz <b><?php echo $userrefresh ?></b> odświeżeń 
							<span class="icon icon-refresh" style="font-size: 20px; color: #6495ed; text-shadow: 1px 1px black;"></span>
						</div>
						<br>
						▼ Doładuj odświeżenia ▼
						<form method="post">
							<input class="filters-input-select" type="text" placeholder="Pełna liczba odświeżeń" id="refreshsvalue" onkeydown="return noNum(event)">
							<input type="hidden" id="refreshsvalue1" name="refreshsvalue">
							<input type="submit" name="chrefreshssubmit" class="filters-input-btn" value="Doładuj!">
						</form>
						<span id="stylehs5"></span>
					</div>
				</div>
			</div>
			
			<!-- Zmiana hasła -->
			<div class="col-lg-6">
				<div class="filters-myacnt-d2">
					<div class="col-md-7 text-left border-primary">
						<h2 class="font-weight-light text-primary">Zmiana hasła</h2>
					</div>
					<div style="margin-left: 10px;">
						Tutaj możesz zmienić swoje hasło na nowe.<br><br>
						<form method="post">
							<label><b>Stare hasło</b><br><input placeholder=" Stare hasło" type="password" name="spassword" class="filters-input-select"></label>
							<label><b>Nowe hasło</b><br><input placeholder=" Nowe hasło" type="password" name="npassword" class="filters-input-select" id="chpsh"></label>
							<label><b>Powtórz nowe</b><br><input placeholder=" Powtórz nowe hasło" type="password" name="rnpassword" class="filters-input-select" id="chpsh1"></label>
							<input type="submit" name="chpasswordsubmit" class="filters-input-btn" value="Zmień hasło">
							<h6 id="styleh5"></h6>
						</form>
					</div>
				</div>
			</div>
			
			<!-- Moje ogłoszenia -->
			<div class="col-lg-6">
				<div class="filters-myacnt-d2">
					<div class="col-md-7 text-left border-primary">
						<h2 class="font-weight-light text-primary">Twoje ogłoszenia</h2>
					</div>
					<div style="text-align: center;">
						<br><br><br><br>
						<a class="filters-input-btn" style="padding: 10px;" href="ogloszenia-uzytkownika.php?user=<?php echo $_SESSION['user']; ?>" target="_blank">Wyświetl moje ogłoszenia</a>
					</div>
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
  <script type="text/javascript">
	<!--
		var variable = document.getElementById('chpsh1');
		variable.onkeyup = function(){
			if(variable.value == document.getElementById('chpsh').value){
				document.getElementById('styleh5').innerHTML = '<span style="color: green;">Nowe hasła są identyczne!</span>';
			}else{
				document.getElementById('styleh5').innerHTML = '<span style="color: red;">Nowe hasła nie są identyczne!</span>';
			}
		}
	-->
  </script>
  <script type="text/javascript">
	function noNum(e){
		var keynum;
		var keychar;
		var numcheck;

		if(window.event){ // IE
			keynum = e.keyCode;
		}else if(e.which){ // Netscape/Firefox/Opera
			keynum = e.which;
		}
		keychar = String.fromCharCode(keynum);
		numcheck = /\d/;
		if(!(keynum == 8 || keynum == 13 || keynum == 37 || keynum == 39)){
			return numcheck.test(keychar);
		}
	}
  </script>
  <script>
	<!--
		var y = document.getElementById('refreshsvalue');
		y.onkeyup = function(){
			document.getElementById('stylehs5').innerHTML = '<span style="color: red;"></span>';
			document.getElementById('refreshsvalue1').value = '';
			if(y.value <= 0){
				document.getElementById('stylehs5').innerHTML = '<span style="color: red;"></span>';
			}else{
				var refnum = y.value * 2;
				document.getElementById('stylehs5').innerHTML = '<span style="color: black;"><img src="img/grosiky.png" style="width: 30px; margin-right: 5px; vertical-align: bottom;">Potrzebnych monet: <b>'+ refnum +'</b></span>';
				document.getElementById('refreshsvalue1').value = refnum;
			}
		}
	-->
  </script>
    
  </body>
</html>