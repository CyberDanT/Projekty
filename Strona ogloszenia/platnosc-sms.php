<?php
	session_start();
	require_once  "php/connect.php";
	if(!isset($_SESSION['logged'])){
		header('Location: login.php');
		exit();
	}
		
	error_reporting(E_ALL);

	ini_set('error_reporting', E_ALL);
	ini_set("display_errors", 1);

	$settings = array(
		/* 
			@nazwa:	userid
			@opis: numer identyfikacyjny partnera nadawany po zarejestrowaniu konta (dostępny po zalogowaniu).
		*/
		'userid' => '6440',
		/*
			@nazwa: serviceid
			@opis: numer identyfikacyjny kanału SKS dostępny w sekcji "Kanały SMS Premium" 
		*/
		'serviceid' => '6515',
		/*
			@nazwa: text
			@opis: treść wiadomości, która zostaje zainicjowana przez partnera w panelu. Pamiętaj, że błąd powoduje nierozliczenie płatności!
		*/
		'text' => 'MSMS.MONETA',
		);
		
	$data[] = array("netto" => 2.00,"number" => 72480,"product" => "1");
	$data[] = array("netto" => 4.00,"number" => 74480,"product" => "2");
	$data[] = array("netto" => 6.00,"number" => 76480,"product" => "3");
	$data[] = array("netto" => 14.00,"number" => 91400,"product" => "7");
	$data[] = array("netto" => 20.00,"number" => 92022,"product" => "10");
	$data[] = array("netto" => 25.00,"number" => 92521,"product" => "12");
	
	/* 
		Weryfikujemy, czy formularz został wysłany
	*/
	if (isset($_POST['send']) && isset($_POST['code'])) {
		
		$code = addslashes($_POST['code']);
		
		/* 
			Weryfikujemy poprawność kodu
		*/
		if (preg_match("/^[A-Za-z0-9]{8}$/", $code)) {
			
			$a = array();
			$b = array();
			
			foreach ($data as $cfg) {
				array_push($a, $cfg['number']);
				$b[$cfg['number']] = $cfg['product'];
			}
			
			/*
				Łączymy się z serwerem MicroSMS
			*/
			$api = @file_get_contents("http://microsms.pl/api/v2/multi.php?userid=" . $settings['userid'] . "&code=" . $code . '&serviceid=' . $settings['serviceid']);
	
			//print_r($api);
			
			/* 
				Jeśli wystąpi problem z połączeniem, skrypt wyświetli błąd.
			*/
			if (!isset($api)) {
				$errormsg = 'Nie można nawiązać połączenia z serwerem płatności.';
			} else {
				/*
					Dekodujemy odpowiedź serwera do formatu json
				*/
				$api = json_decode($api);
			
				/* 
					Sprawdzamy czy odpowiedź na pewno jest w formacie json
				*/
				if (!is_object($api)) {
					$errormsg = 'Nie można odczytać informacji o płatności.';
				} else if (isset($api->error) && $api->error) {
					$errormsg = 'Kod błędu: ' . $api->error->errorCode . ' - ' . $api->error->message;
				} else if ($api->connect == FALSE) {
					$errormsg = 'Kod błędu: ' . $api->data->errorCode . ' - ' . $api->data->message;
				} else if (!isset($b[$api->data->number])) {
					$errormsg = 'Przesłany kod jest nieprawidłowy, spróbuj ponownie.';
				}
			}
			
			if (!isset($errormsg) && isset($api->connect) && $api->connect == TRUE) {
				/*
					Jeśli kod jest prawidłowy, wydajemy produkt
				*/
				if ($api->data->status == 1) {
					$okmsg = 'Transakcja przebiegła pomyślnie!</br>Zakupiona ilość monet: ' . $b[$api->data->number];
					
					try{
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
										$monety = $w['monety'] + $b[$api->data->number];
										if($result = @$connect->query(sprintf('UPDATE accounts SET monety="'.$monety.'" WHERE user="'.$_SESSION['user'].'" AND email="'.$_SESSION['useremail'].'"'))){
											$full_name='BezGrosika.pl';
											$from = $full_name.'<admin@bezgrosika.pl>';
											$subject = 'Zakupiłeś monety';
											$message = '<span style="color: red; text-shadow: 1px 1px black; font-size: 30px;"><i>BezGrosika</span></br><span style="font-size: 15px;">Ogłoszenia dla Ciebie</i></span>
											</br></br>Cześć '.$_SESSION['user'].'! </br>Dziękujemy za zakup monet w naszym serwisie!
											</br>Ilość zakupionych przez Ciebie monet: '.$b[$api->data->number].'
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
											if(mail($_SESSION['useremail'], $subject, $message, $headers, "-f ".$from)){
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
					
				} else {
					$errormsg = 'Przesłany kod jest nieprawidłowy, spróbuj ponownie.';
				}
			}

		} else {
			$errormsg = 'Przesłany kod jest nieprawidłowy, przepisz go ponownie.';
		}
	}

?>
<!DOCTYPE html>
<html lang="pl">
  <head>
	<title>BezGrosika.pl - płatność SMS</title>
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
                <h1>Płatność SMS</h1>
                <p class="mb-0">Doładowanie monet przez SMS</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  

	<div class="site-section bg-light">
      <div class="container">

        <div style="background-color: white; padding: 15px; border-radius: 5px;">
			<h3 style="color: #30e3ca;">Doładowanie monet przez SMS</h3>
			<br>
			<table id="table">
				<tr class="header">
					<td style="font-size: calc(12px + 0.3vw);">Cena:</td>
					<td style="font-size: calc(12px + 0.3vw);">Numer:</td>
					<td style="font-size: calc(12px + 0.3vw);">Treść:</td>
					<td style="font-size: calc(12px + 0.3vw);">Ilość monet:</td>
				</tr>
				<?php foreach($data as $var) { ?>
				<tr>
					<td style="font-size: calc(10px + 0.3vw);"><?php echo number_format($var['netto'] * ( 1 + 23 / 100 ), 2); ?> PLN z VAT</td>
					<td style="font-size: calc(10px + 0.3vw);"><?php echo $var['number']; ?></td>
					<td style="font-size: calc(10px + 0.3vw);"><?php echo $settings['text']; ?></td>
					<td style="font-size: calc(10px + 0.3vw);"><?php echo $var['product']; ?></td>
				</tr>
				<?php } ?>
			</table>
			</br>
			<?php if(isset($okmsg)) { ?><div class="msg ok"><?php echo $okmsg; ?></div><?php } ?>
			<?php if(isset($errormsg)) { ?><div class="msg error"><?php echo $errormsg; ?></div><?php } ?>
			
			<form method="post">
				<input type="hidden" name="send" value="" />   
				<input name="code" placeholder="Kod sms" type="text" class="filters-input-select"/>
				<button class="filters-input-btn" type="submit">Sprawdź kod</button>
			</form>
			<br>
			<div style="font-size: 14px;">
			Korzystanie z serwisu jest jednoznaczne z akceptacją <a href="regulamin.pdf" target="_blank">regulaminu BezGrosika.pl</a> oraz <a href="https://microsms.pl/kernel/Mails/files/regulaminmicrosms25022016.pdf" target="_blank">regulaminu dostawcy płatności.</a><br/>
			Jeśli nie dostałeś kodu zwrotnego w ciągu 30 minut skorzystaj z <a href="https://microsms.pl/cms/complaint.php" target="_blank">formularza reklamacyjnego</a>.<br/><br/>
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