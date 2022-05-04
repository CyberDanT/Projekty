<?php 
@session_start();
if(!isset($_SESSION['fp_logged'])){
	$link = get_site_url().'/moje-konto';	
	echo '<script>window.location.href = "'.$link.'"</script>';
}

if(isset($_POST['wyloguj'])){
	session_destroy();
	echo "Zostałeś/aś wylogowany!";	
	$link = get_site_url();
	echo '<script>window.location.href = "'.$link.'"</script>';
}
?>
<center>
	
	<form method="POST" class="fp-form" style="max-width: 70%;">
		
		<div class="title" style="margin-top: 0;">
			Wylogowanie z konta
			<hr>
		</div>
			
			
			Czy na pewno chcesz się wylogować?

		<br><br>
			
		<div>
			<div>
			  <input style="border-radius: 10px; border: none;" type="submit" name="wyloguj" value="Tak, wyloguj">
			</div>
		</div>
		  
	</form>
</center>