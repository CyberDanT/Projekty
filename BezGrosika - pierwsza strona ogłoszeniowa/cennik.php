<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>BezGrosika.pl - serwis ogłoszeniowy</title>
		<link rel="shortcut icon" href="img/grosiky.png">
		<link rel ="stylesheet" href="style.css" type="text/css"/>
		<meta name="keywords" content="cennik, ogłoszenia"/>
	</head>
	<body style="background: lightgray;">
	<div id="container">
		<div id="menu">
			<div id="nav">
				<div class="square">
					<div id="logo">
							<a href="index.php" title="Do strony głównej"><img src="img/grosiky.png" id="logopng"><span id="logotit">BezGrosika.PL</span></br>
							<p id="logostyle">Ogłoszenia dla Ciebie</p></a>
					</div>
				</div>
				
				<center>
					<div id="search">
						<div id="search1">
							<span style="font-size: 40px; color: white; text-shadow: 1px 1px black;">Cennik</span>
						</div>
					</div>
				</center>

				<div class="square" style="min-width: 200px; height: 90px;">
					<div id="avctext">
						<a href="mojekonto.php" class="avtext" style="cursor: pointer;">
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
								echo '<a href="logout.php">Wyloguj się';
							}else{
								echo '<a href="register.php">Zarejestruj się';
							}
							?>
						</a>
					</div>				

					<div id="avatar">
					</div>
						<form action="dodaj-ogloszenie.php">
							<input type="submit" id="buttonadd" value="Dodaj ogłoszenie"></input>
						</form>
				</div>
			</div>
		</div>

		<div id="content">
			<div id="wyroznione1">
				<div>Miejsce na Twoją reklamę</div>
			</div>
		
			<div id="main" style="margin-top: -50px;">
				<div style="font-size: 20px; text-align: left; margin-left: 25px;">
					<style>
					.imgcost{
						width: 600px;
						cursor: pointer;
					}
					.divcost{
						width: 600px; 
						margin: auto;
					}
					</style>
					<div class="divcost">
						<div style="margin-top: 25px; margin-bottom: 25px;">
							Zamieszczaj swoje ogłoszenia w wszystkich kategoriach za darmo!</br>
							Ogłoszenia są umieszczane na 30 dni.
						</div>
						<a href="cennik/cennik wyróżnień.png" target="_blank"><img class="imgcost" src="cennik/cennik wyróżnień.png"></a>
					</div>
					<div class="divcost">
						<!-- <a href="cennik/kategorie.png" target="_blank"><img class="imgcost" src="cennik/kategorie.png"></a> -->
					</div>
					<div class="divcost">
						<a href="cennik/cennik monet.png" target="_blank"><img class="imgcost" src="cennik/cennik monet.png"></a>
					</div>
				</div>
				
				<div id="reklama3">
					<div>Miejsce na Twoją reklamę</div>
				</div>
			</div>
			
			<div id="wyroznione2">
				<div>Miejsce na Twoją reklamę</div>
			</div>
			
		</div>
		<?php 
		include_once("footer.php");
		footer(); 
		?>
	</body>
</html>
