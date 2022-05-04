<?php 
@session_start();

if(!isset($_POST['submit'])){
		if(isset($_SESSION['fp_logged'])){
			echo '<center>Jesteś zalogowany, Twoje dane zostały uzupełnione automatycznie.<br>Wybierz interesującą Cię pożyczkę oraz potwierdź kodem sms.</center>';
		}
	?>
		<form method="POST" class="fp-form">
		  <!-- One "tab" for each step in the form: -->
		  <div class="tab">
			<div class="title">
				Dane kontaktowe
				<hr>
			</div>
			Imię <em class="required">*</em>
			<p><input placeholder="Imię..." oninput="this.className = ''" name="formularz_pozyczkowy[]" required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?>readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_imie']; ?>" 
				<?php
				}
			?>
			></p>
			
			Nazwisko <em class="required">*</em>
			<p><input placeholder="Nazwisko..." oninput="this.className = ''" name="formularz_pozyczkowy[]" required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?>readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_nazwisko']; ?>" 
				<?php
				}
			?>
			></p>
			
			(Polski) 11-cyfrowy numer pesel <em class="required">*</em>
			<p><input placeholder="Numer pesel..." oninput="this.className = ''" name="formularz_pozyczkowy[]" maxlength="11" pattern="[0-9]{11}" inputmode="numeric" id="numeric_input" required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?>readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_pesel']; ?>" 
				<?php
				}
			?>
			></p>
			
			Numer telefonu (9 cyfrowy, bez spacji oraz znaków specjalnych) <em class="required">*</em>
			<p><input placeholder="Numer telefonu..." oninput="this.className = ''" name="formularz_pozyczkowy[]" maxlength="9" pattern="[0-9]{9}" inputmode="numeric" id="numeric_input2"  required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?>readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_telefon']; ?>" 
				<?php
				}
			?>
			></p>
			
			Miejscowość <em class="required">*</em>
			<p><input placeholder="Miejscowość..." oninput="this.className = ''" name="formularz_pozyczkowy[]"  required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?>readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_miejscowosc']; ?>" 
				<?php
				}
			?>
			></p>
			
			Ulica <em class="required">*</em>
			<p><input placeholder="Ulica..." oninput="this.className = ''" name="formularz_pozyczkowy[]"  required
			<?php 
				if(isset($_SESSION['fp_ulica'])){
					?>readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_imie']; ?>" 
				<?php
				}
			?>
			></p>
			
			
			<br><br><br>
			
			<div class="title">
				Pożyczka
				<hr>
			</div>
			
			

			<p>
				<div class="slidecontainer">
					<div class="row" style="margin: auto;">
						<div class="col-sm-10">
							<span class="inputformvalues">Kwota wnioskowana?</span>
							<input type="range" min="0" max="5000" value="2500" step="500" name="formularz_pozyczkowy[]" class="slider" id="myRange" style="height: 10px; padding: 0; background: #d3d3d3; border: 1px solid #d3d3d3;">
						</div>
						<div class="col-sm-2">
							<div class="sliderp"><div id="demo" class="demo"></div></div>
						</div>
					</div>
				</div>
			</p>
			
			<p>
				<div class="slidecontainer">
					<div class="row" style="margin: auto;">
						<div class="col-sm-10">
							<span class="inputformvalues">Okres spłaty?</span>
							<input type="range" min="0" max="100" value="50" step="10" name="formularz_pozyczkowy[]" class="slider" id="myRange2" style="height: 10px; padding: 0; background: #d3d3d3; border: 1px solid #d3d3d3;">
						</div>
						<div class="col-sm-2">
							<div class="sliderp"><div id="demo2" class="demo"></div></div>
						</div>
					</div>
				</div>
			</p>
			
			<p>
				<div class="slidecontainer">
					<div class="row" style="margin: auto;">
						<div class="col-sm-10">
							<span class="inputformvalues">Ilość rat?</span>
								<input type="range" min="0" max="24" value="12" step="1" name="formularz_pozyczkowy[]" class="slider" id="myRange3" style="height: 10px; padding: 0; background: #d3d3d3; border: 1px solid #d3d3d3;">
						</div>
						<div class="col-sm-2">
							<div class="sliderp"><div id="demo3" class="demo"></div></div>
						</div>
					</div>
				</div>
			</p>
			
			
			<script>
				var slider = document.getElementById("myRange");
				var output = document.getElementById("demo");
				output.innerHTML = slider.value  + ' zł';

				slider.oninput = function() {
				  output.innerHTML = this.value  + ' zł';
				}

				var slider2 = document.getElementById("myRange2");
				var output2 = document.getElementById("demo2");
				output2.innerHTML = slider2.value  + ' dni';

				slider2.oninput = function() {
				  output2.innerHTML = this.value  + ' dni';
				}

				var slider3 = document.getElementById("myRange3");
				var output3 = document.getElementById("demo3");
				output3.innerHTML = slider3.value  + ' rat';

				slider3.oninput = function() {
				  output3.innerHTML = this.value  + ' rat';
				}
			</script>
			
			
			<br><br><br>
			
			<div class="title">
				Potwierdzenie numeru telefonu
				<hr>
			</div>
			<p class="subtitle">Potwierdź swój numer telefonu wysyłając SMS o treści ....... pod numer ....... a następnie wprowadź go poniżej <em class="required">*</em></p>
			
			Kod SMS<em class="required">*</em>
			<p><input placeholder="Kod SMS..." oninput="this.className = ''" name="formularz_pozyczkowy[]" required></p>
			
		  </div>
		  
		  <br><br>
		  
		  <div style="overflow:auto;">
			<div style="float:right;">
			  <input style="border-radius: 10px; border: none;" type="submit" name="submit" value="Wyślij wniosek">
			</div>
		  </div>
		</form>
	<?php 
}else{
	
	if (isset($_POST['submit'])){
	
		$to0 = htmlspecialchars($_POST['formularz_pozyczkowy'][0]);
		$to1 = htmlspecialchars($_POST['formularz_pozyczkowy'][1]);
		$to2 = htmlspecialchars($_POST['formularz_pozyczkowy'][2]);
		$to3 = htmlspecialchars($_POST['formularz_pozyczkowy'][3]);
		$to4 = htmlspecialchars($_POST['formularz_pozyczkowy'][4]);
		$to5 = htmlspecialchars($_POST['formularz_pozyczkowy'][5]);
		$to6 = htmlspecialchars($_POST['formularz_pozyczkowy'][6]);
		$to7 = htmlspecialchars($_POST['formularz_pozyczkowy'][7]);
		$to8 = htmlspecialchars($_POST['formularz_pozyczkowy'][8]);
		$to9 = htmlspecialchars($_POST['formularz_pozyczkowy'][9]); // kod sms	
	


		if(!isset($_SESSION['fp_logged'])){
			
			global $wpdb;
		
			$table_name = $wpdb->prefix. "fp_uzytkownicy";
			
			$wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE pesel = '.$to2.' OR telefon = '.$to3.'');

			
			$result = $wpdb->num_rows;
			
		
			
			
			if($result == 0){

				$opcje=array();
				// Sekret znajdujący się w panelu klienta HotPay.
				$opcje["sekret"]="SzdNcy9kcTlCZVN1Ny9ZemlzUFBpSXQzT0lhcHpmb2l2cnFpN1Q2ZHZIST0,";
				// Kod otrzymany przez użytkownika poprzez SMS.
				$opcje["kod_sms"] = $to9;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://apiv2.hotpay.pl/v1/sms/sprawdz?".http_build_query($opcje));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$wynik = curl_exec($ch);
				curl_close($ch);

				$codeInfo = json_decode($wynik);

				if($codeInfo->status=="ERROR"){
					echo "Wystąpił błąd: : ".$codeInfo->tresc;
				}else if($codeInfo->status=="SUKCESS"){
					
					
					
					function password_generate($chars) {
					  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
					  return substr(str_shuffle($data), 0, $chars);
					}
					
					$haslo = password_generate(10);
					
					$wpdb->insert( $table_name, array(
						'imie' => $to0, 
						'nazwisko' => $to1,
						'pesel' => $to2,
						'haslo' => $haslo,
						'telefon' => $to3, 
						'miejscowosc' => $to4, 
						'ulica' => $to5,
						'reg_date' => date("Y/m/d H:m:s") ),
						array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) 
					);
					
					
					$table_name = $wpdb->prefix. "fp_pozyczki";
					$wpdb->insert( $table_name, array(
						'pesel' => $to2, 
						'telefon' => $to3, 
						'kwotapozyczki' => $to6,
						'czaspozyczki' => $to7,
						'iloscrat' => $to8,
						'status' => 'W trakcie weryfikacji' ),
						array( '%s', '%s', '%s', '%s', '%s' ) 
					);
					
					echo 'Twój wniosek czeka na rozpatrzenie<br>Możesz go zobaczyć logując się na swoje konto<br><br><b>Twoje dane logowania:</b><br>Login: '.$to3.' <br> Hasło: '.$haslo.' ';

					
					
					
					
				}
				
				
				
				
			}else{
				echo "Numer telefonu lub pesel został już wykorzystany.<br>Jeśli to Twoje konto - zaloguj się."; 
			}
		}else{
		
			$opcje=array();
			// Sekret znajdujący się w panelu klienta HotPay.
			$opcje["sekret"]="SzdNcy9kcTlCZVN1Ny9ZemlzUFBpSXQzT0lhcHpmb2l2cnFpN1Q2ZHZIST0,";
			// Kod otrzymany przez użytkownika poprzez SMS.
			$opcje["kod_sms"] = $to9;

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
				$table_name = $wpdb->prefix. "fp_pozyczki";
				$wpdb->insert( $table_name, array(
					'pesel' => $to2, 
					'kwotapozyczki' => $to6,
					'czaspozyczki' => $to7,
					'iloscrat' => $to8,
					'status' => 'W trakcie weryfikacji' ),
					array( '%s', '%s', '%s', '%s', '%s' ) 
				);
				
				echo 'Twój wniosek czeka na rozpatrzenie<br>Możesz go zobaczyć w panelu swojego konta.';
				
				
			}
			
			

		}
	}
}
?>