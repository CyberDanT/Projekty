<?php
	session_start();
	if(isset($_SESSION['logged'])){
		header('Location: mojekonto.php');
		exit();
	}else{
		if(isset($_GET['key']) && isset($_GET['email'])){
			$spr = strrpos($_GET['key'], "=");
			if($spr !== false){
				$ok = false;
				$_SESSION['er_bad'] = "Przepraszamy wystąpił błąd!";
			}
			$spr = strrpos($_GET['email'], "=");
			if($spr !== false){
				$ok = false;
				$_SESSION['er_bad'] = "Przepraszamy wystąpił błąd!";
			}
			if(!isset($ok)){
				require_once("php/connect.php");
				mysqli_report(MYSQLI_REPORT_STRICT);
				try{
					$connect = new mysqli($host, $db_user, $db_password, $db_name);
					if($connect->connect_errno!=0){
						throw new Exception(mysqli_connect_errno());
					}else{
						if(!$connect->set_charset("utf8")){
							printf('<span style="color: red">Przepraszamy za utrudnienia, prosimy spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
							exit();
						}else{
							if($result = @$connect->query(sprintf('SELECT user,email,vkey FROM accounts WHERE email="'.$_GET['email'].'" AND vkey="'.$_GET['key'].'"'))){
								$wyniki = $result->num_rows;
								if($wyniki > 0){
									$w = $result->fetch_assoc();
									$newpass = uniqid('h');
									$hashpassword = password_hash($newpass, PASSWORD_DEFAULT);
									$vkey = md5(uniqid(time(), $w['vkey']));
									if($result = @$connect->query(sprintf('UPDATE accounts SET password="'.$hashpassword.'", vkey="'.$vkey.'" WHERE user="'.$w['user'].'" AND email="'.$w['email'].'" AND vkey="'.$_GET['key'].'"'))){
										$full_name='BezGrosika.pl';
										$from = $full_name.'<admin@bezgrosika.pl>';
										$subject = 'Odzyskiwanie konta';
										$message = '<span style="color: red; text-shadow: 1px 1px black; font-size: 30px;"><i>BezGrosika</span></br><span style="font-size: 15px;">Ogłoszenia dla Ciebie</i></span>
										</br></br>Cześć '.$w['user'].'
										</br></br>Zresetowaliśmy Twoje hasło!</br>Twoje nowe hasło to: '.$newpass.'</br>Po zalogowaniu się koniecznie je zmień w panelu moje konto!
										</br>
										</br>
										<hr>
										Jeśli to nie Ty wysłałeś formularz resetu hasła, zignoruj tą wiadomość.</br>
										Wiadomość została wygenerowana automatycznie, prosimy na nią nie odpowiadać.</br>
										Pozdrawiamy, serwis ogłoszeniowy BezGrosika.pl
										';
										
										$headers = "From: " . $from . "\r\n";
										$headers .= "Reply-To: ". $from . "\r\n";
										$headers .= "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

										if(mail($w['email'], $subject, $message, $headers, "-f ".$from)){
											echo 'Wiadomość została wysłana';
										}
										$_SESSION['globalerrorfrom'] = 'Dziękujemy za potwierdzenie.</br>Aby dokończyć proces odzyskiwania konta wysłaliśmy wiadomość na podany adres email.</br>Sprawdź swoją skrzynkę odbiorczą ponownie.';
										header("Location: index.php");
									}else{
										throw new Exception($connect->error);
									}
								}else{
									$_SESSION['er_bad'] = "Przepraszamy wystąpił błąd.";
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
			}
		}else{
			if(isset($_POST['odzyskaj'])){
				if(isset($_POST['email'])){
					$email = $_POST['email'];
					$email1 = filter_var($email, FILTER_SANITIZE_EMAIL);
					if((filter_var($email1, FILTER_VALIDATE_EMAIL) == false) || ($email != $email1)){
						$ok = false;
						$_SESSION['er_bad'] = "Sprawdź poprawność wpisanego email";
					}
					$email = htmlentities($email, ENT_QUOTES, "UTF-8");
					if(!isset($ok)){
						require_once("php/connect.php");
						mysqli_report(MYSQLI_REPORT_STRICT);
						try{
							$connect = new mysqli($host, $db_user, $db_password, $db_name);
							if($connect->connect_errno!=0){
								throw new Exception(mysqli_connect_errno());
							}else{
								if(!$connect->set_charset("utf8")){
									printf('<span style="color: red">Przepraszamy za utrudnienia, prosimy spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
									exit();
								}else{
									if($result = @$connect->query(sprintf('SELECT vkey,email FROM accounts WHERE email="'.$email.'"'))){
										$wyniki = $result->num_rows;
										if($wyniki > 0){
											$w = $result->fetch_assoc();
											$full_name='BezGrosika.pl';
											$from = $full_name.'<admin@bezgrosika.pl>';
											$subject = 'Odzyskiwanie konta';
											$message = '<span style="color: red; text-shadow: 1px 1px black; font-size: 30px;"><i>BezGrosika</span></br><span style="font-size: 15px;">Ogłoszenia dla Ciebie</i></span>
											</br></br>Dziękujemy za zgłoszenie!
											</br></br>Zresetuj swoje hasło klikając w poniższy link:
											</br><div style="style=text-align: center; width: 250px; padding: 10px; background-color: red; text-shadow: 1px 1px black; border-radius: 15px; border: 1px solid black;"><p>
											<a style="color: white;" href="https://www.bezgrosika.pl/rpass.php?key='.$w['vkey'].'&email='.$w['email'].'"><strong>Odzyskaj konto!</strong></a></p></div>
											</br>
											</br>
											<hr>
											Jeśli to nie Ty wysłałeś formularz resetu hasła, zignoruj tą wiadomość.</br>
											Wiadomość została wygenerowana automatycznie, prosimy na nią nie odpowiadać.</br>
											Pozdrawiamy, serwis ogłoszeniowy BezGrosika.pl
											';

											$headers = "From: " . $from . "\r\n";
											$headers .= "Reply-To: ". $from . "\r\n";
											$headers .= "MIME-Version: 1.0\r\n";
											$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

											if(mail($email, $subject, $message, $headers, "-f ".$from)){
												echo 'Wiadomość została wysłana';
											}
											$_SESSION['globalerrorfrom'] = 'Wysłaliśmy wiadomość na podany adres email.</br>Sprawdź skrzynkę odbiorczą.';
											header("Location: index.php");
										}else{
											$_SESSION['er_bad'] = "Nie znaleziono użytkownika. </br>Podaj prawidłowy adres email.";
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
					}
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Przypomnienie hasła - BezGrosika.pl</title>
    <meta name="keywords" content="przypomnij hasło na bez grosika pl"/>
    <meta name="description" content="Zapomniałeś hasła do swojego konta? Wykorzystaj formularz odzyskiwania hasła i korzystaj z swojego konta."/>
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
                <h1>Przypomnij hasło</h1>
				<p class="mb-0">Formularz odzyskiwania konta</p>
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

            

           <form method="post" class="p-5 bg-white">
             
              <div class="row form-group">
                <?php
					if(isset($_SESSION['er_bad'])){
						echo '<span style="color: red;">'.$_SESSION['er_bad'].'</span>';
						unset($_SESSION['er_bad']);
					}
				?>
                <div class="col-md-12">
                  <label class="text-black">Email użytkownika</label> 
                  <input id="email" class="form-control" name="email" type="email">
                </div>
              </div>
			  
			  <div class="row form-group">
                <div class="col-12">
                  <p>Na podany email zostanie wysłana wiadomość</p>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="odzyskaj" value="Odzyskaj" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
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
