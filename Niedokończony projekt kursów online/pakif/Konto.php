<?php
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
			<h3 style="text-left"><span style="color: #0077be; font-size:35px;">||</span> Twoje kursy</h3>
			
			<?php
			// $_SESSION['uzytkownik'] = $w['user'];
			// $_SESSION['uzytkowniklogin'] = $w['login'];
			
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
								$zkursy = $w['kursyzdane']; // Kursy zdane danego użytkownika
							}
						}
					}
					
					$kursy = str_replace(',', '" OR id="', $kursy);
					$zapytanie = 'SELECT * FROM kursy WHERE id="'.$kursy.'"';
					if($result = $connect->query($zapytanie)){
						$wyniki = $result->num_rows;
						if($wyniki>0){
							for($r = 1; $r <= $wyniki; $r++){
								$w = $result->fetch_assoc();
								echo '
									<div class="col-lg-12" style="margin-top: 25px; padding-bottom: 25px;">
										<div class="d-sm-flex listing">
											  <img src="obrazy/'.$w['Obrazek'].'" class="img d-block img-fluid img-responsive" style="background-image: url(\'obrazy/'.$w['Obrazek'].'\');"/>
											  <div style="min-height: 170px;">
												<h4>'.$w['Tytul'].'</h4>
												<p>
													<form method="POST" action="Rozwiaz-kurs.php" style="max-width: 130px; margin-top: 25px;">
														<input type="submit" class="btn btn-primary btn-block rounded" value="Rozwiąż kurs">
														<input type="hidden" name="kurs" value="'.$w['id'].'">
													</form>
												</p>
											  </div>
										</div>
										
										<div style="text-align: right;">
											
										</div>
										
									</div>
									<hr>
									';
							}
						}
					}
					
					
				//	Wybranie z bazy tylko te kursy co ma user
				//	Wyswietlenie tego co ma user
					
					
					
					
				}$connect->close();
			}
			catch(Exception $error){
				echo '<div style="color: red; font-size: 15px;">Przepraszamy wystąpił błąd, prosimy spróbować ponownie.</div>';
				//$_SERVER['HTTP_REFERER']
				//echo '</br>Informacja developerska:</br>'.$error;
			}
			

			
			?>
			
		</div>
		
	</main>

	<?php
		include_once('footer.php');
		footer();
	?>