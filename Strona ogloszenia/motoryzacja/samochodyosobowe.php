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
    <title>Ogłoszenia BezGrosika.PL - samochody osobowe</title>
	<meta name="description" content="Motoryzacja, samochody osobowe, nowe i używane auta na sprzedaż. Sprzedam, kupię, zamienię. Volkswagen - Audi - BMW - Opel - Ford - Toyota - Kia - Mercedes - Peugeot..."/>
	<meta name="keywords" content="ogłoszenia, ogłoszenia samochody osobowe, BezGrosika, .pl, bez grosika, sprzedam, kupie, samochod, osobowe, grosik, grosika, bez, samochody, audi, bmw, volkswagen, sprzedam vw passsat"/>
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
                <h1>Samochody osobowe</h1>
                <p class="mb-0">Wszystkie ogłoszenia w samochodach osobowych</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  

	
	<div class="filters-row-1">
		<form id="myForm" method="get"> 
			<select id="Marka" class="filters-input-select" name="Marka"> 
				<option <?php  if(@$_GET['Marka'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Marka</option>
				<option <?php  if(@$_GET['Marka'] == 'Abarth'){ echo 'selected'; } ?> class="filters-input-option" value="Abarth">Abarth</option>
				<option <?php  if(@$_GET['Marka'] == 'Acura'){ echo 'selected'; } ?> class="filters-input-option" value="Acura">Acura</option>
				<option <?php  if(@$_GET['Marka'] == 'Alfa Romeo'){ echo 'selected'; } ?> class="filters-input-option" value="Alfa Romeo">Alfa Romeo</option>								
				<option <?php  if(@$_GET['Marka'] == 'Aston Martin'){ echo 'selected'; } ?> class="filters-input-option" value="Aston Martin">Aston Martin</option>
				<option <?php  if(@$_GET['Marka'] == 'Audi'){ echo 'selected'; } ?> class="filters-input-option" value="Audi">Audi</option>
				<option <?php  if(@$_GET['Marka'] == 'Bentley'){ echo 'selected'; } ?> class="filters-input-option" value="Bentley">Bentley</option>
				<option <?php  if(@$_GET['Marka'] == 'BMW'){ echo 'selected'; } ?> class="filters-input-option" value="BMW">BMW</option>
				<option <?php  if(@$_GET['Marka'] == 'Bugatti'){ echo 'selected'; } ?> class="filters-input-option" value="Bugatti">Bugatti</option>
				<option <?php  if(@$_GET['Marka'] == 'Cadilac'){ echo 'selected'; } ?> class="filters-input-option" value="Cadilac">Cadilac</option>
				<option <?php  if(@$_GET['Marka'] == 'Chevrolet'){ echo 'selected'; } ?> class="filters-input-option" value="Chevrolet">Chevrolet</option>
				<option <?php  if(@$_GET['Marka'] == 'Chrysler'){ echo 'selected'; } ?> class="filters-input-option" value="Chrysler">Chrysler</option>
				<option <?php  if(@$_GET['Marka'] == 'Citroen'){ echo 'selected'; } ?> class="filters-input-option" value="Citroen">Citroen</option>
				<option <?php  if(@$_GET['Marka'] == 'Dacia'){ echo 'selected'; } ?> class="filters-input-option" value="Dacia">Dacia</option>
				<option <?php  if(@$_GET['Marka'] == 'Daewoo'){ echo 'selected'; } ?> class="filters-input-option" value="Daewoo">Daewoo</option>
				<option <?php  if(@$_GET['Marka'] == 'Daihatsu'){ echo 'selected'; } ?> class="filters-input-option" value="Daihatsu">Daihatsu</option>								
				<option <?php  if(@$_GET['Marka'] == 'Dodge'){ echo 'selected'; } ?> class="filters-input-option" value="Dodge">Dodge</option>
				<option <?php  if(@$_GET['Marka'] == 'Ferrari'){ echo 'selected'; } ?> class="filters-input-option" value="Ferrari">Ferrari</option>
				<option <?php  if(@$_GET['Marka'] == 'Fiat'){ echo 'selected'; } ?> class="filters-input-option" value="Fiat">Fiat</option>
				<option <?php  if(@$_GET['Marka'] == 'Ford'){ echo 'selected'; } ?> class="filters-input-option" value="Ford">Ford</option>
				<option <?php  if(@$_GET['Marka'] == 'Honda'){ echo 'selected'; } ?> class="filters-input-option" value="Honda">Honda</option>
				<option <?php  if(@$_GET['Marka'] == 'Hyundai'){ echo 'selected'; } ?> class="filters-input-option" value="Hyundai">Hyundai</option>
				<option <?php  if(@$_GET['Marka'] == 'Infiniti'){ echo 'selected'; } ?> class="filters-input-option" value="Infiniti">Infiniti</option>
				<option <?php  if(@$_GET['Marka'] == 'Jaguar'){ echo 'selected'; } ?> class="filters-input-option" value="Jaguar">Jaguar</option>
				<option <?php  if(@$_GET['Marka'] == 'Jeep'){ echo 'selected'; } ?> class="filters-input-option" value="Jeep">Jeep</option>
				<option <?php  if(@$_GET['Marka'] == 'Kia'){ echo 'selected'; } ?> class="filters-input-option" value="Kia">Kia</option>
				<option <?php  if(@$_GET['Marka'] == 'Lamborghini'){ echo 'selected'; } ?> class="filters-input-option" value="Lamborghini">Lamborghini</option>
				<option <?php  if(@$_GET['Marka'] == 'Lancia'){ echo 'selected'; } ?> class="filters-input-option" value="Lancia">Lancia</option>
				<option <?php  if(@$_GET['Marka'] == 'Land Rover'){ echo 'selected'; } ?> class="filters-input-option" value="Land Rover">Land Rover</option>
				<option <?php  if(@$_GET['Marka'] == 'Lexus'){ echo 'selected'; } ?> class="filters-input-option" value="Lexus">Lexus</option>
				<option <?php  if(@$_GET['Marka'] == 'Lincoln'){ echo 'selected'; } ?> class="filters-input-option" value="Lincoln">Lincoln</option>
				<option <?php  if(@$_GET['Marka'] == 'Lotus'){ echo 'selected'; } ?> class="filters-input-option" value="Lotus">Lotus</option>
				<option <?php  if(@$_GET['Marka'] == 'Maserati'){ echo 'selected'; } ?> class="filters-input-option" value="Maserati">Maserati</option>
				<option <?php  if(@$_GET['Marka'] == 'Mazda'){ echo 'selected'; } ?> class="filters-input-option" value="Mazda">Mazda</option>
				<option <?php  if(@$_GET['Marka'] == 'McLaren'){ echo 'selected'; } ?> class="filters-input-option" value="McLaren">McLaren</option>
				<option <?php  if(@$_GET['Marka'] == 'Mercedes'){ echo 'selected'; } ?> class="filters-input-option" value="Mercedes">Mercedes</option>
				<option <?php  if(@$_GET['Marka'] == 'MicroCar'){ echo 'selected'; } ?> class="filters-input-option" value="MicroCar">MicroCar</option>
				<option <?php  if(@$_GET['Marka'] == 'Mini'){ echo 'selected'; } ?> class="filters-input-option" value="Mini">Mini</option>
				<option <?php  if(@$_GET['Marka'] == 'Mitsubishi'){ echo 'selected'; } ?> class="filters-input-option" value="Mitsubishi">Mitsubishi</option>
				<option <?php  if(@$_GET['Marka'] == 'Nissan'){ echo 'selected'; } ?> class="filters-input-option" value="Nissan">Nissan</option>
				<option <?php  if(@$_GET['Marka'] == 'Opel'){ echo 'selected'; } ?> class="filters-input-option" value="Opel">Opel</option>
				<option <?php  if(@$_GET['Marka'] == 'Peugeot'){ echo 'selected'; } ?> class="filters-input-option" value="Peugeot">Peugeot</option>
				<option <?php  if(@$_GET['Marka'] == 'Polonez'){ echo 'selected'; } ?> class="filters-input-option" value="Polonez">Polonez</option>
				<option <?php  if(@$_GET['Marka'] == 'Porsche'){ echo 'selected'; } ?> class="filters-input-option" value="Porsche">Porsche</option>								
				<option <?php  if(@$_GET['Marka'] == 'Renault'){ echo 'selected'; } ?> class="filters-input-option" value="Renault">Renault</option>
				<option <?php  if(@$_GET['Marka'] == 'Rolls Royce'){ echo 'selected'; } ?> class="filters-input-option" value="Rolls Royce">Rolls Royce</option>
				<option <?php  if(@$_GET['Marka'] == 'Rover'){ echo 'selected'; } ?> class="filters-input-option" value="Rover">Rover</option>
				<option <?php  if(@$_GET['Marka'] == 'Saab'){ echo 'selected'; } ?> class="filters-input-option" value="Saab">Saab</option>
				<option <?php  if(@$_GET['Marka'] == 'Seat'){ echo 'selected'; } ?> class="filters-input-option" value="Seat">Seat</option>
				<option <?php  if(@$_GET['Marka'] == 'Skoda'){ echo 'selected'; } ?> class="filters-input-option" value="Skoda">Skoda</option>
				<option <?php  if(@$_GET['Marka'] == 'Smart'){ echo 'selected'; } ?> class="filters-input-option" value="Smart">Smart</option>								
				<option <?php  if(@$_GET['Marka'] == 'SsangYong'){ echo 'selected'; } ?> class="filters-input-option" value="SsangYong">SsangYong</option>
				<option <?php  if(@$_GET['Marka'] == 'Subaru'){ echo 'selected'; } ?> class="filters-input-option" value="Subaru">Subaru</option>
				<option <?php  if(@$_GET['Marka'] == 'Suzuki'){ echo 'selected'; } ?> class="filters-input-option" value="Suzuki">Suzuki</option>
				<option <?php  if(@$_GET['Marka'] == 'Tesla'){ echo 'selected'; } ?> class="filters-input-option" value="Tesla">Tesla</option>
				<option <?php  if(@$_GET['Marka'] == 'Toyota'){ echo 'selected'; } ?> class="filters-input-option" value="Toyota">Toyota</option>
				<option <?php  if(@$_GET['Marka'] == 'Volkswagen'){ echo 'selected'; } ?> class="filters-input-option" value="Volkswagen">Volkswagen</option>
				<option <?php  if(@$_GET['Marka'] == 'Volvo'){ echo 'selected'; } ?> class="filters-input-option" value="Volvo">Volvo</option>
				<option <?php  if(@$_GET['Marka'] == 'Zabytkowe'){ echo 'selected'; } ?> class="filters-input-option" value="Zabytkowe">Zabytkowe</option>
				<option <?php  if(@$_GET['Marka'] == 'Inna marka'){ echo 'selected'; } ?> class="filters-input-option" value="Inna marka">Inna marka</option>
			</select>
			<select class="filters-input-select" id="Model" name="Model">
				<option class="filters-input-option" value="0">Model</option>
					<?php
					if($_GET['Marka'] === 'Abarth'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						<option'; if(@$_GET['Model'] == '124 Spider'){ echo ' selected '; }echo 'class="filters-input-option" value="124 Spider">124 Spider</option>
						<option'; if(@$_GET['Model'] == '500'){ echo ' selected '; }echo ' class="filters-input-option" value="500">500</option>
						<option'; if(@$_GET['Model'] == 'Grande Punto'){ echo ' selected '; }echo ' class="filters-input-option" value="Grande Punto">Grande Punto</option>
						<option'; if(@$_GET['Model'] == 'Punto'){ echo ' selected '; }echo ' class="filters-input-option" value="Punto">Punto</option>
						<option'; if(@$_GET['Model'] == 'Punto Evo'){ echo ' selected '; }echo ' class="filters-input-option" value="Punto Evo">Punto Evo</option>
						<option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
					}
				
					if($_GET['Marka'] === 'Acura'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'CDX'){ echo ' selected '; }echo ' class="filters-input-option" value="CDX">CDX</option>
						 <option'; if(@$_GET['Model'] == 'ILX'){ echo ' selected '; }echo ' class="filters-input-option" value="ILX">ILX</option>
						 <option'; if(@$_GET['Model'] == 'MDX'){ echo ' selected '; }echo ' class="filters-input-option" value="MDX">MDX</option>
						 <option'; if(@$_GET['Model'] == 'RDX'){ echo ' selected '; }echo ' class="filters-input-option" value="RDX">RDX</option>
						 <option'; if(@$_GET['Model'] == 'RLX'){ echo ' selected '; }echo ' class="filters-input-option" value="RLX">RLX</option>
						 <option'; if(@$_GET['Model'] == 'TLX'){ echo ' selected '; }echo ' class="filters-input-option" value="TLX">TLX</option>
						 <option'; if(@$_GET['Model'] == 'TSX'){ echo ' selected '; }echo ' class="filters-input-option" value="TSX">TSX</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
					}
					
					if($_GET['Marka'] === 'Alfa Romeo'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '145'){ echo ' selected '; }echo ' class="filters-input-option" value="145">145</option>
						 <option'; if(@$_GET['Model'] == '146'){ echo ' selected '; }echo ' class="filters-input-option" value="146">146</option>
						 <option'; if(@$_GET['Model'] == '147'){ echo ' selected '; }echo ' class="filters-input-option" value="147">147</option>
						 <option'; if(@$_GET['Model'] == '155'){ echo ' selected '; }echo ' class="filters-input-option" value="155">155</option>
						 <option'; if(@$_GET['Model'] == '156'){ echo ' selected '; }echo ' class="filters-input-option" value="156">156</option>
						 <option'; if(@$_GET['Model'] == '159'){ echo ' selected '; }echo ' class="filters-input-option" value="159">159</option>
						 <option'; if(@$_GET['Model'] == '164'){ echo ' selected '; }echo ' class="filters-input-option" value="164">164</option>
						 <option'; if(@$_GET['Model'] == '159'){ echo ' selected '; }echo ' class="filters-input-option" value="159">166</option>
						 <option'; if(@$_GET['Model'] == '4C'){ echo ' selected '; }echo ' class="filters-input-option" value="4C">4C</option>
						 <option'; if(@$_GET['Model'] == 'Brera'){ echo ' selected '; }echo ' class="filters-input-option" value="Brera">Brera</option>
						 <option'; if(@$_GET['Model'] == 'GT'){ echo ' selected '; }echo ' class="filters-input-option" value="GT">GT</option>
						 <option'; if(@$_GET['Model'] == 'GTV'){ echo ' selected '; }echo ' class="filters-input-option" value="GTV">GTV</option>
						 <option'; if(@$_GET['Model'] == 'Giulia'){ echo ' selected '; }echo ' class="filters-input-option" value="Giulia">Giulia</option>
						 <option'; if(@$_GET['Model'] == 'Giulietta'){ echo ' selected '; }echo ' class="filters-input-option" value="Giulietta">Giulietta</option>
						 <option'; if(@$_GET['Model'] == 'Mito'){ echo ' selected '; }echo ' class="filters-input-option" value="Mito">Mito</option>
						 <option'; if(@$_GET['Model'] == 'Spider'){ echo ' selected '; }echo ' class="filters-input-option" value="Spider">Spider</option>
						 <option'; if(@$_GET['Model'] == 'Stelvio'){ echo ' selected '; }echo ' class="filters-input-option" value="Stelvio">Stelvio</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';		
												
					}
					
					if($_GET['Marka'] === 'Aston Martin'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'DB11'){ echo ' selected '; }echo ' class="filters-input-option" value="DB11">DB11</option>
						 <option'; if(@$_GET['Model'] == 'DB7'){ echo ' selected '; }echo ' class="filters-input-option" value="DB7">DB7</option>
						 <option'; if(@$_GET['Model'] == 'DB9'){ echo ' selected '; }echo ' class="filters-input-option" value="DB9">DB9</option>
						 <option'; if(@$_GET['Model'] == 'DBS Superleggera'){ echo ' selected '; }echo ' class="filters-input-option" value="DBS Superleggera">DBS Superleggera</option>
						 <option'; if(@$_GET['Model'] == 'One-77'){ echo ' selected '; }echo ' class="filters-input-option" value="One-77">One-77</option>
						 <option'; if(@$_GET['Model'] == 'Rapide'){ echo ' selected '; }echo ' class="filters-input-option" value="Rapide">Rapide</option>
						 <option'; if(@$_GET['Model'] == 'Vantage'){ echo ' selected '; }echo ' class="filters-input-option" value="Vantage">Vantage</option>
						 <option'; if(@$_GET['Model'] == 'Vanquish'){ echo ' selected '; }echo ' class="filters-input-option" value="Vanquish">Vanquish</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Audi'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '80'){ echo ' selected '; }echo ' class="filters-input-option" value="80">80</option>
						 <option'; if(@$_GET['Model'] == '90'){ echo ' selected '; }echo ' class="filters-input-option" value="90">90</option>
						 <option'; if(@$_GET['Model'] == '100'){ echo ' selected '; }echo ' class="filters-input-option" value="100">100</option>
						 <option'; if(@$_GET['Model'] == '200'){ echo ' selected '; }echo ' class="filters-input-option" value="200">200</option>
						 <option'; if(@$_GET['Model'] == 'A1'){ echo ' selected '; }echo ' class="filters-input-option" value="A1">A1</option>
						 <option'; if(@$_GET['Model'] == 'A2'){ echo ' selected '; }echo ' class="filters-input-option" value="A2">A2</option>
						 <option'; if(@$_GET['Model'] == 'A3'){ echo ' selected '; }echo ' class="filters-input-option" value="A3">A3</option>
						 <option'; if(@$_GET['Model'] == 'A4'){ echo ' selected '; }echo ' class="filters-input-option" value="A4">A4</option>
						 <option'; if(@$_GET['Model'] == 'A5'){ echo ' selected '; }echo ' class="filters-input-option" value="A5">A5</option>
						 <option'; if(@$_GET['Model'] == 'A6'){ echo ' selected '; }echo ' class="filters-input-option" value="A6">A6</option>
						 <option'; if(@$_GET['Model'] == 'A7'){ echo ' selected '; }echo ' class="filters-input-option" value="A7">A7</option>
						 <option'; if(@$_GET['Model'] == 'A8'){ echo ' selected '; }echo ' class="filters-input-option" value="A8">A8</option>
						 <option'; if(@$_GET['Model'] == 'S1'){ echo ' selected '; }echo ' class="filters-input-option" value="S1">S1</option>
						 <option'; if(@$_GET['Model'] == 'S2'){ echo ' selected '; }echo ' class="filters-input-option" value="S2">S2</option>
						 <option'; if(@$_GET['Model'] == 'S3'){ echo ' selected '; }echo ' class="filters-input-option" value="S3">S3</option>
						 <option'; if(@$_GET['Model'] == 'S4'){ echo ' selected '; }echo ' class="filters-input-option" value="S4">S4</option>
						 <option'; if(@$_GET['Model'] == 'S5'){ echo ' selected '; }echo ' class="filters-input-option" value="S5">S5</option>
						 <option'; if(@$_GET['Model'] == 'S6'){ echo ' selected '; }echo ' class="filters-input-option" value="S6">S6</option>
						 <option'; if(@$_GET['Model'] == 'S7'){ echo ' selected '; }echo ' class="filters-input-option" value="S7">S7</option>
						 <option'; if(@$_GET['Model'] == 'S8'){ echo ' selected '; }echo ' class="filters-input-option" value="S8">S8</option>
						 <option'; if(@$_GET['Model'] == 'RS1'){ echo ' selected '; }echo ' class="filters-input-option" value="RS1">RS1</option>
						 <option'; if(@$_GET['Model'] == 'RS2'){ echo ' selected '; }echo ' class="filters-input-option" value="RS2">RS2</option>
						 <option'; if(@$_GET['Model'] == 'RS3'){ echo ' selected '; }echo ' class="filters-input-option" value="RS3">RS3</option>
						 <option'; if(@$_GET['Model'] == 'RS4'){ echo ' selected '; }echo ' class="filters-input-option" value="RS4">RS4</option>
						 <option'; if(@$_GET['Model'] == 'RS5'){ echo ' selected '; }echo ' class="filters-input-option" value="RS5">RS5</option>
						 <option'; if(@$_GET['Model'] == 'RS6'){ echo ' selected '; }echo ' class="filters-input-option" value="RS6">RS6</option>
						 <option'; if(@$_GET['Model'] == 'RS7'){ echo ' selected '; }echo ' class="filters-input-option" value="RS7">RS7</option>
						 <option'; if(@$_GET['Model'] == 'RS8'){ echo ' selected '; }echo ' class="filters-input-option" value="RS8">RS8</option>
						 <option'; if(@$_GET['Model'] == 'Q1'){ echo ' selected '; }echo ' class="filters-input-option" value="Q1">Q1</option>
						 <option'; if(@$_GET['Model'] == 'Q2'){ echo ' selected '; }echo ' class="filters-input-option" value="Q2">Q2</option>
						 <option'; if(@$_GET['Model'] == 'Q3'){ echo ' selected '; }echo ' class="filters-input-option" value="Q3">Q3</option>
						 <option'; if(@$_GET['Model'] == 'Q4'){ echo ' selected '; }echo ' class="filters-input-option" value="Q4">Q4</option>
						 <option'; if(@$_GET['Model'] == 'Q5'){ echo ' selected '; }echo ' class="filters-input-option" value="Q5">Q5</option>
						 <option'; if(@$_GET['Model'] == 'Q6'){ echo ' selected '; }echo ' class="filters-input-option" value="Q6">Q6</option>
						 <option'; if(@$_GET['Model'] == 'Q7'){ echo ' selected '; }echo ' class="filters-input-option" value="Q7">Q7</option>
						 <option'; if(@$_GET['Model'] == 'Q8'){ echo ' selected '; }echo ' class="filters-input-option" value="Q8">Q8</option>
						 <option'; if(@$_GET['Model'] == 'E-Tron'){ echo ' selected '; }echo ' class="filters-input-option" value="E-Tron">E-Tron</option>
						 <option'; if(@$_GET['Model'] == 'TT'){ echo ' selected '; }echo ' class="filters-input-option" value="TT">TT</option>
						 <option'; if(@$_GET['Model'] == 'R8'){ echo ' selected '; }echo ' class="filters-input-option" value="R8">R8</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Bentley'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Bentayga'){ echo ' selected '; }echo ' class="filters-input-option" value="Bentayga">Bentayga</option>
						 <option'; if(@$_GET['Model'] == 'Continental'){ echo ' selected '; }echo ' class="filters-input-option" value="Continental">Continental</option>
						 <option'; if(@$_GET['Model'] == 'Flying Spur'){ echo ' selected '; }echo ' class="filters-input-option" value="Flying Spur">Flying Spur</option>
						 <option'; if(@$_GET['Model'] == 'Mulsanne'){ echo ' selected '; }echo ' class="filters-input-option" value="Mulsanne">Mulsanne</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'BMW'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'M1'){ echo ' selected '; }echo ' class="filters-input-option" value="M1">M1</option>
						 <option'; if(@$_GET['Model'] == 'M2'){ echo ' selected '; }echo ' class="filters-input-option" value="M2">M2</option>
						 <option'; if(@$_GET['Model'] == 'M3'){ echo ' selected '; }echo ' class="filters-input-option" value="M3">M3</option>
						 <option'; if(@$_GET['Model'] == 'M4'){ echo ' selected '; }echo ' class="filters-input-option" value="M4">M4</option>
						 <option'; if(@$_GET['Model'] == 'M5'){ echo ' selected '; }echo ' class="filters-input-option" value="M5">M5</option>
						 <option'; if(@$_GET['Model'] == 'M6'){ echo ' selected '; }echo ' class="filters-input-option" value="M6">M6</option>
						 <option'; if(@$_GET['Model'] == 'M7'){ echo ' selected '; }echo ' class="filters-input-option" value="M7">M7</option>
						 <option'; if(@$_GET['Model'] == 'M8'){ echo ' selected '; }echo ' class="filters-input-option" value="M8">M8</option>
						 <option'; if(@$_GET['Model'] == 'Seria 1'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 1">Seria 1</option>
						 <option'; if(@$_GET['Model'] == 'Seria 2'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 2">Seria 2</option>
						 <option'; if(@$_GET['Model'] == 'Seria 3'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 3">Seria 3</option>
						 <option'; if(@$_GET['Model'] == 'Seria 4'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 4">Seria 4</option>
						 <option'; if(@$_GET['Model'] == 'Seria 5'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 5">Seria 5</option>
						 <option'; if(@$_GET['Model'] == 'Seria 6'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 6">Seria 6</option>
						 <option'; if(@$_GET['Model'] == 'Seria 7'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 7">Seria 7</option>
						 <option'; if(@$_GET['Model'] == 'Seria 8'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 8">Seria 8</option>
						 <option'; if(@$_GET['Model'] == 'i3'){ echo ' selected '; }echo ' class="filters-input-option" value="i3">i3</option>
						 <option'; if(@$_GET['Model'] == 'i8'){ echo ' selected '; }echo ' class="filters-input-option" value="i8">i8</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}	

					if($_GET['Marka'] === 'Bugatti'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Veyron'){ echo ' selected '; }echo ' class="filters-input-option" value="Veyron">Veyron</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}	

					if($_GET['Marka'] === 'Cadilac'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'ATS'){ echo ' selected '; }echo ' class="filters-input-option" value="ATS">ATS</option>
						 <option'; if(@$_GET['Model'] == 'CT6'){ echo ' selected '; }echo ' class="filters-input-option" value="CT6">CT6</option>
						 <option'; if(@$_GET['Model'] == 'CTS'){ echo ' selected '; }echo ' class="filters-input-option" value="CTS">CTS</option>
						 <option'; if(@$_GET['Model'] == 'ELR'){ echo ' selected '; }echo ' class="filters-input-option" value="ELR">ELR</option>
						 <option'; if(@$_GET['Model'] == 'Escalade'){ echo ' selected '; }echo ' class="filters-input-option" value="Escalade">Escalade</option>
						 <option'; if(@$_GET['Model'] == 'SLS'){ echo ' selected '; }echo ' class="filters-input-option" value="SLS">SLS</option>
						 <option'; if(@$_GET['Model'] == 'SRX'){ echo ' selected '; }echo ' class="filters-input-option" value="SRX">SRX</option>
						 <option'; if(@$_GET['Model'] == 'XT5'){ echo ' selected '; }echo ' class="filters-input-option" value="XT5">XT5</option>
						 <option'; if(@$_GET['Model'] == 'XTS'){ echo ' selected '; }echo ' class="filters-input-option" value="XTS">XTS</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	

					if($_GET['Marka'] === 'Chevrolet'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Aveo'){ echo ' selected '; }echo ' class="filters-input-option" value="Aveo">Aveo</option>
						 <option'; if(@$_GET['Model'] == 'Camaro'){ echo ' selected '; }echo ' class="filters-input-option" value="Camaro">Camaro</option>
						 <option'; if(@$_GET['Model'] == 'Captiva'){ echo ' selected '; }echo ' class="filters-input-option" value="Captiva">Captiva</option>
						 <option'; if(@$_GET['Model'] == 'Cruze'){ echo ' selected '; }echo ' class="filters-input-option" value="Cruze">Cruze</option>
						 <option'; if(@$_GET['Model'] == 'Epica'){ echo ' selected '; }echo ' class="filters-input-option" value="Epica">Epica</option>
						 <option'; if(@$_GET['Model'] == 'Evanda'){ echo ' selected '; }echo ' class="filters-input-option" value="Evanda">Evanda</option>
						 <option'; if(@$_GET['Model'] == 'Lacetti'){ echo ' selected '; }echo ' class="filters-input-option" value="Lacetti">Lacetti</option>
						 <option'; if(@$_GET['Model'] == 'Malibu'){ echo ' selected '; }echo ' class="filters-input-option" value="Malibu">Malibu</option>
						 <option'; if(@$_GET['Model'] == 'Orlando'){ echo ' selected '; }echo ' class="filters-input-option" value="Orlando">Orlando</option>
						 <option'; if(@$_GET['Model'] == 'Spark'){ echo ' selected '; }echo ' class="filters-input-option" value="Spark">Spark</option>
						 <option'; if(@$_GET['Model'] == 'Tacuma'){ echo ' selected '; }echo ' class="filters-input-option" value="Tacuma">Tacuma</option>
						 <option'; if(@$_GET['Model'] == 'Trax'){ echo ' selected '; }echo ' class="filters-input-option" value="Trax">Trax</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	

					if($_GET['Marka'] === 'Chrysler'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '300C'){ echo ' selected '; }echo ' class="filters-input-option" value="300C">300C</option>
						 <option'; if(@$_GET['Model'] == '300M'){ echo ' selected '; }echo ' class="filters-input-option" value="300M">300M</option>
						 <option'; if(@$_GET['Model'] == 'Caravan'){ echo ' selected '; }echo ' class="filters-input-option" value="Caravan">Caravan</option>
						 <option'; if(@$_GET['Model'] == 'Intrepid'){ echo ' selected '; }echo ' class="filters-input-option" value="Intrepid">Intrepid</option>
						 <option'; if(@$_GET['Model'] == 'Neon'){ echo ' selected '; }echo ' class="filters-input-option" value="Neon">Neon</option>
						 <option'; if(@$_GET['Model'] == 'PT Cruiser'){ echo ' selected '; }echo ' class="filters-input-option" value="PT Cruiser">PT Cruiser</option>
						 <option'; if(@$_GET['Model'] == 'Sebring'){ echo ' selected '; }echo ' class="filters-input-option" value="Sebring">Sebring</option>
						 <option'; if(@$_GET['Model'] == 'Stratus'){ echo ' selected '; }echo ' class="filters-input-option" value="Stratus">Stratus</option>
						 <option'; if(@$_GET['Model'] == 'Town Country'){ echo ' selected '; }echo ' class="filters-input-option" value="Town Country">Town Country</option>
						 <option'; if(@$_GET['Model'] == 'Vision'){ echo ' selected '; }echo ' class="filters-input-option" value="Vision">Vision</option>
						 <option'; if(@$_GET['Model'] == 'Voyager'){ echo ' selected '; }echo ' class="filters-input-option" value="Voyager">Voyager</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}

					if($_GET['Marka'] === 'Citroen'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Berlingo'){ echo ' selected '; }echo ' class="filters-input-option" value="Berlingo">Berlingo</option>
						 <option'; if(@$_GET['Model'] == 'C-Elysee'){ echo ' selected '; }echo ' class="filters-input-option" value="C-Elysee">C-Elysee</option>
						 <option'; if(@$_GET['Model'] == 'C1'){ echo ' selected '; }echo ' class="filters-input-option" value="C1">C1</option>
						 <option'; if(@$_GET['Model'] == 'C2'){ echo ' selected '; }echo ' class="filters-input-option" value="C2">C2</option>
						 <option'; if(@$_GET['Model'] == 'C3'){ echo ' selected '; }echo ' class="filters-input-option" value="C3">C3</option>
						 <option'; if(@$_GET['Model'] == 'C4'){ echo ' selected '; }echo ' class="filters-input-option" value="C4">C4</option>
						 <option'; if(@$_GET['Model'] == 'C4 Aircross'){ echo ' selected '; }echo ' class="filters-input-option" value="C4 Aircross">C4 Aircross</option>
						 <option'; if(@$_GET['Model'] == 'C4 Cactus'){ echo ' selected '; }echo ' class="filters-input-option" value="C4 Cactus">C4 Cactus</option>
						 <option'; if(@$_GET['Model'] == 'C4 Picasso'){ echo ' selected '; }echo ' class="filters-input-option" value="C4 Picasso">C4 Picasso</option>
						 <option'; if(@$_GET['Model'] == 'C5'){ echo ' selected '; }echo ' class="filters-input-option" value="C5">C5</option>
						 <option'; if(@$_GET['Model'] == 'C5 Aircross'){ echo ' selected '; }echo ' class="filters-input-option" value="C5 Aircross">C5 Aircross</option>
						 <option'; if(@$_GET['Model'] == 'C6'){ echo ' selected '; }echo ' class="filters-input-option" value="C6">C6</option>
						 <option'; if(@$_GET['Model'] == 'C8'){ echo ' selected '; }echo ' class="filters-input-option" value="C8">C8</option>
						 <option'; if(@$_GET['Model'] == 'DS3'){ echo ' selected '; }echo ' class="filters-input-option" value="DS3">DS3</option>
						 <option'; if(@$_GET['Model'] == 'DS4'){ echo ' selected '; }echo ' class="filters-input-option" value="DS4">DS4</option>
						 <option'; if(@$_GET['Model'] == 'DS5'){ echo ' selected '; }echo ' class="filters-input-option" value="DS5">DS5</option>
						 <option'; if(@$_GET['Model'] == 'Evasion'){ echo ' selected '; }echo ' class="filters-input-option" value="Evasion">Evasion</option>
						 <option'; if(@$_GET['Model'] == 'Nemo'){ echo ' selected '; }echo ' class="filters-input-option" value="Nemo">Nemo</option>
						 <option'; if(@$_GET['Model'] == 'Saxo'){ echo ' selected '; }echo ' class="filters-input-option" value="Saxo">Saxo</option>
						 <option'; if(@$_GET['Model'] == 'XM'){ echo ' selected '; }echo ' class="filters-input-option" value="XM">XM</option>
						 <option'; if(@$_GET['Model'] == 'Xantia'){ echo ' selected '; }echo ' class="filters-input-option" value="Xantia">Xantia</option>
						 <option'; if(@$_GET['Model'] == 'Xsara'){ echo ' selected '; }echo ' class="filters-input-option" value="Xsara">Xsara</option>
						 <option'; if(@$_GET['Model'] == 'Xsara Picasso'){ echo ' selected '; }echo ' class="filters-input-option" value="Xsara Picasso">Xsara Picasso</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Dacia'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Dokker'){ echo ' selected '; }echo ' class="filters-input-option" value="Dokker">Dokker</option>
						 <option'; if(@$_GET['Model'] == 'Duster'){ echo ' selected '; }echo ' class="filters-input-option" value="Duster">Duster</option>
						 <option'; if(@$_GET['Model'] == 'Lodgy'){ echo ' selected '; }echo ' class="filters-input-option" value="Lodgy">Lodgy</option>
						 <option'; if(@$_GET['Model'] == 'Logan'){ echo ' selected '; }echo ' class="filters-input-option" value="Logan">Logan</option>
						 <option'; if(@$_GET['Model'] == 'Nova'){ echo ' selected '; }echo ' class="filters-input-option" value="Nova">Nova</option>
						 <option'; if(@$_GET['Model'] == 'Sandero'){ echo ' selected '; }echo ' class="filters-input-option" value="Sandero">Sandero</option>
						 <option'; if(@$_GET['Model'] == 'Sandero Stepway'){ echo ' selected '; }echo ' class="filters-input-option" value="Sandero Stepway">Sandero Stepway</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
															
					}
					
					if($_GET['Marka'] === 'Daewoo'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Espero'){ echo ' selected '; }echo ' class="filters-input-option" value="Espero">Espero</option>
						 <option'; if(@$_GET['Model'] == 'Kalos'){ echo ' selected '; }echo ' class="filters-input-option" value="Kalos">Kalos</option>
						 <option'; if(@$_GET['Model'] == 'Lanos'){ echo ' selected '; }echo ' class="filters-input-option" value="Lanos">Lanos</option>
						 <option'; if(@$_GET['Model'] == 'Leganza'){ echo ' selected '; }echo ' class="filters-input-option" value="Leganza">Leganza</option>
						 <option'; if(@$_GET['Model'] == 'Matiz'){ echo ' selected '; }echo ' class="filters-input-option" value="Matiz">Matiz</option>
						 <option'; if(@$_GET['Model'] == 'Nubira'){ echo ' selected '; }echo ' class="filters-input-option" value="Nubira">Nubira</option>
						 <option'; if(@$_GET['Model'] == 'Rezzo'){ echo ' selected '; }echo ' class="filters-input-option" value="Rezzo">Rezzo</option>
						 <option'; if(@$_GET['Model'] == 'Tacuma'){ echo ' selected '; }echo ' class="filters-input-option" value="Tacuma">Tacuma</option>
						 <option'; if(@$_GET['Model'] == 'Tico'){ echo ' selected '; }echo ' class="filters-input-option" value="Tico">Tico</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
														
					}
					
					if($_GET['Marka'] === 'Daihatsu'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Coure'){ echo ' selected '; }echo ' class="filters-input-option" value="Coure">Coure</option>
						 <option'; if(@$_GET['Model'] == 'Esse'){ echo ' selected '; }echo ' class="filters-input-option" value="Esse">Esse</option>
						 <option'; if(@$_GET['Model'] == 'Feroza'){ echo ' selected '; }echo ' class="filters-input-option" value="Feroza">Feroza</option>
						 <option'; if(@$_GET['Model'] == 'Sirion'){ echo ' selected '; }echo ' class="filters-input-option" value="Sirion">Sirion</option>
						 <option'; if(@$_GET['Model'] == 'Terios'){ echo ' selected '; }echo ' class="filters-input-option" value="Terios">Terios</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
															
					}
					
					if($_GET['Marka'] === 'Dodge'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Avenger'){ echo ' selected '; }echo ' class="filters-input-option" value="Avenger">Avenger</option>
						 <option'; if(@$_GET['Model'] == 'Caliber'){ echo ' selected '; }echo ' class="filters-input-option" value="Caliber">Caliber</option>
						 <option'; if(@$_GET['Model'] == 'Caravan'){ echo ' selected '; }echo ' class="filters-input-option" value="Caravan">Caravan</option>
						 <option'; if(@$_GET['Model'] == 'Challenger'){ echo ' selected '; }echo ' class="filters-input-option" value="Challenger">Challenger</option>
						 <option'; if(@$_GET['Model'] == 'Charger'){ echo ' selected '; }echo ' class="filters-input-option" value="Charger">Charger</option>
						 <option'; if(@$_GET['Model'] == 'Durango'){ echo ' selected '; }echo ' class="filters-input-option" value="Durango">Durango</option>
						 <option'; if(@$_GET['Model'] == 'Grand Caravan'){ echo ' selected '; }echo ' class="filters-input-option" value="Grand Caravan">Grand Caravan</option>
						 <option'; if(@$_GET['Model'] == 'Magnum'){ echo ' selected '; }echo ' class="filters-input-option" value="Magnum">Magnum</option>
						 <option'; if(@$_GET['Model'] == 'Nitro'){ echo ' selected '; }echo ' class="filters-input-option" value="Nitro">Nitro</option>
						 <option'; if(@$_GET['Model'] == 'Ram'){ echo ' selected '; }echo ' class="filters-input-option" value="Ram">Ram</option>
						 <option'; if(@$_GET['Model'] == 'Stratus'){ echo ' selected '; }echo ' class="filters-input-option" value="Stratus">Stratus</option>
						 <option'; if(@$_GET['Model'] == 'Viper'){ echo ' selected '; }echo ' class="filters-input-option" value="Viper">Viper</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Ferrari'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '458'){ echo ' selected '; }echo ' class="filters-input-option" value="458">458</option>
						 <option'; if(@$_GET['Model'] == '488'){ echo ' selected '; }echo ' class="filters-input-option" value="488">488</option>
						 <option'; if(@$_GET['Model'] == 'California'){ echo ' selected '; }echo ' class="filters-input-option" value="California">California</option>
						 <option'; if(@$_GET['Model'] == 'F12'){ echo ' selected '; }echo ' class="filters-input-option" value="F12">F12</option>
						 <option'; if(@$_GET['Model'] == 'F40'){ echo ' selected '; }echo ' class="filters-input-option" value="F40">F40</option>
						 <option'; if(@$_GET['Model'] == 'F8'){ echo ' selected '; }echo ' class="filters-input-option" value="F8">F8</option>
						 <option'; if(@$_GET['Model'] == 'Portofino'){ echo ' selected '; }echo ' class="filters-input-option" value="Portofino">Portofino</option>
						 <option'; if(@$_GET['Model'] == 'Testarossa'){ echo ' selected '; }echo ' class="filters-input-option" value="Testarossa">Testarossa</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Fiat'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '125p'){ echo ' selected '; }echo ' class="filters-input-option" value="125p">125p</option>
						 <option'; if(@$_GET['Model'] == '126p'){ echo ' selected '; }echo ' class="filters-input-option" value="126p">126p</option>
						 <option'; if(@$_GET['Model'] == '500'){ echo ' selected '; }echo ' class="filters-input-option" value="500">500</option>
						 <option'; if(@$_GET['Model'] == 'Albea'){ echo ' selected '; }echo ' class="filters-input-option" value="Albea">Albea</option>
						 <option'; if(@$_GET['Model'] == 'Barchetta'){ echo ' selected '; }echo ' class="filters-input-option" value="Barchetta">Barchetta</option>
						 <option'; if(@$_GET['Model'] == 'Brava'){ echo ' selected '; }echo ' class="filters-input-option" value="Brava">Brava</option>
						 <option'; if(@$_GET['Model'] == 'Bravo'){ echo ' selected '; }echo ' class="filters-input-option" value="Bravo">Bravo</option>
						 <option'; if(@$_GET['Model'] == 'Cinquecento'){ echo ' selected '; }echo ' class="filters-input-option" value="Cinquecento">Cinquecento</option>
						 <option'; if(@$_GET['Model'] == 'Coupe'){ echo ' selected '; }echo ' class="filters-input-option" value="Coupe">Coupe</option>
						 <option'; if(@$_GET['Model'] == 'Doblo'){ echo ' selected '; }echo ' class="filters-input-option" value="Doblo">Doblo</option>
						 <option'; if(@$_GET['Model'] == 'Ducato'){ echo ' selected '; }echo ' class="filters-input-option" value="Ducato">Ducato</option>
						 <option'; if(@$_GET['Model'] == 'Idea'){ echo ' selected '; }echo ' class="filters-input-option" value="Idea">Idea</option>
						 <option'; if(@$_GET['Model'] == 'Linea'){ echo ' selected '; }echo ' class="filters-input-option" value="Linea">Linea</option>
						 <option'; if(@$_GET['Model'] == 'Marea'){ echo ' selected '; }echo ' class="filters-input-option" value="Marea">Marea</option>
						 <option'; if(@$_GET['Model'] == 'Multipla'){ echo ' selected '; }echo ' class="filters-input-option" value="Multipla">Multipla</option>
						 <option'; if(@$_GET['Model'] == 'Palio'){ echo ' selected '; }echo ' class="filters-input-option" value="Palio">Palio</option>
						 <option'; if(@$_GET['Model'] == 'Panda'){ echo ' selected '; }echo ' class="filters-input-option" value="Panda">Panda</option>
						 <option'; if(@$_GET['Model'] == 'Punto'){ echo ' selected '; }echo ' class="filters-input-option" value="Punto">Punto</option>
						 <option'; if(@$_GET['Model'] == 'Qubo'){ echo ' selected '; }echo ' class="filters-input-option" value="Qubo">Qubo</option>
						 <option'; if(@$_GET['Model'] == 'Scudo'){ echo ' selected '; }echo ' class="filters-input-option" value="Scudo">Scudo</option>
						 <option'; if(@$_GET['Model'] == 'Seicento'){ echo ' selected '; }echo ' class="filters-input-option" value="Seicento">Seicento</option>
						 <option'; if(@$_GET['Model'] == 'Siena'){ echo ' selected '; }echo ' class="filters-input-option" value="Siena">Siena</option>
						 <option'; if(@$_GET['Model'] == 'Stilo'){ echo ' selected '; }echo ' class="filters-input-option" value="Stilo">Stilo</option>
						 <option'; if(@$_GET['Model'] == 'Tipo'){ echo ' selected '; }echo ' class="filters-input-option" value="Tipo">Tipo</option>
						 <option'; if(@$_GET['Model'] == 'Ulysse'){ echo ' selected '; }echo ' class="filters-input-option" value="Ulysse">Ulysse</option>
						 <option'; if(@$_GET['Model'] == 'Uno'){ echo ' selected '; }echo ' class="filters-input-option" value="Uno">Uno</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Ford'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Active'){ echo ' selected '; }echo ' class="filters-input-option" value="Active">Active</option>
						 <option'; if(@$_GET['Model'] == 'Cougar'){ echo ' selected '; }echo ' class="filters-input-option" value="Cougar">Cougar</option>
						 <option'; if(@$_GET['Model'] == 'EcoSport'){ echo ' selected '; }echo ' class="filters-input-option" value="EcoSport">EcoSport</option>
						 <option'; if(@$_GET['Model'] == 'Edge'){ echo ' selected '; }echo ' class="filters-input-option" value="Edge">Edge</option>
						 <option'; if(@$_GET['Model'] == 'Escort'){ echo ' selected '; }echo ' class="filters-input-option" value="Escort">Escort</option>
						 <option'; if(@$_GET['Model'] == 'Explorer'){ echo ' selected '; }echo ' class="filters-input-option" value="Explorer">Explorer</option>
						 <option'; if(@$_GET['Model'] == 'Fiesta'){ echo ' selected '; }echo ' class="filters-input-option" value="Fiesta">Fiesta</option>
						 <option'; if(@$_GET['Model'] == 'Focus'){ echo ' selected '; }echo ' class="filters-input-option" value="Focus">Focus</option>
						 <option'; if(@$_GET['Model'] == 'Fusion'){ echo ' selected '; }echo ' class="filters-input-option" value="Fusion">Fusion</option>
						 <option'; if(@$_GET['Model'] == 'GT'){ echo ' selected '; }echo ' class="filters-input-option" value="GT">GT</option>
						 <option'; if(@$_GET['Model'] == 'Galaxy'){ echo ' selected '; }echo ' class="filters-input-option" value="Galaxy">Galaxy</option>
						 <option'; if(@$_GET['Model'] == 'Granada'){ echo ' selected '; }echo ' class="filters-input-option" value="Granada">Granada</option>
						 <option'; if(@$_GET['Model'] == 'Ka'){ echo ' selected '; }echo ' class="filters-input-option" value="Ka">Ka</option>
						 <option'; if(@$_GET['Model'] == 'Kuga'){ echo ' selected '; }echo ' class="filters-input-option" value="Kuga">Kuga</option>
						 <option'; if(@$_GET['Model'] == 'Maverick'){ echo ' selected '; }echo ' class="filters-input-option" value="Maverick">Maverick</option>
						 <option'; if(@$_GET['Model'] == 'Mondeo'){ echo ' selected '; }echo ' class="filters-input-option" value="Mondeo">Mondeo</option>
						 <option'; if(@$_GET['Model'] == 'Mustang'){ echo ' selected '; }echo ' class="filters-input-option" value="Mustang">Mustang</option>
						 <option'; if(@$_GET['Model'] == 'Orion'){ echo ' selected '; }echo ' class="filters-input-option" value="Orion">Orion</option>
						 <option'; if(@$_GET['Model'] == 'Puma'){ echo ' selected '; }echo ' class="filters-input-option" value="Puma">Puma</option>
						 <option'; if(@$_GET['Model'] == 'Ranger'){ echo ' selected '; }echo ' class="filters-input-option" value="Ranger">Ranger</option>
						 <option'; if(@$_GET['Model'] == 'Raptor'){ echo ' selected '; }echo ' class="filters-input-option" value="Raptor">Raptor</option>
						 <option'; if(@$_GET['Model'] == 'S-Max'){ echo ' selected '; }echo ' class="filters-input-option" value="S-Max">S-Max</option>
						 <option'; if(@$_GET['Model'] == 'Scorpio'){ echo ' selected '; }echo ' class="filters-input-option" value="Scorpio">Scorpio</option>
						 <option'; if(@$_GET['Model'] == 'Sierra'){ echo ' selected '; }echo ' class="filters-input-option" value="Sierra">Sierra</option>
						 <option'; if(@$_GET['Model'] == 'Streetka'){ echo ' selected '; }echo ' class="filters-input-option" value="Streetka">Streetka</option>
						 <option'; if(@$_GET['Model'] == 'Tourneo'){ echo ' selected '; }echo ' class="filters-input-option" value="Tourneo">Tourneo</option>
						 <option'; if(@$_GET['Model'] == 'Transit'){ echo ' selected '; }echo ' class="filters-input-option" value="Transit">Transit</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
																	
					}	
					
					if($_GET['Marka'] === 'Honda'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Accord'){ echo ' selected '; }echo ' class="filters-input-option" value="Accord">Accord</option>
						 <option'; if(@$_GET['Model'] == 'CR-V'){ echo ' selected '; }echo ' class="filters-input-option" value="CR-V">CR-V</option>
						 <option'; if(@$_GET['Model'] == 'CR-Z'){ echo ' selected '; }echo ' class="filters-input-option" value="CR-Z">CR-Z</option>
						 <option'; if(@$_GET['Model'] == 'CRX'){ echo ' selected '; }echo ' class="filters-input-option" value="CRX">CRX</option>
						 <option'; if(@$_GET['Model'] == 'CR-Z'){ echo ' selected '; }echo ' class="filters-input-option" value="CR-Z">CR-Z</option>
						 <option'; if(@$_GET['Model'] == 'City'){ echo ' selected '; }echo ' class="filters-input-option" value="City">City</option>
						 <option'; if(@$_GET['Model'] == 'Civic'){ echo ' selected '; }echo ' class="filters-input-option" value="Civic">Civic</option>
						 <option'; if(@$_GET['Model'] == 'HR-V'){ echo ' selected '; }echo ' class="filters-input-option" value="HR-V">HR-V</option>
						 <option'; if(@$_GET['Model'] == 'Jazz'){ echo ' selected '; }echo ' class="filters-input-option" value="Jazz">Jazz</option>
						 <option'; if(@$_GET['Model'] == 'Legend'){ echo ' selected '; }echo ' class="filters-input-option" value="Legend">Legend</option>
						 <option'; if(@$_GET['Model'] == 'Logo'){ echo ' selected '; }echo ' class="filters-input-option" value="Logo">Logo</option>
						 <option'; if(@$_GET['Model'] == 'NSX'){ echo ' selected '; }echo ' class="filters-input-option" value="NSX">NSX</option>
						 <option'; if(@$_GET['Model'] == 'S 2000'){ echo ' selected '; }echo ' class="filters-input-option" value="S 2000">S 2000</option>
						 <option'; if(@$_GET['Model'] == 'TypeR'){ echo ' selected '; }echo ' class="filters-input-option" value="TypeR">TypeR</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}	
					
					if($_GET['Marka'] === 'Hyundai'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Accent'){ echo ' selected '; }echo ' class="filters-input-option" value="Accent">Accent</option>
						 <option'; if(@$_GET['Model'] == 'Atos'){ echo ' selected '; }echo ' class="filters-input-option" value="Atos">Atos</option>
						 <option'; if(@$_GET['Model'] == 'Coupe'){ echo ' selected '; }echo ' class="filters-input-option" value="Coupe">Coupe</option>
						 <option'; if(@$_GET['Model'] == 'Elantra'){ echo ' selected '; }echo ' class="filters-input-option" value="Elantra">Elantra</option>
						 <option'; if(@$_GET['Model'] == 'Galloper'){ echo ' selected '; }echo ' class="filters-input-option" value="Galloper">Galloper</option>
						 <option'; if(@$_GET['Model'] == 'Getz'){ echo ' selected '; }echo ' class="filters-input-option" value="Getz">Getz</option>
						 <option'; if(@$_GET['Model'] == 'H1'){ echo ' selected '; }echo ' class="filters-input-option" value="H1">H1</option>
						 <option'; if(@$_GET['Model'] == 'H200'){ echo ' selected '; }echo ' class="filters-input-option" value="H200">H200</option>
						 <option'; if(@$_GET['Model'] == 'Kona'){ echo ' selected '; }echo ' class="filters-input-option" value="Kona">Kona</option>
						 <option'; if(@$_GET['Model'] == 'Lantra'){ echo ' selected '; }echo ' class="filters-input-option" value="Lantra">Lantra</option>
						 <option'; if(@$_GET['Model'] == 'Matrix'){ echo ' selected '; }echo ' class="filters-input-option" value="Matrix">Matrix</option>
						 <option'; if(@$_GET['Model'] == 'Santa Fe'){ echo ' selected '; }echo ' class="filters-input-option" value="Santa Fe">Santa Fe</option>
						 <option'; if(@$_GET['Model'] == 'Sonata'){ echo ' selected '; }echo ' class="filters-input-option" value="Sonata">Sonata</option>
						 <option'; if(@$_GET['Model'] == 'Terracan'){ echo ' selected '; }echo ' class="filters-input-option" value="Terracan">Terracan</option>
						 <option'; if(@$_GET['Model'] == 'Trajet'){ echo ' selected '; }echo ' class="filters-input-option" value="Trajet">Trajet</option>
						 <option'; if(@$_GET['Model'] == 'Tucson'){ echo ' selected '; }echo ' class="filters-input-option" value="Tucson">Tucson</option>
						 <option'; if(@$_GET['Model'] == 'Veloster'){ echo ' selected '; }echo ' class="filters-input-option" value="Veloster">Veloster</option>
						 <option'; if(@$_GET['Model'] == 'XG'){ echo ' selected '; }echo ' class="filters-input-option" value="XG">XG</option>
						 <option'; if(@$_GET['Model'] == 'i10'){ echo ' selected '; }echo ' class="filters-input-option" value="i10">i10</option>
						 <option'; if(@$_GET['Model'] == 'i20'){ echo ' selected '; }echo ' class="filters-input-option" value="i20">i20</option>
						 <option'; if(@$_GET['Model'] == 'i30'){ echo ' selected '; }echo ' class="filters-input-option" value="i30">i30</option>
						 <option'; if(@$_GET['Model'] == 'i40'){ echo ' selected '; }echo ' class="filters-input-option" value="i40">i40</option>
						 <option'; if(@$_GET['Model'] == 'ix20'){ echo ' selected '; }echo ' class="filters-input-option" value="ix20">ix20</option>
						 <option'; if(@$_GET['Model'] == 'ix35'){ echo ' selected '; }echo ' class="filters-input-option" value="ix35">ix35</option>
						 <option'; if(@$_GET['Model'] == 'ix55'){ echo ' selected '; }echo ' class="filters-input-option" value="ix55">ix55</option>								
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Infiniti'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'EX'){ echo ' selected '; }echo ' class="filters-input-option" value="EX">EX</option>							
						 <option'; if(@$_GET['Model'] == 'FX'){ echo ' selected '; }echo ' class="filters-input-option" value="FX">FX</option>	
						 <option'; if(@$_GET['Model'] == 'G'){ echo ' selected '; }echo ' class="filters-input-option" value="G">G</option>	
						 <option'; if(@$_GET['Model'] == 'Q30'){ echo ' selected '; }echo ' class="filters-input-option" value="Q30">Q30</option>							
						 <option'; if(@$_GET['Model'] == 'Q40'){ echo ' selected '; }echo ' class="filters-input-option" value="Q40">Q40</option>							
						 <option'; if(@$_GET['Model'] == 'Q50'){ echo ' selected '; }echo ' class="filters-input-option" value="Q50">Q50</option>							
						 <option'; if(@$_GET['Model'] == 'Q60'){ echo ' selected '; }echo ' class="filters-input-option" value="Q60">Q60</option>							
						 <option'; if(@$_GET['Model'] == 'Q70'){ echo ' selected '; }echo ' class="filters-input-option" value="Q70">Q70</option>							
						 <option'; if(@$_GET['Model'] == 'QX30'){ echo ' selected '; }echo ' class="filters-input-option" value="QX30">QX30</option>							
						 <option'; if(@$_GET['Model'] == 'QX50'){ echo ' selected '; }echo ' class="filters-input-option" value="QX50">QX50</option>				
						 <option'; if(@$_GET['Model'] == 'QX60'){ echo ' selected '; }echo ' class="filters-input-option" value="QX60">QX60</option>				
						 <option'; if(@$_GET['Model'] == 'QX70'){ echo ' selected '; }echo ' class="filters-input-option" value="QX70">QX70</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Jaguar'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'E-Pace'){ echo ' selected '; }echo ' class="filters-input-option" value="E-Pace">E-Pace</option>							
						 <option'; if(@$_GET['Model'] == 'F-Pace'){ echo ' selected '; }echo ' class="filters-input-option" value="F-Pace">F-Pace</option>							
						 <option'; if(@$_GET['Model'] == 'F-Type'){ echo ' selected '; }echo ' class="filters-input-option" value="F-Type">F-Type</option>							
						 <option'; if(@$_GET['Model'] == 'I-Pace'){ echo ' selected '; }echo ' class="filters-input-option" value="I-Pace">I-Pace</option>							
						 <option'; if(@$_GET['Model'] == 'S-Type'){ echo ' selected '; }echo ' class="filters-input-option" value="S-Type">S-Type</option>							
						 <option'; if(@$_GET['Model'] == 'XE'){ echo ' selected '; }echo ' class="filters-input-option" value="XE">XE</option>							
						 <option'; if(@$_GET['Model'] == 'XF'){ echo ' selected '; }echo ' class="filters-input-option" value="XF">XF</option>							
						 <option'; if(@$_GET['Model'] == 'XJ'){ echo ' selected '; }echo ' class="filters-input-option" value="XJ">XJ</option>							
						 <option'; if(@$_GET['Model'] == 'XJR'){ echo ' selected '; }echo ' class="filters-input-option" value="XJR">XJR</option>							
						 <option'; if(@$_GET['Model'] == 'XKR'){ echo ' selected '; }echo ' class="filters-input-option" value="XKR">XKR</option>							
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Jeep'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Commander'){ echo ' selected '; }echo ' class="filters-input-option" value="Commander">Commander</option>				
						 <option'; if(@$_GET['Model'] == 'Compass'){ echo ' selected '; }echo ' class="filters-input-option" value="Compass">Compass</option>				
						 <option'; if(@$_GET['Model'] == 'Grand Cherokee'){ echo ' selected '; }echo ' class="filters-input-option" value="Grand Cherokee">Grand Cherokee</option>				
						 <option'; if(@$_GET['Model'] == 'Liberty'){ echo ' selected '; }echo ' class="filters-input-option" value="Liberty">Liberty</option>
						 <option'; if(@$_GET['Model'] == 'Patriot'){ echo ' selected '; }echo ' class="filters-input-option" value="Patriot">Patriot</option>
						 <option'; if(@$_GET['Model'] == 'Renegade'){ echo ' selected '; }echo ' class="filters-input-option" value="Renegade">Renegade</option>
						 <option'; if(@$_GET['Model'] == 'Wrangler'){ echo ' selected '; }echo ' class="filters-input-option" value="Wrangler">Wrangler</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Kia'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Carens'){ echo ' selected '; }echo ' class="filters-input-option" value="Carens">Carens</option>
						 <option'; if(@$_GET['Model'] == 'Carnival'){ echo ' selected '; }echo ' class="filters-input-option" value="Carnival">Carnival</option>
						 <option'; if(@$_GET['Model'] == 'Ceed'){ echo ' selected '; }echo ' class="filters-input-option" value="Ceed">Ceed</option>
						 <option'; if(@$_GET['Model'] == 'Ceed GT'){ echo ' selected '; }echo ' class="filters-input-option" value="Ceed GT">Ceed GT</option>
						 <option'; if(@$_GET['Model'] == 'Cerato'){ echo ' selected '; }echo ' class="filters-input-option" value="Cerato">Cerato</option>
						 <option'; if(@$_GET['Model'] == 'Magentis'){ echo ' selected '; }echo ' class="filters-input-option" value="Magentis">Magentis</option>
						 <option'; if(@$_GET['Model'] == 'Niro'){ echo ' selected '; }echo ' class="filters-input-option" value="Niro">Niro</option>
						 <option'; if(@$_GET['Model'] == 'Optima'){ echo ' selected '; }echo ' class="filters-input-option" value="Optima">Optima</option>
						 <option'; if(@$_GET['Model'] == 'Picanto'){ echo ' selected '; }echo ' class="filters-input-option" value="Picanto">Picanto</option>
						 <option'; if(@$_GET['Model'] == 'Retona'){ echo ' selected '; }echo ' class="filters-input-option" value="Retona">Retona</option>
						 <option'; if(@$_GET['Model'] == 'Sephia'){ echo ' selected '; }echo ' class="filters-input-option" value="Sephia">Sephia</option>
						 <option'; if(@$_GET['Model'] == 'Sorento'){ echo ' selected '; }echo ' class="filters-input-option" value="Sorento">Sorento</option>
						 <option'; if(@$_GET['Model'] == 'Soul'){ echo ' selected '; }echo ' class="filters-input-option" value="Soul">Soul</option>
						 <option'; if(@$_GET['Model'] == 'Sportage'){ echo ' selected '; }echo ' class="filters-input-option" value="Sportage">Sportage</option>
						 <option'; if(@$_GET['Model'] == 'Stinger'){ echo ' selected '; }echo ' class="filters-input-option" value="Stinger">Stinger</option>
						 <option'; if(@$_GET['Model'] == 'Stonic'){ echo ' selected '; }echo ' class="filters-input-option" value="Stonic">Stonic</option>
						 <option'; if(@$_GET['Model'] == 'Venga'){ echo ' selected '; }echo ' class="filters-input-option" value="Venga">Venga</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Lamborghini'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Aventador'){ echo ' selected '; }echo ' class="filters-input-option" value="Aventador">Aventador</option>
						 <option'; if(@$_GET['Model'] == 'Gallardo'){ echo ' selected '; }echo ' class="filters-input-option" value="Gallardo">Gallardo</option>
						 <option'; if(@$_GET['Model'] == 'Huracan'){ echo ' selected '; }echo ' class="filters-input-option" value="Huracan">Huracan</option>
						 <option'; if(@$_GET['Model'] == 'Murcielago'){ echo ' selected '; }echo ' class="filters-input-option" value="Murcielago">Murcielago</option>
						 <option'; if(@$_GET['Model'] == 'Reventon'){ echo ' selected '; }echo ' class="filters-input-option" value="Reventon">Reventon</option>
						 <option'; if(@$_GET['Model'] == 'Urus'){ echo ' selected '; }echo ' class="filters-input-option" value="Urus">Urus</option>
						 <option'; if(@$_GET['Model'] == 'Veneno'){ echo ' selected '; }echo ' class="filters-input-option" value="Veneno">Veneno</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}	
					
					if($_GET['Marka'] === 'Lancia'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Delta'){ echo ' selected '; }echo ' class="filters-input-option" value="Delta">Delta</option>
						 <option'; if(@$_GET['Model'] == 'Kappa'){ echo ' selected '; }echo ' class="filters-input-option" value="Kappa">Kappa</option>
						 <option'; if(@$_GET['Model'] == 'Lybra'){ echo ' selected '; }echo ' class="filters-input-option" value="Lybra">Lybra</option>
						 <option'; if(@$_GET['Model'] == 'Musa'){ echo ' selected '; }echo ' class="filters-input-option" value="Musa">Musa</option>
						 <option'; if(@$_GET['Model'] == 'Phedra'){ echo ' selected '; }echo ' class="filters-input-option" value="Phedra">Phedra</option>
						 <option'; if(@$_GET['Model'] == 'Still'){ echo ' selected '; }echo ' class="filters-input-option" value="Still">Still</option>
						 <option'; if(@$_GET['Model'] == 'Thema'){ echo ' selected '; }echo ' class="filters-input-option" value="Thema">Thema</option>
						 <option'; if(@$_GET['Model'] == 'Thesis'){ echo ' selected '; }echo ' class="filters-input-option" value="Thesis">Thesis</option>
						 <option'; if(@$_GET['Model'] == 'Voyager'){ echo ' selected '; }echo ' class="filters-input-option" value="Voyager">Voyager</option>
						 <option'; if(@$_GET['Model'] == 'Ypsilon'){ echo ' selected '; }echo ' class="filters-input-option" value="Ypsilon">Ypsilon</option>
						 <option'; if(@$_GET['Model'] == 'Zeta'){ echo ' selected '; }echo ' class="filters-input-option" value="Zeta">Zeta</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}	
					
					if($_GET['Marka'] === 'Land Rover'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Discovery'){ echo ' selected '; }echo ' class="filters-input-option" value="Discovery">Discovery</option>
						 <option'; if(@$_GET['Model'] == 'Discovery Sport'){ echo ' selected '; }echo ' class="filters-input-option" value="Discovery Sport">Discovery Sport</option>
						 <option'; if(@$_GET['Model'] == 'Freelander'){ echo ' selected '; }echo ' class="filters-input-option" value="Freelander">Freelander</option>
						 <option'; if(@$_GET['Model'] == 'Range Rover'){ echo ' selected '; }echo ' class="filters-input-option" value="Range Rover">Range Rover</option>
						 <option'; if(@$_GET['Model'] == 'Range Rover Evoque'){ echo ' selected '; }echo ' class="filters-input-option" value="Range Rover Evoque">Range Rover Evoque</option>
						 <option'; if(@$_GET['Model'] == 'Range Rover Sport'){ echo ' selected '; }echo ' class="filters-input-option" value="Range Rover Sport">Range Rover Sport</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
													
					}
					
					if($_GET['Marka'] === 'Lexus'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'CT'){ echo ' selected '; }echo ' class="filters-input-option" value="CT">CT</option>
						 <option'; if(@$_GET['Model'] == 'ES300'){ echo ' selected '; }echo ' class="filters-input-option" value="ES300">ES300</option>
						 <option'; if(@$_GET['Model'] == 'GS300'){ echo ' selected '; }echo ' class="filters-input-option" value="GS300">GS300</option>
						 <option'; if(@$_GET['Model'] == 'GS450'){ echo ' selected '; }echo ' class="filters-input-option" value="GS450">GS450</option>
						 <option'; if(@$_GET['Model'] == 'IS200'){ echo ' selected '; }echo ' class="filters-input-option" value="IS200">IS200</option>
						 <option'; if(@$_GET['Model'] == 'IS220'){ echo ' selected '; }echo ' class="filters-input-option" value="IS220">IS220</option>
						 <option'; if(@$_GET['Model'] == 'IS250'){ echo ' selected '; }echo ' class="filters-input-option" value="IS250">IS250</option>
						 <option'; if(@$_GET['Model'] == 'LC'){ echo ' selected '; }echo ' class="filters-input-option" value="LC">LC</option>
						 <option'; if(@$_GET['Model'] == 'LS'){ echo ' selected '; }echo ' class="filters-input-option" value="LS">LS</option>
						 <option'; if(@$_GET['Model'] == 'NX'){ echo ' selected '; }echo ' class="filters-input-option" value="NX">NX</option>
						 <option'; if(@$_GET['Model'] == 'RC'){ echo ' selected '; }echo ' class="filters-input-option" value="RC">RC</option>
						 <option'; if(@$_GET['Model'] == 'RX300'){ echo ' selected '; }echo ' class="filters-input-option" value="RX300">RX300</option>
						 <option'; if(@$_GET['Model'] == 'RX350'){ echo ' selected '; }echo ' class="filters-input-option" value="RX350">RX350</option>
						 <option'; if(@$_GET['Model'] == 'RX400'){ echo ' selected '; }echo ' class="filters-input-option" value="RX400">RX400</option>
						 <option'; if(@$_GET['Model'] == 'SC'){ echo ' selected '; }echo ' class="filters-input-option" value="SC">SC</option>
						 <option'; if(@$_GET['Model'] == 'UX'){ echo ' selected '; }echo ' class="filters-input-option" value="UX">UX</option>							
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'Lincoln'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Aviator'){ echo ' selected '; }echo ' class="filters-input-option" value="Aviator">Aviator</option>
						 <option'; if(@$_GET['Model'] == 'MKC'){ echo ' selected '; }echo ' class="filters-input-option" value="MKC">MKC</option>				
						 <option'; if(@$_GET['Model'] == 'MKS'){ echo ' selected '; }echo ' class="filters-input-option" value="MKS">MKS</option>				
						 <option'; if(@$_GET['Model'] == 'MKT'){ echo ' selected '; }echo ' class="filters-input-option" value="MKT">MKT</option>				
						 <option'; if(@$_GET['Model'] == 'MKX'){ echo ' selected '; }echo ' class="filters-input-option" value="MKX">MKX</option>				
						 <option'; if(@$_GET['Model'] == 'MKZ'){ echo ' selected '; }echo ' class="filters-input-option" value="MKZ">MKZ</option>				
						 <option'; if(@$_GET['Model'] == 'Nautilus'){ echo ' selected '; }echo ' class="filters-input-option" value="Nautilus">Nautilus</option>				
						 <option'; if(@$_GET['Model'] == 'Navigator'){ echo ' selected '; }echo ' class="filters-input-option" value="Navigator">Navigator</option>				
						 <option'; if(@$_GET['Model'] == 'Town Car'){ echo ' selected '; }echo ' class="filters-input-option" value="Town Car">Town Car</option>				
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Lotus'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Elise'){ echo ' selected '; }echo ' class="filters-input-option" value="Elise">Elise</option>	
						 <option'; if(@$_GET['Model'] == 'Evora'){ echo ' selected '; }echo ' class="filters-input-option" value="Evora">Evora</option>	
						 <option'; if(@$_GET['Model'] == 'Exige'){ echo ' selected '; }echo ' class="filters-input-option" value="Exige">Exige</option>	
						 <option'; if(@$_GET['Model'] == 'Exige S'){ echo ' selected '; }echo ' class="filters-input-option" value="Exige S">Exige S</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'Maserati'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Ghibli'){ echo ' selected '; }echo ' class="filters-input-option" value="Ghibli">Ghibli</option>	
						 <option'; if(@$_GET['Model'] == 'GranCabrio'){ echo ' selected '; }echo ' class="filters-input-option" value="GranCabrio">GranCabrio</option>	
						 <option'; if(@$_GET['Model'] == 'GranTurismo'){ echo ' selected '; }echo ' class="filters-input-option" value="GranTurismo">GranTurismo</option>	
						 <option'; if(@$_GET['Model'] == 'Levante'){ echo ' selected '; }echo ' class="filters-input-option" value="Levante">Levante</option>	
						 <option'; if(@$_GET['Model'] == 'Quattroporte'){ echo ' selected '; }echo ' class="filters-input-option" value="Quattroporte">Quattroporte</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Mazda'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '2'){ echo ' selected '; }echo ' class="filters-input-option" value="2">2</option>	
						 <option'; if(@$_GET['Model'] == '3'){ echo ' selected '; }echo ' class="filters-input-option" value="3">3</option>	
						 <option'; if(@$_GET['Model'] == '323F'){ echo ' selected '; }echo ' class="filters-input-option" value="323F">323F</option>	
						 <option'; if(@$_GET['Model'] == '4'){ echo ' selected '; }echo ' class="filters-input-option" value="4">4</option>	
						 <option'; if(@$_GET['Model'] == '5'){ echo ' selected '; }echo ' class="filters-input-option" value="5">5</option>	
						 <option'; if(@$_GET['Model'] == '6'){ echo ' selected '; }echo ' class="filters-input-option" value="6">6</option>	
						 <option'; if(@$_GET['Model'] == '121'){ echo ' selected '; }echo ' class="filters-input-option" value="121">121</option>	
						 <option'; if(@$_GET['Model'] == '323'){ echo ' selected '; }echo ' class="filters-input-option" value="323">323</option>	
						 <option'; if(@$_GET['Model'] == '626'){ echo ' selected '; }echo ' class="filters-input-option" value="626">626</option>	
						 <option'; if(@$_GET['Model'] == '929'){ echo ' selected '; }echo ' class="filters-input-option" value="929">929</option>	
						 <option'; if(@$_GET['Model'] == 'BT-50'){ echo ' selected '; }echo ' class="filters-input-option" value="BT-50">BT-50</option>	
						 <option'; if(@$_GET['Model'] == 'CX-3'){ echo ' selected '; }echo ' class="filters-input-option" value="CX-3">CX-3</option>	
						 <option'; if(@$_GET['Model'] == 'CX-5'){ echo ' selected '; }echo ' class="filters-input-option" value="CX-5">CX-5</option>	
						 <option'; if(@$_GET['Model'] == 'CX-7'){ echo ' selected '; }echo ' class="filters-input-option" value="CX-7">CX-7</option>	
						 <option'; if(@$_GET['Model'] == 'CX-9'){ echo ' selected '; }echo ' class="filters-input-option" value="CX-9">CX-9</option>	
						 <option'; if(@$_GET['Model'] == 'Demio'){ echo ' selected '; }echo ' class="filters-input-option" value="Demio">Demio</option>	
						 <option'; if(@$_GET['Model'] == 'MPV'){ echo ' selected '; }echo ' class="filters-input-option" value="MPV">MPV</option>	
						 <option'; if(@$_GET['Model'] == 'MX-2'){ echo ' selected '; }echo ' class="filters-input-option" value="MX-2">MX-2</option>	
						 <option'; if(@$_GET['Model'] == 'MX-5'){ echo ' selected '; }echo ' class="filters-input-option" value="MX-5">MX-5</option>	
						 <option'; if(@$_GET['Model'] == 'MX-6'){ echo ' selected '; }echo ' class="filters-input-option" value="MX-6">MX-6</option>	
						 <option'; if(@$_GET['Model'] == 'Millenia'){ echo ' selected '; }echo ' class="filters-input-option" value="Millenia">Millenia</option>	
						 <option'; if(@$_GET['Model'] == 'Premacy'){ echo ' selected '; }echo ' class="filters-input-option" value="Premacy">Premacy</option>	
						 <option'; if(@$_GET['Model'] == 'Protege'){ echo ' selected '; }echo ' class="filters-input-option" value="Protege">Protege</option>	
						 <option'; if(@$_GET['Model'] == 'RX-6'){ echo ' selected '; }echo ' class="filters-input-option" value="RX-6">RX-6</option>	
						 <option'; if(@$_GET['Model'] == 'RX-7'){ echo ' selected '; }echo ' class="filters-input-option" value="RX-7">RX-7</option>	
						 <option'; if(@$_GET['Model'] == 'RX-8'){ echo ' selected '; }echo ' class="filters-input-option" value="RX-8">RX-8</option>	
						 <option'; if(@$_GET['Model'] == 'Tribute'){ echo ' selected '; }echo ' class="filters-input-option" value="Tribute">Tribute</option>	
						 <option'; if(@$_GET['Model'] == 'Xedos'){ echo ' selected '; }echo ' class="filters-input-option" value="Xedos">Xedos</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'McLaren'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '540C'){ echo ' selected '; }echo ' class="filters-input-option" value="540C">540C</option>	
						 <option'; if(@$_GET['Model'] == '570GT'){ echo ' selected '; }echo ' class="filters-input-option" value="570GT">570GT</option>	
						 <option'; if(@$_GET['Model'] == '570S'){ echo ' selected '; }echo ' class="filters-input-option" value="570S">570S</option>	
						 <option'; if(@$_GET['Model'] == '570S Spider'){ echo ' selected '; }echo ' class="filters-input-option" value="570S Spider">570S Spider</option>	
						 <option'; if(@$_GET['Model'] == '600LT'){ echo ' selected '; }echo ' class="filters-input-option" value="600LT">600LT</option>	
						 <option'; if(@$_GET['Model'] == '600LT Spider'){ echo ' selected '; }echo ' class="filters-input-option" value="600LT Spider">600LT Spider</option>	
						 <option'; if(@$_GET['Model'] == '720S'){ echo ' selected '; }echo ' class="filters-input-option" value="720S">720S</option>	
						 <option'; if(@$_GET['Model'] == '720S Spider'){ echo ' selected '; }echo ' class="filters-input-option" value="720S Spider">720S Spider</option>	
						 <option'; if(@$_GET['Model'] == 'F1'){ echo ' selected '; }echo ' class="filters-input-option" value="F1">F1</option>	
						 <option'; if(@$_GET['Model'] == 'GT'){ echo ' selected '; }echo ' class="filters-input-option" value="GT">GT</option>	
						 <option'; if(@$_GET['Model'] == 'P1'){ echo ' selected '; }echo ' class="filters-input-option" value="P1">P1</option>	
						 <option'; if(@$_GET['Model'] == 'Senna'){ echo ' selected '; }echo ' class="filters-input-option" value="Senna">Senna</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Mercedes'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'AMG'){ echo ' selected '; }echo ' class="filters-input-option" value="AMG">AMG</option>	
						 <option'; if(@$_GET['Model'] == 'CLA'){ echo ' selected '; }echo ' class="filters-input-option" value="CLA">CLA</option>	
						 <option'; if(@$_GET['Model'] == 'Citan'){ echo ' selected '; }echo ' class="filters-input-option" value="Citan">Citan</option>	
						 <option'; if(@$_GET['Model'] == 'EQC'){ echo ' selected '; }echo ' class="filters-input-option" value="EQC">EQC</option>	
						 <option'; if(@$_GET['Model'] == 'GL'){ echo ' selected '; }echo ' class="filters-input-option" value="GL">GL</option>	
						 <option'; if(@$_GET['Model'] == 'GLA'){ echo ' selected '; }echo ' class="filters-input-option" value="GLA">GLA</option>	
						 <option'; if(@$_GET['Model'] == 'GLB'){ echo ' selected '; }echo ' class="filters-input-option" value="GLB">GLB</option>	
						 <option'; if(@$_GET['Model'] == 'GLC'){ echo ' selected '; }echo ' class="filters-input-option" value="GLC">GLC</option>	
						 <option'; if(@$_GET['Model'] == 'GLE'){ echo ' selected '; }echo ' class="filters-input-option" value="GLE">GLE</option>	
						 <option'; if(@$_GET['Model'] == 'GLS'){ echo ' selected '; }echo ' class="filters-input-option" value="GLS">GLS</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa A'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa A">Klasa A</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa B'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa B">Klasa B</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa C'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa C">Klasa C</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa E'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa E">Klasa E</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa G'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa G">Klasa G</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa S'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa S">Klasa S</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa V'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa V">Klasa V</option>	
						 <option'; if(@$_GET['Model'] == 'Klasa X'){ echo ' selected '; }echo ' class="filters-input-option" value="Klasa X">Klasa X</option>	
						 <option'; if(@$_GET['Model'] == 'ML'){ echo ' selected '; }echo ' class="filters-input-option" value="ML">ML</option>	
						 <option'; if(@$_GET['Model'] == 'SL'){ echo ' selected '; }echo ' class="filters-input-option" value="SL">SL</option>	
						 <option'; if(@$_GET['Model'] == 'SLC'){ echo ' selected '; }echo ' class="filters-input-option" value="SLC">SLC</option>	
						 <option'; if(@$_GET['Model'] == 'SLK'){ echo ' selected '; }echo ' class="filters-input-option" value="SLK">SLK</option>	
						 <option'; if(@$_GET['Model'] == 'Vaneo'){ echo ' selected '; }echo ' class="filters-input-option" value="Vaneo">Vaneo</option>	
						 <option'; if(@$_GET['Model'] == 'Viano'){ echo ' selected '; }echo ' class="filters-input-option" value="Viano">Viano</option>	
						 <option'; if(@$_GET['Model'] == 'Vito'){ echo ' selected '; }echo ' class="filters-input-option" value="Vito">Vito</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'MicroCar'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Aixam'){ echo ' selected '; }echo ' class="filters-input-option" value="Aixam">Aixam</option>	
						 <option'; if(@$_GET['Model'] == 'Chatenet'){ echo ' selected '; }echo ' class="filters-input-option" value="Chatenet">Chatenet</option>	
						 <option'; if(@$_GET['Model'] == 'Grecav'){ echo ' selected '; }echo ' class="filters-input-option" value="Grecav">Grecav</option>	
						 <option'; if(@$_GET['Model'] == 'Ligier'){ echo ' selected '; }echo ' class="filters-input-option" value="Ligier">Ligier</option>	
						 <option'; if(@$_GET['Model'] == 'M.Go'){ echo ' selected '; }echo ' class="filters-input-option" value="M.Go">M.Go</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Mini'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Cabrio'){ echo ' selected '; }echo ' class="filters-input-option" value="Cabrio">Cabrio</option>	
						 <option'; if(@$_GET['Model'] == 'Clubman'){ echo ' selected '; }echo ' class="filters-input-option" value="Clubman">Clubman</option>	
						 <option'; if(@$_GET['Model'] == 'Cooper'){ echo ' selected '; }echo ' class="filters-input-option" value="Cooper">Cooper</option>	
						 <option'; if(@$_GET['Model'] == 'Cooper S'){ echo ' selected '; }echo ' class="filters-input-option" value="Cooper S">Cooper S</option>	
						 <option'; if(@$_GET['Model'] == 'Countryman'){ echo ' selected '; }echo ' class="filters-input-option" value="Countryman">Countryman</option>	
						 <option'; if(@$_GET['Model'] == 'One'){ echo ' selected '; }echo ' class="filters-input-option" value="One">One</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Mitsubishi'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'ASX'){ echo ' selected '; }echo ' class="filters-input-option" value="ASX">ASX</option>	
						 <option'; if(@$_GET['Model'] == 'Carisma'){ echo ' selected '; }echo ' class="filters-input-option" value="Carisma">Carisma</option>	
						 <option'; if(@$_GET['Model'] == 'Colt'){ echo ' selected '; }echo ' class="filters-input-option" value="Colt">Colt</option>	
						 <option'; if(@$_GET['Model'] == 'Eclipse'){ echo ' selected '; }echo ' class="filters-input-option" value="Eclipse">Eclipse</option>	
						 <option'; if(@$_GET['Model'] == 'Eclipse Cross'){ echo ' selected '; }echo ' class="filters-input-option" value="Eclipse Cross">Eclipse Cross</option>	
						 <option'; if(@$_GET['Model'] == 'Endeavor'){ echo ' selected '; }echo ' class="filters-input-option" value="Endeavor">Endeavor</option>	
						 <option'; if(@$_GET['Model'] == 'Galant'){ echo ' selected '; }echo ' class="filters-input-option" value="Galant">Galant</option>	
						 <option'; if(@$_GET['Model'] == 'Grandis'){ echo ' selected '; }echo ' class="filters-input-option" value="Grandis">Grandis</option>	
						 <option'; if(@$_GET['Model'] == 'L200'){ echo ' selected '; }echo ' class="filters-input-option" value="L200">L200</option>	
						 <option'; if(@$_GET['Model'] == 'L400'){ echo ' selected '; }echo ' class="filters-input-option" value="L400">L400</option>	
						 <option'; if(@$_GET['Model'] == 'Lancer Evolution VI'){ echo ' selected '; }echo ' class="filters-input-option" value="Lancer Evolution VI">Lancer Evolution VI</option>	
						 <option'; if(@$_GET['Model'] == 'Lancer Evolution VII'){ echo ' selected '; }echo ' class="filters-input-option" value="Lancer Evolution VII">Lancer Evolution VII</option>	
						 <option'; if(@$_GET['Model'] == 'Lancer Evolution VIII'){ echo ' selected '; }echo ' class="filters-input-option" value="Lancer Evolution VIII">Lancer Evolution VIII</option>	
						 <option'; if(@$_GET['Model'] == 'Lancer Evolution IX'){ echo ' selected '; }echo ' class="filters-input-option" value="Lancer Evolution IX"> Lancer Evolution IX</option>	
						 <option'; if(@$_GET['Model'] == 'Lancer Evolution X'){ echo ' selected '; }echo ' class="filters-input-option" value="Lancer Evolution X"> Lancer Evolution X</option>	
						 <option'; if(@$_GET['Model'] == 'Montero'){ echo ' selected '; }echo ' class="filters-input-option" value="Montero">Montero</option>	
						 <option'; if(@$_GET['Model'] == 'Outlander'){ echo ' selected '; }echo ' class="filters-input-option" value="Outlander">Outlander</option>	
						 <option'; if(@$_GET['Model'] == 'Outlander PHEV'){ echo ' selected '; }echo ' class="filters-input-option" value="Outlander PHEV">Outlander PHEV</option>	
						 <option'; if(@$_GET['Model'] == 'Pajero'){ echo ' selected '; }echo ' class="filters-input-option" value="Pajero">Pajero</option>	
						 <option'; if(@$_GET['Model'] == 'Pajero Pinin'){ echo ' selected '; }echo ' class="filters-input-option" value="Pajero Pinin">Pajero Pinin</option>	
						 <option'; if(@$_GET['Model'] == 'Sigma'){ echo ' selected '; }echo ' class="filters-input-option" value="Sigma">Sigma</option>	
						 <option'; if(@$_GET['Model'] == 'Space Gear'){ echo ' selected '; }echo ' class="filters-input-option" value="Space Gear">Space Gear</option>	
						 <option'; if(@$_GET['Model'] == 'Space Runner'){ echo ' selected '; }echo ' class="filters-input-option" value="Space Runner">Space Runner</option>	
						 <option'; if(@$_GET['Model'] == 'Space Star'){ echo ' selected '; }echo ' class="filters-input-option" value="Space Star">Space Star</option>	
						 <option'; if(@$_GET['Model'] == 'Space Wagon'){ echo ' selected '; }echo ' class="filters-input-option" value="Space Wagon">Space Wagon</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'Nissan'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '100 NX'){ echo ' selected '; }echo ' class="filters-input-option" value="100 NX">100 NX</option>	
						 <option'; if(@$_GET['Model'] == '200 SX'){ echo ' selected '; }echo ' class="filters-input-option" value="200 SX">200 SX</option>	
						 <option'; if(@$_GET['Model'] == '300 ZX'){ echo ' selected '; }echo ' class="filters-input-option" value="300 ZX">300 ZX</option>	
						 <option'; if(@$_GET['Model'] == '350Z'){ echo ' selected '; }echo ' class="filters-input-option" value="350Z">350Z</option>	
						 <option'; if(@$_GET['Model'] == '370Z'){ echo ' selected '; }echo ' class="filters-input-option" value="370Z">370Z</option>	
						 <option'; if(@$_GET['Model'] == '370Z Nismo'){ echo ' selected '; }echo ' class="filters-input-option" value="370Z Nismo">370Z Nismo</option>	
						 <option'; if(@$_GET['Model'] == '370Z Roadster'){ echo ' selected '; }echo ' class="filters-input-option" value="370Z Roadster">370Z Roadster</option>	
						 <option'; if(@$_GET['Model'] == 'Almera'){ echo ' selected '; }echo ' class="filters-input-option" value="Almera">Almera</option>	
						 <option'; if(@$_GET['Model'] == 'Almera Tino'){ echo ' selected '; }echo ' class="filters-input-option" value="Almera Tino">Almera Tino</option>	
						 <option'; if(@$_GET['Model'] == 'Altima'){ echo ' selected '; }echo ' class="filters-input-option" value="Altima">Altima</option>	
						 <option'; if(@$_GET['Model'] == 'E-NV200'){ echo ' selected '; }echo ' class="filters-input-option" value="E-NV200">E-NV200</option>	
						 <option'; if(@$_GET['Model'] == 'E-NV200 Evalia'){ echo ' selected '; }echo ' class="filters-input-option" value="E-NV200 Evalia">E-NV200 Evalia</option>	
						 <option'; if(@$_GET['Model'] == 'Frontier'){ echo ' selected '; }echo ' class="filters-input-option" value="Frontier">Frontier</option>	
						 <option'; if(@$_GET['Model'] == 'GT-R'){ echo ' selected '; }echo ' class="filters-input-option" value="GT-R">GT-R</option>	
						 <option'; if(@$_GET['Model'] == 'GT-R Nismo'){ echo ' selected '; }echo ' class="filters-input-option" value="GT-R Nismo">GT-R Nismo</option>	
						 <option'; if(@$_GET['Model'] == 'Juke'){ echo ' selected '; }echo ' class="filters-input-option" value="Juke">Juke</option>	
						 <option'; if(@$_GET['Model'] == 'King Cab'){ echo ' selected '; }echo ' class="filters-input-option" value="King Cab">King Cab</option>	
						 <option'; if(@$_GET['Model'] == 'Leaf'){ echo ' selected '; }echo ' class="filters-input-option" value="Leaf">Leaf</option>	
						 <option'; if(@$_GET['Model'] == 'Maxima'){ echo ' selected '; }echo ' class="filters-input-option" value="Maxima">Maxima</option>	
						 <option'; if(@$_GET['Model'] == 'Micra'){ echo ' selected '; }echo ' class="filters-input-option" value="Micra">Micra</option>	
						 <option'; if(@$_GET['Model'] == 'Murano'){ echo ' selected '; }echo ' class="filters-input-option" value="Murano">Murano</option>	
						 <option'; if(@$_GET['Model'] == 'NV200'){ echo ' selected '; }echo ' class="filters-input-option" value="NV200">NV200</option>	
						 <option'; if(@$_GET['Model'] == 'Navara'){ echo ' selected '; }echo ' class="filters-input-option" value="Navara">Navara</option>	
						 <option'; if(@$_GET['Model'] == 'Note'){ echo ' selected '; }echo ' class="filters-input-option" value="Note">Note</option>	
						 <option'; if(@$_GET['Model'] == 'Patrol'){ echo ' selected '; }echo ' class="filters-input-option" value="Patrol">Patrol</option>	
						 <option'; if(@$_GET['Model'] == 'Pickup'){ echo ' selected '; }echo ' class="filters-input-option" value="Pickup">Pickup</option>	
						 <option'; if(@$_GET['Model'] == 'Primera'){ echo ' selected '; }echo ' class="filters-input-option" value="Primera">Primera</option>	
						 <option'; if(@$_GET['Model'] == 'Pulsar'){ echo ' selected '; }echo ' class="filters-input-option" value="Pulsar">Pulsar</option>	
						 <option'; if(@$_GET['Model'] == 'Qashqai'){ echo ' selected '; }echo ' class="filters-input-option" value="Qashqai">Qashqai</option>	
						 <option'; if(@$_GET['Model'] == 'Quest'){ echo ' selected '; }echo ' class="filters-input-option" value="Quest">Quest</option>	
						 <option'; if(@$_GET['Model'] == 'Rogue'){ echo ' selected '; }echo ' class="filters-input-option" value="Rogue">Rogue</option>	
						 <option'; if(@$_GET['Model'] == 'Serena'){ echo ' selected '; }echo ' class="filters-input-option" value="Serena">Serena</option>	
						 <option'; if(@$_GET['Model'] == 'Skyline'){ echo ' selected '; }echo ' class="filters-input-option" value="Skyline">Skyline</option>	
						 <option'; if(@$_GET['Model'] == 'Titan'){ echo ' selected '; }echo ' class="filters-input-option" value="Titan">Titan</option>	
						 <option'; if(@$_GET['Model'] == 'X-Trail'){ echo ' selected '; }echo ' class="filters-input-option" value="X-Trail">X-Trail</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Opel'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Adam'){ echo ' selected '; }echo ' class="filters-input-option" value="Adam">Adam</option>
						 <option'; if(@$_GET['Model'] == 'Agila'){ echo ' selected '; }echo ' class="filters-input-option" value="Agila">Agila</option>
						 <option'; if(@$_GET['Model'] == 'Antara'){ echo ' selected '; }echo ' class="filters-input-option" value="Antara">Antara</option>
						 <option'; if(@$_GET['Model'] == 'Astra'){ echo ' selected '; }echo ' class="filters-input-option" value="Astra">Astra</option>
						 <option'; if(@$_GET['Model'] == 'Calibra'){ echo ' selected '; }echo ' class="filters-input-option" value="Calibra">Calibra</option>
						 <option'; if(@$_GET['Model'] == 'Campo'){ echo ' selected '; }echo ' class="filters-input-option" value="Campo">Campo</option>
						 <option'; if(@$_GET['Model'] == 'Cascada'){ echo ' selected '; }echo ' class="filters-input-option" value="Cascada">Cascada</option>
						 <option'; if(@$_GET['Model'] == 'Combo'){ echo ' selected '; }echo ' class="filters-input-option" value="Combo">Combo</option>
						 <option'; if(@$_GET['Model'] == 'Corsa'){ echo ' selected '; }echo ' class="filters-input-option" value="Corsa">Corsa</option>
						 <option'; if(@$_GET['Model'] == 'Frontera'){ echo ' selected '; }echo ' class="filters-input-option" value="Frontera">Frontera</option>
						 <option'; if(@$_GET['Model'] == 'GT'){ echo ' selected '; }echo ' class="filters-input-option" value="GT">GT</option>
						 <option'; if(@$_GET['Model'] == 'Insignia'){ echo ' selected '; }echo ' class="filters-input-option" value="Insignia">Insignia</option>
						 <option'; if(@$_GET['Model'] == 'Kadett'){ echo ' selected '; }echo ' class="filters-input-option" value="Kadett">Kadett</option>
						 <option'; if(@$_GET['Model'] == 'Meriva'){ echo ' selected '; }echo ' class="filters-input-option" value="Meriva">Meriva</option>
						 <option'; if(@$_GET['Model'] == 'Mokka'){ echo ' selected '; }echo ' class="filters-input-option" value="Mokka">Mokka</option>
						 <option'; if(@$_GET['Model'] == 'Monterey'){ echo ' selected '; }echo ' class="filters-input-option" value="Monterey">Monterey</option>
						 <option'; if(@$_GET['Model'] == 'Movano'){ echo ' selected '; }echo ' class="filters-input-option" value="Movano">Movano</option>
						 <option'; if(@$_GET['Model'] == 'Omega'){ echo ' selected '; }echo ' class="filters-input-option" value="Omega">Omega</option>
						 <option'; if(@$_GET['Model'] == 'Signum'){ echo ' selected '; }echo ' class="filters-input-option" value="Signum">Signum</option>
						 <option'; if(@$_GET['Model'] == 'Sintra'){ echo ' selected '; }echo ' class="filters-input-option" value="Sintra">Sintra</option>
						 <option'; if(@$_GET['Model'] == 'Tigra'){ echo ' selected '; }echo ' class="filters-input-option" value="Tigra">Tigra</option>
						 <option'; if(@$_GET['Model'] == 'Vectra'){ echo ' selected '; }echo ' class="filters-input-option" value="Vectra">Vectra</option>
						 <option'; if(@$_GET['Model'] == 'Vivaro'){ echo ' selected '; }echo ' class="filters-input-option" value="Vivaro">Vivaro</option>
						 <option'; if(@$_GET['Model'] == 'Zafira'){ echo ' selected '; }echo ' class="filters-input-option" value="Zafira">Zafira</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'Peugeot'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '108'){ echo ' selected '; }echo ' class="filters-input-option" value="108">108</option>
						 <option'; if(@$_GET['Model'] == '205'){ echo ' selected '; }echo ' class="filters-input-option" value="205">205</option>
						 <option'; if(@$_GET['Model'] == '206'){ echo ' selected '; }echo ' class="filters-input-option" value="206">206</option>
						 <option'; if(@$_GET['Model'] == '207'){ echo ' selected '; }echo ' class="filters-input-option" value="207">207</option>
						 <option'; if(@$_GET['Model'] == '208'){ echo ' selected '; }echo ' class="filters-input-option" value="208">208</option>
						 <option'; if(@$_GET['Model'] == '301'){ echo ' selected '; }echo ' class="filters-input-option" value="301">301</option>
						 <option'; if(@$_GET['Model'] == '308'){ echo ' selected '; }echo ' class="filters-input-option" value="308">308</option>
						 <option'; if(@$_GET['Model'] == '405'){ echo ' selected '; }echo ' class="filters-input-option" value="405">405</option>
						 <option'; if(@$_GET['Model'] == '406'){ echo ' selected '; }echo ' class="filters-input-option" value="406">406</option>
						 <option'; if(@$_GET['Model'] == '407'){ echo ' selected '; }echo ' class="filters-input-option" value="407">407</option>
						 <option'; if(@$_GET['Model'] == '508'){ echo ' selected '; }echo ' class="filters-input-option" value="508">508</option>
						 <option'; if(@$_GET['Model'] == '607'){ echo ' selected '; }echo ' class="filters-input-option" value="607">607</option>
						 <option'; if(@$_GET['Model'] == '806'){ echo ' selected '; }echo ' class="filters-input-option" value="806">806</option>
						 <option'; if(@$_GET['Model'] == '807'){ echo ' selected '; }echo ' class="filters-input-option" value="807">807</option>
						 <option'; if(@$_GET['Model'] == '1007'){ echo ' selected '; }echo ' class="filters-input-option" value="1007">1007</option>
						 <option'; if(@$_GET['Model'] == '2008'){ echo ' selected '; }echo ' class="filters-input-option" value="2008">2008</option>
						 <option'; if(@$_GET['Model'] == '3008'){ echo ' selected '; }echo ' class="filters-input-option" value="3008">3008</option>
						 <option'; if(@$_GET['Model'] == '4007'){ echo ' selected '; }echo ' class="filters-input-option" value="4007">4007</option>
						 <option'; if(@$_GET['Model'] == '4008'){ echo ' selected '; }echo ' class="filters-input-option" value="4008">4008</option>
						 <option'; if(@$_GET['Model'] == '5008'){ echo ' selected '; }echo ' class="filters-input-option" value="5008">5008</option>
						 <option'; if(@$_GET['Model'] == 'Bipper'){ echo ' selected '; }echo ' class="filters-input-option" value="Bipper">Bipper</option>
						 <option'; if(@$_GET['Model'] == 'Boxer'){ echo ' selected '; }echo ' class="filters-input-option" value="Boxer">Boxer</option>
						 <option'; if(@$_GET['Model'] == 'E-208'){ echo ' selected '; }echo ' class="filters-input-option" value="E-208">E-208</option>
						 <option'; if(@$_GET['Model'] == 'Expert'){ echo ' selected '; }echo ' class="filters-input-option" value="Expert">Expert</option>
						 <option'; if(@$_GET['Model'] == 'Partner'){ echo ' selected '; }echo ' class="filters-input-option" value="Partner">Partner</option>
						 <option'; if(@$_GET['Model'] == 'RCZ'){ echo ' selected '; }echo ' class="filters-input-option" value="RCZ">RCZ</option>
						 <option'; if(@$_GET['Model'] == 'Rifter'){ echo ' selected '; }echo ' class="filters-input-option" value="Rifter">Rifter</option>
						 <option'; if(@$_GET['Model'] == 'Traveller'){ echo ' selected '; }echo ' class="filters-input-option" value="Traveller">Traveller</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'Polonez'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Atu'){ echo ' selected '; }echo ' class="filters-input-option" value="Atu">Atu</option>
						 <option'; if(@$_GET['Model'] == 'Atu Plus'){ echo ' selected '; }echo ' class="filters-input-option" value="Atu Plus">Atu Plus</option>
						 <option'; if(@$_GET['Model'] == 'Caro'){ echo ' selected '; }echo ' class="filters-input-option" value="Caro">Caro</option>
						 <option'; if(@$_GET['Model'] == 'Caro Plus'){ echo ' selected '; }echo ' class="filters-input-option" value="Caro Plus">Caro Plus</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Porsche'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '718'){ echo ' selected '; }echo ' class="filters-input-option" value="718">718</option>
						 <option'; if(@$_GET['Model'] == '911'){ echo ' selected '; }echo ' class="filters-input-option" value="911">911</option>
						 <option'; if(@$_GET['Model'] == '944'){ echo ' selected '; }echo ' class="filters-input-option" value="944">944</option>
						 <option'; if(@$_GET['Model'] == 'Cayenne'){ echo ' selected '; }echo ' class="filters-input-option" value="Cayenne">Cayenne</option>
						 <option'; if(@$_GET['Model'] == 'Cayman'){ echo ' selected '; }echo ' class="filters-input-option" value="Cayman">Cayman</option>
						 <option'; if(@$_GET['Model'] == 'E-Performance'){ echo ' selected '; }echo ' class="filters-input-option" value="E-Performance">E-Performance</option>
						 <option'; if(@$_GET['Model'] == 'Macan'){ echo ' selected '; }echo ' class="filters-input-option" value="Macan">Macan</option>
						 <option'; if(@$_GET['Model'] == 'Panamera'){ echo ' selected '; }echo ' class="filters-input-option" value="Panamera">Panamera</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Renault'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Avantime'){ echo ' selected '; }echo ' class="filters-input-option" value="Avantime">Avantime</option>
						 <option'; if(@$_GET['Model'] == 'Captur'){ echo ' selected '; }echo ' class="filters-input-option" value="Captur">Captur</option>
						 <option'; if(@$_GET['Model'] == 'Clio'){ echo ' selected '; }echo ' class="filters-input-option" value="Clio">Clio</option>
						 <option'; if(@$_GET['Model'] == 'Escape'){ echo ' selected '; }echo ' class="filters-input-option" value="Escape">Escape</option>
						 <option'; if(@$_GET['Model'] == 'Fluence'){ echo ' selected '; }echo ' class="filters-input-option" value="Fluence">Fluence</option>
						 <option'; if(@$_GET['Model'] == 'Grand Escape'){ echo ' selected '; }echo ' class="filters-input-option" value="Grand Escape">Grand Escape</option>
						 <option'; if(@$_GET['Model'] == 'Grand Scenic'){ echo ' selected '; }echo ' class="filters-input-option" value="Grand Scenic">Grand Scenic</option>
						 <option'; if(@$_GET['Model'] == 'Scenic'){ echo ' selected '; }echo ' class="filters-input-option" value="Scenic">Scenic</option>
						 <option'; if(@$_GET['Model'] == 'Scenic Conquest'){ echo ' selected '; }echo ' class="filters-input-option" value="Scenic Conquest">Scenic Conquest</option>
						 <option'; if(@$_GET['Model'] == 'Scenic RX4'){ echo ' selected '; }echo ' class="filters-input-option" value="Scenic RX4">Scenic RX4</option>
						 <option'; if(@$_GET['Model'] == 'Kadjar'){ echo ' selected '; }echo ' class="filters-input-option" value="Kadjar">Kadjar</option>
						 <option'; if(@$_GET['Model'] == 'Kangoo'){ echo ' selected '; }echo ' class="filters-input-option" value="Kangoo">Kangoo</option>
						 <option'; if(@$_GET['Model'] == 'Koleos'){ echo ' selected '; }echo ' class="filters-input-option" value="Koleos">Koleos</option>
						 <option'; if(@$_GET['Model'] == 'Laguna'){ echo ' selected '; }echo ' class="filters-input-option" value="Laguna">Laguna</option>
						 <option'; if(@$_GET['Model'] == 'Latitude'){ echo ' selected '; }echo ' class="filters-input-option" value="Latitude">Latitude</option>
						 <option'; if(@$_GET['Model'] == 'Master'){ echo ' selected '; }echo ' class="filters-input-option" value="Master">Master</option>
						 <option'; if(@$_GET['Model'] == 'Megane'){ echo ' selected '; }echo ' class="filters-input-option" value="Megane">Megane</option>
						 <option'; if(@$_GET['Model'] == 'Megane RS'){ echo ' selected '; }echo ' class="filters-input-option" value="Megane RS">Megane RS</option>
						 <option'; if(@$_GET['Model'] == 'Modus'){ echo ' selected '; }echo ' class="filters-input-option" value="Modus">Modus</option>
						 <option'; if(@$_GET['Model'] == 'Talisman'){ echo ' selected '; }echo ' class="filters-input-option" value="Talisman">Talisman</option>
						 <option'; if(@$_GET['Model'] == 'Thalia'){ echo ' selected '; }echo ' class="filters-input-option" value="Thalia">Thalia</option>
						 <option'; if(@$_GET['Model'] == 'Trafic'){ echo ' selected '; }echo ' class="filters-input-option" value="Trafic">Trafic</option>
						 <option'; if(@$_GET['Model'] == 'Twingo'){ echo ' selected '; }echo ' class="filters-input-option" value="Twingo">Twingo</option>
						 <option'; if(@$_GET['Model'] == 'Twizy'){ echo ' selected '; }echo ' class="filters-input-option" value="Twizy">Twizy</option>
						 <option'; if(@$_GET['Model'] == 'Vel Satis'){ echo ' selected '; }echo ' class="filters-input-option" value="Vel Satis">Vel Satis</option>
						 <option'; if(@$_GET['Model'] == 'Wind'){ echo ' selected '; }echo ' class="filters-input-option" value="Wind">Wind</option>
						 <option'; if(@$_GET['Model'] == 'ZOE'){ echo ' selected '; }echo ' class="filters-input-option" value="ZOE">ZOE</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'Rolls Royce'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Ghost'){ echo ' selected '; }echo ' class="filters-input-option" value="Ghost">Ghost</option>
						 <option'; if(@$_GET['Model'] == 'Phantom'){ echo ' selected '; }echo ' class="filters-input-option" value="Phantom">Phantom</option>
						 <option'; if(@$_GET['Model'] == 'Wraith'){ echo ' selected '; }echo ' class="filters-input-option" value="Wraith">Wraith</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Rover'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '25'){ echo ' selected '; }echo ' class="filters-input-option" value="25">25</option>
						 <option'; if(@$_GET['Model'] == '45'){ echo ' selected '; }echo ' class="filters-input-option" value="45">45</option>
						 <option'; if(@$_GET['Model'] == '75'){ echo ' selected '; }echo ' class="filters-input-option" value="75">75</option>
						 <option'; if(@$_GET['Model'] == '200'){ echo ' selected '; }echo ' class="filters-input-option" value="200">200</option>
						 <option'; if(@$_GET['Model'] == '214'){ echo ' selected '; }echo ' class="filters-input-option" value="214">214</option>
						 <option'; if(@$_GET['Model'] == '400'){ echo ' selected '; }echo ' class="filters-input-option" value="400">400</option>
						 <option'; if(@$_GET['Model'] == '414'){ echo ' selected '; }echo ' class="filters-input-option" value="414">414</option>
						 <option'; if(@$_GET['Model'] == '416'){ echo ' selected '; }echo ' class="filters-input-option" value="416">416</option>
						 <option'; if(@$_GET['Model'] == '420'){ echo ' selected '; }echo ' class="filters-input-option" value="420">420</option>
						 <option'; if(@$_GET['Model'] == '600'){ echo ' selected '; }echo ' class="filters-input-option" value="600">600</option>
						 <option'; if(@$_GET['Model'] == '620'){ echo ' selected '; }echo ' class="filters-input-option" value="620">620</option>
						 <option'; if(@$_GET['Model'] == 'MG'){ echo ' selected '; }echo ' class="filters-input-option" value="MG">MG</option>
						 <option'; if(@$_GET['Model'] == 'Streetwise'){ echo ' selected '; }echo ' class="filters-input-option" value="Streetwise">Streetwise</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Saab'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '9-5'){ echo ' selected '; }echo ' class="filters-input-option" value="9-5">9-5</option>
						 <option'; if(@$_GET['Model'] == '900'){ echo ' selected '; }echo ' class="filters-input-option" value="900">900</option>
						 <option'; if(@$_GET['Model'] == '9000'){ echo ' selected '; }echo ' class="filters-input-option" value="9000">9000</option>
						 <option'; if(@$_GET['Model'] == '9-3'){ echo ' selected '; }echo ' class="filters-input-option" value="9-3">9-3</option>
						 <option'; if(@$_GET['Model'] == '9-7X'){ echo ' selected '; }echo ' class="filters-input-option" value="9-7X">9-7X</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Seat'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Alhambra'){ echo ' selected '; }echo ' class="filters-input-option" value="Alhambra">Alhambra</option>
						 <option'; if(@$_GET['Model'] == 'Altea'){ echo ' selected '; }echo ' class="filters-input-option" value="Altea">Altea</option>
						 <option'; if(@$_GET['Model'] == 'Altea XL'){ echo ' selected '; }echo ' class="filters-input-option" value="Altea XL">Altea XL</option>
						 <option'; if(@$_GET['Model'] == 'Arona'){ echo ' selected '; }echo ' class="filters-input-option" value="Arona">Arona</option>
						 <option'; if(@$_GET['Model'] == 'Arosa'){ echo ' selected '; }echo ' class="filters-input-option" value="Arosa">Arosa</option>
						 <option'; if(@$_GET['Model'] == 'Ateca'){ echo ' selected '; }echo ' class="filters-input-option" value="Ateca">Ateca</option>
						 <option'; if(@$_GET['Model'] == 'Cordoba'){ echo ' selected '; }echo ' class="filters-input-option" value="Cordoba">Cordoba</option>
						 <option'; if(@$_GET['Model'] == 'Exeo'){ echo ' selected '; }echo ' class="filters-input-option" value="Exeo">Exeo</option>
						 <option'; if(@$_GET['Model'] == 'Ibiza'){ echo ' selected '; }echo ' class="filters-input-option" value="Ibiza">Ibiza</option>
						 <option'; if(@$_GET['Model'] == 'Inca'){ echo ' selected '; }echo ' class="filters-input-option" value="Inca">Inca</option>
						 <option'; if(@$_GET['Model'] == 'Leon'){ echo ' selected '; }echo ' class="filters-input-option" value="Leon">Leon</option>
						 <option'; if(@$_GET['Model'] == 'Leon Cupra'){ echo ' selected '; }echo ' class="filters-input-option" value="Leon Cupra">Leon Cupra</option>
						 <option'; if(@$_GET['Model'] == 'Leon Sportourer ST'){ echo ' selected '; }echo ' class="filters-input-option" value="Leon Sportourer ST">Leon Sportourer ST</option>
						 <option'; if(@$_GET['Model'] == 'Mii'){ echo ' selected '; }echo ' class="filters-input-option" value="Mii">Mii</option>
						 <option'; if(@$_GET['Model'] == 'Tarraco'){ echo ' selected '; }echo ' class="filters-input-option" value="Tarraco">Tarraco</option>
						 <option'; if(@$_GET['Model'] == 'Toledo'){ echo ' selected '; }echo ' class="filters-input-option" value="Toledo">Toledo</option>					
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Skoda'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '105'){ echo ' selected '; }echo ' class="filters-input-option" value="105">105</option>
						 <option'; if(@$_GET['Model'] == '120'){ echo ' selected '; }echo ' class="filters-input-option" value="120">120</option>
						 <option'; if(@$_GET['Model'] == 'Citigo'){ echo ' selected '; }echo ' class="filters-input-option" value="Citigo">Citigo</option>
						 <option'; if(@$_GET['Model'] == 'Fabia'){ echo ' selected '; }echo ' class="filters-input-option" value="Fabia">Fabia</option>
						 <option'; if(@$_GET['Model'] == 'Favorit'){ echo ' selected '; }echo ' class="filters-input-option" value="Favorit">Favorit</option>
						 <option'; if(@$_GET['Model'] == 'Felicia'){ echo ' selected '; }echo ' class="filters-input-option" value="Felicia">Felicia</option>
						 <option'; if(@$_GET['Model'] == 'Kamiq'){ echo ' selected '; }echo ' class="filters-input-option" value="Kamiq">Kamiq</option>
						 <option'; if(@$_GET['Model'] == 'Karoq'){ echo ' selected '; }echo ' class="filters-input-option" value="Karoq">Karoq</option>
						 <option'; if(@$_GET['Model'] == 'Kodiaq'){ echo ' selected '; }echo ' class="filters-input-option" value="Kodiaq">Kodiaq</option>
						 <option'; if(@$_GET['Model'] == 'Octavia'){ echo ' selected '; }echo ' class="filters-input-option" value="Octavia">Octavia</option>
						 <option'; if(@$_GET['Model'] == 'Rapid'){ echo ' selected '; }echo ' class="filters-input-option" value="Rapid">Rapid</option>
						 <option'; if(@$_GET['Model'] == 'Roomster'){ echo ' selected '; }echo ' class="filters-input-option" value="Roomster">Roomster</option>
						 <option'; if(@$_GET['Model'] == 'Scala'){ echo ' selected '; }echo ' class="filters-input-option" value="Scala">Scala</option>
						 <option'; if(@$_GET['Model'] == 'Superb'){ echo ' selected '; }echo ' class="filters-input-option" value="Superb">Superb</option>
						 <option'; if(@$_GET['Model'] == 'Yeti'){ echo ' selected '; }echo ' class="filters-input-option" value="Yeti">Yeti</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Smart'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Fortwo'){ echo ' selected '; }echo ' class="filters-input-option" value="Fortwo">Fortwo</option>									
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'SsangYong'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Actyon'){ echo ' selected '; }echo ' class="filters-input-option" value="Actyon">Actyon</option>						
						 <option'; if(@$_GET['Model'] == 'Korando'){ echo ' selected '; }echo ' class="filters-input-option" value="Korando">Korando</option>						
						 <option'; if(@$_GET['Model'] == 'Kyron'){ echo ' selected '; }echo ' class="filters-input-option" value="Kyron">Kyron</option>						
						 <option'; if(@$_GET['Model'] == 'Musso'){ echo ' selected '; }echo ' class="filters-input-option" value="Musso">Musso</option>						
						 <option'; if(@$_GET['Model'] == 'Rexton'){ echo ' selected '; }echo ' class="filters-input-option" value="Rexton">Rexton</option>						
						 <option'; if(@$_GET['Model'] == 'Rodius'){ echo ' selected '; }echo ' class="filters-input-option" value="Rodius">Rodius</option>						
						 <option'; if(@$_GET['Model'] == 'Tivoli'){ echo ' selected '; }echo ' class="filters-input-option" value="Tivoli">Tivoli</option>						
						 <option'; if(@$_GET['Model'] == 'XLV'){ echo ' selected '; }echo ' class="filters-input-option" value="XLV">XLV</option>						
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}	
					
					if($_GET['Marka'] === 'Subaru'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'B9 Tribeca'){ echo ' selected '; }echo ' class="filters-input-option" value="B9 Tribeca">B9 Tribeca</option>			
						 <option'; if(@$_GET['Model'] == 'BRZ'){ echo ' selected '; }echo ' class="filters-input-option" value="BRZ">BRZ</option>			
						 <option'; if(@$_GET['Model'] == 'Forester'){ echo ' selected '; }echo ' class="filters-input-option" value="Forester">Forester</option>			
						 <option'; if(@$_GET['Model'] == 'Impreza'){ echo ' selected '; }echo ' class="filters-input-option" value="Impreza">Impreza</option>			
						 <option'; if(@$_GET['Model'] == 'Justy'){ echo ' selected '; }echo ' class="filters-input-option" value="Justy">Justy</option>			
						 <option'; if(@$_GET['Model'] == 'Legacy'){ echo ' selected '; }echo ' class="filters-input-option" value="Legacy">Legacy</option>			
						 <option'; if(@$_GET['Model'] == 'Levorg'){ echo ' selected '; }echo ' class="filters-input-option" value="Levorg">Levorg</option>			
						 <option'; if(@$_GET['Model'] == 'Outback'){ echo ' selected '; }echo ' class="filters-input-option" value="Outback">Outback</option>			
						 <option'; if(@$_GET['Model'] == 'Tribeca'){ echo ' selected '; }echo ' class="filters-input-option" value="Tribeca">Tribeca</option>			
						 <option'; if(@$_GET['Model'] == 'WRX'){ echo ' selected '; }echo ' class="filters-input-option" value="WRX">WRX</option>			
						 <option'; if(@$_GET['Model'] == 'XV'){ echo ' selected '; }echo ' class="filters-input-option" value="XV">XV</option>			
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Suzuki'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Alto'){ echo ' selected '; }echo ' class="filters-input-option" value="Alto">Alto</option>			
						 <option'; if(@$_GET['Model'] == 'Baleno'){ echo ' selected '; }echo ' class="filters-input-option" value="Baleno">Baleno</option>			
						 <option'; if(@$_GET['Model'] == 'Celerio'){ echo ' selected '; }echo ' class="filters-input-option" value="Celerio">Celerio</option>			
						 <option'; if(@$_GET['Model'] == 'Grand Vitara'){ echo ' selected '; }echo ' class="filters-input-option" value="Grand Vitara">Grand Vitara</option>			
						 <option'; if(@$_GET['Model'] == 'Ignis'){ echo ' selected '; }echo ' class="filters-input-option" value="Ignis">Ignis</option>			
						 <option'; if(@$_GET['Model'] == 'Jimny'){ echo ' selected '; }echo ' class="filters-input-option" value="Jimny">Jimny</option>			
						 <option'; if(@$_GET['Model'] == 'Liana'){ echo ' selected '; }echo ' class="filters-input-option" value="Liana">Liana</option>			
						 <option'; if(@$_GET['Model'] == 'SJ'){ echo ' selected '; }echo ' class="filters-input-option" value="SJ">SJ</option>			
						 <option'; if(@$_GET['Model'] == 'SX4'){ echo ' selected '; }echo ' class="filters-input-option" value="SX4">SX4</option>			
						 <option'; if(@$_GET['Model'] == 'SX4 S-Cross'){ echo ' selected '; }echo ' class="filters-input-option" value="SX4 S-Cross">SX4 S-Cross</option>			
						 <option'; if(@$_GET['Model'] == 'Samurai'){ echo ' selected '; }echo ' class="filters-input-option" value="Samurai">Samurai</option>			
						 <option'; if(@$_GET['Model'] == 'Splash'){ echo ' selected '; }echo ' class="filters-input-option" value="Splash">Splash</option>			
						 <option'; if(@$_GET['Model'] == 'Swift'){ echo ' selected '; }echo ' class="filters-input-option" value="Swift">Swift</option>			
						 <option'; if(@$_GET['Model'] == 'Swift Sport'){ echo ' selected '; }echo ' class="filters-input-option" value="Swift Sport">Swift Sport</option>			
						 <option'; if(@$_GET['Model'] == 'Vitara'){ echo ' selected '; }echo ' class="filters-input-option" value="Vitara">Vitara</option>			
						 <option'; if(@$_GET['Model'] == 'Wagon'){ echo ' selected '; }echo ' class="filters-input-option" value="Wagon">Wagon</option>			
						 <option'; if(@$_GET['Model'] == 'X-90'){ echo ' selected '; }echo ' class="filters-input-option" value="X-90">X-90</option>			
						 <option'; if(@$_GET['Model'] == 'XL7'){ echo ' selected '; }echo ' class="filters-input-option" value="XL7">XL7</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Tesla'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Model 3'){ echo ' selected '; }echo ' class="filters-input-option" value="Model 3">Model 3</option>			
						 <option'; if(@$_GET['Model'] == 'Model S'){ echo ' selected '; }echo ' class="filters-input-option" value="Model S">Model S</option>			
						 <option'; if(@$_GET['Model'] == 'Model X'){ echo ' selected '; }echo ' class="filters-input-option" value="Model X">Model X</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Toyota'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == '4-Runner'){ echo ' selected '; }echo ' class="filters-input-option" value="4-Runner">4-Runner</option>	
						 <option'; if(@$_GET['Model'] == 'Auris'){ echo ' selected '; }echo ' class="filters-input-option" value="Auris">Auris</option>	
						 <option'; if(@$_GET['Model'] == 'Avalon'){ echo ' selected '; }echo ' class="filters-input-option" value="Avalon">Avalon</option>	
						 <option'; if(@$_GET['Model'] == 'Avensis'){ echo ' selected '; }echo ' class="filters-input-option" value="Avensis">Avensis</option>	
						 <option'; if(@$_GET['Model'] == 'Avensis Verso'){ echo ' selected '; }echo ' class="filters-input-option" value="Avensis Verso">Avensis Verso</option>	
						 <option'; if(@$_GET['Model'] == 'Aygo'){ echo ' selected '; }echo ' class="filters-input-option" value="Aygo">Aygo</option>	
						 <option'; if(@$_GET['Model'] == 'C-HR'){ echo ' selected '; }echo ' class="filters-input-option" value="C-HR">C-HR</option>	
						 <option'; if(@$_GET['Model'] == 'Camry'){ echo ' selected '; }echo ' class="filters-input-option" value="Camry">Camry</option>	
						 <option'; if(@$_GET['Model'] == 'Camry Solara'){ echo ' selected '; }echo ' class="filters-input-option" value="Camry Solara">Camry Solara</option>	
						 <option'; if(@$_GET['Model'] == 'Carina'){ echo ' selected '; }echo ' class="filters-input-option" value="Carina">Carina</option>	
						 <option'; if(@$_GET['Model'] == 'Celica'){ echo ' selected '; }echo ' class="filters-input-option" value="Celica">Celica</option>	
						 <option'; if(@$_GET['Model'] == 'Corolla'){ echo ' selected '; }echo ' class="filters-input-option" value="Corolla">Corolla</option>	
						 <option'; if(@$_GET['Model'] == 'FJ'){ echo ' selected '; }echo ' class="filters-input-option" value="FJ">FJ</option>	
						 <option'; if(@$_GET['Model'] == 'GR Supra'){ echo ' selected '; }echo ' class="filters-input-option" value="GR Supra">GR Supra</option>	
						 <option'; if(@$_GET['Model'] == 'GT86'){ echo ' selected '; }echo ' class="filters-input-option" value="GT86">GT86</option>	
						 <option'; if(@$_GET['Model'] == 'Highlander'){ echo ' selected '; }echo ' class="filters-input-option" value="Highlander">Highlander</option>	
						 <option'; if(@$_GET['Model'] == 'Hilux'){ echo ' selected '; }echo ' class="filters-input-option" value="Hilux">Hilux</option>	
						 <option'; if(@$_GET['Model'] == 'Land Cruiser'){ echo ' selected '; }echo ' class="filters-input-option" value="Land Cruiser">Land Cruiser</option>	
						 <option'; if(@$_GET['Model'] == 'Highlander'){ echo ' selected '; }echo ' class="filters-input-option" value="Highlander">Highlander</option>	
						 <option'; if(@$_GET['Model'] == 'MR2'){ echo ' selected '; }echo ' class="filters-input-option" value="MR2">MR2</option>	
						 <option'; if(@$_GET['Model'] == 'Matrix'){ echo ' selected '; }echo ' class="filters-input-option" value="Matrix">Matrix</option>	
						 <option'; if(@$_GET['Model'] == 'Mirai'){ echo ' selected '; }echo ' class="filters-input-option" value="Mirai">Mirai</option>	
						 <option'; if(@$_GET['Model'] == 'Paseo'){ echo ' selected '; }echo ' class="filters-input-option" value="Paseo">Paseo</option>	
						 <option'; if(@$_GET['Model'] == 'Picnic'){ echo ' selected '; }echo ' class="filters-input-option" value="Picnic">Picnic</option>	
						 <option'; if(@$_GET['Model'] == 'Previa'){ echo ' selected '; }echo ' class="filters-input-option" value="Previa">Previa</option>	
						 <option'; if(@$_GET['Model'] == 'Prius'){ echo ' selected '; }echo ' class="filters-input-option" value="Prius">Prius</option>	
						 <option'; if(@$_GET['Model'] == 'Proace'){ echo ' selected '; }echo ' class="filters-input-option" value="Proace">Proace</option>	
						 <option'; if(@$_GET['Model'] == 'RAV4'){ echo ' selected '; }echo ' class="filters-input-option" value="RAV4">RAV4</option>	
						 <option'; if(@$_GET['Model'] == 'Sienna'){ echo ' selected '; }echo ' class="filters-input-option" value="Sienna">Sienna</option>	
						 <option'; if(@$_GET['Model'] == 'Supra'){ echo ' selected '; }echo ' class="filters-input-option" value="Supra">Supra</option>	
						 <option'; if(@$_GET['Model'] == 'Verso'){ echo ' selected '; }echo ' class="filters-input-option" value="Verso">Verso</option>	
						 <option'; if(@$_GET['Model'] == 'Yaris Verso'){ echo ' selected '; }echo ' class="filters-input-option" value="Yaris Verso">Yaris Verso</option>	
						 <option'; if(@$_GET['Model'] == 'Yaris'){ echo ' selected '; }echo ' class="filters-input-option" value="Yaris">Yaris</option>	
						 <option'; if(@$_GET['Model'] == 'iQ'){ echo ' selected '; }echo ' class="filters-input-option" value="iQ">iQ</option>
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Volkswagen'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'Arteon'){ echo ' selected '; }echo ' class="filters-input-option" value="Arteon">Arteon</option>	
						 <option'; if(@$_GET['Model'] == 'Beetle'){ echo ' selected '; }echo ' class="filters-input-option" value="Beetle">Beetle</option>	
						 <option'; if(@$_GET['Model'] == 'Bora'){ echo ' selected '; }echo ' class="filters-input-option" value="Bora">Bora</option>	
						 <option'; if(@$_GET['Model'] == 'Caddy'){ echo ' selected '; }echo ' class="filters-input-option" value="Caddy">Caddy</option>	
						 <option'; if(@$_GET['Model'] == 'California'){ echo ' selected '; }echo ' class="filters-input-option" value="California">California</option>	
						 <option'; if(@$_GET['Model'] == 'Caravelle'){ echo ' selected '; }echo ' class="filters-input-option" value="Caravelle">Caravelle</option>	
						 <option'; if(@$_GET['Model'] == 'Corrado'){ echo ' selected '; }echo ' class="filters-input-option" value="Corrado">Corrado</option>	
						 <option'; if(@$_GET['Model'] == 'Crafter'){ echo ' selected '; }echo ' class="filters-input-option" value="Crafter">Crafter</option>	
						 <option'; if(@$_GET['Model'] == 'E-Golf'){ echo ' selected '; }echo ' class="filters-input-option" value="E-Golf">E-Golf</option>	
						 <option'; if(@$_GET['Model'] == 'Eos'){ echo ' selected '; }echo ' class="filters-input-option" value="Eos">Eos</option>	
						 <option'; if(@$_GET['Model'] == 'Fox'){ echo ' selected '; }echo ' class="filters-input-option" value="Fox">Fox</option>	
						 <option'; if(@$_GET['Model'] == 'Garbus'){ echo ' selected '; }echo ' class="filters-input-option" value="Garbus">Garbus</option>	
						 <option'; if(@$_GET['Model'] == 'Golf'){ echo ' selected '; }echo ' class="filters-input-option" value="Golf">Golf</option>	
						 <option'; if(@$_GET['Model'] == 'Golf GTI'){ echo ' selected '; }echo ' class="filters-input-option" value="Golf GTI">Golf GTI</option>	
						 <option'; if(@$_GET['Model'] == 'Golf Plus'){ echo ' selected '; }echo ' class="filters-input-option" value="Golf Plus">Golf Plus</option>	
						 <option'; if(@$_GET['Model'] == 'Golf Sportsvan'){ echo ' selected '; }echo ' class="filters-input-option" value="Golf Sportsvan">Golf Sportsvan</option>	
						 <option'; if(@$_GET['Model'] == 'Jetta'){ echo ' selected '; }echo ' class="filters-input-option" value="Jetta">Jetta</option>	
						 <option'; if(@$_GET['Model'] == 'Lupo'){ echo ' selected '; }echo ' class="filters-input-option" value="Lupo">Lupo</option>	
						 <option'; if(@$_GET['Model'] == 'Multivan'){ echo ' selected '; }echo ' class="filters-input-option" value="Multivan">Multivan</option>	
						 <option'; if(@$_GET['Model'] == 'New Beetle'){ echo ' selected '; }echo ' class="filters-input-option" value="New Beetle">New Beetle</option>	
						 <option'; if(@$_GET['Model'] == 'Passat'){ echo ' selected '; }echo ' class="filters-input-option" value="Passat">Passat</option>	
						 <option'; if(@$_GET['Model'] == 'Passat CC'){ echo ' selected '; }echo ' class="filters-input-option" value="Passat CC">Passat CC</option>	
						 <option'; if(@$_GET['Model'] == 'Passat W8'){ echo ' selected '; }echo ' class="filters-input-option" value="Passat W8">Passat W8</option>	
						 <option'; if(@$_GET['Model'] == 'Phaeton'){ echo ' selected '; }echo ' class="filters-input-option" value="Phaeton">Phaeton</option>	
						 <option'; if(@$_GET['Model'] == 'Polo'){ echo ' selected '; }echo ' class="filters-input-option" value="Polo">Polo</option>	
						 <option'; if(@$_GET['Model'] == 'Polo GTI'){ echo ' selected '; }echo ' class="filters-input-option" value="Polo GTI">Polo GTI</option>	
						 <option'; if(@$_GET['Model'] == 'Routan'){ echo ' selected '; }echo ' class="filters-input-option" value="Routan">Routan</option>	
						 <option'; if(@$_GET['Model'] == 'Scirocco'){ echo ' selected '; }echo ' class="filters-input-option" value="Scirocco">Scirocco</option>	
						 <option'; if(@$_GET['Model'] == 'Sharan'){ echo ' selected '; }echo ' class="filters-input-option" value="Sharan">Sharan</option>	
						 <option'; if(@$_GET['Model'] == 'T-Cross'){ echo ' selected '; }echo ' class="filters-input-option" value="T-Cross">T-Cross</option>	
						 <option'; if(@$_GET['Model'] == 'T-Roc'){ echo ' selected '; }echo ' class="filters-input-option" value="T-Roc">T-Roc</option>	
						 <option'; if(@$_GET['Model'] == 'Tiguan'){ echo ' selected '; }echo ' class="filters-input-option" value="Tiguan">Tiguan</option>	
						 <option'; if(@$_GET['Model'] == 'Tiguan Allspace'){ echo ' selected '; }echo ' class="filters-input-option" value="Tiguan Allspace">Tiguan Allspace</option>	
						 <option'; if(@$_GET['Model'] == 'Touareg'){ echo ' selected '; }echo ' class="filters-input-option" value="Touareg">Touareg</option>	
						 <option'; if(@$_GET['Model'] == 'Touran'){ echo ' selected '; }echo ' class="filters-input-option" value="Touran">Touran</option>	
						 <option'; if(@$_GET['Model'] == 'Transporter'){ echo ' selected '; }echo ' class="filters-input-option" value="Transporter">Transporter</option>	
						 <option'; if(@$_GET['Model'] == 'Up!'){ echo ' selected '; }echo ' class="filters-input-option" value="Up!">Up!</option>	
						 <option'; if(@$_GET['Model'] == 'Vento'){ echo ' selected '; }echo ' class="filters-input-option" value="Vento">Vento</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					
					if($_GET['Marka'] === 'Volvo'){
						echo '<option'; if(@$_GET['Model'] == '0'){ echo ' selected '; }echo ' class="filters-input-option" value="0">Wybierz model</option>
						 <option'; if(@$_GET['Model'] == 'C30'){ echo ' selected '; }echo ' class="filters-input-option" value="C30">C30</option>	
						 <option'; if(@$_GET['Model'] == 'C70'){ echo ' selected '; }echo ' class="filters-input-option" value="C70">C70</option>	
						 <option'; if(@$_GET['Model'] == 'S40'){ echo ' selected '; }echo ' class="filters-input-option" value="S40">S40</option>	
						 <option'; if(@$_GET['Model'] == 'S60'){ echo ' selected '; }echo ' class="filters-input-option" value="S60">S60</option>	
						 <option'; if(@$_GET['Model'] == 'S70'){ echo ' selected '; }echo ' class="filters-input-option" value="S70">S70</option>	
						 <option'; if(@$_GET['Model'] == 'S80'){ echo ' selected '; }echo ' class="filters-input-option" value="S80">S80</option>	
						 <option'; if(@$_GET['Model'] == 'S90'){ echo ' selected '; }echo ' class="filters-input-option" value="S90">S90</option>	
						 <option'; if(@$_GET['Model'] == 'Seria 200'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 200">Seria 200</option>	
						 <option'; if(@$_GET['Model'] == 'Seria 400'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 400">Seria 400</option>	
						 <option'; if(@$_GET['Model'] == 'Seria 700'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 700">Seria 700</option>	
						 <option'; if(@$_GET['Model'] == 'Seria 800'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 800">Seria 800</option>	
						 <option'; if(@$_GET['Model'] == 'Seria 900'){ echo ' selected '; }echo ' class="filters-input-option" value="Seria 900">Seria 900</option>	
						 <option'; if(@$_GET['Model'] == 'V40'){ echo ' selected '; }echo ' class="filters-input-option" value="V40">V40</option>	
						 <option'; if(@$_GET['Model'] == 'V50'){ echo ' selected '; }echo ' class="filters-input-option" value="V50">V50</option>	
						 <option'; if(@$_GET['Model'] == 'V60'){ echo ' selected '; }echo ' class="filters-input-option" value="V60">V60</option>	
						 <option'; if(@$_GET['Model'] == 'V70'){ echo ' selected '; }echo ' class="filters-input-option" value="V70">V70</option>	
						 <option'; if(@$_GET['Model'] == 'V90'){ echo ' selected '; }echo ' class="filters-input-option" value="V90">V90</option>	
						 <option'; if(@$_GET['Model'] == 'XC40'){ echo ' selected '; }echo ' class="filters-input-option" value="XC40">XC40</option>	
						 <option'; if(@$_GET['Model'] == 'XC50'){ echo ' selected '; }echo ' class="filters-input-option" value="XC50">XC50</option>	
						 <option'; if(@$_GET['Model'] == 'XC60'){ echo ' selected '; }echo ' class="filters-input-option" value="XC60">XC60</option>	
						 <option'; if(@$_GET['Model'] == 'XC70'){ echo ' selected '; }echo ' class="filters-input-option" value="XC70">XC70</option>	
						 <option'; if(@$_GET['Model'] == 'XC80'){ echo ' selected '; }echo ' class="filters-input-option" value="XC80">XC80</option>	
						 <option'; if(@$_GET['Model'] == 'XC90'){ echo ' selected '; }echo ' class="filters-input-option" value="XC90">XC90</option>	
						 <option'; if(@$_GET['Model'] == 'Inne'){ echo ' selected '; }echo ' class="filters-input-option" value="Inne">Inne</option>';
												
					}
					?>
			</select>
			<select class="filters-input-select" id="Nadwozie" name="Nadwozie">
				<option <?php if(@$_GET['Nadwozie'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Nadwozie</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Coupe'){ echo 'selected'; } ?> class="filters-input-option" value="Coupe">Coupe</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Hatchback'){ echo 'selected'; } ?> class="filters-input-option" value="Hatchback">Hatchback</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Kabriolet'){ echo 'selected'; } ?> class="filters-input-option" value="Kabriolet">Kabriolet</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Kombi'){ echo 'selected'; } ?> class="filters-input-option" value="Kombi">Kombi</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Minivan'){ echo 'selected'; } ?> class="filters-input-option" value="Minivan">Minivan</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Pickup'){ echo 'selected'; } ?> class="filters-input-option" value="Pickup">Pickup</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Sedan'){ echo 'selected'; } ?> class="filters-input-option" value="Sedan">Sedan</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Suv'){ echo 'selected'; } ?> class="filters-input-option" value="Suv">Suv</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Terenowy'){ echo 'selected'; } ?> class="filters-input-option" value="Terenowy">Terenowy</option>
				<option <?php if(@$_GET['Nadwozie'] == 'Van'){ echo 'selected'; } ?> class="filters-input-option" value="Van">Van</option>
			</select>
			<select class="filters-input-select" id="Paliwo" name="Paliwo">
				<option <?php if(@$_GET['Paliwo'] == '0'){ echo 'selected'; } ?> class="filters-input-option" value="0">Paliwo</option>
				<option <?php if(@$_GET['Paliwo'] == 'Benzyna'){ echo 'selected'; } ?> class="filters-input-option" value="Benzyna">Benzyna</option>
				<option <?php if(@$_GET['Paliwo'] == 'Benzyna+LPG'){ echo 'selected'; } ?> class="filters-input-option" value="Benzyna+LPG">Benzyna+LPG</option>
				<option <?php if(@$_GET['Paliwo'] == 'Diesel'){ echo 'selected'; } ?> class="filters-input-option" value="Diesel">Diesel</option>
				<option <?php if(@$_GET['Paliwo'] == 'Elektryczny'){ echo 'selected'; } ?> class="filters-input-option" value="Elektryczny">Elektryczny</option>
				<option <?php if(@$_GET['Paliwo'] == 'Hybryda(Benzyna)'){ echo 'selected'; } ?> class="filters-input-option" value="Hybryda(Benzyna)">Hybryda(Benzyna)</option>
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
					<option class="filters-input-option" value="1000" label="1 000 zł">
					<option class="filters-input-option" value="2500" label="2 500 zł">
					<option class="filters-input-option" value="4500" label="4 500 zł">
					<option class="filters-input-option" value="6000" label="6 000 zł">
					<option class="filters-input-option" value="8000" label="8 000 zł">
					<option class="filters-input-option" value="10000" label="10 000 zł">
					<option class="filters-input-option" value="15000" label="15 000 zł">
					<option class="filters-input-option" value="20000" label="20 000 zł">
					<option class="filters-input-option" value="30000" label="30 000 zł">
					<option class="filters-input-option" value="50000" label="50 000 zł">
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
					<option class="filters-input-option" value="30" label="30 KM">
					<option class="filters-input-option" value="50" label="50 KM">
					<option class="filters-input-option" value="80" label="80 KM">
					<option class="filters-input-option" value="100" label="100 KM">
					<option class="filters-input-option" value="130" label="130 KM">
					<option class="filters-input-option" value="170" label="170 KM">
				</select>
			</datalist>
			
			<input <?php if(@isset($_GET['poj_silnikaod'])){ echo 'value ="'.$_GET['poj_silnikaod'].'"'; } ?> class="filters-input-select" type="text" maxlength="5" name="poj_silnikaod" list="poj_silnika" placeholder="Poj. silnika od" onclick='document.getElementById("ps").style="display: block;";' onkeydown="return noNum(event)">
			<input <?php if(@isset($_GET['poj_silnikado'])){ echo 'value ="'.$_GET['poj_silnikado'].'"'; } ?> class="filters-input-select" type="text" maxlength="5" name="poj_silnikado" list="poj_silnika" placeholder="Poj. silnika do" onclick='document.getElementById("ps").style="display: block;";' onkeydown="return noNum(event)">
			<datalist id="poj_silnika">
				<select id="ps">
					<option class="filters-input-option" value="1000" label="1 000 cm³">
					<option class="filters-input-option" value="1200" label="1 200 cm³">
					<option class="filters-input-option" value="1600" label="1 600 cm³">
					<option class="filters-input-option" value="1800" label="1 800 cm³">
					<option class="filters-input-option" value="2000" label="2 000 cm³">
					<option class="filters-input-option" value="2200" label="2 200 cm³">
					<option class="filters-input-option" value="2500" label="2 500 cm³">
					<option class="filters-input-option" value="2700" label="2 700 cm³">
					<option class="filters-input-option" value="3000" label="3 000 cm³">
				</select>
			</datalist>

	

			<input <?php if(@isset($_GET['przebiegod'])){ echo 'value ="'.$_GET['przebiegod'].'"'; } ?> class="filters-input-select" type="text" maxlength="8" name="przebiegod" list="przebieg" placeholder="Przebieg od" onclick='document.getElementById("prs").style="display: block;";' onkeydown="return noNum(event)">
			<input <?php if(@isset($_GET['przebiegdo'])){ echo 'value ="'.$_GET['przebiegdo'].'"'; } ?> class="filters-input-select" type="text" maxlength="8" name="przebiegdo" list="przebieg" placeholder="Przebieg do" onclick='document.getElementById("prs").style="display: block;";' onkeydown="return noNum(event)">
			<datalist id="przebieg">
				<select id="prs">
					<option class="filters-input-option" value="500" label="500 km">
					<option class="filters-input-option" value="1000" label="1 000 km">
					<option class="filters-input-option" value="5000" label="5 000 km">
					<option class="filters-input-option" value="10000" label="10 000 km">
					<option class="filters-input-option" value="30000" label="30 000 km">
					<option class="filters-input-option" value="50000" label="50 000 km">
					<option class="filters-input-option" value="100000" label="100 000 km">
					<option class="filters-input-option" value="150000" label="150 000 km">
					<option class="filters-input-option" value="200000" label="200 000 km">
					<option class="filters-input-option" value="250000" label="250 000 km">
					<option class="filters-input-option" value="300000" label="300 000 km">
				</select>
			</datalist>
			<div>
				<span class="filters-row-2"><input type="submit" class="filters-input-btn" name="submitsearch" value="Filtruj wyniki"></span>
				<span class="filters-row-3"><a class="filters-input-a" onclick="window.location.href='samochodyosobowe.php?page=<?php if(isset($_GET['page'])){echo $_GET['page'];}else{echo '0';}; ?>'">Usuń filtry</a></span>
			</div>
		</form>
		
		
	</div>
	
	
	<div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 text-left border-primary">
            <h2 class="font-weight-light text-primary">Wszystkie w samochody osobowe</h2>
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
							$zapytanie = 'SELECT * FROM samochody_osobowe WHERE datepromotion > NOW()';
							$zapytanie1 = 'SELECT * FROM samochody_osobowe WHERE datepromotion < NOW()';
							if(isset($_GET['submitsearch'])){
								if((@$_GET['Marka'] == 'Abarth') || (@$_GET['Marka'] == 'Acura') || (@$_GET['Marka'] == 'Alfa Romeo') 
									|| (@$_GET['Marka'] == 'Aston Martin') || (@$_GET['Marka'] == 'Audi') || (@$_GET['Marka'] == 'Bentley') 
									|| (@$_GET['Marka'] == 'BMW') || (@$_GET['Marka'] == 'Bugatti') || (@$_GET['Marka'] == 'Cadilac') 
									|| (@$_GET['Marka'] == 'Chevrolet') || (@$_GET['Marka'] == 'Chrysler') || (@$_GET['Marka'] == 'Citroen') 
									|| (@$_GET['Marka'] == 'Dacia') || (@$_GET['Marka'] == 'Daewoo') || (@$_GET['Marka'] == 'Daihatsu') 
									|| (@$_GET['Marka'] == 'Dodge') || (@$_GET['Marka'] == 'Ferrari') || (@$_GET['Marka'] == 'Fiat') 
									|| (@$_GET['Marka'] == 'Ford') || (@$_GET['Marka'] == 'Honda') || (@$_GET['Marka'] == 'Hyundai') 
									|| (@$_GET['Marka'] == 'Infiniti') || (@$_GET['Marka'] == 'Jaguar') || (@$_GET['Marka'] == 'Jeep') 
									|| (@$_GET['Marka'] == 'Kia') || (@$_GET['Marka'] == 'Lamborghini') || (@$_GET['Marka'] == 'Lancia') 
									|| (@$_GET['Marka'] == 'Land Rover') || (@$_GET['Marka'] == 'Lexus') || (@$_GET['Marka'] == 'Lincoln') 
									|| (@$_GET['Marka'] == 'Lotus') || (@$_GET['Marka'] == 'Maserati') || (@$_GET['Marka'] == 'Mazda') 
									|| (@$_GET['Marka'] == 'McLaren') || (@$_GET['Marka'] == 'Mercedes') || (@$_GET['Marka'] == 'MicroCar') 
									|| (@$_GET['Marka'] == 'Mini') || (@$_GET['Marka'] == 'Mitsubishi') || (@$_GET['Marka'] == 'Nissan') 
									|| (@$_GET['Marka'] == 'Opel') || (@$_GET['Marka'] == 'Peugeot') || (@$_GET['Marka'] == 'Polonez') 
									|| (@$_GET['Marka'] == 'Porsche') || (@$_GET['Marka'] == 'Renault') || (@$_GET['Marka'] == 'Rolls Royce') 
									|| (@$_GET['Marka'] == 'Rover') || (@$_GET['Marka'] == 'Saab') || (@$_GET['Marka'] == 'Seat') 
									|| (@$_GET['Marka'] == 'Skoda') || (@$_GET['Marka'] == 'Smart') || (@$_GET['Marka'] == 'SsangYong')
									|| (@$_GET['Marka'] == 'Subaru') || (@$_GET['Marka'] == 'Suzuki') || (@$_GET['Marka'] == 'Tesla')
									|| (@$_GET['Marka'] == 'Toyota') || (@$_GET['Marka'] == 'Volkswagen') || (@$_GET['Marka'] == 'Volvo') 
									|| (@$_GET['Marka'] == 'Zabytkowe') || (@$_GET['Marka'] == 'Inna marka')){
									
									if(isset($_GET['Model'])){
										if(($_GET['Marka'] == 'Zabytkowe') || ($_GET['Marka'] == 'Inna marka')){
											if(isset($_GET['Model'])){
												unset($_GET['Model']); 
											}
										}
										if($_GET['Marka'] == 'Abarth'){
											if(!(($_GET['Model'] == '124 Spider') || ($_GET['Model'] == '500') ||  ($_GET['Model'] == 'Grande Punto') 
												|| ($_GET['Model'] == 'Punto') || ($_GET['Model'] == 'Punto Evo') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										if($_GET['Marka'] == 'Acura'){
											if(!(($_GET['Model'] == 'CDX') || ($_GET['Model'] == 'ILX') || ($_GET['Model'] == 'MDX')
												|| ($_GET['Model'] == 'RDX') || ($_GET['Model'] == 'RLX') || ($_GET['Model'] == 'TLX')
												|| ($_GET['Model'] == 'TSX') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Alfa Romeo'){
											if(!(($_GET['Model'] == '145') || ($_GET['Model'] == '146') || ($_GET['Model'] == '147') || ($_GET['Model'] == '155') 
												|| ($_GET['Model'] == '156') || ($_GET['Model'] == '159') || ($_GET['Model'] == '164') || ($_GET['Model'] == '166')
												|| ($_GET['Model'] == '4C') || ($_GET['Model'] == 'Brera') || ($_GET['Model'] == 'GT') || ($_GET['Model'] == 'GTV')
												|| ($_GET['Model'] == 'Giulia') || ($_GET['Model'] == 'Giulietta') || ($_GET['Model'] == 'Mito') || ($_GET['Model'] == 'Spider')
												|| ($_GET['Model'] == 'Stelvio') || ($_GET['Model'] == 'Inne'))){	
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Aston Martin'){
											if(!(($_GET['Model'] == 'DB11') || ($_GET['Model'] == 'DB7') || ($_GET['Model'] == 'DB9') || ($_GET['Model'] == 'DBS Superleggera')
												|| ($_GET['Model'] == 'One-77') || ($_GET['Model'] == 'Rapide') || ($_GET['Model'] == 'Vantage') || ($_GET['Model'] == 'Vanquish')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Audi'){
											if(!(($_GET['Model'] == '80') || ($_GET['Model'] == '90') || ($_GET['Model'] == '100') || ($_GET['Model'] == '200')
												|| ($_GET['Model'] == 'A1') || ($_GET['Model'] == 'A2') || ($_GET['Model'] == 'A3') || ($_GET['Model'] == 'A4')
												|| ($_GET['Model'] == 'A5') || ($_GET['Model'] == 'A6') || ($_GET['Model'] == 'A7') || ($_GET['Model'] == 'A8')
												|| ($_GET['Model'] == 'S1') || ($_GET['Model'] == 'S2') || ($_GET['Model'] == 'S3') || ($_GET['Model'] == 'S4')
												|| ($_GET['Model'] == 'S5') || ($_GET['Model'] == 'S6') || ($_GET['Model'] == 'S7') || ($_GET['Model'] == 'S8')
												|| ($_GET['Model'] == 'RS1') || ($_GET['Model'] == 'RS2') || ($_GET['Model'] == 'RS3') || ($_GET['Model'] == 'RS4')
												|| ($_GET['Model'] == 'RS5') || ($_GET['Model'] == 'RS6') || ($_GET['Model'] == 'RS7') || ($_GET['Model'] == 'RS8')														
												|| ($_GET['Model'] == 'Q1') || ($_GET['Model'] == 'Q2') || ($_GET['Model'] == 'Q3') || ($_GET['Model'] == 'Q4')
												|| ($_GET['Model'] == 'Q5') || ($_GET['Model'] == 'Q6') || ($_GET['Model'] == 'Q7') || ($_GET['Model'] == 'Q8')
												|| ($_GET['Model'] == 'E-Tron') || ($_GET['Model'] == 'TT') || ($_GET['Model'] == 'R8') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Bentley'){
											if(!(($_GET['Model'] == 'Bentayga') || ($_GET['Model'] == 'Continental') || ($_GET['Model'] == 'Flying Spur')
												|| ($_GET['Model'] == 'Mulsanne') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'BMW'){
											if(!(($_GET['Model'] == 'M1') || ($_GET['Model'] == 'M2') || ($_GET['Model'] == 'M3') || ($_GET['Model'] == 'M4')
												|| ($_GET['Model'] == 'M5') || ($_GET['Model'] == 'M6') || ($_GET['Model'] == 'M7') || ($_GET['Model'] == 'M8')
												|| ($_GET['Model'] == 'Seria 1') || ($_GET['Model'] == 'Seria 2') || ($_GET['Model'] == 'Seria 3') || ($_GET['Model'] == 'Seria 4')
												|| ($_GET['Model'] == 'Seria 5') || ($_GET['Model'] == 'Seria 6') || ($_GET['Model'] == 'Seria 7') || ($_GET['Model'] == 'Seria 8')
												|| ($_GET['Model'] == 'i3') || ($_GET['Model'] == 'i8') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	

										if($_GET['Marka'] == 'Bugatti'){
											if(!(($_GET['Model'] == 'Veyron') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	

										if($_GET['Marka'] == 'Cadilac'){
											if(!(($_GET['Model'] == 'ATS') || ($_GET['Model'] == 'CT6') || ($_GET['Model'] == 'CTS') || ($_GET['Model'] == 'ELR')
												|| ($_GET['Model'] == 'Escalade') || ($_GET['Model'] == 'SLS') || ($_GET['Model'] == 'SRX') || ($_GET['Model'] == 'XT5')
												|| ($_GET['Model'] == 'XTS') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										

										if($_GET['Marka'] == 'Chevrolet'){
											if(!(($_GET['Model'] == 'Aveo') || ($_GET['Model'] == 'Camaro') || ($_GET['Model'] == 'Captiva') || ($_GET['Model'] == 'Cruze')
												|| ($_GET['Model'] == 'Epica') || ($_GET['Model'] == 'Evanda') || ($_GET['Model'] == 'Lacetti') || ($_GET['Model'] == 'Malibu')
												|| ($_GET['Model'] == 'Orlando') || ($_GET['Model'] == 'Spark') || ($_GET['Model'] == 'Tacuma') || ($_GET['Model'] == 'Trax')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	

										if($_GET['Marka'] == 'Chrysler'){
											if(!(($_GET['Model'] == '300C') || ($_GET['Model'] == '300M') || ($_GET['Model'] == 'Caravan') || ($_GET['Model'] == 'Intrepid')
												|| ($_GET['Model'] == 'Neon') || ($_GET['Model'] == 'PT Cruiser') || ($_GET['Model'] == 'Sebring') || ($_GET['Model'] == 'Stratus')
												|| ($_GET['Model'] == 'Town Country') || ($_GET['Model'] == 'Vision') || ($_GET['Model'] == 'Voyager')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}

										if($_GET['Marka'] == 'Citroen'){
											if(!(($_GET['Model'] == 'Berlingo') || ($_GET['Model'] == 'C-Elysee') || ($_GET['Model'] == 'C1') || ($_GET['Model'] == 'C2')
												|| ($_GET['Model'] == 'C3') || ($_GET['Model'] == 'C4') || ($_GET['Model'] == 'C4 Aircross') || ($_GET['Model'] == 'C4 Cactus')
												|| ($_GET['Model'] == 'C4 Picasso') || ($_GET['Model'] == 'C5') || ($_GET['Model'] == 'C5 Aircross') || ($_GET['Model'] == 'C6')
												|| ($_GET['Model'] == 'C8') || ($_GET['Model'] == 'DS3') || ($_GET['Model'] == 'DS4') || ($_GET['Model'] == 'DS5')
												|| ($_GET['Model'] == 'Evasion') || ($_GET['Model'] == 'Nemo') || ($_GET['Model'] == 'Saxo') || ($_GET['Model'] == 'XM')
												|| ($_GET['Model'] == 'Xantia') || ($_GET['Model'] == 'Xsara') || ($_GET['Model'] == 'Xsara Picasso') 
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Dacia'){
											if(!(($_GET['Model'] == 'Dokker') || ($_GET['Model'] == 'Duster') || ($_GET['Model'] == 'Lodgy') || ($_GET['Model'] == 'Logan')
												|| ($_GET['Model'] == 'Nova') || ($_GET['Model'] == 'Sandero') || ($_GET['Model'] == 'Sandero Stepway')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Daewoo'){
											if(!(($_GET['Model'] == 'Espero') || ($_GET['Model'] == 'Kalos') || ($_GET['Model'] == 'Lanos') || ($_GET['Model'] == 'Leganza')
												|| ($_GET['Model'] == 'Matiz') || ($_GET['Model'] == 'Nubira') || ($_GET['Model'] == 'Rezzo') || ($_GET['Model'] == 'Tacuma') 
												|| ($_GET['Model'] == 'Tico') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Daihatsu'){
											if(!(($_GET['Model'] == 'Coure') || ($_GET['Model'] == 'Esse') || ($_GET['Model'] == 'Feroza') || ($_GET['Model'] == 'Sirion')
												|| ($_GET['Model'] == 'Terios') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Dodge'){
											if(!(($_GET['Model'] == 'Avenger') || ($_GET['Model'] == 'Caliber') || ($_GET['Model'] == 'Caravan')
												|| ($_GET['Model'] == 'Challenger') || ($_GET['Model'] == 'Charger') || ($_GET['Model'] == 'Durango') 
												|| ($_GET['Model'] == 'Grand Caravan') || ($_GET['Model'] == 'Magnum') || ($_GET['Model'] == 'Nitro')
												|| ($_GET['Model'] == 'Ram') || ($_GET['Model'] == 'Stratus') || ($_GET['Model'] == 'Viper') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Ferrari'){
											if(!(($_GET['Model'] == '458') || ($_GET['Model'] == '488') || ($_GET['Model'] == 'California') || ($_GET['Model'] == 'F12')
												|| ($_GET['Model'] == 'F40') || ($_GET['Model'] == 'F8') || ($_GET['Model'] == 'Portofino') || ($_GET['Model'] == 'Testarossa')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Fiat'){
											if(!(($_GET['Model'] == '125p') || ($_GET['Model'] == '126p') || ($_GET['Model'] == '500') || ($_GET['Model'] == 'Albea') || ($_GET['Model'] == 'Barchetta')
												|| ($_GET['Model'] == 'Brava') || ($_GET['Model'] == 'Bravo') || ($_GET['Model'] == 'Cinquecento') || ($_GET['Model'] == 'Coupe')
												|| ($_GET['Model'] == 'Doblo') || ($_GET['Model'] == 'Ducato') || ($_GET['Model'] == 'Idea') || ($_GET['Model'] == 'Linea') 
												|| ($_GET['Model'] == 'Marea') || ($_GET['Model'] == 'Multipla') || ($_GET['Model'] == 'Palio') || ($_GET['Model'] == 'Panda')
												|| ($_GET['Model'] == 'Punto') || ($_GET['Model'] == 'Qubo') || ($_GET['Model'] == 'Scudo') || ($_GET['Model'] == 'Seicento') 
												|| ($_GET['Model'] == 'Siena') || ($_GET['Model'] == 'Stilo') || ($_GET['Model'] == 'Tipo') || ($_GET['Model'] == 'Ulysse') 
												|| ($_GET['Model'] == 'Uno') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Ford'){
											if(!(($_GET['Model'] == 'Active') || ($_GET['Model'] == 'Cougar') || ($_GET['Model'] == 'EcoSport') || ($_GET['Model'] == 'Edge')
												|| ($_GET['Model'] == 'Escort') || ($_GET['Model'] == 'Explorer') || ($_GET['Model'] == 'Fiesta') || ($_GET['Model'] == 'Focus')
												|| ($_GET['Model'] == 'Fusion') || ($_GET['Model'] == 'GT') || ($_GET['Model'] == 'Galaxy') || ($_GET['Model'] == 'Granada') 
												|| ($_GET['Model'] == 'Ka') || ($_GET['Model'] == 'Kuga') || ($_GET['Model'] == 'Maverick') || ($_GET['Model'] == 'Mondeo')
												|| ($_GET['Model'] == 'Mustang') || ($_GET['Model'] == 'Orion') || ($_GET['Model'] == 'Puma') || ($_GET['Model'] == 'Ranger') 
												|| ($_GET['Model'] == 'Raptor') || ($_GET['Model'] == 'S-Max') || ($_GET['Model'] == 'Scorpio') || ($_GET['Model'] == 'Sierra')
												|| ($_GET['Model'] == 'Streetka') || ($_GET['Model'] == 'Tourneo') || ($_GET['Model'] == 'Transit') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 			
											}
										}	
										
										if($_GET['Marka'] == 'Honda'){
											if(!(($_GET['Model'] == 'Accord') || ($_GET['Model'] == 'CR-V') || ($_GET['Model'] == 'CR-Z') || ($_GET['Model'] == 'CRX')
												|| ($_GET['Model'] == 'CR-Z') || ($_GET['Model'] == 'City') || ($_GET['Model'] == 'Civic') || ($_GET['Model'] == 'HR-V') || ($_GET['Model'] == 'Jazz')
												|| ($_GET['Model'] == 'Legend') || ($_GET['Model'] == 'Logo') || ($_GET['Model'] == 'NSX') || ($_GET['Model'] == 'S 2000')
												|| ($_GET['Model'] == 'TypeR') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Hyundai'){
											if(!(($_GET['Model'] == 'Accent') || ($_GET['Model'] == 'Atos') || ($_GET['Model'] == 'Coupe') || ($_GET['Model'] == 'Elantra')
												|| ($_GET['Model'] == 'Galloper') || ($_GET['Model'] == 'Getz') || ($_GET['Model'] == 'H1') || ($_GET['Model'] == 'H200') 
												|| ($_GET['Model'] == 'Kona') || ($_GET['Model'] == 'Lantra') || ($_GET['Model'] == 'Matrix') || ($_GET['Model'] == 'Santa Fe') 
												|| ($_GET['Model'] == 'Sonata') || ($_GET['Model'] == 'Terracan') || ($_GET['Model'] == 'Trajet') || ($_GET['Model'] == 'Tucson')
												|| ($_GET['Model'] == 'Veloster') || ($_GET['Model'] == 'XG') || ($_GET['Model'] == 'i10') || ($_GET['Model'] == 'i20')
												|| ($_GET['Model'] == 'i30') || ($_GET['Model'] == 'i40') || ($_GET['Model'] == 'ix20') || ($_GET['Model'] == 'ix35')
												|| ($_GET['Model'] == 'ix55') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Infiniti'){
											if(!(($_GET['Model'] == 'EX'	) || ($_GET['Model'] == 'FX'	) || ($_GET['Model'] == 'G') || ($_GET['Model'] == 'Q30')
												|| ($_GET['Model'] == 'Q40') || ($_GET['Model'] == 'Q50') || ($_GET['Model'] == 'Q60') || ($_GET['Model'] == 'Q70')
												|| ($_GET['Model'] == 'QX30') || ($_GET['Model'] == 'QX50') || ($_GET['Model'] == 'QX60') || ($_GET['Model'] == 'QX70')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Jaguar'){
											if(!(($_GET['Model'] == 'E-Pace')  || ($_GET['Model'] == 'F-Pace') || ($_GET['Model'] == 'F-Type')
												|| ($_GET['Model'] == 'I-Pace') || ($_GET['Model'] == 'S-Type') || ($_GET['Model'] == 'XE') || ($_GET['Model'] == 'XF')
												|| ($_GET['Model'] == '>XJ') || ($_GET['Model'] == 'XJR') || ($_GET['Model'] == 'XKR') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Jeep'){
											if(!(($_GET['Model'] == 'Commander') || ($_GET['Model'] == 'Compass') || ($_GET['Model'] == 'Grand Cherokee')
												|| ($_GET['Model'] == 'Liberty') || ($_GET['Model'] == 'Patriot') || ($_GET['Model'] == 'Renegade') 
												|| ($_GET['Model'] == 'Wrangler') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Kia'){
											if(!(($_GET['Model'] == 'Carens') || ($_GET['Model'] == 'Carnival') || ($_GET['Model'] == 'Ceed') || ($_GET['Model'] == 'Ceed GT')
												|| ($_GET['Model'] == 'Cerato') || ($_GET['Model'] == 'Magentis') || ($_GET['Model'] == 'Niro') || ($_GET['Model'] == 'Optima')
												|| ($_GET['Model'] == 'Picanto') || ($_GET['Model'] == 'Retona') || ($_GET['Model'] == 'Sephia') || ($_GET['Model'] == 'Sorento')
												|| ($_GET['Model'] == 'Soul') || ($_GET['Model'] == 'Sportage') || ($_GET['Model'] == 'Stinger') || ($_GET['Model'] == 'Stonic')
												|| ($_GET['Model'] == 'Venga') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Lamborghini'){
											if(!(($_GET['Model'] == 'Aventador') || ($_GET['Model'] == 'Gallardo') || ($_GET['Model'] == 'Huracan')
												|| ($_GET['Model'] == 'Murcielago') || ($_GET['Model'] == 'Reventon') || ($_GET['Model'] == 'Urus')
												|| ($_GET['Model'] == 'Veneno') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Lancia'){
											if(!(($_GET['Model'] == 'Delta') || ($_GET['Model'] == 'Kappa') || ($_GET['Model'] == 'Lybra') || ($_GET['Model'] == 'Musa') 
												|| ($_GET['Model'] == 'Phedra') || ($_GET['Model'] == 'Still') || ($_GET['Model'] == 'Thema') || ($_GET['Model'] == 'Thesis')
												|| ($_GET['Model'] == 'Voyager') || ($_GET['Model'] == 'Ypsilon') || ($_GET['Model'] == 'Zeta') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Land Rover'){
											if(!(($_GET['Model'] == 'Discovery') || ($_GET['Model'] == 'Discovery Sport') || ($_GET['Model'] == 'Freelander')
												|| ($_GET['Model'] == 'Range Rover') || ($_GET['Model'] == 'Range Rover Evoque')
												|| ($_GET['Model'] == 'Range Rover Sport') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Lexus'){
											if(!(($_GET['Model'] == 'CT') || ($_GET['Model'] == 'ES300') || ($_GET['Model'] == 'GS300') || ($_GET['Model'] == 'GS450')
												|| ($_GET['Model'] == 'IS200') || ($_GET['Model'] == 'IS220') || ($_GET['Model'] == 'IS250') || ($_GET['Model'] == 'LC')
												|| ($_GET['Model'] == 'LS') || ($_GET['Model'] == 'NX') || ($_GET['Model'] == 'RC') || ($_GET['Model'] == 'RX300') 
												|| ($_GET['Model'] == 'RX350') || ($_GET['Model'] == 'RX400') || ($_GET['Model'] == 'SC') || ($_GET['Model'] == 'UX'	)
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Lincoln'){
											if(!(($_GET['Model'] == 'Aviator') || ($_GET['Model'] == 'MKC') || ($_GET['Model'] == 'MKS') || ($_GET['Model'] == 'MKT')
												|| ($_GET['Model'] == 'MKX') || ($_GET['Model'] == 'MKZ') || ($_GET['Model'] == 'Nautilus') || ($_GET['Model'] == 'Navigator')
												|| ($_GET['Model'] == 'Town Car') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Lotus'){
											if(!(($_GET['Model'] == 'Elise') || ($_GET['Model'] == 'Evora') || ($_GET['Model'] == 'Exige') 
												|| ($_GET['Model'] == 'Exige S') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Maserati'){
											if(!(($_GET['Model'] == 'Ghibli') || ($_GET['Model'] == 'GranCabrio') || ($_GET['Model'] == 'GranTurismo') 
												|| ($_GET['Model'] == 'Levante') || ($_GET['Model'] == 'Quattroporte') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Mazda'){
											if(!(($_GET['Model'] == '2') || ($_GET['Model'] == '3') || ($_GET['Model'] == '323F') || ($_GET['Model'] == '4')
												|| ($_GET['Model'] == '5') || ($_GET['Model'] == '6') || ($_GET['Model'] == '121') || ($_GET['Model'] == '323') 
												|| ($_GET['Model'] == '626') || ($_GET['Model'] == '929') || ($_GET['Model'] == 'BT-50') || ($_GET['Model'] == 'CX-3')
												|| ($_GET['Model'] == 'CX-5') || ($_GET['Model'] == 'CX-7') || ($_GET['Model'] == 'CX-9') || ($_GET['Model'] == 'Demio')
												|| ($_GET['Model'] == 'MPV') || ($_GET['Model'] == 'MX-2') || ($_GET['Model'] == 'MX-5') || ($_GET['Model'] == 'MX-6') 
												|| ($_GET['Model'] == 'Millenia') || ($_GET['Model'] == 'Premacy') || ($_GET['Model'] == 'Protege') || ($_GET['Model'] == 'RX-6')
												|| ($_GET['Model'] == 'RX-7') || ($_GET['Model'] == 'RX-8') || ($_GET['Model'] == 'Tribute')
												|| ($_GET['Model'] == 'Xedos') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'McLaren'){
											if(!(($_GET['Model'] == '540C') || ($_GET['Model'] == '570GT') || ($_GET['Model'] == '570S') || ($_GET['Model'] == '570S Spider') 
												|| ($_GET['Model'] == '600LT') || ($_GET['Model'] == '600LT Spider') || ($_GET['Model'] == '720S') || ($_GET['Model'] == '720S Spider')
												|| ($_GET['Model'] == 'F1') || ($_GET['Model'] == 'GT') || ($_GET['Model'] == 'P1') || ($_GET['Model'] == 'Senna')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Mercedes'){
											if(!(($_GET['Model'] == 'AMG') || ($_GET['Model'] == 'CLA') || ($_GET['Model'] == 'Citan') || ($_GET['Model'] == 'EQC') 
												|| ($_GET['Model'] == 'GL') || ($_GET['Model'] == 'GLA') || ($_GET['Model'] == 'GLB') || ($_GET['Model'] == 'GLC')
												|| ($_GET['Model'] == 'GLE') || ($_GET['Model'] == 'GLS') || ($_GET['Model'] == 'Klasa A') || ($_GET['Model'] == 'Klasa B') 
												|| ($_GET['Model'] == 'Klasa C') || ($_GET['Model'] == 'Klasa E') || ($_GET['Model'] == 'Klasa G') || ($_GET['Model'] == 'Klasa S')
												|| ($_GET['Model'] == 'Klasa V') || ($_GET['Model'] == 'Klasa X') || ($_GET['Model'] == 'ML') || ($_GET['Model'] == 'SL') 
												|| ($_GET['Model'] == 'SLC') || ($_GET['Model'] == 'ML') || ($_GET['Model'] == 'SLK') || ($_GET['Model'] == 'Vaneo')
												|| ($_GET['Model'] == 'Viano') || ($_GET['Model'] == 'Vito') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'MicroCar'){
											if(!(($_GET['Model'] == 'Aixam') || ($_GET['Model'] == 'Chatenet') || ($_GET['Model'] == 'Grecav') || ($_GET['Model'] == 'Ligier') 
												|| ($_GET['Model'] == 'M.Go') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Mini'){
											if(!(($_GET['Model'] == 'Cabrio') || ($_GET['Model'] == 'Clubman') || ($_GET['Model'] == 'Cooper') 
												|| ($_GET['Model'] == 'Cooper S') || ($_GET['Model'] == 'Countryman')
												|| ($_GET['Model'] == 'One') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Mitsubishi'){
											if(!(($_GET['Model'] == 'ASX') || ($_GET['Model'] == 'Carisma') || ($_GET['Model'] == 'Colt') || ($_GET['Model'] == 'Eclipse') 
												|| ($_GET['Model'] == 'Eclipse Cross') || ($_GET['Model'] == 'Endeavor') || ($_GET['Model'] == 'Galant') || ($_GET['Model'] == 'Grandis')
												|| ($_GET['Model'] == 'L200') || ($_GET['Model'] == 'L400') || ($_GET['Model'] == 'Lancer Evolution VI')
												|| ($_GET['Model'] == 'Lancer Evolution VII') || ($_GET['Model'] == 'Lancer Evolution VIII')
												|| ($_GET['Model'] == 'Lancer Evolution IX') || ($_GET['Model'] == 'Lancer Evolution X') || ($_GET['Model'] == 'Montero')
												|| ($_GET['Model'] == 'Outlander') || ($_GET['Model'] == 'Outlander PHEV') || ($_GET['Model'] == 'Pajero') 
												|| ($_GET['Model'] == 'Pajero Pinin') || ($_GET['Model'] == 'Sigma') || ($_GET['Model'] == 'Space Gear')
												|| ($_GET['Model'] == 'Space Runner') || ($_GET['Model'] == 'Space Star') || ($_GET['Model'] == 'Space Wagon')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Nissan'){
											if(!(($_GET['Model'] == '100 NX') || ($_GET['Model'] == '200 SX') || ($_GET['Model'] == '300 ZX') || ($_GET['Model'] == '350Z') 
												|| ($_GET['Model'] == '370Z') || ($_GET['Model'] == '370Z Nismo') || ($_GET['Model'] == '370Z Roadster') || ($_GET['Model'] == 'Almera') 
												|| ($_GET['Model'] == 'Almera Tino') || ($_GET['Model'] == 'Altima') || ($_GET['Model'] == 'E-NV200') || ($_GET['Model'] == 'E-NV200 Evalia')
												|| ($_GET['Model'] == 'Frontier') || ($_GET['Model'] == 'GT-R'	) || ($_GET['Model'] == '>GT-R Nismo') || ($_GET['Model'] == 'Juke')
												|| ($_GET['Model'] == 'King Cab') || ($_GET['Model'] == 'Leaf') || ($_GET['Model'] == 'Maxima') || ($_GET['Model'] == 'Micra')
												|| ($_GET['Model'] == 'Murano') || ($_GET['Model'] == 'NV200') || ($_GET['Model'] == 'Navara') || ($_GET['Model'] == 'Note')
												|| ($_GET['Model'] == 'Patrol') || ($_GET['Model'] == 'Pickup') || ($_GET['Model'] == 'Primera') || ($_GET['Model'] == 'Pulsar')
												|| ($_GET['Model'] == 'Qasqai') || ($_GET['Model'] == 'Quest') || ($_GET['Model'] == 'Rogue') || ($_GET['Model'] == 'Serena') 
												|| ($_GET['Model'] == 'Skyline') || ($_GET['Model'] == 'Titan') || ($_GET['Model'] == 'X-Trail') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Opel'){
											if(!(($_GET['Model'] == 'Adam') || ($_GET['Model'] == 'Agila') || ($_GET['Model'] == 'Antara') || ($_GET['Model'] == 'Astra')
												|| ($_GET['Model'] == 'Calibra') || ($_GET['Model'] == 'Campo') || ($_GET['Model'] == 'Cascada') || ($_GET['Model'] == 'Combo')
												|| ($_GET['Model'] == 'Corsa') || ($_GET['Model'] == 'Frontera') || ($_GET['Model'] == 'GT') || ($_GET['Model'] == 'Insignia')
												|| ($_GET['Model'] == 'Kadett') || ($_GET['Model'] == 'Meriva') || ($_GET['Model'] == 'Mokka') || ($_GET['Model'] == 'Monterey')
												|| ($_GET['Model'] == 'Movano') || ($_GET['Model'] == 'Omega') || ($_GET['Model'] == 'Signum') || ($_GET['Model'] == 'Sintra')
												|| ($_GET['Model'] == 'Tigra') || ($_GET['Model'] == 'Vectra') || ($_GET['Model'] == 'Vivaro')
												|| ($_GET['Model'] == 'Zafira') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Peugeot'){
											if(!(($_GET['Model'] == '108') || ($_GET['Model'] == '205') || ($_GET['Model'] == '206') || ($_GET['Model'] == '207')
												|| ($_GET['Model'] == '208') || ($_GET['Model'] == '301') || ($_GET['Model'] == '108') || ($_GET['Model'] == '308')
												|| ($_GET['Model'] == '405') || ($_GET['Model'] == '406') || ($_GET['Model'] == '407') || ($_GET['Model'] == '508') 
												|| ($_GET['Model'] == '607') || ($_GET['Model'] == '806') || ($_GET['Model'] == '807') || ($_GET['Model'] == '1007') 
												|| ($_GET['Model'] == '2008') || ($_GET['Model'] == '3008') || ($_GET['Model'] == '4007') || ($_GET['Model'] == '4008') 
												|| ($_GET['Model'] == '5008') || ($_GET['Model'] == 'Bipper') || ($_GET['Model'] == 'Boxer') || ($_GET['Model'] == 'E-208')
												|| ($_GET['Model'] == 'Expert') || ($_GET['Model'] == 'Partner') || ($_GET['Model'] == 'RCZ') || ($_GET['Model'] == 'Rifter')
												|| ($_GET['Model'] == 'Traveller') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Polonez'){
											if(!(($_GET['Model'] == 'Atu') || ($_GET['Model'] == 'Atu Plus') || ($_GET['Model'] == 'Caro')
												|| ($_GET['Model'] == 'Caro Plus') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Porsche'){
											if(!(($_GET['Model'] == '718') || ($_GET['Model'] == '911') || ($_GET['Model'] == '944')
												|| ($_GET['Model'] == 'Cayenne') || ($_GET['Model'] == 'Cayman') || ($_GET['Model'] == 'E-Performance')
												|| ($_GET['Model'] == 'Macan') || ($_GET['Model'] == 'Panamera') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Renault'){
											if(!(($_GET['Model'] == 'Avantime') || ($_GET['Model'] == 'Captur') || ($_GET['Model'] == 'Clio') || ($_GET['Model'] == 'Escape')
												|| ($_GET['Model'] == 'Fluence') || ($_GET['Model'] == 'Grand Escape') || ($_GET['Model'] == 'Grand Scenic') 
												|| ($_GET['Model'] == 'Scenic') || ($_GET['Model'] == 'Scenic Conquest') || ($_GET['Model'] == 'Scenic RX4')
												|| ($_GET['Model'] == 'Kadjar') || ($_GET['Model'] == 'Kangoo') || ($_GET['Model'] == 'Koleos') 
												|| ($_GET['Model'] == 'Laguna') || ($_GET['Model'] == 'Latitude') || ($_GET['Model'] == 'Master') 
												|| ($_GET['Model'] == 'Megane') || ($_GET['Model'] == 'Megane RS') || ($_GET['Model'] == 'Modus')
												|| ($_GET['Model'] == 'Talisman') || ($_GET['Model'] == 'Thalia') || ($_GET['Model'] == 'Trafic') || ($_GET['Model'] == 'Twingo')
												|| ($_GET['Model'] == 'Twizy') || ($_GET['Model'] == 'Vel Satis') || ($_GET['Model'] == 'Wind') || ($_GET['Model'] == 'ZOE')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Rolls Royce'){
											if(!(($_GET['Model'] == 'Ghost') || ($_GET['Model'] == 'Phantom') || ($_GET['Model'] == 'Wraith')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Rover'){
											if(!(($_GET['Model'] == '25') || ($_GET['Model'] == '45') || ($_GET['Model'] == '75') || ($_GET['Model'] == '200')
												|| ($_GET['Model'] == '214') || ($_GET['Model'] == '400') || ($_GET['Model'] == '414') || ($_GET['Model'] == '416')
												|| ($_GET['Model'] == '420') || ($_GET['Model'] == '600') || ($_GET['Model'] == '620') || ($_GET['Model'] == 'MG') 
												|| ($_GET['Model'] == 'Streetwise') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Saab'){
											if(!(($_GET['Model'] == '9-5') || ($_GET['Model'] == '900') || ($_GET['Model'] == '9000') || ($_GET['Model'] == '9-3') 
												|| ($_GET['Model'] == '9-7X') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Seat'){
											if(!(($_GET['Model'] == 'Alhambra') || ($_GET['Model'] == 'Altea') || ($_GET['Model'] == 'Altea XL') 
												|| ($_GET['Model'] == 'Arona') || ($_GET['Model'] == 'Arosa') || ($_GET['Model'] == 'Ateca') 
												|| ($_GET['Model'] == 'Cordoba') || ($_GET['Model'] == 'Exeo') || ($_GET['Model'] == 'Ibiza') || ($_GET['Model'] == 'Inca')
												|| ($_GET['Model'] == 'Leon') || ($_GET['Model'] == 'Leon Cupra') || ($_GET['Model'] == 'Leon Sportourer ST')
												|| ($_GET['Model'] == 'Mii') || ($_GET['Model'] == 'Tarraco') || ($_GET['Model'] == 'Toledo') 
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Skoda'){
											if(!(($_GET['Model'] == '105') || ($_GET['Model'] == '120') || ($_GET['Model'] == 'Citigo') || ($_GET['Model'] == 'Fabia')
												|| ($_GET['Model'] == 'Favorit') || ($_GET['Model'] == 'Felicia') || ($_GET['Model'] == 'Kamiq') || ($_GET['Model'] == 'Karoq') 
												|| ($_GET['Model'] == 'Kodiaq') || ($_GET['Model'] == 'Octavia') || ($_GET['Model'] == 'Rapid') || ($_GET['Model'] == 'Roomster')
												|| ($_GET['Model'] == 'Scala') || ($_GET['Model'] == 'Superb') || ($_GET['Model'] == 'Yeti')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Smart'){
											if(!(($_GET['Model'] == 'Fortwo') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'SsangYong'){
											if(!(($_GET['Model'] == 'Actyon') || ($_GET['Model'] == 'Korando') || ($_GET['Model'] == 'Kyron') || ($_GET['Model'] == 'Musso')
												|| ($_GET['Model'] == 'Rexton') || ($_GET['Model'] == 'Rodius') || ($_GET['Model'] == 'Tivoli') || ($_GET['Model'] == 'XLV')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}	
										
										if($_GET['Marka'] == 'Subaru'){
											if(!(($_GET['Model'] == 'B9 Tribeca') || ($_GET['Model'] == 'BRZ') || ($_GET['Model'] == 'Forester')
												|| ($_GET['Model'] == 'Impreza') || ($_GET['Model'] == 'Justy') || ($_GET['Model'] == 'Legacy') 
												|| ($_GET['Model'] == 'Levorg') || ($_GET['Model'] == 'Outback') || ($_GET['Model'] == 'Tribeca')
												|| ($_GET['Model'] == 'WRX') || ($_GET['Model'] == 'XV') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Suzuki'){
											if(!(($_GET['Model'] == 'Alto') || ($_GET['Model'] == 'Baleno') || ($_GET['Model'] == 'Celerio') || ($_GET['Model'] == 'Grand Vitara')
												|| ($_GET['Model'] == 'Ignis') || ($_GET['Model'] == 'Jimny') || ($_GET['Model'] == 'Liana') || ($_GET['Model'] == 'SJ')
												|| ($_GET['Model'] == 'SX4') || ($_GET['Model'] == 'SX4 S-Cross') || ($_GET['Model'] == 'Samurai')
												|| ($_GET['Model'] == 'Splash') || ($_GET['Model'] == 'Swift') || ($_GET['Model'] == 'Swift Sport')
												|| ($_GET['Model'] == 'Vitara') || ($_GET['Model'] == 'Wagon') || ($_GET['Model'] == 'X-90') || ($_GET['Model'] == 'XL7')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Tesla'){
											if(!(($_GET['Model'] == 'Model 3') || ($_GET['Model'] == 'Model S') || ($_GET['Model'] == 'Model X') 
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Toyota'){
											if(!(($_GET['Model'] == '4-Runner') || ($_GET['Model'] == 'Auris') || ($_GET['Model'] == 'Avalon') || ($_GET['Model'] == 'Avensis')
												|| ($_GET['Model'] == 'Avensis Verso') || ($_GET['Model'] == 'Aygo') || ($_GET['Model'] == 'C-HR') || ($_GET['Model'] == 'Camry')
												|| ($_GET['Model'] == 'Camry Solara') || ($_GET['Model'] == 'Carina') || ($_GET['Model'] == 'Celica')
												|| ($_GET['Model'] == 'Corolla') || ($_GET['Model'] == 'FJ') || ($_GET['Model'] == 'GR Supra') || ($_GET['Model'] == 'GT86') || ($_GET['Model'] == 'Highlander') 
												|| ($_GET['Model'] == 'Hilux') || ($_GET['Model'] == 'Land Cruiser') || ($_GET['Model'] == 'Highlander') || ($_GET['Model'] == 'MR2') 
												|| ($_GET['Model'] == 'Matrix') || ($_GET['Model'] == 'Mirai') || ($_GET['Model'] == 'Paseo') || ($_GET['Model'] == 'Picnic')
												|| ($_GET['Model'] == 'Previa') || ($_GET['Model'] == 'Prius') || ($_GET['Model'] == 'Proace') || ($_GET['Model'] == 'RAV4')
												|| ($_GET['Model'] == 'Sienna') || ($_GET['Model'] == 'Supra') || ($_GET['Model'] == 'Verso') || ($_GET['Model'] == 'Yaris Verso')
												|| ($_GET['Model'] == 'Yaris') || ($_GET['Model'] == 'iQ') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Volkswagen'){
											if(!(($_GET['Model'] == 'Arteon') || ($_GET['Model'] == 'Beetle') || ($_GET['Model'] == 'Bora')
												|| ($_GET['Model'] == 'Caddy') || ($_GET['Model'] == 'California') || ($_GET['Model'] == 'Caravelle')
												|| ($_GET['Model'] == 'Corrado') || ($_GET['Model'] == 'Crafter') || ($_GET['Model'] == 'E-Golf') || ($_GET['Model'] == 'Eos')
												|| ($_GET['Model'] == 'Fox') || ($_GET['Model'] == 'Garbus') || ($_GET['Model'] == 'Golf') || ($_GET['Model'] == 'Golf GTI')
												|| ($_GET['Model'] == 'Golf Plus') || ($_GET['Model'] == 'Golf Sportsvan') || ($_GET['Model'] == 'Jetta')
												|| ($_GET['Model'] == 'Lupo') || ($_GET['Model'] == 'Multivan') || ($_GET['Model'] == 'New Beetle') 
												|| ($_GET['Model'] == 'Passat') || ($_GET['Model'] == 'Passat CC') || ($_GET['Model'] == 'Passat W8')
												|| ($_GET['Model'] == 'Phaeton') || ($_GET['Model'] == 'Polo') || ($_GET['Model'] == 'Polo GTI') || ($_GET['Model'] == 'Routan')
												|| ($_GET['Model'] == 'Scirocco') || ($_GET['Model'] == 'Sharan') || ($_GET['Model'] == 'T-Cross') || ($_GET['Model'] == 'T-Roc')
												|| ($_GET['Model'] == 'Tiguan') || ($_GET['Model'] == 'Tiguan Allspace') || ($_GET['Model'] == 'Touareg') || ($_GET['Model'] == 'Touran') 
												|| ($_GET['Model'] == 'Transporter') || ($_GET['Model'] == 'Up!')
												|| ($_GET['Model'] == 'Vento') || ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']); 
											}
										}
										
										if($_GET['Marka'] == 'Volvo'){
											if(!(($_GET['Model'] == 'C30') || ($_GET['Model'] == 'C70') || ($_GET['Model'] == 'S40') || ($_GET['Model'] == 'S60')
												|| ($_GET['Model'] == 'S70') || ($_GET['Model'] == 'S80') || ($_GET['Model'] == 'S90') || ($_GET['Model'] == 'Seria 200') 
												|| ($_GET['Model'] == 'Seria 400') || ($_GET['Model'] == 'Seria 700') || ($_GET['Model'] == 'Seria 800') 
												|| ($_GET['Model'] == 'Seria 900') || ($_GET['Model'] == 'V40') || ($_GET['Model'] == 'V50') || ($_GET['Model'] == 'V60') 
												|| ($_GET['Model'] == 'V70') || ($_GET['Model'] == 'V90') || ($_GET['Model'] == 'XC40') || ($_GET['Model'] == 'XC50')
												|| ($_GET['Model'] == 'XC60') || ($_GET['Model'] == 'XC70') || ($_GET['Model'] == 'XC80') || ($_GET['Model'] == 'XC90')
												|| ($_GET['Model'] == 'Inne'))){
												unset($_GET['Model']);
											}
										}
									}
								}

								if(isset($_GET['Nadwozie'])){
									if(!(($_GET['Nadwozie'] == 'Coupe') || ($_GET['Nadwozie'] == 'Hatchback') || ($_GET['Nadwozie'] == 'Kabriolet') || ($_GET['Nadwozie'] == 'Kombi')
										|| ($_GET['Nadwozie'] == 'Minivan') || ($_GET['Nadwozie'] == 'Pickup') || ($_GET['Nadwozie'] == 'Sedan') || ($_GET['Nadwozie'] == 'Suv')
										|| ($_GET['Nadwozie'] == 'Terenowy') || ($_GET['Nadwozie'] == 'Van'))){
										unset($_GET['Nadwozie']);
									}
								}
								
								if(isset($_GET['Paliwo'])){
									if(!(($_GET['Paliwo'] == 'Benzyna') || ($_GET['Paliwo'] == 'Benzyna+LPG') || ($_GET['Paliwo'] == 'Diesel') || ($_GET['Paliwo'] == 'Elektryczny')
										|| ($_GET['Paliwo'] == 'Hybryda(Benzyna)') || ($_GET['Paliwo'] == 'Hybryda(Diesel)'))){
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
								if(isset($_GET['Model']) && $_GET['Model'] != '0'){
									$zapytanie = $zapytanie.' AND Model="'.$_GET['Model'].'"';
									$zapytanie1 = $zapytanie1.' AND Model="'.$_GET['Model'].'"';
								}
								if(isset($_GET['Nadwozie']) && $_GET['Nadwozie'] != '0'){
									$zapytanie = $zapytanie.' AND Nadwozie="'.$_GET['Nadwozie'].'"';
									$zapytanie1 = $zapytanie1.' AND Nadwozie="'.$_GET['Nadwozie'].'"';
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
									if($result = $connect->query('SELECT * FROM samochody_osobowe')){
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
													@$connect->query('DELETE FROM samochody_osobowe WHERE ID='.$w['ID'].'');
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
									
									if($result = $connect->query('SELECT * FROM samochody_osobowe')){
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
																echo '<a href="ogloszenia-samochody-osobowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../galeria/aktywne/'.$w['Photo'.$i].'\')"></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<a href="ogloszenia-samochody-osobowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../img/camera.png\')"></a>';
												}
												echo '
												<div class="lh-content">
														<span class="category" style="background-color: #f89d13;">Motoryzacja</span>
														<a href="ogloszenia-samochody-osobowe.php?id='.$w['ID'].'" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;"></span></a>
														<h3><a href="ogloszenia-samochody-osobowe.php?id='.$w['ID'].'" title="'.$w['Tytul'].'">'.$Tytul.'</a></h3>
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
																echo '<a href="ogloszenia-samochody-osobowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../galeria/aktywne/'.$w['Photo'.$i].'\')"></a>';
															}
														}
													}
												}
													
												if(!isset($glowne)){
													echo '<a href="ogloszenia-samochody-osobowe.php?id='.$w['ID'].'" class="img d-block" style="background-image: url(\'../img/camera.png\')"></a>';
												}
												echo '
												<div class="lh-content">
														<span class="category">Motoryzacja</span>
														<h3><a href="ogloszenia-samochody-osobowe.php?id='.$w['ID'].'" title="'.$w['Tytul'].'">'.$Tytul.'</a></h3>
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
								$pytanie = 'SELECT * FROM samochody_osobowe';
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
							
							if(isset($_GET['Model'])){
								$link = $link.'&Model='.$_GET['Model'];
							}
							
							if(isset($_GET['Nadwozie'])){
								$link = $link.'&Model='.$_GET['Model'];
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
										echo '<a href="samochodyosobowe.php?page='.$previouspage.$link.'&submitsearch=Szukaj">'.$seepreviouspage.'</a>';
									}else{
										echo '<a href="#">_</a>';
									}
								  
									echo '<span>'.$showpage.'</span>';
									
									if($lStron == $showpage){
										echo '<a href="#">_</a>';
									}else{
										echo '<a href="samochodyosobowe.php?page='.$nextpage.$link.'&submitsearch=Szukaj">'.$seepage.'</a>';
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
  <script type="text/javascript">
		var mS = document.getElementById('Marka');
		var mS2 = document.getElementById('Model');
		mS.onchange=function() {
			if(mS.value==='0' || mS.value==='Zabytkowe' || mS.value==='Inna marka'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>';
			}
			if(mS.value==='Abarth'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="124 Spider">124 Spider</option>' +
										'<option class="filters-input-option" value="500">500</option>' +
										'<option class="filters-input-option" value="Grande Punto">Grande Punto</option>' +
										'<option class="filters-input-option" value="Punto">Punto</option>' +
										'<option class="filters-input-option" value="Punto Evo">Punto Evo</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
			}
			
			if(mS.value==='Acura'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="CDX">CDX</option>' +
										'<option class="filters-input-option" value="ILX">ILX</option>' +
										'<option class="filters-input-option" value="MDX">MDX</option>' +
										'<option class="filters-input-option" value="RDX">RDX</option>' +
										'<option class="filters-input-option" value="RLX">RLX</option>' +
										'<option class="filters-input-option" value="TLX">TLX</option>' +
										'<option class="filters-input-option" value="TSX">TSX</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
			}
			
			if(mS.value==='Alfa Romeo'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="145">145</option>' +
										'<option class="filters-input-option" value="146">146</option>' +
										'<option class="filters-input-option" value="147">147</option>' +
										'<option class="filters-input-option" value="155">155</option>' +
										'<option class="filters-input-option" value="156">156</option>' +
										'<option class="filters-input-option" value="159">159</option>' +
										'<option class="filters-input-option" value="164">164</option>' +
										'<option class="filters-input-option" value="159">166</option>' +
										'<option class="filters-input-option" value="4C">4C</option>' +
										'<option class="filters-input-option" value="Brera">Brera</option>' +
										'<option class="filters-input-option" value="GT">GT</option>' +
										'<option class="filters-input-option" value="GTV">GTV</option>' +
										'<option class="filters-input-option" value="Giulia">Giulia</option>' +
										'<option class="filters-input-option" value="Giulietta">Giulietta</option>' +
										'<option class="filters-input-option" value="Mito">Mito</option>' +
										'<option class="filters-input-option" value="Spider">Spider</option>' +
										'<option class="filters-input-option" value="Stelvio">Stelvio</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';		
										
			}
			
			if(mS.value==='Aston Martin'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="DB11">DB11</option>' +
										'<option class="filters-input-option" value="DB7">DB7</option>' +
										'<option class="filters-input-option" value="DB9">DB9</option>' +
										'<option class="filters-input-option" value="DBS Superleggera">DBS Superleggera</option>' +
										'<option class="filters-input-option" value="One-77">One-77</option>' +
										'<option class="filters-input-option" value="Rapide">Rapide</option>' +
										'<option class="filters-input-option" value="Vantage">Vantage</option>' +
										'<option class="filters-input-option" value="Vanquish">Vanquish</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Audi'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="80">80</option>' +
										'<option class="filters-input-option" value="90">90</option>' +
										'<option class="filters-input-option" value="100">100</option>' +
										'<option class="filters-input-option" value="200">200</option>' +
										'<option class="filters-input-option" value="A1">A1</option>' +
										'<option class="filters-input-option" value="A2">A2</option>' +
										'<option class="filters-input-option" value="A3">A3</option>' +
										'<option class="filters-input-option" value="A4">A4</option>' +
										'<option class="filters-input-option" value="A5">A5</option>' +
										'<option class="filters-input-option" value="A6">A6</option>' +
										'<option class="filters-input-option" value="A7">A7</option>' +
										'<option class="filters-input-option" value="A8">A8</option>' +
										'<option class="filters-input-option" value="S1">S1</option>' +
										'<option class="filters-input-option" value="S2">S2</option>' +
										'<option class="filters-input-option" value="S3">S3</option>' +
										'<option class="filters-input-option" value="S4">S4</option>' +
										'<option class="filters-input-option" value="S5">S5</option>' +
										'<option class="filters-input-option" value="S6">S6</option>' +
										'<option class="filters-input-option" value="S7">S7</option>' +
										'<option class="filters-input-option" value="S8">S8</option>' +
										'<option class="filters-input-option" value="RS1">RS1</option>' +
										'<option class="filters-input-option" value="RS2">RS2</option>' +
										'<option class="filters-input-option" value="RS3">RS3</option>' +
										'<option class="filters-input-option" value="RS4">RS4</option>' +
										'<option class="filters-input-option" value="RS5">RS5</option>' +
										'<option class="filters-input-option" value="RS6">RS6</option>' +
										'<option class="filters-input-option" value="RS7">RS7</option>' +
										'<option class="filters-input-option" value="RS8">RS8</option>' +
										'<option class="filters-input-option" value="Q1">Q1</option>' +
										'<option class="filters-input-option" value="Q2">Q2</option>' +
										'<option class="filters-input-option" value="Q3">Q3</option>' +
										'<option class="filters-input-option" value="Q4">Q4</option>' +
										'<option class="filters-input-option" value="Q5">Q5</option>' +
										'<option class="filters-input-option" value="Q6">Q6</option>' +
										'<option class="filters-input-option" value="Q7">Q7</option>' +
										'<option class="filters-input-option" value="Q8">Q8</option>' +
										'<option class="filters-input-option" value="E-Tron">E-Tron</option>' +
										'<option class="filters-input-option" value="TT">TT</option>' +
										'<option class="filters-input-option" value="R8">R8</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Bentley'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Bentayga">Bentayga</option>' +
										'<option class="filters-input-option" value="Continental">Continental</option>' +
										'<option class="filters-input-option" value="Flying Spur">Flying Spur</option>' +
										'<option class="filters-input-option" value="Mulsanne">Mulsanne</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='BMW'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="M1">M1</option>' +
										'<option class="filters-input-option" value="M2">M2</option>' +
										'<option class="filters-input-option" value="M3">M3</option>' +
										'<option class="filters-input-option" value="M4">M4</option>' +
										'<option class="filters-input-option" value="M5">M5</option>' +
										'<option class="filters-input-option" value="M6">M6</option>' +
										'<option class="filters-input-option" value="M7">M7</option>' +
										'<option class="filters-input-option" value="M8">M8</option>' +
										'<option class="filters-input-option" value="Seria 1">Seria 1</option>' +
										'<option class="filters-input-option" value="Seria 2">Seria 2</option>' +
										'<option class="filters-input-option" value="Seria 3">Seria 3</option>' +
										'<option class="filters-input-option" value="Seria 4">Seria 4</option>' +
										'<option class="filters-input-option" value="Seria 5">Seria 5</option>' +
										'<option class="filters-input-option" value="Seria 6">Seria 6</option>' +
										'<option class="filters-input-option" value="Seria 7">Seria 7</option>' +
										'<option class="filters-input-option" value="Seria 8">Seria 8</option>' +
										'<option class="filters-input-option" value="i3">i3</option>' +
										'<option class="filters-input-option" value="i8">i8</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}	

			if(mS.value==='Bugatti'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Veyron">Veyron</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}	

			if(mS.value==='Cadilac'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="ATS">ATS</option>' +
										'<option class="filters-input-option" value="CT6">CT6</option>' +
										'<option class="filters-input-option" value="CTS">CTS</option>' +
										'<option class="filters-input-option" value="ELR">ELR</option>' +
										'<option class="filters-input-option" value="Escalade">Escalade</option>' +
										'<option class="filters-input-option" value="SLS">SLS</option>' +
										'<option class="filters-input-option" value="SRX">SRX</option>' +
										'<option class="filters-input-option" value="XT5">XT5</option>' +
										'<option class="filters-input-option" value="XTS">XTS</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	

			if(mS.value==='Chevrolet'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Aveo">Aveo</option>' +
										'<option class="filters-input-option" value="Camaro">Camaro</option>' +
										'<option class="filters-input-option" value="Captiva">Captiva</option>' +
										'<option class="filters-input-option" value="Cruze">Cruze</option>' +
										'<option class="filters-input-option" value="Epica">Epica</option>' +
										'<option class="filters-input-option" value="Evanda">Evanda</option>' +
										'<option class="filters-input-option" value="Lacetti">Lacetti</option>' +
										'<option class="filters-input-option" value="Malibu">Malibu</option>' +
										'<option class="filters-input-option" value="Orlando">Orlando</option>' +
										'<option class="filters-input-option" value="Spark">Spark</option>' +
										'<option class="filters-input-option" value="Tacuma">Tacuma</option>' +
										'<option class="filters-input-option" value="Trax">Trax</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	

			if(mS.value==='Chrysler'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="300C">300C</option>' +
										'<option class="filters-input-option" value="300M">300M</option>' +
										'<option class="filters-input-option" value="Caravan">Caravan</option>' +
										'<option class="filters-input-option" value="Intrepid">Intrepid</option>' +
										'<option class="filters-input-option" value="Neon">Neon</option>' +
										'<option class="filters-input-option" value="PT Cruiser">PT Cruiser</option>' +
										'<option class="filters-input-option" value="Sebring">Sebring</option>' +
										'<option class="filters-input-option" value="Stratus">Stratus</option>' +
										'<option class="filters-input-option" value="Town Country">Town Country</option>' +
										'<option class="filters-input-option" value="Vision">Vision</option>' +
										'<option class="filters-input-option" value="Voyager">Voyager</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}

			if(mS.value==='Citroen'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Berlingo">Berlingo</option>' +
										'<option class="filters-input-option" value="C-Elysee">C-Elysee</option>' +
										'<option class="filters-input-option" value="C1">C1</option>' +
										'<option class="filters-input-option" value="C2">C2</option>' +
										'<option class="filters-input-option" value="C3">C3</option>' +
										'<option class="filters-input-option" value="C4">C4</option>' +
										'<option class="filters-input-option" value="C4 Aircross">C4 Aircross</option>' +
										'<option class="filters-input-option" value="C4 Cactus">C4 Cactus</option>' +
										'<option class="filters-input-option" value="C4 Picasso">C4 Picasso</option>' +
										'<option class="filters-input-option" value="C5">C5</option>' +
										'<option class="filters-input-option" value="C5 Aircross">C5 Aircross</option>' +
										'<option class="filters-input-option" value="C6">C6</option>' +
										'<option class="filters-input-option" value="C8">C8</option>' +
										'<option class="filters-input-option" value="DS3">DS3</option>' +
										'<option class="filters-input-option" value="DS4">DS4</option>' +
										'<option class="filters-input-option" value="DS5">DS5</option>' +
										'<option class="filters-input-option" value="Evasion">Evasion</option>' +
										'<option class="filters-input-option" value="Nemo">Nemo</option>' +
										'<option class="filters-input-option" value="Saxo">Saxo</option>' +
										'<option class="filters-input-option" value="XM">XM</option>' +
										'<option class="filters-input-option" value="Xantia">Xantia</option>' +
										'<option class="filters-input-option" value="Xsara">Xsara</option>' +
										'<option class="filters-input-option" value="Xsara Picasso">Xsara Picasso</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Dacia'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Dokker">Dokker</option>' +
										'<option class="filters-input-option" value="Duster">Duster</option>' +
										'<option class="filters-input-option" value="Lodgy">Lodgy</option>' +
										'<option class="filters-input-option" value="Logan">Logan</option>' +
										'<option class="filters-input-option" value="Nova">Nova</option>' +
										'<option class="filters-input-option" value="Sandero">Sandero</option>' +
										'<option class="filters-input-option" value="Sandero Stepway">Sandero Stepway</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
													
			}
			
			if(mS.value==='Daewoo'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Espero">Espero</option>' +
										'<option class="filters-input-option" value="Kalos">Kalos</option>' +
										'<option class="filters-input-option" value="Lanos">Lanos</option>' +
										'<option class="filters-input-option" value="Leganza">Leganza</option>' +
										'<option class="filters-input-option" value="Matiz">Matiz</option>' +
										'<option class="filters-input-option" value="Nubira">Nubira</option>' +
										'<option class="filters-input-option" value="Rezzo">Rezzo</option>' +
										'<option class="filters-input-option" value="Tacuma">Tacuma</option>' +
										'<option class="filters-input-option" value="Tico">Tico</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
												
			}
			
			if(mS.value==='Daihatsu'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Coure">Coure</option>' +
										'<option class="filters-input-option" value="Esse">Esse</option>' +
										'<option class="filters-input-option" value="Feroza">Feroza</option>' +
										'<option class="filters-input-option" value="Sirion">Sirion</option>' +
										'<option class="filters-input-option" value="Terios">Terios</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
													
			}
			
			if(mS.value==='Dodge'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Avenger">Avenger</option>' +
										'<option class="filters-input-option" value="Caliber">Caliber</option>' +
										'<option class="filters-input-option" value="Caravan">Caravan</option>' +
										'<option class="filters-input-option" value="Challenger">Challenger</option>' +
										'<option class="filters-input-option" value="Charger">Charger</option>' +
										'<option class="filters-input-option" value="Durango">Durango</option>' +
										'<option class="filters-input-option" value="Grand Caravan">Grand Caravan</option>' +
										'<option class="filters-input-option" value="Magnum">Magnum</option>' +
										'<option class="filters-input-option" value="Nitro">Nitro</option>' +
										'<option class="filters-input-option" value="Ram">Ram</option>' +
										'<option class="filters-input-option" value="Stratus">Stratus</option>' +
										'<option class="filters-input-option" value="Viper">Viper</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Ferrari'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="458">458</option>' +
										'<option class="filters-input-option" value="488">488</option>' +
										'<option class="filters-input-option" value="California">California</option>' +
										'<option class="filters-input-option" value="F12">F12</option>' +
										'<option class="filters-input-option" value="F40">F40</option>' +
										'<option class="filters-input-option" value="F8">F8</option>' +
										'<option class="filters-input-option" value="Portofino">Portofino</option>' +
										'<option class="filters-input-option" value="Testarossa">Testarossa</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Fiat'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="125p">125p</option>' +
										'<option class="filters-input-option" value="126p">126p</option>' +
										'<option class="filters-input-option" value="500">500</option>' +
										'<option class="filters-input-option" value="Albea">Albea</option>' +
										'<option class="filters-input-option" value="Barchetta">Barchetta</option>' +
										'<option class="filters-input-option" value="Brava">Brava</option>' +
										'<option class="filters-input-option" value="Bravo">Bravo</option>' +
										'<option class="filters-input-option" value="Cinquecento">Cinquecento</option>' +
										'<option class="filters-input-option" value="Coupe">Coupe</option>' +
										'<option class="filters-input-option" value="Doblo">Doblo</option>' +
										'<option class="filters-input-option" value="Ducato">Ducato</option>' +
										'<option class="filters-input-option" value="Idea">Idea</option>' +
										'<option class="filters-input-option" value="Linea">Linea</option>' +
										'<option class="filters-input-option" value="Marea">Marea</option>' +
										'<option class="filters-input-option" value="Multipla">Multipla</option>' +
										'<option class="filters-input-option" value="Palio">Palio</option>' +
										'<option class="filters-input-option" value="Panda">Panda</option>' +
										'<option class="filters-input-option" value="Punto">Punto</option>' +
										'<option class="filters-input-option" value="Qubo">Qubo</option>' +
										'<option class="filters-input-option" value="Scudo">Scudo</option>' +
										'<option class="filters-input-option" value="Seicento">Seicento</option>' +
										'<option class="filters-input-option" value="Siena">Siena</option>' +
										'<option class="filters-input-option" value="Stilo">Stilo</option>' +
										'<option class="filters-input-option" value="Tipo">Tipo</option>' +
										'<option class="filters-input-option" value="Ulysse">Ulysse</option>' +
										'<option class="filters-input-option" value="Uno">Uno</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Ford'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Active">Active</option>' +
										'<option class="filters-input-option" value="Cougar">Cougar</option>' +
										'<option class="filters-input-option" value="EcoSport">EcoSport</option>' +
										'<option class="filters-input-option" value="Edge">Edge</option>' +
										'<option class="filters-input-option" value="Escort">Escort</option>' +
										'<option class="filters-input-option" value="Explorer">Explorer</option>' +
										'<option class="filters-input-option" value="Fiesta">Fiesta</option>' +
										'<option class="filters-input-option" value="Focus">Focus</option>' +
										'<option class="filters-input-option" value="Fusion">Fusion</option>' +
										'<option class="filters-input-option" value="GT">GT</option>' +
										'<option class="filters-input-option" value="Galaxy">Galaxy</option>' +
										'<option class="filters-input-option" value="Granada">Granada</option>' +
										'<option class="filters-input-option" value="Ka">Ka</option>' +
										'<option class="filters-input-option" value="Kuga">Kuga</option>' +
										'<option class="filters-input-option" value="Maverick">Maverick</option>' +
										'<option class="filters-input-option" value="Mondeo">Mondeo</option>' +
										'<option class="filters-input-option" value="Mustang">Mustang</option>' +
										'<option class="filters-input-option" value="Orion">Orion</option>' +
										'<option class="filters-input-option" value="Puma">Puma</option>' +
										'<option class="filters-input-option" value="Ranger">Ranger</option>' +
										'<option class="filters-input-option" value="Raptor">Raptor</option>' +
										'<option class="filters-input-option" value="S-Max">S-Max</option>' +
										'<option class="filters-input-option" value="Scorpio">Scorpio</option>' +
										'<option class="filters-input-option" value="Sierra">Sierra</option>' +
										'<option class="filters-input-option" value="Streetka">Streetka</option>' +
										'<option class="filters-input-option" value="Tourneo">Tourneo</option>' +
										'<option class="filters-input-option" value="Transit">Transit</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
															
			}	
			
			if(mS.value==='Honda'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Accord">Accord</option>' +
										'<option class="filters-input-option" value="CR-V">CR-V</option>' +
										'<option class="filters-input-option" value="CR-Z">CR-Z</option>' +
										'<option class="filters-input-option" value="CRX">CRX</option>' +
										'<option class="filters-input-option" value="CR-Z">CR-Z</option>' +
										'<option class="filters-input-option" value="City">City</option>' +
										'<option class="filters-input-option" value="Civic">Civic</option>' +
										'<option class="filters-input-option" value="HR-V">HR-V</option>' +
										'<option class="filters-input-option" value="Jazz">Jazz</option>' +
										'<option class="filters-input-option" value="Legend">Legend</option>' +
										'<option class="filters-input-option" value="Logo">Logo</option>' +
										'<option class="filters-input-option" value="NSX">NSX</option>' +
										'<option class="filters-input-option" value="S 2000">S 2000</option>' +
										'<option class="filters-input-option" value="TypeR">TypeR</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}	
			
			if(mS.value==='Hyundai'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Accent">Accent</option>' +
										'<option class="filters-input-option" value="Atos">Atos</option>' +
										'<option class="filters-input-option" value="Coupe">Coupe</option>' +
										'<option class="filters-input-option" value="Elantra">Elantra</option>' +
										'<option class="filters-input-option" value="Galloper">Galloper</option>' +
										'<option class="filters-input-option" value="Getz">Getz</option>' +
										'<option class="filters-input-option" value="H1">H1</option>' +
										'<option class="filters-input-option" value="H200">H200</option>' +
										'<option class="filters-input-option" value="Kona">Kona</option>' +
										'<option class="filters-input-option" value="Lantra">Lantra</option>' +
										'<option class="filters-input-option" value="Matrix">Matrix</option>' +
										'<option class="filters-input-option" value="Santa Fe">Santa Fe</option>' +
										'<option class="filters-input-option" value="Sonata">Sonata</option>' +
										'<option class="filters-input-option" value="Terracan">Terracan</option>' +
										'<option class="filters-input-option" value="Trajet">Trajet</option>' +
										'<option class="filters-input-option" value="Tucson">Tucson</option>' +
										'<option class="filters-input-option" value="Veloster">Veloster</option>' +
										'<option class="filters-input-option" value="XG">XG</option>' +
										'<option class="filters-input-option" value="i10">i10</option>' +
										'<option class="filters-input-option" value="i20">i20</option>' +
										'<option class="filters-input-option" value="i30">i30</option>' +
										'<option class="filters-input-option" value="i40">i40</option>' +
										'<option class="filters-input-option" value="ix20">ix20</option>' +
										'<option class="filters-input-option" value="ix35">ix35</option>' +
										'<option class="filters-input-option" value="ix55">ix55</option>' +								
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Infiniti'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="EX">EX</option>' +							
										'<option class="filters-input-option" value="FX">FX</option>' +	
										'<option class="filters-input-option" value="G">G</option>' +	
										'<option class="filters-input-option" value="Q30">Q30</option>' +							
										'<option class="filters-input-option" value="Q40">Q40</option>' +							
										'<option class="filters-input-option" value="Q50">Q50</option>' +							
										'<option class="filters-input-option" value="Q60">Q60</option>' +							
										'<option class="filters-input-option" value="Q70">Q70</option>' +							
										'<option class="filters-input-option" value="QX30">QX30</option>' +							
										'<option class="filters-input-option" value="QX50">QX50</option>' +				
										'<option class="filters-input-option" value="QX60">QX60</option>' +				
										'<option class="filters-input-option" value="QX70">QX70</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Jaguar'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="E-Pace">E-Pace</option>' +							
										'<option class="filters-input-option" value="F-Pace">F-Pace</option>' +							
										'<option class="filters-input-option" value="F-Type">F-Type</option>' +							
										'<option class="filters-input-option" value="I-Pace">I-Pace</option>' +							
										'<option class="filters-input-option" value="S-Type">S-Type</option>' +							
										'<option class="filters-input-option" value="XE">XE</option>' +							
										'<option class="filters-input-option" value="XF">XF</option>' +							
										'<option class="filters-input-option" value="XJ">XJ</option>' +							
										'<option class="filters-input-option" value="XJR">XJR</option>' +							
										'<option class="filters-input-option" value="XKR">XKR</option>' +							
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Jeep'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Commander">Commander</option>' +				
										'<option class="filters-input-option" value="Compass">Compass</option>' +				
										'<option class="filters-input-option" value="Grand Cherokee">Grand Cherokee</option>' +				
										'<option class="filters-input-option" value="Liberty">Liberty</option>' +
										'<option class="filters-input-option" value="Patriot">Patriot</option>' +
										'<option class="filters-input-option" value="Renegade">Renegade</option>' +
										'<option class="filters-input-option" value="Wrangler">Wrangler</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Kia'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Carens">Carens</option>' +
										'<option class="filters-input-option" value="Carnival">Carnival</option>' +
										'<option class="filters-input-option" value="Ceed">Ceed</option>' +
										'<option class="filters-input-option" value="Ceed GT">Ceed GT</option>' +
										'<option class="filters-input-option" value="Cerato">Cerato</option>' +
										'<option class="filters-input-option" value="Magentis">Magentis</option>' +
										'<option class="filters-input-option" value="Niro">Niro</option>' +
										'<option class="filters-input-option" value="Optima">Optima</option>' +
										'<option class="filters-input-option" value="Picanto">Picanto</option>' +
										'<option class="filters-input-option" value="Retona">Retona</option>' +
										'<option class="filters-input-option" value="Sephia">Sephia</option>' +
										'<option class="filters-input-option" value="Sorento">Sorento</option>' +
										'<option class="filters-input-option" value="Soul">Soul</option>' +
										'<option class="filters-input-option" value="Sportage">Sportage</option>' +
										'<option class="filters-input-option" value="Stinger">Stinger</option>' +
										'<option class="filters-input-option" value="Stonic">Stonic</option>' +
										'<option class="filters-input-option" value="Venga">Venga</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Lamborghini'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Aventador">Aventador</option>' +
										'<option class="filters-input-option" value="Gallardo">Gallardo</option>' +
										'<option class="filters-input-option" value="Huracan">Huracan</option>' +
										'<option class="filters-input-option" value="Murcielago">Murcielago</option>' +
										'<option class="filters-input-option" value="Reventon">Reventon</option>' +
										'<option class="filters-input-option" value="Urus">Urus</option>' +
										'<option class="filters-input-option" value="Veneno">Veneno</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}	
			
			if(mS.value==='Lancia'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Delta">Delta</option>' +
										'<option class="filters-input-option" value="Kappa">Kappa</option>' +
										'<option class="filters-input-option" value="Lybra">Lybra</option>' +
										'<option class="filters-input-option" value="Musa">Musa</option>' +
										'<option class="filters-input-option" value="Phedra">Phedra</option>' +
										'<option class="filters-input-option" value="Still">Still</option>' +
										'<option class="filters-input-option" value="Thema">Thema</option>' +
										'<option class="filters-input-option" value="Thesis">Thesis</option>' +
										'<option class="filters-input-option" value="Voyager">Voyager</option>' +
										'<option class="filters-input-option" value="Ypsilon">Ypsilon</option>' +
										'<option class="filters-input-option" value="Zeta">Zeta</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}	
			
			if(mS.value==='Land Rover'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Discovery">Discovery</option>' +
										'<option class="filters-input-option" value="Discovery Sport">Discovery Sport</option>' +
										'<option class="filters-input-option" value="Freelander">Freelander</option>' +
										'<option class="filters-input-option" value="Range Rover">Range Rover</option>' +
										'<option class="filters-input-option" value="Range Rover Evoque">Range Rover Evoque</option>' +
										'<option class="filters-input-option" value="Range Rover Sport">Range Rover Sport</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
											
			}
			
			if(mS.value==='Lexus'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="CT">CT</option>' +
										'<option class="filters-input-option" value="ES300">ES300</option>' +
										'<option class="filters-input-option" value="GS300">GS300</option>' +
										'<option class="filters-input-option" value="GS450">GS450</option>' +
										'<option class="filters-input-option" value="IS200">IS200</option>' +
										'<option class="filters-input-option" value="IS220">IS220</option>' +
										'<option class="filters-input-option" value="IS250">IS250</option>' +
										'<option class="filters-input-option" value="LC">LC</option>' +
										'<option class="filters-input-option" value="LS">LS</option>' +
										'<option class="filters-input-option" value="NX">NX</option>' +
										'<option class="filters-input-option" value="RC">RC</option>' +
										'<option class="filters-input-option" value="RX300">RX300</option>' +
										'<option class="filters-input-option" value="RX350">RX350</option>' +
										'<option class="filters-input-option" value="RX400">RX400</option>' +
										'<option class="filters-input-option" value="SC">SC</option>' +
										'<option class="filters-input-option" value="UX">UX</option>' +							
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='Lincoln'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Aviator">Aviator</option>' +				
										'<option class="filters-input-option" value="MKC">MKC</option>' +				
										'<option class="filters-input-option" value="MKS">MKS</option>' +				
										'<option class="filters-input-option" value="MKT">MKT</option>' +				
										'<option class="filters-input-option" value="MKX">MKX</option>' +				
										'<option class="filters-input-option" value="MKZ">MKZ</option>' +				
										'<option class="filters-input-option" value="Nautilus">Nautilus</option>' +				
										'<option class="filters-input-option" value="Navigator">Navigator</option>' +				
										'<option class="filters-input-option" value="Town Car">Town Car</option>' +				
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Lotus'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Elise">Elise</option>' +	
										'<option class="filters-input-option" value="Evora">Evora</option>' +	
										'<option class="filters-input-option" value="Exige">Exige</option>' +	
										'<option class="filters-input-option" value="Exige S">Exige S</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='Maserati'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Ghibli">Ghibli</option>' +	
										'<option class="filters-input-option" value="GranCabrio">GranCabrio</option>' +	
										'<option class="filters-input-option" value="GranTurismo">GranTurismo</option>' +	
										'<option class="filters-input-option" value="Levante">Levante</option>' +	
										'<option class="filters-input-option" value="Quattroporte">Quattroporte</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Mazda'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="2">2</option>' +	
										'<option class="filters-input-option" value="3">3</option>' +	
										'<option class="filters-input-option" value="323F">323F</option>' +	
										'<option class="filters-input-option" value="4">4</option>' +	
										'<option class="filters-input-option" value="5">5</option>' +	
										'<option class="filters-input-option" value="6">6</option>' +	
										'<option class="filters-input-option" value="121">121</option>' +	
										'<option class="filters-input-option" value="323">323</option>' +	
										'<option class="filters-input-option" value="626">626</option>' +	
										'<option class="filters-input-option" value="929">929</option>' +	
										'<option class="filters-input-option" value="BT-50">BT-50</option>' +	
										'<option class="filters-input-option" value="CX-3">CX-3</option>' +	
										'<option class="filters-input-option" value="CX-5">CX-5</option>' +	
										'<option class="filters-input-option" value="CX-7">CX-7</option>' +	
										'<option class="filters-input-option" value="CX-9">CX-9</option>' +	
										'<option class="filters-input-option" value="Demio">Demio</option>' +	
										'<option class="filters-input-option" value="MPV">MPV</option>' +	
										'<option class="filters-input-option" value="MX-2">MX-2</option>' +	
										'<option class="filters-input-option" value="MX-5">MX-5</option>' +	
										'<option class="filters-input-option" value="MX-6">MX-6</option>' +	
										'<option class="filters-input-option" value="Millenia">Millenia</option>' +	
										'<option class="filters-input-option" value="Premacy">Premacy</option>' +	
										'<option class="filters-input-option" value="Protege">Protege</option>' +	
										'<option class="filters-input-option" value="RX-6">RX-6</option>' +	
										'<option class="filters-input-option" value="RX-7">RX-7</option>' +	
										'<option class="filters-input-option" value="RX-8">RX-8</option>' +	
										'<option class="filters-input-option" value="Tribute">Tribute</option>' +	
										'<option class="filters-input-option" value="Xedos">Xedos</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='McLaren'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="540C">540C</option>' +	
										'<option class="filters-input-option" value="570GT">570GT</option>' +	
										'<option class="filters-input-option" value="570S">570S</option>' +	
										'<option class="filters-input-option" value="570S Spider">570S Spider</option>' +	
										'<option class="filters-input-option" value="600LT">600LT</option>' +	
										'<option class="filters-input-option" value="600LT Spider">600LT Spider</option>' +	
										'<option class="filters-input-option" value="720S">720S</option>' +	
										'<option class="filters-input-option" value="720S Spider">720S Spider</option>' +	
										'<option class="filters-input-option" value="F1">F1</option>' +	
										'<option class="filters-input-option" value="GT">GT</option>' +	
										'<option class="filters-input-option" value="P1">P1</option>' +	
										'<option class="filters-input-option" value="Senna">Senna</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Mercedes'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="AMG">AMG</option>' +	
										'<option class="filters-input-option" value="CLA">CLA</option>' +	
										'<option class="filters-input-option" value="Citan">Citan</option>' +	
										'<option class="filters-input-option" value="EQC">EQC</option>' +	
										'<option class="filters-input-option" value="GL">GL</option>' +	
										'<option class="filters-input-option" value="GLA">GLA</option>' +	
										'<option class="filters-input-option" value="GLB">GLB</option>' +	
										'<option class="filters-input-option" value="GLC">GLC</option>' +	
										'<option class="filters-input-option" value="GLE">GLE</option>' +	
										'<option class="filters-input-option" value="GLS">GLS</option>' +	
										'<option class="filters-input-option" value="Klasa A">Klasa A</option>' +	
										'<option class="filters-input-option" value="Klasa B">Klasa B</option>' +	
										'<option class="filters-input-option" value="Klasa C">Klasa C</option>' +	
										'<option class="filters-input-option" value="Klasa E">Klasa E</option>' +	
										'<option class="filters-input-option" value="Klasa G">Klasa G</option>' +	
										'<option class="filters-input-option" value="Klasa S">Klasa S</option>' +	
										'<option class="filters-input-option" value="Klasa V">Klasa V</option>' +	
										'<option class="filters-input-option" value="Klasa X">Klasa X</option>' +	
										'<option class="filters-input-option" value="ML">ML</option>' +	
										'<option class="filters-input-option" value="SL">SL</option>' +	
										'<option class="filters-input-option" value="SLC">SLC</option>' +	
										'<option class="filters-input-option" value="SLK">SLK</option>' +	
										'<option class="filters-input-option" value="Vaneo">Vaneo</option>' +	
										'<option class="filters-input-option" value="Viano">Viano</option>' +	
										'<option class="filters-input-option" value="Vito">Vito</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='MicroCar'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Aixam">Aixam</option>' +	
										'<option class="filters-input-option" value="Chatenet">Chatenet</option>' +	
										'<option class="filters-input-option" value="Grecav">Grecav</option>' +	
										'<option class="filters-input-option" value="Ligier">Ligier</option>' +	
										'<option class="filters-input-option" value="M.Go">M.Go</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Mini'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Cabrio">Cabrio</option>' +	
										'<option class="filters-input-option" value="Clubman">Clubman</option>' +	
										'<option class="filters-input-option" value="Cooper">Cooper</option>' +	
										'<option class="filters-input-option" value="Cooper S">Cooper S</option>' +	
										'<option class="filters-input-option" value="Countryman">Countryman</option>' +	
										'<option class="filters-input-option" value="One">One</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Mitsubishi'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="ASX">ASX</option>' +	
										'<option class="filters-input-option" value="Carisma">Carisma</option>' +	
										'<option class="filters-input-option" value="Colt">Colt</option>' +	
										'<option class="filters-input-option" value="Eclipse">Eclipse</option>' +	
										'<option class="filters-input-option" value="Eclipse Cross">Eclipse Cross</option>' +	
										'<option class="filters-input-option" value="Endeavor">Endeavor</option>' +	
										'<option class="filters-input-option" value="Galant">Galant</option>' +	
										'<option class="filters-input-option" value="Grandis">Grandis</option>' +	
										'<option class="filters-input-option" value="L200">L200</option>' +	
										'<option class="filters-input-option" value="L400">L400</option>' +	
										'<option class="filters-input-option" value="Lancer Evolution VI">Lancer Evolution VI</option>' +	
										'<option class="filters-input-option" value="Lancer Evolution VII">Lancer Evolution VII</option>' +	
										'<option class="filters-input-option" value="Lancer Evolution VIII">Lancer Evolution VIII</option>' +	
										'<option class="filters-input-option" value="Lancer Evolution IX"> Lancer Evolution IX</option>' +	
										'<option class="filters-input-option" value="Lancer Evolution X"> Lancer Evolution X</option>' +	
										'<option class="filters-input-option" value="Montero">Montero</option>' +	
										'<option class="filters-input-option" value="Outlander">Outlander</option>' +	
										'<option class="filters-input-option" value="Outlander PHEV">Outlander PHEV</option>' +	
										'<option class="filters-input-option" value="Pajero">Pajero</option>' +	
										'<option class="filters-input-option" value="Pajero Pinin">Pajero Pinin</option>' +	
										'<option class="filters-input-option" value="Sigma">Sigma</option>' +	
										'<option class="filters-input-option" value="Space Gear">Space Gear</option>' +	
										'<option class="filters-input-option" value="Space Runner">Space Runner</option>' +	
										'<option class="filters-input-option" value="Space Star">Space Star</option>' +	
										'<option class="filters-input-option" value="Space Wagon">Space Wagon</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='Nissan'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="100 NX">100 NX</option>' +	
										'<option class="filters-input-option" value="200 SX">200 SX</option>' +	
										'<option class="filters-input-option" value="300 ZX">300 ZX</option>' +	
										'<option class="filters-input-option" value="350Z">350Z</option>' +	
										'<option class="filters-input-option" value="370Z">370Z</option>' +	
										'<option class="filters-input-option" value="370Z Nismo">370Z Nismo</option>' +	
										'<option class="filters-input-option" value="370Z Roadster">370Z Roadster</option>' +	
										'<option class="filters-input-option" value="Almera">Almera</option>' +	
										'<option class="filters-input-option" value="Almera Tino">Almera Tino</option>' +	
										'<option class="filters-input-option" value="Altima">Altima</option>' +	
										'<option class="filters-input-option" value="E-NV200">E-NV200</option>' +	
										'<option class="filters-input-option" value="E-NV200 Evalia">E-NV200 Evalia</option>' +	
										'<option class="filters-input-option" value="Frontier">Frontier</option>' +	
										'<option class="filters-input-option" value="GT-R">GT-R</option>' +	
										'<option class="filters-input-option" value="GT-R Nismo">GT-R Nismo</option>' +	
										'<option class="filters-input-option" value="Juke">Juke</option>' +	
										'<option class="filters-input-option" value="King Cab">King Cab</option>' +	
										'<option class="filters-input-option" value="Leaf">Leaf</option>' +	
										'<option class="filters-input-option" value="Maxima">Maxima</option>' +	
										'<option class="filters-input-option" value="Micra">Micra</option>' +	
										'<option class="filters-input-option" value="Murano">Murano</option>' +	
										'<option class="filters-input-option" value="NV200">NV200</option>' +	
										'<option class="filters-input-option" value="Navara">Navara</option>' +	
										'<option class="filters-input-option" value="Note">Note</option>' +	
										'<option class="filters-input-option" value="Patrol">Patrol</option>' +	
										'<option class="filters-input-option" value="Pickup">Pickup</option>' +	
										'<option class="filters-input-option" value="Primera">Primera</option>' +	
										'<option class="filters-input-option" value="Pulsar">Pulsar</option>' +	
										'<option class="filters-input-option" value="Qashqai">Qashqai</option>' +	
										'<option class="filters-input-option" value="Quest">Quest</option>' +	
										'<option class="filters-input-option" value="Rogue">Rogue</option>' +	
										'<option class="filters-input-option" value="Serena">Serena</option>' +	
										'<option class="filters-input-option" value="Skyline">Skyline</option>' +	
										'<option class="filters-input-option" value="Titan">Titan</option>' +	
										'<option class="filters-input-option" value="X-Trail">X-Trail</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Opel'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Adam">Adam</option>' +
										'<option class="filters-input-option" value="Agila">Agila</option>' +
										'<option class="filters-input-option" value="Antara">Antara</option>' +
										'<option class="filters-input-option" value="Astra">Astra</option>' +
										'<option class="filters-input-option" value="Calibra">Calibra</option>' +
										'<option class="filters-input-option" value="Campo">Campo</option>' +
										'<option class="filters-input-option" value="Cascada">Cascada</option>' +
										'<option class="filters-input-option" value="Combo">Combo</option>' +
										'<option class="filters-input-option" value="Corsa">Corsa</option>' +
										'<option class="filters-input-option" value="Frontera">Frontera</option>' +
										'<option class="filters-input-option" value="GT">GT</option>' +
										'<option class="filters-input-option" value="Insignia">Insignia</option>' +
										'<option class="filters-input-option" value="Kadett">Kadett</option>' +
										'<option class="filters-input-option" value="Meriva">Meriva</option>' +
										'<option class="filters-input-option" value="Mokka">Mokka</option>' +
										'<option class="filters-input-option" value="Monterey">Monterey</option>' +
										'<option class="filters-input-option" value="Movano">Movano</option>' +
										'<option class="filters-input-option" value="Omega">Omega</option>' +
										'<option class="filters-input-option" value="Signum">Signum</option>' +
										'<option class="filters-input-option" value="Sintra">Sintra</option>' +
										'<option class="filters-input-option" value="Tigra">Tigra</option>' +
										'<option class="filters-input-option" value="Vectra">Vectra</option>' +
										'<option class="filters-input-option" value="Vivaro">Vivaro</option>' +
										'<option class="filters-input-option" value="Zafira">Zafira</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='Peugeot'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="108">108</option>' +
										'<option class="filters-input-option" value="205">205</option>' +
										'<option class="filters-input-option" value="206">206</option>' +
										'<option class="filters-input-option" value="207">207</option>' +
										'<option class="filters-input-option" value="208">208</option>' +
										'<option class="filters-input-option" value="301">301</option>' +
										'<option class="filters-input-option" value="308">308</option>' +
										'<option class="filters-input-option" value="405">405</option>' +
										'<option class="filters-input-option" value="406">406</option>' +
										'<option class="filters-input-option" value="407">407</option>' +
										'<option class="filters-input-option" value="508">508</option>' +
										'<option class="filters-input-option" value="607">607</option>' +
										'<option class="filters-input-option" value="806">806</option>' +
										'<option class="filters-input-option" value="807">807</option>' +
										'<option class="filters-input-option" value="1007">1007</option>' +
										'<option class="filters-input-option" value="2008">2008</option>' +
										'<option class="filters-input-option" value="3008">3008</option>' +
										'<option class="filters-input-option" value="4007">4007</option>' +
										'<option class="filters-input-option" value="4008">4008</option>' +
										'<option class="filters-input-option" value="5008">5008</option>' +
										'<option class="filters-input-option" value="Bipper">Bipper</option>' +
										'<option class="filters-input-option" value="Boxer">Boxer</option>' +
										'<option class="filters-input-option" value="E-208">E-208</option>' +
										'<option class="filters-input-option" value="Expert">Expert</option>' +
										'<option class="filters-input-option" value="Partner">Partner</option>' +
										'<option class="filters-input-option" value="RCZ">RCZ</option>' +
										'<option class="filters-input-option" value="Rifter">Rifter</option>' +
										'<option class="filters-input-option" value="Traveller">Traveller</option>'  +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='Polonez'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Atu">Atu</option>' +
										'<option class="filters-input-option" value="Atu Plus">Atu Plus</option>' +
										'<option class="filters-input-option" value="Caro">Caro</option>' +
										'<option class="filters-input-option" value="Caro Plus">Caro Plus</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Porsche'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="718">718</option>' +
										'<option class="filters-input-option" value="911">911</option>' +
										'<option class="filters-input-option" value="944">944</option>' +
										'<option class="filters-input-option" value="Cayenne">Cayenne</option>' +
										'<option class="filters-input-option" value="Cayman">Cayman</option>' +
										'<option class="filters-input-option" value="E-Performance">E-Performance</option>' +
										'<option class="filters-input-option" value="Macan">Macan</option>' +
										'<option class="filters-input-option" value="Panamera">Panamera</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Renault'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Avantime">Avantime</option>' +
										'<option class="filters-input-option" value="Captur">Captur</option>' +
										'<option class="filters-input-option" value="Clio">Clio</option>' +
										'<option class="filters-input-option" value="Escape">Escape</option>' +
										'<option class="filters-input-option" value="Fluence">Fluence</option>' +
										'<option class="filters-input-option" value="Grand Escape">Grand Escape</option>' +
										'<option class="filters-input-option" value="Grand Scenic">Grand Scenic</option>' +
										'<option class="filters-input-option" value="Scenic">Scenic</option>' +
										'<option class="filters-input-option" value="Scenic Conquest">Scenic Conquest</option>' +
										'<option class="filters-input-option" value="Scenic RX4">Scenic RX4</option>' +
										'<option class="filters-input-option" value="Kadjar">Kadjar</option>' +
										'<option class="filters-input-option" value="Kangoo">Kangoo</option>' +
										'<option class="filters-input-option" value="Koleos">Koleos</option>' +
										'<option class="filters-input-option" value="Laguna">Laguna</option>' +
										'<option class="filters-input-option" value="Latitude">Latitude</option>' +
										'<option class="filters-input-option" value="Master">Master</option>' +
										'<option class="filters-input-option" value="Megane">Megane</option>' +
										'<option class="filters-input-option" value="Megane RS">Megane RS</option>' +
										'<option class="filters-input-option" value="Modus">Modus</option>' +
										'<option class="filters-input-option" value="Talisman">Talisman</option>' +
										'<option class="filters-input-option" value="Thalia">Thalia</option>' +
										'<option class="filters-input-option" value="Trafic">Trafic</option>' +
										'<option class="filters-input-option" value="Twingo">Twingo</option>' +
										'<option class="filters-input-option" value="Twizy">Twizy</option>' +
										'<option class="filters-input-option" value="Vel Satis">Vel Satis</option>' +
										'<option class="filters-input-option" value="Wind">Wind</option>' +
										'<option class="filters-input-option" value="ZOE">ZOE</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='Rolls Royce'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Ghost">Ghost</option>' +
										'<option class="filters-input-option" value="Phantom">Phantom</option>' +
										'<option class="filters-input-option" value="Wraith">Wraith</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Rover'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="25">25</option>' +
										'<option class="filters-input-option" value="45">45</option>' +
										'<option class="filters-input-option" value="75">75</option>' +
										'<option class="filters-input-option" value="200">200</option>' +
										'<option class="filters-input-option" value="214">214</option>' +
										'<option class="filters-input-option" value="400">400</option>' +
										'<option class="filters-input-option" value="414">414</option>' +
										'<option class="filters-input-option" value="416">416</option>' +
										'<option class="filters-input-option" value="420">420</option>' +
										'<option class="filters-input-option" value="600">600</option>' +
										'<option class="filters-input-option" value="620">620</option>' +
										'<option class="filters-input-option" value="MG">MG</option>' +
										'<option class="filters-input-option" value="Streetwise">Streetwise</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Saab'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="9-5">9-5</option>' +
										'<option class="filters-input-option" value="900">900</option>' +
										'<option class="filters-input-option" value="9000">9000</option>' +
										'<option class="filters-input-option" value="9-3">9-3</option>' +
										'<option class="filters-input-option" value="9-7X">9-7X</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Seat'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Alhambra">Alhambra</option>' +
										'<option class="filters-input-option" value="Altea">Altea</option>' +
										'<option class="filters-input-option" value="Altea XL">Altea XL</option>' +
										'<option class="filters-input-option" value="Arona">Arona</option>' +
										'<option class="filters-input-option" value="Arosa">Arosa</option>' +
										'<option class="filters-input-option" value="Ateca">Ateca</option>' +
										'<option class="filters-input-option" value="Cordoba">Cordoba</option>' +
										'<option class="filters-input-option" value="Exeo">Exeo</option>' +
										'<option class="filters-input-option" value="Ibiza">Ibiza</option>' +
										'<option class="filters-input-option" value="Inca">Inca</option>' +
										'<option class="filters-input-option" value="Leon">Leon</option>' +
										'<option class="filters-input-option" value="Leon Cupra">Leon Cupra</option>' +
										'<option class="filters-input-option" value="Leon Sportourer ST">Leon Sportourer ST</option>' +
										'<option class="filters-input-option" value="Mii">Mii</option>' +
										'<option class="filters-input-option" value="Tarraco">Tarraco</option>' +
										'<option class="filters-input-option" value="Toledo">Toledo</option>' +					
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Skoda'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="105">105</option>' +
										'<option class="filters-input-option" value="120">120</option>' +
										'<option class="filters-input-option" value="Citigo">Citigo</option>' +
										'<option class="filters-input-option" value="Fabia">Fabia</option>' +
										'<option class="filters-input-option" value="Favorit">Favorit</option>' +
										'<option class="filters-input-option" value="Felicia">Felicia</option>' +
										'<option class="filters-input-option" value="Kamiq">Kamiq</option>' +
										'<option class="filters-input-option" value="Karoq">Karoq</option>' +
										'<option class="filters-input-option" value="Kodiaq">Kodiaq</option>' +
										'<option class="filters-input-option" value="Octavia">Octavia</option>' +
										'<option class="filters-input-option" value="Rapid">Rapid</option>' +
										'<option class="filters-input-option" value="Roomster">Roomster</option>' +
										'<option class="filters-input-option" value="Scala">Scala</option>' +
										'<option class="filters-input-option" value="Superb">Superb</option>' +
										'<option class="filters-input-option" value="Yeti">Yeti</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Smart'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Fortwo">Fortwo</option>' +									
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='SsangYong'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Actyon">Actyon</option>' +						
										'<option class="filters-input-option" value="Korando">Korando</option>' +						
										'<option class="filters-input-option" value="Kyron">Kyron</option>' +						
										'<option class="filters-input-option" value="Musso">Musso</option>' +						
										'<option class="filters-input-option" value="Rexton">Rexton</option>' +						
										'<option class="filters-input-option" value="Rodius">Rodius</option>' +						
										'<option class="filters-input-option" value="Tivoli">Tivoli</option>' +						
										'<option class="filters-input-option" value="XLV">XLV</option>' +						
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}	
			
			if(mS.value==='Subaru'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="B9 Tribeca">B9 Tribeca</option>' +			
										'<option class="filters-input-option" value="BRZ">BRZ</option>' +			
										'<option class="filters-input-option" value="Forester">Forester</option>' +			
										'<option class="filters-input-option" value="Impreza">Impreza</option>' +			
										'<option class="filters-input-option" value="Justy">Justy</option>' +			
										'<option class="filters-input-option" value="Legacy">Legacy</option>' +			
										'<option class="filters-input-option" value="Levorg">Levorg</option>' +			
										'<option class="filters-input-option" value="Outback">Outback</option>' +			
										'<option class="filters-input-option" value="Tribeca">Tribeca</option>' +			
										'<option class="filters-input-option" value="WRX">WRX</option>' +			
										'<option class="filters-input-option" value="XV">XV</option>' +			
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Suzuki'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Alto">Alto</option>' +			
										'<option class="filters-input-option" value="Baleno">Baleno</option>' +			
										'<option class="filters-input-option" value="Celerio">Celerio</option>' +			
										'<option class="filters-input-option" value="Grand Vitara">Grand Vitara</option>' +			
										'<option class="filters-input-option" value="Ignis">Ignis</option>' +			
										'<option class="filters-input-option" value="Jimny">Jimny</option>' +			
										'<option class="filters-input-option" value="Liana">Liana</option>' +			
										'<option class="filters-input-option" value="SJ">SJ</option>' +			
										'<option class="filters-input-option" value="SX4">SX4</option>' +			
										'<option class="filters-input-option" value="SX4 S-Cross">SX4 S-Cross</option>' +			
										'<option class="filters-input-option" value="Samurai">Samurai</option>' +			
										'<option class="filters-input-option" value="Splash">Splash</option>' +			
										'<option class="filters-input-option" value="Swift">Swift</option>' +			
										'<option class="filters-input-option" value="Swift Sport">Swift Sport</option>' +			
										'<option class="filters-input-option" value="Vitara">Vitara</option>' +			
										'<option class="filters-input-option" value="Wagon">Wagon</option>' +			
										'<option class="filters-input-option" value="X-90">X-90</option>' +			
										'<option class="filters-input-option" value="XL7">XL7</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Tesla'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Model 3">Model 3</option>' +			
										'<option class="filters-input-option" value="Model S">Model S</option>' +			
										'<option class="filters-input-option" value="Model X">Model X</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Toyota'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="4-Runner">4-Runner</option>' +	
										'<option class="filters-input-option" value="Auris">Auris</option>' +	
										'<option class="filters-input-option" value="Avalon">Avalon</option>' +	
										'<option class="filters-input-option" value="Avensis">Avensis</option>' +	
										'<option class="filters-input-option" value="Avensis Verso">Avensis Verso</option>' +	
										'<option class="filters-input-option" value="Aygo">Aygo</option>' +	
										'<option class="filters-input-option" value="C-HR">C-HR</option>' +	
										'<option class="filters-input-option" value="Camry">Camry</option>' +	
										'<option class="filters-input-option" value="Camry Solara">Camry Solara</option>' +	
										'<option class="filters-input-option" value="Carina">Carina</option>' +	
										'<option class="filters-input-option" value="Celica">Celica</option>' +	
										'<option class="filters-input-option" value="Corolla">Corolla</option>' +	
										'<option class="filters-input-option" value="FJ">FJ</option>' +	
										'<option class="filters-input-option" value="GR Supra">GR Supra</option>' +	
										'<option class="filters-input-option" value="GT86">GT86</option>' +	
										'<option class="filters-input-option" value="Highlander">Highlander</option>' +	
										'<option class="filters-input-option" value="Hilux">Hilux</option>' +	
										'<option class="filters-input-option" value="Land Cruiser">Land Cruiser</option>' +	
										'<option class="filters-input-option" value="Highlander">Highlander</option>' +	
										'<option class="filters-input-option" value="MR2">MR2</option>' +	
										'<option class="filters-input-option" value="Matrix">Matrix</option>' +	
										'<option class="filters-input-option" value="Mirai">Mirai</option>' +	
										'<option class="filters-input-option" value="Paseo">Paseo</option>' +	
										'<option class="filters-input-option" value="Picnic">Picnic</option>' +	
										'<option class="filters-input-option" value="Previa">Previa</option>' +	
										'<option class="filters-input-option" value="Prius">Prius</option>' +	
										'<option class="filters-input-option" value="Proace">Proace</option>' +	
										'<option class="filters-input-option" value="RAV4">RAV4</option>' +	
										'<option class="filters-input-option" value="Sienna">Sienna</option>' +	
										'<option class="filters-input-option" value="Supra">Supra</option>' +	
										'<option class="filters-input-option" value="Verso">Verso</option>' +	
										'<option class="filters-input-option" value="Yaris Verso">Yaris Verso</option>' +	
										'<option class="filters-input-option" value="Yaris">Yaris</option>' +	
										'<option class="filters-input-option" value="iQ">iQ</option>' +
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Volkswagen'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="Arteon">Arteon</option>' +	
										'<option class="filters-input-option" value="Beetle">Beetle</option>' +	
										'<option class="filters-input-option" value="Bora">Bora</option>' +	
										'<option class="filters-input-option" value="Caddy">Caddy</option>' +	
										'<option class="filters-input-option" value="California">California</option>' +	
										'<option class="filters-input-option" value="Caravelle">Caravelle</option>' +	
										'<option class="filters-input-option" value="Corrado">Corrado</option>' +	
										'<option class="filters-input-option" value="Crafter">Crafter</option>' +	
										'<option class="filters-input-option" value="E-Golf">E-Golf</option>' +	
										'<option class="filters-input-option" value="Eos">Eos</option>' +	
										'<option class="filters-input-option" value="Fox">Fox</option>' +	
										'<option class="filters-input-option" value="Garbus">Garbus</option>' +	
										'<option class="filters-input-option" value="Golf">Golf</option>' +	
										'<option class="filters-input-option" value="Golf GTI">Golf GTI</option>' +	
										'<option class="filters-input-option" value="Golf Plus">Golf Plus</option>' +	
										'<option class="filters-input-option" value="Golf Sportsvan">Golf Sportsvan</option>' +	
										'<option class="filters-input-option" value="Jetta">Jetta</option>' +	
										'<option class="filters-input-option" value="Lupo">Lupo</option>' +	
										'<option class="filters-input-option" value="Multivan">Multivan</option>' +	
										'<option class="filters-input-option" value="New Beetle">New Beetle</option>' +	
										'<option class="filters-input-option" value="Passat">Passat</option>' +	
										'<option class="filters-input-option" value="Passat CC">Passat CC</option>' +	
										'<option class="filters-input-option" value="Passat W8">Passat W8</option>' +	
										'<option class="filters-input-option" value="Phaeton">Phaeton</option>' +	
										'<option class="filters-input-option" value="Polo">Polo</option>' +	
										'<option class="filters-input-option" value="Polo GTI">Polo GTI</option>' +	
										'<option class="filters-input-option" value="Routan">Routan</option>' +	
										'<option class="filters-input-option" value="Scirocco">Scirocco</option>' +	
										'<option class="filters-input-option" value="Sharan">Sharan</option>' +	
										'<option class="filters-input-option" value="T-Cross">T-Cross</option>' +	
										'<option class="filters-input-option" value="T-Roc">T-Roc</option>' +	
										'<option class="filters-input-option" value="Tiguan">Tiguan</option>' +	
										'<option class="filters-input-option" value="Tiguan Allspace">Tiguan Allspace</option>' +	
										'<option class="filters-input-option" value="Touareg">Touareg</option>' +	
										'<option class="filters-input-option" value="Touran">Touran</option>' +	
										'<option class="filters-input-option" value="Transporter">Transporter</option>' +	
										'<option class="filters-input-option" value="Up!">Up!</option>' +	
										'<option class="filters-input-option" value="Vento">Vento</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
			
			if(mS.value==='Volvo'){
				mS2.innerHTML='<option class="filters-input-option" value="0">Wybierz model</option>' +
										'<option class="filters-input-option" value="C30">C30</option>' +	
										'<option class="filters-input-option" value="C70">C70</option>' +	
										'<option class="filters-input-option" value="S40">S40</option>' +	
										'<option class="filters-input-option" value="S60">S60</option>' +	
										'<option class="filters-input-option" value="S70">S70</option>' +	
										'<option class="filters-input-option" value="S80">S80</option>' +	
										'<option class="filters-input-option" value="S90">S90</option>' +	
										'<option class="filters-input-option" value="Seria 200">Seria 200</option>' +	
										'<option class="filters-input-option" value="Seria 400">Seria 400</option>' +	
										'<option class="filters-input-option" value="Seria 700">Seria 700</option>' +	
										'<option class="filters-input-option" value="Seria 800">Seria 800</option>' +	
										'<option class="filters-input-option" value="Seria 900">Seria 900</option>' +	
										'<option class="filters-input-option" value="V40">V40</option>' +	
										'<option class="filters-input-option" value="V50">V50</option>' +	
										'<option class="filters-input-option" value="V60">V60</option>' +	
										'<option class="filters-input-option" value="V70">V70</option>' +	
										'<option class="filters-input-option" value="V90">V90</option>' +	
										'<option class="filters-input-option" value="XC40">XC40</option>' +	
										'<option class="filters-input-option" value="XC50">XC50</option>' +	
										'<option class="filters-input-option" value="XC60">XC60</option>' +	
										'<option class="filters-input-option" value="XC70">XC70</option>' +	
										'<option class="filters-input-option" value="XC80">XC80</option>' +	
										'<option class="filters-input-option" value="XC90">XC90</option>' +	
										'<option class="filters-input-option" value="Inne">Inne</option>';
										
			}
		}
    </script>
  </body>
</html>