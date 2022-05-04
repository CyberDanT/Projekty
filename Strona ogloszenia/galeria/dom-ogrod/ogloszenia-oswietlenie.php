<?php
include_once("../footer.php");
@session_start();

if(isset($_GET['id'])){
	if(is_numeric($_GET['id'])){
		$ID = $_GET['id'];
		//echo "ID ogłoszenia przeszło: ".$_GET['id'];
	}else{
		$ID = '';
		//header("Location ../index.php");
	}
}
$_SESSION['info_ogl'] = 'dom i ogrod';
$_SESSION['info_ogl2'] = 'oswietlenie';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>BezGrosika.pl - serwis ogłoszeniowy</title>
		<link rel="shortcut icon" href="../img/grosiky.png">
		<link rel ="stylesheet" href="../ogstyle.css" type="text/css"/>
		<meta name="keywords" content="dom i ogród, oświetlenie, ledy, zarowki"/>
	</head>
	<body style="background: lightgray;">
	<div id="container">
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
							<span style="font-size: 40px; color: white; text-shadow: 1px 1px black;">Oświetlenie</span>
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

		

<?php
	require_once("../php/connect.php");
	$db_name = $administratorbazy."domiogrod";
	$zapytanie = 'SELECT * FROM domogrod_oswietlenie WHERE ID="'.$ID.'"';
	
	// zapytania może w pliku albo każdy ma przypisane zapytanie do siebie pod $_SESSION i zmienia je podczas zmiany na górze parametrów
	// w wyszukiwarce
	
for($i = 1; $i<=8; $i++){
	unset($_SESSION['Photo'.$i]);
}


mysqli_report(MYSQLI_REPORT_STRICT);
try{
	$connect = new mysqli($host, $db_user, $db_password, $db_name);
	if($connect->connect_errno!=0){
		throw new Exception(mysqli_connect_errno());
	}//else{
		//$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	//}
			
	if (!$connect->set_charset("utf8")) {
		printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
		exit();
		
	}else{
		if(is_numeric($ID)){
			if($result = @$connect->query(sprintf($zapytanie))){
				$wyniki = $result->num_rows;
				if($wyniki>0){
					//echo "</br>Oddane wyniki: ".$wyniki;
					$w = $result->fetch_assoc();
					
					if($w['ID'] != ''){
						for($i = 1; $i<=3; $i++){
							if($w['Photo'.$i] != ''){
								$_SESSION['Photo'.$i] = $w['Photo'.$i];
							}
						}
						
						
						// Pierwszy odzielnik z napisem np: tytułem nad zdjęciami
						echo '<center><div style="margin-top: 25px; margin-left: 10px; margin-right: 10px; box-shadow: 0px 10px 10px -10px gray, 0px -10px 10px -10px gray;">';
						echo '<div class="oglcontit" style="color: red; text-shadow: 1px 1px black;">'.$w['Tytul'].'</div></div>';
						
						//Div ze zdjęciami tutaj spróbować zablokować jeśli ktoś da więcej zdjęć niż powinien // raczej ok
						echo '<div style="margin-left: auto; margin-right: auto; height: 500px;">';
						echo '<iframe src="galeria.php" style="border: none; border-top: 1px solid darkgray; border-bottom: 3px solid darkgray; height: 500px; min-width: 700px; background-color: lightgray;">';
						echo '</iframe></div>';
						
						// Drugi oddzielnik (1 pod zdjęciem), zgłoś, odśwież, wyróżnij:
							echo '<div style="margin-top: 5px; margin-left: 10px; margin-right: 10px; box-shadow: 0px 10px 10px -10px gray, 0px -10px 10px -10px gray;">';
							echo '<div style="height: 45px; font-size: 25px; color: #CCC; text-shadow: 1px 1px black;">
										
										<div class="zna">
											<form method="post" target = "_blank" action="../zglosnaduzycie.php">
												<input type="hidden" name="category" value="domogrod_oswietlenie">
												<input type="hidden" name="id" value="'.$ID.'">
												<label style="cursor: pointer;">Zgłoś nadużycie<input type="submit" name="zgloszenie" style="display: none;"></label>
											</form>
										</div>
										
										
										<div class="ref">
											<form method="post" target = "_blank" action="../refresh.php">
												<input type="hidden" name="category" value="domogrod_oswietlenie">
												<input type="hidden" name="id" value="'.$ID.'">
												<label style="cursor: pointer;"><img src="../img/refresh.png" style="width: 25px; vertical-align: middle; margin-right: 5px;">Odśwież<input type="submit" name="refresh" style="display: none;"</label>
											</form>
										</div>
										
										<div class="promotiontext">
											<form method="post" target = "_blank" action="../promotion.php">
												<input type="hidden" name="category" value="domogrod_oswietlenie">
												<input type="hidden" name="id" value="'.$ID.'">
												<label style="cursor: pointer;">Wyróżnij ogłoszenie<input type="submit" name="promotion" style="display: none;"</label>
											</form>
										</div>
									</div></div>';
								
								//Opis ogłoszenia (pasek)
								echo '<div class="oglci2"><b><i>Opis ogłoszenia</i></b></div>';
								
								//Opis ogłoszenia pod paskiem
								echo '<div class="oglci3">
								<div style="color: #CCC; font-size: 20px; text-shadow: 1px 1px black; width: 680px;">'.$w['Opis'].'</div></div>';
						
								//Kontakt itp
								echo '<div style="margin-top: 25px;">
											<div style="display: inline-table; margin-right: 150px;">
												<div class="oglci5"><b><i>Kontakt</i></b></div>
													<div class="oglci3">';
														echo '<div style="font-size: 25px; color: #CCC; text-shadow: 1px 1px black;"><img src ="../img/avatar1.png" style="width: 30px; margin-right: 10px; vertical-align: middle;"/><a class="usersogls" href="../ogloszenia-uzytkownika.php?user='.$w['user'].'">'.$w['user'].'</a></div>';
														if(isset($w['Ktelefon'])){
															echo '<div style="font-size: 25px; color: #CCC; text-shadow: 1px 1px black; margin-top: 10px;"><img src ="../img/phone1.png" style="width: 30px; margin-right: 10px; vertical-align: middle;"/>'.$w['Ktelefon'].'</div>';
														}
														if($w['Kemail'] != ''){
															echo '<div style="font-size: 25px; color: #CCC; text-shadow: 1px 1px black; margin-top: 10px;"><img src ="../img/mail1.png" style="width: 30px; margin-right: 10px; vertical-align: middle;"/>'.$w['Kemail'].'</div>';
														}
														echo '<div style="font-size: 25px; color: #CCC; text-shadow: 1px 1px black; margin-top: 10px;"><img src ="../img/location1.png" style="width: 30px; margin-right: 10px; vertical-align: middle;"/>'.$w['Wojewodztwo'].'</div>';
														if($w['Miejscowosc'] != ''){
															echo '<div style="font-size: 25px; color: #CCC; text-shadow: 1px 1px black; margin-top: 10px;"><img src ="../img/location1.png" style="width: 30px; margin-right: 10px; vertical-align: middle;"/>'.$w['Miejscowosc'].'</div>';
														}
								echo'			</div>
											</div>';
											
											// CENA
												echo '<div style="display: inline-table; margin-left: 150px;">
														<div class="oglci5"><b><i>Cena</i></b></div>
														<div class="oglci3">
															<div style="display: inline-flex; float: right; text-align: center; margin-right: 25px;">';
																$Cena = number_format($w['Cena'],0," "," ");
																echo '<span style="color: red; font-size: 50px;"><b>/</b></span><span style="font-size: 30px;">'.$Cena.' <span style="font-size: 18px;">ZŁ</span>';
																if($w['Negocjacja'] == 'on'){
																	echo '<div style="font-size: 15px;">Bez Grosika, Do negocjacji</div>';
																}else{
																	echo '<div style="font-size: 15px; margin-left: 10px;">Bez Grosika</div>';
																}
																echo '</div>
														</div>
													</div>';
					
								echo '</div></center>';				
							
						$result->free_result();
					}else{
						header("Location: ../index.php");
					}
					$connect->close();
					//echo '<span style="color:red;"></br>Zamknięto połączenie';
				}else{
					throw new Exception($connect->error);
				}
			}else{
				$connect->close();
				header("Location: ../index.php");
			}
		}
	}
}
catch(Exception $error){
	echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
	// // echo '</br>Informacja developerska:</br>'.$error;
}
?>
			<div id="reklama3">
				<div>Miejsce na Twoją reklamę</div>
			</div>
		</div>
		
		<div id="wyroznione2">
			<div>Miejsce na Twoją reklamę</div>
        </div>
		
		<?php footer(); ?>
	</body>
</html>
