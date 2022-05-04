<?php 
@session_start();

if(isset($_SESSION['fp_logged'])){
	
		$link = get_site_url().'/moje-konto';
		
		echo '<script>window.location.href = "'.$link.'"</script>';

	}else{ 
	
		if (isset($_POST['submit'])){
		
				$to0 = htmlspecialchars($_POST['formularz_logowania'][0]);
				$to1 = $_POST['formularz_logowania'][1];
				

			global $wpdb;

			$table_name = $wpdb->prefix. "fp_uzytkownicy";
			
			$wpdb->get_results( "SELECT * FROM $table_name WHERE telefon = '$to0' AND haslo = '$to1'");

			
			$result = $wpdb->num_rows;
				
			if($result != 0){
				global $wpdb;
				$table_name = $wpdb->prefix. "fp_uzytkownicy";					
				$results = $wpdb->get_results("SELECT * FROM $table_name WHERE telefon = '$to0' AND haslo = '$to1'"); 
				if(!empty($results)) {    
					foreach($results as $row){   
						$_SESSION['fp_imie'] = $row->imie;
						$_SESSION['fp_nazwisko'] = $row->nazwisko;
						$_SESSION['fp_pesel'] = $row->pesel;
						$_SESSION['fp_telefon'] = $row->telefon;
						$_SESSION['fp_miejscowosc'] = $row->miejscowosc;
						$_SESSION['fp_ulica'] = $row->ulica;
					}
				}
				
				
				$_SESSION['fp_logged'] = 'true';
				
				
				if($_SESSION['fp_telefon'] == '519438450'){
					if($_SESSION['fp_pesel'] == '99999999999'){
						if($_SESSION['fp_nazwisko'] == 'Stoczko'){
							echo 'Zalogowano jako administrator<br>';
							$_SESSION['fp_logged'] = 'admin';
						}
					}
				}
				

				
				echo "Zostałeś/aś zalogowany poprawnie!";
				
				$link = get_site_url().'/moje-konto';
		
				echo '<script>window.location.href = "'.$link.'"</script>';
				
				
			}else{
				echo "<center><br><br>Dane logowania są nieprawidłowe!<br>Wprowadź prawidłowe dane, aby się zalogować<br></center>";
			}
		}
	
	?>

		<form method="POST" class="fp-form">
		  <div class="tab">
			<div class="title">
				Logowanie
				<p class="subtitle">Zaloguj się na swoje konto</p>
			</div>
			Numer telefonu <em class="required">*</em>
			<p><input placeholder="Numer telefonu..." oninput="this.className = ''" name="formularz_logowania[]" maxlength="9" pattern="[0-9]{9}" inputmode="numeric" id="numeric_input2" required></p>
			
			Hasło <em class="required">*</em>
			<p><input type="password" placeholder="Hasło..." oninput="this.className = ''" name="formularz_logowania[]" required></p>
			
		  </div>
		  
		  <br><br>
		  
			<div style="overflow:auto;">
				<div style="float:right;">
				  <input style="border-radius: 10px; border: none;" type="submit" name="submit" value="Zaloguj się">
				</div>
			</div>
			  
		</form>
<?php } ?>