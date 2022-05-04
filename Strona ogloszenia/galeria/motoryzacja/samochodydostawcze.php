<?php
	session_start();
	require_once("../php/connect.php");
	$db_name = $administratorbazy."motoryzacja";
	$count = 15;
	include_once("../footer.php");
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Ogłoszenia BezGrosika.PL - samochody dostawcze</title>
		<meta name="description" content="Motoryzacja, samochody dostawcze, nowe i używane dostawcze na sprzedaż. Sprzedam, kupię, zamienię. Volkswagen - Iveco - Renault - Ford - Fiat - Citroen - Mercedes..."/>
		<meta name="keywords" content="ogłoszenia, BezGrosika, .pl, sprzedam, sprzedam samochód dostawczy, bez grosika, kupie, bez grosika, volvo, volkswagen, citroen, samochód, dostawczy, dla domu"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,=1"/>
		<link rel="shortcut icon" href="../img/grosiky.png">
		<link rel ="stylesheet" href="../style.css" type="text/css"/>
	</head>
	<body>
	
	

		<div id="menu">
			<div id="nav">
				<div class="square">
					<div id="logo">
							<a href="../" title="Do strony głównej"><img src="../img/grosiky.png" id="logopng"><span id="logotit">BezGrosika.PL</span></br>
							<p id="logostyle">Ogłoszenia dla Ciebie</p></a>
					</div>
				</div>
				
				<center>
					<div id="search">
						<div id="search1">
							<span style="font-size: 40px; color: white; text-shadow: 1px 1px black;">Samochody dostawcze</span>
						</div>
					</div>
				</center>

				<div class="square" style="min-width: 200px; height: 90px;">
					<div id="avctext">
						<a href="../mojekonto.php" class="avtext" style="cursor: pointer;">
							<?php
								if(isset($_SESSION['user'])){
									echo $_SESSION['user'];
								}else{
									echo "Moje konto";
								}
							?>
						</a>
						</br></br>
						<a class="avtext" style="cursor: pointer;">
							<?php
							if(isset($_SESSION['logged'])){
								echo '<a href="../logout.php">Wyloguj się';
							}else{
								echo '<a href="../register.php">Zarejestruj się';
							}
							?>
						</a>
					</div>				

					<div id="avatar">
					</div>
						<form action="../dodaj-ogloszenie.php">
							<input type="submit" id="buttonadd" value="Dodaj ogłoszenie"></input>
						</form>
				</div>
			</div>
		</div>
		<div id="content">
			<div id="wyroznione1">
				<div>Miejsce na Twoją reklamę</div>
			</div>
			<div id="main" style="margin-top: -40px;">
				<div style="margin-left: auto; margin-right: auto;">
					<form id="myForm" method="get"> 
						<div class="inputsearchblock">
							<div>
								<!-- <input type="hidden" name="page" disabled value="0"> -->
								<div><input <?php
									if(@isset($_GET['page'])){ echo 'value ="'.$_GET['page'].'"';} ?> class="inputsearch" type="hidden" name="page"></div>
								<div><select id="Marka" class="inputsearch" name="Marka"> 
									<option <?php  if(@$_GET['Marka'] == '0'){ echo 'selected'; } ?> class="searchopt" value="0">Marka</option>
									<option <?php  if(@$_GET['Marka'] == 'Citroen'){ echo 'selected'; } ?> class="searchopt" value="Citroen">Citroen</option>
									<option <?php  if(@$_GET['Marka'] == 'Fiat'){ echo 'selected'; } ?> class="searchopt" value="Fiat">Fiat</option>
									<option <?php  if(@$_GET['Marka'] == 'Ford'){ echo 'selected'; } ?> class="searchopt" value="Ford">Ford</option>								
									<option <?php  if(@$_GET['Marka'] == 'Iveco'){ echo 'selected'; } ?> class="searchopt" value="Iveco">Iveco</option>
									<option <?php  if(@$_GET['Marka'] == 'Mercedes'){ echo 'selected'; } ?> class="searchopt" value="Mercedes">Mercedes</option>
									<option <?php  if(@$_GET['Marka'] == 'Opel'){ echo 'selected'; } ?> class="searchopt" value="Opel">Opel</option>
									<option <?php  if(@$_GET['Marka'] == 'Peugeot'){ echo 'selected'; } ?> class="searchopt" value="Peugeot">Peugeot</option>
									<option <?php  if(@$_GET['Marka'] == 'Renault'){ echo 'selected'; } ?> class="searchopt" value="Renault">Renault</option>
									<option <?php  if(@$_GET['Marka'] == 'Volkswagen'){ echo 'selected'; } ?> class="searchopt" value="Volkswagen">Volkswagen</option>
									<option <?php  if(@$_GET['Marka'] == 'Inna marka'){ echo 'selected'; } ?> class="searchopt" value="Inna marka">Inna marka</option>
								</select></div>

								<div>
									<select class="inputsearch" id="Paliwo" name="Paliwo">
										<option <?php if(@$_GET['Paliwo'] == '0'){ echo 'selected'; } ?> class="searchopt" value="0">Paliwo</option>
										<option <?php if(@$_GET['Paliwo'] == 'Benzyna'){ echo 'selected'; } ?> class="searchopt" value="Benzyna">Benzyna</option>
										<option <?php if(@$_GET['Paliwo'] == 'Benzyna+LPG'){ echo 'selected'; } ?> class="searchopt" value="Benzyna+LPG">Benzyna+LPG</option>
										<option <?php if(@$_GET['Paliwo'] == 'Diesel'){ echo 'selected'; } ?> class="searchopt" value="Diesel">Diesel</option>
										<option <?php if(@$_GET['Paliwo'] == 'Elektryczny'){ echo 'selected'; } ?> class="searchopt" value="Elektryczny">Elektryczny</option>
										<option <?php if(@$_GET['Paliwo'] == 'Hybryda(Diesel)'){ echo 'selected'; } ?> class="searchopt" value="Hybryda(Diesel)">Hybryda(Diesel)</option>
										<option <?php if(@$_GET['Paliwo'] == 'Hybryda(Benzyna)'){ echo 'selected'; } ?> class="searchopt" value="Hybryda(Diesel)">Hybryda(Benzyna)</option>
									</select>
								</div>
							</div>
						</div>
						
				
						<div class="inputsearchblock">
							<div>
								<div>
									<select class="inputsearch" id="Skrzynia" name="Skrzynia">
										<option <?php if(@$_GET['Skrzynia'] == '0'){ echo 'selected'; } ?> class="searchopt" value="0">Skrzynia biegów</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Automatyczna'){ echo 'selected'; } ?> class="searchopt" value="Automatyczna">Automatyczna</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Manualna'){ echo 'selected'; } ?> class="searchopt" value="Manualna">Manualna</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Sekwencyjna'){ echo 'selected'; } ?> class="searchopt" value="Sekwencyjna">Sekwencyjna</option>
									</select>
								</div>
								<div>
									<select class="inputsearch" id="Kolor" name="Kolor">
										<option <?php if(@$_GET['Skrzynia'] == '0'){ echo 'selected'; } ?> class="searchopt" value="0">Kolor</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Bialy'){ echo 'selected'; } ?> class="searchopt" value="Bialy">Biały</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Czarny'){ echo 'selected'; } ?> class="searchopt" value="Czarny">Czarny</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Czerwony'){ echo 'selected'; } ?> class="searchopt" value="Czerwony">Czerwony</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Niebieski'){ echo 'selected'; } ?> class="searchopt" value="Niebieski">Niebieski</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Srebny'){ echo 'selected'; } ?> class="searchopt" value="Srebny">Srebny</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Szary'){ echo 'selected'; } ?> class="searchopt" value="Szary">Szary</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Zielony'){ echo 'selected'; } ?> class="searchopt" value="Zielony">Zielony</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Zolty'){ echo 'selected'; } ?> class="searchopt" value="Zolty">Żółty</option>
										<option <?php if(@$_GET['Skrzynia'] == 'Inny'){ echo 'selected'; } ?> class="searchopt" value="Inny">Inny</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="inputsearchblock">
							<div>
								<div>
									<select class="inputsearch" id="Stantechniczny" name="Stantechniczny">
										<option <?php if(@$_GET['Stantechniczny'] == '0'){ echo 'selected'; } ?> class="searchopt" value="0">Stan techniczny</option>
										<option <?php if(@$_GET['Stantechniczny'] == 'Nieuszkodzony'){ echo 'selected'; } ?> class="searchopt" value="Nieuszkodzony">Nieuszkodzony</option>
										<option <?php if(@$_GET['Stantechniczny'] == 'Uszkodzony'){ echo 'selected'; } ?> class="searchopt" value="Uszkodzony">Uszkodzony</option>
									</select>
								</div>
								<div>
									<select class="inputsearch" id="Stanuzytkowy" name="Stanuzytkowy">
										<option <?php if(@$_GET['Stanuzytkowy'] == '0'){ echo 'selected'; } ?> class="searchopt" value="0">Stan użytkowy</option>
										<option <?php if(@$_GET['Stanuzytkowy'] == 'Nowy'){ echo 'selected'; } ?> class="searchopt" value="Nowy">Nowy</option>
										<option <?php if(@$_GET['Stanuzytkowy'] == 'Uzywany'){ echo 'selected'; } ?> class="searchopt" value="Uzywany">Używany</option>
									</select>
								</div>
							</div>
						</div>										
						<div class="inputsearchblock">
							<div>
								<div><input <?php if(@isset($_GET['cenaod'])){ echo 'value ="'.$_GET['cenaod'].'"'; } ?> class="inputsearch" type="text" maxlength="7" name="cenaod" list="cena" placeholder="Cena od" onclick='document.getElementById("cs").style="display: block;";' onkeydown="return noNum(event)"></div>
								<div><input <?php if(@isset($_GET['cenado'])){ echo 'value ="'.$_GET['cenado'].'"'; } ?> class="inputsearch" type="text" maxlength="7" name="cenado" list="cena" placeholder="Cena do" onclick='document.getElementById("cs").style="display: block;";' onkeydown="return noNum(event)"></div>
								<datalist id="cena">
									<select id="cs">
										<option class="searchopt" value="4500" label="4 500 zł">
										<option class="searchopt" value="6000" label="6 000 zł">
										<option class="searchopt" value="8000" label="8 000 zł">
										<option class="searchopt" value="10000" label="10 000 zł">
										<option class="searchopt" value="15000" label="15 000 zł">
										<option class="searchopt" value="20000" label="20 000 zł">
										<option class="searchopt" value="50000" label="50 000 zł">
										<option class="searchopt" value="70000" label="70 000 zł">
										<option class="searchopt" value="100000" label="100 000 zł">
										<option class="searchopt" value="150000" label="150 000 zł">
										<option class="searchopt" value="200000" label="200 000 zł">
										<option class="searchopt" value="300000" label="300 000 zł">
									</select>
								</datalist>
							</div>
						</div>
							
						<div class="inputsearchblock">
							<div>
								<div><input <?php if(@isset($_GET['rok_produkcjiod'])){ echo 'value ="'.$_GET['rok_produkcjiod'].'"'; } ?> class="inputsearch" type="text" maxlength="4" name="rok_produkcjiod" list="rok_produkcji" placeholder="Rok prod. od" onclick='document.getElementById("rp").style="display: block;";' onkeydown="return noNum(event)"></div>
								<div><input <?php if(@isset($_GET['rok_produkcjido'])){ echo 'value ="'.$_GET['rok_produkcjido'].'"'; } ?> class="inputsearch" type="text" maxlength="4" name="rok_produkcjido" list="rok_produkcji" placeholder="Rok prod. do" onclick='document.getElementById("rp").style="display: block;";' onkeydown="return noNum(event)"></div>
								<datalist id="rok_produkcji">
									<select id="rp">
										<option class="searchopt" value="2000" label="2000">
										<option class="searchopt" value="2001" label="2001">
										<option class="searchopt" value="2002" label="2002">
										<option class="searchopt" value="2003" label="2003">
										<option class="searchopt" value="2004" label="2004">
										<option class="searchopt" value="2005" label="2005">
										<option class="searchopt" value="2006" label="2006">
										<option class="searchopt" value="2007" label="2007">
										<option class="searchopt" value="2008" label="2008">
										<option class="searchopt" value="2009" label="2009">
										<option class="searchopt" value="2010" label="2010">
										<option class="searchopt" value="2011" label="2011">
										<option class="searchopt" value="2012" label="2012">
										<option class="searchopt" value="2013" label="2013">
										<option class="searchopt" value="2014" label="2014">
										<option class="searchopt" value="2015" label="2015">
										<option class="searchopt" value="2016" label="2016">
										<option class="searchopt" value="2017" label="2017">
										<option class="searchopt" value="2018" label="2018">
										<option class="searchopt" value="2019" label="2019">
									</select>
								</datalist>
							</div>
						</div>
						
						<div class="inputsearchblock">
							<div>
								<div><input <?php if(@isset($_GET['moc_silnikaod'])){ echo 'value ="'.$_GET['moc_silnikaod'].'"'; } ?> class="inputsearch" type="text" maxlength="4" name="moc_silnikaod" list="moc_silnika" placeholder="Moc silnika od" onclick='document.getElementById("ms").style="display: block;";' onkeydown="return noNum(event)"></div>
								<div><input <?php if(@isset($_GET['moc_silnikado'])){ echo 'value ="'.$_GET['moc_silnikado'].'"'; } ?> class="inputsearch" type="text" maxlength="4" name="moc_silnikado" list="moc_silnika" placeholder="Moc silnika do" onclick='document.getElementById("ms").style="display: block;";' onkeydown="return noNum(event)"></div>
								<datalist id="moc_silnika">
									<select id="ms">
										<option class="searchopt" value="80" label="80 KM">
										<option class="searchopt" value="100" label="100 KM">
										<option class="searchopt" value="180" label="180 KM">
										<option class="searchopt" value="250" label="250 KM">
										<option class="searchopt" value="500" label="500 KM">
									</select>
								</datalist>
							</div>
						</div>
						
						<div class="inputsearchblock">
							<div>
								<div><input <?php if(@isset($_GET['poj_silnikaod'])){ echo 'value ="'.$_GET['poj_silnikaod'].'"'; } ?> class="inputsearch" type="text" maxlength="5" name="poj_silnikaod" list="poj_silnika" placeholder="Poj. silnika od" onclick='document.getElementById("ps").style="display: block;";' onkeydown="return noNum(event)"></div>
								<div><input <?php if(@isset($_GET['poj_silnikado'])){ echo 'value ="'.$_GET['poj_silnikado'].'"'; } ?> class="inputsearch" type="text" maxlength="5" name="poj_silnikado" list="poj_silnika" placeholder="Poj. silnika do" onclick='document.getElementById("ps").style="display: block;";' onkeydown="return noNum(event)"></div>
								<datalist id="poj_silnika">
									<select id="ps">
										<option class="searchopt" value="2000" label="2 000 cm³">
										<option class="searchopt" value="4000" label="4 000 cm³">
										<option class="searchopt" value="6000" label="6 000 cm³">
										<option class="searchopt" value="8000" label="8 000 cm³">
										<option class="searchopt" value="10000" label="10 000 cm³">
										<option class="searchopt" value="12000" label="12 000 cm³">
									</select>
								</datalist>
							</div>
						</div>
						
						
						<div class="inputsearchblock">
							<div>
								<div><input <?php if(@isset($_GET['przebiegod'])){ echo 'value ="'.$_GET['przebiegod'].'"'; } ?> class="inputsearch" type="text" maxlength="8" name="przebiegod" list="przebieg" placeholder="Przebieg od" onclick='document.getElementById("prs").style="display: block;";' onkeydown="return noNum(event)"></div>
								<div><input <?php if(@isset($_GET['przebiegdo'])){ echo 'value ="'.$_GET['przebiegdo'].'"'; } ?> class="inputsearch" type="text" maxlength="8" name="przebiegdo" list="przebieg" placeholder="Przebieg do" onclick='document.getElementById("prs").style="display: block;";' onkeydown="return noNum(event)"></div>
								<datalist id="przebieg">
									<select id="prs">
										<option class="searchopt" value="500" label="500 km">
										<option class="searchopt" value="1000" label="1 000 km">
										<option class="searchopt" value="5000" label="5 000 km">
										<option class="searchopt" value="30000" label="30 000 km">
										<option class="searchopt" value="50000" label="50 000 km">
										<option class="searchopt" value="100000" label="100 000 km">
										<option class="searchopt" value="150000" label="150 000 km">
										<option class="searchopt" value="200000" label="200 000 km">
										<option class="searchopt" value="250000" label="250 000 km">
										<option class="searchopt" value="300000" label="300 000 km">
									</select>
								</datalist>
							</div>
						</div>
						<div style="float: right;">
							<input type="submit" class="submitsearch" name="submitsearch" value="Szukaj"></br>
							<a class="submitsearch" onclick="window.location.href='samochodydostawcze.php?page=<?php if(isset($_GET['page'])){echo $_GET['page'];}else{echo '0';}; ?>'">Usuń filtry</a>
						</div>
					</form>
				</div>
				
				<?php
							$zapytanie = 'SELECT * FROM samochody_dostawcze WHERE datepromotion > NOW()';
							$zapytanie1 = 'SELECT * FROM samochody_dostawcze WHERE datepromotion < NOW()';
							if(isset($_GET['submitsearch'])){
								if(isset($_GET['Marka'])){
									if(!((@$_GET['Marka'] == 'DAF') || (@$_GET['Marka'] == 'Iveco') || (@$_GET['Marka'] == 'Jelcz') 
										|| (@$_GET['Marka'] == 'MAN') || (@$_GET['Marka'] == 'Mercedes') || (@$_GET['Marka'] == 'Renault') 
										|| (@$_GET['Marka'] == 'Scania') || (@$_GET['Marka'] == 'Star') || (@$_GET['Marka'] == 'Volvo') || (@$_GET['Marka'] == 'Inna marka'))){
											unset($_GET['Marka']);
										}
									}
								}
								if(isset($_GET['Paliwo'])){
									if(!(($_GET['Paliwo'] == 'Diesel') || ($_GET['Paliwo'] == 'Elektryczny') || ($_GET['Paliwo'] == 'Hybryda(Diesel)') || ($_GET['Paliwo'] == 'Hybryda(Benzyna)') 
										|| ($_GET['Paliwo'] == 'Benzyna+LPG') || ($_GET['Paliwo'] == 'Benzyna'))){
										unset($_GET['Paliwo']);
									}
								}
								
								if(isset($_GET['Skrzynia'])){
									if(!(($_GET['Skrzynia'] == 'Automatyczna') || ($_GET['Skrzynia'] == 'Manualna') || ($_GET['Skrzynia'] == 'Sekwencyjna'))){
										unset($_GET['Skrzynia']);
									}
								}
								
								if(isset($_GET['Kolor'])){
									if(!(($_GET['Kolor'] == 'Bialy') || ($_GET['Kolor'] == 'Czarny') || ($_GET['Kolor'] == 'Czerwony')
										|| ($_GET['Kolor'] == 'Niebieski') || ($_GET['Kolor'] == 'Srebny') || ($_GET['Kolor'] == 'Szary')
										|| ($_GET['Kolor'] == 'Zielony') || ($_GET['Kolor'] == 'Zolty') || ($_GET['Kolor'] == 'Inny'))){
										unset($_GET['Kolor']);
									}
								}
								
								if(isset($_GET['Stantechniczny'])){
									if(!(($_GET['Stantechniczny'] == 'Nieuszkodzony') || ($_GET['Stantechniczny'] == 'Uszkodzony'))){
										unset($_GET['Stantechniczny']);
									}
								}
								
								if(isset($_GET['Stanuzytkowy'])){
									if(!(($_GET['Stanuzytkowy'] == 'Nowy') || ($_GET['Stanuzytkowy'] == 'Uzywany'))){
										unset($_GET['Stanuzytkowy']);
									}
								}
								

								if(isset($_GET['Cenaod'])){
									if(is_numeric($_GET['Cenaod'])){
										if($_GET['Cenaod'] <= 0 || $_GET['Cenaod'] >= 9999999){
											unset($_GET['Cenaod']);
										}
									}else{
										unset($_GET['Cenaod']);
									}
								}
								
								if(isset($_GET['Cenado'])){
									if(is_numeric($_GET['Cenado'])){
										if($_GET['Cenado'] <= 0 || $_GET['Cenado'] >= 9999999){
											unset($_GET['Cenado']);
										}
									}else{
										unset($_GET['Cenado']);
									}
								}
								
								if(isset($_GET['Rok_produkcjiod'])){
									if(is_numeric($_GET['Rok_produkcjiod'])){
										if($_GET['Rok_produkcjiod'] < 0 || $_GET['Rok_produkcjiod'] > 9999){
											unset($_GET['Rok_produkcjiod']);
										}
									}else{
										unset($_GET['Rok_produkcjiod']);
									}
								}
								
								if(isset($_GET['Rok_produkcjido'])){
									if(is_numeric($_GET['Rok_produkcjido'])){
										if($_GET['Rok_produkcjido'] < 0 || $_GET['Rok_produkcjido'] > 9999){
											unset($_GET['Rok_produkcjido']);
										}
									}else{
										unset($_GET['Rok_produkcjido']);
									}
								}
								if(isset($_GET['Poj_silnikaod'])){
									if(is_numeric($_GET['Poj_silnikaod'])){
										if($_GET['Poj_silnikaod'] < 0 || $_GET['Poj_silnikaod'] > 99999){
											unset($_GET['Poj_silnikaod']);
										}
									}else{
										unset($_GET['Poj_silnikaod']);
									}
								}
								
								if(isset($_GET['Poj_silnikado'])){
									if(is_numeric($_GET['Poj_silnikado'])){
										if($_GET['Poj_silnikado'] < 0 || $_GET['Poj_silnikado'] > 99999){
											unset($_GET['Poj_silnikado']);
										}
									}else{
										unset($_GET['Poj_silnikado']);
									}
								}
								
								if(isset($_GET['Moc_silnikaod'])){
									if(is_numeric($_GET['Moc_silnikaod'])){
										if($_GET['Moc_silnikaod'] < 0 || $_GET['Moc_silnikaod'] > 9999){
											unset($_GET['Moc_silnikaod']);
										}
									}else{
										unset($_GET['Moc_silnikaod']);
									}
								}
								
								if(isset($_GET['Moc_silnikado'])){
									if(is_numeric($_GET['Moc_silnikado'])){
										if($_GET['Moc_silnikado'] < 0 || $_GET['Moc_silnikado'] > 9999){
											unset($_GET['Moc_silnikado']);
										}
									}else{
										unset($_GET['Moc_silnikado']);
									}
								}
								
								if(isset($_GET['Przebiegod'])){
									if(is_numeric($_GET['Przebiegod'])){
										if($_GET['Przebiegod'] < 0 || $_GET['Przebiegod'] > 99999999){
											unset($_GET['Przebiegod']);
										}
									}else{
										unset($_GET['Przebiegod']);
									}
								}
								
								if(isset($_GET['Przebiegdo'])){
									if(is_numeric($_GET['Przebiegdo'])){
										if($_GET['Przebiegdo'] < 0 || $_GET['Przebiegdo'] > 99999999){
											unset($_GET['Przebiegdo']);
										}
									}else{
										unset($_GET['Przebiegdo']);
									}
								}
								
								$_SESSION['nooglerror'] = '<center><div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">
								Nie znaleziono ogłoszeń w podanych kryteriach wyszukiwania,</br> dodaj swoje jako pierwsze!</div></center>';
								
								if(isset($_GET['Marka']) && $_GET['Marka'] != '0'){
									$zapytanie = $zapytanie.' AND Marka="'.$_GET['Marka'].'"';
									$zapytanie1 = $zapytanie1.' AND Marka="'.$_GET['Marka'].'"';
								}
								if(isset($_GET['Paliwo']) && $_GET['Paliwo'] != '0'){
									$zapytanie = $zapytanie.' AND Paliwo="'.$_GET['Paliwo'].'"';
									$zapytanie1 = $zapytanie1.' AND Paliwo="'.$_GET['Paliwo'].'"';
								}
								if(isset($_GET['Skrzynia']) && $_GET['Skrzynia'] != '0'){
									$zapytanie = $zapytanie.' AND Skrzynia="'.$_GET['Skrzynia'].'"';
									$zapytanie1 = $zapytanie1.' AND Skrzynia="'.$_GET['Skrzynia'].'"';
								}
								if(isset($_GET['Kolor']) && $_GET['Kolor'] != '0'){
									$zapytanie = $zapytanie.' AND Kolor="'.$_GET['Kolor'].'"';
									$zapytanie1 = $zapytanie1.' AND Kolor="'.$_GET['Kolor'].'"';
								}
								if(isset($_GET['Stantechniczny']) && $_GET['Stantechniczny'] != '0'){
									$zapytanie = $zapytanie.' AND Stantechniczny="'.$_GET['Stantechniczny'].'"';
									$zapytanie1 = $zapytanie1.' AND Stantechniczny="'.$_GET['Stantechniczny'].'"';
								}
								if(isset($_GET['Stanuzytkowy']) && $_GET['Stanuzytkowy'] != '0'){
									$zapytanie = $zapytanie.' AND Stanuzytkowy="'.$_GET['Stanuzytkowy'].'"';
									$zapytanie1 = $zapytanie1.' AND Stanuzytkowy="'.$_GET['Stanuzytkowy'].'"';
								}
								
								if(isset($_GET['cenaod']) && $_GET['cenaod'] != '0' && $_GET['cenaod'] != ''){
									$zapytanie = $zapytanie.' AND Cena>="'.$_GET['cenaod'].'"';
									$zapytanie1 = $zapytanie1.' AND Cena>="'.$_GET['cenaod'].'"';
								}
								if(isset($_GET['cenado']) && $_GET['cenado'] != '0' && $_GET['cenado'] != ''){
									$zapytanie = $zapytanie.' AND Cena<="'.$_GET['cenado'].'"';
									$zapytanie1 = $zapytanie1.' AND Cena<="'.$_GET['cenado'].'"';
								}
								if(isset($_GET['rok_produkcjiod']) && $_GET['rok_produkcjiod'] != '0' && $_GET['rok_produkcjiod'] != ''){
									$zapytanie = $zapytanie.' AND Rokprodukcji>="'.$_GET['rok_produkcjiod'].'"';
									$zapytanie1 = $zapytanie1.' AND Rokprodukcji>="'.$_GET['rok_produkcjiod'].'"';
								}
								if(isset($_GET['rok_produkcjido']) && $_GET['rok_produkcjido'] != '0' && $_GET['rok_produkcjido'] != ''){
									$zapytanie = $zapytanie.' AND Rokprodukcji<="'.$_GET['rok_produkcjido'].'"';
									$zapytanie1 = $zapytanie1.' AND Rokprodukcji<="'.$_GET['rok_produkcjido'].'"';
								}
								if(isset($_GET['moc_silnikaod']) && $_GET['moc_silnikaod'] != '0' && $_GET['moc_silnikaod'] != ''){
									$zapytanie = $zapytanie.' AND Mocsilnika>="'.$_GET['moc_silnikaod'].'"';
									$zapytanie1 = $zapytanie1.' AND Mocsilnika>="'.$_GET['moc_silnikaod'].'"';
								}
								if(isset($_GET['moc_silnikado']) && $_GET['moc_silnikado'] != '0' && $_GET['moc_silnikado'] != ''){
									$zapytanie = $zapytanie.' AND Mocsilnika<="'.$_GET['moc_silnikado'].'"';
									$zapytanie1 = $zapytanie1.' AND Mocsilnika<="'.$_GET['moc_silnikado'].'"';
								}
								if(isset($_GET['Poj_silnikaod']) && $_GET['poj_silnikaod'] != '0' && $_GET['poj_silnikaod'] != ''){
									$zapytanie = $zapytanie.' AND Pojsilnika>="'.$_GET['poj_silnikaod'].'"';
									$zapytanie1 = $zapytanie1.' AND Pojsilnika>="'.$_GET['poj_silnikaod'].'"';
								}
								
								if(isset($_GET['poj_silnikado']) && $_GET['poj_silnikado'] != '0' && $_GET['poj_silnikado'] != ''){
									$zapytanie = $zapytanie.' AND Pojsilnika<="'.$_GET['poj_silnikado'].'"';
									$zapytanie1 = $zapytanie1.' AND Pojsilnika<="'.$_GET['poj_silnikado'].'"';
								}
								
								if(isset($_GET['przebiegod']) && $_GET['przebiegod'] != '0' && $_GET['przebiegod'] != ''){
									$zapytanie = $zapytanie.' AND Przebieg>="'.$_GET['przebiegod'].'"';
									$zapytanie1 = $zapytanie1.' AND Przebieg>="'.$_GET['przebiegod'].'"';
								}
								if(isset($_GET['przebiegdo']) && $_GET['przebiegdo'] != '0' && $_GET['przebiegdo'] != ''){
									$zapytanie = $zapytanie.' AND Przebieg<="'.$_GET['przebiegdo'].'"';
									$zapytanie1 = $zapytanie1.' AND Przebieg<="'.$_GET['przebiegdo'].'"';
								}
								
								if(isset($_SESSION['searchitem'])){
										$item = strip_tags($_SESSION['searchitem']);
										$wzor = '/^[a-zA-Z]/';
										if(preg_match($wzor, $item)){
											$item = strrpos($item, "=");
											if(!$item == false){
												unset($_SESSION['searchitem']);
											}else{
												$_SESSION['nooglerror'] = '<center><div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">
												ogłoszeń w podanych kryteriach wyszukiwania: </br>'.$_SESSION['searchitem'].'</div></center>';
											}
										}else{
											unset($_SESSION['searchitem']);
										}
									}
									
								if(isset($_SESSION['searchloc'])){
									$loc = $_SESSION['searchloc'];
									$loc = strrpos($loc, "=");
									if($loc == false){
										$loc = strrpos($loc, "<");
										if($loc == false){
											$loc = strrpos($loc, ">");
											if(!$loc == false){
												unset($_SESSION['searchloc']);
											}else{
												$_SESSION['nooglerror'] = '<center><div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">Nie znaleziono ogłoszeń w podanych kryteriach wyszukiwania: </br>'.$_SESSION['searchloc'].'</div></center>';
											}
										}else{
											unset($_SESSION['searchloc']);
										}
									}else{
										unset($_SESSION['searchloc']);
									}
								}
								
								
								if(isset($_SESSION['searchitem'])){
									$zapytanie = $zapytanie.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%"';
									$zapytanie1 = $zapytanie1.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%"';
									$_SESSION['nooglerror'] = '<center><div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">Nie znaleziono '.$_SESSION['searchitem'].' w podanych kryteriach wyszukiwania.</div></center>';
								}
								
								if(isset($_SESSION['searchloc'])){
									if($_SESSION['searchloc'] != ''){
										$zapytanie = $zapytanie.' AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
										$zapytanie1 = $zapytanie1.' AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
										$_SESSION['nooglerror'] = '<center><div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">Nie znaleziono ogłoszeń w '.$_SESSION['searchloc'].'</div></center>';
									}
								}
								
								if(isset($_SESSION['searchitem'])){
									if($_SESSION['searchloc'] != ''){
										$zapytanie = $zapytanie.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%" AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
										$zapytanie1 = $zapytanie1.' AND Tytul LIKE "%'.$_SESSION['searchitem'].'%" AND Lokalizacja LIKE "%'.$_SESSION['searchloc'].'%"';
										$_SESSION['nooglerror'] = '<center><div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">Nie znaleziono ogłoszeń w podanych kryteriach wyszukiwania.</br>
										Może poszukasz '.$_SESSION['searchitem'].' w innym województwie, lub miejscowości?'.'</div></center>';
									}
								}
						
							
							$zapytanie = $zapytanie.' ORDER BY refreshdate DESC';
							$zapytanie1 = $zapytanie1.' ORDER BY refreshdate DESC';
							
							try {
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
									if($result = $connect->query('SELECT * FROM samochody_dostawcze')){
										$wyniki = $result->num_rows;
										if($wyniki>0){
											for($r = 1; $r <= $wyniki; $r++){
												$w = $result->fetch_assoc();
												$date = date('Y-m-d H:i:s');
												//echo $date;
												if($w['dateremove'] <= $date){
													for($p=1; $p<=8; $p++){
														if(isset($w['Photo'.$p])){
															$file = '../galeria/aktywne/'.$w['Photo'.$p];
															if(@file_exists($file)){
																@unlink($file);
															}
														}
													}
													@$connect->query('DELETE FROM samochody_dostawcze WHERE ID='.$w['ID'].'');
												}
											}
										}
										$result->free_result();
										$connect->close();
										//echo 'zamknięto';
									}else{
										throw new Exception($connect->error);
									}
								}	
							}
							catch(Exception $error){
								echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
								// echo '</br>Informacja developerska:</br>'.$error;
							}
								
							
							try{
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
									$page = 0;
									if(isset($_GET['page'])){
										if(is_numeric($_GET['page'])){
											$page = $_GET['page'];
										}
									}
									
									if($result = $connect->query('SELECT * FROM samochody_dostawcze')){
										$wszystkich = $result->num_rows;
										//echo 'Wszystkich: '.$wszystkich.'</br>';
										$stronywszystkich = ceil($wszystkich/$count);
										//echo 'Wszystkich - strony: '.$stronywszystkich.'</br>';
									}else{
										throw new Exception($connect->error);
									}
									
									if($result = $connect->query($zapytanie)){
										$promowanych = $result->num_rows;
										if($promowanych != 0){
											//echo 'Promowanych: '.$promowanych.'</br>';
											$stronypromowanych = ceil($promowanych/$count);
											//echo 'Promowanych - strony: '.$stronypromowanych.'</br>';
										}else{
											$promowanych = 0;
										}
									}else{
										throw new Exception($connect->error);
									}
									
									$zwyklych = $wszystkich - $promowanych;
									//echo 'Zwykłych: '.$zwyklych.'</br>';
									$stronyzwyklych = ceil($zwyklych/$count);
									//echo 'Zwykłych - strony: '.$stronyzwyklych.'</br>';
									
								
									
									if($wszystkich != 0){
										if($promowanych != 0){

										$a = $page;
										for($i = 0; $i <= $stronypromowanych; $i++){
											if($i == $a){
												$a = $i;
												break;
											}
										}
											
											if($a == $stronypromowanych-1){
												$zap = " LIMIT ".($a*$count).",$count";
												$zapytanie = $zapytanie.$zap;
												if($result = $connect->query($zapytanie)){
													$a = $result->num_rows;
													//echo 'promowanych wyświetlanych: '.$a.'</br>';
												}else{
													throw new Exception($connect->error);
												}
											}
										
										
											if($page < $stronypromowanych-1){
												$zapytanie = $zapytanie.' LIMIT '.($page*$count).','.$count;
												unset($zapytanie1);
											}
											
											$b = $count - $a;
											if($page == $stronypromowanych-1){
												if($a == $count){
													unset($zapytanie1);
												}else{
													$b = $count - $a;
													$zap = ' LIMIT '.($page*$count).','.$b;
													$zapytanie1 = $zapytanie1.$zap;
												}
											}
											
											if($page > $stronypromowanych-1){
												$zap = ' LIMIT '.($page*$count - $a).','.$count;
												$zapytanie1 = $zapytanie1.$zap;
												unset($zapytanie);
											}
											
										}else{
											$zap = ' LIMIT '.($page*$count).','.$count;
											$zapytanie1 = $zapytanie1.$zap;
											unset($zapytanie);
										}
									}			
								}
								$result->free_result();
								$connect->close();
								//echo 'zamknieto';
							}
							catch(Exception $error){
								echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
								// echo '</br>Informacja developerska:</br>'.$error;
							}
							
							
							//echo $zapytanie.'</br>';
							//echo $zapytanie1;
				
		// --------------------------------------------- WYŚWIETLENIE WYNIKÓW ------------------------------------------------------------------
						if(isset($zapytanie)){
							mysqli_report(MYSQLI_REPORT_STRICT);
							try{
								$connect = new mysqli($host, $db_user, $db_password, $db_name);
								mysqli_query($connect, "SET CHARSET utf8");
								mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
								if($connect->connect_errno!=0){
									throw new Exception(mysqli_connect_errno());
								}//else{
									//$login = htmlentities($login, ENT_QUOTES, "UTF-8");
								//}

								if(!$connect->set_charset("utf8")){
									printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
									exit();
									
								}else{
									if($result = $connect->query($zapytanie)){
										//echo $zapytanie;
										//mysqli_real_escape_string($connect,$login),
										//mysqli_real_escape_string($connect,$password)))){
										$wyniki = $result->num_rows;
										if($wyniki>0){
											//echo "Ogłoszenia promowane: ".$wyniki;
											for($r = 1; $r <= $wyniki; $r++){
												$w = $result->fetch_assoc();
												echo '<div onclick="window.location = (\'ogloszenia-samochody-dostawcze.php?id='.$w['ID'].'\');" class="oglcon1" style="background: #fafad2">';
												echo '<div class="oglimgg">';
												for($i=1; $i<=8; $i++){
													if($w['Photo'.$i] != ''){
														$file = '../galeria/aktywne/'.$w['Photo'.$i];
														if(!isset($glowne)){
															if(@file_exists($file)){
																$glowne = $w['Photo'.$i];
																echo '<a href="../galeria/aktywne/'.$w['Photo'.$i].'" target="_blank"><div style="line-height: 150px;"><img style="margin-left: 10px; width: 150px; vertical-align: middle;" src="../galeria/aktywne/'.$w['Photo'.$i].'"/></div></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<img style="padding: 25px; width: 100px; border-bottom-left-radius: 15px; border-top-left-radius: 10px; background: linear-gradient(to right, #DDD 92%, white);" src="../img/camera.png">';
												}
												unset($glowne);
												echo '<div style="line-height: 150px;">';
												echo '</div></div>';
												
												// Tytuł
												echo '<div class="oglcontit">'.$w['Tytul'].'</div>';
												
												//Pierwsza zawartość
												echo '<div style="height: 30px; font-size: 15px; text-align: left;">';
												
												//Ustalanie obrazków jeśli motoryzacja / elektronika
												echo '<img src="../img/wrench.png" style="margin-left: 15px; width: 30px; float: left;">';
												
												echo '<span style="margin-left: 5px; line-height: 30px;">';
												if(($w['Stanuzytkowy']) === "Uzywany"){
													echo "Używany";
												}else{
													echo $w['Stanuzytkowy'];
												}
												echo ' ● '.$w['Stantechniczny'];
												$Przebieg = number_format($w['Przebieg'],0," "," ");
												echo ' ● '.$Przebieg.' km ● '.$w['Rokprodukcji'];
												echo ' ● '.$w['Paliwo'].' ● '.$w['Skrzynia'];
												echo '</span></div>';
												
												echo '<div style="height: 55px; font-size: 15px; text-align: left;"><div style="display: inline-flex;">';
												
												// Ustalenie ikonki i opis obok ikonki
												echo '<img src="../img/truck.png" style="margin-left: 15px; width: 30px; float: left;">';
												echo '<span style="margin-left: 5px; line-height: 30px;">'.$w['Marka'].'</span>';
												echo '</div>';
												
												//Cena w pasku
												$Cena = number_format($w['Cena'],0," "," ");
												echo '<div style="display: inline-flex; float: right; text-align: center; margin-right: 25px; width: 200px;">';
												echo '<span style="color: red; font-size: 50px;"><b>/</b></span><span style="font-size: 30px; margin-left: 10px; width: 166px;">'.$Cena.' <span style="font-size: 18px;">ZŁ</span>';
											
												if($w['Negocjacja'] == 'on'){
														echo '<div style="font-size: 15px;">Bez Grosika, Do negocjacji</div>';
													}else{
														echo '<div style="font-size: 15px; margin-left: 10px;">Bez Grosika</div>';
													}
												echo '</span></div></div>';
												
												//Trzecia zawartość: Woj i miejscowość
												echo '<div style="height: 30px; font-size: 18px; text-align: left;"><img src="../img/location1.png" style="width: 30px; margin-left: 15px;">';
												echo '<span style="line-height: 30px;">'.$w['Wojewodztwo'];
												if($w['Miejscowosc'] != ''){
													echo ', '.$w['Miejscowosc'];
												}
												echo '</span></div>';
											
											echo '</div>';
											}
											$result->free_result();
										}else{
											$_SESSION['yes'] = true;
										}
										$connect->close();
										//echo '<span style="color:red;"></br>Zamknięto połączenie';
										
									}else{
										throw new Exception($connect->error);
									}
								}
							}
							catch(Exception $error){
								echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
								// echo '</br>Informacja developerska:</br>'.$error;
							}
						}	
							# zwykłe ---------------------------------------------------------------------------------
						if(isset($zapytanie1)){
							mysqli_report(MYSQLI_REPORT_STRICT);
							try{
								$connect = new mysqli($host, $db_user, $db_password, $db_name);
								mysqli_query($connect, "SET CHARSET utf8");
								mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
								if($connect->connect_errno!=0){
									throw new Exception(mysqli_connect_errno());
								}//else{
									//$login = htmlentities($login, ENT_QUOTES, "UTF-8");
								//}
										
								if (!$connect->set_charset("utf8")) {
									printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
									exit();
									
								}else{
									if($result = @$connect->query($zapytanie1)){
										//echo $zapytanie1;
										//mysqli_real_escape_string($connect,$login),
										//mysqli_real_escape_string($connect,$password)))){
										$wyniki = $result->num_rows;
										if($wyniki>0){
											//echo "Ogłoszenia nie promowane: ".$wyniki;
											for($r = 1; $r <= $wyniki; $r++){
												$w = $result->fetch_assoc();
												
												$date = date('Y-m-d H:i:s');
												//echo $date;
												echo '<div onclick="window.location = (\'ogloszenia-samochody-dostawcze.php?id='.$w['ID'].'\');" class="oglcon1">';
												echo '<div class="oglimgg">';
												for($i=1; $i<=8; $i++){
													if($w['Photo'.$i] != ''){
														$file = '../galeria/aktywne/'.$w['Photo'.$i];
														if(!isset($glowne)){
															if(@file_exists($file)){
																$glowne = $w['Photo'.$i];
																echo '<a href="../galeria/aktywne/'.$w['Photo'.$i].'" target="_blank"><div style="line-height: 150px;"><img style="margin-left: 10px; width: 150px; vertical-align: middle;" src="../galeria/aktywne/'.$w['Photo'.$i].'"/></div></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<img style="padding: 25px; width: 100px; border-bottom-left-radius: 15px; border-top-left-radius: 10px; background: linear-gradient(to right, #DDD 92%, white);" src="../img/camera.png">';
												}
												unset($glowne);
													
												echo '<div style="line-height: 150px;">';
												echo '</div></div>';
												
												// Tytuł
												echo '<div class="oglcontit">'.$w['Tytul'].'</div>';
												
												//Pierwsza zawartość
												echo '<div style="height: 30px; font-size: 15px; text-align: left;">';
												
												//Ustalanie obrazków jeśli motoryzacja / elektronika
												echo '<img src="../img/wrench.png" style="margin-left: 15px; width: 30px; float: left;">';
												
												echo '<span style="margin-left: 5px; line-height: 30px;">';
												if(($w['Stanuzytkowy']) === "Uzywany"){
													echo "Używany";
												}else{
													echo $w['Stanuzytkowy'];
												}
												echo ' ● '.$w['Stantechniczny'];
												$Przebieg = number_format($w['Przebieg'],0," "," ");
												echo ' ● '.$Przebieg.' km ● '.$w['Rokprodukcji'];
												echo ' ● '.$w['Paliwo'].' ● '.$w['Skrzynia'];
												echo '</span></div>';
												
												echo '<div style="height: 55px; font-size: 15px; text-align: left;"><div style="display: inline-flex;">';
												
												// Ustalenie ikonki i opis obok ikonki
												echo '<img src="../img/truck.png" style="margin-left: 15px; width: 30px; float: left;">';
												echo '<span style="margin-left: 5px; line-height: 30px;">'.$w['Marka'].'</span>';
												echo '</div>';
												
												//Cena w pasku
												$Cena = number_format($w['Cena'],0," "," ");
												echo '<div style="display: inline-flex; float: right; text-align: center; margin-right: 25px; width: 200px;">';
												echo '<span style="color: red; font-size: 50px;"><b>/</b></span><span style="font-size: 30px; margin-left: 10px; width: 166px;">'.$Cena.' <span style="font-size: 18px;">ZŁ</span>';
											
												if($w['Negocjacja'] == 'on'){
														echo '<div style="font-size: 15px;">Bez Grosika, Do negocjacji</div>';
													}else{
														echo '<div style="font-size: 15px; margin-left: 10px;">Bez Grosika</div>';
													}
												echo '</span></div></div>';
												
												//Trzecia zawartość: Woj i miejscowość
												echo '<div style="height: 30px; font-size: 18px; text-align: left;"><img src="../img/location1.png" style="width: 30px; margin-left: 15px;">';
												echo '<span style="line-height: 30px;">'.$w['Wojewodztwo'];
												if($w['Miejscowosc'] != ''){
													echo ', '.$w['Miejscowosc'];
												}
												echo '</span></div>';
												echo '</div>';
											}
											
										}else{
											unset($_SESSION['yes']);
											if(isset($_SESSION['nooglerror'])){
												echo $_SESSION['nooglerror'];
												unset($_SESSION['nooglerror']);
											}
											// echo '</div>';
										}
										$result->free_result();
										$connect->close();
										//echo '<span style="color:red;"></br>Zamknięto połączenie';
										
									}else{
										throw new Exception($connect->error);
									}
								}
							}
						catch(Exception $error){
							echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
							//echo '</br>Informacja developerska:</br>'.$error;
						}	
					}		
							?>

						<?php
						if(isset($_GET['page'])){
							if(is_numeric($_GET['page'])){
								$page = $_GET['page'];
							}else{
								$page = 0;
							}
						}else{
							$page = 0;
						}
						
						try{
							$connect = new mysqli($host, $db_user, $db_password, $db_name);
							mysqli_query($connect, "SET CHARSET utf8");
							mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
							if($connect->connect_errno!=0){
								throw new Exception(mysqli_connect_errno());
							}
									
							if (!$connect->set_charset("utf8")) {
								printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
								exit();
								
							}else{
								$pytanie = 'SELECT * FROM samochody_dostawcze';
								if($result = @$connect->query($pytanie)){
									$wyniki = $result->num_rows;
									$lStron = ceil($wyniki / $count);
									$result->free_result();
									$connect->close();
								}else{
									throw new Exception($connect->error);
								}
							}
						}
						catch(Exception $error){
							echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
							//echo '</br>Informacja developerska:</br>'.$error;
						}
						

						echo '<div style="display: inline-flex; margin-top: 15px;">';	

							$link = '';
							if(isset($_GET['Marka'])){
								$link = $link.'&Marka='.$_GET['Marka'];
							}
							
							if(isset($_GET['Paliwo'])){
								$link = $link.'&Paliwo='.$_GET['Paliwo'];
							}
							
							if(isset($_GET['Skrzynia'])){
								$link = $link.'&Skrzynia='.$_GET['Skrzynia'];
							}
							
							if(isset($_GET['Kolor'])){
								$link = $link.'&Kolor='.$_GET['Kolor'];
							}
							
							if(isset($_GET['Stantechniczny'])){
								$link = $link.'&Stantechniczny='.$_GET['Stantechniczny'];
							}
							
							if(isset($_GET['Stanuzytkowy'])){
								$link = $link.'&Stanuzytkowy='.$_GET['Stanuzytkowy'];
							}
							
							if(isset($_GET['cenaod'])){
								$link = $link.'&cenaod='.$_GET['cenaod'];
							}
							
							if(isset($_GET['cenado'])){
								$link = $link.'&cenado='.$_GET['cenado'];
							}
							
							if(isset($_GET['rok_produkcjiod'])){
								$link = $link.'&rok_produkcjiod='.$_GET['rok_produkcjiod'];
							}
							
							if(isset($_GET['rok_produkcjido'])){
								$link = $link.'&rok_produkcjido='.$_GET['rok_produkcjido'];
							}
							
							if(isset($_GET['moc_silnikaod'])){
								$link = $link.'&moc_silnikaod='.$_GET['moc_silnikaod'];
							}
							
							if(isset($_GET['moc_silnikado'])){
								$link = $link.'&moc_silnikado='.$_GET['moc_silnikado'];
							}
							
							if(isset($_GET['poj_silnikaod'])){
								$link = $link.'&poj_silnikaod='.$_GET['poj_silnikaod'];
							}
							
							if(isset($_GET['poj_silnikado'])){
								$link = $link.'&poj_silnikado='.$_GET['poj_silnikado'];
							}
							
							if(isset($_GET['przebiegod'])){
								$link = $link.'&przebiegod='.$_GET['przebiegod'];
							}
							
							if(isset($_GET['przebiegdo'])){
								$link = $link.'&przebiegdo='.$_GET['przebiegdo'];
							}

							$pagep = $page -1;
							if($pagep <= 0){
								$pagep = 0;
							}
							
							$pagen = $page + 1;
							if($pagen >= $lStron -1){
								$pagen = $lStron -1;
							}
							
							if(isset($_GET['page'])){
								if(is_numeric($_GET['page'])){
									$showpage = $_GET['page']+1;
								}else{
									$showpage = 1;
								}
							}else{
								$showpage = 1;
							}
							

							
							echo '
							<a href="samochodydostawcze.php?page=0'.$link.'&submitsearch=Szukaj">
								<div style="cursor: pointer; margin: 5px; margin-right: -3px; font-size: 25px; border: 1px solid darkred; border-radius: 15px; padding: 10px; background: white; width: 50px;">
									<<
								</div>
							</a>
							
							<a href="samochodydostawcze.php?page='.$pagep.''.$link.'&submitsearch=Szukaj">
								<div style="cursor: pointer; margin: 5px; font-size: 25px; border: 1px solid darkred; border-radius: 15px; padding: 10px; background: white; width: 50px;">
									<
								</div>
							</a>';

						
								$page = 0;
								if(isset($_GET['page'])){
									if(is_numeric($_GET['page'])){
										if(!($_GET['page'] > $lStron-1)){
											$page = $_GET['page'];
										}
									}
								}
					
								for($p = $page+1; $p<=$page+9; $p++){
									$echo = $p - 1;
									if($echo == $page){
										echo '<a href="samochodydostawcze.php?page='.$echo.''.$link.'&submitsearch=Szukaj"><div class="pagesquare" style="margin-top: 15px;">'.$p.'</div></a>';
									}else{
										if($echo < $lStron-1){
											echo '<a href="samochodydostawcze.php?page='.$echo.''.$link.'&submitsearch=Szukaj"><div class="pagesquare">'.$p.'</div></a>';
										}
									}
								}
								
							echo '<a href="samochodydostawcze.php?page='.$pagen.''.$link.'&submitsearch=Szukaj">	
									<div style="cursor: pointer; margin: 5px; font-size: 25px; border: 1px solid darkred; border-radius: 15px; padding: 10px; background: white; width: 50px;">
									>
								</div>
							</a>';

						echo '</div>';
					?>

				<script type="text/javascript">
					function noNum(e){
						var keynum;
						var keychar;
						var numcheck;
						var page = "<?php echo $lStron ?>";

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
				</script>
				
				<div id="reklama3">
					<div>Miejsce na Twoją reklamę</div>
				</div>
			</div>
			
			
			<div id="wyroznione2">
				<div>Miejsce na Twoją reklamę</div>
			</div>
		</div>
		
		<?php
			footer();
		?>
	</body>
</html>
