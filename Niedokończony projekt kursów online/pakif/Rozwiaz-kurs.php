<?php
if(isset($_POST['Rozwiazujacy'])){
	$email = 'kontakt@pakif.pl';
	$full_name='Pakif.pl';
	$from = $full_name.'<kontakt@pakif.pl>';
	$subject = 'Rozwiązanie kursu od '.$_POST['Rozwiazujacy'].'(Login: '.$_POST['RozwiazujacyLogin'].')';
	$message = '
		<span style="font-size: 18px;">
			Rozwiązanie kursu od '.$_POST['Rozwiazujacy'].'(Login: '.$_POST['RozwiazujacyLogin'].')<br>
			Email rozwiązującego kurs: '.$_POST['RozwiazujacyEmail'].'<br><br>
			<b>Rozwiązywany kurs:</b> '.$_POST['TytulKursu'].'<br>
			<br><br>
			<b>Odpowiedzi:</b><br>';
				for($i=1; $i <=10; $i++){
					$message = $message.'<br>'.$i.') '.$_POST['Odp'.$i].'<br>';
				}
			$message = $message.'<hr><br>
			 <p>Wiadomość wysyłana automatycznie, prosimy na nią nie odpowiadać.</p>
		</span>
	';

	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $from . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	if(mail($email, $subject, $message, $headers, "-f ".$from)){
		include_once('head.php');
		head();
		include_once('header.php');
		headerwrapper();
		echo '
		<main role="main" class="flex-shrink-0" style="margin-top: -230px; padding-bottom: 150px;">
			<div class="container">
				<center>
					<h5>Wysłano odpowiedzi kursu</h5><br>
					<h4>Odpowiedzi odsyłamy na adres email</h4>
				</center>
			</div>
		</main>
		';
		include_once('footer.php');
		footer();
		exit();
		
	}
}


	include_once('head.php');
	head();
	
	if(!isset($_SESSION['uzytkownik'])){
		header('Location: Logowanie.php');
	}
?>
		<title>Pakif - Twoje kursy</title>
	</head>

	
    <?php
		include_once('header.php');
		headerwrapper();
	?>
	
	<main role="main" class="flex-shrink-0" style="margin-top: -230px; padding-bottom: 150px;">
		<div class="container">

			<?php
			
			
			require_once('php/connect.php');
			try{
				$zapytanie = 'SELECT * FROM konta WHERE user="'.$_SESSION['uzytkownik'].'" AND login="'.$_SESSION['uzytkowniklogin'].'"';
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
								$kursy = $w['kursy']; // Kursy danego użytkownika
							}
						}
					}
				}$connect->close();
			}
			catch(Exception $error){
				echo '<div style="color: red; font-size: 15px;">Przepraszamy wystąpił błąd, prosimy spróbować ponownie.</div>';
				//$_SERVER['HTTP_REFERER']
				//echo '</br>Informacja developerska:</br>'.$error;
			}
			
			
			if(isset($_POST['kurs'])){
				if(strpos($kursy, $_POST['kurs']) !== false) {
					try{
						$zapytanie = 'SELECT * FROM pytania WHERE id="'.$_POST['kurs'].'"';
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
							$zapytanie1 = 'SELECT Tytul FROM kursy WHERE id="'.$_POST['kurs'].'"';
							if($result = $connect->query($zapytanie1)){
								$wyniki = $result->num_rows;
								if($wyniki>0){
									for($r = 1; $r <= $wyniki; $r++){
										$w = $result->fetch_assoc();
										$Tytul = $w['Tytul'];
									}
								}
							}
							
							if($result = $connect->query($zapytanie)){
								$wyniki = $result->num_rows;
								echo '<h3 style="text-left"><span style="color: #0077be; font-size:35px;">||</span> Rozwiązywanie kursu: <br><h4>'.$Tytul.'</h4></h3>';
								echo '<form method="POST">';
								if($wyniki>0){
									for($r = 1; $r <= $wyniki; $r++){
										$w = $result->fetch_assoc();
										
										for($i=1; $i <=10; $i++){
											echo '<div style="margin-top: 100px;">';
												echo '<h5>'.$i.') '.$w['pytanie'.$i].'</h5>';
												echo '<textarea style="min-width: 100%; min-height: 100px;" required name="Odp'.$i.'" placeholder="Wpisz odpowiedź do pytania '.$i.'."></textarea>';
											echo '</div>';
										}
									}
								}
								echo '
									<div style="margin-top: 50px;">
										<label style="cursor: pointer;"><input type="checkbox" required> Kurs jest gotowy do wysłania</label>
										<input type="submit" class="btn btn-primary btn-block rounded" value="Wyślij odpowiedzi">
										
										<input type="hidden" name="Rozwiazujacy" value="'.$_SESSION['uzytkownik'].'">
										<input type="hidden" name="RozwiazujacyLogin" value="'.$_SESSION['uzytkowniklogin'].'">
										<input type="hidden" name="RozwiazujacyEmail" value="'.$_SESSION['uzytkownikemail'].'">
										<input type="hidden" name="TytulKursu" value="'.$Tytul.'">
									</div>
								</form>
								';
							}
						}$connect->close();
					}
					catch(Exception $error){
						echo '<div style="color: red; font-size: 15px;">Przepraszamy wystąpił błąd, prosimy spróbować ponownie.</div>';
						//$_SERVER['HTTP_REFERER']
						//echo '</br>Informacja developerska:</br>'.$error;
					}
					
				}else{
					header('Location: Konto.php');
				}
			}			
			?>
			
		</div>
		
	</main>

	<?php
		include_once('footer.php');
		footer();
	?>