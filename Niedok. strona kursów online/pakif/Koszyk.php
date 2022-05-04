<?php
	include_once('head.php');
	head();
?>
		<title>Pakif - Twój koszyk</title>
		<meta name="keywords" content="Pakif, Koszyk"/>
		<meta name="description" content="Tutaj będą widoczne Twoje zakupy"/>
	</head>
	

    <?php
		include_once('header.php');
		headerwrapper();
	?>
	
	<main role="main" class="flex-shrink-0" style="margin-top: -250px;">		
		<div class="container">
			<h4 style="text-left"><span style="color: #0077be; font-size:35px;">||</span> Twój koszyk</h4>
			
			
			
			<?php
				
				if(isset($_GET['delall'])){
					if($_GET['delall'] == 'all'){
						unset($_SESSION['koszyk']);
						echo '<script>location.replace("Koszyk.php")</script>';
					}
				}
				
				//obrazek id tytul cena
				
				if(isset($_GET['id'])){
					if(is_numeric($_GET['id'])){							
							
						require_once('php/connect.php');

						try{
							$zapytanie = 'SELECT * FROM kursy WHERE id='.$_GET['id'].'';
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
											
											if(isset($_GET['type'])){
												if($_GET['type'] == 'add'){
													
													if(isset($_SESSION['koszyk'])){
														foreach($_SESSION['koszyk'] as $key=>$val) {
															if($w['id'] == $val['id']){
																$ok = false;
															}
														}
													}
													if(!isset($ok)){
														$item1 = array(
														'id'=>''.$w['id'].'',
														'obrazek'=>''.$w['Obrazek'].'',
														'nazwa'=>''.$w['Tytul'].'',
														'opis'=>''.$w['Opis'].'',
														'cena'=>''.$w['Cena']);
														dodaj($item1);
													}
												}
												
												if($_GET['type'] == 'del'){
													foreach($_SESSION['koszyk'] as $key=>$val) {
														if($w['id'] == $val['id']){
															usun($key);
														}
													}
												}
											}
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
					}
				}
				

				
				function dodaj($item) {
					// Sprawdzenie czy nie zawiera
					$_SESSION['koszyk'][] = $item;
					echo '<script>location.replace("Koszyk.php")</script>';
				}

				function usun($id) {
					unset($_SESSION['koszyk'][$id]);
					if(empty($_SESSION['koszyk'])){
						unset($_SESSION['koszyk']);
					}
					echo '<script>location.replace("Koszyk.php")</script>';
				}

				unset($_SESSION['cena']);
				if(isset($_SESSION['koszyk'])){
					foreach($_SESSION['koszyk'] as $key=>$val) {
						if(!isset($_SESSION['cena'])){
							$_SESSION['cena'] = 0;
						}
						$_SESSION['cena'] = $val['cena'] + $_SESSION['cena'];
						//echo 'IdKEY: '.$key.',
						//Id: '.$val['id'].',
						//Obrazek: '.$val['obrazek'].',
						//Nazwa: '.$val['nazwa'].',
						//Opis: '.$val['opis'].',
						//Cena: '.$val['cena']."\r\n";
						
						
						echo '
						<div class="col-lg-12" style="margin-top: 25px; padding-bottom: 25px;">
							<div class="d-sm-flex listing">
								  <img src="obrazy/'.$val['obrazek'].'" class="img d-block img-fluid img-responsive" style="background-image: url(\'obrazy/'.$val['obrazek'].'\');"/>
								  <div style="min-height: 170px;">
									<h4>'.$val['nazwa'].'</h4>
									<p>
										<form method="GET" action="koszyk.php" style="max-width: 130px; margin-top: 25px;">
											<input type="submit" class="btn btn-primary btn-block rounded" value="Usuń z koszyka">
											<input type="hidden" name="id" value="'.$val['id'].'">
											<input type="hidden" name="type" value="del">
										</form>
									</p>
								  </div>
							</div>
							<div style="text-align: right;">
								Cena kursu <b>'.$val['cena'].' PLN</b>
							</div>
						</div>
						<hr>
						';
					}
					
					echo '<div style="text-align: right; padding-top: 50px; padding-bottom: 50px;">Łączna cena kursów <b>'.$_SESSION['cena'].' PLN</b></div>';
					
					echo '
					<center>
						<div class="row" style="padding-bottom: 50px;">
							<div class="col">
								<a href="" class="btn btn-primary btn-block rounded" style="max-width: 250px;">Dodaj kursy</a>
							</div>
							<div class="col">
								<form method="GET" action="Koszyk.php" style="max-width: 250px;">
									<button type="submit" class="btn btn-primary btn-block rounded" value="Wyczyść koszyk">Wyczyść koszyk</button>
									<input type="hidden" name="delall" value="all">
								</form>
							</div>
							<div class="col">
								<form method="POST" action="Dane-do-platnosci.php" style="max-width: 250px;">
									<button type="submit" class="btn btn-primary btn-block rounded" value="Opłać zamówienie">Opłać zamówienie</button>
									<input type="hidden" name="platnosc" value="1">
								</form>
								
							</div>
						</div>
						</center>';
						
				}else{
					echo '<br><p>Twój koszyk jest pusty</p>
					<a href="" class="btn btn-primary btn-block rounded" style="max-width: 250px;">Dodaj kursy</a>';
				}
				
				//unset($_SESSION['koszyk']);
			?>
			
		</div>
		
	</main>

	<?php
		include_once('footer.php');
		footer();
	?>