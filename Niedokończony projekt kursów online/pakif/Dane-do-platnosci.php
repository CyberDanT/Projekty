<?php
	include_once('head.php');
	head();
?>
		<title>Dane do płatności</title>
	</head>
	

    <?php
		include_once('header.php');
		headerwrapper();
	?>
	
	<main role="main" class="flex-shrink-0" style="margin-top: -250px;">		
		<div class="container">
			<?php						
			unset($_SESSION['ids']);
			if(isset($_SESSION['koszyk'])){
				foreach($_SESSION['koszyk'] as $key=>$val) {
					//echo 'IdKEY: '.$key.',
					//Id: '.$val['id'].',
					//Obrazek: '.$val['obrazek'].',
					//Nazwa: '.$val['nazwa'].',
					//Opis: '.$val['opis'].',
					//Cena: '.$val['cena']."\r\n";
					if(!isset($_SESSION['ids'])){
						$_SESSION['ids'] = $val['id'];
					}else{
						$_SESSION['ids'] = $_SESSION['ids'].','.$val['id'];
					}
				}
			}
			
			?>
			
			<h4>Podaj dane do płatności</h4>
						
			<?php
			if(isset($_SESSION['bad'])){
				echo $_SESSION['bad'];
				unset($_SESSION['bad']);
			}
			?>
			
			<form style="padding-top: 50px;" method="POST" action="Platnosc.php">
			  <div class="form-row">
				<div class="form-group col-md-6">
				   <label for "inputFirstName">Imię / Imiona</label>
				  <input type="text" id="inputFirstName" class="form-control" placeholder="Imię" <?php if(isset($_SESSION['formname'])){echo 'value="'.$_SESSION['formname'].'"'; unset($_SESSION['formname']);}?> name="name" required>
				</div>
				<div class="form-group col-md-6">
				   <label for "inputLaseName">Nazwisko</label>
				  <input type="text" id ="inputLaseName" class="form-control" placeholder="Nazwisko" <?php if(isset($_SESSION['formlastname'])){echo 'value="'.$_SESSION['formlastname'].'"'; unset($_SESSION['formlastname']);}?> name="lastname" required>
				</div>
				
				<div class="form-group col-md-6">
				  <label for="inputEmail4">Email</label>
				  <input type="email" class="form-control" id="inputEmail4" placeholder="Email" <?php if(isset($_SESSION['formemail'])){echo 'value="'.$_SESSION['formemail'].'"'; unset($_SESSION['formemail']);}?> name="email" required>
				</div>
				<div class="form-group col-md-6">
				  <label for="inputPhone">Telefon</label>
				  <input type="phone" class="form-control" id="inputPhone" placeholder="+48 122522522" <?php if(isset($_SESSION['formphone'])){echo 'value="'.$_SESSION['formphone'].'"'; unset($_SESSION['formphone']);}?> name="phone" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" id="gridCheck" name="checkbox" required>
				  <label class="form-check-label" for="gridCheck">
					Akceptuję <a href="regulamin.php">regulamin serwisu</a> oraz <a href="https://dotpay.pl" target="_blank">regulamin operatora usługi</a>
				  </label>
				  <p>Kontakt email z serwisem w sprawie płatności <b>kontakt@pakif.pl</b></p><br><br>
				  <p>Po dokonaniu płatności sprawdź swój adres email</p>
				</div>
			  </div>
			  <button type="submit" class="btn btn-primary">Potwierdź</button>
			</form>

			<br><br><br><br>
		
			
			
		</div>
		
	</main>

	<?php
		include_once('footer.php');
		footer();
	?>