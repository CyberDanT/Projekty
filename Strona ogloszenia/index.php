<?php
@session_start();
include_once("newsadds.php");
include_once("indexpromotions.php");
unset($_SESSION['searchitem']);
unset($_SESSION['searchloc']);
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155847317-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-155847317-1');
	</script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
    <title>Ogłoszenia - Darmowe ogłoszenia dla Ciebie - BezGrosika.pl</title>
    <meta name="keywords" content="bezpłatny serwis ogłoszeniowy, ogłoszenia, darmowe ogłoszenia, dodaj ogłoszenie, praca, motoryzacja">
    <meta name="description" content="BezGrosika.pl to bezpłatny serwis ogłoszeniowy. Darmowe ogłoszenia dla Ciebie, wystaw ogłoszenie w każdej kategorii za darmo">
	<meta property="og:title" content="Darmowe ogłoszenia na BezGrosika">
	<meta property="og:description" content="Serwis ogłoszeniowy ogólnopolski, wystaw samochód na sprzedaż, szukaj pracy, poszukaj nieruchomości na sprzedaż lub ogłoszenia auta">
	<meta property="og:image" content="images/grosiky.png">
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://www.bezgrosika.pl">
	<meta property="og:site_name" content="BezGrosika.pl">
    <link rel="shortcut icon" href="images/grosiky.png">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
	
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/rangeslider.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
	
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
          
          <img src="images/grosiky.png" style="height: 50px;"/><div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="index.php" class="text-black mb-0">Bez<span class="text-primary">Grosika</span>.pl</a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="index.php">Strona główna</a></li>
                <li><a href="reklama.php">Reklama</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
				
                <li class="ml-xl-3 login">
					<?php
						if(isset($_SESSION['user'])){
							echo '<a href="mojekonto.php"><span class="border-left pl-xl-4"></span>'.$_SESSION['user'].'<b><span class="icon-arrow_drop_down"></span></b></a>';
						}else{
							echo '<a href="login.php"><span class="border-left pl-xl-4"></span>Login</a>';
						}
					?>
				</li>
                <li>
					<?php
						if(isset($_SESSION['logged'])){
							echo '<a href="logout.php">Wyloguj się';
						}else{
							echo '<a href="register.php">Rejestracja</a>';
						}
					?>
				</li>

                <li><a href="dodaj-ogloszenie.php" class="cta"><span class="bg-primary text-white rounded">+ Ogłoszenie</span></a></li>
              </ul>
            </nav>
          </div>

          <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>

        </div>
      <!-- </div> -->
    </header>

  

    <div class="site-blocks-cover overlay" style="background-image: url(images/hero_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-12">
            
            
            <div class="row justify-content-center mb-4">
              <div class="col-md-8 text-center">
                <h1 class="" data-aos="fade-up">Bezpłatny serwis ogłoszeniowy</h1>
                <p data-aos="fade-up" data-aos-delay="100">Dodawaj ogłoszenia za darmo!</p>
              </div>
            </div>

            <div class="form-search-wrap" data-aos="fade-up" data-aos-delay="200">
              <form method="post" action="search.php?page=0">
                <div class="row align-items-center">
                  <div class="col-lg-12 mb-4 mb-xl-0 col-xl-4">
                    <input type="text" name="searchitem" class="form-control rounded" placeholder="Co mam wyszukać?">
                  </div>
                  <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                    <div class="wrap-icon">
                      <span class="icon icon-room"></span>
                      <input type="text" name="searchloc" class="form-control rounded" placeholder="Polska">
                    </div>
                    
                  </div>
                  <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                    <div class="select-wrap">
                      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                      <select class="form-control rounded" name="" id="">
                        <option value="">Wszystkie kategorie</option>
                      <!--  <option value="">-</option>
                        <option value="">-</option>
                        <option value="">-</option>
                        <option value="">-</option>
                        <option value="">-</option>
                        <option value="">-</option> -->
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12 col-xl-2 ml-auto text-right">
                    <input type="submit" name="submit" class="btn btn-primary btn-block rounded" value="Szukaj">
                  </div>
                  
                </div>
              </form>
            </div>
          </div>
		  <?php
			@session_start();
			if(isset($_SESSION['globalerrorfrom'])){
				echo '<div id="zglid" onclick="document.getElementById(\'zglid\').style=\'display: none;\' " style="cursor: pointer; min-width: 170px; display: block; text-align: center; background: white; border-radius: 15px; padding: 15px; position: fixed; top: 90px; border: 2px solid #30e3ca; width: 30%; top: 30%; left: 35%;">';
				echo '<span style="font-size: 15px;">'.$_SESSION['globalerrorfrom'].'</br><span style="float: right;"><b>X</b></span></span>';
				echo '</div>';
				unset($_SESSION['globalerrorfrom']);
			}
		  ?>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        
        <div class="overlap-category mb-5">
          <div class="row align-items-stretch no-gutters">
		  
		    <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a id="myBtn" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-car"></span></span>
                <span class="caption mb-2 d-block">Motoryzacja</span>
                <span class="number"></span>
              </a>
            </div>
			<div id="myModal" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <h2>Motoryzacja</h2>
				  <span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="motoryzacja.php" alt="ogłoszenia auta">Wszystkie w motoryzacja</a></p>
						« » <p><a href="motoryzacja/samochodyosobowe.php" alt="ogłoszenia samochody osobowe">Samochody osobowe</a></p>
						« » <p><a href="motoryzacja/samochodyciezarowe.php">Samochody ciężarowe</a></p>
						« » <p><a href="motoryzacja/samochodydostawcze.php">Samochody dostawcze</a></p>
						« » <p><a href="motoryzacja/motocykleskutery.php">Motocykle i skutery</a></p>
					</div>
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="motoryzacja/pojazdyrolnicze.php">Pojazdy rolnicze</a></p>
						« » <p><a href="motoryzacja/felgiopony.php">Felgi i opony</a></p>
						« » <p><a href="motoryzacja/audio.php">Sprzęt audio</a></p>
						« » <p><a href="motoryzacja/pozostale.php">Pozostałe</a></p>
					</div>
				</div>
			  </div>
			</div>
			
			<div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a id="myBtn1" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-idea"></span></span>
                <span class="caption mb-2 d-block">Elektronika</span>
                <span class="number"></span>
              </a>
            </div>
			<div id="myModal1" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <h2>Elektronika</h2>
				  <span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="elektronika.php">Wszystkie w elektronika</a></p>
						« » <p><a href="elektronika/komputery.php">Komputery</a></p>
						« » <p><a href="elektronika/telewizory.php">Telewizory</a></p>
						« » <p><a href="elektronika/telefony.php">Telefony</a></p>
					</div>
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="elektronika/tablety.php">Tablety</a></p>
						« » <p><a href="elektronika/konsole.php">Konsole</a></p>
						« » <p><a href="elektronika/akcesoria.php">Akcesoria</a></p>
						« » <p><a href="elektronika/pozostale.php">Pozostałe</a></p>
					</div>
				</div>
			  </div>
			</div>
			
            <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a id="myBtn2" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-rent"></span></span>
                <span class="caption mb-2 d-block">Nieruchomości</span>
                <span class="number"></span>
              </a>
            </div>
			<div id="myModal2" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <h2>Nieruchomości</h2>
				  <span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="nieruchomosci.php" alt="ogłoszenia nieruchomości">Wszystkie w nieruchomości</a></p>
						« » <p><a href="nieruchomosci/mieszkania.php">Mieszkania</a></p>
						« » <p><a href="nieruchomosci/garaze.php">Garaże</a></p>
					</div>
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="nieruchomosci/dzialki.php">Działki</a></p>
						« » <p><a href="nieruchomosci/domy.php">Domy</a></p>
						« » <p><a href="nieruchomosci/pozostale.php">Pozostałe</a></p>
					</div>
				</div>
			  </div>
			</div>
			
			<div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a id="myBtn3" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-bedroom"></span></span>
                <span class="caption mb-2 d-block">Dom i ogród</span>
                <span class="number"></span>
              </a>
            </div>
			<div id="myModal3" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <h2>Dom i ogród</h2>
				  <span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="domiogrod.php">Wszystkie w dom i ogród</a></p>
						« » <p><a href="dom-ogrod/rtvagd.php">Sprzęt RTV/AGD</a></p>
						« » <p><a href="dom-ogrod/oswietlenie.php">Oświetlenie</a></p>
					</div>
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="dom-ogrod/ogrod.php">Ogród</a></p>
						« » <p><a href="dom-ogrod/meble.php">Meble</a></p>
						« » <p><a href="dom-ogrod/pozostale.php">Pozostałe</a></p>
					</div>
				</div>
			  </div>
			</div>
			
			<div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a id="myBtn4" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-work"></span></span>
                <span class="caption mb-2 d-block">Praca</span>
                <span class="number"></span>
              </a>
            </div>
			<div id="myModal4" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <h2>Praca</h2>
				  <span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="praca.php" alt="ogłoszenia praca">Wszystkie w praca</a></p>
						« » <p><a href="praca/dorywcza.php" alt="praca dorywcza">Dorywcza</a></p>
						« » <p><a href="praca/zagranica.php" alt="praca za granicą">Za granicą</a></p>
					</div>
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="praca/wkraju.php">W kraju</a></p>
						« » <p><a href="praca/uslugi.php">Usługi</a></p>
						« » <p><a href="praca/pozostale.php">Pozostałe</a></p>
					</div>
				</div>
			  </div>
			</div>
			
			<div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a id="myBtn5" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-shirt"></span></span>
                <span class="caption mb-2 d-block">Odzież</span>
                <span class="number"></span>
              </a>
            </div>
			<div id="myModal5" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <h2>Odzież</h2>
				  <span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="odziez.php">Wszystkie w odzież</a></p>
						« » <p><a href="odziez/ubrania.php">Ubrania</a></p>
						« » <p><a href="odziez/dodatki.php">Dodatki</a></p>
					</div>
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="odziez/zegarki.php">Zegarki</a></p>
						« » <p><a href="odziez/buty.php">Buty</a></p>
						« » <p><a href="odziez/pozostale.php">Pozostałe</a></p>
					</div>
				</div>
			  </div>
			</div>
			
            <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
             <a id="myBtn6" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-pawprints"></span></span>
                <span class="caption mb-2 d-block">Zwierzęta</span>
                <span class="number"></span>
              </a>
            </div>
			<div id="myModal6" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <h2>Zwierzęta</h2>
				  <span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="zwierzeta.php">Wszystkie w zwierzęta</a></p>
						« » <p><a href="zwierzeta/schroniska.php">Schroniska</a></p>
						« » <p><a href="zwierzeta/koty.php">Koty</a></p>
					</div>
					<div style="display: inline-block; margin-left: 20%;">
						« » <p><a href="zwierzeta/psy.php">Psy</a></p>
						« » <p><a href="zwierzeta/pozostale.php">Pozostałe zwierzęta</a></p>
						« » <p><a href="zwierzeta/dlazwierzat.php">Dla zwierząt</a></p>
					</div>
				</div>
			  </div>
			</div>
			
            <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a href="pozostale/pozostale.php" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-map"></span></span>
                <span class="caption mb-2 d-block">Pozostałe</span>
                <span class="number"></span>
              </a>
            </div>
			<div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a href="oddam-za-darmo/oddamzadarmo.php" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="flaticon-free"></span></span>
                <span class="caption mb-2 d-block">Oddam za darmo</span>
                <span class="number"></span>
              </a>
            </div>
			<div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a href="search.php?page=0" style="cursor: pointer; color: #30e3ca" class="popular-category h-100">
                <span class="icon"><span class="icon-format_list_bulleted"></span></span>
                <span class="caption mb-2 d-block">Wszystkie ogłoszenia</span>
                <span class="number"></span>
              </a>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <h2 class="h5 mb-4 text-black">Ostatnio dodane ogłoszenia</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12  block-13">
            <div class="owl-carousel nonloop-block-13">
              <!-- PRZYKŁADY OGŁOSZEŃ
			  
              <div class="d-block d-md-flex listing vertical">
                <a href="#" class="img d-block" style="background-image: url('images/img_1.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Motoryzacja</span>
                  <h3><a href="#">Auto na sprzedaż (przykład)</a></h3>
                  <span style="display: inline-block;" class="icon-tags"></span> <address style="display: inline-block;">185 500 PLN</address>
                  <!-- ><p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p>
                </div>
              </div>
			  
			  <div class="d-block d-md-flex listing vertical">
                <a href="#" class="img d-block" style="background-image: url('images/img_2.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Nieruchomości</span>
                  <h3><a href="#">Dom z basenem (przykład)</a></h3>
                  <span style="display: inline-block;" class="icon-tags"></span> <address style="display: inline-block;">420 000 PLN</address>
                  <!-- <p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p>
                </div>
              </div> -->
				<?php
					newsadds();
				?>

              <!-- <div class="d-block d-md-flex listing vertical">
                <a href="listings-single.html" class="img d-block" style="background-image: url('images/img_3.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Furniture</span>
                  <a href="#" class="bookmark"><span class="icon-star" title="Dodaj do zakładek"></span></a>
                  <h3><a href="listings-single.html">Wooden Chair &amp; Table</a></h3>
                  <address>Don St, Brooklyn, New York</address>
                  <p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p>
                </div>
              </div>

              <div class="d-block d-md-flex listing vertical">
                <a href="listings-single.html" class="img d-block" style="background-image: url('images/img_4.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Electronics</span>
                  <a href="#" class="bookmark"><span class="icon-star" title="Dodaj do zakładek"></span></a>
                  <h3><a href="listings-single.html">iPhone X gray</a></h3>
                  <address>Don St, Brooklyn, New York</address>
                  <p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p>
                </div>
              </div>

              <div class="d-block d-md-flex listing vertical">
                <a href="listings-single.html" class="img d-block" style="background-image: url('images/img_1.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Cars &amp; Vehicles</span>
                  <a href="#" class="bookmark"><span class="icon-star" title="Dodaj do zakładek"></span></a>
                  <h3><a href="listings-single.html">Red Luxury Car</a></h3>
                  <address>Don St, Brooklyn, New York</address>
                   <p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p> 
                </div>
              </div>

              <div class="d-block d-md-flex listing vertical">
                <a href="listings-single.html" class="img d-block" style="background-image: url('images/img_2.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Real Estate</span>
                  <a href="#" class="bookmark"><span class="icon-star" title="Dodaj do zakładek"></span></a>
                  <h3><a href="listings-single.html">House with Swimming Pool</a></h3>
                  <address>Don St, Brooklyn, New York</address>
                  <p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p> 
                </div>
              </div>

              <div class="d-block d-md-flex listing vertical">
                <a href="listings-single.html" class="img d-block" style="background-image: url('images/img_3.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Furniture</span>
                  <a href="#" class="bookmark"><span class="icon-star" title="Dodaj do zakładek"></span></a>
                  <h3><a href="listings-single.html">Wooden Chair &amp; Table</a></h3>
                  <address>Don St, Brooklyn, New York</address>
                   <p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p> 
                </div>
              </div>

              <div class="d-block d-md-flex listing vertical">
                <a href="listings-single.html" class="img d-block" style="background-image: url('images/img_4.jpg')"></a>
                <div class="lh-content">
                  <span class="category">Electronics</span>
                  <a href="#" class="bookmark"><span class="icon-star" title="Dodaj do zakładek"></span></a>
                  <h3><a href="listings-single.html">iPhone X gray</a></h3>
                  <address>Don St, Brooklyn, New York</address>
                   <p class="mb-0">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-secondary"></span>
                    <span class="review">(3 Reviews)</span>
                  </p>
                </div>
              </div> -->

            </div>
          </div>


        </div>
      </div>
    </div>
    
    <div class="site-section" data-aos="fade">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Wyróżnione ogłoszenia</h2>
            <p class="color-black-opacity-5">Może znajdziesz coś dla siebie?</p>
          </div>
        </div>

        <div class="row">
          
        <!--  <div class="col-md-6 mb-4 mb-lg-4 col-lg-4">
            <div class="listing-item" style="border-bottom: 5px solid #f89d13;">
              <div class="listing-image">
                <img src="images/img_3.jpg" alt="Image" class="img-fluid">
              </div>
              <div class="listing-item-content">
                <a href="#" class="bookmark"><span class="icon-star text-warning" style="font-size: 25px;" title="Ogłoszenie promowane"></span></a>
                <a class="px-3 mb-3 category" style="background-color: #f89d13;" href="#">Dom i ogród</a>
                <h2 class="mb-1"><a href="#">Meble kuchenne</a></h2>
                <h2 class="mb-1"><a href="#">(Przykład)</a></h2>
				<span style="display: inline-block;" class="icon-tags"></span> <span class="address" style="display: inline-block;">1 500 PLN</span>
              </div>
            </div>
          </div> !-->
		  
		  <?php
			indexpromotions();
		   ?>

        </div>
      </div>
    </div>
 
    <?php
		include_once("footer.php");
		footer();
	?>
  </div>
  <script src="js/modal.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/rangeslider.min.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>