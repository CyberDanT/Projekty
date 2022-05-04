<?php
	session_start();
	require_once("../php/connect.php");
	$db_name = $administratorbazy."motoryzacja";
	$count = 16;
	include_once("../footer.php");
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
	<title>Ogłoszenia BezGrosika.PL - samochody ciężarowe</title>
	<meta name="description" content="Motoryzacja, samochody ciężarowe, nowe i używane ciągniki siodłowe na sprzedaż. Sprzedam, kupię, zamienię. DAF - MAN - Iveco - Scania - Volvo - Renault - Mercedes - Jelcz - Star..."/>
	<meta name="keywords" content="ogłoszenia, BezGrosika, .pl, sprzedam, ciągnik siodłowy, ciężarówka, volvo, scania, man, ciężarówka siodłowa, bez grosika, kupie, samochod, osobowe"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,=1"/>
	<link rel="shortcut icon" href="../img/grosiky.png">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/rangeslider.css">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/filters.css">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar container py-0 bg-white" role="banner">

      <!-- <div class="container"> -->
        <div class="row align-items-center">
          
          <img src="../images/grosiky.png" style="height: 50px;"/><div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="../index.php" class="text-black mb-0">Bez<span class="text-primary">Grosika</span>.pl</a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="../index.php">Strona główna</a></li>
                <li><a href="../reklama.php">Reklama</a></li>
                <li><a href="../kontakt.php">Kontakt</a></li>

                <li class="ml-xl-3 login">
					<?php
						if(isset($_SESSION['user'])){
							echo '<a href="../mojekonto.php"><span class="border-left pl-xl-4"></span>'.$_SESSION['user'].'<b><span class="icon-arrow_drop_down"></span></b></a>';
						}else{
							echo '<a href="../login.php"><span class="border-left pl-xl-4"></span>Login</a>';
						}
					?>
				</li>
                <li>
					<?php
						if(isset($_SESSION['logged'])){
							echo '<a href="../logout.php">Wyloguj się';
						}else{
							echo '<a href="../register.php">Rejestracja</a>';
						}
					?>
				</li>

                <li><a href="../dodaj-ogloszenie.php" class="cta"><span class="bg-primary text-white rounded">+ Ogłoszenie</span></a></li>
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>

        </div>

      <!-- </div> -->
      
    </header>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('../images/hero_1.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Samochody ciężarowe</h1>
                <p class="mb-0">Wszystkie ogłoszenia w samochodach ciężarowych</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  

	
	<div class="filters-row-1">
		<form id="myForm" method="get"> 
			<input <?php
				if(@isset($_GET['page'])){ echo 'value ="'.$_GET['page'].'"';} ?> class="filters-input-select" type="hidden" name="page">
				<select id="Marka" class="filters-input-select" name="Marka"> 
					<option <?php  if(@$_GET['Marka'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Marka</option>
					<option <?php  if(@$_GET['Marka'] == 'DAF'){ echo 'selected'; } ?> class="filters-input-option" value="DAF">DAF</option>
					<option <?php  if(@$_GET['Marka'] == 'Iveco'){ echo 'selected'; } ?> class="filters-input-option" value="Iveco">Iveco</option>
					<option <?php  if(@$_GET['Marka'] == 'Jelcz'){ echo 'selected'; } ?> class="filters-input-option" value="Jelcz">Jelcz</option>								
					<option <?php  if(@$_GET['Marka'] == 'MAN'){ echo 'selected'; } ?> class="filters-input-option" value="MAN">MAN</option>
					<option <?php  if(@$_GET['Marka'] == 'Mercedes'){ echo 'selected'; } ?> class="filters-input-option" value="Mercedes">Mercedes</option>
					<option <?php  if(@$_GET['Marka'] == 'Renault'){ echo 'selected'; } ?> class="filters-input-option" value="Renault">Renault</option>
					<option <?php  if(@$_GET['Marka'] == 'Scania'){ echo 'selected'; } ?> class="filters-input-option" value="Scania">Scania</option>
					<option <?php  if(@$_GET['Marka'] == 'Star'){ echo 'selected'; } ?> class="filters-input-option" value="Star">Star</option>
					<option <?php  if(@$_GET['Marka'] == 'Volvo'){ echo 'selected'; } ?> class="filters-input-option" value="Volvo">Volvo</option>
					<option <?php  if(@$_GET['Marka'] == 'Inna marka'){ echo 'selected'; } ?> class="filters-input-option" value="Inna marka">Inna marka</option>
				</select>
				
				<select class="filters-input-select" id="Paliwo" name="Paliwo">
					<option <?php if(@$_GET['Paliwo'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Paliwo</option>
					<option <?php if(@$_GET['Paliwo'] == 'Diesel'){ echo 'selected'; } ?> class="filters-input-option" value="Diesel">Diesel</option>
					<option <?php if(@$_GET['Paliwo'] == 'Elektryczny'){ echo 'selected'; } ?> class="filters-input-option" value="Elektryczny">Elektryczny</option>
					<option <?php if(@$_GET['Paliwo'] == 'Hybryda(Diesel)'){ echo 'selected'; } ?> class="filters-input-option" value="Hybryda(Diesel)">Hybryda(Diesel)</option>
				</select>

				<select class="filters-input-select" id="Skrzynia" name="Skrzynia">
					<option <?php if(@$_GET['Skrzynia'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Skrzynia biegów</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Automatyczna'){ echo 'selected'; } ?> class="filters-input-option" value="Automatyczna">Automatyczna</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Manualna'){ echo 'selected'; } ?> class="filters-input-option" value="Manualna">Manualna</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Sekwencyjna'){ echo 'selected'; } ?> class="filters-input-option" value="Sekwencyjna">Sekwencyjna</option>
				</select>
				
				<select class="filters-input-select" id="Kolor" name="Kolor">
					<option <?php if(@$_GET['Skrzynia'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Kolor</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Bialy'){ echo 'selected'; } ?> class="filters-input-option" value="Bialy">Biały</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Czarny'){ echo 'selected'; } ?> class="filters-input-option" value="Czarny">Czarny</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Czerwony'){ echo 'selected'; } ?> class="filters-input-option" value="Czerwony">Czerwony</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Niebieski'){ echo 'selected'; } ?> class="filters-input-option" value="Niebieski">Niebieski</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Srebny'){ echo 'selected'; } ?> class="filters-input-option" value="Srebny">Srebny</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Szary'){ echo 'selected'; } ?> class="filters-input-option" value="Szary">Szary</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Zielony'){ echo 'selected'; } ?> class="filters-input-option" value="Zielony">Zielony</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Zolty'){ echo 'selected'; } ?> class="filters-input-option" value="Zolty">Żółty</option>
					<option <?php if(@$_GET['Skrzynia'] == 'Inny'){ echo 'selected'; } ?> class="filters-input-option" value="Inny">Inny</option>
				</select>

				<select class="filters-input-select" id="Stantechniczny" name="Stantechniczny">
					<option <?php if(@$_GET['Stantechniczny'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Stan techniczny</option>
					<option <?php if(@$_GET['Stantechniczny'] == 'Nieuszkodzony'){ echo 'selected'; } ?> class="filters-input-option" value="Nieuszkodzony">Nieuszkodzony</option>
					<option <?php if(@$_GET['Stantechniczny'] == 'Uszkodzony'){ echo 'selected'; } ?> class="filters-input-option" value="Uszkodzony">Uszkodzony</option>
				</select>
				
				<select class="filters-input-select" id="Stanuzytkowy" name="Stanuzytkowy">
					<option <?php if(@$_GET['Stanuzytkowy'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Stan użytkowy</option>
					<option <?php if(@$_GET['Stanuzytkowy'] == 'Nowy'){ echo 'selected'; } ?> class="filters-input-option" value="Nowy">Nowy</option>
					<option <?php if(@$_GET['Stanuzytkowy'] == 'Uzywany'){ echo 'selected'; } ?> class="filters-input-option" value="Uzywany">Używany</option>
				</select>
				
				<input <?php if(@isset($_GET['cenaod'])){ echo 'value ="'.$_GET['cenaod'].'"'; } ?> class="filters-input-select" type="text" maxlength="7" name="cenaod" list="cena" placeholder="Cena od" onclick='document.getElementById("cs").style="display: block;";' onkeydown="return noNum(event)">
				<input <?php if(@isset($_GET['cenado'])){ echo 'value ="'.$_GET['cenado'].'"'; } ?> class="filters-input-select" type="text" maxlength="7" name="cenado" list="cena" placeholder="Cena do" onclick='document.getElementById("cs").style="display: block;";' onkeydown="return noNum(event)">
				<datalist id="cena">
					<select id="cs">
						<option class="filters-input-option" value="4500" label="4 500 zł">
						<option class="filters-input-option" value="6000" label="6 000 zł">
						<option class="filters-input-option" value="8000" label="8 000 zł">
						<option class="filters-input-option" value="10000" label="10 000 zł">
						<option class="filters-input-option" value="15000" label="15 000 zł">
						<option class="filters-input-option" value="20000" label="20 000 zł">
						<option class="filters-input-option" value="50000" label="50 000 zł">
						<option class="filters-input-option" value="70000" label="70 000 zł">
						<option class="filters-input-option" value="100000" label="100 000 zł">
						<option class="filters-input-option" value="150000" label="150 000 zł">
						<option class="filters-input-option" value="200000" label="200 000 zł">
						<option class="filters-input-option" value="300000" label="300 000 zł">
					</select>
				</datalist>
			
				<input <?php if(@isset($_GET['rok_produkcjiod'])){ echo 'value ="'.$_GET['rok_produkcjiod'].'"'; } ?> class="filters-input-select" type="text" maxlength="4" name="rok_produkcjiod" list="rok_produkcji" placeholder="Rok prod. od" onclick='document.getElementById("rp").style="display: block;";' onkeydown="return noNum(event)">
				<input <?php if(@isset($_GET['rok_produkcjido'])){ echo 'value ="'.$_GET['rok_produkcjido'].'"'; } ?> class="filters-input-select" type="text" maxlength="4" name="rok_produkcjido" list="rok_produkcji" placeholder="Rok prod. do" onclick='document.getElementById("rp").style="display: block;";' onkeydown="return noNum(event)">
				<datalist id="rok_produkcji">
					<select id="rp">
						<option class="filters-input-option" value="2000" label="2000">
						<option class="filters-input-option" value="2001" label="2001">
						<option class="filters-input-option" value="2002" label="2002">
						<option class="filters-input-option" value="2003" label="2003">
						<option class="filters-input-option" value="2004" label="2004">
						<option class="filters-input-option" value="2005" label="2005">
						<option class="filters-input-option" value="2006" label="2006">
						<option class="filters-input-option" value="2007" label="2007">
						<option class="filters-input-option" value="2008" label="2008">
						<option class="filters-input-option" value="2009" label="2009">
						<option class="filters-input-option" value="2010" label="2010">
						<option class="filters-input-option" value="2011" label="2011">
						<option class="filters-input-option" value="2012" label="2012">
						<option class="filters-input-option" value="2013" label="2013">
						<option class="filters-input-option" value="2014" label="2014">
						<option class="filters-input-option" value="2015" label="2015">
						<option class="filters-input-option" value="2016" label="2016">
						<option class="filters-input-option" value="2017" label="2017">
						<option class="filters-input-option" value="2018" label="2018">
						<option class="filters-input-option" value="2019" label="2019">
					</select>
				</datalist>
			
				<input <?php if(@isset($_GET['moc_silnikaod'])){ echo 'value ="'.$_GET['moc_silnikaod'].'"'; } ?> class="filters-input-select" type="text" maxlength="4" name="moc_silnikaod" list="moc_silnika" placeholder="Moc silnika od" onclick='document.getElementById("ms").style="display: block;";' onkeydown="return noNum(event)">
				<input <?php if(@isset($_GET['moc_silnikado'])){ echo 'value ="'.$_GET['moc_silnikado'].'"'; } ?> class="filters-input-select" type="text" maxlength="4" name="moc_silnikado" list="moc_silnika" placeholder="Moc silnika do" onclick='document.getElementById("ms").style="display: block;";' onkeydown="return noNum(event)">
				<datalist id="moc_silnika">
					<select id="ms">
						<option class="filters-input-option" value="100" label="100 KM">
						<option class="filters-input-option" value="300" label="300 KM">
						<option class="filters-input-option" value="500" label="500 KM">
						<option class="filters-input-option" value="600" label="600 KM">
						<option class="filters-input-option" value="700" label="700 KM">
						<option class="filters-input-option" value="800" label="800 KM">
					</select>
				</datalist>
		
				<input <?php if(@isset($_GET['poj_silnikaod'])){ echo 'value ="'.$_GET['poj_silnikaod'].'"'; } ?> class="filters-input-select" type="text" maxlength="5" name="poj_silnikaod" list="poj_silnika" placeholder="Poj. silnika od" onclick='document.getElementById("ps").style="display: block;";' onkeydown="return noNum(event)">
				<input <?php if(@isset($_GET['poj_silnikado'])){ echo 'value ="'.$_GET['poj_silnikado'].'"'; } ?> class="filters-input-select" type="text" maxlength="5" name="poj_silnikado" list="poj_silnika" placeholder="Poj. silnika do" onclick='document.getElementById("ps").style="display: block;";' onkeydown="return noNum(event)">
				<datalist id="poj_silnika">
					<select id="ps">
						<option class="filters-input-option" value="4000" label="4 000 cm³">
						<option class="filters-input-option" value="6000" label="6 000 cm³">
						<option class="filters-input-option" value="8000" label="8 000 cm³">
						<option class="filters-input-option" value="10000" label="10 000 cm³">
						<option class="filters-input-option" value="12000" label="12 000 cm³">
						<option class="filters-input-option" value="15000" label="15 000 cm³">
					</select>
				</datalist>

				<input <?php if(@isset($_GET['przebiegod'])){ echo 'value ="'.$_GET['przebiegod'].'"'; } ?> class="filters-input-select" type="text" maxlength="8" name="przebiegod" list="przebieg" placeholder="Przebieg od" onclick='document.getElementById("prs").style="display: block;";' onkeydown="return noNum(event)">
				<input <?php if(@isset($_GET['przebiegdo'])){ echo 'value ="'.$_GET['przebiegdo'].'"'; } ?> class="filters-input-select" type="text" maxlength="8" name="przebiegdo" list="przebieg" placeholder="Przebieg do" onclick='document.getElementById("prs").style="display: block;";' onkeydown="return noNum(event)">
				<datalist id="przebieg">
					<select id="prs">
						<option class="filters-input-option" value="500" label="500 km">
						<option class="filters-input-option" value="1000" label="1 000 km">
						<option class="filters-input-option" value="5000" label="5 000 km">
						<option class="filters-input-option" value="30000" label="30 000 km">
						<option class="filters-input-option" value="50000" label="50 000 km">
						<option class="filters-input-option" value="100000" label="100 000 km">
						<option class="filters-input-option" value="150000" label="150 000 km">
						<option class="filters-input-option" value="200000" label="200 000 km">
						<option class="filters-input-option" value="250000" label="250 000 km">
						<option class="filters-input-option" value="300000" label="300 000 km">
						<option class="filters-input-option" value="400000" label="400 000 km">
					</select>
				</datalist>

				<div>
					<span class="filters-row-2"><input type="submit" class="filters-input-btn" name="submitsearch" value="Filtruj wyniki"></span>
					<span class="filters-row-3"><a class="filters-input-a" onclick="window.location.href='samochodyciezarowe.php?page=<?php if(isset($_GET['page'])){echo $_GET['page'];}else{echo '0';}; ?>'">Usuń filtry</a></span>
				</div>
		</form>

	</div>
	
	
	<div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 text-left border-primary">
            <h2 class="font-weight-light text-primary">Wszystkie w samochody ciężarowe</h2>
          </div>
        </div>
        <div class="row mt-5">
		
		  <!-- Ogłoszenia promowane -->
		  
		  <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <a href="#" class="img d-block" style="background-image: url('../images/img_1.jpg')"></a>
              <div class="lh-content">
                <span class="category" style="background-color: #f89d13;">Motoryzacja</span>
				<a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a></a>
                <h3><a href="#">Samochód na sprzedaż</a></h3>
                <address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> 185 500 PLN</address>
              </div>
            </div>
		  </div>

		<!-- Ogłoszenia zwykłe -->
          <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <a href="#" class="img d-block" style="background-image: url('../images/img_1.jpg')"></a>
              <div class="lh-content">
                <span class="category">Motoryzacja</span>
                <h3><a href="#">Samochód na sprzedaż</a></h3>
                <address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> 185 500 PLN</address>
              </div>
            </div>
		  </div>
		  
			
		<?php
							$zapytanie = 'SELECT * FROM samochody_ciezarowe WHERE datepromotion > NOW()';
							$zapytanie1 = 'SELECT * FROM samochody_ciezarowe WHERE datepromotion < NOW()';
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
									if(!(($_GET['Paliwo'] == 'Diesel') || ($_GET['Paliwo'] == 'Elektryczny') || ($_GET['Paliwo'] == 'Hybryda(Diesel)'))){
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
									if($result = $connect->query('SELECT * FROM samochody_ciezarowe')){
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
													@$connect->query('DELETE FROM samochody_ciezarowe WHERE ID='.$w['ID'].'');
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
									
									if($result = $connect->query('SELECT * FROM samochody_ciezarowe')){
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
												
												$Cena = $w['Cena'];
												$Tytul = mb_substr($w['Tytul'], 0, 20);
												//if($w['Kategoria1'] != 'Oddam za darmo'){
													$Cena = number_format($w['Cena'],0," "," ");
												//}
												
												echo '
												<div class="col-lg-6">
													<div class="d-block d-md-flex listing">';

												for($i=1; $i<=8; $i++){
													if($w['Photo'.$i] != ''){
														$file = '../galeria/aktywne/'.$w['Photo'.$i];
														if(!isset($glowne)){
															if(@file_exists($file)){
																$glowne = $w['Photo'.$i];
																echo '<a href="ogloszenia-samochody-ciezarowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../galeria/aktywne/'.$w['Photo'.$i].'\')"></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<a href="ogloszenia-samochody-ciezarowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../img/camera.png\')"></a>';
												}
												echo '
												<div class="lh-content">
														<span class="category" style="background-color: #f89d13;">Motoryzacja</span>
														<a href="ogloszenia-samochody-ciezarowe.php?id='.$w['ID'].'" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a>
														<h3><a href="ogloszenia-samochody-ciezarowe.php?id='.$w['ID'].'" title="'.$w['Tytul'].'">'.$Tytul.'</a></h3>
														<address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> '.$Cena.' PLN';
														if($w['Negocjacja'] == 'on'){
															echo ' do negocjacji';
														}
														echo '</address>
													  </div>
													</div>
												  </div>';
												
												unset($glowne);
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
												$Cena = $w['Cena'];
												$Tytul = mb_substr($w['Tytul'], 0, 20);
												//if($w['Kategoria1'] != 'Oddam za darmo'){
													$Cena = number_format($w['Cena'],0," "," ");
												//}
												
												echo '
												<div class="col-lg-6">
													<div class="d-block d-md-flex listing">';

												for($i=1; $i<=8; $i++){
													if($w['Photo'.$i] != ''){
														$file = '../galeria/aktywne/'.$w['Photo'.$i];
														if(!isset($glowne)){
															if(@file_exists($file)){
																$glowne = $w['Photo'.$i];
																echo '<a href="ogloszenia-samochody-ciezarowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../galeria/aktywne/'.$w['Photo'.$i].'\')"></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<a href="ogloszenia-samochody-ciezarowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../img/camera.png\')"></a>';
												}
												echo '
												<div class="lh-content">
														<span class="category">Motoryzacja</span>
														<h3><a href="ogloszenia-samochody-ciezarowe.php?id='.$w['ID'].'" title="'.$w['Tytul'].'">'.$Tytul.'</a></h3>
														<address style="display: inline-block;"><span style="display: inline-block;" class="icon-tags"></span> '.$Cena.' PLN';
														if($w['Negocjacja'] == 'on'){
															echo ' do negocjacji';
														}
														echo '</address>
													  </div>
													</div>
												  </div>';
												
												unset($glowne);
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
				</div>
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
								$pytanie = 'SELECT * FROM samochody_ciezarowe';
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
							
							$seepage = $showpage+1;
							$nextpage = $page + 1;
							$seepreviouspage = $showpage-1;
							$previouspage = $page - 1;
							
							// <a href="search.php?page='.$pagen.'">
							echo '
							<div class="col-12 mt-5 text-center">
							  <div class="custom-pagination">';
								if($lStron != 0){
									if($showpage != 1){
										echo '<a href="samochodyciezarowe.php?page='.$previouspage.$link.'&submitsearch=Szukaj">'.$seepreviouspage.'</a>';
									}else{
										echo '<a href="#">_</a>';
									}
								  
									echo '<span>'.$showpage.'</span>';
									
									if($lStron == $showpage){
										echo '<a href="#">_</a>';
									}else{
										echo '<a href="samochodyciezarowe.php?page='.$nextpage.$link.'&submitsearch=Szukaj">'.$seepage.'</a>';
									}
									
									echo '<span class="more-page">...</span>
									<a href="#">'.$lStron.'</a>';
									
								}else{
									echo '<a href="#">_</a>
									<span>1</span>
									<a href="#">_</a>
									<span class="more-page">...</span>
									<a href="#">1</a>';
								}
								
								echo '
							  </div>
							</div>';
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
		
      </div>
    </div>	
	

	<?php
		include_once("../footer.php");
		footer();
	?>
  </div>

  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/jquery.countdown.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/bootstrap-datepicker.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/rangeslider.min.js"></script>

  <script src="../js/main.js"></script>
  </body>
</html>