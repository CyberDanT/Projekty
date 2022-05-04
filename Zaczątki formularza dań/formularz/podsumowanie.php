<?php
session_unset();
session_start();
require_once('inputs.php');

if(isset($_POST['submit'])){
	echo '<h1>Podsumowanie</h1><br><br>';
	if(empty($_POST["Calories"])){
		$caloriessErr = "Nie zaznaczono dla jakich kalorii";
	}else{
		$calories = test($_POST["Calories"]);
		echo 'Wybrana ilość kalorii: '.$calories.'<br>';
	}
	
	if(empty($_POST["Dates"])){
		$datesErr = "Nie wybrano żadnej daty!";
	}else{
		$dates = test($_POST['Dates']);
		//echo 'Wybrane (wszystkie) daty '.$dates;
		
		$ToDate=Date('yy-m-d', strtotime('+ 10 days'));
		$x = date_parse($ToDate);
		
		$arraydates = explode(",", $dates);
		
		
		for($i = 1; $i<=$count; $i++){
			foreach($_SESSION['Cennik'.$i] as $key=>$val) {
				$Csniadanie[$val['kalorycznosc']] = (int)$val['sniadanie'];
				$C2sniadanie[$val['kalorycznosc']] = (int)$val['2sniadanie'];
				$Cobiad[$val['kalorycznosc']] = (int)$val['obiad'];
				$Cpodwieczorek[$val['kalorycznosc']] = (int)$val['podwieczorek'];
				$Ckolacja[$val['kalorycznosc']] = (int)$val['kolacja'];
				$SumaCennika = $Csniadanie[$val['kalorycznosc']] + $C2sniadanie[$val['kalorycznosc']] + $Cobiad[$val['kalorycznosc']] + $Cpodwieczorek[$val['kalorycznosc']] + $Ckolacja[$val['kalorycznosc']];			
			}
		}
		$Platnosc = 0;
		
		foreach($arraydates as $i =>$key) {
			$y = date_parse($key);
			if($y <= $x){
				echo '<br><br><h4>---------- Posiłki dla dnia '.$key.' ----------</h4>';
				// Daty poprawne
				
				if(isset($_POST['Sniadanie'])){
					echo '<br>ŚNIADANIE | Dzień '.$key.'<br>';
					for($il = 1; $il<=4; $il++){
						if(isset($_POST['sniadanie'.$il.$key])){
							echo 'Ilość (x'.test($_POST['ilsniadanie'.$il.$key]).')<br>';
							echo $_POST['sniadanie'.$il.$key].'<br><br>';
							$ilosc = $_POST['ilsniadanie'.$il.$key];
							$Platnosc = (int)$Csniadanie[$calories]*(int)$ilosc + (int)$Platnosc;
						}
					}
				}
				if(isset($_POST['2Sniadanie'])){
					echo '<br>2 ŚNIADANIE | Dzień '.$key.'<br>';
					for($il = 1; $il<=4; $il++){
						if(isset($_POST['2sniadanie'.$il.$key])){
							echo 'Ilość (x'.test($_POST['il2sniadanie'.$il.$key]).')<br>';
							echo $_POST['2sniadanie'.$il.$key].'<br><br>';
							$ilosc = $_POST['il2sniadanie'.$il.$key];
							$Platnosc = (int)$C2sniadanie[$calories]*(int)$ilosc + (int)$Platnosc;
						}
					}
				}
				if(isset($_POST['Obiad'])){
					echo '<br>OBIAD | Dzień '.$key.'<br>';
					for($il = 1; $il<=4; $il++){
						if(isset($_POST['obiad'.$il.$key])){
							echo 'Ilość (x'.test($_POST['ilobiad'.$il.$key]).')<br>';
							echo $_POST['obiad'.$il.$key].'<br><br>';
							$ilosc = $_POST['ilobiad'.$il.$key];
							$Platnosc = (int)$Cobiad[$calories]*(int)$ilosc + (int)$Platnosc;
						}
					}
				}
				if(isset($_POST['Podwieczorek'])){
					echo '<br>PODWIECZOREK | Dzień '.$key.'<br>';
					for($il = 1; $il<=4; $il++){
						if(isset($_POST['podwieczorek'.$il.$key])){
							echo 'Ilość (x'.test($_POST['ilpodwieczorek'.$il.$key]).')<br>';
							echo $_POST['podwieczorek'.$il.$key].'<br><br>';
							$ilosc = $_POST['ilpodwieczorek'.$il.$key];
							$Platnosc = (int)$Cpodwieczorek[$calories]*(int)$ilosc + (int)$Platnosc;
						}
					}
				}
				if(isset($_POST['Kolacja'])){
					echo '<br>KOLACJA | Dzień '.$key.'<br>';
					for($il = 1; $il<=4; $il++){
						if(isset($_POST['kolacja'.$il.$key])){
							echo 'Ilość (x'.test($_POST['ilkolacja'.$il.$key]).')<br>';
							echo $_POST['kolacja'.$il.$key].'<br><br>';
							$ilosc = $_POST['ilkolacja'.$il.$key];
							$Platnosc = (int)$Ckolacja[$calories]*(int)$ilosc + (int)$Platnosc;
						}
					}
				}
				
			}else{
				// Błędne daty (większe niż dzisiaj +10)
				//echo '<br>Data odrzucona '.$y;
				// Tutaj można wysłać np wiadomość na pocztę
			}
		}	
	}
	echo '<br><br><h5>Wartość zamówienia '.$Platnosc.' PLN</h5>';
}
	
function test($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz - podsumowanie</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
</head>

	<body class="text-center">
		
	</body>
</html>