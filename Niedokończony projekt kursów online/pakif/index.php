<?php
	include_once('head.php');
	head();
?>
		<title>Pakif - kursy online</title>
		<meta name="keywords" content="Pakif, strona główna, kursy online"/>
		<meta name="description" content="Zacznij kursy z nami! Kursy online na Pakif.pl"/>
	</head>


    <?php
		include_once('header.php');
		headerwrapper();
	?>

	<main role="main" class="flex-shrink-0" style="margin-top: -280px;">
		<div class="container">
			<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				  <li data-target="#myCarousel" data-slide-to="0" class="active" style="height: 10px; width: 10px; border-radius: 100%;"></li>
				  <li data-target="#myCarousel" data-slide-to="1" style="height: 10px; width: 10px; border-radius: 100%;"></li>
				  <li data-target="#myCarousel" data-slide-to="2" style="height: 10px; width: 10px; border-radius: 100%;"></li>
				</ol>
			  <div class="carousel-inner">
				<div class="carousel-item active">
				  <img src="images/image-1.jpg" class="d-block w-100" style="max-height: 350px;" alt="Pierwszy slajd strony głównej kursy Pakif">
				  <!-- <div class="carousel-caption d-none d-md-block">
					<h5>...</h5>
					<p>...</p>
				  </div> -->
				</div>
				<div class="carousel-item">
				  <img src="images/image-2.jpg" class="d-block w-100" style="max-height: 350px;" alt="Drugi slajd strony głównej kursy Pakif">
				  <!-- <div class="carousel-caption d-none d-md-block">
					<h5>...</h5>
					<p>...</p>
				  </div> -->
				</div>
				<div class="carousel-item">
				  <img src="images/image-3.jpg" class="d-block w-100" style="max-height: 350px;" alt="Trzeci slajd strony głównej kursy Pakif">
				  <!-- <div class="carousel-caption d-none d-md-block">
					<h5>...</h5>
					<p>...</p>
				  </div> -->
				</div>
			  </div>
			  

			  
			</div>

			<div style="padding-top: 100px;">

				<MARQUEE BEHAVIOR=ALTERNATE TRUESPEED SCROLLAMOUNT=1 SCROLLDELAY=30 style="height: 150px;">
					<img class="blokimg" src="loga/logo_1.png">
					<img class="blokimg" src="loga/logo_2.png">
					<img class="blokimg" src="loga/logo_3.png">
					<img class="blokimg" src="loga/logo_4.png">
					<img class="blokimg" src="loga/logo_5.png">
					<img class="blokimg" src="loga/logo_6.png">
					<img class="blokimg" src="loga/logo_7.png">
					<img class="blokimg" src="loga/logo_8.png">
					<img class="blokimg" src="loga/logo_9.png">
				</MARQUEE>



				<div class="row">
					<div class="col-lg-3" style="max-height: 170px;">
						<div style="color: lightgray; text-shadow: 1px 1px black; width: 50px; height: 50px; font-size: 22px; display: inline-block;">
							<span class="icon-users" style="position: relative; left: 20px;"></span>
							<span class="icon-search" style="font-size: 80px; position: relative; top: -55px;"></span>
						</div>
						<span style="position: relative; top: -115px; left: 70px;">
							<h5>WYBIERZ KURS<br>
							DLA SIEBIE</h5>
						</span>
					</div>

					<div class="col-lg-9">
						<div class="form-search-wrap">
						  <form method="GET" class="formindex">
							<div class="row align-items-center">
							  <div class="col-lg-12 mb-2 mb-xl-0 col-xl-3">
								<input type="text" name="s" class="form-control rounded" style="min-width: 200px;" placeholder="Szukaj kursu...">
							  </div>

							 <div class="col-lg-12 mb-2 mb-xl-0 col-xl-3">
								
								  <select class="custom-select mr-sm-2" style="min-width: 200px;" id="inlineFormCustomSelect" name="s2">
									<option selected value="0">Sposób sortowania...</option>
									<option value="1">Sortuj po nazwie</option>
									<option value="2">Sortuj po cenie</option>
									<option value="3">Sortuj po popularności</option>
									<option value="4">Sortuj po ilości opini</option>
								  </select>
								
							  </div>
							  
							  
							  <div class="col-lg-12 mb-2 mb-xl-0 col-xl-3">

								  <select class="custom-select mr-sm-2" style="min-width: 200px;" id="inlineFormCustomSelect" name="s3">
									<option selected value="0">Kolejność sortowania...</option>
									<option value="1">Sortuj rosnąco</option>
									<option value="2">Sortuj malejąco</option>
								  </select>
								
							  </div>


							  <div class="col-lg-12 col-xl-2 ml-auto text-right">
								<input type="submit" class="btn btn-primary btn-block rounded" value="Szukaj">
							  </div>
							</div>
						  </form>
						  <hr>
						</div>
					</div>
				</div>
				

				<h4>Poznaj nasze kursy</h4>

				<div class="row">

				  <?php
					
				    $zapytanie = 'SELECT * FROM kursy';
					$zapytanie1 = '';

					
					if(isset($_GET['s'])){
						if(strrpos($_GET['s'], "=")){
							unset($_GET['s']);
							exit();
						}
						if(strrpos($_GET['s'], "-")){
							unset($_GET['s']);
							exit();
						}
					}
					if(isset($_GET['s']) && $_GET['s'] !=''){
						$zapytanie1 = ' WHERE Tytul LIKE "%'.$_GET['s'].'%"';
					}
					
					$zapytanie = $zapytanie.$zapytanie1;
	

					
					if(@$_GET['s2']){
						// Sortowanie po nazwie
						if($_GET['s2'] == "1"){
							if($_GET['s3'] == "1"){				
								$zapytanie1 = $zapytanie.' ORDER BY Tytul ASC';
							}else{
								$zapytanie1 = $zapytanie.' ORDER BY Tytul DESC';
							}
						}
						
						// Sortowanie po cenie
						if($_GET['s2'] == "2"){
							if($_GET['s3'] == "1"){
								$zapytanie1 = $zapytanie.' ORDER BY Cena ASC';
							}else{
								$zapytanie1 = $zapytanie.' ORDER BY Cena DESC';
							}
						}
						
						// Sortowanie po popularnosci
						if($_GET['s2'] == "3"){
							if($_GET['s3'] == "1"){
								$zapytanie1 = $zapytanie.' ORDER BY Popularnosc ASC';
							}else{
								$zapytanie1 = $zapytanie.' ORDER BY Popularnosc DESC';
							}
						}
						
						// Sortowanie po opiniach
						if($_GET['s2'] == "4"){
							if($_GET['s3'] == "1"){
								$zapytanie1 = $zapytanie.' ORDER BY OpinieInt ASC';
							}else{
								$zapytanie1 = $zapytanie.' ORDER BY OpinieInt DESC';
							}
						}
						
						$zapytanie = $zapytanie1;
						
					}
					
					function cut($tekst,$ile,$kursid,$tekst_po_zmianie){
					   $tekst = strip_tags($tekst);
					   if (strlen($tekst) > $ile) {
						  $tekst=mb_substr($tekst, 0, $ile);
						  for ($a=strlen($tekst)-1;$a>=0;$a--) {
							 if ($tekst[$a]==" ") {
								$tekst=mb_substr($tekst, 0, $a).'... <a href="kursy.php?id='.$kursid.'&kurs='.$tekst_po_zmianie.'">czytaj więcej</a>';
								break;
							 };
						  };
					   };
					return $tekst;
					}
					require_once('php/connect.php');

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
										 $tekst=$w['Opis'];
										 $tekst_po_zmianie = str_replace(" ", "-", $w['Tytul']);
										 
										echo '<div class="col-lg-12" style="margin-top: 25px; margin-bottom: 25px;">
										<div class="d-block d-md-flex listing">
											  <a href="kursy.php?id='.$w['id'].'&kurs='.$tekst_po_zmianie.'" class="img d-block" style="background-image: url(\'obrazy/'.$w['Obrazek'].'\');"></a>
											  <div style="min-height: 170px;">
												<h4><a href="kursy.php?id='.$w['id'].'&kurs='.$tekst_po_zmianie.'" class="link">'.$w['Tytul'].'</a></h4>
												<p>';
												echo cut($tekst, 250,$w['id'],$tekst_po_zmianie);
												echo '</p>
											  </div>
											</div>

											<div style="font-size: 13px; text-align: right;">
											<div style="display: inline-block; margin-right: 50px;">
											';
	
											$liczby = $w['Gwiazdki'];
											$expl = explode(',', $liczby);
											 
											$suma = 0;
											$liczb = 0;
											 
											for ($i=0, $count=count($expl); $i<$count; $i++) {
												$suma += (int)$expl[$i];
												$liczb++;
											}
											 
											$w['Gwiazdki'] = $suma/$liczb;
											$w['Gwiazdki'] = round($w['Gwiazdki'], 0);

												if($w['Gwiazdki'] == 0){
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
												}
												if($w['Gwiazdki'] == 1){
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
												}
												if($w['Gwiazdki'] == 2){
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
												}
												if($w['Gwiazdki'] == 3){
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
												}
												if($w['Gwiazdki'] == 4){
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: lightgray; text-shadow: 1px 1px #CCC;"></span>';
												}
												if($w['Gwiazdki'] == 5){
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';
													echo '<span class="icon-star" style="color: orange; text-shadow: 1px 1px yellow;"></span>';	
												}
							
												echo '</div>
												<div style="display: inline-block; margin-right: 50px;"><span>Popularność kursu <b>'.$w['Popularnosc'].'%</b></span></div>
												<div style="display: inline-block; margin-right: 50px;"><span>Cena kursu <b>'.$w['Cena'].' PLN</b></span></div>
											</div>

										</div>
										<hr class="col-12" />';
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
					echo '<div class="container" style="text-align: center; padding-bottom: 15px;">Brak więcej wyników spełniających kryteria.</div>
					<hr class="col-12" />';
				  ?>

			  </div>

			</div>





		</div>



		</div>
	</main>

	<?php
		include_once('footer.php');
		footer();
	?>
