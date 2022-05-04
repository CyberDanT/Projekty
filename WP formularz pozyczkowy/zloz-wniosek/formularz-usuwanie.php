<?php 
@session_start();
if(!isset($_SESSION['fp_logged'])){
	$link = get_site_url().'/moje-konto';	
	echo '<script>window.location.href = "'.$link.'"</script>';
}

if(isset($_POST['usun'])){
	echo "Usunięto konto!";
	
	
	global $wpdb;
	$table_name = $wpdb->prefix. "fp_pozyczki";
	$wpdb->query( 'DELETE FROM '.$table_name.' WHERE pesel = '.$_SESSION['fp_pesel'].'');
	
	$table_name = $wpdb->prefix. "fp_uzytkownicy";
	$wpdb->query( 'DELETE FROM '.$table_name.' WHERE pesel = '.$_SESSION['fp_pesel'].'');
	
	session_destroy();
	$link = get_site_url();
	echo '<script>window.location.href = "'.$link.'"</script>';
}
?>
<center>
	
	<form method="POST" class="fp-form" style="max-width: 70%;">
			
			<div class="title" style="margin-top: 0;">
				Usuwanie konta
				<hr>
			</div>
			
			
	<?php 
	if($_SESSION['fp_logged'] != 'admin'){
	?>				
			
			
				Czy na pewno chcesz usunąć konto?
	
			<br><br>
	
			
		<div>
			<div>
			  <input style="border-radius: 10px; border: none;" type="submit" name="usun" value="Tak, usuń">
			</div>
		</div>
		
		
	<?php 
	}else{
		echo 'Jesteś administratorem. Dla bezpieczeństwa - nie możesz usunąć swojego konta.<br>Zmiana danych możliwa jest jedynie ręcznie.';
	}
	?>
		  
	</form>
</center>