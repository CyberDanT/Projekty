<?php
session_start();
if(!isset($_SESSION['logged'])){
		header('Location: mojekonto.php');
		exit();
	}
	
if(isset($_POST['submit'])){
	unset($_SESSION['addogl_wyposazenie']);
	$ok = true;
	$title = $_POST['title'];
	$category = $_POST['category'];
	$title = strip_tags($title);
	$_SESSION['addogl_title'] = $title;
	$wzor = '/^[a-zA-Z]/';
	if((strlen($title)<3) || (strlen($title)>60)){
		$ok = false;
		$_SESSION['eogl_title'] = "Podaj tytuł od 3 do 60 znaków";
	}
	if(!preg_match($wzor, $title)){
		$ok = false;
		$_SESSION['eogl_title'] = "Tytuł składa się z niedozwolonych znaków!";
	}
	$title = strrpos($title, "=");
	if($title !== false) {
		$ok = false;
		$_SESSION['eogl_title'] = "Tytuł zawiera niedozwolone znaki!";
	}

	if(!(($category == 'Motoryzacja') || ($category == 'Elektronika') || ($category == 'Nieruchomosci') || ($category == 'Dom i ogrod') || ($category == 'Praca') || ($category == 'Odziez') ||  ($category =='Zwierzeta') || ($category == 'Oddam za darmo') || ($category == 'Pozostale'))){
		$ok = false;
		$_SESSION['eogl_category'] = "Wybierz kategorię 1";
	}
	if((strlen($_POST['Telefon']) == 0) && (strlen($_POST['Email']) == 0)){
		$ok = false;
		$_SESSION['eogl_kontakt'] = "Podaj przynajmniej jedną możliwość kontaktu";
	}else{
		if(strlen($_POST['Telefon']) > 0){ 
			$telefon = $_POST['Telefon'];
		}
		if(strlen($_POST['Email']) > 0){
			$email = $_POST['Email'];
			$email1 = filter_var($email, FILTER_SANITIZE_EMAIL);
			if((filter_var($email1, FILTER_VALIDATE_EMAIL) == false) || ($email != $email1)){
				$ok = false;
				$_SESSION['eogl_email'] = "Sprawdź poprawność wpisanego emaila";
			}
			$email = strrpos($email, "=");
			if($email !== false) {
				$ok = false;
				$_SESSION['eogl_email'] = "Email zawiera niedozwolone znaki!";
			}
		}
	}
	if(!(($_POST['Woj'] == 'Dolnośląskie') || ($_POST['Woj'] == 'Kujawsko pomorskie')
		|| ($_POST['Woj'] == 'Lubelskie') || ($_POST['Woj'] == 'Lubelskie') || ($_POST['Woj'] == 'Lubuskie') 
		|| ($_POST['Woj'] == 'Łódzkie') || ($_POST['Woj'] == 'Małopolskie') || ($_POST['Woj'] == 'Mazowieckie') 
		|| ($_POST['Woj'] == 'Opolskie') || ($_POST['Woj'] == 'Podkarpackie') || ($_POST['Woj'] == 'Podlaskie') 
		|| ($_POST['Woj'] == 'Pomorskie') || ($_POST['Woj'] == 'Śląskie') || ($_POST['Woj'] == 'Świętokrzyskie') 
		|| ($_POST['Woj'] == 'Warmińsko-mazurskie') || ($_POST['Woj'] == 'Wielkopolskie') 
		|| ($_POST['Woj'] == 'Zachodniopomorskie'))){
		$ok = false;
		$_SESSION['eogl_woj'] = "Wybierz poprawne województwo";
	}

	if(strlen($_POST['Miej']) > 0){
		$locationmiej = $_POST['Miej'];
		$locationmiej = strip_tags($locationmiej);
		$locationmiej = strrpos($locationmiej, "<");
		if($locationmiej !== false) {
			$ok = false;
			//echo "</br>nie 139";
			$_SESSION['eogl_miej'] = "Miejscowość zawiera niedozwolone znaki!</br>Podawanie miejscowości nie jest obowiązkowe.";
		}
		$_SESSION['addogl_miej'] = $locationmiej; //Miejscowość
		$locationmiej = strrpos($locationmiej, ">");
		if($locationmiej !== false) {
			$ok = false;
			//echo "</br>nie 139";
			$_SESSION['eogl_miej'] = "Miejscowość zawiera niedozwolone znaki!</br>Podawanie miejscowości nie jest obowiązkowe.";
		}
		$_SESSION['addogl_miej'] = $locationmiej; //Miejscowość
		$locationmiej = strrpos($locationmiej, "=");
		if($locationmiej !== false) {
			$ok = false;
			//echo "</br>nie 139";
			$_SESSION['eogl_miej'] = "Miejscowość zawiera niedozwolone znaki!</br>Podawanie miejscowości nie jest obowiązkowe.";
		}
		$_SESSION['addogl_miej'] = $locationmiej; //Miejscowość
	}
	$opis = addslashes($_POST['Opis']);
	$opis = strip_tags($opis);
	$wzor1 = '/^[a-zA-Z]/';
	$_SESSION['addogl_opis'] = $opis; //Opis
	if((strlen($opis) < 10) || (strlen($opis) > 1000)){
		$ok = false;
		//echo "</br>nie 150";
		$_SESSION['eogl_opis'] = "Podaj opis od 10 do 1000 znaków";
	}
	if(!preg_match($wzor1, $opis)){
		$ok = false;
		//echo "</br>nie 155";
		$_SESSION['eogl_opis'] = "Opis składa się z niedozwolonych znaków!";
	}
	$opis = strrpos($opis, "=");
	if($opis !== false) {
		$ok = false;
		//echo "</br>nie 161";
		$_SESSION['eogl_opis'] = "Opis zawiera niedozwolone znaki!";
	}

	if($_POST['category'] === 'Oddam za darmo'){
		$_SESSION['addogl_cena'] = "Oddam"; //Cena
	}
	
	$category = $_POST['category'];
	if(($category == 'Motoryzacja') || ($category == 'Elektronika') || ($category == 'Nieruchomosci') || ($category == 'Dom i ogrod') || ($category == 'Praca') || ($category == 'Odziez') ||  ($category =='Zwierzeta') || ($category == 'Pozostale')){
		$cena = $_POST['Cena'];
		if((strlen($_POST['Cena']) == 0)){
			$ok = false;
			//echo "</br>nie 174";
			$_SESSION['eogl_cena'] = "Cena: Podaj cenę!";
		}
		if(!(preg_match('/^[0-9]+$/', $cena))){
			$ok = false;
			//echo "</br>nie 179";
			$_SESSION['eogl_cena'] = "Cena: Podana liczba musi być całkowita, dodatnia!";
		}
		if((int)$cena <= 0){
			$ok = false;
			//echo "</br>nie 184";
			$_SESSION['eogl_cena'] =  "Cena: Podana liczba musi być większa od 0!";
		}
	}else{
		if($category === 'Oddam za darmo'){
			$_SESSION['addogl_cena'] = "Oddam za darmo"; //Cena
		}else{
			$ok = false;
			//echo "</br>nie 192";
			$_SESSION['eogl_cena'] = "Cena: Podaj cenę dla właściwej kategorii!";
		}
	}
	if(@$_POST['Negocjacji'] == 'on'){
		$_SESSION['addogl_negocjacja'] = "Tak"; //Negocjacja - 'tak'
	}
	
	if($category == 'Motoryzacja'){
		$category2 = $_POST['category2'];
		if(!(($category2 == 'Samochody osobowe') || ($category2 == 'Samochody dostawcze') || ($category2 == 'Samochody ciezarowe') || ($category2 == 'Motocykle i skutery')  || ($category2 == 'Pojazdy rolnicze') || ($category2 == 'Felgi i opony') || ($category2 == 'Sprzet audio') || ($category2 == 'Pozostale'))){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 2";
		}
		if($category2 == 'Samochody osobowe'){
			$category3 = $_POST['category3'];
			if(!(($category3 == 'Abarth') || ($category3 == 'Acura') || ($category3 == 'Alfa Romeo') 
				|| ($category3 == 'Aston Martin') || ($category3 == 'Audi') || ($category3 == 'Bentley') 
				|| ($category3 == 'BMW') || ($category3 == 'Bugatti') || ($category3 == 'Cadilac') 
				|| ($category3 == 'Chevrolet') || ($category3 == 'Chrysler') || ($category3 == 'Citroen') 
				|| ($category3 == 'Dacia') || ($category3 == 'Daewoo') || ($category3 == 'Daihatsu') 
				|| ($category3 == 'Dodge') || ($category3 == 'Ferrari') || ($category3 == 'Fiat') 
				|| ($category3 == 'Ford') || ($category3 == 'Honda') || ($category3 == 'Hyundai') 
				|| ($category3 == 'Infiniti') || ($category3 == 'Jaguar') || ($category3 == 'Jeep') 
				|| ($category3 == 'Kia') || ($category3 == 'Lamborghini') || ($category3 == 'Lancia') 
				|| ($category3 == 'Land Rover') || ($category3 == 'Lexus') || ($category3 == 'Lincoln') 
				|| ($category3 == 'Lotus') || ($category3 == 'Maserati') || ($category3 == 'Mazda') 
				|| ($category3 == 'McLaren') || ($category3 == 'Mercedes') || ($category3 == 'MicroCar') 
				|| ($category3 == 'Mini') || ($category3 == 'Mitsubishi') || ($category3 == 'Nissan') 
				|| ($category3 == 'Opel') || ($category3 == 'Peugeot') || ($category3 == 'Polonez') 
				|| ($category3 == 'Porsche') || ($category3 == 'Renault') || ($category3 == 'Rolls Royce') 
				|| ($category3 == 'Rover') || ($category3 == 'Saab') || ($category3 == 'Seat') 
				|| ($category3 == 'Skoda') || ($category3 == 'Smart') || ($category3 == 'SsangYong')
				|| ($category3 == 'Subaru') || ($category3 == 'Suzuki') || ($category3 == 'Tesla')
				|| ($category3 == 'Toyota') || ($category3 == 'Volkswagen') || ($category3 == 'Volvo') 
				|| ($category3 == 'Zabytkowe') || ($category3 == 'Inna marka'))){
				$ok = false;
				$_SESSION['eogl_category'] = "Wybierz kategorię 3";
			}
			if(!(($category3 == 'Zabytkowe') || ($category3 == 'Inna marka'))){
				@$category4 = $_POST['category4'];
				if($category3 == 'Abarth'){
					if(!(($category4 == '124 Spider') || ($category4 == '500') ||  ($category4 == 'Grande Punto') 
						|| ($category4 == 'Punto') || ($category4 == 'Punto Evo') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				if($category3 == 'Acura'){
					if(!(($category4 == 'CDX') || ($category4 == 'ILX') || ($category4 == 'MDX')
						|| ($category4 == 'RDX') || ($category4 == 'RLX') || ($category4 == 'TLX')
						|| ($category4 == 'TSX') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Alfa Romeo'){
					if(!(($category4 == '145') || ($category4 == '146') || ($category4 == '147') || ($category4 == '155') 
						|| ($category4 == '156') || ($category4 == '159') || ($category4 == '164') || ($category4 == '166')
						|| ($category4 == '4C') || ($category4 == 'Brera') || ($category4 == 'GT') || ($category4 == 'GTV')
						|| ($category4 == 'Giulia') || ($category4 == 'Giulietta') || ($category4 == 'Mito') || ($category4 == 'Spider')
						|| ($category4 == 'Stelvio') || ($category4 == 'Inne'))){	
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Aston Martin'){
					if(!(($category4 == 'DB11') || ($category4 == 'DB7') || ($category4 == 'DB9') || ($category4 == 'DBS Superleggera')
						|| ($category4 == 'One-77') || ($category4 == 'Rapide') || ($category4 == 'Vantage') || ($category4 == 'Vanquish')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Audi'){
					if(!(($category4 == '80') || ($category4 == '90') || ($category4 == '100') || ($category4 == '200')
						|| ($category4 == 'A1') || ($category4 == 'A2') || ($category4 == 'A3') || ($category4 == 'A4')
						|| ($category4 == 'A5') || ($category4 == 'A6') || ($category4 == 'A7') || ($category4 == 'A8')
						|| ($category4 == 'S1') || ($category4 == 'S2') || ($category4 == 'S3') || ($category4 == 'S4')
						|| ($category4 == 'S5') || ($category4 == 'S6') || ($category4 == 'S7') || ($category4 == 'S8')
						|| ($category4 == 'RS1') || ($category4 == 'RS2') || ($category4 == 'RS3') || ($category4 == 'RS4')
						|| ($category4 == 'RS5') || ($category4 == 'RS6') || ($category4 == 'RS7') || ($category4 == 'RS8')														
						|| ($category4 == 'Q1') || ($category4 == 'Q2') || ($category4 == 'Q3') || ($category4 == 'Q4')
						|| ($category4 == 'Q5') || ($category4 == 'Q6') || ($category4 == 'Q7') || ($category4 == 'Q8')
						|| ($category4 == 'E-Tron') || ($category4 == 'TT') || ($category4 == 'R8') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Bentley'){
					if(!(($category4 == 'Bentayga') || ($category4 == 'Continental') || ($category4 == 'Flying Spur')
						|| ($category4 == 'Mulsanne') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'BMW'){
					if(!(($category4 == 'M1') || ($category4 == 'M2') || ($category4 == 'M3') || ($category4 == 'M4')
						|| ($category4 == 'M5') || ($category4 == 'M6') || ($category4 == 'M7') || ($category4 == 'M8')
						|| ($category4 == 'Seria 1') || ($category4 == 'Seria 2') || ($category4 == 'Seria 3') || ($category4 == 'Seria 4')
						|| ($category4 == 'Seria 5') || ($category4 == 'Seria 6') || ($category4 == 'Seria 7') || ($category4 == 'Seria 8')
						|| ($category4 == 'i3') || ($category4 == 'i8') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	

				if($category3 == 'Bugatti'){
					if(!(($category4 == 'Veyron') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	

				if($category3 == 'Cadilac'){
					if(!(($category4 == 'ATS') || ($category4 == 'CT6') || ($category4 == 'CTS') || ($category4 == 'ELR')
						|| ($category4 == 'Escalade') || ($category4 == 'SLS') || ($category4 == 'SRX') || ($category4 == 'XT5')
						|| ($category4 == 'XTS') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				

				if($category3 == 'Chevrolet'){
					if(!(($category4 == 'Aveo') || ($category4 == 'Camaro') || ($category4 == 'Captiva') || ($category4 == 'Cruze')
						|| ($category4 == 'Epica') || ($category4 == 'Evanda') || ($category4 == 'Lacetti') || ($category4 == 'Malibu')
						|| ($category4 == 'Orlando') || ($category4 == 'Spark') || ($category4 == 'Tacuma') || ($category4 == 'Trax')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	

				if($category3 == 'Chrysler'){
					if(!(($category4 == '300C') || ($category4 == '300M') || ($category4 == 'Caravan') || ($category4 == 'Intrepid')
						|| ($category4 == 'Neon') || ($category4 == 'PT Cruiser') || ($category4 == 'Sebring') || ($category4 == 'Stratus')
						|| ($category4 == 'Town Country') || ($category4 == 'Vision') || ($category4 == 'Voyager')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}

				if($category3 == 'Citroen'){
					if(!(($category4 == 'Berlingo') || ($category4 == 'C-Elysee') || ($category4 == 'C1') || ($category4 == 'C2')
						|| ($category4 == 'C3') || ($category4 == 'C4') || ($category4 == 'C4 Aircross') || ($category4 == 'C4 Cactus')
						|| ($category4 == 'C4 Picasso') || ($category4 == 'C5') || ($category4 == 'C5 Aircross') || ($category4 == 'C6')
						|| ($category4 == 'C8') || ($category4 == 'DS3') || ($category4 == 'DS4') || ($category4 == 'DS5')
						|| ($category4 == 'Evasion') || ($category4 == 'Nemo') || ($category4 == 'Saxo') || ($category4 == 'XM')
						|| ($category4 == 'Xantia') || ($category4 == 'Xsara') || ($category4 == 'Xsara Picasso') 
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Dacia'){
					if(!(($category4 == 'Dokker') || ($category4 == 'Duster') || ($category4 == 'Lodgy') || ($category4 == 'Logan')
						|| ($category4 == 'Nova') || ($category4 == 'Sandero') || ($category4 == 'Sandero Stepway')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Daewoo'){
					if(!(($category4 == 'Espero') || ($category4 == 'Kalos') || ($category4 == 'Lanos') || ($category4 == 'Leganza')
						|| ($category4 == 'Matiz') || ($category4 == 'Nubira') || ($category4 == 'Rezzo') || ($category4 == 'Tacuma') 
						|| ($category4 == 'Tico') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Daihatsu'){
					if(!(($category4 == 'Coure') || ($category4 == 'Esse') || ($category4 == 'Feroza') || ($category4 == 'Sirion')
						|| ($category4 == 'Terios') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Dodge'){
					if(!(($category4 == 'Avenger') || ($category4 == 'Caliber') || ($category4 == 'Caravan')
						|| ($category4 == 'Challenger') || ($category4 == 'Charger') || ($category4 == 'Durango') 
						|| ($category4 == 'Grand Caravan') || ($category4 == 'Magnum') || ($category4 == 'Nitro')
						|| ($category4 == 'Ram') || ($category4 == 'Stratus') || ($category4 == 'Viper') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Ferrari'){
					if(!(($category4 == '458') || ($category4 == '488') || ($category4 == 'California') || ($category4 == 'F12')
						|| ($category4 == 'F40') || ($category4 == 'F8') || ($category4 == 'Portofino') || ($category4 == 'Testarossa')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Fiat'){
					if(!(($category4 == '125p') || ($category4 == '126p') || ($category4 == '500') || ($category4 == 'Albea') || ($category4 == 'Barchetta')
						|| ($category4 == 'Brava') || ($category4 == 'Bravo') || ($category4 == 'Cinquecento') || ($category4 == 'Coupe')
						|| ($category4 == 'Doblo') || ($category4 == 'Ducato') || ($category4 == 'Idea') || ($category4 == 'Linea') 
						|| ($category4 == 'Marea') || ($category4 == 'Multipla') || ($category4 == 'Palio') || ($category4 == 'Panda')
						|| ($category4 == 'Punto') || ($category4 == 'Qubo') || ($category4 == 'Scudo') || ($category4 == 'Seicento') 
						|| ($category4 == 'Siena') || ($category4 == 'Stilo') || ($category4 == 'Tipo') || ($category4 == 'Ulysse') 
						|| ($category4 == 'Uno') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Ford'){
					if(!(($category4 == 'Active') || ($category4 == 'Cougar') || ($category4 == 'EcoSport') || ($category4 == 'Edge')
						|| ($category4 == 'Escort') || ($category4 == 'Explorer') || ($category4 == 'Fiesta') || ($category4 == 'Focus')
						|| ($category4 == 'Fusion') || ($category4 == 'GT') || ($category4 == 'Galaxy') || ($category4 == 'Granada') 
						|| ($category4 == 'Ka') || ($category4 == 'Kuga') || ($category4 == 'Maverick') || ($category4 == 'Mondeo')
						|| ($category4 == 'Mustang') || ($category4 == 'Orion') || ($category4 == 'Puma') || ($category4 == 'Ranger') 
						|| ($category4 == 'Raptor') || ($category4 == 'S-Max') || ($category4 == 'Scorpio') || ($category4 == 'Sierra')
						|| ($category4 == 'Streetka') || ($category4 == 'Tourneo') || ($category4 == 'Transit') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";			
					}
				}	
				
				if($category3 == 'Honda'){
					if(!(($category4 == 'Accord') || ($category4 == 'CR-V') || ($category4 == 'CR-Z') || ($category4 == 'CRX')
						|| ($category4 == 'CR-Z') || ($category4 == 'City') || ($category4 == 'Civic') || ($category4 == 'HR-V') || ($category4 == 'Jazz')
						|| ($category4 == 'Legend') || ($category4 == 'Logo') || ($category4 == 'NSX') || ($category4 == 'S 2000')
						|| ($category4 == 'TypeR') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Hyundai'){
					if(!(($category4 == 'Accent') || ($category4 == 'Atos') || ($category4 == 'Coupe') || ($category4 == 'Elantra')
						|| ($category4 == 'Galloper') || ($category4 == 'Getz') || ($category4 == 'H1') || ($category4 == 'H200') 
						|| ($category4 == 'Kona') || ($category4 == 'Lantra') || ($category4 == 'Matrix') || ($category4 == 'Santa Fe') 
						|| ($category4 == 'Sonata') || ($category4 == 'Terracan') || ($category4 == 'Trajet') || ($category4 == 'Tucson')
						|| ($category4 == 'Veloster') || ($category4 == 'XG') || ($category4 == 'i10') || ($category4 == 'i20')
						|| ($category4 == 'i30') || ($category4 == 'i40') || ($category4 == 'ix20') || ($category4 == 'ix35')
						|| ($category4 == 'ix55') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Infiniti'){
					if(!(($category4 == 'EX'	) || ($category4 == 'FX'	) || ($category4 == 'G') || ($category4 == 'Q30')
						|| ($category4 == 'Q40') || ($category4 == 'Q50') || ($category4 == 'Q60') || ($category4 == 'Q70')
						|| ($category4 == 'QX30') || ($category4 == 'QX50') || ($category4 == 'QX60') || ($category4 == 'QX70')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Jaguar'){
					if(!(($category4 == 'E-Pace')  || ($category4 == 'F-Pace') || ($category4 == 'F-Type')
						|| ($category4 == 'I-Pace') || ($category4 == 'S-Type') || ($category4 == 'XE') || ($category4 == 'XF')
						|| ($category4 == '>XJ') || ($category4 == 'XJR') || ($category4 == 'XKR') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Jeep'){
					if(!(($category4 == 'Commander') || ($category4 == 'Compass') || ($category4 == 'Grand Cherokee')
						|| ($category4 == 'Liberty') || ($category4 == 'Patriot') || ($category4 == 'Renegade') 
						|| ($category4 == 'Wrangler') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Kia'){
					if(!(($category4 == 'Carens') || ($category4 == 'Carnival') || ($category4 == 'Ceed') || ($category4 == 'Ceed GT')
						|| ($category4 == 'Cerato') || ($category4 == 'Magentis') || ($category4 == 'Niro') || ($category4 == 'Optima')
						|| ($category4 == 'Picanto') || ($category4 == 'Retona') || ($category4 == 'Sephia') || ($category4 == 'Sorento')
						|| ($category4 == 'Soul') || ($category4 == 'Sportage') || ($category4 == 'Stinger') || ($category4 == 'Stonic')
						|| ($category4 == 'Venga') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Lamborghini'){
					if(!(($category4 == 'Aventador') || ($category4 == 'Gallardo') || ($category4 == 'Huracan')
						|| ($category4 == 'Murcielago') || ($category4 == 'Reventon') || ($category4 == 'Urus')
						|| ($category4 == 'Veneno') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Lancia'){
					if(!(($category4 == 'Delta') || ($category4 == 'Kappa') || ($category4 == 'Lybra') || ($category4 == 'Musa') 
						|| ($category4 == 'Phedra') || ($category4 == 'Still') || ($category4 == 'Thema') || ($category4 == 'Thesis')
						|| ($category4 == 'Voyager') || ($category4 == 'Ypsilon') || ($category4 == 'Zeta') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Land Rover'){
					if(!(($category4 == 'Discovery') || ($category4 == 'Discovery Sport') || ($category4 == 'Freelander')
						|| ($category4 == 'Range Rover') || ($category4 == 'Range Rover Evoque')
						|| ($category4 == 'Range Rover Sport') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Lexus'){
					if(!(($category4 == 'CT') || ($category4 == 'ES300') || ($category4 == 'GS300') || ($category4 == 'GS450')
						|| ($category4 == 'IS200') || ($category4 == 'IS220') || ($category4 == 'IS250') || ($category4 == 'LC')
						|| ($category4 == 'LS') || ($category4 == 'NX') || ($category4 == 'RC') || ($category4 == 'RX300') 
						|| ($category4 == 'RX350') || ($category4 == 'RX400') || ($category4 == 'SC') || ($category4 == 'UX'	)
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Lincoln'){
					if(!(($category4 == 'Aviator') || ($category4 == 'MKC') || ($category4 == 'MKS') || ($category4 == 'MKT')
						|| ($category4 == 'MKX') || ($category4 == 'MKZ') || ($category4 == 'Nautilus') || ($category4 == 'Navigator')
						|| ($category4 == 'Town Car') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Lotus'){
					if(!(($category4 == 'Elise') || ($category4 == 'Evora') || ($category4 == 'Exige') 
						|| ($category4 == 'Exige S') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Maserati'){
					if(!(($category4 == 'Ghibli') || ($category4 == 'GranCabrio') || ($category4 == 'GranTurismo') 
						|| ($category4 == 'Levante') || ($category4 == 'Quattroporte') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Mazda'){
					if(!(($category4 == '2') || ($category4 == '3') || ($category4 == '323F') || ($category4 == '4')
						|| ($category4 == '5') || ($category4 == '6') || ($category4 == '121') || ($category4 == '323') 
						|| ($category4 == '626') || ($category4 == '929') || ($category4 == 'BT-50') || ($category4 == 'CX-3')
						|| ($category4 == 'CX-5') || ($category4 == 'CX-7') || ($category4 == 'CX-9') || ($category4 == 'Demio')
						|| ($category4 == 'MPV') || ($category4 == 'MX-2') || ($category4 == 'MX-5') || ($category4 == 'MX-6') 
						|| ($category4 == 'Millenia') || ($category4 == 'Premacy') || ($category4 == 'Protege') || ($category4 == 'RX-6')
						|| ($category4 == 'RX-7') || ($category4 == 'RX-8') || ($category4 == 'Tribute')
						|| ($category4 == 'Xedos') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'McLaren'){
					if(!(($category4 == '540C') || ($category4 == '570GT') || ($category4 == '570S') || ($category4 == '570S Spider') 
						|| ($category4 == '600LT') || ($category4 == '600LT Spider') || ($category4 == '720S') || ($category4 == '720S Spider')
						|| ($category4 == 'F1') || ($category4 == 'GT') || ($category4 == 'P1') || ($category4 == 'Senna')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Mercedes'){
					if(!(($category4 == 'AMG') || ($category4 == 'CLA') || ($category4 == 'Citan') || ($category4 == 'EQC') 
						|| ($category4 == 'GL') || ($category4 == 'GLA') || ($category4 == 'GLB') || ($category4 == 'GLC')
						|| ($category4 == 'GLE') || ($category4 == 'GLS') || ($category4 == 'Klasa A') || ($category4 == 'Klasa B') 
						|| ($category4 == 'Klasa C') || ($category4 == 'Klasa E') || ($category4 == 'Klasa G') || ($category4 == 'Klasa S')
						|| ($category4 == 'Klasa V') || ($category4 == 'Klasa X') || ($category4 == 'ML') || ($category4 == 'SL') 
						|| ($category4 == 'SLC') || ($category4 == 'ML') || ($category4 == 'SLK') || ($category4 == 'Vaneo')
						|| ($category4 == 'Viano') || ($category4 == 'Vito') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'MicroCar'){
					if(!(($category4 == 'Aixam') || ($category4 == 'Chatenet') || ($category4 == 'Grecav') || ($category4 == 'Ligier') 
						|| ($category4 == 'M.Go') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Mini'){
					if(!(($category4 == 'Cabrio') || ($category4 == 'Clubman') || ($category4 == 'Cooper') 
						|| ($category4 == 'Cooper S') || ($category4 == 'Countryman')
						|| ($category4 == 'One') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Mitsubishi'){
					if(!(($category4 == 'ASX') || ($category4 == 'Carisma') || ($category4 == 'Colt') || ($category4 == 'Eclipse') 
						|| ($category4 == 'Eclipse Cross') || ($category4 == 'Endeavor') || ($category4 == 'Galant') || ($category4 == 'Grandis')
						|| ($category4 == 'L200') || ($category4 == 'L400') || ($category4 == 'Lancer Evolution VI')
						|| ($category4 == 'Lancer Evolution VII') || ($category4 == 'Lancer Evolution VIII')
						|| ($category4 == 'Lancer Evolution IX') || ($category4 == 'Lancer Evolution X') || ($category4 == 'Montero')
						|| ($category4 == 'Outlander') || ($category4 == 'Outlander PHEV') || ($category4 == 'Pajero') 
						|| ($category4 == 'Pajero Pinin') || ($category4 == 'Sigma') || ($category4 == 'Space Gear')
						|| ($category4 == 'Space Runner') || ($category4 == 'Space Star') || ($category4 == 'Space Wagon')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Nissan'){
					if(!(($category4 == '100 NX') || ($category4 == '200 SX') || ($category4 == '300 ZX') || ($category4 == '350Z') 
						|| ($category4 == '370Z') || ($category4 == '370Z Nismo') || ($category4 == '370Z Roadster') || ($category4 == 'Almera') 
						|| ($category4 == 'Almera Tino') || ($category4 == 'Altima') || ($category4 == 'E-NV200') || ($category4 == 'E-NV200 Evalia')
						|| ($category4 == 'Frontier') || ($category4 == 'GT-R'	) || ($category4 == '>GT-R Nismo') || ($category4 == 'Juke')
						|| ($category4 == 'King Cab') || ($category4 == 'Leaf') || ($category4 == 'Maxima') || ($category4 == 'Micra')
						|| ($category4 == 'Murano') || ($category4 == 'NV200') || ($category4 == 'Navara') || ($category4 == 'Note')
						|| ($category4 == 'Patrol') || ($category4 == 'Pickup') || ($category4 == 'Primera') || ($category4 == 'Pulsar')
						|| ($category4 == 'Qashqai') || ($category4 == 'Quest') || ($category4 == 'Rogue') || ($category4 == 'Serena') 
						|| ($category4 == 'Skyline') || ($category4 == 'Titan') || ($category4 == 'X-Trail') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Opel'){
					if(!(($category4 == 'Adam') || ($category4 == 'Agila') || ($category4 == 'Antara') || ($category4 == 'Astra')
						|| ($category4 == 'Calibra') || ($category4 == 'Campo') || ($category4 == 'Cascada') || ($category4 == 'Combo')
						|| ($category4 == 'Corsa') || ($category4 == 'Frontera') || ($category4 == 'GT') || ($category4 == 'Insignia')
						|| ($category4 == 'Kadett') || ($category4 == 'Meriva') || ($category4 == 'Mokka') || ($category4 == 'Monterey')
						|| ($category4 == 'Movano') || ($category4 == 'Omega') || ($category4 == 'Signum') || ($category4 == 'Sintra')
						|| ($category4 == 'Tigra') || ($category4 == 'Vectra') || ($category4 == 'Vivaro')
						|| ($category4 == 'Zafira') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Peugeot'){
					if(!(($category4 == '108') || ($category4 == '205') || ($category4 == '206') || ($category4 == '207')
						|| ($category4 == '208') || ($category4 == '301') || ($category4 == '108') || ($category4 == '308')
						|| ($category4 == '405') || ($category4 == '406') || ($category4 == '407') || ($category4 == '508') 
						|| ($category4 == '607') || ($category4 == '806') || ($category4 == '807') || ($category4 == '1007') 
						|| ($category4 == '2008') || ($category4 == '3008') || ($category4 == '4007') || ($category4 == '4008') 
						|| ($category4 == '5008') || ($category4 == 'Bipper') || ($category4 == 'Boxer') || ($category4 == 'E-208')
						|| ($category4 == 'Expert') || ($category4 == 'Partner') || ($category4 == 'RCZ') || ($category4 == 'Rifter')
						|| ($category4 == 'Traveller') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Polonez'){
					if(!(($category4 == 'Atu') || ($category4 == 'Atu Plus') || ($category4 == 'Caro')
						|| ($category4 == 'Caro Plus') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Porsche'){
					if(!(($category4 == '718') || ($category4 == '911') || ($category4 == '944')
						|| ($category4 == 'Cayenne') || ($category4 == 'Cayman') || ($category4 == 'E-Performance')
						|| ($category4 == 'Macan') || ($category4 == 'Panamera') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Renault'){
					if(!(($category4 == 'Avantime') || ($category4 == 'Captur') || ($category4 == 'Clio') || ($category4 == 'Escape')
						|| ($category4 == 'Fluence') || ($category4 == 'Grand Escape') || ($category4 == 'Grand Scenic') 
						|| ($category4 == 'Scenic') || ($category4 == 'Scenic Conquest') || ($category4 == 'Scenic RX4')
						|| ($category4 == 'Kadjar') || ($category4 == 'Kangoo') || ($category4 == 'Koleos') 
						|| ($category4 == 'Laguna') || ($category4 == 'Latitude') || ($category4 == 'Master') 
						|| ($category4 == 'Megane') || ($category4 == 'Megane RS') || ($category4 == 'Modus')
						|| ($category4 == 'Talisman') || ($category4 == 'Thalia') || ($category4 == 'Trafic') || ($category4 == 'Twingo')
						|| ($category4 == 'Twizy') || ($category4 == 'Vel Satis') || ($category4 == 'Wind') || ($category4 == 'ZOE')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Rolls Royce'){
					if(!(($category4 == 'Ghost') || ($category4 == 'Phantom') || ($category4 == 'Wraith')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Rover'){
					if(!(($category4 == '25') || ($category4 == '45') || ($category4 == '75') || ($category4 == '200')
						|| ($category4 == '214') || ($category4 == '400') || ($category4 == '414') || ($category4 == '416')
						|| ($category4 == '420') || ($category4 == '600') || ($category4 == '620') || ($category4 == 'MG') 
						|| ($category4 == 'Streetwise') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Saab'){
					if(!(($category4 == '9-5') || ($category4 == '900') || ($category4 == '9000') || ($category4 == '9-3') 
						|| ($category4 == '9-7X') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Seat'){
					if(!(($category4 == 'Alhambra') || ($category4 == 'Altea') || ($category4 == 'Altea XL') 
						|| ($category4 == 'Arona') || ($category4 == 'Arosa') || ($category4 == 'Ateca') 
						|| ($category4 == 'Cordoba') || ($category4 == 'Exeo') || ($category4 == 'Ibiza') || ($category4 == 'Inca')
						|| ($category4 == 'Leon') || ($category4 == 'Leon Cupra') || ($category4 == 'Leon Sportourer ST')
						|| ($category4 == 'Mii') || ($category4 == 'Tarraco') || ($category4 == 'Toledo') 
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Skoda'){
					if(!(($category4 == '105') || ($category4 == '120') || ($category4 == 'Citigo') || ($category4 == 'Fabia')
						|| ($category4 == 'Favorit') || ($category4 == 'Felicia') || ($category4 == 'Kamiq') || ($category4 == 'Karoq') 
						|| ($category4 == 'Kodiaq') || ($category4 == 'Octavia') || ($category4 == 'Rapid') || ($category4 == 'Roomster')
						|| ($category4 == 'Scala') || ($category4 == 'Superb') || ($category4 == 'Yeti')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Smart'){
					if(!(($category4 == 'Fortwo') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'SsangYong'){
					if(!(($category4 == 'Actyon') || ($category4 == 'Korando') || ($category4 == 'Kyron') || ($category4 == 'Musso')
						|| ($category4 == 'Rexton') || ($category4 == 'Rodius') || ($category4 == 'Tivoli') || ($category4 == 'XLV')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}	
				
				if($category3 == 'Subaru'){
					if(!(($category4 == 'B9 Tribeca') || ($category4 == 'BRZ') || ($category4 == 'Forester')
						|| ($category4 == 'Impreza') || ($category4 == 'Justy') || ($category4 == 'Legacy') 
						|| ($category4 == 'Levorg') || ($category4 == 'Outback') || ($category4 == 'Tribeca')
						|| ($category4 == 'WRX') || ($category4 == 'XV') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Suzuki'){
					if(!(($category4 == 'Alto') || ($category4 == 'Baleno') || ($category4 == 'Celerio') || ($category4 == 'Grand Vitara')
						|| ($category4 == 'Ignis') || ($category4 == 'Jimny') || ($category4 == 'Liana') || ($category4 == 'SJ')
						|| ($category4 == 'SX4') || ($category4 == 'SX4 S-Cross') || ($category4 == 'Samurai')
						|| ($category4 == 'Splash') || ($category4 == 'Swift') || ($category4 == 'Swift Sport')
						|| ($category4 == 'Vitara') || ($category4 == 'Wagon') || ($category4 == 'X-90') || ($category4 == 'XL7')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Tesla'){
					if(!(($category4 == 'Model 3') || ($category4 == 'Model S') || ($category4 == 'Model X') 
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Toyota'){
					if(!(($category4 == '4-Runner') || ($category4 == 'Auris') || ($category4 == 'Avalon') || ($category4 == 'Avensis')
						|| ($category4 == 'Avensis Verso') || ($category4 == 'Aygo') || ($category4 == 'C-HR') || ($category4 == 'Camry')
						|| ($category4 == 'Camry Solara') || ($category4 == 'Carina') || ($category4 == 'Celica')
						|| ($category4 == 'Corolla') || ($category4 == 'FJ') || ($category4 == 'GR Supra') || ($category4 == 'GT86') || ($category4 == 'Highlander') 
						|| ($category4 == 'Hilux') || ($category4 == 'Land Cruiser') || ($category4 == 'Highlander') || ($category4 == 'MR2') 
						|| ($category4 == 'Matrix') || ($category4 == 'Mirai') || ($category4 == 'Paseo') || ($category4 == 'Picnic')
						|| ($category4 == 'Previa') || ($category4 == 'Prius') || ($category4 == 'Proace') || ($category4 == 'RAV4')
						|| ($category4 == 'Sienna') || ($category4 == 'Supra') || ($category4 == 'Verso') || ($category4 == 'Yaris Verso')
						|| ($category4 == 'Yaris') || ($category4 == 'iQ') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Volkswagen'){
					if(!(($category4 == 'Arteon') || ($category4 == 'Beetle') || ($category4 == 'Bora')
						|| ($category4 == 'Caddy') || ($category4 == 'California') || ($category4 == 'Caravelle')
						|| ($category4 == 'Corrado') || ($category4 == 'Crafter') || ($category4 == 'E-Golf') || ($category4 == 'Eos')
						|| ($category4 == 'Fox') || ($category4 == 'Garbus') || ($category4 == 'Golf') || ($category4 == 'Golf GTI')
						|| ($category4 == 'Golf Plus') || ($category4 == 'Golf Sportsvan') || ($category4 == 'Jetta')
						|| ($category4 == 'Lupo') || ($category4 == 'Multivan') || ($category4 == 'New Beetle') 
						|| ($category4 == 'Passat') || ($category4 == 'Passat CC') || ($category4 == 'Passat W8')
						|| ($category4 == 'Phaeton') || ($category4 == 'Polo') || ($category4 == 'Polo GTI') || ($category4 == 'Routan')
						|| ($category4 == 'Scirocco') || ($category4 == 'Sharan') || ($category4 == 'T-Cross') || ($category4 == 'T-Roc')
						|| ($category4 == 'Tiguan') || ($category4 == 'Tiguan Allspace') || ($category4 == 'Touareg') || ($category4 == 'Touran') 
						|| ($category4 == 'Transporter') || ($category4 == 'Up!')
						|| ($category4 == 'Vento') || ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				
				if($category3 == 'Volvo'){
					if(!(($category4 == 'C30') || ($category4 == 'C70') || ($category4 == 'S40') || ($category4 == 'S60')
						|| ($category4 == 'S70') || ($category4 == 'S80') || ($category4 == 'S90') || ($category4 == 'Seria 200') 
						|| ($category4 == 'Seria 400') || ($category4 == 'Seria 700') || ($category4 == 'Seria 800') 
						|| ($category4 == 'Seria 900') || ($category4 == 'V40') || ($category4 == 'V50') || ($category4 == 'V60') 
						|| ($category4 == 'V70') || ($category4 == 'V90') || ($category4 == 'XC40') || ($category4 == 'XC50')
						|| ($category4 == 'XC60') || ($category4 == 'XC70') || ($category4 == 'XC80') || ($category4 == 'XC90')
						|| ($category4 == 'Inne'))){
						$ok = false;
						$_SESSION['eogl_category'] = "Wybierz kategorię 4";
					}
				}
				$moc = $_POST['Moc_silnika'];
				if(strlen($moc) == 0){
					$ok = false;
					$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podaj moc silnika w KM!";
					//echo "</br>nie 831";
				}
				if(!(preg_match('/^[0-9]+$/', $moc))){
					$ok = false;
					$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być całkowita, dodatnia!";
					//echo "</br>nie 835";
				}else{
					if(!(int)$moc > 0){
						$ok = false;
						$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być większa od 0!";
						//echo "</br>nie 839";
					}
				}
				$pojemnosc = $_POST['Poj_silnika'];
				if(strlen($pojemnosc) == 0){
					$ok = false;
					$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podaj pojemność silnika w cm3!";
					//echo "</br>nie 845";
				}
				if(!(preg_match('/^[0-9]+$/', $pojemnosc))){
					$ok = false;
					$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podana liczba musi być całkowita, dodatnia!";
					//echo "</br>nie 849";
				}else{
					if(!(int)$pojemnosc > 0){
						$ok = false;
						$_SESSION['eogl_pojemnosc'] =  "Pojemność silnika: Podana liczba musi być większa od 0!";
						//echo "</br>nie 853";
					}
				}
				$rok = $_POST['Rok_produkcji'];
				if(strlen($rok) == 0){
					$ok = false;
					$_SESSION['eog_rok'] = "Rok produkcji: Podaj rok produkcji!";
					//echo "</br>nie 859";
				}
				if(!(preg_match('/^[0-9]+$/', $rok))){
					$ok = false;
					$_SESSION['eogl_rok'] = "Rok produkcji: Podana liczba musi być całkowita, dodatnia!";
					//echo "</br>nie 862";
				}else{
					if(!(int)$rok > 0){
						$ok = false;
						$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba musi być większa od 0!";
						//echo "</br>nie 867";
					}
					if((int)$rok > 9999){
						$ok = false;
						$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba nie może być większa niż 9999!";
						//echo "</br>nie 871";
					}
				}
				$przebieg = $_POST['Przebieg'];
				if(strlen($przebieg) == 0){
					$ok = false;
					$_SESSION['eogl_przebieg'] = "Przebieg: Podaj przebieg!";
					//echo "</br>nie 876";
				}
				if (!(preg_match('/^[0-9]+$/', $przebieg))){
					$ok = false;
					$_SESSION['eogl_przebieg'] = "Przebieg: Podana liczba musi być całkowita, dodatnia!";
					//echo "</br>nie 881";
				}
				$nadwozie = $_POST['Nadwozie'];
				if(!(($nadwozie == 'Coupe') || ($nadwozie == 'Hatchback') || ($nadwozie == 'Kabriolet') || 
					($nadwozie == 'Kombi') || ($nadwozie == 'Minivan') || ($nadwozie == 'Pickup') || 
					($nadwozie == 'Sedan') || ($nadwozie == 'Suv') || ($nadwozie == 'Terenowy') || 
					($nadwozie == 'Van'))){
					$ok = false;
					$_SESSION['eogl_nadwozie'] = "Wybierz typ nadwozia pojazdu";
					//echo "</br>nie 889";
				}

				$paliwo = $_POST['Paliwo'];
				if(!(($paliwo == 'Benzyna') || ($paliwo == 'Benzyna+LPG') || ($paliwo == 'Diesel') || 
					($paliwo == 'Hybryda(Benzyna)') || ($paliwo == 'Hybryda(Diesel)') || ($paliwo == 'Elektryczny'))){
					$ok = false;
					$_SESSION['eogl_paliwo'] = "Wybierz typ paliwa";
					//echo "</br>nie 896";
				}
				
				$skrzynia = $_POST['Skrzynia_biegow'];
				if(!(($skrzynia == 'Automatyczna') || ($skrzynia == 'Manualna') || ($skrzynia == 'Sekwencyjna'))){
					$ok = false;
					$_SESSION['eogl_skrzynia'] = "Wybierz skrzynie biegów";
					//echo "</br>nie 902";
				}
				
				$kolor = $_POST['Kolor'];
				if(!(($kolor == 'Bialy') || ($kolor == 'Czarny') || ($kolor == 'Czerwony')
				|| ($kolor == 'Niebieski') || ($kolor == 'Srebny') || ($kolor == 'Szary') 
				|| ($kolor == 'Zielony') || ($kolor == 'Zolty') || ($kolor == 'Inny'))){
					$ok = false;
					//echo "</br>nie 909";
					$_SESSION['eogl_kolor'] = "Wybierz kolor pojazdu";
				}
				
				$stantechniczny = $_POST['Stan_techniczny'];
				if(!(($stantechniczny == 'Nieuszkodzony') || ($stantechniczny == 'Uszkodzony'))){
					//echo "</br>nie 914";
					$ok = false;
					$_SESSION['eogl_stantechniczny'] = "Wybierz stan techniczny pojazdu";
				}			

				$stanuzytkowy = $_POST['Stan_uzytkowy'];
				if(!(($stanuzytkowy == 'Nowy') || ($stanuzytkowy == 'Uzywany'))){
					//echo "</br>nie 920";
					$ok = false;
					$_SESSION['eogl_stanuzytkowy'] = "Wybierz stan użytkowy pojazdu";
				}
				if(isset($_POST['wyp'])){
					$wyposazenie = $_POST['wyp']; 
					foreach ($wyposazenie as $obecne){
						if(($obecne == 'ABS') || ($obecne == 'ASR') || ($obecne == 'Alarm') || ($obecne == 'Alufelgi')
							|| ($obecne == 'Asystent pasa ruchu') || ($obecne == 'Bluetooth') || ($obecne == 'CD') || ($obecne == 'Czujnik deszczu')
							|| ($obecne == 'Czujnik zmierzchu') || ($obecne == 'Czujniki parkowania') || ($obecne == 'ESP') || ($obecne == 'Elektryczne fotele')
							|| ($obecne == 'Elektryczne lusterka') || ($obecne == 'Elektryczne szyby') || ($obecne == 'EDL') 
							|| ($obecne == 'Fotochromatyczne lusterka boczne') || ($obecne == 'Fotochromatyczne lusterko wsteczne') 
							|| ($obecne == 'Hak') || ($obecne == 'Isofix') || ($obecne == 'Kierownica wielofunkcyjna') 
							|| ($obecne == 'Klimatyzacja') || ($obecne == 'Komputer pokładowy') || ($obecne == 'MP3') 
							|| ($obecne == 'Odtwarzacz DVD') || ($obecne == 'Podgrzewana przednia szyba') || ($obecne == 'Podgrzewane fotele')
							|| ($obecne == 'Poduszki powietrzne') || ($obecne == 'Radio fabryczne') || ($obecne == 'Regulacja wysokości podwozia')
							|| ($obecne == 'Relingi dachowe') || ($obecne == 'Skórzana tapicerka') || ($obecne == 'Szyberdach')
							|| ($obecne == 'Tempomat') || ($obecne == 'Tempomat aktywny') || ($obecne == 'Webasto') 
							|| ($obecne == 'Wspomaganie kierownicy') || ($obecne == 'Wzmacniacz audio')  || ($obecne == 'Przyciemniane szyby')
							|| ($obecne == 'Zmieniarka CD') || ($obecne == 'Nawigacja')
							|| ($obecne == 'Xenony') || ($obecne == 'Światła do jazdy dziennej')){
							if(isset($listaobecne)){
								$listaobecne = $listaobecne.", ".$obecne.", ";
								$_SESSION['addogl_wyposazenie'] = $listaobecne;
							}else{
								$listaobecne = $obecne;
								$_SESSION['addogl_wyposazenie'] = $listaobecne;
							}
						}else{
							//echo "</br>nie 965";
							$ok = false;
							$_SESSION['eogl_obecne'] = "Wybierz poprawne wyposażenie pojazdu";
						}
					}
				}
				if($ok == true){
					$_SESSION['accept'] = true;
					//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
					$_SESSION['addogl_telefon'] = $_POST['Telefon'];
					$_SESSION['addogl_email'] = $_POST['Email'];
					$_SESSION['addogl_woj'] = $_POST['Woj'];
					$_SESSION['addogl_miej'] = $_POST['Miej'];
					//echo	$_SESSION['addogl_opis'] = $opis;
					$_SESSION['addogl_cena'] = $_POST['Cena'];
					$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
					$_SESSION['addogl_category'] = $_POST['category'];
					$_SESSION['addogl_category2'] = $_POST['category2'];
					$_SESSION['addogl_category3'] = $_POST['category3'];
					$_SESSION['addogl_category4'] = $_POST['category4'];
					$_SESSION['addogl_mocsilnika'] = $_POST['Moc_silnika'];
					$_SESSION['addogl_pojsilnika'] = $_POST['Poj_silnika'];
					$_SESSION['addogl_rok'] = $_POST['Rok_produkcji'];
					$_SESSION['addogl_przebieg'] = $_POST['Przebieg'];
					$_SESSION['addogl_nadwozie'] = $_POST['Nadwozie'];
					$_SESSION['addogl_paliwo'] = $_POST['Paliwo'];
					$_SESSION['addogl_skrzynia'] = $_POST['Skrzynia_biegow'];
					$_SESSION['addogl_kolor'] = $_POST['Kolor'];
					$_SESSION['addogl_stantechniczny'] = $_POST['Stan_techniczny'];				
					$_SESSION['addogl_stanuzytkowy'] = $_POST['Stan_uzytkowy'];
					//$_SESSION['addogl_wyposazenie'] = $listaobecne;
					session_write_close();
					header("Location: dodaj-ogloszenie-potwierdz.php");
					exit;
				}else{
					$_SESSION['eogl_error'] = "Prosimy wypełnić wszystkie wymagane pola!";
					//echo "nie 973";
				}
				
		// ---- zabytkowe lub inna marka
		
			}else{
				if(($category3 == 'Zabytkowe') || ($category3 == 'Inna marka')){
					unset($_SESSION['category4']);
					unset($category4);
					$moc = $_POST['Moc_silnika'];
					if(strlen($moc) == 0){
						$ok = false;
						$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podaj moc silnika w KM!";
						//echo "</br>nie 831";
					}
					if(!(preg_match('/^[0-9]+$/', $moc))){
						$ok = false;
						$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być całkowita, dodatnia!";
						//echo "</br>nie 835";
					}else{
						if(!(int)$moc > 0){
							$ok = false;
							$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być większa od 0!";
							//echo "</br>nie 839";
						}
					}
					$pojemnosc = $_POST['Poj_silnika'];
					if(strlen($pojemnosc) == 0){
						$ok = false;
						$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podaj pojemność silnika w cm3!";
						//echo "</br>nie 845";
					}
					if(!(preg_match('/^[0-9]+$/', $pojemnosc))){
						$ok = false;
						$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podana liczba musi być całkowita, dodatnia!";
						//echo "</br>nie 849";
					}else{
						if(!(int)$pojemnosc > 0){
							$ok = false;
							$_SESSION['eogl_pojemnosc'] =  "Pojemność silnika: Podana liczba musi być większa od 0!";
							//echo "</br>nie 853";
						}
					}
					$rok = $_POST['Rok_produkcji'];
					if(strlen($rok) == 0){
						$ok = false;
						$_SESSION['eog_rok'] = "Rok produkcji: Podaj rok produkcji!";
						//echo "</br>nie 859";
					}
					if(!(preg_match('/^[0-9]+$/', $rok))){
						$ok = false;
						$_SESSION['eogl_rok'] = "Rok produkcji: Podana liczba musi być całkowita, dodatnia!";
						//echo "</br>nie 862";
					}else{
						if(!(int)$rok > 0){
							$ok = false;
							$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba musi być większa od 0!";
							//echo "</br>nie 867";
						}
						if((int)$rok > 9999){
							$ok = false;
							$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba nie może być większa niż 9999!";
							//echo "</br>nie 871";
						}
					}
					$przebieg = $_POST['Przebieg'];
					if(strlen($przebieg) == 0){
						$ok = false;
						$_SESSION['eogl_przebieg'] = "Przebieg: Podaj przebieg!";
						//echo "</br>nie 876";
					}
					if (!(preg_match('/^[0-9]+$/', $przebieg))){
						$ok = false;
						$_SESSION['eogl_przebieg'] = "Przebieg: Podana liczba musi być całkowita, dodatnia!";
						//echo "</br>nie 881";
					}
					$nadwozie = $_POST['Nadwozie'];
					if(!(($nadwozie == 'Coupe') || ($nadwozie == 'Hatchback') || ($nadwozie == 'Kabriolet') || 
						($nadwozie == 'Kombi') || ($nadwozie == 'Minivan') || ($nadwozie == 'Pickup') || 
						($nadwozie == 'Sedan') || ($nadwozie == 'Suv') || ($nadwozie == 'Terenowy') || 
						($nadwozie == 'Van'))){
						$ok = false;
						$_SESSION['eogl_nadwozie'] = "Wybierz typ nadwozia pojazdu";
						//echo "</br>nie 889";
					}

					$paliwo = $_POST['Paliwo'];
					if(!(($paliwo == 'Benzyna') || ($paliwo == 'Benzyna+LPG') || ($paliwo == 'Diesel') || ($paliwo == 'Elektryczny') || 
						($paliwo == 'Hybryda(Benzyna)') || ($paliwo == 'Hybryda(Diesel)'))){
						$ok = false;
						$_SESSION['eogl_paliwo'] = "Wybierz typ paliwa";
						//echo "</br>nie 896";
					}
					
					$skrzynia = $_POST['Skrzynia_biegow'];
					if(!(($skrzynia == 'Automatyczna') || ($skrzynia == 'Manualna') || ($skrzynia == 'Sekwencyjna'))){
						$ok = false;
						$_SESSION['eogl_skrzynia'] = "Wybierz skrzynie biegów";
						//echo "</br>nie 902";
					}
					
					$kolor = $_POST['Kolor'];
					if(!(($kolor == 'Bialy') || ($kolor == 'Czarny') || ($kolor == 'Czerwony')
					|| ($kolor == 'Niebieski') || ($kolor == 'Srebny') || ($kolor == 'Szary') 
					|| ($kolor == 'Zielony') || ($kolor == 'Zolty') || ($kolor == 'Inny'))){
						$ok = false;
						//echo "</br>nie 909";
						$_SESSION['eogl_kolor'] = "Wybierz kolor pojazdu";
					}
					
					$stantechniczny = $_POST['Stan_techniczny'];
					if(!(($stantechniczny == 'Nieuszkodzony') || ($stantechniczny == 'Uszkodzony'))){
						//echo "</br>nie 914";
						$ok = false;
						$_SESSION['eogl_stantechniczny'] = "Wybierz stan techniczny pojazdu";
					}			

					$stanuzytkowy = $_POST['Stan_uzytkowy'];
					if(!(($stanuzytkowy == 'Nowy') || ($stanuzytkowy == 'Uzywany'))){
						//echo "</br>nie 920";
						$ok = false;
						$_SESSION['eogl_stanuzytkowy'] = "Wybierz stan użytkowy pojazdu";
					}
					if(isset($_POST['wyp'])){
						$wyposazenie = $_POST['wyp']; 
						foreach ($wyposazenie as $obecne){
							if(($obecne == 'ABS') || ($obecne == 'ASR') || ($obecne == 'Alarm') || ($obecne == 'Alufelgi')
								|| ($obecne == 'Asystent pasa ruchu') || ($obecne == 'Bluetooth') || ($obecne == 'CD') || ($obecne == 'Czujnik deszczu')
								|| ($obecne == 'Czujnik zmierzchu') || ($obecne == 'Czujniki parkowania') || ($obecne == 'ESP') || ($obecne == 'Elektryczne fotele')
								|| ($obecne == 'Elektryczne lusterka') || ($obecne == 'Elektryczne szyby') || ($obecne == 'EDL') 
								|| ($obecne == 'Fotochromatyczne lusterka boczne') || ($obecne == 'Fotochromatyczne lusterko wsteczne') 
								|| ($obecne == 'Hak') || ($obecne == 'Isofix') || ($obecne == 'Kierownica wielofunkcyjna') 
								|| ($obecne == 'Klimatyzacja') || ($obecne == 'Komputer pokładowy') || ($obecne == 'MP3') 
								|| ($obecne == 'Odtwarzacz DVD') || ($obecne == 'Podgrzewana przednia szyba') || ($obecne == 'Podgrzewane fotele')
								|| ($obecne == 'Poduszki powietrzne') || ($obecne == 'Radio fabryczne') || ($obecne == 'Regulacja wysokości podwozia')
								|| ($obecne == 'Relingi dachowe') || ($obecne == 'Skórzana tapicerka') || ($obecne == 'Szyberdach')
								|| ($obecne == 'Tempomat') || ($obecne == 'Tempomat aktywny') || ($obecne == 'Webasto') 
								|| ($obecne == 'Wspomaganie kierownicy') || ($obecne == 'Wzmacniacz audio')  || ($obecne == 'Przyciemniane szyby')
								|| ($obecne == 'Zmieniarka CD') || ($obecne == 'Nawigacja')
								|| ($obecne == 'Xenony') || ($obecne == 'Światła do jazdy dziennej')){
								if(isset($listaobecne)){
									$listaobecne = $listaobecne.", ".$obecne.", ";
									$_SESSION['addogl_wyposazenie'] = $listaobecne;
								}else{
									$listaobecne = $obecne.", ";
									$_SESSION['addogl_wyposazenie'] = $listaobecne;
								}
							}else{
								//echo "</br>nie 965";
								$ok = false;
								$_SESSION['eogl_obecne'] = "Wybierz poprawne wyposażenie pojazdu";
							}
						}
					}
				}
				if($ok == true){
					$_SESSION['accept'] = true;
					//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
					$_SESSION['addogl_telefon'] = $_POST['Telefon'];
					$_SESSION['addogl_email'] = $_POST['Email'];
					$_SESSION['addogl_woj'] = $_POST['Woj'];
					$_SESSION['addogl_miej'] = $_POST['Miej'];
					//echo	$_SESSION['addogl_opis'] = $opis;
					$_SESSION['addogl_cena'] = $_POST['Cena'];
					$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
					$_SESSION['addogl_category'] = $_POST['category'];
					$_SESSION['addogl_category2'] = $_POST['category2'];
					$_SESSION['addogl_category3'] = $_POST['category3'];
					$_SESSION['addogl_category4'] = $_POST['category4'];
					$_SESSION['addogl_mocsilnika'] = $_POST['Moc_silnika'];
					$_SESSION['addogl_pojsilnika'] = $_POST['Poj_silnika'];
					$_SESSION['addogl_rok'] = $_POST['Rok_produkcji'];
					$_SESSION['addogl_przebieg'] = $_POST['Przebieg'];
					$_SESSION['addogl_nadwozie'] = $_POST['Nadwozie'];
					$_SESSION['addogl_paliwo'] = $_POST['Paliwo'];
					$_SESSION['addogl_skrzynia'] = $_POST['Skrzynia_biegow'];
					$_SESSION['addogl_kolor'] = $_POST['Kolor'];
					$_SESSION['addogl_stantechniczny'] = $_POST['Stan_techniczny'];				
					$_SESSION['addogl_stanuzytkowy'] = $_POST['Stan_uzytkowy'];
					//$_SESSION['addogl_wyposazenie'] = $listaobecne;
					session_write_close();
					header("Location: dodaj-ogloszenie-potwierdz.php");
					exit;
				}else{
					$_SESSION['eogl_error'] = "Prosimy wypełnić wszystkie wymagane pola!";
					//echo "nie 973";
				}
			}
		}
		
		
		
		if(($category2 == 'Samochody ciezarowe') || ($category2 == 'Samochody dostawcze')){
			$category3 = $_POST['category3'];
			unset($_SESSION['addogl_category4']);
			unset($category4);
			unset($nadwozie);
			unset($_SESSION['addogl_nadwozie']);
			if($category2 == 'Samochody ciezarowe'){
				if(!(($category3 == 'DAF') || ($category3 == 'Iveco') || ($category3 == 'Jelcz')  || ($category3 == 'MAN')  || ($category3 == 'Mercedes')  || ($category3 == 'Renault')  || ($category3 == 'Scania')
					|| ($category3 == 'Star') || ($category3 == 'Volvo')  || ($category3 == 'Inna marka'))){
					$ok = false;
					$_SESSION['eogl_category'] = "Wybierz kategorię 3";
				}
			}
			if($category2 == 'Samochody dostawcze'){
				if(!(($category3 == 'Citroen') || ($category3 == 'Fiat') || ($category3 == 'Ford')  || ($category3 == 'Iveco')  || ($category3 == 'Mercedes')  || ($category3 == 'Opel')  || ($category3 == 'Peugeot')
					|| ($category3 == 'Renault') || ($category3 == 'Volkswagen')  || ($category3 == 'Inna marka'))){
					$ok = false;
					$_SESSION['eogl_category'] = "Wybierz kategorię 3";
				}
			}
			
			$moc = $_POST['Moc_silnika'];
			if(strlen($moc) == 0){
				$ok = false;
				$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podaj moc silnika w KM!";
				//echo "</br>nie 831";
			}
			if(!(preg_match('/^[0-9]+$/', $moc))){
				$ok = false;
				$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 835";
			}else{
				if(!(int)$moc > 0){
					$ok = false;
					$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być większa od 0!";
					//echo "</br>nie 839";
				}
			}
			$pojemnosc = $_POST['Poj_silnika'];
			if(strlen($pojemnosc) == 0){
				$ok = false;
				$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podaj pojemność silnika w cm3!";
				//echo "</br>nie 845";
			}
			if(!(preg_match('/^[0-9]+$/', $pojemnosc))){
				$ok = false;
				$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 849";
			}else{
				if(!(int)$pojemnosc > 0){
					$ok = false;
					$_SESSION['eogl_pojemnosc'] =  "Pojemność silnika: Podana liczba musi być większa od 0!";
					//echo "</br>nie 853";
				}
			}
			$rok = $_POST['Rok_produkcji'];
			if(strlen($rok) == 0){
				$ok = false;
				$_SESSION['eog_rok'] = "Rok produkcji: Podaj rok produkcji!";
				//echo "</br>nie 859";
			}
			if(!(preg_match('/^[0-9]+$/', $rok))){
				$ok = false;
				$_SESSION['eogl_rok'] = "Rok produkcji: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 862";
			}else{
				if(!(int)$rok > 0){
					$ok = false;
					$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba musi być większa od 0!";
					//echo "</br>nie 867";
				}
				if((int)$rok > 9999){
					$ok = false;
					$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba nie może być większa niż 9999!";
					//echo "</br>nie 871";
				}
			}
			$przebieg = $_POST['Przebieg'];
			if(strlen($przebieg) == 0){
				$ok = false;
				$_SESSION['eogl_przebieg'] = "Przebieg: Podaj przebieg!";
				//echo "</br>nie 876";
			}
			if (!(preg_match('/^[0-9]+$/', $przebieg))){
				$ok = false;
				$_SESSION['eogl_przebieg'] = "Przebieg: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 881";
			}
			$paliwo = $_POST['Paliwo'];
			if(!(($paliwo == 'Diesel') || ($paliwo == 'Hybryda(Diesel)') || ($paliwo == 'Elektryczny') || ($paliwo == 'Hybryda(Benzyna)') || ($paliwo == 'Benzyna+LPG') || ($paliwo == 'Benzyna'))){
				$ok = false;
				$_SESSION['eogl_paliwo'] = "Wybierz typ paliwa";
				//echo "</br>nie 896";
			}
			
			$skrzynia = $_POST['Skrzynia_biegow'];
			if(!(($skrzynia == 'Automatyczna') || ($skrzynia == 'Manualna') || ($skrzynia == 'Sekwencyjna'))){
				$ok = false;
				$_SESSION['eogl_skrzynia'] = "Wybierz skrzynie biegów";
				//echo "</br>nie 902";
			}
			
			$kolor = $_POST['Kolor'];
			if(!(($kolor == 'Bialy') || ($kolor == 'Czarny') || ($kolor == 'Czerwony')
			|| ($kolor == 'Niebieski') || ($kolor == 'Srebny') || ($kolor == 'Szary') 
			|| ($kolor == 'Zielony') || ($kolor == 'Zolty') || ($kolor == 'Inny'))){
				$ok = false;
				//echo "</br>nie 909";
				$_SESSION['eogl_kolor'] = "Wybierz kolor pojazdu";
			}
			
			$stantechniczny = $_POST['Stan_techniczny'];
			if(!(($stantechniczny == 'Nieuszkodzony') || ($stantechniczny == 'Uszkodzony'))){
				//echo "</br>nie 914";
				$ok = false;
				$_SESSION['eogl_stantechniczny'] = "Wybierz stan techniczny pojazdu";
			}			

			$stanuzytkowy = $_POST['Stan_uzytkowy'];
			if(!(($stanuzytkowy == 'Nowy') || ($stanuzytkowy == 'Uzywany'))){
				//echo "</br>nie 920";
				$ok = false;
				$_SESSION['eogl_stanuzytkowy'] = "Wybierz stan użytkowy pojazdu";
			}
			if(isset($_POST['wyp'])){
				$wyposazenie = $_POST['wyp']; 
				foreach ($wyposazenie as $obecne){
					if(($obecne == 'ABS') || ($obecne == 'ASR') || ($obecne == 'Alarm')
						|| ($obecne == 'Asystent pasa ruchu') || ($obecne == 'Bluetooth') || ($obecne == 'CD') || ($obecne == 'Czujnik deszczu')
						|| ($obecne == 'Czujnik zmierzchu') || ($obecne == 'ESP') || ($obecne == 'Elektryczne fotele')
						|| ($obecne == 'Elektryczne lusterka') || ($obecne == 'Elektryczne szyby')
						|| ($obecne == 'Fotochromatyczne lusterka boczne') || ($obecne == 'Kierownica wielofunkcyjna') 
						|| ($obecne == 'Klimatyzacja') || ($obecne == 'Komputer pokładowy') || ($obecne == 'MP3') 
						|| ($obecne == 'Odtwarzacz DVD') || ($obecne == 'Podgrzewana przednia szyba') || ($obecne == 'Podgrzewane fotele')
						|| ($obecne == 'Poduszki powietrzne') || ($obecne == 'Radio fabryczne') || ($obecne == 'Regulacja wysokości podwozia')
						|| ($obecne == 'Skórzana tapicerka') || ($obecne == 'Szyberdach')
						|| ($obecne == 'Tempomat') || ($obecne == 'Tempomat aktywny') || ($obecne == 'Webasto') 
						|| ($obecne == 'Wspomaganie kierownicy') || ($obecne == 'Przyciemniane szyby')
						|| ($obecne == 'Zmieniarka CD') || ($obecne == 'Nawigacja')
						|| ($obecne == 'Xenony') || ($obecne == 'Światła do jazdy dziennej')){
						if(isset($listaobecne)){
							$listaobecne = $listaobecne.", ".$obecne;
							$_SESSION['addogl_wyposazenie'] = $listaobecne;
						}else{
							$listaobecne = $obecne;
							$_SESSION['addogl_wyposazenie'] = $listaobecne;
						}
					}else{
						//echo "</br>nie 965";
						$ok = false;
						$_SESSION['eogl_obecne'] = "Wybierz poprawne wyposażenie pojazdu";
					}
				}
			}
			if($ok == true){
					$_SESSION['accept'] = true;
					//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
					$_SESSION['addogl_telefon'] = $_POST['Telefon'];
					$_SESSION['addogl_email'] = $_POST['Email'];
					$_SESSION['addogl_woj'] = $_POST['Woj'];
					$_SESSION['addogl_miej'] = $_POST['Miej'];
					//echo	$_SESSION['addogl_opis'] = $opis;
					$_SESSION['addogl_cena'] = $_POST['Cena'];
					$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
					$_SESSION['addogl_category'] = $_POST['category'];
					$_SESSION['addogl_category2'] = $_POST['category2'];
					$_SESSION['addogl_category3'] = $_POST['category3'];
					$_SESSION['addogl_mocsilnika'] = $_POST['Moc_silnika'];
					$_SESSION['addogl_pojsilnika'] = $_POST['Poj_silnika'];
					$_SESSION['addogl_rok'] = $_POST['Rok_produkcji'];
					$_SESSION['addogl_przebieg'] = $_POST['Przebieg'];
					$_SESSION['addogl_paliwo'] = $_POST['Paliwo'];
					$_SESSION['addogl_skrzynia'] = $_POST['Skrzynia_biegow'];
					$_SESSION['addogl_kolor'] = $_POST['Kolor'];
					$_SESSION['addogl_stantechniczny'] = $_POST['Stan_techniczny'];				
					$_SESSION['addogl_stanuzytkowy'] = $_POST['Stan_uzytkowy'];
					//$_SESSION['addogl_wyposazenie'] = $listaobecne;
					session_write_close();
					header("Location: dodaj-ogloszenie-potwierdz.php");
					exit;
				}else{
					$_SESSION['eogl_error'] = "Prosimy wypełnić wszystkie wymagane pola!";
					//echo "nie 973";
				}
			
			
			
		}
		if($category2 == 'Motocykle i skutery'){
			$category3 = $_POST['category3'];
			$category4 = $_POST['category4'];
			unset($nadwozie);
			unset($_SESSION['addogl_nadwozie']);
			unset($_SESSION['addogl_paliwo']);
			unset($_SESSION['addogl_skrzynia']);
			unset($_SESSION['addogl_kolor']);
			unset($_SESSION['addogl_wyposazenie']);
			
			if(!(($category3 == 'Motocykle') || ($category3 == 'Skutery') || ($category3 == 'Quady ATV'))){
				$ok = false;
				$_SESSION['eogl_category'] = "Wybierz kategorię 3";
			}
			if($category3 == 'Motocykle'){
				if(!(($category4 == 'Aprilia') || ($category4 == 'BMW') || ($category4 == 'Barton') || ($category4 == 'Ducati') || ($category4 == 'Honda') || ($category4 == 'Jawa') || ($category4 == 'Junak')
					|| ($category4 == 'KTM') || ($category4 == 'Kawasaki') || ($category4 == 'Kimco') || ($category4 == 'MZ') || ($category4 == 'Rieju') || ($category4 == 'Romet') || ($category4 == 'SHL')
					|| ($category4 == 'Simson') || ($category4 == 'Suzuki') || ($category4 == 'WSK') || ($category4 == 'Yamaha') || ($category4 == 'Inna marka'))){
					$ok = false;
					$_SESSION['eogl_category'] = "Wybierz kategorię 4";
				}
			}
			if($category3 == 'Skutery'){
				if(!(($category4 == 'Adiva') || ($category4 == 'Aprilia') || ($category4 == 'BMW') || ($category4 == 'Barton') || ($category4 == 'Honda') || ($category4 == 'Junak') || ($category4 == 'Kawasaki')
					|| ($category4 == 'Kymco') || ($category4 == 'Peugeot') || ($category4 == 'Piaggio') || ($category4 == 'Suzuki') || ($category4 == 'Yamaha') || ($category4 == 'Inna marka'))){
					$ok = false;
					$_SESSION['eogl_category'] = "Wybierz kategorię 4";
				}
			}
			if($category3 == 'Quady ATV'){
				if(!(($category4 == 'Bashan') || ($category4 == 'Benyco') || ($category4 == 'Beretta') || ($category4 == 'Grizzly') || ($category4 == 'Honda') || ($category4 == 'Hummer') || ($category4 == 'Kawasaki')
					|| ($category4 == 'Phyton') || ($category4 == 'Polaris') || ($category4 == 'Romet') || ($category4 == 'Suzuki') || ($category4 == 'Yamaha') || ($category4 == 'Inna marka'))){
					$ok = false;
					$_SESSION['eogl_category'] = "Wybierz kategorię 4";
				}
			}
			$moc = $_POST['Moc_silnika'];
			if(strlen($moc) == 0){
				$ok = false;
				$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podaj moc silnika w KM!";
				//echo "</br>nie 831";
			}
			if(!(preg_match('/^[0-9]+$/', $moc))){
				$ok = false;
				$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 835";
			}else{
				if(!(int)$moc > 0){
					$ok = false;
					$_SESSION['eogl_mocsilnika'] = "Moc silnika: Podana liczba musi być większa od 0!";
					//echo "</br>nie 839";
				}
			}
			$pojemnosc = $_POST['Poj_silnika'];
			if(strlen($pojemnosc) == 0){
				$ok = false;
				$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podaj pojemność silnika w cm3!";
				//echo "</br>nie 845";
			}
			if(!(preg_match('/^[0-9]+$/', $pojemnosc))){
				$ok = false;
				$_SESSION['eogl_pojemnosc'] = "Pojemność silnika: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 849";
			}else{
				if(!(int)$pojemnosc > 0){
					$ok = false;
					$_SESSION['eogl_pojemnosc'] =  "Pojemność silnika: Podana liczba musi być większa od 0!";
					//echo "</br>nie 853";
				}
			}
			$rok = $_POST['Rok_produkcji'];
			if(strlen($rok) == 0){
				$ok = false;
				$_SESSION['eog_rok'] = "Rok produkcji: Podaj rok produkcji!";
				//echo "</br>nie 859";
			}
			if(!(preg_match('/^[0-9]+$/', $rok))){
				$ok = false;
				$_SESSION['eogl_rok'] = "Rok produkcji: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 862";
			}else{
				if(!(int)$rok > 0){
					$ok = false;
					$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba musi być większa od 0!";
					//echo "</br>nie 867";
				}
				if((int)$rok > 9999){
					$ok = false;
					$_SESSION['eogl_rok'] =  "Rok produkcji: Podana liczba nie może być większa niż 9999!";
					//echo "</br>nie 871";
				}
			}
			$przebieg = $_POST['Przebieg'];
			if(strlen($przebieg) == 0){
				$ok = false;
				$_SESSION['eogl_przebieg'] = "Przebieg: Podaj przebieg!";
				//echo "</br>nie 876";
			}
			if (!(preg_match('/^[0-9]+$/', $przebieg))){
				$ok = false;
				$_SESSION['eogl_przebieg'] = "Przebieg: Podana liczba musi być całkowita, dodatnia!";
				//echo "</br>nie 881";
			}
			$stantechniczny = $_POST['Stan_techniczny'];
			if(!(($stantechniczny == 'Nieuszkodzony') || ($stantechniczny == 'Uszkodzony'))){
				//echo "</br>nie 914";
				$ok = false;
				$_SESSION['eogl_stantechniczny'] = "Wybierz stan techniczny pojazdu";
			}

			$stanuzytkowy = $_POST['Stan_uzytkowy'];
			if(!(($stanuzytkowy == 'Nowy') || ($stanuzytkowy == 'Uzywany'))){
				//echo "</br>nie 920";
				$ok = false;
				$_SESSION['eogl_stanuzytkowy'] = "Wybierz stan użytkowy pojazdu";
			}
			if($ok == true){
				$_SESSION['accept'] = true;
				//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
				$_SESSION['addogl_telefon'] = $_POST['Telefon'];
				$_SESSION['addogl_email'] = $_POST['Email'];
				$_SESSION['addogl_woj'] = $_POST['Woj'];
				$_SESSION['addogl_miej'] = $_POST['Miej'];
				//echo	$_SESSION['addogl_opis'] = $opis;
				$_SESSION['addogl_cena'] = $_POST['Cena'];
				$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
				$_SESSION['addogl_category'] = $_POST['category'];
				$_SESSION['addogl_category2'] = $_POST['category2'];
				$_SESSION['addogl_category3'] = $_POST['category3'];
				$_SESSION['addogl_category4'] = $_POST['category4'];
				$_SESSION['addogl_mocsilnika'] = $_POST['Moc_silnika'];
				$_SESSION['addogl_pojsilnika'] = $_POST['Poj_silnika'];
				$_SESSION['addogl_rok'] = $_POST['Rok_produkcji'];
				$_SESSION['addogl_przebieg'] = $_POST['Przebieg'];
				$_SESSION['addogl_stantechniczny'] = $_POST['Stan_techniczny'];				
				$_SESSION['addogl_stanuzytkowy'] = $_POST['Stan_uzytkowy'];
				session_write_close();
				header("Location: dodaj-ogloszenie-potwierdz.php");
				exit;
			}else{
				$_SESSION['eogl_error'] = "Prosimy wypełnić wszystkie wymagane pola!";
				//echo "nie 973";
			}
		}
		if($category2 == 'Pojazdy rolnicze'){
			$stantechniczny = $_POST['Stan_techniczny'];
			if(!(($stantechniczny == 'Nieuszkodzony') || ($stantechniczny == 'Uszkodzony'))){
				//echo "</br>nie 914";
				$ok = false;
				$_SESSION['eogl_stantechniczny'] = "Wybierz stan techniczny pojazdu";
			}

			$stanuzytkowy = $_POST['Stan_uzytkowy'];
			if(!(($stanuzytkowy == 'Nowy') || ($stanuzytkowy == 'Uzywany'))){
				//echo "</br>nie 920";
				$ok = false;
				$_SESSION['eogl_stanuzytkowy'] = "Wybierz stan użytkowy pojazdu";
			}
			if($ok == true){
				$_SESSION['accept'] = true;
				//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
				$_SESSION['addogl_telefon'] = $_POST['Telefon'];
				$_SESSION['addogl_email'] = $_POST['Email'];
				$_SESSION['addogl_woj'] = $_POST['Woj'];
				$_SESSION['addogl_miej'] = $_POST['Miej'];
				//echo	$_SESSION['addogl_opis'] = $opis;
				$_SESSION['addogl_cena'] = $_POST['Cena'];
				$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
				$_SESSION['addogl_category'] = $_POST['category'];
				$_SESSION['addogl_category2'] = $_POST['category2'];
				$_SESSION['addogl_stantechniczny'] = $_POST['Stan_techniczny'];				
				$_SESSION['addogl_stanuzytkowy'] = $_POST['Stan_uzytkowy'];
				session_write_close();
				header("Location: dodaj-ogloszenie-potwierdz.php");
				exit;
			}
		}
		if($category2 == 'Felgi i opony' || $category2 == 'Sprzet audio' || $category2 == 'Pozostale'){
			if($ok == true){
				$_SESSION['accept'] = true;
				//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
				$_SESSION['addogl_telefon'] = $_POST['Telefon'];
				$_SESSION['addogl_email'] = $_POST['Email'];
				$_SESSION['addogl_woj'] = $_POST['Woj'];
				$_SESSION['addogl_miej'] = $_POST['Miej'];
				//echo	$_SESSION['addogl_opis'] = $opis;
				$_SESSION['addogl_cena'] = $_POST['Cena'];
				$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
				$_SESSION['addogl_category'] = $_POST['category'];
				$_SESSION['addogl_category2'] = $_POST['category2'];
				session_write_close();
				header("Location: dodaj-ogloszenie-potwierdz.php");
				exit;
			}
		}
	}
	
	if($category == 'Elektronika'){
		$category2 = $_POST['category2'];
		if(!($category2 == 'Komputery' || $category2 == 'Telewizory' || $category2 == 'Telefony' || $category2 == 'Tablety' || $category2 == 'Konsole' 
			|| $category2 == 'Akcesoria' || $category2 == 'Pozostale')){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 2";
		}
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = $_POST['Cena'];
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			$_SESSION['addogl_category2'] = $_POST['category2'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}
	if($category == 'Nieruchomosci'){
		$category2 = $_POST['category2'];
		if(!($category2 == 'Mieszkania' || $category2 == 'Garaze' || $category2 == 'Dzialki' || $category2 == 'Domy' || $category2 == 'Pozostale')){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 2";
		}
		$category3 = $_POST['category3'];
		if(!($category3 == 'Sprzedam' || $category3 == 'Wynajme')){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 3";
		}
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = $_POST['Cena'];
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			$_SESSION['addogl_category2'] = $_POST['category2'];
			$_SESSION['addogl_category3'] = $_POST['category3'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}
	
	if($category == 'Dom i ogrod'){
		$category2 = $_POST['category2'];
		if(!($category2 == 'Sprzet RTV/AGD' || $category2 == 'Oswietlenie' || $category2 == 'Ogrod' || $category2 == 'Meble' || $category2 == 'Pozostale')){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 2";
		}
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = $_POST['Cena'];
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			$_SESSION['addogl_category2'] = $_POST['category2'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}	

	if($category == 'Praca'){
		$category2 = $_POST['category2'];
		if(!($category2 == 'Dorywcza' || $category2 == 'Za granica' || $category2 == 'W kraju' || $category2 == 'Uslugi' || $category2 == 'Pozostale')){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 2";
		}
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = $_POST['Cena'];
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			$_SESSION['addogl_category2'] = $_POST['category2'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}

	if($category == 'Odziez'){
		$category2 = $_POST['category2'];
		if(!($category2 == 'Ubrania' || $category2 == 'Dodatki' || $category2 == 'Zegarki' || $category2 == 'Buty' || $category2 == 'Pozostale')){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 2";
		}
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = $_POST['Cena'];
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			$_SESSION['addogl_category2'] = $_POST['category2'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}
	
	if($category == 'Zwierzeta'){
		$category2 = $_POST['category2'];
		if(!($category2 == 'Schroniska' || $category2 == 'Koty' || $category2 == 'Psy' || $category2 == 'Pozostale zwierzeta' || $category2 == 'Dla zwierzat')){
			$ok = false;
			$_SESSION['eogl_category'] = "Wybierz kategorię 2";
		}
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = $_POST['Cena'];
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			$_SESSION['addogl_category2'] = $_POST['category2'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}
	if($category == 'Oddam za darmo'){
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = "Oddam za darmo";
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}
	if($category == 'Pozostale'){
		if($ok == true){
			$_SESSION['accept'] = true;
			//echo	$_SESSION['addogl_title']. "title; i tak zostaje";
			$_SESSION['addogl_telefon'] = $_POST['Telefon'];
			$_SESSION['addogl_email'] = $_POST['Email'];
			$_SESSION['addogl_woj'] = $_POST['Woj'];
			$_SESSION['addogl_miej'] = $_POST['Miej'];
			//echo	$_SESSION['addogl_opis'] = $opis;
			$_SESSION['addogl_cena'] = $_POST['Cena'];
			$_SESSION['addogl_negocjacja'] = $_POST['Negocjacji'];
			$_SESSION['addogl_category'] = $_POST['category'];
			session_write_close();
			header("Location: dodaj-ogloszenie-potwierdz.php");
			exit;
		}
	}
	

	
}else{
	for($p=1; $p<=8; $p++){
		if(@$_SESSION['Photo'.$p] != ''){
			$unlink = 'galeria/tymczasowe/'.$_SESSION['Photo'.$p];
			if(file_exists($unlink)){
				unlink($unlink);
			}
		}
	}
}
?>	
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Dodaj ogłoszenie na BezGrosika.pl</title>
	<link rel="shortcut icon" href="img/grosiky.png">
	<meta name="keywords" content="serwis ogłoszeniowy, motoryzacja, samochody osobowe, samochody dostawcze, samochody ciężarowe, samochody ciężarowe DAF, Iveco, MAN, samochody osobowe vw, volkswagen, audi, bmw, dacia"/>
	<meta name="description" content="Dodaj swoje nowe ogłoszenie w serwisie ogłoszeniowym BezGrosika.pl"/>
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
    <link rel="stylesheet" href="css/filters.css">
    
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
                <li><a href="index.php">Strona główna</a></li>
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

  
    
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Dodaj ogłoszenie</h1>
                <p class="mb-0">Dodawanie ogłoszenia</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  

	<div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 text-left border-primary">
            <h2 class="font-weight-light text-primary">Formularz dodawania</h2>
          </div>
        </div>
        <div class="row mt-5">
		  <div style="width: 99%;">
            <div class="d-block d-md-flex listing">
              
				<form method="post" style="margin-left: auto; margin-right: auto;">
					<div class="ogc">
						<div class="ogc1">
							<div style="width: 100%; margin-left: auto; margin-right: auto;">
								<br>
								<div style="text-align: center;">Przed dodaniem ogłoszenia sprawdź czy wypełniłeś wszystkie wymagane pola!<br>Zaczynamy!</div><br>
								<hr>
								<br>
								<div style="width: 100%; max-width: 600px; margin-left: auto; margin-right: auto;">
									<b>Podaj tytuł</b> <span style="color: red;">*</span><br>
									<input required class="filters-addogl-input" style="width: 100%; max-width: 600px;" onkeyup="licz(this,60);" type="text" name="title" maxlength="60" value="<?php if(isset($_SESSION['addogl_title'])){ echo $_SESSION['addogl_title']; unset($_SESSION['addogl_title']);}?>"></input><br>
									<span style="font-size: 11px;">Na ogłoszeniu najlepiej wygląda krótki tytuł do 20 znaków (np. Rower górski, czy Audi A4)</span>
									<span id="ile" style="float: right; font-size: 11px;">Pozostało 60 znaków.</span>
								</div>
								<?php 
									if(isset($_POST['submit'])){
										echo '<br><br>';
										if(isset($_SESSION['eogl_title'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_title'].'</br></span>'; 
											unset($_SESSION['eogl_title']);
										}
										if(isset($_SESSION['eogl_category'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_category'].'</br></span>'; 
											unset($_SESSION['eogl_category']);
										}	
										if(isset($_SESSION['eogl_mocsilnika'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_mocsilnika'].'</br></span>'; 
											unset($_SESSION['eogl_mocsilnika']);
										}	
										if(isset($_SESSION['eogl_pojemnosc'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_pojemnosc'].'</br></span>'; 
											unset($_SESSION['eogl_pojemnosc']);
										}
										if(isset($_SESSION['eogl_rok'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_rok'].'</br></span>'; 
											unset($_SESSION['eogl_rok']);
										}
										if(isset($_SESSION['eogl_przebieg'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_przebieg'].'</br></span>'; 
											unset($_SESSION['eogl_przebieg']);
										}
										if(isset($_SESSION['eogl_nadwozie'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_nadwozie'].'</br></span>'; 
											unset($_SESSION['eogl_nadwozie']);
										}
										if(isset($_SESSION['eogl_paliwo'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_paliwo'].'</br></span>'; 
											unset($_SESSION['eogl_paliwo']);
										}
										if(isset($_SESSION['eogl_skrzynia'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_skrzynia'].'</br></span>'; 
											unset($_SESSION['eogl_skrzynia']);
										}
										if(isset($_SESSION['eogl_kolor'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_kolor'].'</br></span>'; 
											unset($_SESSION['eogl_kolor']);
										}
										if(isset($_SESSION['eogl_stantechniczny'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_stantechniczny'].'</br></span>'; 
											unset($_SESSION['eogl_stantechniczny']);
										}
										if(isset($_SESSION['eogl_stanuzytkowy'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_stanuzytkowy'].'</br></span>'; 
											unset($_SESSION['eogl_stanuzytkowy']);
										}
										if(isset($_SESSION['eogl_obecne'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_obecne'].'</br></span>'; 
											unset($_SESSION['eogl_obecne']);
										}
										if(isset($_SESSION['eogl_opis'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_opis'].'</br></span>'; 
											unset($_SESSION['eogl_opis']);
										}
										if(isset($_SESSION['eogl_telefon'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_telefon'].'</br></span>'; 
											unset($_SESSION['eogl_telefon']);
										}
										if(isset($_SESSION['eogl_kontakt'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_kontakt'].'</br></span>'; 
											unset($_SESSION['eogl_kontakt']);
										}
										if(isset($_SESSION['eogl_email'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_email'].'</br></span>'; 
											unset($_SESSION['eogl_email']);
										}
										if(isset($_SESSION['eogl_woj'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_woj'].'</br></span>'; 
											unset($_SESSION['eogl_woj']);
										}
										if(isset($_SESSION['eogl_miej'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_miej'].'</br></span>'; 
											unset($_SESSION['eogl_miej']);
										}
										if(isset($_SESSION['eogl_cena'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_cena'].'</br></span>'; 
											unset($_SESSION['eogl_cena']);
										}
										if(isset($_SESSION['eogl_error'])){
											echo '<span style="color: red; font-size: 13px;">'.$_SESSION['eogl_error'].'</br></span>'; 
											unset($_SESSION['eogl_error']);
										}
									}
									?>
							</div>		
							<div style="margin-top: 50px; width: 100%; max-width: 600px;" style="text-align: center;">
									<span required class="icon-format_list_bulleted"> </span><b>Wybierz kategorię</b> <span style="color: red;">*</span><br>
									<select id="category" class="filters-addogl-input" style="display: inline-block;" name="category">
									<option value="0"></option>
									<option value="Motoryzacja">Motoryzacja</option>
									<option value="Elektronika">Elektronika</option>
									<option value="Nieruchomosci">Nieruchomości</option>
									<option value="Dom i ogrod">Dom i ogród</option>
									<option value="Praca">Praca</option>
									<option value="Odziez">Odzież</option>
									<option value="Zwierzeta">Zwierzęta</option>
									<option value="Oddam za darmo">Oddam za darmo</option>
									<option value="Pozostale">Pozostałe</option>
								</select>

								<br>
								<br>
									
								<span id="Info1"></span><br>
								<select id="category2" class="filters-addogl-input" name="category2" style="display: none;">
								</select>
								
								<br>
								<br>
								
								<span id="Info"></span><br>
								<select id="category3" class="filters-addogl-input" name="category3" style="display: none;">
								</select>
								
								<br>
								<br>
								
								<span id="Info2"></span><br>
								<select id="category4" class="filters-addogl-input" name="category4" style="display: none;">
								</select>	
								
								<br>
								<br>
								<hr>
								<br>
								<br>
								
								<div id="category5" style="display: none;">
								</div>
								
								<div id="category6">
									<div class="opisd">
										<b>Opis Twojego ogłoszenia</b> <span style="color: red;">*</span><br>
										<textarea required onkeyup="liczo(this,1000);" class="opis" name="Opis" maxlength="1000"><?php if(isset($_SESSION['addogl_opis'])){ echo $_SESSION['addogl_opis']; unset($_SESSION['addogl_opis']);}?></textarea>
										<span style="font-size: 11px;">Twój opis powinien mieć minumum 10 znaków.</span>
										<span id="ileo" style="float: right; font-size: 11px;">Pozostało 1000 znaków.</span>
									</div>
									
									<div id="photos" style="display: none;">
										<br><br><b>Tutaj możesz dodać zdjęcia.<br>Pierwsze zdjęcie z góry będzie zdjęciem głównym ogłoszenia.</b><br>
										<iframe src="addgallery/form1.php" class="file">
										</iframe>
										<iframe src="addgallery/form2.php" class="file">
										</iframe>
										<iframe src="addgallery/form3.php" class="file">
										</iframe>
										<iframe src="addgallery/form4.php" class="file">
										</iframe>
										<iframe src="addgallery/form5.php" class="file">										
										</iframe>
										<iframe src="addgallery/form6.php" class="file">
										</iframe>
										<iframe src="addgallery/form7.php" class="file">	
										</iframe>
										<iframe src="addgallery/form8.php" class="file">
										</iframe>
									</div>	
									
									<div id="photos1" style="display: none;">
										<br><br><b>Tutaj możesz dodać zdjęcia.<br>Pierwsze zdjęcie z góry będzie zdjęciem głównym ogłoszenia.</b><br>
										<iframe src="addgallery/form1.php" class="file">
										</iframe>
										<iframe src="addgallery/form2.php" class="file">
										</iframe>
										<iframe src="addgallery/form3.php" class="file">
										</iframe>
									</div>	
									
									<div id="photos2" style="display: none;">
										<br><br><b>Tutaj możesz dodać zdjęcia.<br>Pierwsze zdjęcie z góry będzie zdjęciem głównym ogłoszenia.</b><br>
										<iframe src="addgallery/form1.php" class="file">
										</iframe>
									</div>	
									
									
									<div style="margin-top: 50px;">
										<span class="icon-location-arrow"> </span><b>Województwo</b> <span style="color: red;">*</span><br>
										<select required class="filters-addogl-input" name="Woj" placeholder="Województwo">
											<option value="0"></option>
											<option value="Dolnośląskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Dolnośląskie"){ echo "selected";} ?>>Dolnośląskie</option>
											<option value="Kujawsko pomorskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Kujawsko pomorskie"){ echo "selected";} ?>>Kujawsko-pomorskie</option>
											<option value="Lubelskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Lubelskie"){ echo "selected";} ?>>Lubelskie</option>
											<option value="Lubuskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Lubuskie"){ echo "selected";} ?>>Lubuskie</option>
											<option value="Łódzkie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Łódzkie"){ echo "selected";} ?>>Łódzkie</option>
											<option value="Małopolskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Małopolskie"){ echo "selected";} ?>>Małopolskie</option>
											<option value="Mazowieckie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Mazowieckie"){ echo "selected";} ?>>Mazowieckie</option>
											<option value="Opolskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Opolskie"){ echo "selected";} ?>>Opolskie</option>
											<option value="Podkarpackie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Podkarpackie"){ echo "selected";} ?>>Podkarpackie</option>
											<option value="Podlaskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Podlaskie"){ echo "selected";} ?>>Podlaskie</option>
											<option value="Pomorskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Pomorskie"){ echo "selected";} ?>>Pomorskie</option>
											<option value="Śląskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Śląskie"){ echo "selected";} ?>>Śląskie</option>
											<option value="Świętokrzyskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Świętokrzyskie"){ echo "selected";} ?>>Świętokrzyskie</option>
											<option value="Warmińsko-mazurskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Warmińsko-mazurskie"){ echo "selected";} ?>>Warmińsko-mazurskie</option>
											<option value="Wielkopolskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Wielkopolskie"){ echo "selected";} ?>>Wielkopolskie</option>
											<option value="Zachodniopomorskie" <?php if(isset($_POST['Woj']) && $_POST['Woj'] == "Zachodniopomorskie"){ echo "selected";} ?>>Zachodniopomorskie</option>
										</select>
										<br><br>
										<span class="icon-location-arrow"> </span><b>Miejscowość</b><br>
										<input type="text" class="filters-addogl-input" style="cursor: auto;" name="Miej" placeholder="np. Warszawa" <?php if(isset($_POST['Miej']) && $_POST['Miej'] != ''){ echo 'value='.$_POST['Miej'];} ?>></input>
									</div>
										
									
									<div class="cenad">
										<br><span class="icon-tags"> </span><b>Podaj kwotę (w PLN)</b> <span style="color: red;">*</span><br>
										<label><input required type="text" onkeydown="return noNum(event)" id="Cena" class="filters-addogl-input" name="Cena" <?php if(isset($_POST['Cena']) && $_POST['Cena'] != ''){ echo 'value='.$_POST['Cena'];} ?>/>
										<label><span class="cena1" id="Cena1"><input type="checkbox" name="Negocjacji">Do negocjacji</span></label></label>
									</div>
								
									<hr>
										
									<div class="contact">
										<br><b>Kontakt</b> <span style="color: red;">*</span><br>
										<span style="font-size: 11px;">Podaj przynajmniej jedną możliwość kontaktu.</span>
										</br>
										<label>
											<div class="contact1">
												<br><span class="icon-phone"> </span><b>Numer telefonu</b><br>
												<input type="text" class="filters-addogl-input" name="Telefon" onkeydown="return noNum(event)" maxlength="9" <?php if(isset($_POST['Telefon']) && $_POST['Telefon'] != ''){ echo 'value='.$_POST['Telefon'];} ?>>
												<br><span style="font-size: 11px;">Przykład: 111333555</span>
											</div>
										</label>
										</br>
										<label> 
											<div class="contact1">
												<br><span class="icon-mail_outline"> </span><b>Adres email</b><br>
												<input type="email" class="filters-addogl-input" name="Email" <?php if(isset($_POST['Email']) && $_POST['Email'] != ''){ echo 'value='.$_POST['Email'];} ?>>
												<br><span style="font-size: 11px;">Przykład: Poczta@gmail.com</span>
											</div>
										</label>
										</br>
										<label>
											<div class="contact1">
												<span class=""></span>
												<input type="hidden" class="filters-addogl-input" name="Email-serwis" placeholder="E-Mail dla serwisu" value="<?php if(isset($_SESSION['useremail'])){echo $_SESSION['useremail'];}?>" disabled>
											</div>
										</label>
									</div>
								</div>
							
							</div>
						</div>
					</div>
					<div style="padding: 15px;">
						<center>
							<p>Sprawdziłeś wszystko jeszcze raz? :)<br>
							To do dzieła, idziemy dalej!</p><br>
							<input type="submit" class="filters-input-btn" name="submit" value="Przejdź do podsumowania"></input>
						</center>
					</div>
				</form>
			  
			  
            </div>
		  </div>
			
      </div>
    </div>	
	</div>
	

    <?php
		include_once("footer.php");
		footer();
	?>
  </div>
  <script type="text/javascript">
	function noNum(e){
		var keynum;
		var keychar;
		var numcheck;

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
    
  <script type="text/javascript">
	var mS = document.getElementById('category');
	var mS2 = document.getElementById('category2');
	var mS3 = document.getElementById('category3');
	var mS4 = document.getElementById('category4');
	var mS5 = document.getElementById('category5');
	var mS6 = document.getElementById('photos');
	var mS7 = document.getElementById('photos1');
	var mS8 = document.getElementById('photos2');
	var Cena0 = document.getElementById('Cena0');
	var Cena = document.getElementById('Cena');
	var Cena1 = document.getElementById('Cena1');
	var mS10 = document.getElementById('Info');
	var mS11 = document.getElementById('Info1');
	var mS12 = document.getElementById('Info2');
	mS2.onchange=function() {
		mS3.style='display: none;';
		mS4.style='display: none;';
		mS6.style='display: none;';
		mS7.style='display: none;';
		mS5.style='display: none;';
		mS10.innerHTML='';
		mS12.innerHTML='';
		if(mS.value==='Motoryzacja'){
			if(mS2.value==='Samochody osobowe'){
				mS10.innerHTML='<b>Marka</b> <span style="color: red;">*</span>';
				mS3.innerHTML='<option value="0"></option>' +
										'<option value="Abarth">Abarth</option>' +
										'<option value="Acura">Acura</option>' +
										'<option value="Alfa Romeo">Alfa Romeo</option>' +								
										'<option value="Aston Martin">Aston Martin</option>' +
										'<option value="Audi">Audi</option>' +
										'<option value="Bentley">Bentley</option>' +
										'<option value="BMW">BMW</option>' +
										'<option value="Bugatti">Bugatti</option>' +
										'<option value="Cadilac">Cadilac</option>' +
										'<option value="Chevrolet">Chevrolet</option>' +
										'<option value="Chrysler">Chrysler</option>' +
										'<option value="Citroen">Citroen</option>' +
										'<option value="Dacia">Dacia</option>' +
										'<option value="Daewoo">Daewoo</option>' +
										'<option value="Daihatsu">Daihatsu</option>' +								
										'<option value="Dodge">Dodge</option>' +
										'<option value="Ferrari">Ferrari</option>' +
										'<option value="Fiat">Fiat</option>' +
										'<option value="Ford">Ford</option>' +
										'<option value="Honda">Honda</option>' +
										'<option value="Hyundai">Hyundai</option>' +
										'<option value="Infiniti">Infiniti</option>' +
										'<option value="Jaguar">Jaguar</option>' +
										'<option value="Jeep">Jeep</option>' +
										'<option value="Kia">Kia</option>' +
										'<option value="Lamborghini">Lamborghini</option>' +
										'<option value="Lancia">Lancia</option>' +
										'<option value="Land Rover">Land Rover</option>' +
										'<option value="Lexus">Lexus</option>' +
										'<option value="Lincoln">Lincoln</option>' +
										'<option value="Lotus">Lotus</option>' +
										'<option value="Maserati">Maserati</option>' +
										'<option value="Mazda">Mazda</option>' +
										'<option value="McLaren">McLaren</option>' +
										'<option value="Mercedes">Mercedes</option>' +
										'<option value="MicroCar">MicroCar</option>' +
										'<option value="Mini">Mini</option>' +
										'<option value="Mitsubishi">Mitsubishi</option>' +
										'<option value="Nissan">Nissan</option>' +
										'<option value="Opel">Opel</option>' +
										'<option value="Peugeot">Peugeot</option>' +
										'<option value="Polonez">Polonez</option>' +
										'<option value="Porsche">Porsche</option>' +								
										'<option value="Renault">Renault</option>' +
										'<option value="Rolls Royce">Rolls Royce</option>' +
										'<option value="Rover">Rover</option>' +
										'<option value="Saab">Saab</option>' +
										'<option value="Seat">Seat</option>' +
										'<option value="Skoda">Skoda</option>' +
										'<option value="Smart">Smart</option>' +								
										'<option value="SsangYong">SsangYong</option>' +
										'<option value="Subaru">Subaru</option>' +
										'<option value="Suzuki">Suzuki</option>' +
										'<option value="Tesla">Tesla</option>' +
										'<option value="Toyota">Toyota</option>' +
										'<option value="Volkswagen">Volkswagen</option>' +
										'<option value="Volvo">Volvo</option>' +
										'<option value="Zabytkowe">Zabytkowe</option>' +
										'<option value="Inna marka">Inna marka</option>';
										mS3.style='display: block; display: inline-block;';
										
				mS5.style='display: block;';
				mS5.innerHTML='<div>' +
											'<b>Moc silnika (km)</b> <span style="color: red;">*</span><br><input maxlength="4" name="Moc_silnika" <?php if(isset($_POST['Moc_silnika']) && $_POST['Moc_silnika'] != ''){ echo 'value='.$_POST['Moc_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Poj. silnika (cm³)</b> <span style="color: red;">*</span><br><input maxlength="5" name="Poj_silnika" <?php if(isset($_POST['Poj_silnika']) && $_POST['Poj_silnika'] != ''){ echo 'value='.$_POST['Poj_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Rok produkcji</b> <span style="color: red;">*</span><br><input maxlength="4" name="Rok_produkcji" <?php if(isset($_POST['Rok_produkcji']) && $_POST['Rok_produkcji'] != ''){ echo 'value='.$_POST['Rok_produkcji'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Przebieg</b> <span style="color: red;">*</span><br><input maxlength="7" name="Przebieg" <?php if(isset($_POST['Przebieg']) && $_POST['Przebieg'] != ''){ echo 'value='.$_POST['Przebieg'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
										'</div>' +
										'<div>' +
											'<b>Nadwozie</b> <span style="color: red;">*</span><br>' +
											'<select name="Nadwozie" placeholder="Nadwozie" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Coupe" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Coupe'){ echo "selected";} ?>>Coupe</option>' +
												'<option value="Hatchback" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Hatchback'){ echo "selected";} ?>>Hatchback</option>' +
												'<option value="Kabriolet" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Kabriolet'){ echo "selected";} ?>>Kabriolet</option>' +
												'<option value="Kombi" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Kombi'){ echo "selected";} ?>>Kombi</option>' +
												'<option value="Minivan" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Minivan'){ echo "selected";} ?>>Minivan</option>' +
												'<option value="Pickup" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Pickup'){ echo "selected";} ?>>Pickup</option>' +
												'<option value="Sedan" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Sedan'){ echo "selected";} ?>>Sedan</option>' +
												'<option value="Suv" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Suv'){ echo "selected";} ?>>Suv</option>' +
												'<option value="Terenowy" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Terenowy'){ echo "selected";} ?>>Terenowy</option>' +
												'<option value="Van" <?php if(isset($_POST['Nadwozie']) && $_POST['Nadwozie'] == 'Van'){ echo "selected";} ?>>Van</option>' +
											'</select>' +
											'<br>' +
											'<br><b>Paliwo</b> <span style="color: red;">*</span><br>' +
											'<select name="Paliwo" placeholder="Paliwo" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Benzyna" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Benzyna'){ echo "selected";} ?>>Benzyna</option>' +
												'<option value="Benzyna+LPG" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Benzyna+LPG'){ echo "selected";} ?>>Benzyna+LPG</option>' +
												'<option value="Diesel" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Diesel'){ echo "selected";} ?>>Diesel</option>' +
												'<option value="Elektryczny" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Elektryczny'){ echo "selected";} ?>>Elektryczny</option>' +
												'<option value="Hybryda(Benzyna)" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Hybryda(Benzyna)'){ echo "selected";} ?>>Hybryda(Benzyna)</option>' +
												'<option value="Hybryda(Diesel)" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Hybryda(Diesel)'){ echo "selected";} ?>>Hybryda(Diesel)</option>' +
											'</select>' +
											'<br>' +
											'<br><b>Skrzynia biegów</b> <span style="color: red;">*</span><br>' +
											'<select name="Skrzynia_biegow" placeholder="Skrzynia biegów" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Automatyczna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Automatyczna'){ echo "selected";} ?>>Automatyczna</option>' +
												'<option value="Manualna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Manualna'){ echo "selected";} ?>>Manualna</option>' +
												'<option value="Sekwencyjna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Sekwencyjna'){ echo "selected";} ?>>Sekwencyjna</option>' +
											'</select>' +
											'<br>' +
											'<br><b>Kolor</b> <span style="color: red;">*</span><br>' +
											'<select name="Kolor" placeholder="Kolor" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Bialy" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Bialy'){ echo "selected";} ?>>Biały</option>' +
												'<option value="Czarny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Czarny'){ echo "selected";} ?>>Czarny</option>' +
												'<option value="Czerwony" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Czerwony'){ echo "selected";} ?>>Czerwony</option>' +
												'<option value="Niebieski" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Niebieski'){ echo "selected";} ?>>Niebieski</option>' +
												'<option value="Srebny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Srebny'){ echo "selected";} ?>>Srebny</option>' +
												'<option value="Szary" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Szary'){ echo "selected";} ?>>Szary</option>' +
												'<option value="Zielony" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Zielony'){ echo "selected";} ?>>Zielony</option>' +
												'<option value="Zolty" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Zolty'){ echo "selected";} ?>>Żółty</option>' +
												'<option value="Inny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Inny'){ echo "selected";} ?>>Inny</option>' +
											'</select>' + 
										'</div>' +
										'<div>' +
											'<br><b>Stan techniczny</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_techniczny" placeholder="Stan techniczny" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nieuszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Nieuszkodzony'){ echo "selected";} ?>>Nieuszkodzony</option>' +
												'<option value="Uszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Uszkodzony'){ echo "selected";} ?>>Uszkodzony</option>' +
											'</select>' +
											'<br>' +
											'<br><b>Stan użytkowy</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_uzytkowy" placeholder="Stan użytkowy" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nowy" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Nowy'){ echo "selected";} ?>>Nowy</option>' +
												'<option value="Uzywany" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Uzywany'){ echo "selected";} ?>>Używany</option>' +
											'</select>' +
										'</div>' +
										'<br>' +
										'<br>' +
										'<hr>' +
										'<br>' +
										'<br><b>Posiadane wyposażenie</b><br><br>' +
										'<div class="col">' +	
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ABS">ABS</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ASR">ASR</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Alarm">Alarm</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Alufelgi">Alufelgi</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Asystent pasa ruchu">Asystent pasa ruchu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Bluetooth">Bluetooth</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="CD">CD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Czujnik deszczu">Czujnik deszczu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Czujnik zmierzchu">Czujnik zmierzchu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Czujniki parkowania">Czujniki parkowania</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ESP">ESP</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne fotele">Elektryczne fotele</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne lusterka">Elektryczne lusterka</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne szyby">Elektryczne szyby</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="EDL">EDL</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Fotochromatyczne lusterka boczne">Fotochromatyczne lusterka boczne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Fotochromatyczne lusterko wsteczne">Fotochromatyczne lusterko wsteczne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Hak">Hak</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Isofix">Isofix</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Kierownica wielofunkcyjna">Kierownica wielofunkcyjna</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Klimatyzacja">Klimatyzacja</div></label><br>' +									
										'</div>' +
										'<div class="col">' +	
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Komputer pokładowy">Komputer pokładowy</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="MP3">MP3</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Odtwarzacz DVD">Odtwarzacz DVD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Podgrzewana przednia szyba">Podgrzewana przednia szyba</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Podgrzewane fotele">Podgrzewane fotele</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Poduszki powietrzne">Poduszki powietrzne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Radio fabryczne">Radio fabryczne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Regulacja wysokości podwozia">Regulacja wysokości podwozia</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Relingi dachowe">Relingi dachowe</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Skórzana tapicerka">Skórzana tapicerka</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Szyberdach">Szyberdach</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Tempomat">Tempomat</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Tempomat aktywny">Tempomat aktywny</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Webasto">Webasto</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Wspomaganie kierownicy">Wspomaganie kierownicy</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Wzmacniacz audio">Wzmacniacz audio</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Przyciemniane szyby">Przyciemniane szyby</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Zmieniarka CD">Zmieniarka CD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Nawigacja">Nawigacja</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Xenony">Xenony</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Światła do jazdy dziennej">Światła do jazdy dziennej</div></label><br>' +
										'</div>' +				
										'<br>' +				
										'<br>' +		
										'<hr>' +				
										'<br>' +												
										'<br>';												
				mS6.style='display: block; margin-top: 25px;';						
			}
			if(mS2.value==='Samochody ciezarowe'){
				mS10.innerHTML='<b>Marka</b> <span style="color: red;">*</span>';
				mS3.innerHTML='<option value="0"></option>' +
										'<option value="DAF">DAF</option>' +
										'<option value="Iveco">Iveco</option>' +
										'<option value="Jelcz">Jelcz</option>' +
										'<option value="MAN">MAN</option>' +
										'<option value="Mercedes">Mercedes</option>' +
										'<option value="Renault">Renault</option>' +
										'<option value="Scania">Scania</option>' +
										'<option value="Star">Star</option>' +
										'<option value="Volvo">Volvo</option>' +
										'<option value="Inna marka">Inna marka</option>';
										mS3.style='display: block; display: inline-block;';
				mS5.style='display: block;';
				mS5.innerHTML='<div>' +
											'<b>Moc silnika (km)</b> <span style="color: red;">*</span><br><input maxlength="4" name="Moc_silnika" <?php if(isset($_POST['Moc_silnika']) && $_POST['Moc_silnika'] != ''){ echo 'value='.$_POST['Moc_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Poj. silnika (cm³)</b> <span style="color: red;">*</span><br><input maxlength="5" name="Poj_silnika" <?php if(isset($_POST['Poj_silnika']) && $_POST['Poj_silnika'] != ''){ echo 'value='.$_POST['Poj_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Rok produkcji</b> <span style="color: red;">*</span><br><input maxlength="4" name="Rok_produkcji" <?php if(isset($_POST['Rok_produkcji']) && $_POST['Rok_produkcji'] != ''){ echo 'value='.$_POST['Rok_produkcji'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Przebieg</b> <span style="color: red;">*</span><br><input maxlength="7" name="Przebieg" <?php if(isset($_POST['Przebieg']) && $_POST['Przebieg'] != ''){ echo 'value='.$_POST['Przebieg'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
										'</div>' +
										'<div>' +
										'<b>Paliwo</b> <span style="color: red;">*</span><br>' +
											'<select name="Paliwo" placeholder="Paliwo" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Diesel" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Diesel'){ echo "selected";} ?>>Diesel</option>' +
												'<option value="Elektryczny" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Elektryczny'){ echo "selected";} ?>>Elektryczny</option>' +
												'<option value="Hybryda(Diesel)" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Hybryda(Diesel)'){ echo "selected";} ?>>Hybryda(Diesel)</option>' +
											'</select>' +
											'<br>' +
											'<br><b>Skrzynia biegów</b> <span style="color: red;">*</span><br>' +
											'<select name="Skrzynia_biegow" placeholder="Skrzynia biegów" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Automatyczna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Automatyczna'){ echo "selected";} ?>>Automatyczna</option>' +
												'<option value="Manualna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Manualna'){ echo "selected";} ?>>Manualna</option>' +
												'<option value="Sekwencyjna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Sekwencyjna'){ echo "selected";} ?>>Sekwencyjna</option>' +
											'</select>' +
											'<br>' +
											'<br><b>Kolor</b> <span style="color: red;">*</span><br>' +
											'<select name="Kolor" placeholder="Kolor" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Bialy" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Bialy'){ echo "selected";} ?>>Biały</option>' +
												'<option value="Czarny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Czarny'){ echo "selected";} ?>>Czarny</option>' +
												'<option value="Czerwony" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Czerwony'){ echo "selected";} ?>>Czerwony</option>' +
												'<option value="Niebieski" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Niebieski'){ echo "selected";} ?>>Niebieski</option>' +
												'<option value="Srebny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Srebny'){ echo "selected";} ?>>Srebny</option>' +
												'<option value="Szary" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Szary'){ echo "selected";} ?>>Szary</option>' +
												'<option value="Zielony" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Zielony'){ echo "selected";} ?>>Zielony</option>' +
												'<option value="Zolty" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Zolty'){ echo "selected";} ?>>Żółty</option>' +
												'<option value="Inny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Inny'){ echo "selected";} ?>>Inny</option>' +
											'</select>' + 
										'</div>' +
										'<div>' +
											'<br><b>Stan techniczny</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_techniczny" placeholder="Stan techniczny" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nieuszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Nieuszkodzony'){ echo "selected";} ?>>Nieuszkodzony</option>' +
												'<option value="Uszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Uszkodzony'){ echo "selected";} ?>>Uszkodzony</option>' +
											'</select>' +
											'<br>' +
											'<br><b>Stan użytkowy</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_uzytkowy" placeholder="Stan użytkowy" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nowy" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Nowy'){ echo "selected";} ?>>Nowy</option>' +
												'<option value="Uzywany" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Uzywany'){ echo "selected";} ?>>Używany</option>' +
											'</select>' +
										'</div>' +
										'<br>' +
										'<br>' +
										'<hr>' +
										'<br>' +
										'<br><b>Posiadane wyposażenie</b><br><br>' +
										'<div class="col">' +	
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ABS">ABS</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ASR">ASR</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Alarm">Alarm</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Asystent pasa ruchu">Asystent pasa ruchu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Bluetooth">Bluetooth</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="CD">CD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Czujnik deszczu">Czujnik deszczu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Czujnik zmierzchu">Czujnik zmierzchu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ESP">ESP</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne fotele">Elektryczne fotele</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne lusterka">Elektryczne lusterka</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne szyby">Elektryczne szyby</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Fotochromatyczne lusterka boczne">Fotochromatyczne lusterka boczne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Kierownica wielofunkcyjna">Kierownica wielofunkcyjna</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Klimatyzacja">Klimatyzacja</div></label><br>' +			
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Komputer pokładowy">Komputer pokładowy</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="MP3">MP3</div></label><br>' +										
										'</div>' +
										'<div class="col">' +	
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Odtwarzacz DVD">Odtwarzacz DVD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Podgrzewana przednia szyba">Podgrzewana przednia szyba</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Podgrzewane fotele">Podgrzewane fotele</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Poduszki powietrzne">Poduszki powietrzne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Radio fabryczne">Radio fabryczne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Regulacja wysokości podwozia">Regulacja wysokości podwozia</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Skórzana tapicerka">Skórzana tapicerka</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Szyberdach">Szyberdach</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Tempomat">Tempomat</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Tempomat aktywny">Tempomat aktywny</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Webasto">Webasto</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Wspomaganie kierownicy">Wspomaganie kierownicy</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Przyciemniane szyby">Przyciemniane szyby</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Zmieniarka CD">Zmieniarka CD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Nawigacja">Nawigacja</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Xenony">Xenony</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Światła do jazdy dziennej">Światła do jazdy dziennej</div></label><br>' +
										'</div>' +
										'<br>' +				
										'<br>' +		
										'<hr>' +				
										'<br>' +												
										'<br>';					
				mS6.style='display: block; margin-top: 25px;';
								
			}
			
			if(mS2.value==='Samochody dostawcze'){
				mS10.innerHTML='<b>Marka</b> <span style="color: red;">*</span>';
				mS3.innerHTML='<option value="0"></option>' +
										'<option value="Citroen">Citroen</option>' +
										'<option value="Fiat">Fiat</option>' +
										'<option value="Ford">Ford</option>' +
										'<option value="Iveco">Iveco</option>' +
										'<option value="Mercedes">Mercedes</option>' +
										'<option value="Opel">Opel</option>' +
										'<option value="Peugeot">Peugeot</option>' +
										'<option value="Renault">Renault</option>' +
										'<option value="Volkswagen">Volkswagen</option>' +
										'<option value="Inna marka">Inna marka</option>';
										mS3.style='display: block; display: inline-block;';
				mS5.style='display: block;';
				mS5.innerHTML='<div>' +
											'<b>Moc silnika (km)</b> <span style="color: red;">*</span><br><input maxlength="4" name="Moc_silnika" <?php if(isset($_POST['Moc_silnika']) && $_POST['Moc_silnika'] != ''){ echo 'value='.$_POST['Moc_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Poj. silnika (cm³)</b> <span style="color: red;">*</span><br><input maxlength="5" name="Poj_silnika" <?php if(isset($_POST['Poj_silnika']) && $_POST['Poj_silnika'] != ''){ echo 'value='.$_POST['Poj_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Rok produkcji</b> <span style="color: red;">*</span><br><input maxlength="4" name="Rok_produkcji" <?php if(isset($_POST['Rok_produkcji']) && $_POST['Rok_produkcji'] != ''){ echo 'value='.$_POST['Rok_produkcji'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Przebieg</b> <span style="color: red;">*</span><br><input maxlength="7" name="Przebieg" <?php if(isset($_POST['Przebieg']) && $_POST['Przebieg'] != ''){ echo 'value='.$_POST['Przebieg'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
										'</div>' +
										'<div>' +
										'<b>Paliwo</b> <span style="color: red;">*</span><br>' +
											'<select name="Paliwo" placeholder="Paliwo" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Benzyna" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Benzyna'){ echo "selected";} ?>>Benzyna</option>' +
												'<option value="Benzyna+LPG" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Benzyna+LPG'){ echo "selected";} ?>>Benzyna+LPG</option>' +
												'<option value="Diesel" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Diesel'){ echo "selected";} ?>>Diesel</option>' +
												'<option value="Elektryczny" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Elektryczny'){ echo "selected";} ?>>Elektryczny</option>' +
												'<option value="Hybryda(Benzyna)" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Hybryda(Benzyna)'){ echo "selected";} ?>>Hybryda(Benzyna)</option>' +
												'<option value="Hybryda(Diesel)" <?php if(isset($_POST['Paliwo']) && $_POST['Paliwo'] == 'Hybryda(Diesel)'){ echo "selected";} ?>>Hybryda(Diesel)</option>' +
											'</select>' +
											'<br><br><b>Skrzynia biegów</b> <span style="color: red;">*</span><br>' +
											'<select name="Skrzynia_biegow" placeholder="Skrzynia biegów" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Automatyczna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Automatyczna'){ echo "selected";} ?>>Automatyczna</option>' +
												'<option value="Manualna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Manualna'){ echo "selected";} ?>>Manualna</option>' +
												'<option value="Sekwencyjna" <?php if(isset($_POST['Skrzynia_biegow']) && $_POST['Skrzynia_biegow'] == 'Sekwencyjna'){ echo "selected";} ?>>Sekwencyjna</option>' +
											'</select>' +
											'<br><br><b>Kolor</b> <span style="color: red;">*</span><br>' +
											'<select name="Kolor" placeholder="Kolor" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Bialy" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Bialy'){ echo "selected";} ?>>Biały</option>' +
												'<option value="Czarny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Czarny'){ echo "selected";} ?>>Czarny</option>' +
												'<option value="Czerwony" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Czerwony'){ echo "selected";} ?>>Czerwony</option>' +
												'<option value="Niebieski" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Niebieski'){ echo "selected";} ?>>Niebieski</option>' +
												'<option value="Srebny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Srebny'){ echo "selected";} ?>>Srebny</option>' +
												'<option value="Szary" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Szary'){ echo "selected";} ?>>Szary</option>' +
												'<option value="Zielony" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Zielony'){ echo "selected";} ?>>Zielony</option>' +
												'<option value="Zolty" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Zolty'){ echo "selected";} ?>>Żółty</option>' +
												'<option value="Inny" <?php if(isset($_POST['Kolor']) && $_POST['Kolor'] == 'Inny'){ echo "selected";} ?>>Inny</option>' +
											'</select>' + 
										'</div>' +
										'<div>' +
											'<br><b>Stan techniczny</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_techniczny" placeholder="Stan techniczny" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nieuszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Nieuszkodzony'){ echo "selected";} ?>>Nieuszkodzony</option>' +
												'<option value="Uszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Uszkodzony'){ echo "selected";} ?>>Uszkodzony</option>' +
											'</select>' +
											'<br><br><b>Stan użytkowy</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_uzytkowy" placeholder="Stan użytkowy" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nowy" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Nowy'){ echo "selected";} ?>>Nowy</option>' +
												'<option value="Uzywany" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Uzywany'){ echo "selected";} ?>>Używany</option>' +
											'</select>' +
										'</div>' +
										'<br>' +
										'<br>' +
										'<hr>' +
										'<br>' +
										'<br><b>Posiadane wyposażenie</b><br><br>' +
										'<div class="col">' +	
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ABS">ABS</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ASR">ASR</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Alarm">Alarm</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Asystent pasa ruchu">Asystent pasa ruchu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Bluetooth">Bluetooth</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="CD">CD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Czujnik deszczu">Czujnik deszczu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Czujnik zmierzchu">Czujnik zmierzchu</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="ESP">ESP</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne fotele">Elektryczne fotele</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne lusterka">Elektryczne lusterka</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Elektryczne szyby">Elektryczne szyby</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Fotochromatyczne lusterka boczne">Fotochromatyczne lusterka boczne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Kierownica wielofunkcyjna">Kierownica wielofunkcyjna</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Klimatyzacja">Klimatyzacja</div></label><br>' +			
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Komputer pokładowy">Komputer pokładowy</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="MP3">MP3</div></label><br>' +										
										'</div>' +
										'<div class="col">' +	
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Odtwarzacz DVD">Odtwarzacz DVD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Podgrzewana przednia szyba">Podgrzewana przednia szyba</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Podgrzewane fotele">Podgrzewane fotele</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Poduszki powietrzne">Poduszki powietrzne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Radio fabryczne">Radio fabryczne</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Regulacja wysokości podwozia">Regulacja wysokości podwozia</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Skórzana tapicerka">Skórzana tapicerka</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Szyberdach">Szyberdach</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Tempomat">Tempomat</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Tempomat aktywny">Tempomat aktywny</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Webasto">Webasto</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Wspomaganie kierownicy">Wspomaganie kierownicy</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Przyciemniane szyby">Przyciemniane szyby</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Zmieniarka CD">Zmieniarka CD</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Nawigacja">Nawigacja</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Xenony">Xenony</div></label><br>' +
												'<label><div class="cols"><input type="checkbox" name="wyp[]" value="Światła do jazdy dziennej">Światła do jazdy dziennej</div></label><br>' +
										'</div>' +
										'<br>' +				
										'<br>' +		
										'<hr>' +				
										'<br>' +												
										'<br>';					
				mS6.style='display: block; margin-top: 25px;';
			}
			
			if(mS2.value==='Motocykle i skutery'){
				mS10.innerHTML='<b>Typ</b> <span style="color: red;">*</span>';
				mS3.innerHTML='<option value="0">Wybierz typ</option>' +
										'<option value="Motocykle">Motocykle</option>' +
										'<option value="Skutery">Skutery</option>' +
										'<option value="Quady ATV">Quady, ATV</option>';
										mS3.style='display: block; display: inline-block;';
				mS5.style='display: block;';
				mS5.innerHTML='<div>' +
											'<b>Moc silnika (km)</b> <span style="color: red;">*</span><br><input maxlength="4" name="Moc_silnika" <?php if(isset($_POST['Moc_silnika']) && $_POST['Moc_silnika'] != ''){ echo 'value='.$_POST['Moc_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Poj. silnika (cm³)</b> <span style="color: red;">*</span><br><input maxlength="5" name="Poj_silnika" <?php if(isset($_POST['Poj_silnika']) && $_POST['Poj_silnika'] != ''){ echo 'value='.$_POST['Poj_silnika'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Rok produkcji</b> <span style="color: red;">*</span><br><input maxlength="4" name="Rok_produkcji" <?php if(isset($_POST['Rok_produkcji']) && $_POST['Rok_produkcji'] != ''){ echo 'value='.$_POST['Rok_produkcji'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
											'<b>Przebieg</b> <span style="color: red;">*</span><br><input maxlength="7" name="Przebieg" <?php if(isset($_POST['Przebieg']) && $_POST['Przebieg'] != ''){ echo 'value='.$_POST['Przebieg'];} ?> type="text" onkeydown="return noNum(event)" class="filters-addogl-input"></input><br><br>' +
										'</div>' +
										'<div>' +
											'<b>Stan techniczny</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_techniczny" placeholder="Stan techniczny" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nieuszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Nieuszkodzony'){ echo "selected";} ?>>Nieuszkodzony</option>' +
												'<option value="Uszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Uszkodzony'){ echo "selected";} ?>>Uszkodzony</option>' +
											'</select>' +
											'<br><br><b>Stan użytkowy</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_uzytkowy" placeholder="Stan użytkowy" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nowy" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Nowy'){ echo "selected";} ?>>Nowy</option>' +
												'<option value="Uzywany" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Uzywany'){ echo "selected";} ?>>Używany</option>' +
											'</select>' +
										'</div>' +
										'<br>' +				
										'<br>' +		
										'<hr>' +				
										'<br>' +												
										'<br>';		
				mS7.style='display: block; margin-top: 25px;';
			}
			
			if(mS2.value==='Pojazdy rolnicze'){
				mS5.style='display: block;';
				mS5.innerHTML='<div>' +
											'<br><b>Stan techniczny</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_techniczny" placeholder="Stan techniczny" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nieuszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Nieuszkodzony'){ echo "selected";} ?>>Nieuszkodzony</option>' +
												'<option value="Uszkodzony" <?php if(isset($_POST['Stan_techniczny']) && $_POST['Stan_techniczny'] == 'Uszkodzony'){ echo "selected";} ?>>Uszkodzony</option>' +
											'</select>' +
											'<br><br><b>Stan użytkowy</b> <span style="color: red;">*</span><br>' +
											'<select name="Stan_uzytkowy" placeholder="Stan użytkowy" class="filters-addogl-input">' +
												'<option value="0"></option>' +
												'<option value="Nowy" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Nowy'){ echo "selected";} ?>>Nowy</option>' +
												'<option value="Uzywany" <?php if(isset($_POST['Stan_uzytkowy']) && $_POST['Stan_uzytkowy'] == 'Uzywany'){ echo "selected";} ?>>Używany</option>' +
											'</select>' +
										'</div>' +
										'<br>' +				
										'<br>' +		
										'<hr>' +				
										'<br>' +												
										'<br>';			
				mS6.style='display: block; margin-top: 25px;';
			}
			
			if(mS2.value==='Felgi i opony' || mS2.value==='Sprzet audio' || mS2.value==='Pozostale'){
				mS7.style='display: block; margin-top: 25px;';
			}
		}

		if(mS.value==='Elektronika'){
			if(mS2.value==='Komputery' || mS2.value==='Telewizory' 
				|| mS2.value==='Telefony' || mS2.value==='Tablety' || mS2.value==='Konsole' || mS2.value==='Akcesoria' || mS2.value==='Pozostale' || mS2.value==='Elektronika'){
				mS7.style='display: block; margin-top: 25px;';
			}
		}

		if(mS.value==='Nieruchomosci'){
			if(mS2.value==='Mieszkania' || mS2.value==='Garaze' || mS2.value==='Dzialki'
				|| mS2.value==='Domy' || mS2.value==='Pozostale'){
				mS3.innerHTML='<option value="0">Wybierz typ</option>' +
									'<option value="Sprzedam">Sprzedam</option>' +
									'<option value="Wynajme">Wynajmę</option>';
									mS3.style='display: block; display: inline-block;';
				mS6.style='display: block; margin-top: 25px;';
			}
		}

		if(mS.value=='Dom i ogrod'){
			if(mS2.value==='Sprzet RTV/AGD' || mS2.value==='Oswietlenie' || mS2.value==='Ogrod' || mS2.value==='Meble' || mS2.value==='Pozostale'){
				mS7.style='display: block; margin-top: 25px;';
			}
		}

		if(mS.value=='Praca'){
			if(mS2.value==='Dorywcza' || mS2.value==='Za granica' || mS2.value==='W kraju' || mS2.value==='Uslugi' || mS2.value==='Pozostale'){
				mS8.style='display: block; margin-top: 25px;';
			}
		}

		if(mS.value=='Odziez'){
			if(mS2.value==='Ubrania' || mS2.value==='Dodatki' || mS2.value==='Zegarki' || mS2.value==='Buty' || mS2.value==='Pozostale'){
				mS7.style='display: block; margin-top: 25px;';
			}
		}

		if(mS.value=='Zwierzeta'){
			if(mS2.value==='Schroniska' || mS2.value==='Psy' || mS2.value==='Koty' || mS2.value==='Pozostale zwierzeta' || mS2.value==='Dla zwierzat'){
				mS7.style='display: block; margin-top: 25px;';
			}
			mS7.style='display: block; margin-top: 25px;';
		}
		
	}	
	mS3.onchange=function() { 
		mS4.style='display: none;';
		mS12.innerHTML='';
		if(mS2.value == 'Motocykle i skutery'){
			if(mS3.value == 'Motocykle'){
				mS12.innerHTML='<b>Marka</b> <span style="color: red;">*</span>';
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Aprilia">Aprilia</option>' +
										'<option value="BMW">BMW</option>' +
										'<option value="Barton">Barton</option>' +
										'<option value="Ducati">Ducati</option>' +
										'<option value="Honda">Honda</option>' +
										'<option value="Jawa">Jawa</option>' +
										'<option value="Junak">Junak</option>' +
										'<option value="KTM">KTM</option>' +
										'<option value="Kawasaki">Kawasaki</option>' +
										'<option value="Kimco">Kimco</option>' +
										'<option value="MZ">MZ</option>' +
										'<option value="Rieju">Rieju</option>' +
										'<option value="Romet">Romet</option>' +
										'<option value="SHL">SHL</option>' +
										'<option value="Simson">Simson</option>' +
										'<option value="Suzuki">Suzuki</option>' +
										'<option value="WSK">WSK</option>' +
										'<option value="Yamaha">Yamaha</option>' +
										'<option value="0">Inna marka</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			if(mS3.value == 'Skutery'){
				mS12.innerHTML='<b>Marka</b> <span style="color: red;">*</span>';
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Adiva">Adiva</option>' +
										'<option value="Aprilia">Aprilia</option>' +
										'<option value="BMW">BMW</option>' +
										'<option value="Barton">Barton</option>' +
										'<option value="Honda">Honda</option>' +
										'<option value="Junak">Junak</option>' +
										'<option value="Kawasaki">Kawasaki</option>' +
										'<option value="Kymco">Kymco</option>' +
										'<option value="Peugeot">Peugeot</option>' +
										'<option value="Piaggio">Piaggio</option>' +
										'<option value="Romet">Romet</option>' +
										'<option value="Suzuki">Suzuki</option>' +
										'<option value="Yamaha">Yamaha</option>' +
										'<option value="0">Inna marka</option>';
										mS4.style='display: block; display: inline-block;';
			}
			if(mS3.value == 'Quady ATV'){
				mS12.innerHTML='<b>Marka</b> <span style="color: red;">*</span>';
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Bashan">Bashan</option>' +
										'<option value="Benyco">Benyco</option>' +
										'<option value="Beretta">Beretta</option>' +
										'<option value="Grizzly">Grizzly</option>' +
										'<option value="Honda">Honda</option>' +
										'<option value="Hummer">Hummer</option>' +
										'<option value="Kawasaki">Kawasaki</option>' +
										'<option value="Phyton">Phyton</option>' +
										'<option value="Polaris">Polaris</option>' +
										'<option value="Romet">Romet</option>' +
										'<option value="Suzuki">Suzuki</option>' +
										'<option value="Yamaha">Yamaha</option>' +
										'<option value="0">Inna marka</option>';
										mS4.style='display: block; display: inline-block;';
			}
		}
		if(mS2.value == 'Samochody osobowe'){
			mS12.innerHTML='<b>Model</b> <span style="color: red;">*</span>';
			if(mS3.value==='Abarth'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="124 Spider">124 Spider</option>' +
										'<option value="500">500</option>' +
										'<option value="Grande Punto">Grande Punto</option>' +
										'<option value="Punto">Punto</option>' +
										'<option value="Punto Evo">Punto Evo</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
										
			}
			
			if(mS3.value==='Acura'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="CDX">CDX</option>' +
										'<option value="ILX">ILX</option>' +
										'<option value="MDX">MDX</option>' +
										'<option value="RDX">RDX</option>' +
										'<option value="RLX">RLX</option>' +
										'<option value="TLX">TLX</option>' +
										'<option value="TSX">TSX</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Alfa Romeo'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="145">145</option>' +
										'<option value="146">146</option>' +
										'<option value="147">147</option>' +
										'<option value="155">155</option>' +
										'<option value="156">156</option>' +
										'<option value="159">159</option>' +
										'<option value="164">164</option>' +
										'<option value="159">166</option>' +
										'<option value="4C">4C</option>' +
										'<option value="Brera">Brera</option>' +
										'<option value="GT">GT</option>' +
										'<option value="GTV">GTV</option>' +
										'<option value="Giulia">Giulia</option>' +
										'<option value="Giulietta">Giulietta</option>' +
										'<option value="Mito">Mito</option>' +
										'<option value="Spider">Spider</option>' +
										'<option value="Stelvio">Stelvio</option>' +
										'<option value="Inne">Inne</option>';		
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Aston Martin'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="DB11">DB11</option>' +
										'<option value="DB7">DB7</option>' +
										'<option value="DB9">DB9</option>' +
										'<option value="DBS Superleggera">DBS Superleggera</option>' +
										'<option value="One-77">One-77</option>' +
										'<option value="Rapide">Rapide</option>' +
										'<option value="Vantage">Vantage</option>' +
										'<option value="Vanquish">Vanquish</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Audi'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="80">80</option>' +
										'<option value="90">90</option>' +
										'<option value="100">100</option>' +
										'<option value="200">200</option>' +
										'<option value="A1">A1</option>' +
										'<option value="A2">A2</option>' +
										'<option value="A3">A3</option>' +
										'<option value="A4">A4</option>' +
										'<option value="A5">A5</option>' +
										'<option value="A6">A6</option>' +
										'<option value="A7">A7</option>' +
										'<option value="A8">A8</option>' +
										'<option value="S1">S1</option>' +
										'<option value="S2">S2</option>' +
										'<option value="S3">S3</option>' +
										'<option value="S4">S4</option>' +
										'<option value="S5">S5</option>' +
										'<option value="S6">S6</option>' +
										'<option value="S7">S7</option>' +
										'<option value="S8">S8</option>' +
										'<option value="RS1">RS1</option>' +
										'<option value="RS2">RS2</option>' +
										'<option value="RS3">RS3</option>' +
										'<option value="RS4">RS4</option>' +
										'<option value="RS5">RS5</option>' +
										'<option value="RS6">RS6</option>' +
										'<option value="RS7">RS7</option>' +
										'<option value="RS8">RS8</option>' +
										'<option value="Q1">Q1</option>' +
										'<option value="Q2">Q2</option>' +
										'<option value="Q3">Q3</option>' +
										'<option value="Q4">Q4</option>' +
										'<option value="Q5">Q5</option>' +
										'<option value="Q6">Q6</option>' +
										'<option value="Q7">Q7</option>' +
										'<option value="Q8">Q8</option>' +
										'<option value="E-Tron">E-Tron</option>' +
										'<option value="TT">TT</option>' +
										'<option value="R8">R8</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';			
			}
			
			if(mS3.value==='Bentley'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Bentayga">Bentayga</option>' +
										'<option value="Continental">Continental</option>' +
										'<option value="Flying Spur">Flying Spur</option>' +
										'<option value="Mulsanne">Mulsanne</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';			
			}
			
			if(mS3.value==='BMW'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="M1">M1</option>' +
										'<option value="M2">M2</option>' +
										'<option value="M3">M3</option>' +
										'<option value="M4">M4</option>' +
										'<option value="M5">M5</option>' +
										'<option value="M6">M6</option>' +
										'<option value="M7">M7</option>' +
										'<option value="M8">M8</option>' +
										'<option value="Seria 1">Seria 1</option>' +
										'<option value="Seria 2">Seria 2</option>' +
										'<option value="Seria 3">Seria 3</option>' +
										'<option value="Seria 4">Seria 4</option>' +
										'<option value="Seria 5">Seria 5</option>' +
										'<option value="Seria 6">Seria 6</option>' +
										'<option value="Seria 7">Seria 7</option>' +
										'<option value="Seria 8">Seria 8</option>' +
										'<option value="i3">i3</option>' +
										'<option value="i8">i8</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';			
			}	

			if(mS3.value==='Bugatti'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Veyron">Veyron</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';			
			}	

			if(mS3.value==='Cadilac'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="ATS">ATS</option>' +
										'<option value="CT6">CT6</option>' +
										'<option value="CTS">CTS</option>' +
										'<option value="ELR">ELR</option>' +
										'<option value="Escalade">Escalade</option>' +
										'<option value="SLS">SLS</option>' +
										'<option value="SRX">SRX</option>' +
										'<option value="XT5">XT5</option>' +
										'<option value="XTS">XTS</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	

			if(mS3.value==='Chevrolet'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Aveo">Aveo</option>' +
										'<option value="Camaro">Camaro</option>' +
										'<option value="Captiva">Captiva</option>' +
										'<option value="Cruze">Cruze</option>' +
										'<option value="Epica">Epica</option>' +
										'<option value="Evanda">Evanda</option>' +
										'<option value="Lacetti">Lacetti</option>' +
										'<option value="Malibu">Malibu</option>' +
										'<option value="Orlando">Orlando</option>' +
										'<option value="Spark">Spark</option>' +
										'<option value="Tacuma">Tacuma</option>' +
										'<option value="Trax">Trax</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	

			if(mS3.value==='Chrysler'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="300C">300C</option>' +
										'<option value="300M">300M</option>' +
										'<option value="Caravan">Caravan</option>' +
										'<option value="Intrepid">Intrepid</option>' +
										'<option value="Neon">Neon</option>' +
										'<option value="PT Cruiser">PT Cruiser</option>' +
										'<option value="Sebring">Sebring</option>' +
										'<option value="Stratus">Stratus</option>' +
										'<option value="Town Country">Town Country</option>' +
										'<option value="Vision">Vision</option>' +
										'<option value="Voyager">Voyager</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}

			if(mS3.value==='Citroen'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Berlingo">Berlingo</option>' +
										'<option value="C-Elysee">C-Elysee</option>' +
										'<option value="C1">C1</option>' +
										'<option value="C2">C2</option>' +
										'<option value="C3">C3</option>' +
										'<option value="C4">C4</option>' +
										'<option value="C4 Aircross">C4 Aircross</option>' +
										'<option value="C4 Cactus">C4 Cactus</option>' +
										'<option value="C4 Picasso">C4 Picasso</option>' +
										'<option value="C5">C5</option>' +
										'<option value="C5 Aircross">C5 Aircross</option>' +
										'<option value="C6">C6</option>' +
										'<option value="C8">C8</option>' +
										'<option value="DS3">DS3</option>' +
										'<option value="DS4">DS4</option>' +
										'<option value="DS5">DS5</option>' +
										'<option value="Evasion">Evasion</option>' +
										'<option value="Nemo">Nemo</option>' +
										'<option value="Saxo">Saxo</option>' +
										'<option value="XM">XM</option>' +
										'<option value="Xantia">Xantia</option>' +
										'<option value="Xsara">Xsara</option>' +
										'<option value="Xsara Picasso">Xsara Picasso</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Dacia'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Dokker">Dokker</option>' +
										'<option value="Duster">Duster</option>' +
										'<option value="Lodgy">Lodgy</option>' +
										'<option value="Logan">Logan</option>' +
										'<option value="Nova">Nova</option>' +
										'<option value="Sandero">Sandero</option>' +
										'<option value="Sandero Stepway">Sandero Stepway</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';					
			}
			
			if(mS3.value==='Daewoo'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Espero">Espero</option>' +
										'<option value="Kalos">Kalos</option>' +
										'<option value="Lanos">Lanos</option>' +
										'<option value="Leganza">Leganza</option>' +
										'<option value="Matiz">Matiz</option>' +
										'<option value="Nubira">Nubira</option>' +
										'<option value="Rezzo">Rezzo</option>' +
										'<option value="Tacuma">Tacuma</option>' +
										'<option value="Tico">Tico</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';				
			}
			
			if(mS3.value==='Daihatsu'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Coure">Coure</option>' +
										'<option value="Esse">Esse</option>' +
										'<option value="Feroza">Feroza</option>' +
										'<option value="Sirion">Sirion</option>' +
										'<option value="Terios">Terios</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';					
			}
			
			if(mS3.value==='Dodge'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Avenger">Avenger</option>' +
										'<option value="Caliber">Caliber</option>' +
										'<option value="Caravan">Caravan</option>' +
										'<option value="Challenger">Challenger</option>' +
										'<option value="Charger">Charger</option>' +
										'<option value="Durango">Durango</option>' +
										'<option value="Grand Caravan">Grand Caravan</option>' +
										'<option value="Magnum">Magnum</option>' +
										'<option value="Nitro">Nitro</option>' +
										'<option value="Ram">Ram</option>' +
										'<option value="Stratus">Stratus</option>' +
										'<option value="Viper">Viper</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Ferrari'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="458">458</option>' +
										'<option value="488">488</option>' +
										'<option value="California">California</option>' +
										'<option value="F12">F12</option>' +
										'<option value="F40">F40</option>' +
										'<option value="F8">F8</option>' +
										'<option value="Portofino">Portofino</option>' +
										'<option value="Testarossa">Testarossa</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Fiat'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="125p">125p</option>' +
										'<option value="126p">126p</option>' +
										'<option value="500">500</option>' +
										'<option value="Albea">Albea</option>' +
										'<option value="Barchetta">Barchetta</option>' +
										'<option value="Brava">Brava</option>' +
										'<option value="Bravo">Bravo</option>' +
										'<option value="Cinquecento">Cinquecento</option>' +
										'<option value="Coupe">Coupe</option>' +
										'<option value="Doblo">Doblo</option>' +
										'<option value="Ducato">Ducato</option>' +
										'<option value="Idea">Idea</option>' +
										'<option value="Linea">Linea</option>' +
										'<option value="Marea">Marea</option>' +
										'<option value="Multipla">Multipla</option>' +
										'<option value="Palio">Palio</option>' +
										'<option value="Panda">Panda</option>' +
										'<option value="Punto">Punto</option>' +
										'<option value="Qubo">Qubo</option>' +
										'<option value="Scudo">Scudo</option>' +
										'<option value="Seicento">Seicento</option>' +
										'<option value="Siena">Siena</option>' +
										'<option value="Stilo">Stilo</option>' +
										'<option value="Tipo">Tipo</option>' +
										'<option value="Ulysse">Ulysse</option>' +
										'<option value="Uno">Uno</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Ford'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Active">Active</option>' +
										'<option value="Cougar">Cougar</option>' +
										'<option value="EcoSport">EcoSport</option>' +
										'<option value="Edge">Edge</option>' +
										'<option value="Escort">Escort</option>' +
										'<option value="Explorer">Explorer</option>' +
										'<option value="Fiesta">Fiesta</option>' +
										'<option value="Focus">Focus</option>' +
										'<option value="Fusion">Fusion</option>' +
										'<option value="GT">GT</option>' +
										'<option value="Galaxy">Galaxy</option>' +
										'<option value="Granada">Granada</option>' +
										'<option value="Ka">Ka</option>' +
										'<option value="Kuga">Kuga</option>' +
										'<option value="Maverick">Maverick</option>' +
										'<option value="Mondeo">Mondeo</option>' +
										'<option value="Mustang">Mustang</option>' +
										'<option value="Orion">Orion</option>' +
										'<option value="Puma">Puma</option>' +
										'<option value="Ranger">Ranger</option>' +
										'<option value="Raptor">Raptor</option>' +
										'<option value="S-Max">S-Max</option>' +
										'<option value="Scorpio">Scorpio</option>' +
										'<option value="Sierra">Sierra</option>' +
										'<option value="Streetka">Streetka</option>' +
										'<option value="Tourneo">Tourneo</option>' +
										'<option value="Transit">Transit</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';							
			}	
			
			if(mS3.value==='Honda'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Accord">Accord</option>' +
										'<option value="CR-V">CR-V</option>' +
										'<option value="CR-Z">CR-Z</option>' +
										'<option value="CRX">CRX</option>' +
										'<option value="CR-Z">CR-Z</option>' +
										'<option value="City">City</option>' +
										'<option value="Civic">Civic</option>' +
										'<option value="HR-V">HR-V</option>' +
										'<option value="Jazz">Jazz</option>' +
										'<option value="Legend">Legend</option>' +
										'<option value="Logo">Logo</option>' +
										'<option value="NSX">NSX</option>' +
										'<option value="S 2000">S 2000</option>' +
										'<option value="TypeR">TypeR</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}	
			
			if(mS3.value==='Hyundai'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Accent">Accent</option>' +
										'<option value="Atos">Atos</option>' +
										'<option value="Coupe">Coupe</option>' +
										'<option value="Elantra">Elantra</option>' +
										'<option value="Galloper">Galloper</option>' +
										'<option value="Getz">Getz</option>' +
										'<option value="H1">H1</option>' +
										'<option value="H200">H200</option>' +
										'<option value="Kona">Kona</option>' +
										'<option value="Lantra">Lantra</option>' +
										'<option value="Matrix">Matrix</option>' +
										'<option value="Santa Fe">Santa Fe</option>' +
										'<option value="Sonata">Sonata</option>' +
										'<option value="Terracan">Terracan</option>' +
										'<option value="Trajet">Trajet</option>' +
										'<option value="Tucson">Tucson</option>' +
										'<option value="Veloster">Veloster</option>' +
										'<option value="XG">XG</option>' +
										'<option value="i10">i10</option>' +
										'<option value="i20">i20</option>' +
										'<option value="i30">i30</option>' +
										'<option value="i40">i40</option>' +
										'<option value="ix20">ix20</option>' +
										'<option value="ix35">ix35</option>' +
										'<option value="ix55">ix55</option>' +								
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Infiniti'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="EX">EX</option>' +							
										'<option value="FX">FX</option>' +	
										'<option value="G">G</option>' +	
										'<option value="Q30">Q30</option>' +							
										'<option value="Q40">Q40</option>' +							
										'<option value="Q50">Q50</option>' +							
										'<option value="Q60">Q60</option>' +							
										'<option value="Q70">Q70</option>' +							
										'<option value="QX30">QX30</option>' +							
										'<option value="QX50">QX50</option>' +				
										'<option value="QX60">QX60</option>' +				
										'<option value="QX70">QX70</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Jaguar'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="E-Pace">E-Pace</option>' +							
										'<option value="F-Pace">F-Pace</option>' +							
										'<option value="F-Type">F-Type</option>' +							
										'<option value="I-Pace">I-Pace</option>' +							
										'<option value="S-Type">S-Type</option>' +							
										'<option value="XE">XE</option>' +							
										'<option value="XF">XF</option>' +							
										'<option value="XJ">XJ</option>' +							
										'<option value="XJR">XJR</option>' +							
										'<option value="XKR">XKR</option>' +							
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Jeep'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Commander">Commander</option>' +				
										'<option value="Compass">Compass</option>' +				
										'<option value="Grand Cherokee">Grand Cherokee</option>' +				
										'<option value="Liberty">Liberty</option>' +
										'<option value="Patriot">Patriot</option>' +
										'<option value="Renegade">Renegade</option>' +
										'<option value="Wrangler">Wrangler</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Kia'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Carens">Carens</option>' +
										'<option value="Carnival">Carnival</option>' +
										'<option value="Ceed">Ceed</option>' +
										'<option value="Ceed GT">Ceed GT</option>' +
										'<option value="Cerato">Cerato</option>' +
										'<option value="Magentis">Magentis</option>' +
										'<option value="Niro">Niro</option>' +
										'<option value="Optima">Optima</option>' +
										'<option value="Picanto">Picanto</option>' +
										'<option value="Retona">Retona</option>' +
										'<option value="Sephia">Sephia</option>' +
										'<option value="Sorento">Sorento</option>' +
										'<option value="Soul">Soul</option>' +
										'<option value="Sportage">Sportage</option>' +
										'<option value="Stinger">Stinger</option>' +
										'<option value="Stonic">Stonic</option>' +
										'<option value="Venga">Venga</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Lamborghini'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Aventador">Aventador</option>' +
										'<option value="Gallardo">Gallardo</option>' +
										'<option value="Huracan">Huracan</option>' +
										'<option value="Murcielago">Murcielago</option>' +
										'<option value="Reventon">Reventon</option>' +
										'<option value="Urus">Urus</option>' +
										'<option value="Veneno">Veneno</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}	
			
			if(mS3.value==='Lancia'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Delta">Delta</option>' +
										'<option value="Kappa">Kappa</option>' +
										'<option value="Lybra">Lybra</option>' +
										'<option value="Musa">Musa</option>' +
										'<option value="Phedra">Phedra</option>' +
										'<option value="Still">Still</option>' +
										'<option value="Thema">Thema</option>' +
										'<option value="Thesis">Thesis</option>' +
										'<option value="Voyager">Voyager</option>' +
										'<option value="Ypsilon">Ypsilon</option>' +
										'<option value="Zeta">Zeta</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}	
			
			if(mS3.value==='Land Rover'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Discovery">Discovery</option>' +
										'<option value="Discovery Sport">Discovery Sport</option>' +
										'<option value="Freelander">Freelander</option>' +
										'<option value="Range Rover">Range Rover</option>' +
										'<option value="Range Rover Evoque">Range Rover Evoque</option>' +
										'<option value="Range Rover Sport">Range Rover Sport</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';	
			}
			
			if(mS3.value==='Lexus'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="CT">CT</option>' +
										'<option value="ES300">ES300</option>' +
										'<option value="GS300">GS300</option>' +
										'<option value="GS450">GS450</option>' +
										'<option value="IS200">IS200</option>' +
										'<option value="IS220">IS220</option>' +
										'<option value="IS250">IS250</option>' +
										'<option value="LC">LC</option>' +
										'<option value="LS">LS</option>' +
										'<option value="NX">NX</option>' +
										'<option value="RC">RC</option>' +
										'<option value="RX300">RX300</option>' +
										'<option value="RX350">RX350</option>' +
										'<option value="RX400">RX400</option>' +
										'<option value="SC">SC</option>' +
										'<option value="UX">UX</option>' +							
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='Lincoln'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Aviator">Aviator</option>' +				
										'<option value="MKC">MKC</option>' +				
										'<option value="MKS">MKS</option>' +				
										'<option value="MKT">MKT</option>' +				
										'<option value="MKX">MKX</option>' +				
										'<option value="MKZ">MKZ</option>' +				
										'<option value="Nautilus">Nautilus</option>' +				
										'<option value="Navigator">Navigator</option>' +				
										'<option value="Town Car">Town Car</option>' +				
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Lotus'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Elise">Elise</option>' +	
										'<option value="Evora">Evora</option>' +	
										'<option value="Exige">Exige</option>' +	
										'<option value="Exige S">Exige S</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='Maserati'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Ghibli">Ghibli</option>' +	
										'<option value="GranCabrio">GranCabrio</option>' +	
										'<option value="GranTurismo">GranTurismo</option>' +	
										'<option value="Levante">Levante</option>' +	
										'<option value="Quattroporte">Quattroporte</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Mazda'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="2">2</option>' +	
										'<option value="3">3</option>' +	
										'<option value="323F">323F</option>' +	
										'<option value="4">4</option>' +	
										'<option value="5">5</option>' +	
										'<option value="6">6</option>' +	
										'<option value="121">121</option>' +	
										'<option value="323">323</option>' +	
										'<option value="626">626</option>' +	
										'<option value="929">929</option>' +	
										'<option value="BT-50">BT-50</option>' +	
										'<option value="CX-3">CX-3</option>' +	
										'<option value="CX-5">CX-5</option>' +	
										'<option value="CX-7">CX-7</option>' +	
										'<option value="CX-9">CX-9</option>' +	
										'<option value="Demio">Demio</option>' +	
										'<option value="MPV">MPV</option>' +	
										'<option value="MX-2">MX-2</option>' +	
										'<option value="MX-5">MX-5</option>' +	
										'<option value="MX-6">MX-6</option>' +	
										'<option value="Millenia">Millenia</option>' +	
										'<option value="Premacy">Premacy</option>' +	
										'<option value="Protege">Protege</option>' +	
										'<option value="RX-6">RX-6</option>' +	
										'<option value="RX-7">RX-7</option>' +	
										'<option value="RX-8">RX-8</option>' +	
										'<option value="Tribute">Tribute</option>' +	
										'<option value="Xedos">Xedos</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='McLaren'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="540C">540C</option>' +	
										'<option value="570GT">570GT</option>' +	
										'<option value="570S">570S</option>' +	
										'<option value="570S Spider">570S Spider</option>' +	
										'<option value="600LT">600LT</option>' +	
										'<option value="600LT Spider">600LT Spider</option>' +	
										'<option value="720S">720S</option>' +	
										'<option value="720S Spider">720S Spider</option>' +	
										'<option value="F1">F1</option>' +	
										'<option value="GT">GT</option>' +	
										'<option value="P1">P1</option>' +	
										'<option value="Senna">Senna</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Mercedes'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="AMG">AMG</option>' +	
										'<option value="CLA">CLA</option>' +	
										'<option value="Citan">Citan</option>' +	
										'<option value="EQC">EQC</option>' +	
										'<option value="GL">GL</option>' +	
										'<option value="GLA">GLA</option>' +	
										'<option value="GLB">GLB</option>' +	
										'<option value="GLC">GLC</option>' +	
										'<option value="GLE">GLE</option>' +	
										'<option value="GLS">GLS</option>' +	
										'<option value="Klasa A">Klasa A</option>' +	
										'<option value="Klasa B">Klasa B</option>' +	
										'<option value="Klasa C">Klasa C</option>' +	
										'<option value="Klasa E">Klasa E</option>' +	
										'<option value="Klasa G">Klasa G</option>' +	
										'<option value="Klasa S">Klasa S</option>' +	
										'<option value="Klasa V">Klasa V</option>' +	
										'<option value="Klasa X">Klasa X</option>' +	
										'<option value="ML">ML</option>' +	
										'<option value="SL">SL</option>' +	
										'<option value="SLC">SLC</option>' +	
										'<option value="SLK">SLK</option>' +	
										'<option value="Vaneo">Vaneo</option>' +	
										'<option value="Viano">Viano</option>' +	
										'<option value="Vito">Vito</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='MicroCar'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Aixam">Aixam</option>' +	
										'<option value="Chatenet">Chatenet</option>' +	
										'<option value="Grecav">Grecav</option>' +	
										'<option value="Ligier">Ligier</option>' +	
										'<option value="M.Go">M.Go</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Mini'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Cabrio">Cabrio</option>' +	
										'<option value="Clubman">Clubman</option>' +	
										'<option value="Cooper">Cooper</option>' +	
										'<option value="Cooper S">Cooper S</option>' +	
										'<option value="Countryman">Countryman</option>' +	
										'<option value="One">One</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Mitsubishi'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="ASX">ASX</option>' +	
										'<option value="Carisma">Carisma</option>' +	
										'<option value="Colt">Colt</option>' +	
										'<option value="Eclipse">Eclipse</option>' +	
										'<option value="Eclipse Cross">Eclipse Cross</option>' +	
										'<option value="Endeavor">Endeavor</option>' +	
										'<option value="Galant">Galant</option>' +	
										'<option value="Grandis">Grandis</option>' +	
										'<option value="L200">L200</option>' +	
										'<option value="L400">L400</option>' +	
										'<option value="Lancer Evolution VI">Lancer Evolution VI</option>' +	
										'<option value="Lancer Evolution VII">Lancer Evolution VII</option>' +	
										'<option value="Lancer Evolution VIII">Lancer Evolution VIII</option>' +	
										'<option value="Lancer Evolution IX"> Lancer Evolution IX</option>' +	
										'<option value="Lancer Evolution X"> Lancer Evolution X</option>' +	
										'<option value="Montero">Montero</option>' +	
										'<option value="Outlander">Outlander</option>' +	
										'<option value="Outlander PHEV">Outlander PHEV</option>' +	
										'<option value="Pajero">Pajero</option>' +	
										'<option value="Pajero Pinin">Pajero Pinin</option>' +	
										'<option value="Sigma">Sigma</option>' +	
										'<option value="Space Gear">Space Gear</option>' +	
										'<option value="Space Runner">Space Runner</option>' +	
										'<option value="Space Star">Space Star</option>' +	
										'<option value="Space Wagon">Space Wagon</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='Nissan'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="100 NX">100 NX</option>' +	
										'<option value="200 SX">200 SX</option>' +	
										'<option value="300 ZX">300 ZX</option>' +	
										'<option value="350Z">350Z</option>' +	
										'<option value="370Z">370Z</option>' +	
										'<option value="370Z Nismo">370Z Nismo</option>' +	
										'<option value="370Z Roadster">370Z Roadster</option>' +	
										'<option value="Almera">Almera</option>' +	
										'<option value="Almera Tino">Almera Tino</option>' +	
										'<option value="Altima">Altima</option>' +	
										'<option value="E-NV200">E-NV200</option>' +	
										'<option value="E-NV200 Evalia">E-NV200 Evalia</option>' +	
										'<option value="Frontier">Frontier</option>' +	
										'<option value="GT-R">GT-R</option>' +	
										'<option value="GT-R Nismo">GT-R Nismo</option>' +	
										'<option value="Juke">Juke</option>' +	
										'<option value="King Cab">King Cab</option>' +	
										'<option value="Leaf">Leaf</option>' +	
										'<option value="Maxima">Maxima</option>' +	
										'<option value="Micra">Micra</option>' +	
										'<option value="Murano">Murano</option>' +	
										'<option value="NV200">NV200</option>' +	
										'<option value="Navara">Navara</option>' +	
										'<option value="Note">Note</option>' +	
										'<option value="Patrol">Patrol</option>' +	
										'<option value="Pickup">Pickup</option>' +	
										'<option value="Primera">Primera</option>' +	
										'<option value="Pulsar">Pulsar</option>' +	
										'<option value="Qashqai">Qashqai</option>' +	
										'<option value="Quest">Quest</option>' +	
										'<option value="Rogue">Rogue</option>' +	
										'<option value="Serena">Serena</option>' +	
										'<option value="Skyline">Skyline</option>' +	
										'<option value="Titan">Titan</option>' +	
										'<option value="X-Trail">X-Trail</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Opel'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Adam">Adam</option>' +
										'<option value="Agila">Agila</option>' +
										'<option value="Antara">Antara</option>' +
										'<option value="Astra">Astra</option>' +
										'<option value="Calibra">Calibra</option>' +
										'<option value="Campo">Campo</option>' +
										'<option value="Cascada">Cascada</option>' +
										'<option value="Combo">Combo</option>' +
										'<option value="Corsa">Corsa</option>' +
										'<option value="Frontera">Frontera</option>' +
										'<option value="GT">GT</option>' +
										'<option value="Insignia">Insignia</option>' +
										'<option value="Kadett">Kadett</option>' +
										'<option value="Meriva">Meriva</option>' +
										'<option value="Mokka">Mokka</option>' +
										'<option value="Monterey">Monterey</option>' +
										'<option value="Movano">Movano</option>' +
										'<option value="Omega">Omega</option>' +
										'<option value="Signum">Signum</option>' +
										'<option value="Sintra">Sintra</option>' +
										'<option value="Tigra">Tigra</option>' +
										'<option value="Vectra">Vectra</option>' +
										'<option value="Vivaro">Vivaro</option>' +
										'<option value="Zafira">Zafira</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='Peugeot'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="108">108</option>' +
										'<option value="205">205</option>' +
										'<option value="206">206</option>' +
										'<option value="207">207</option>' +
										'<option value="208">208</option>' +
										'<option value="301">301</option>' +
										'<option value="308">308</option>' +
										'<option value="405">405</option>' +
										'<option value="406">406</option>' +
										'<option value="407">407</option>' +
										'<option value="508">508</option>' +
										'<option value="607">607</option>' +
										'<option value="806">806</option>' +
										'<option value="807">807</option>' +
										'<option value="1007">1007</option>' +
										'<option value="2008">2008</option>' +
										'<option value="3008">3008</option>' +
										'<option value="4007">4007</option>' +
										'<option value="4008">4008</option>' +
										'<option value="5008">5008</option>' +
										'<option value="Bipper">Bipper</option>' +
										'<option value="Boxer">Boxer</option>' +
										'<option value="E-208">E-208</option>' +
										'<option value="Expert">Expert</option>' +
										'<option value="Partner">Partner</option>' +
										'<option value="RCZ">RCZ</option>' +
										'<option value="Rifter">Rifter</option>' +
										'<option value="Traveller">Traveller</option>'  +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='Polonez'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Atu">Atu</option>' +
										'<option value="Atu Plus">Atu Plus</option>' +
										'<option value="Caro">Caro</option>' +
										'<option value="Caro Plus">Caro Plus</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Porsche'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="718">718</option>' +
										'<option value="911">911</option>' +
										'<option value="944">944</option>' +
										'<option value="Cayenne">Cayenne</option>' +
										'<option value="Cayman">Cayman</option>' +
										'<option value="E-Performance">E-Performance</option>' +
										'<option value="Macan">Macan</option>' +
										'<option value="Panamera">Panamera</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Renault'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Avantime">Avantime</option>' +
										'<option value="Captur">Captur</option>' +
										'<option value="Clio">Clio</option>' +
										'<option value="Escape">Escape</option>' +
										'<option value="Fluence">Fluence</option>' +
										'<option value="Grand Escape">Grand Escape</option>' +
										'<option value="Grand Scenic">Grand Scenic</option>' +
										'<option value="Scenic">Scenic</option>' +
										'<option value="Scenic Conquest">Scenic Conquest</option>' +
										'<option value="Scenic RX4">Scenic RX4</option>' +
										'<option value="Kadjar">Kadjar</option>' +
										'<option value="Kangoo">Kangoo</option>' +
										'<option value="Koleos">Koleos</option>' +
										'<option value="Laguna">Laguna</option>' +
										'<option value="Latitude">Latitude</option>' +
										'<option value="Master">Master</option>' +
										'<option value="Megane">Megane</option>' +
										'<option value="Megane RS">Megane RS</option>' +
										'<option value="Modus">Modus</option>' +
										'<option value="Talisman">Talisman</option>' +
										'<option value="Thalia">Thalia</option>' +
										'<option value="Trafic">Trafic</option>' +
										'<option value="Twingo">Twingo</option>' +
										'<option value="Twizy">Twizy</option>' +
										'<option value="Vel Satis">Vel Satis</option>' +
										'<option value="Wind">Wind</option>' +
										'<option value="ZOE">ZOE</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='Rolls Royce'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Ghost">Ghost</option>' +
										'<option value="Phantom">Phantom</option>' +
										'<option value="Wraith">Wraith</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Rover'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="25">25</option>' +
										'<option value="45">45</option>' +
										'<option value="75">75</option>' +
										'<option value="200">200</option>' +
										'<option value="214">214</option>' +
										'<option value="400">400</option>' +
										'<option value="414">414</option>' +
										'<option value="416">416</option>' +
										'<option value="420">420</option>' +
										'<option value="600">600</option>' +
										'<option value="620">620</option>' +
										'<option value="MG">MG</option>' +
										'<option value="Streetwise">Streetwise</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Saab'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="9-5">9-5</option>' +
										'<option value="900">900</option>' +
										'<option value="9000">9000</option>' +
										'<option value="9-3">9-3</option>' +
										'<option value="9-7X">9-7X</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Seat'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Alhambra">Alhambra</option>' +
										'<option value="Altea">Altea</option>' +
										'<option value="Altea XL">Altea XL</option>' +
										'<option value="Arona">Arona</option>' +
										'<option value="Arosa">Arosa</option>' +
										'<option value="Ateca">Ateca</option>' +
										'<option value="Cordoba">Cordoba</option>' +
										'<option value="Exeo">Exeo</option>' +
										'<option value="Ibiza">Ibiza</option>' +
										'<option value="Inca">Inca</option>' +
										'<option value="Leon">Leon</option>' +
										'<option value="Leon Cupra">Leon Cupra</option>' +
										'<option value="Leon Sportourer ST">Leon Sportourer ST</option>' +
										'<option value="Mii">Mii</option>' +
										'<option value="Tarraco">Tarraco</option>' +
										'<option value="Toledo">Toledo</option>' +					
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Skoda'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="105">105</option>' +
										'<option value="120">120</option>' +
										'<option value="Citigo">Citigo</option>' +
										'<option value="Fabia">Fabia</option>' +
										'<option value="Favorit">Favorit</option>' +
										'<option value="Felicia">Felicia</option>' +
										'<option value="Kamiq">Kamiq</option>' +
										'<option value="Karoq">Karoq</option>' +
										'<option value="Kodiaq">Kodiaq</option>' +
										'<option value="Octavia">Octavia</option>' +
										'<option value="Rapid">Rapid</option>' +
										'<option value="Roomster">Roomster</option>' +
										'<option value="Scala">Scala</option>' +
										'<option value="Superb">Superb</option>' +
										'<option value="Yeti">Yeti</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Smart'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Fortwo">Fortwo</option>' +									
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='SsangYong'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Actyon">Actyon</option>' +						
										'<option value="Korando">Korando</option>' +						
										'<option value="Kyron">Kyron</option>' +						
										'<option value="Musso">Musso</option>' +						
										'<option value="Rexton">Rexton</option>' +						
										'<option value="Rodius">Rodius</option>' +						
										'<option value="Tivoli">Tivoli</option>' +						
										'<option value="XLV">XLV</option>' +						
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}	
			
			if(mS3.value==='Subaru'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="B9 Tribeca">B9 Tribeca</option>' +			
										'<option value="BRZ">BRZ</option>' +			
										'<option value="Forester">Forester</option>' +			
										'<option value="Impreza">Impreza</option>' +			
										'<option value="Justy">Justy</option>' +			
										'<option value="Legacy">Legacy</option>' +			
										'<option value="Levorg">Levorg</option>' +			
										'<option value="Outback">Outback</option>' +			
										'<option value="Tribeca">Tribeca</option>' +			
										'<option value="WRX">WRX</option>' +			
										'<option value="XV">XV</option>' +			
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Suzuki'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Alto">Alto</option>' +			
										'<option value="Baleno">Baleno</option>' +			
										'<option value="Celerio">Celerio</option>' +			
										'<option value="Grand Vitara">Grand Vitara</option>' +			
										'<option value="Ignis">Ignis</option>' +			
										'<option value="Jimny">Jimny</option>' +			
										'<option value="Liana">Liana</option>' +			
										'<option value="SJ">SJ</option>' +			
										'<option value="SX4">SX4</option>' +			
										'<option value="SX4 S-Cross">SX4 S-Cross</option>' +			
										'<option value="Samurai">Samurai</option>' +			
										'<option value="Splash">Splash</option>' +			
										'<option value="Swift">Swift</option>' +			
										'<option value="Swift Sport">Swift Sport</option>' +			
										'<option value="Vitara">Vitara</option>' +			
										'<option value="Wagon">Wagon</option>' +			
										'<option value="X-90">X-90</option>' +			
										'<option value="XL7">XL7</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Tesla'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value=" 3"> 3</option>' +			
										'<option value=" S"> S</option>' +			
										'<option value=" X"> X</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Toyota'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="4-Runner">4-Runner</option>' +	
										'<option value="Auris">Auris</option>' +	
										'<option value="Avalon">Avalon</option>' +	
										'<option value="Avensis">Avensis</option>' +	
										'<option value="Avensis Verso">Avensis Verso</option>' +	
										'<option value="Aygo">Aygo</option>' +	
										'<option value="C-HR">C-HR</option>' +	
										'<option value="Camry">Camry</option>' +	
										'<option value="Camry Solara">Camry Solara</option>' +	
										'<option value="Carina">Carina</option>' +	
										'<option value="Celica">Celica</option>' +	
										'<option value="Corolla">Corolla</option>' +	
										'<option value="FJ">FJ</option>' +	
										'<option value="GR Supra">GR Supra</option>' +	
										'<option value="GT86">GT86</option>' +	
										'<option value="Highlander">Highlander</option>' +	
										'<option value="Hilux">Hilux</option>' +	
										'<option value="Land Cruiser">Land Cruiser</option>' +	
										'<option value="Highlander">Highlander</option>' +	
										'<option value="MR2">MR2</option>' +	
										'<option value="Matrix">Matrix</option>' +	
										'<option value="Mirai">Mirai</option>' +	
										'<option value="Paseo">Paseo</option>' +	
										'<option value="Picnic">Picnic</option>' +	
										'<option value="Previa">Previa</option>' +	
										'<option value="Prius">Prius</option>' +	
										'<option value="Proace">Proace</option>' +	
										'<option value="RAV4">RAV4</option>' +	
										'<option value="Sienna">Sienna</option>' +	
										'<option value="Supra">Supra</option>' +	
										'<option value="Verso">Verso</option>' +	
										'<option value="Yaris Verso">Yaris Verso</option>' +	
										'<option value="Yaris">Yaris</option>' +	
										'<option value="iQ">iQ</option>' +
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Volkswagen'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="Arteon">Arteon</option>' +	
										'<option value="Beetle">Beetle</option>' +	
										'<option value="Bora">Bora</option>' +	
										'<option value="Caddy">Caddy</option>' +	
										'<option value="California">California</option>' +	
										'<option value="Caravelle">Caravelle</option>' +	
										'<option value="Corrado">Corrado</option>' +	
										'<option value="Crafter">Crafter</option>' +	
										'<option value="E-Golf">E-Golf</option>' +	
										'<option value="Eos">Eos</option>' +	
										'<option value="Fox">Fox</option>' +	
										'<option value="Garbus">Garbus</option>' +	
										'<option value="Golf">Golf</option>' +	
										'<option value="Golf GTI">Golf GTI</option>' +	
										'<option value="Golf Plus">Golf Plus</option>' +	
										'<option value="Golf Sportsvan">Golf Sportsvan</option>' +	
										'<option value="Jetta">Jetta</option>' +	
										'<option value="Lupo">Lupo</option>' +	
										'<option value="Multivan">Multivan</option>' +	
										'<option value="New Beetle">New Beetle</option>' +	
										'<option value="Passat">Passat</option>' +	
										'<option value="Passat CC">Passat CC</option>' +	
										'<option value="Passat W8">Passat W8</option>' +	
										'<option value="Phaeton">Phaeton</option>' +	
										'<option value="Polo">Polo</option>' +	
										'<option value="Polo GTI">Polo GTI</option>' +	
										'<option value="Routan">Routan</option>' +	
										'<option value="Scirocco">Scirocco</option>' +	
										'<option value="Sharan">Sharan</option>' +	
										'<option value="T-Cross">T-Cross</option>' +	
										'<option value="T-Roc">T-Roc</option>' +	
										'<option value="Tiguan">Tiguan</option>' +	
										'<option value="Tiguan Allspace">Tiguan Allspace</option>' +	
										'<option value="Touareg">Touareg</option>' +	
										'<option value="Touran">Touran</option>' +	
										'<option value="Transporter">Transporter</option>' +	
										'<option value="Up!">Up!</option>' +	
										'<option value="Vento">Vento</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
			
			if(mS3.value==='Volvo'){
				mS4.innerHTML='<option value="0"></option>' +
										'<option value="C30">C30</option>' +	
										'<option value="C70">C70</option>' +	
										'<option value="S40">S40</option>' +	
										'<option value="S60">S60</option>' +	
										'<option value="S70">S70</option>' +	
										'<option value="S80">S80</option>' +	
										'<option value="S90">S90</option>' +	
										'<option value="Seria 200">Seria 200</option>' +	
										'<option value="Seria 400">Seria 400</option>' +	
										'<option value="Seria 700">Seria 700</option>' +	
										'<option value="Seria 800">Seria 800</option>' +	
										'<option value="Seria 900">Seria 900</option>' +	
										'<option value="V40">V40</option>' +	
										'<option value="V50">V50</option>' +	
										'<option value="V60">V60</option>' +	
										'<option value="V70">V70</option>' +	
										'<option value="V90">V90</option>' +	
										'<option value="XC40">XC40</option>' +	
										'<option value="XC50">XC50</option>' +	
										'<option value="XC60">XC60</option>' +	
										'<option value="XC70">XC70</option>' +	
										'<option value="XC80">XC80</option>' +	
										'<option value="XC90">XC90</option>' +	
										'<option value="Inne">Inne</option>';
										mS4.style='display: block; display: inline-block;';
			}
		}
	}

	mS.onchange=function() {	
		document.getElementById('Cena').disabled = false;
		document.getElementById('Cena').value='';
		if(mS.value==='0') {
			mS2.style='display: none;';
			mS3.style='display: none;';
			mS4.style='display: none;';
			mS5.style='display: none;';
			mS6.style='display: none;';
			mS7.style='display: none;';
			mS8.style='display: none;';
			mS11.innerHTML='';
			mS12.innerHTML='';
			mS10.innerHTML='';
			
		}
		else{
			if(mS.value==='Oddam za darmo'){
				mS2.style='display: none;';
				mS3.style='display: none;';
				mS4.style='display: none;';
				mS5.style='display: none;';
				mS6.style='display: none;';
				mS7.style='display: none;';
				mS11.innerHTML='';
				mS12.innerHTML='';
				mS10.innerHTML='';
				mS8.style='display: block; margin-top: 25px;';
				document.getElementById('Cena').value='Oddam';
				document.getElementById('Cena').disabled = true;
			}else{
				if(mS.value==='Pozostale'){
					mS2.style='display: none;';
					mS3.style='display: none;';
					mS4.style='display: none;';
					mS5.style='display: none;';
					mS6.style='display: none;';
					mS7.style='display: block; margin-top: 25px;';
					mS8.style='display: none;';
					mS11.innerHTML='';
					mS12.innerHTML='';
					mS10.innerHTML='';
				}else{
					mS2.style='display: block; display: inline-block;';
					mS3.style='display: none;';
					mS4.style='display: none;';
					mS5.style='display: none;';
					mS6.style='display: none;';
					mS7.style='display: none;';
					mS8.style='display: none;';
					mS11.innerHTML='<b>Wybierz podkategorię</b> <span style="color: red;">*</span>';
					mS12.innerHTML='';
					mS10.innerHTML='';
				}
			}
		}
		if(mS.value==='Motoryzacja') {
			mS2.innerHTML='<option value="0"></option> ' + 
									'<option value="Samochody osobowe">Samochody osobowe</option> '+
									'<option value="Samochody ciezarowe">Samochody ciężarowe</option> '+
									'<option value="Samochody dostawcze">Samochody dostawcze</option> '+
									'<option value="Motocykle i skutery">Motocykle i skutery</option> '+
									'<option value="Pojazdy rolnicze">Pojazdy rolnicze</option> '+
									'<option value="Felgi i opony">Felgi i opony</option> '+
									'<option value="Sprzet audio">Sprzęt audio</option> '+
									'<option value="Pozostale">Pozostałe</option> '+
									'</select>';
		}
		if(mS.value==='Elektronika') {
			mS2.innerHTML='<option value="0"></option> ' + 
									'<option value="Komputery">Komputery</option> '+
									'<option value="Telewizory">Telewizory</option> '+
									'<option value="Telefony">Telefony</option> '+
									'<option value="Tablety">Tablety</option> '+
									'<option value="Konsole">Konsole</option> '+
									'<option value="Akcesoria">Akcesoria</option> '+
									'<option value="Pozostale">Pozostałe</option> '+
									'</select>';
		}
		if(mS.value==='Nieruchomosci') {
			mS2.innerHTML='<option value="0"></option> ' + 
									'<option value="Mieszkania">Mieszkania</option> '+
									'<option value="Garaze">Garaże</option> '+
									'<option value="Dzialki">Działki</option> '+
									'<option value="Domy">Domy</option> '+
									'<option value="Pozostale">Pozostałe</option> '+
									'</select>';
		}
		if(mS.value==='Dom i ogrod') {
			mS2.innerHTML='<option value="0"></option> ' + 
									'<option value="Sprzet RTV/AGD">Sprzęt RTV/AGD</option> '+
									'<option value="Oswietlenie">Oświetlenie</option> '+
									'<option value="Ogrod">Ogród</option> '+
									'<option value="Meble">Meble</option> '+
									'<option value="Pozostale">Pozostałe</option> '+
									'</select>';
		}
		if(mS.value==='Praca') {
			mS2.innerHTML='<option value="0"></option> ' + 
									'<option value="Dorywcza">Dorywcza</option> '+
									'<option value="Za granica">Za granicą</option> '+
									'<option value="W kraju">W kraju</option> '+
									'<option value="Uslugi">Usługi</option> '+
									'<option value="Pozostale">Pozostałe</option> '+
									'</select>';
		}
		if(mS.value==='Odziez') {
			mS2.innerHTML='<option value="0"></option> ' + 
									'<option value="Ubrania">Ubrania</option> '+
									'<option value="Dodatki">Dodatki</option> '+
									'<option value="Zegarki">Zegarki</option> '+
									'<option value="Buty">Buty</option> '+
									'<option value="Pozostale">Pozostałe</option> '+
									'</select>';
		}
		if(mS.value==='Zwierzeta') {
			mS2.innerHTML='<option value="0"></option> ' + 
									'<option value="Schroniska">Schroniska</option> '+
									'<option value="Koty">Koty</option> '+
									'<option value="Psy">Psy</option> '+
									'<option value="Pozostale zwierzeta">Pozostałe zwierzeta</option> '+
									'<option value="Dla zwierzat">Dla zwierząt</option> '+
									'</select>';
		}
	}
	</script>
	<script>
		function licz(o,n){
		   document.getElementById('ile').innerHTML='Pozostalo '+(60-o.value.length)+' znaków.';
		}
	</script>
	<script>
		function liczo(o,n){
		   document.getElementById('ileo').innerHTML='Pozostalo '+(1000-o.value.length)+' znaków.';
		}
	</script>
	
  </body>
</html>