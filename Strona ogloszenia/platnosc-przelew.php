<?php 
	session_start();
	require_once  "php/connect.php";

    /* 
        Konfiguracja przelewów
    */
        $config = array(
            'transfers' => array(

                /* 
                    shopid - parametr umożliwiający idetyfikacje sklepu przyjmującego płatność.
                */
                'shopid' => 513,

                /* 
                    ID partnera w serwisie 
                */

                'userid' => 6440,

                /* 
                    HASh, który uniemożliwi osobą nieautoryzowanym "podrobienie" płatności
                    i odebranie płatności bez ponoszenia kosztów.

                    HASH można wygenerować przechodząc w poniższe zakładki
                    Panel bilingowy -> Przelewy online -> Sklepy -> wybieramy nasz sklep i go edytujemy -> znajduje się tutaj
                    pole Hash, który należy skopiować i wkleić poniżej.

                    Pamiętaj, aby nikomu go nie udostępniać. 
                    Możesz w ten sposób narazić się na ogromne straty finansowe!
                */
                'hash' => 'F@8!l3!n6Um3Iy1*w3Gi7Nc0Ms2!o9Du',

                /*
                    Tytuł płatności
                */
                'description' => 'BezGrosika.pl zakup monet',
				
				/*
                    Adres url pod który system MicroSMS
                    ma przesłać informacje do księgowości
                */
				//'return_urlc' => 'https://microsms.pl/przelewy?checkPayment',
				'return_urlc' => 'https://www.bezgrosika.pl/platnosc-przelew.php?checkPayment',
				
				/*
					Adres pod który zostanie odesłany klient po dokonaniu płatności
				*/
				'return_url' => 'https://www.bezgrosika.pl/platnosc-przelew.php',
				
            )
        );

    /*
        Inicjujemy klasę mPaySafeCard
    */
	
    class MicroSMSTransfers
    {
        private $url = 'https://microsms.pl/api/bankTransfer/';
        private $ips = 'https://microsms.pl/psc/ips/';
        private $fields = array();
       
        function add($field, $value)
        {
            $this->fields[$field] = $value;
        }
       
        function submit()
        {
            echo '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <title>Przekierowanie do platnosci ...</title>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <script>
                            function submitform() {
                                document.getElementById(\'send\').submit();
                            }
                        </script>
                    </head>
                            <body onload="submitform();">
                    <h3>Przekierowanie do platnosci ...</h3>
                    <form id=\'send\' action="' . $this->url . '" method="get"  >
                    ';
           
            foreach ($this->fields as $name => $value) {
                echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
            }
           
            echo '<input type="hidden" name="charset" value="utf-8" />
                        <input type="submit" value="Kliknij tutaj, jezeli nie zostaniesz przeniesiony w ciągu 10 sekund" />
                    </form>
                    </body>
                    </html>';
            exit();
        }
       
        public function validate_ipn()
        {
            if (!in_array($_SERVER['REMOTE_ADDR'], explode(',', file_get_contents($this->ips))) == TRUE) {
                exit('Access denid.');
            }
        }

        public function validate_user($config, $post)
        {
            if ($config['transfers']['userid'] != $post['userid']) 
                exit('Bad user');
            
        }
    }
        $transfer = new MicroSMSTransfers;


    /* 
        Odbiór i księgowanie płatności
    */

     if(isset($_GET['checkPayment']) && isset($_POST['status'])) {

        /* 
            Wyłączamy szablon
        */
            ob_clean();

        /*  
            Dostęp do tej zakładki może mieć tylko i wyłącznie MicroSMS!
            Nie należy usuwać oraz modyfikować tej funkcji.
        */
        //    $psc->validate_ipn(); <-------------------------------------------- ----------------------  PO ZABLOKOWANIU 'OK' DZIAŁA

        /* 
            Należy zabezpieczyć się przed nieautoryzowanymi płatnościami.
            Koniecznie sprawdzaj jaki userid otrzymał tą płatność!
        */
         //   $psc->validate_user($config, $_POST); <---------------------- ---------------------- PO ZABLOKOWANIU 'OK' DZIAŁA

        /*
            MicroSMS prześle metodą post pod zdefiniowany link url w formularu
            pakiet pakietów. 
            
            status      => Status płatności TRUE i FALSE
            test        => Informacja czy transakcja jest testowa czy produkcyjna TRUE i FALSE
            email       => Adres Email płacącego
            orderID     => Unikalny numer transakcji 
            control     => Pole dla sklepu, umożliwiające m.in zapisanie sesji
            amountIni   => Wartość zainicjowanej kwoty
            amountPay   => Wartość wpłaconej kwoty w banku
            description => Opis płatności zdefiniowany w fomrmularzu
            control
        */

        /* 
            Przykład zastosowania
        */
            if($_POST['status'] == TRUE) { 			
				try{
					$connect = new mysqli($host, $db_user, $db_password, $db_name);
					if($connect->connect_errno!=0){
						throw new Exception(mysqli_connect_errno());
					}else{
						if(!$connect->set_charset("utf8")){
							printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
							exit();
						}else{
							if($result = @$connect->query('SELECT monety,email FROM accounts WHERE user="'.$_POST['control'].'"')){
								$wyniki = $result->num_rows;
								if($wyniki>0){
									$w = $result->fetch_assoc();
									$monety = $w['monety'] + $_POST['amountPay'];
									if($result = @$connect->query(sprintf('UPDATE accounts SET monety='.$monety.' WHERE user="'.$_POST['control'].'" AND email="'.$w['email'].'"'))){
										$full_name='BezGrosika.pl';
										$from = $full_name.'<admin@bezgrosika.pl>';
										$subject = 'Zakupiłeś monety';
										$message = '<span style="color: red; text-shadow: 1px 1px black; font-size: 30px;"><i>BezGrosika</span></br><span style="font-size: 15px;">Ogłoszenia dla Ciebie</i></span>
										</br></br>Cześć '.$_POST['control'].'! </br>Dziękujemy za zakup monet w naszym serwisie!
										</br>Ilość zakupionych przez Ciebie monet: '.$_POST['amountPay'].'
										</br>Stan monet możesz sprawdzić w panelu swojego konta.
										</br>
										</br>
										<hr>
										Wiadomość została wygenerowana automatycznie, prosimy na nią nie odpowiadać.</br>
										Pozdrawiamy, serwis ogłoszeniowy BezGrosika.pl
										';
										$headers = "From: " . $from . "\r\n";
										$headers .= "Reply-To: ". $from . "\r\n";
										$headers .= "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
										if(mail($w['email'], $subject, $message, $headers, "-f ".$from)){
											// echo 'Wiadomość została wysłana';
										}
										//$result->free_result();
									}else{
										throw new Exception($connect->error);
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
					echo '<div class="servererror">Przepraszamy wystąpił błąd! Prosimy skontaktować się z administratorem.</div>';
					//echo '</br>Informacja developerska:</br>'.$error;
				}
				exit('OK');
            }

        /* 
            Zamykamy skrypt odpowiedzią dla MicroSMS
        */
			//exit('OK');
     } 

     /* 
        Poniżej możesz skonfigurować odpowiedzi w przypadku
        negatywnych lub pozytywnych płatności
    */

        if(isset($_GET['status']) && isset($_GET['hash']) && isset($_GET['orderID'])) {

            if($_GET['hash'] == md5($_GET['status'].$_GET['orderID'].$config['transfers']['hash'])) {
               if($_GET['status'] == true) { 
                    $okmsg = 'Płatność przebiegła prawidłowo</br>Sprawdź stan monet <a href="mojekonto.php">tutaj</a>';
                } else {
                    $errormsg = 'Płatność przebiegła negatywnie.';
                }
            } else {
                $errormsg = 'Płatność przebiegła negatywnie.';
            }
        }

    /* 
        Generujemy formularz płatności
    */
        if(isset($_POST['send'])) { 

            if(!isset($_POST['email']) OR !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
                $errormsg .= 'Adres email jest nieprawidłowy.';

            if(isset($_POST['amount'])) { 
				if(!is_numeric($_POST['amount']) == TRUE OR $_POST['amount'] < 1) {
		            @$errormsg .= 'Minimalna kwota transakcji to 1 PLN<br>';
				}
				if(!is_numeric($_POST['amount']) == TRUE OR $_POST['amount'] > 100) {
		            @$errormsg .= 'Maksymalna kwota transakcji to 100 PLN<br>';
				}
				$liczba = (bool)preg_match('#^[0-9]+$#', $_POST['amount']);
				if($liczba != TRUE){
					@$errormsg .= 'Nieprawidłowa kwota, sprawdź cennik.<br>';
				}
	        } else {
	        	@$errormsg .= 'Minimalna kwota transakcji to 1 PLN<br>';
	        }
		   
		   
            if(!isset($errormsg)) { 

                /* 
                    Poniższe funkcje wygenerują formularz
                    oraz przeniosą do płatności
                */
                $transfer->add('shopid', $config['transfers']['shopid']);
                $transfer->add('return_url', $config['transfers']['return_url']);
                $transfer->add('return_urlc', $config['transfers']['return_urlc']);
                $transfer->add('description', $config['transfers']['description']);
                $transfer->add('amount', $_POST['amount']);
                $transfer->add('signature', md5($config['transfers']['shopid'] . $config['transfers']['hash'] . $_POST['amount']));
                $transfer->add('email', $_POST['email']);
                $transfer->add('control', $_SESSION['user']);
                $transfer->submit();

                /* 
                    Jeśłi wystąpił by błąd z generowaniem płatności
                    klient zobaczy poniższy komunikat
                */
                $errormsg = 'Płatność nie mogła zostać wygenerowana.';
            }
        }
?>
<?php
if(!isset($_SESSION['logged'])){
		header('Location: login.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
	<title>BezGrosika.pl - płatność przelewem online</title>
	<link rel="stylesheet" href="css/pricesstyle.css" type="text/css"/>
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
                <h1>Płatność przelewem online</h1>
                <p class="mb-0">Doładowanie monet przez przelew online</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  

	<div class="site-section bg-light">
      <div class="container">

        <div style="background-color: white; padding: 15px; border-radius: 5px;">
			<h3 style="color: #30e3ca;">Doładowanie monet przelewem online</h3>
			<div class="center" style="font-size: 15px;">
				<br>
				<p>
					Wpisz kwotę za którą chcesz zakupić monety.
				</p>

				<?php if(isset($okmsg)) { ?><div class="msg ok"><?php echo $okmsg; ?></div><?php } ?>
				<?php if(isset($errormsg)) { ?><div class="msg error"><?php echo $errormsg; ?></div><?php } ?>
				
				<form method="post" >
				   <input type="hidden" name="send" value="" />   
				   <input type="hidden" name="email" placeholder="E-Mail" type="text" value="<?php echo $_SESSION['useremail']; ?>" />
				   <input class="filters-input-select" name="amount" id="mvalue" placeholder="Kwota transakcji" type="text" onkeydown="return noNum(event)" maxlength="3"/><span style="font-size: 20px; margin-left: -40px; cursor: default;">PLN</span><br>
				   <button class="filters-input-btn" id="psubmit" type="submit">Przejdź do płatności</button>
				</form>
				<span id="stylehs5"></span>
				<br>
				<div style="font-size: 12px; margin-top: 15px;">
					Cennik zakupu monet znajdziesz pod <a href="cennik.php" target="_blank">tym adresem</a>.<br>
					Korzystanie z serwisu jest jednoznaczne z akceptacją <a href="regulamin.pdf" target="_blank">regulaminu BezGrosika.pl</a> oraz <a href="https://microsms.pl/kernel/Mails/files/regulaminmicrosms25022016.pdf" target="_blank">regulaminu dostawcy płatności.</a><br/>
				</div>
				<script type="text/javascript">
					<!--
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
					var mvalue = document.getElementById('mvalue');
					mvalue.onkeyup = function(){
						var mvalue1 = document.getElementById('mvalue').value;
						document.getElementById('stylehs5').innerHTML = ' ';
						if(mvalue1 != null){
							if(mvalue1 != 0){
								if(mvalue1 <= 100){
									document.getElementById('stylehs5').innerHTML = '<span><img src="img/grosiky.png" style="width: 30px; margin-right: 5px; vertical-align: bottom;">Tyle monet otrzymasz po dokonaniu płatności: <b>'+ mvalue1 +'</b></span>';
									document.getElementById('psubmit').disabled = false;
								}else{
									document.getElementById('stylehs5').innerHTML = '<span style="color: red;"><img src="img/grosiky.png" style="width: 30px; margin-right: 5px; vertical-align: bottom;">W celu bezpieczeństwa, jednorazowo można kupić maksymalnie 100 monet.</span>';
									document.getElementById('psubmit').disabled = true;
								}
							}
						}
					}
					-->
				</script>
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