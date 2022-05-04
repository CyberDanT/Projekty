<?php
unset($signature);
$signature = '';
$PIN = ".........................";

$sign =
	$PIN.
	$_POST['id'].
	$_POST['operation_number'].
	$_POST['operation_type'].
	$_POST['operation_status'].
	$_POST['operation_amount'].
	$_POST['operation_currency'].
	$_POST['operation_original_amount'].
	$_POST['operation_original_currency'].
	$_POST['operation_datetime'].
	$_POST['control'].
	$_POST['description'].
	$_POST['email'].
	$_POST['p_info'].
	$_POST['p_email'].
	$_POST['channel'];
	
$signature=hash('sha256', $sign);

//echo '<br>Sygnatura 1'.$signature.'<br>';
//echo 'Sygnatura 2'.$_POST['signature'].'<br>';

@require_once('../config/config.php');

$allow_server = array('217.17.41.5', '195.150.9.37');

if (!in_array($_SERVER['REMOTE_ADDR'], $allow_server)) {
    exit('You are not authorized to do this operation!'); 
}

if(isset($_POST['signature'])){
	if($_POST['signature'] != ''){
		if($_POST['signature'] == $signature){
			if($_POST['operation_amount'] != '' && $_POST['control'] != '') {
				$control = $_POST['control'];
				$amount = $_POST['operation_amount'];
				if (is_numeric($control) && is_numeric($amount)) {
					if($_POST['operation_amount'] == $_POST['operation_original_amount']){
						if($_POST['operation_currency'] == $_POST['operation_original_currency']){
							
							require_once('php/connect.php');
							try{
								$db_name = $administratorbazy.$db_name;
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
								
									// "description" => "Zaplata za kursy dla - ".$_POST['name']." ".$_POST['lastname']." ",
									$user = $_POST['description'];
									$dane_osobowe = explode(" - ", $user);
									
									
									$user = $dane_osobowe[1];
									$email = $_POST['email'];
									$kursy = $_POST['control'];
									$kursyzdane = " ";
									$platnosc = $_POST['operation_amount'];
									$login =  time();
									$login = $login.rand(0, 999);
									$haslo = uniqid(); 
									$hashpassword = password_hash($haslo, PASSWORD_DEFAULT);
																	
									if($connect->query("INSERT INTO konta VALUES (NULL, '$user', '$email', '$login', '$hashpassword', '$kursy','$kursyzdane','$platnosc',NOW())")){
									
										$full_name='Pakif.pl';
										$from = $full_name.'<kontakt@pakif.pl>';
										$subject = 'Potwierdzenie zakupu kursów';
										$message = '
											<span style="font-size: 18px;">
												<b>Pakif.pl</b><br>
												<br><br>
												<p>Dziękujemy za zakup kursów.</p><br>
												<p>Zakupiłeś/aś u nas kursy za łączną kwotę '.$_POST['operation_amount'].' PLN</p><br>
												<br><br>
												 <p><b>Twoje dane do logowania na stronie</b></p><br>
												 <p><b>Login:</b> '.$login.'</p><br>
												 <p><b>Hasło:</b> '.$haslo.'</p><br>
												 <br><br>
												 <p>Nikomu nie udostępniaj tych danych!</p><br>
												 <p>Pakif.pl nigdy nie zapyta o dane logowania!</p><br><br>
												 <hr><br>
												 <p>Wiadomość wysyłana automatycznie, prosimy na nią nie odpowiadać.</p>
											</span>
										';

										$headers = "From: " . $from . "\r\n";
										$headers .= "Reply-To: ". $from . "\r\n";
										$headers .= "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

										if(mail($email, $subject, $message, $headers, "-f ".$from)){
											echo 'Wiadomość została wysłana';
										}
										
							}else{
								throw new Exception($connect->error);
							}
									}
								}$connect->close();
							}
							catch(Exception $error){
								echo '<div style="color: red; font-size: 15px;">Przepraszamy wystąpił błąd, prosimy spróbować ponownie.</div>';
								//$_SERVER['HTTP_REFERER']
								//echo '</br>Informacja developerska:</br>'.$error;
							}
						}
					}
							// Tutaj co ma się zrobić po dokonaniu płatności
							// Czyli wysłać emaila z danymi do logowania
							// stworzyć tabele w której będą zapisane kursy kupione czyli np. kursy: 1,2,5
							
							// Do tego stworzyć bazę pytań i odpowiedzi
							// coś takiego żeby ID się zgrywały np pytania do testu z ID...
							// odpowiedzi otwarte, max. 10 pytań do każdego
							
							
							
							unset($signature);
							unset($_POST['signature']);
						}else{
							exit();
						}
					}else{
						exit();
					}
				}else{
					exit();
				}
			}else{
				exit();
			}
		}else{
			exit();
		}
	}else{
		exit();
	}
}else{
	exit();
}
echo "OK";
exit();
?>