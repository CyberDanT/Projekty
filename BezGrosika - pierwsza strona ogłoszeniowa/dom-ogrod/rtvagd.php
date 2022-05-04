<?php
	session_start();
	require_once("../php/connect.php");
	$db_name = $administratorbazy."domiogrod";
	$count = 15;
	include_once("../footer.php");
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Dla domu i ogrodu, RTV i AGD - Ogłoszenia BezGrosika.pl</title>
		<meta name="description" content="Dom i ogród, lodówki, pralki, czajniki, RTV, AGD, telewizory, mikrofalówki, sprzęty domowego użytku..."/>
		<meta name="keywords" content="ogłoszenia, BezGrosika, .pl, sprzedam, kupie, rtv, agd, dla domu"/>
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
							<span style="font-size: 40px; color: white; text-shadow: 1px 1px black;">Sprzęt RTV/AGD</span>
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
								<input <?php if(@isset($_GET['cenaod'])){ echo 'value ="'.$_GET['cenaod'].'"'; } ?> class="inputsearch" type="text" maxlength="7" name="cenaod" list="cena" placeholder="Cena od" onclick='document.getElementById("cs").style="display: block;";' onkeydown="return noNum(event)">
								<input <?php if(@isset($_GET['cenado'])){ echo 'value ="'.$_GET['cenado'].'"'; } ?> class="inputsearch" type="text" maxlength="7" name="cenado" list="cena" placeholder="Cena do" onclick='document.getElementById("cs").style="display: block;";' onkeydown="return noNum(event)">
								<datalist id="cena">
									<select id="cs">
										<option class="searchopt" value="500" label="100 zł">
										<option class="searchopt" value="500" label="300 zł">
										<option class="searchopt" value="500" label="500 zł">
										<option class="searchopt" value="1500" label="1 500 zł">
										<option class="searchopt" value="4500" label="3 500 zł">
									</select>
								</datalist>
							</div>
						</div>
						<div style="float: right;">
							<input type="submit" class="submitsearch" name="submitsearch" value="Szukaj"></br>
							<a class="submitsearch" onclick="window.location.href='rtvagd.php?page=<?php if(isset($_GET['page'])){echo $_GET['page'];}else{echo '0';}; ?>'">Usuń filtry</a>
						</div>
					</form>
				</div>
				
				<?php
							$zapytanie = 'SELECT * FROM domogrod_rtvagd WHERE datepromotion > NOW()';
							$zapytanie1 = 'SELECT * FROM domogrod_rtvagd WHERE datepromotion < NOW()';
							if(isset($_GET['submitsearch'])){
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
								
								$_SESSION['nooglerror'] = '<center><div style="font-size: 20px; text-shadow: 1px 1px black; color: #CCC;">
								Nie znaleziono ogłoszeń w podanych kryteriach wyszukiwania,</br> dodaj swoje jako pierwsze!</div></center>';
								
								if(isset($_GET['cenaod']) && $_GET['cenaod'] != '0' && $_GET['cenaod'] != ''){
									$zapytanie = $zapytanie.' AND Cena>="'.$_GET['cenaod'].'"';
									$zapytanie1 = $zapytanie1.' AND Cena>="'.$_GET['cenaod'].'"';
								}
								if(isset($_GET['cenado']) && $_GET['cenado'] != '0' && $_GET['cenado'] != ''){
									$zapytanie = $zapytanie.' AND Cena<="'.$_GET['cenado'].'"';
									$zapytanie1 = $zapytanie1.' AND Cena<="'.$_GET['cenado'].'"';
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
									if($result = $connect->query('SELECT * FROM domogrod_rtvagd')){
										$wyniki = $result->num_rows;
										if($wyniki>0){
											for($r = 1; $r <= $wyniki; $r++){
												$w = $result->fetch_assoc();
												$date = date('Y-m-d H:i:s');
												//echo $date;
												if($w['dateremove'] <= $date){
													for($p=1; $p<=3; $p++){
														if(isset($w['Photo'.$p])){
															$file = '../galeria/aktywne/'.$w['Photo'.$p];
															if(@file_exists($file)){
																@unlink($file);
															}
														}
													}
													@$connect->query('DELETE FROM domogrod_rtvagd WHERE ID='.$w['ID'].'');
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
									
									if($result = $connect->query('SELECT * FROM domogrod_rtvagd')){
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
												echo '<div onclick="window.location = (\'ogloszenia-rtvagd.php?id='.$w['ID'].'\');" class="oglcon1" style="background: #fafad2">';
												echo '<div class="oglimgg">';
												for($i=1; $i<=3; $i++){
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
												echo '<img src="../img/homeandicon1.png" style="margin-left: 15px; width: 30px; float: left;">';
												
												echo '<span style="margin-left: 5px; line-height: 30px;">';
												echo 'Dom i ogród ● Sprzęt RTV/AGD';
												echo '</span></div>';
												
												echo '<div style="height: 55px; font-size: 15px; text-align: left;">';
												
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
												echo '<div onclick="window.location = (\'ogloszenia-rtvagd.php?id='.$w['ID'].'\');" class="oglcon1">';
												echo '<div class="oglimgg">';
												for($i=1; $i<=3; $i++){
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
												echo '<img src="../img/homeandicon1.png" style="margin-left: 15px; width: 30px; float: left;">';
												
												echo '<span style="margin-left: 5px; line-height: 30px;">';
												echo 'Dom i ogród ● Sprzęt RTV/AGD';
												echo '</span></div>';
												
												echo '<div style="height: 55px; font-size: 15px; text-align: left;">';
												
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
								$pytanie = 'SELECT * FROM domogrod_rtvagd';
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

							if(isset($_GET['cenaod'])){
								$link = $link.'&cenaod='.$_GET['cenaod'];
							}
							
							if(isset($_GET['cenado'])){
								$link = $link.'&cenado='.$_GET['cenado'];
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
							<a href="rtvagd.php?page=0'.$link.'&submitsearch=Szukaj">
								<div style="cursor: pointer; margin: 5px; margin-right: -3px; font-size: 25px; border: 1px solid darkred; border-radius: 15px; padding: 10px; background: white; width: 50px;">
									<<
								</div>
							</a>
							
							<a href="rtvagd.php?page='.$pagep.''.$link.'&submitsearch=Szukaj">
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
										echo '<a href="rtvagd.php?page='.$echo.''.$link.'&submitsearch=Szukaj"><div class="pagesquare" style="margin-top: 15px;">'.$p.'</div></a>';
									}else{
										if($echo < $lStron-1){
											echo '<a href="rtvagd.php?page='.$echo.''.$link.'&submitsearch=Szukaj"><div class="pagesquare">'.$p.'</div></a>';
										}
									}
								}
								
							echo '<a href="rtvagd.php?page='.$pagen.''.$link.'&submitsearch=Szukaj">	
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
