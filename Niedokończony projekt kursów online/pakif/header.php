<?php
function headerwrapper()
{
	?>
<!-- Custom styles for this template -->
	<body class="d-flex flex-column h-100">
	<!-- Begin page content -->
		<header>
		
			<div class="sticky">
				<a href="Kontakt.php" class="sticya"><div class="squarekontakt">
					<span class="icon-phone"></span><br>
					<span>Kontakt</span>
				</div></a>
			</div>
		
			<div class="container sticky-top" style="background-color: white; height: 90px; min-width: 100%; box-shadow: 0 4px 2px -2px gray;">
				<nav class="navbar navbar-expand-xl navbar-light info-color" style="font-size: 18px;">
					<a class="navbar-brand" href="#"><b>PAKIF</b></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						
						<ul class="navbar-nav mr-auto">
							<li class="nav-item">
									<a class="nav-link" href="#">Strona główna</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="O-nas.php">O nas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="Nota-prawna.php">Nota prawna</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="Ubezpieczeni.php">Ubezpieczeni</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="Absolwenci.php">Absolwenci</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="Dotacje-dla-bezrobotnych.php">Dotacje dla bezrobotnych</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="Dotacje-dla-firm.php">Dotacje dla firm</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="Kontakt.php">Kontakt</a>
								</li>
						</ul>

						<div class="md-form my-0">
							<ul class="navbar-nav mr-auto">
								
								<li>
									<?php
										if(!isset($_SESSION['uzytkownik'])){
											echo '<a class="nav-link" href="Logowanie.php"><span class="icon-user"><br>Zaloguj się</a></span>';
										}else{
											echo '<a class="nav-link" href="Konto.php"><span class="icon-user"><br>'.$_SESSION['uzytkownik'].'</a></span>';
										}
										?>
								</li>
								<li>
									<?php
									if(!isset($_SESSION['uzytkownik'])){
											echo '<a class="nav-link" href="Koszyk.php"><span class="icon-shopping-basket"><br>Koszyk</a></span>';
										}else{
											echo '<a class="nav-link" href="Wyloguj.php"><span class="icon-logout"><br>Wyloguj</a></span>';
										}
									?>
								</li>
							</ul>


						</div>

					</div>
				</nav>

			</div>
		</header>

	<?php
}
?>
