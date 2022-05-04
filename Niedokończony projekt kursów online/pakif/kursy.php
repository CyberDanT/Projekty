<?php
	include_once('head.php');
	head();
	
	require_once('php/connect.php');
	
	// sprawdzić czy ID nie jest czasem wstrzykiem mysql
	if(!is_numeric($_GET['id'])){
		echo 'Przepraszamy wystąpił błąd!';
		exit();
	}
	$zapytanie=sprintf('SELECT * FROM kursy WHERE id='.$_GET['id'].'');
	try{
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
						 $id = $w['id'];
						 $obrazek = $w['Obrazek'];
						 $tytul = $w['Tytul'];
						 $opis = $w['Opis'];
						 $faq = $w['Faq'];
						 $gwiazdki = $w['Gwiazdki'];
						 $popularnosc = $w['Popularnosc'];
						 $opinieint = $w['OpinieInt'];
						 $opinietext = $w['OpinieText'];
						 $cena = $w['Cena'];
						 $cena = $w['Cena'];
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
?>
		<title><?php echo $tytul ?> w Pakif.pl</title>
		<meta name="description" content="<?php echo $opis; ?>"/>
	</head>


    <?php
		include_once('header.php');
		headerwrapper();
	?>

	<main role="main" class="flex-shrink-0" style="margin-top: -250px;">
		<div class="container">
						
			<div class="row">
				<div class="col-md-4">
					<img src="obrazy/<?php echo $obrazek; ?>" class="text-left img-fluid img-responsive img-thumbnail rounded"/>
				</div>
				<div class="col">
					<h3 style="text-left"><span style="color: #0077be; font-size:35px;">||</span> <?php echo $tytul; ?></h3>
					
					<?php
						if(isset($_SESSION['koszyk'])){
							if(array_search(''.$id.'', array_column($_SESSION['koszyk'], 'id'))){
								echo '
								<form method="GET" action="koszyk.php" style="max-width: 180px; margin-top: 25px;">
									<input type="submit" class="btn btn-primary btn-block rounded" value="Usuń z koszyka">
									<input type="hidden" name="id" value="'.$id.'">
									<input type="hidden" name="type" value="del">
								</form>';
							}else{
								echo '
								<form method="GET" action="koszyk.php" style="max-width: 180px; margin-top: 25px;">
									<input type="submit" class="btn btn-primary btn-block rounded" value="Dodaj do koszyka">
									<input type="hidden" name="id" value="'.$id.'">
									<input type="hidden" name="type" value="add">
								</form>';
							}
						}else{
							echo '
							<form method="GET" action="koszyk.php" style="max-width: 180px; margin-top: 25px;">
								<input type="submit" class="btn btn-primary btn-block rounded" value="Dodaj do koszyka">
								<input type="hidden" name="id" value="'.$id.'">
								<input type="hidden" name="type" value="add">
							</form>';
						}
					?>
					
					<br><span style="font-size: 17px;">Ten kurs kosztuje tylko <b><?php echo $cena; ?> PLN</b><span><br>
					
					<hr>
					
					<div class="row" style="font-size: 15px;">
						<div class="col-md-4">
						<?php
							$liczby = $gwiazdki;
							$expl = explode(',', $liczby);
							 
							$suma = 0;
							$liczb = 0;
							 
							for ($i=0, $count=count($expl); $i<$count; $i++) {
								$suma += (int)$expl[$i];
								$liczb++;
							}
							 
							$gwiazdki = $suma/$liczb;
							$gwiazdki = round($gwiazdki, 0);
						
						
							if($gwiazdki == 0){
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
							}
							if($gwiazdki == 1){
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
							}
							if($gwiazdki == 2){
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
							}
							if($gwiazdki == 3){
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
							}
							if($gwiazdki == 4){
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
							}
							if($gwiazdki == 5){
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
								echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';	
							}
						?>	
						</div>
						<div class="col-md-4">
							<span>Popularność kursu: <b><?php echo $popularnosc; ?>%</b></span>
						</div>
						
						<div class="col-md-4">
							<span>Opinie: <b><?php echo $opinieint; ?></b></span>
						</div>
						
					</div>

				</div>
					
			</div>
			
			<br><p><?php echo $opis; ?></p>
			
			<div class="row" style="margin-top: 80px;">
				<div class="col-md-12">
					<h4 style="font-size: 21px;"><span style="color: #0077be; font-size:35px;">|</span> FAQ - podstawowe informacje</h4>
					<hr>
					<p><?php echo $faq; ?></p>
				</div>
				
				<div class="col-md-12" style="margin-top: 80px;">
					<h4 style="font-size: 21px;"><span style="color: #0077be; font-size:35px;">|</span> Opinie absolwentów</h4>
					<hr>
					<p>
						<?php							
							$expl = explode(',=,', $opinietext);
							foreach ($expl as $item) {
								echo "<div>$item</div><br>";
							}
						?>
					</p>
				</div>
			</div>
			
		</div>

	</main>

	<?php
		include_once('footer.php');
		footer();
	?>
