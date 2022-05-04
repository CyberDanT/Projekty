<?php
require_once('inputs.php');
?>


	<div class="text-center">
		<form method="POST" action="podsumowanie.php">
			<h1>Formularz posiłków</h1>
			<br>
			<br>
			<h2>Wybierz kaloryczność</h2>
			<?php
				for($i = 1; $i<=$count; $i++){
					foreach($_SESSION['Cennik'.$i] as $key=>$val) {
					?>
						<label for="Calories<?php echo $val['kalorycznosc']; ?>"><?php echo $val['kalorycznosc'];?></label>
						<input type="radio" id="Calories<?php echo $val['kalorycznosc']; ?>" name="Calories" value="<?php echo $val['kalorycznosc']; ?>" <?php if($i == 1){echo 'checked';} ?> onchange="radioClick(this);"/><br>
					<?php
					}
				}
			?>

			<br><br>
			<center>
				<h2>Wybierz daty posiłków</h2>
				
				<div id="datepicker">
					<input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select days" hidden/>
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-calendar"></i>
						<span class="count"></span>
					</span>
				</div>
			</center>
			
			<br>
			<h2>Wybierz posiłki</h2>
			<div class="form-inline justify-content-center">
				<div class="form-group" style="margin: 10px;">
					<input type="checkbox" id="inputsniadanie" name="Sniadanie" value="Śniadanie" checked>
					<label for="inputsniadanie"> Śniadanie</label><br>
				</div>
				<div class="form-group" style="margin: 10px;">
					<input type="checkbox" id="input2sniadanie" name="2Sniadanie" value="2 Śniadanie" checked>
					<label for="input2sniadanie"> 2 Śniadanie</label><br>
				</div>
				<div class="form-group" style="margin: 10px;">
					<input type="checkbox" id="inputobiad" name="Obiad" value="Obiad" checked>
					<label for="inputobiad"> Obiad</label><br>
				</div>
				<div class="form-group" style="margin: 10px;">
					<input type="checkbox" id="inputpodwieczorek" name="Podwieczorek" value="Podwieczorek" checked>
					<label for="inputpodwieczorek"> Podwieczorek</label><br>
				</div>
				<div class="form-group" style="margin: 10px;">
					<input type="checkbox" id="inputkolacja" name="Kolacja" value="Kolacja" checked>
					<label for="inputkolacja"> Kolacja</label><br>
				</div>
			</div>
			
			<br>
			<h3>Wybierz menu</h3>
				<div id="menuinfo"></div>
				<div id="menu">
				</div>
				
				<div id="menuselect">
					<?php 
						for($i=0; $i<= 10; $i++){
							$NewDate=Date('yy-m-d', strtotime('+'.$i.' days'));
							echo '<div id="MealsFor'.$NewDate.'" class="MealsList" style="display: none;">
								<br><br>
								<h5>Menu dla dnia '.$NewDate.'</h5>';
								
								// ŚNIADANIE 
								foreach($_SESSION['Sniadanie'.$NewDate] as $key=>$val) {
									echo '
									<div class="container sniadanie" style="margin-top: 25px;">
										<div class="row">
											<div class="col-md-2">
												<h5>Śniadanie</h5>
												<p class="inputfromcalories"><br>Dla kalorii 1000</p>		
											</div>';
											for($num=1; $num<= 4; $num++){
												echo '
												<div class="col">
													<div id="ilps'.$num.$NewDate.'" style="display: none;">
														<label for "ilsniadanie'.$num.$NewDate.'">Ilość posiłku<br></label>
														<input value="1" min="1" type="number" name="ilsniadanie'.$num.$NewDate.'" id="ilsniadanie'.$num.$NewDate.'" onchange=\'checkDates();\'>
													</div>
													<br><br>
													<label for="sniadanie'.$num.$NewDate.'">'.$val['wybor-'.$num].'<br>Skład: '.$val['sklad-'.$num].'</label>
													<input type="checkbox" name="sniadanie'.$num.$NewDate.'" id="sniadanie'.$num.$NewDate.'" value="'.$val['wybor-'.$num].'" onclick=\'checkDates(); getChange("ilps'.$num.$NewDate.'");\'>
												</div>
												';
											}
										echo '
										</div>
										<hr>
									</div>';
								}
								
								// 2 ŚNIADANIE 
								foreach($_SESSION['Sniadanie2'.$NewDate] as $key=>$val) {
									echo '
									<div class="container 2sniadanie" style="margin-top: 25px;">
										<div class="row">
											<div class="col-md-2">
												<h5>2 Śniadanie</h5>
												<p class="inputfromcalories"><br>Dla kalorii 1000</p>
											</div>';
											for($num=1; $num<= 4; $num++){
												echo '
												<div class="col">
													<div id="ilp2s'.$num.$NewDate.'" style="display: none;">
														<label for "il2sniadanie'.$num.$NewDate.'">Ilość posiłku<br></label>
														<input value="1" min="1" type="number" name="il2sniadanie'.$num.$NewDate.'" id="il2sniadanie'.$num.$NewDate.'" onchange=\'checkDates();\'>
													</div>
													<br><br>
													<label for="2sniadanie'.$num.$NewDate.'">'.$val['wybor-'.$num].'<br>Skład: '.$val['sklad-'.$num].'</label>
													<input type="checkbox" name="2sniadanie'.$num.$NewDate.'" id="2sniadanie'.$num.$NewDate.'" value="'.$val['wybor-'.$num].'" onclick=\'checkDates(); getChange("ilp2s'.$num.$NewDate.'");\'>
												</div>';
											}
											echo '
										</div>
										<hr>
									</div>';
								}
								
								// OBIAD
								foreach($_SESSION['Obiad'.$NewDate] as $key=>$val) {
									echo '
									<div class="container obiad" style="margin-top: 25px;">
										<div class="row">
											<div class="col-md-2">
												<h5>Obiad</h5>
												<p class="inputfromcalories"><br>Dla kalorii 1000</p>
											</div>';
											for($num=1; $num<= 4; $num++){
												echo '
												<div class="col">
													<div id="ilpo'.$num.$NewDate.'" style="display: none;">
														<label for "ilobiad'.$num.$NewDate.'">Ilość posiłku<br></label>
														<input value="1" min="1" type="number" name="ilobiad'.$num.$NewDate.'" id="ilobiad'.$num.$NewDate.'" onchange=\'checkDates();\'>
													</div>
													<br><br>
													<label for="obiad'.$num.$NewDate.'">'.$val['wybor-'.$num].'<br>Skład: '.$val['sklad-'.$num].'</label>
													<input type="checkbox" name="obiad'.$num.$NewDate.'" id="obiad'.$num.$NewDate.'" value="'.$val['wybor-'.$num].'" onclick=\'checkDates(); getChange("ilpo'.$num.$NewDate.'");\'>
												</div>';
											}
											echo '
										</div>
										<hr>
									</div>';
								}
								
								// PODWIECZOREK
								foreach($_SESSION['Podwieczorek'.$NewDate] as $key=>$val) {
									echo '
									<div class="container podwieczorek" style="margin-top: 25px;">
										<div class="row">
											<div class="col-md-2">
												<h5>Podwieczorek</h5>
												<p class="inputfromcalories"><br>Dla kalorii 1000</p>
											</div>';
											for($num=1; $num<= 4; $num++){
												echo '
												<div class="col">
													<div id="ilpp'.$num.$NewDate.'" style="display: none;">
														<label for "ilpodwieczorek'.$num.$NewDate.'">Ilość posiłku<br></label>
														<input value="1" min="1" type="number" name="ilpodwieczorek'.$num.$NewDate.'" id="ilpodwieczorek'.$num.$NewDate.'" onchange=\'checkDates();\'>
													</div>
													<br><br>
													<label for="podwieczorek'.$num.$NewDate.'">'.$val['wybor-'.$num].'<br>Skład: '.$val['sklad-'.$num].'</label>
													<input type="checkbox" name="podwieczorek'.$num.$NewDate.'" id="podwieczorek'.$num.$NewDate.'" value="'.$val['wybor-'.$num].'" onclick=\'checkDates(); getChange("ilpp'.$num.$NewDate.'");\'>
												</div>';
											}
											echo '
										</div>
										<hr>
									</div>';
								}
								
								// KOLACJA
								foreach($_SESSION['Kolacja'.$NewDate] as $key=>$val) {
									echo '
									<div class="container kolacja" style="margin-top: 25px;">
										<div class="row">
											<div class="col-md-2">
												<h5>Kolacja</h5>
												<p class="inputfromcalories"><br>Dla kalorii 1000</p>
											</div>';
											for($num=1; $num<= 4; $num++){
												echo '
												<div class="col">
													<div id="ilpk'.$num.$NewDate.'" style="display: none;">
														<label for "ilkolacja'.$num.$NewDate.'">Ilość posiłku<br></label>
														<input value="1" min="1" type="number" name="ilkolacja'.$num.$NewDate.'" id="ilkolacja'.$num.$NewDate.'" onchange=\'checkDates();\'>
													</div>
													<br><br>
													<label for="kolacja'.$num.$NewDate.'">'.$val['wybor-'.$num].'<br>Skład: '.$val['sklad-'.$num].'</label>
													<input type="checkbox" name="kolacja'.$num.$NewDate.'" id="kolacja'.$num.$NewDate.'" value="'.$val['wybor-'.$num].'" onclick=\'checkDates(); getChange("ilpk'.$num.$NewDate.'");\'>
												</div>';
											}
											echo '
										</div>
										<hr>
									</div>';
								}
								echo '<div id="forsubmit"></div>';
							echo '</div>';
						}
					?>
				</div>

			<?php
			// CENNIK
			echo '<div>';
			for($i = 1; $i<=$count; $i++){
				foreach($_SESSION['Cennik'.$i] as $key=>$val) {
					echo '<input type="hidden" id="Csniadanie'.$val['kalorycznosc'].'" value="'.$val['sniadanie'].'">';
					echo '<input type="hidden" id="C2sniadanie'.$val['kalorycznosc'].'" value="'.$val['2sniadanie'].'">';
					echo '<input type="hidden" id="Cobiad'.$val['kalorycznosc'].'" value="'.$val['obiad'].'">';
					echo '<input type="hidden" id="Cpodwieczorek'.$val['kalorycznosc'].'" value="'.$val['podwieczorek'].'">';
					echo '<input type="hidden" id="Ckolacja'.$val['kalorycznosc'].'" value="'.$val['kolacja'].'">';
					
					$Csniadanie[$val['kalorycznosc']] = (int)$val['sniadanie'];
					$C2sniadanie[$val['kalorycznosc']] = (int)$val['2sniadanie'];
					$Cobiad[$val['kalorycznosc']] = (int)$val['obiad'];
					$Cpodwieczorek[$val['kalorycznosc']] = (int)$val['podwieczorek'];
					$Ckolacja[$val['kalorycznosc']] = (int)$val['kolacja'];
					
					$SumaCennika = $Csniadanie[$val['kalorycznosc']] + $C2sniadanie[$val['kalorycznosc']] + $Cobiad[$val['kalorycznosc']] + $Cpodwieczorek[$val['kalorycznosc']] + $Ckolacja[$val['kalorycznosc']];
					echo '<input type="hidden" id="SumaCennika'.$val['kalorycznosc'].'" value="'.$SumaCennika.'">';					
				}
			}
			echo '</div>';
			?>
			<br><br>
			<h3>Łączna suma całego zamówienia:</h3>
			<p id="cena">Całkowita kwota: <br>0 PLN</p>
			
			<input type="submit" name="submit" id="submit" disabled>
			<p id="submitinfo"></p>
						
			
		</form>
	</div>