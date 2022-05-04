<?php
@session_start();
if(!isset($_SESSION['fp_logged'])){
	$link = get_site_url().'/moje-konto';	
	echo '<script>window.location.href = "'.$link.'"</script>';
}
if(isset($_POST['zmiennrtel'])){
	if($_POST['nrtel'] != ''){
		if($_POST['sms'] != ''){
			
			$to0 = htmlspecialchars($_POST['nrtel']);
		
			global $wpdb;
			$table_name = $wpdb->prefix. "fp_uzytkownicy";
			$wpdb->get_results( "SELECT * FROM $table_name WHERE telefon = '$to0' ");

			
			$result = $wpdb->num_rows;
				
			if($result == 0){
			
			
				// Jeśli weryfikacja SMS jest ok to:
				
				$to1 = $_POST['sms']; // KOD SMS
				
				
				$opcje=array();
				// Sekret znajdujący się w panelu klienta HotPay.
				$opcje["sekret"]="SzdNcy9kcTlCZVN1Ny9ZemlzUFBpSXQzT0lhcHpmb2l2cnFpN1Q2ZHZIST0,";
				// Kod otrzymany przez użytkownika poprzez SMS.
				$opcje["kod_sms"] = $to1;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://apiv2.hotpay.pl/v1/sms/sprawdz?".http_build_query($opcje));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$wynik = curl_exec($ch);
				curl_close($ch);

				$codeInfo = json_decode($wynik);

				if($codeInfo->status=="ERROR"){
					echo "Wystąpił błąd: : ".$codeInfo->tresc;
				}else if($codeInfo->status=="SUKCESS"){
				

						global $wpdb;
						$table_name = $wpdb->prefix. "fp_uzytkownicy";
						$wpdb->query('UPDATE '.$table_name.' SET telefon='.$to0.' WHERE pesel='.$_SESSION['fp_pesel'].'');
						
						$_SESSION['fp_telefon'] = $to0;
						
						
						
						
				}
				
				echo 'Twój numer telefonu został zmieniony poprawnie<br><br>'; 
				// Jeśli inaczej to wysłanie że nie bo np zły kod SMS
				
			}else{
				echo 'Taki numer telefonu istnieje już w bazie danych<br><br>';
			}
			
		}else{
			echo 'Pole sms - nie może być puste<br><br>';
		}
	}else{
		echo 'Pole telefon - nie może być puste<br><br>';
	}
}
?>

	<form method="POST" class="fp-form">
	
		  <!-- One "tab" for each step in the form: -->
			<div class="title" style="margin-top: 0;">
				Zmień login/numer telefonu
				<hr>
			</div>
			

	<?php 
	if($_SESSION['fp_logged'] != 'admin'){
	?>			
			
			
			<center>
			Uwaga!<br>Do ponownego zalogowania się (po wylogowaniu się z konta), będzie potrzebny nowy numer telefonu.<br><br><br>
			</center>
			
			Numer telefonu (9 cyfrowy, bez spacji oraz znaków specjalnych) <em class="required">*</em>
			<p><input placeholder="Numer telefonu..." oninput="this.className = ''" name="nrtel" maxlength="9" pattern="[0-9]{9}" inputmode="numeric" id="numeric_input2"  required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?> value="<?php echo $_SESSION['fp_telefon']; ?>" 
				<?php
				}
			?>
			></p>
			
			
			<p class="subtitle">Potwierdź swój numer telefonu wysyłając SMS o treści ....... pod numer ....... a następnie wprowadź go poniżej <em class="required">*</em></p>
			
			Kod SMS<em class="required">*</em>
			<p><input placeholder="Kod SMS..." oninput="this.className = ''" name="sms" required></p>
			
		  <br><br>
		  
		  <div style="overflow:auto;">
			<div style="float:right;">
			  <input style="border-radius: 10px; border: none;" type="submit" name="zmiennrtel" value="Zmień login/numer telefonu">
			</div>
		  </div>
		  
		  
	<?php 
	}else{
		echo '<center>Jesteś administratorem. Dla bezpieczeństwa - nie możesz zmieniać swoich danych.<br>Zmiana danych możliwa jest jedynie ręcznie.</center>';
	}
	?>
		  
		</form>
		