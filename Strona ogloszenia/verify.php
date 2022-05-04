<?php
require_once("php/connect.php");
if(isset($_GET['key'])){
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
			if($result = $connect->query('SELECT v,vkey FROM accounts WHERE v=0 AND vkey="'.$_GET['key'].'"')){
				$wyniki = $result->num_rows;
				if($wyniki>0){
					for($r = 1; $r <= $wyniki; $r++){
						$w = $result->fetch_assoc();
						if($result = $connect->query('UPDATE accounts SET v=1 WHERE vkey="'.$_GET['key'].'"')){
							sleep(1);
							header("Location: login.php");
						}else{
							throw new Exception($connect->error);
						}
					}
				}else{
					header("Location: login.php");
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
		$_SESSION['globalerrorfrom'] = 'Przepraszamy wystąpił błąd</br>Prosimy spróbować później.';
		//echo '<div style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</div>';
		//echo '</br>Informacja developerska:</br>'.$error;
		sleep(1);
		header("Location: index.php");
	}
}else{
	header("Location: index.php");
}
?>