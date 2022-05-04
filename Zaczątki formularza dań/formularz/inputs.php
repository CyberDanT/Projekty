<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dania";


try {
	$conn = new PDO(
        "mysql:host=$servername;dbname=$dbname", $username, $password,
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        ]
    );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully";
	
	// ------------- Cennik posiłków ------------------
	$count = $conn->query("SELECT COUNT(*) FROM cennikposilkow");
	$count = $count->fetch();
	$count = $count[0];
	for($i = 1; $i<=$count; $i++){
		$q = 'SELECT * FROM cennikposilkow WHERE id='.$i.'';
		$stmt = $conn->query($q);
		
		unset($_SESSION['Cennik'.$i]);
		
		while ($w = $stmt->fetch()) {
			$Cennik = array(
				'id'=>''.$w['id'].'',
				'kalorycznosc'=>''.$w['Kalorycznosc'].'',
				'sniadanie'=>''.$w['Sniadanie'].'',
				'2sniadanie'=>''.$w['2Sniadanie'].'',
				'obiad'=>''.$w['Obiad'].'',
				'podwieczorek'=>''.$w['Podwieczorek'].'',
				'kolacja'=>''.$w['Kolacja']);
			$_SESSION['Cennik'.$i][] = $Cennik;
		}
	}
	
	// ----------------  Śniadania  --------------------
	for($i=0; $i<= 10; $i++){
		$NewDay=Date('d', strtotime('+'.$i.' days'));
		$NewDate=Date('yy-m-d', strtotime('+'.$i.' days'));
		
		$q = 'SELECT * FROM sniadanie WHERE dzien ='.$NewDay;
		
		$stmt = $conn->query($q);
		
		unset($_SESSION['Sniadanie'.$NewDate]);
		while ($w = $stmt->fetch()) {
			$Sniadanie = array(
				'dzien'=>''.$w['dzien'].'',
				'wybor-1'=>''.$w['wybor-1'].'',
				'sklad-1'=>''.$w['sklad-1'].'',
				'wybor-2'=>''.$w['wybor-2'].'',
				'sklad-2'=>''.$w['sklad-2'].'',
				'wybor-3'=>''.$w['wybor-3'].'',
				'sklad-3'=>''.$w['sklad-3'].'',
				'wybor-4'=>''.$w['wybor-4'].'',
				'sklad-4'=>''.$w['sklad-4']);
			$_SESSION['Sniadanie'.$NewDate][] = $Sniadanie;
		}
	}
	
	// ---------------- 2 Śniadania  --------------------
	for($i=0; $i<= 10; $i++){
		$NewDay=Date('d', strtotime('+'.$i.' days'));
		$NewDate=Date('yy-m-d', strtotime('+'.$i.' days'));
		
		$q = 'SELECT * FROM sniadanie2 WHERE dzien ='.$NewDay;
		
		$stmt = $conn->query($q);
		
		unset($_SESSION['Sniadanie2'.$NewDate]);
		while ($w = $stmt->fetch()) {
			$Sniadanie2 = array(
				'dzien'=>''.$w['dzien'].'',
				'wybor-1'=>''.$w['wybor-1'].'',
				'sklad-1'=>''.$w['sklad-1'].'',
				'wybor-2'=>''.$w['wybor-2'].'',
				'sklad-2'=>''.$w['sklad-2'].'',
				'wybor-3'=>''.$w['wybor-3'].'',
				'sklad-3'=>''.$w['sklad-3'].'',
				'wybor-4'=>''.$w['wybor-4'].'',
				'sklad-4'=>''.$w['sklad-4']);
			$_SESSION['Sniadanie2'.$NewDate][] = $Sniadanie2;
		}
	}
	
	// ---------------- Obiad  --------------------
	for($i=0; $i<= 10; $i++){
		$NewDay=Date('d', strtotime('+'.$i.' days'));
		$NewDate=Date('yy-m-d', strtotime('+'.$i.' days'));
		
		$q = 'SELECT * FROM obiad WHERE dzien ='.$NewDay;
		
		$stmt = $conn->query($q);
		
		unset($_SESSION['Obiad'.$NewDate]);
		while ($w = $stmt->fetch()) {
			$Obiad = array(
				'dzien'=>''.$w['dzien'].'',
				'wybor-1'=>''.$w['wybor-1'].'',
				'sklad-1'=>''.$w['sklad-1'].'',
				'wybor-2'=>''.$w['wybor-2'].'',
				'sklad-2'=>''.$w['sklad-2'].'',
				'wybor-3'=>''.$w['wybor-3'].'',
				'sklad-3'=>''.$w['sklad-3'].'',
				'wybor-4'=>''.$w['wybor-4'].'',
				'sklad-4'=>''.$w['sklad-4']);
			$_SESSION['Obiad'.$NewDate][] = $Obiad;
		}
	}
	
	// ---------------- Podwieczorek  --------------------
	for($i=0; $i<= 10; $i++){
		$NewDay=Date('d', strtotime('+'.$i.' days'));
		$NewDate=Date('yy-m-d', strtotime('+'.$i.' days'));
		
		$q = 'SELECT * FROM podwieczorek WHERE dzien ='.$NewDay;
		
		$stmt = $conn->query($q);
		
		unset($_SESSION['Podwieczorek'.$NewDate]);
		while ($w = $stmt->fetch()) {
			$Podwieczorek = array(
				'dzien'=>''.$w['dzien'].'',
				'wybor-1'=>''.$w['wybor-1'].'',
				'sklad-1'=>''.$w['sklad-1'].'',
				'wybor-2'=>''.$w['wybor-2'].'',
				'sklad-2'=>''.$w['sklad-2'].'',
				'wybor-3'=>''.$w['wybor-3'].'',
				'sklad-3'=>''.$w['sklad-3'].'',
				'wybor-4'=>''.$w['wybor-4'].'',
				'sklad-4'=>''.$w['sklad-4']);
			$_SESSION['Podwieczorek'.$NewDate][] = $Podwieczorek;
		}
	}
	
	// ---------------- Kolacja  --------------------
	for($i=0; $i<= 10; $i++){
		$NewDay=Date('d', strtotime('+'.$i.' days'));
		$NewDate=Date('yy-m-d', strtotime('+'.$i.' days'));
		
		$q = 'SELECT * FROM kolacja WHERE dzien ='.$NewDay;
		
		$stmt = $conn->query($q);
		
		unset($_SESSION['Kolacja'.$NewDate]);
		while ($w = $stmt->fetch()) {
			$Kolacja = array(
				'dzien'=>''.$w['dzien'].'',
				'wybor-1'=>''.$w['wybor-1'].'',
				'sklad-1'=>''.$w['sklad-1'].'',
				'wybor-2'=>''.$w['wybor-2'].'',
				'sklad-2'=>''.$w['sklad-2'].'',
				'wybor-3'=>''.$w['wybor-3'].'',
				'sklad-3'=>''.$w['sklad-3'].'',
				'wybor-4'=>''.$w['wybor-4'].'',
				'sklad-4'=>''.$w['sklad-4']);
			$_SESSION['Kolacja'.$NewDate][] = $Kolacja;
		}
	}	
	$conn = null;	
}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>