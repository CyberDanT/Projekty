<?php
@session_start();

if(!isset($_SESSION['fp_logged'])){
	$link = get_site_url().'/moje-konto';	
	echo '<script>window.location.href = "'.$link.'"</script>';
}


if(isset($_GET['status'])){
	if(isset($_GET['id'])){
	
		$to0 = $_GET['id'];
		
		
		global $wpdb;
		$table_name = $wpdb->prefix. "fp_pozyczki";
		$wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE id = '.$to0.' ');

		
		$result = $wpdb->num_rows;
			
		if($result != 0){
			
			global $wpdb;
			$table_name = $wpdb->prefix. "fp_pozyczki";
			
			if($_GET['status'] == 'zaakceptowana'){
			
				$wpdb->query('UPDATE '.$table_name.' SET status=\'Zaakceptowana\' WHERE id='.$to0.' ');
				
				$link = get_site_url().'/moje-konto';	
				echo '<script>window.location.href = "'.$link.'"</script>';
			}
			
			if($_GET['status'] == 'odrzucona'){
			
				$wpdb->query('UPDATE '.$table_name.' SET status=\'Odrzucona\' WHERE id='.$to0.' ');
			
				$link = get_site_url().'/moje-konto';	
				echo '<script>window.location.href = "'.$link.'"</script>';
			
			}
		}
	}
}





?>

<form class="fp-form">
<div class="title" style="margin-top: 0;">
	Wnioski o pożyczkę
	<hr>
</div>

</form>

<?php



global $wpdb;

$table_name = $wpdb->prefix. "fp_pozyczki";

if($_SESSION['fp_logged'] == 'admin'){
	$wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE status = \'W trakcie weryfikacji\' ');
}else{
	$wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE pesel = '.$_SESSION['fp_pesel'].'');
}


$result = $wpdb->num_rows;
	
if($result != 0){
	global $wpdb;
	$table_name = $wpdb->prefix. "fp_pozyczki";		

	if($_SESSION['fp_logged'] == 'admin'){
		echo '<center>Jesteś administratorem, wyświetlone zostały wszystkie wnioski użytkowników o pożyczki.<br><br></center>';
		
		if(isset($_GET['pesel'])){
			if($_SESSION['fp_logged'] == 'admin'){	
				if(isset($_GET['pid'])){
					
					?>
					
					<div style="margin-top: 25px; margin-bottom: 25px; border-top: 1px solid gray; border-bottom: 1px solid gray; padding-top: 10px; padding-bottom: 10px;">
						<center><b>Dane wybranego numeru:</b></center>
						<?php 
						
						global $wpdb;

						$table_name = $wpdb->prefix. "fp_uzytkownicy";
						$wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE pesel='.$_GET['pesel'].' ');
						$result = $wpdb->num_rows;
						if($result != 0){
							global $wpdb;
							$table_name = $wpdb->prefix. "fp_uzytkownicy";					
							$results = $wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE pesel='.$_GET['pesel'].' '); 
							if(!empty($results)) {    
								foreach($results as $row){   
									echo '<b>Imię:</b> '.$row->imie.'<br>';
									echo '<b>Nazwisko:</b> '.$row->nazwisko.'<br>';
									echo '<b>Pesel:</b> '.$row->pesel.'<br>';
									echo '<b>Telefon:</b> '.$row->telefon.'<br>';
									echo '<b>Miejscowość:</b> '.$row->miejscowosc.'<br>';
									echo '<b>Ulica:</b> '.$row->ulica.'<br>';
								}
							}
						}
						
						echo '<br>';
						
						$table_name = $wpdb->prefix. "fp_pozyczki";
						$wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE id='.$_GET['pid'].' ');
						$result = $wpdb->num_rows;
						if($result != 0){
							global $wpdb;
							$table_name = $wpdb->prefix. "fp_pozyczki";					
							$results = $wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE id='.$_GET['pid'].' '); 
							if(!empty($results)) {    
								foreach($results as $row){   
									echo '<b>Wnioskowana kwota:</b> '.$row->kwotapozyczki.' zł<br>';
									echo '<b>Na okres spłaty:</b> '.$row->czaspozyczki.' dni<br>';
									echo '<b>W ilości rat:</b> '.$row->iloscrat.'<br>';
								}
							}
						}
						
						echo '<br><br>';
						
						?>
							<?php $link = get_site_url().'/moje-konto?id='.$_GET['pid'].'&status=zaakceptowana';	?>
							<a href="<?php echo $link; ?>"><b>Akceptuj wniosek</b></a>
							
							|
							
							<?php $link = get_site_url().'/moje-konto?id='.$_GET['pid'].'&status=odrzucona';	?>
							<a href="<?php echo $link; ?>"><b>Odrzuć wniosek</b></a>
										
					</div>
						
				<?php
				}
			}
		}
		
		
	
		$table_name = $wpdb->prefix. "fp_pozyczki";		
		
		
		
		$results = $wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE status = \'W trakcie weryfikacji\' '); 
	}else{
		$results = $wpdb->get_results('SELECT * FROM '.$table_name.' WHERE pesel = '.$_SESSION['fp_pesel'].''); 
	}
	
	if(!empty($results)) {    
		 
			?>
			<table>
				<thead>
				  <tr>
					<th>Pesel</th>
					<th>Kwota pożyczki</th>
					<th>Okres spłaty</th>
					<th>Ilość rat</th>
					<th>Status</th>
				  </tr>
				</thead>
			<?php
			foreach($results as $row){
				echo "<tr>"; 
				
				
					if($_SESSION['fp_logged'] == 'admin'){
						echo "<td>";
							$link = '?pesel='.$row->pesel.
							'&pid='.$row->id;
							
							echo '<a href="'.$link.'">'. $row->pesel . '</a>';
						"</td>";
					}else{
						echo "<td>" . $row->pesel . "</td>";
					}
					
					echo "<td>" . $row->kwotapozyczki . " zł</td>";
					echo "<td>" . $row->czaspozyczki . " dni</td>";
					echo "<td>" . $row->iloscrat . "</td>";
					if($row->status == "W trakcie weryfikacji"){
						echo "<td style='color: #FF8E30;'>" . $row->status . "</td>";
					}
					if($row->status == "Zaakceptowana"){
						echo "<td style='color: limegreen;'>" . $row->status . "</td>";
					}
					if($row->status == "Odrzucona"){
						echo "<td style='color: red;'>" . $row->status . "</td>";
					}
				echo "</tr>";
			}
			echo "</table>"; 
		
	}
}else{
	echo "<center>Brak wniosków o pożyczkę</center>";
}


?>