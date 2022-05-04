<?php
define('FACEBOOK_API','251711686262530');
define('FACEBOOK_SECRET','f0eadb9699f4ac3a1b5d5ed24a628440');
define('REDIRECT_URI','https://www.bezgrosika.pl/login.php');

$facebook_redirect_uri = 'https://www.facebook.com/v2.2/dialog/oauth?client_id='.FACEBOOK_API.'&redirect_uri='.urlencode(REDIRECT_URI).'&sdk=php-sdk-4.0.12&scope=email';


if(!empty($_REQUEST['code'])){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?fields=email,name&client_id=".FACEBOOK_API."&redirect_uri=".urlencode(REDIRECT_URI)."&client_secret=".FACEBOOK_SECRET."&code=".$_REQUEST['code']);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $fb_params = json_decode(curl_exec($ch));
  curl_close($ch);
  if(isset($fb_params->access_token)){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?fields=email,name&access_token=".$fb_params->access_token);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    $fb_user = json_decode($output);
    curl_close($ch);
  }
}

session_start();
if(isset($_POST['facebookuser'])){
	if($_POST['facebookuser'] != ''){
		$_SESSION['facebookuser'] = $_POST['facebookuser'];
	}
}

if(($fb_user) || ($_SESSION['fb_user'])){
	if(($fb_user->email) || ($_SESSION['fb_useremail'])){
		if($fb_user != ''){
			$_SESSION['fb_user'] = $fb_user;
		}
		if($fb_user->email != ''){
			$_SESSION['fb_useremail'] = $fb_user->email;
		}
		require_once  "php/connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try{
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			if($connect->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}else{
				if (!$connect->set_charset("utf8")) {
					printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
					exit();
				} else {
					if ($result = @$connect->query('SELECT * FROM accounts WHERE email="'.$_SESSION['fb_useremail'].'"')){
						$users = $result->num_rows;
						if($users>0){
							$w = $result->fetch_assoc();
							$_SESSION['logged'] = true;
							$_SESSION['user'] = $w['user'];
							$_SESSION['useremail'] = $w['email'];
							$result->free_result();
							header('Location: mojekonto.php');
						}else{
							if(isset($_SESSION['facebookuser'])){
								$ok = true;
								$nick = $_SESSION['facebookuser'];
							    if((strlen($nick)<3) || (strlen($nick)>20)){
									$ok = false;
									$_SESSION['facebookerror'] = "Podaj nazwę użytkownika od 3 do 20 znaków";
								}
								if((ctype_alnum($nick)==false) && (strlen($nick)>0)){
									$ok = false;
									$_SESSION['facebookerror'] = "Nazwa nie może zawierać znaków polskich oraz specjalnych";
								}
								require_once  "php/connect.php";
								mysqli_report(MYSQLI_REPORT_STRICT);
								 try{
									 $connect = new mysqli($host, $db_user, $db_password, $db_name);
									 if($connect->connect_errno!=0){
										throw new Exception(mysqli_connect_errno());
									}else{
										//email istnieje?
										$result = $connect->query('SELECT id FROM accounts WHERE email="'.$_SESSION['fb_useremail'].'"');
										if(!$result) throw new Exception($connect->error);
										$mails = $result->num_rows;
										if($mails > 0){
											$ok = false;
											$_SESSION['facebookerror'] = "Istnieje już konto z tym adresem Email!";
										}
										//nick istnieje?
										$result = $connect->query('SELECT id FROM accounts WHERE user="'.$_SESSION['facebookuser'].'"');
										if(!$result) throw new Exception($connect->error);

										$users = $result->num_rows;
										if($users > 0){
											$ok = false;
											$_SESSION['facebookerror'] = "Istnieje już konto z taką nazwą użytkownika!";
										}
										//zarejestrowanie konta
										if ($ok == true){
											$refreshi = 0;
											$monety = 0;
											$vkey = md5(uniqid(time(), $facebookuser));
											$hashpassword = md5(uniqid(time(), time()));
											$facebookuser = $_SESSION['facebookuser'];
											$email = $_SESSION['fb_useremail'];
											if($connect->query("INSERT INTO accounts VALUES (NULL, '$facebookuser', '$email', '$hashpassword', '$refreshi', '$monety','$vkey','1',NOW())")){
															
												//			$full_name='BezGrosika.pl';
												//			$from = $full_name.'<admin@bezgrosika.pl>';
												//			$subject = 'Hasło do Twojego konta BezGrosika.pl';
												//			$message = '<span style="color: red; text-shadow: 1px 1px black; font-size: 30px;"><i>BezGrosika</span></br><span style="font-size: 15px;">Ogłoszenia dla Ciebie</i></span>
												//			</br></br>Dziękujemy za rejestrację w serwisie!
												//			</br></br>Twoje hasło do logowania przez stronę: 
												//			</br>
												//			</br>
												//			</br>
												//			<hr>
												//			Jeśli to nie Ty aktywowałeś konto, prosimy zignorować tą wiadomość.</br>
												//			Wiadomość została wygenerowana automatycznie, prosimy na nią nie odpowiadać.</br>
												//			Pozdrawiamy, serwis ogłoszeniowy BezGrosika.pl
												//			';

												//			$headers = "From: " . $from . "\r\n";
												//			$headers .= "Reply-To: ". $from . "\r\n";
												//			$headers .= "MIME-Version: 1.0\r\n";
												//			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

												//			if(mail($email, $subject, $message, $headers, "-f ".$from)){
												//				echo 'Wiadomość została wysłana';
												//			}
													$_SESSION['logged'] = true;
													$_SESSION['user'] = $_SESSION['facebookuser'];
													$_SESSION['useremail'] = $user;
													header('Location: mojekonto.php');
													unset($_SESSION['facebookuser']);
													unset($_SESSION['facebooklogin']);
													unset($_SESSION['facebookerror']);
													unset($_SESSION['fb_user']);
													unset($_SESSION['fb_useremail']);
														
														


											}else{
												throw new Exception($connect->error);
											}
										}
										$connect->close();
									}
								 }
								 catch(Exception $error){
									 echo '<div class="servererror">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
									 //echo '</br>Informacja developerska:</br>'.$error;
								 }
								
								
								//echo $_SESSION['facebookuser'];
								@session_start();
								if($_SESSION['facebookerror'] == ''){
									unset($_SESSION['facebooklogin']);
								}else{
									$_SESSION['facebooklogin'] = 'new';
								}
							}else{
								@session_start();
								$_SESSION['facebooklogin'] = 'new';
							}
							
							// Nie ma, trzeba formularz do nazwy użytkownika
							// zrobić losowe hasło żeby można było się też logować normalnie?
							
							// Jeśli nie ma w bazie to tworzy - wyświetla się okienko do podania nazwy użytkownika, jeśli jest to ok.
							// Ustawić zmienna facebooklogin czy coś, jeśli ustalona to nie wyświetla zaloguj hasło i tamto, tylko formularz nazwy użytkownika - sprawdza czy nie zajęta też.
						}
					}else{
						throw new Exception($connect->error);
					}
					$connect->close();
				}
			}
		}
		catch(Exception $error){
			echo '<div><span style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</span></div>';
			//echo '</br>Informacja developerska:</br>'.$error;
		}
	}else{
		echo '<div id="zglid" onclick="document.getElementById(\'zglid\').style=\'display: none;\' " style="z-index: 10; cursor: pointer; min-width: 170px; display: block; text-align: center; background: white; border-radius: 15px; padding: 15px; position: fixed; top: 90px; border: 2px solid #30e3ca; width: 30%; top: 30%; left: 35%;">';
		echo '<span style="font-size: 15px;">Przepraszamy, wystąpił błąd<br>
			Aby kontynuować przez facebooka musisz udostępnić swój adres email<br><span style="float: right;"><b>X</b></span></span>';
		echo '</div>';
	}
}else{
	unset($_SESSION['facebooklogin']);
}
?>


<?php
	session_start();
	if(isset($_SESSION['logged'])){
		header('Location: mojekonto.php');
		exit();
	}
	else{
		require_once  "php/connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try{
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			if($connect->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}
			else{
				if(isset($_POST['nick'])){
					$login = $_POST['nick'];
					$password = $_POST['password'];
					$login = htmlentities($login, ENT_QUOTES, "UTF-8");
				}
				
				if (!$connect->set_charset("utf8")) {
					printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
					exit();
				} else {
					if ($result = @$connect->query(
						sprintf("SELECT * FROM accounts WHERE user='%s'",
						mysqli_real_escape_string($connect,$login),
						mysqli_real_escape_string($connect,$password)))){
							$users = $result->num_rows;
							if($users>0){
								$w = $result->fetch_assoc();
								if (password_verify($password, $w['password'])){
									if($w['v'] == 1){
										$_SESSION['logged'] = true;
										$_SESSION['user'] = $w['user'];
										$_SESSION['useremail'] = $w['email'];
										$result->free_result();
										header('Location: mojekonto.php');
									}else{
										$_SESSION['e_bad'] = "To konto nie zostało jeszcze aktywowane. </br>Aktywuj je i spróbuj jeszcze raz.";
									}
								}
								else{
									$_SESSION['e_bad'] = "Podano błędny login i/lub hasło. </br>Spróbuj jeszcze raz.";
								}
								
							}else{
									$_SESSION['e_bad'] = "Podano błędny login i/lub hasło. </br>Spróbuj jeszcze raz.";
							}
					}else{
						throw new Exception($connect->error);
					}
					
					if($result = @$connect->query('SELECT * FROM accounts WHERE joindate <= NOW() - INTERVAL 1 DAY AND v = 0')){
						$w = $result->fetch_assoc();
						$wyniki = $result->num_rows;
						if($wyniki>0){
							for($r = 1; $r <= $wyniki; $r++){
								@$connect->query('DELETE FROM accounts WHERE joindate <= NOW() - INTERVAL 1 DAY AND v = 0');
							}
						}						
					}else{
						throw new Exception($connect->error);
					}
					$connect->close();
				}
			}
		}
		catch(Exception $error){
			echo '<div><span style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</span></div>';
			//echo '</br>Informacja developerska:</br>'.$error;
		}
	}
?>
		

<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Login - zaloguj się - BezGrosika.pl</title>
    <meta name="keywords" content="zaloguj się na konto bez grosika pl"/>
    <meta name="description" content="BezGrosika.pl - logowanie na konto, zaloguj się i korzystaj!"/>
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
    
  </head>
  <body>
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

                <li class="ml-xl-3 login active">
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
                <h1>Zaloguj się</h1>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 mb-5"  data-aos="fade">

		  <?php
			@session_start();
			if($_SESSION['facebooklogin']){
				if(isset($_SESSION['facebookerror'])){
					echo '<br><span style="color: red;">'.$_SESSION['facebookerror'].'</span>';
					unset($_SESSION['facebookerror']);
				}
				?>
				<form method="post" class="p-5 bg-white">
					<div class="row form-group">
						<div class="col-md-12">
						  <label class="text-black">Jak chcesz się nazywać?</label> 
						  <input id="email" class="form-control" name="facebookuser">
						</div>
					  </div>
					  <input type="submit" value="Ok!" class="btn btn-primary py-2 px-4 text-white">
				</form>
				
			<?php }else{ ?>
				<form method="post" class="p-5 bg-white">
					 <center>
						<a href="<?= $facebook_redirect_uri; ?>">
							<b><div	style="font-size: calc(75% + 5px); max-height: 40px; min-width: 150px; max-width: 300px; width: auto; background: #1877f2; border-radius: 5px; color: white; line-height: 40px;">
								<span style="display: inline-block; color: #1877f2; background-color: white; font-size: 30px; height: 29px; width: 29px; border-radius: 29px; vertical-align: middle;"><b>f</b></span>
								<span style="display: inline-block;">Kontynuuj z Facebook</span>
							</div></b>
						</a>
						

					</center>
					 
					  
					  <br>
					  <hr>
					  <br>
					  <center>lub zaloguj przez BezGrosika.pl</center>
					  <br>
					  
					  <div class="row form-group">
						<?php
						if(isset($login)){
							if(isset($_SESSION['e_bad'])){
								echo '<div class="aerror">'.$_SESSION['e_bad'].'</div>';
								unset($_SESSION['e_bad']);
							}
						}
						?>
						<div class="col-md-12">
						  <label class="text-black">Nazwa użytkownika</label> 
						  <input id="email" class="form-control" name="nick">
						</div>
					  </div>

					  <div class="row form-group">
						
						<div class="col-md-12">
						  <label class="text-black">Hasło</label> 
						  <input type="password" id="subject" class="form-control" name="password">
						</div>
					  </div>

					  <div class="row form-group">
						<div class="col-12">
						  <p>Nie masz konta? <a href="register.php">Zarejestruj</a></p>
						  <p>Zapomniałeś hasła? <a href="rpass.php">Przypomnij</a></p>
						</div>
					  </div>

					  <div class="row form-group">
						<div class="col-md-12">
						  <input type="submit" value="Zaloguj" class="btn btn-primary py-2 px-4 text-white">
						</div>
					  </div>

				</form>
			<?php } ?>
	

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