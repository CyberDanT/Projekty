<?php
@session_start();
if(!isset($_SESSION['fp_logged'])){
	$link = get_site_url().'/moje-konto';	
	echo '<script>window.location.href = "'.$link.'"</script>';
}



if(isset($_POST['zmiendaneo'])){
	if($_POST['imie'] != ''){
		if($_POST['nazwisko'] != ''){
			if($_POST['miejscowosc'] != ''){
				if($_POST['ulica'] != ''){

					
					$to0 = htmlspecialchars($_POST['imie']);
					$to1 = htmlspecialchars($_POST['nazwisko']); 
					$to2 = htmlspecialchars($_POST['miejscowosc']); 
					$to3 = htmlspecialchars($_POST['ulica']); 
				


					
					global $wpdb;
					$table_name = $wpdb->prefix. "fp_uzytkownicy";
					$wpdb->query('UPDATE '.$table_name.' SET imie='.$to0.', nazwisko='.$to1.', miejscowosc='.$to2.', ulica='.$to3.' WHERE pesel='.$_SESSION['fp_pesel'].'');
					
					$_SESSION['fp_imie'] = $to0;
					$_SESSION['fp_nazwisko'] = $to1;
					$_SESSION['fp_miejscowosc'] = $to2;
					$_SESSION['fp_ulica'] = $to3;
					
					
				}else{
					echo 'Pole ulica - nie może być puste';
				}
			}else{
				echo 'Pole miejscowość - nie może być puste';
			}
		}else{
			echo 'Pole nazwisko - nie może być puste';
		}
	}else{
		echo 'Pole imię - nie może być puste';
	}
}


?>




	<form method="POST" class="fp-form">
		  <!-- One "tab" for each step in the form: -->
			<div class="title" style="margin-top: 0;">
				Dane osobowe
				<hr>
			</div>
			
			
			
	<?php 
	if($_SESSION['fp_logged'] != 'admin'){
	?>
	
	
	
	
			Imię <em class="required">*</em>
			<p><input placeholder="Imię..." oninput="this.className = ''" name="imie" required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?> value="<?php echo $_SESSION['fp_imie']; ?>" 
				<?php
				}
			?>
			></p>
			
			Nazwisko <em class="required">*</em>
			<p><input placeholder="Nazwisko..." oninput="this.className = ''" name="nazwisko" required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?> value="<?php echo $_SESSION['fp_nazwisko']; ?>" 
				<?php
				}
			?>
			></p>
			
			(Polski) 11-cyfrowy numer pesel <em class="required">*</em>
			<p><input placeholder="Numer pesel..." oninput="this.className = ''" name="" maxlength="11" pattern="[0-9]{11}" inputmode="numeric" id="numeric_input" required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?> readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_pesel']; ?>" 
				<?php
				}
			?>
			></p>
			
			Numer telefonu (9 cyfrowy, bez spacji oraz znaków specjalnych) <em class="required">*</em>
			<p><input placeholder="Numer telefonu..." oninput="this.className = ''" name="" maxlength="9" pattern="[0-9]{9}" inputmode="numeric" id="numeric_input2"  required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?> readonly style="background: #efefef4d; cursor: default;" value="<?php echo $_SESSION['fp_telefon']; ?>" 
				<?php
				}
			?>
			></p>
			
			Miejscowość <em class="required">*</em>
			<p><input placeholder="Miejscowość..." oninput="this.className = ''" name="miejscowosc"  required
			<?php 
				if(isset($_SESSION['fp_logged'])){
					?> value="<?php echo $_SESSION['fp_miejscowosc']; ?>" 
				<?php
				}
			?>
			></p>
			
			Ulica <em class="required">*</em>
			<p><input placeholder="Ulica..." oninput="this.className = ''" name="ulica"  required
			<?php 
				if(isset($_SESSION['fp_ulica'])){
					?> value="<?php echo $_SESSION['fp_ulica']; ?>" 
				<?php
				}
			?>
			></p>
			
			
		  <br><br>
		  
		  <div style="overflow:auto;">
			<div style="float:right;">
			  <input style="border-radius: 10px; border: none;" type="submit" name="zmiendaneo" value="Zmień dane osobowe">
			</div>
		  </div>
		  
		
	<?php 
	}else{
		echo '<center>Jesteś administratorem. Dla bezpieczeństwa - nie możesz zmieniać swoich danych.<br>Zmiana danych możliwa jest jedynie ręcznie.</center>';
	}
	?>		  
		  
		  
		</form>
