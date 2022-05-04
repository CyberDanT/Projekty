<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Rejestracja - zarejestruj się - BezGrosika.pl</title>
    <meta name="keywords" content="zarejestruj się na konto bez grosika pl"/>
    <meta name="description" content="BezGrosika.pl - rejestracja konta - zarejestruj się i korzystaj!"/>
    <link rel="shortcut icon" href="images/grosiky.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://www.bezgrosika.pl/fonts/icomoon/style.css">

    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/magnific-popup.css">
    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/jquery-ui.css">
    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="https://www.bezgrosika.pl/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/aos.css">
    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/rangeslider.css">

    <link rel="stylesheet" href="https://www.bezgrosika.pl/css/style.css">
	<script src="https://www.google.com/recaptcha/api.js"></script>
    
  </head>
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
if(isset($_SESSION['logged'])){
	header('Location: mojekonto.php');
	exit();
}
if(isset($_POST['nick'])){
  $ok = true;
  $nick = $_POST['nick'];
  if((strlen($nick)<3) || (strlen($nick)>20)){
    $ok = false;
    $_SESSION['e_nick'] = "Podaj nazwę użytkownika od 3 do 20 znaków";
  }
   if((ctype_alnum($nick)==false) && (strlen($nick)>0)){
     $ok = false;
     $_SESSION['e_nick'] = "Nazwa nie może zawierać znaków polskich oraz specjalnych";
   }
   $email = $_POST['email'];
   $email1 = filter_var($email, FILTER_SANITIZE_EMAIL);
   if((filter_var($email1, FILTER_VALIDATE_EMAIL) == false) || ($email != $email1)){
     $ok = false;
     $_SESSION['e_email'] = "Sprawdź poprawność wpisanego email";
   }
   $password1 = $_POST['password1'];
   $password2 = $_POST['password2'];
   if($password1 != $password2){
     $ok = false;
     $_SESSION['e_password'] = "Podane hasła nie są identyczne";
   }
   if((strlen($password1)<5) || (strlen($password1)>20)){
     $ok = false;
     $_SESSION['e_password'] = "Hasło powinno mieć od 5 do 20 znaków";
	}

   $hashpassword = password_hash($password1, PASSWORD_DEFAULT);

   if(!isset($_POST['regulamin'])){
     $ok = false;
     $_SESSION['e_regulamin'] = "Zaakceptuj regulamin serwisu";
   }

   $secretkey = "6Ld4WrkUAAAAAKL7CzfjwTgP5vWmIVvR7_OXsRth";
   $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response='.$_POST['g-recaptcha-response']);
   $reply = json_decode($check);
   if($reply->success==false){
     $ok = false;
     $_SESSION['e_bot'] = "Potwierdź, że nie jesteś robotem";
   }
	
	$_SESSION['r_nick'] = $nick;
	$_SESSION['r_email'] = $email;
	$_SESSION['r_password1'] = $password1;
	$_SESSION['r_password2'] = $password2;
	if(isset($_POST['regulamin'])) $_SESSION['r_regulamin'] = true;
	
	 require_once "php/connect.php";
	 mysqli_report(MYSQLI_REPORT_STRICT);
	 try{
		 $connect = new mysqli($host, $db_user, $db_password, $db_name);
		 if($connect->connect_errno!=0){
		 	throw new Exception(mysqli_connect_errno());
		}else{
			//email istnieje?
			$result = $connect->query("SELECT id FROM accounts WHERE email='$email'");
			if(!$result) throw new Exception($connect->error);

			$mails = $result->num_rows;
			if($mails > 0){
				$ok = false;
				$_SESSION['e_email'] = "Istnieje już konto z tym adresem Email!";
			}
			//nick istnieje?
			$result = $connect->query("SELECT id FROM accounts WHERE user='$nick'");
			if(!$result) throw new Exception($connect->error);

			$users = $result->num_rows;
			if($users > 0){
				$ok = false;
				$_SESSION['e_nick'] = "Istnieje już konto z taką nazwą użytkownika!";
			}

			//zarejestrowanie konta
			if ($ok == true){
			$refreshi = 0;
			$monety = 0;
			$vkey = md5(uniqid(time(), $nick));
	 	   	if($connect->query("INSERT INTO accounts VALUES (NULL, '$nick', '$email', '$hashpassword', '$refreshi', '$monety','$vkey','0',NOW())")){
							
							$full_name='BezGrosika.pl';
							$from = $full_name.'<admin@bezgrosika.pl>';
							$subject = 'Potwierdzenie rejestracji konta';
							$message = '<div class="site-navbar container py-0 bg-white" role="banner">
								<div class="row align-items-center">
								  
								  <img src="https://www.bezgrosika.pl/images/grosiky.png" style="height: 50px;"><div class="col-6 col-xl-2">
									<h1 class="mb-0 site-logo"><a href="https://www.bezgrosika.pl" class="text-black mb-0">Bez<span class="text-primary">Grosika</span>.pl</a></h1>
								  </div>
								  <div class="col-12 col-md-10 d-none d-xl-block">
										<br><br>
										Dziękujemy za rejestrację w serwisie BezGrosika.pl
										<br>Aktywuj swoje konto klikając w poniższy link:
										<br><br>
										<a href="https://www.bezgrosika.pl/verify.php?key='.$vkey.'" class="cta"><span class="bg-primary text-white rounded">Aktywuj!</span></a>
										<br><br>
										<hr>
										<br>
										Jeśli to nie Ty aktywowałeś konto, prosimy zignorować tą wiadomość.<br>
										Wiadomość została wygenerowana automatycznie, prosimy na nią nie odpowiadać.<br>
										Pozdrawiamy, serwis ogłoszeniowy BezGrosika.pl<br>
										www.bezgrosika.pl
								  </div>
								</div>
							</div>';
							
						//	$message = '<span style="color: red; text-shadow: 1px 1px black; font-size: 30px;"><i>BezGrosika</span><br><span style="font-size: 15px;">Ogłoszenia dla Ciebie</i></span>
						//	</br></br>Dziękujemy za rejestrację w serwisie!
						//	</br></br>Potwierdź swoje konto klikając w poniższy link:
						//	</br><div style="style=text-align: center; width: 250px; padding: 10px; background-color: red; text-shadow: 1px 1px black; border-radius: 15px; border: 1px solid black;"><p><a style="color: white;" href="https://www.bezgrosika.pl/verify.php?key='.$vkey.'"><strong>Aktywuj konto</strong></a></p></div>
						//	</br>
						//	</br>
						//	<hr>
						//	Jeśli to nie Ty aktywowałeś konto, prosimy zignorować tą wiadomość.</br>
						//	Wiadomość została wygenerowana automatycznie, prosimy na nią nie odpowiadać.</br>
						//	Pozdrawiamy, serwis ogłoszeniowy BezGrosika.pl
						//	';

							$headers = "From: " . $from . "\r\n";
							$headers .= "Reply-To: ". $from . "\r\n";
							$headers .= "MIME-Version: 1.0\r\n";
							$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

							if(mail($email, $subject, $message, $headers, "-f ".$from)){
								echo 'Wiadomość została wysłana';
							}

						$_SESSION['register'] = true;
						header('Location: welcome.php');
						
						


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
}

?>
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
							echo '<a href="mojekonto.php"><span class="border-left pl-xl-4"></span>'.$_SESSION['user'].'</a>';
						}else{
							echo '<a href="login.php"><span class="border-left pl-xl-4"></span>Login</a>';
						}
					?>
				</li>
                <li class="active">
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
                <h1>Rejestracja</h1>
				<p data-aos="fade-up" data-aos-delay="100">Załóż darmowe konto!</p>
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
			  <center>lub zarejestruj przez BezGrosika.pl</center>
			  <br>
			  
             <div class="row form-group">
                <div class="col-md-12">				
                  <label class="text-black" for="nick">Nazwa użytkownika</label> 
                  <input type="text" id="nick" class="form-control" value = "<?php 
												if(isset($_SESSION['r_nick'])){
													echo $_SESSION['r_nick']; 
													unset($_SESSION['r_nick']);
												}
											?>" name="nick">
											<?php
													if(isset($_SESSION['e_nick'])){
														echo '<span style="color: red;">'.$_SESSION['e_nick'].'</span>';
														unset($_SESSION['e_nick']);
													}
												?>
                </div>
              </div>
			 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control" value = "<?php 
												if(isset($_SESSION['r_email'])){
													echo $_SESSION['r_email']; 
													unset($_SESSION['r_email']);
												}
											?>" name="email">
											<?php
													if(isset($_SESSION['e_email'])){
														echo '<span style="color: red;">'.$_SESSION['e_email'].'</span>';
														unset($_SESSION['e_email']);
													}
												?>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Hasło</label> 
                  <input type="password" id="subject" class="form-control" value = "<?php 
												if(isset($_SESSION['r_password1'])){
													echo $_SESSION['r_password1']; 
													unset($_SESSION['r_password1']);
												}
											?>" name="password1">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="password">Powtórz hasło</label> 
                  <input type="password" id="subject" class="form-control" value = "<?php 
												if(isset($_SESSION['r_password2'])){
													echo $_SESSION['r_password2']; 
													unset($_SESSION['r_password2']);
												}
											?>" name="password2">
											<?php
													if(isset($_SESSION['e_password'])){
														echo '<span style="color: red;">'.$_SESSION['e_password'].'</span>';
														unset($_SESSION['e_password']);
													}
												?>
                </div>
              </div>
			  
			  
			  <label><input type="checkbox" name="regulamin" value = "<?php 
					if(isset($_SESSION['r_regulamin'])){
						echo "checked"; 
						unset($_SESSION['r_regulamin']);
					}
				?>" </input> Akceptuję <a href="regulamin.pdf" target="_blank">regulamin</a> serwisu</label>
					<?php
						if(isset($_SESSION['e_regulamin'])){
							echo '<div class="aerror">'.$_SESSION['e_regulamin'].'</div>';
							unset($_SESSION['e_regulamin']);
						}
					?>
				</br>
				<center>
					<div class="g-recaptcha" data-sitekey="6Ld4WrkUAAAAAD7JqA6BtTjkzoESKmKxQjr2NVld"></div>
					<?php
						if(isset($_SESSION['e_bot'])){
							echo '<div class="aerror">'.$_SESSION['e_bot'].'</div>';
							unset($_SESSION['e_bot']);
						}
					?>
				</center>

              <div class="row form-group">
                <div class="col-12">
				   <br>
                   <p>Masz konto? <a href="login.php">Zaloguj</a></p>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Zarejestruj" class="btn btn-primary py-2 px-4 text-white">
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