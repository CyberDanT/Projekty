<?php
function footer()
{
	?>
		<footer class="footer mt-auto py-3">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3">
						<div style="min-height: 250px;">
							<br><br>
							<b>Polska Akademia Kulturystyki i Fitness</b><br><br>
							Ul.<br>
							Kod pocztowy Miejscowość<br>
							NIP 
						</div>
						<hr>
					</div>
					
					<div class="col-md-3">
						<div style="min-height: 250px;">
							<br><br>
							<b>Obsługa Klienta:</b><br>
							<br>
							e-mail: kontakt@pakif.pl<br>
							telefon: <br>
							Obsługa telefoniczna w dni robocze (pon-pt) w godz. 09:00 - 17:00<br>
						</div>
						<hr>
					</div>
					
					
					<div class="col-md-3">
						<div style="min-height: 250px;">
							<br><br>
							<b>Obsługa dotacji dla bezrobotnych, szkół bądź firm:</b><br>
							<br>
							e- mail: <b>dotacje@pakif.pl</b><br><br>
							<b>Nr konta bankowego (Santander): PL
							<br>
							SWIFT-BIC: </b>
						</div>
						<hr>
					</div>
					
					<div class="col-md-3">
						<div style="min-height: 250px;">
							<br><br>
							<div class="col" style="margin-bottom: 30px;"><b>Informacje</b></div>
							<div class="col"><a href="Regulamin.php">Regulamin</a></div>
							<div class="col"><a href="Prywatnosc.php">Prywatność</a></div>
							<div class="col"><a href="Cookies.php">Pliki Cookies</a></div>
						</div>
						<hr>
					</div>
				</div>
				
				<div class="col" style="color: black;"><br>© Copyright 2020 - Wszelkie prawa zastrzeżone</div> <!--  border-radius: 10px; color: white; background-color: rgba(51,51,51, 0.9);"> -->
				
				<div id="infocookies" style="position: fixed; bottom: 10px; left: 10px; min-width: 200px; max-width: 250px; padding: 5px; z-index: 100; border-radius: 10px; color: black; background-color: rgba(255,255,255,0.9); box-shadow: 0px 0px 15px 4px gray;">
					<div style="text-align: center; margin: 10px;"><br>W celu poprawnego działania serwisu, korzystamy z plików Cookies <br>Zobacz <a style="border-bottom: 1px solid white;" href="Cookies.php">Polityke Cookies</a>
						<a tabindex="0" id="accept" style="cursor: pointer; color: gray; position: absolute; top: 10px; right: 10px; font-size: 25px;"><b><span class="icon-close"></span></b></a>
					</div>
				</div>
				
			</div>
		</footer>
	</body>
</html>
<script type="text/javascript">
	function checkcookies(){
		if(localStorage.timeforsuccess_cookiesinfo_accepted){
			document.getElementById('infocookies').style="display: none;"
		} 
	}
	window.onload = checkcookies;
	
	x = document.getElementById('accept');
	x.onclick = function(){
		localStorage.timeforsuccess_cookiesinfo_accepted = true; 
		document.getElementById('infocookies').style.display="none";
	}
</script>
	
	<?php
}
?>
