<?php
	include_once('head.php');
	head();
	
	if(isset($_SESSION['uzytkownik'])){
		header('Location: Konto.php');
	}
?>
		<title>Pakif - zaloguj się na konto</title>
		<meta name="keywords" content="Pakif, zaloguj się, logowanie na strone, kursy online"/>
		<meta name="description" content="Zaloguj się aby swobodnie korzystać z kursów na Pakif"/>
	</head>

	
    <?php
		include_once('header.php');
		headerwrapper();
	?>
	
	
	<?php
	
		require_once  "php/connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		if(isset($_POST['login'])){
		
			try{
				$db_name = $administratorbazy.$db_name;
				$connect = new mysqli($host, $db_user, $db_password, $db_name);
				if($connect->connect_errno!=0){
					throw new Exception(mysqli_connect_errno());
				}
				else{
					if(isset($_POST['login'])){
						$login = $_POST['login'];
						$password = $_POST['password'];
						$login = htmlentities($login, ENT_QUOTES, "UTF-8");
					}
					
					if (!$connect->set_charset("utf8")) {
						printf('<span style="color: red">Przepraszamy za utrudnienia, proszę spróbować później</br>Developerska informacja: Błąd UTF8</span> %s\n', $connect->error);
						exit();
					} else {
						if ($result = @$connect->query(
							sprintf("SELECT * FROM konta WHERE login='%s'",
							mysqli_real_escape_string($connect,$login),
							mysqli_real_escape_string($connect,$password)))){
								$users = $result->num_rows;
								if($users>0){
									$w = $result->fetch_assoc();
									if(password_verify($password, $w['password'])){
										$_SESSION['uzytkownik'] = $w['user'];
										$_SESSION['uzytkowniklogin'] = $w['login'];
										$_SESSION['uzytkownikemail'] = $w['email'];
										$result->free_result();
										echo "<script>window.location.href = 'Konto.php';</script>";
									}else{
										$_SESSION['e_bad'] = "Podano błędny login i/lub hasło. </br>Spróbuj jeszcze raz.";
									}	
								}else{
									$_SESSION['e_bad'] = "Podano błędny login i/lub hasło. </br>Spróbuj jeszcze raz.";
								}	
						}else{
							throw new Exception($connect->error);
						}
						$connect->close();
					}
				}
			}
			catch(Exception $error){
				echo '<div><span style="color: red;">Przepraszamy wystąpił błąd, prosimy spróbować później.</span></div>';
				//echo '</br>Informacja developerska:</br>'.$error;
			}
			
		}
		
	?>
	
	<main role="main" class="flex-shrink-0" style="margin-top: -230px; padding-bottom: 150px;">
		<div class="container">
			<h4>Zaloguj się</h4>
			<p>Jeśli posiadasz już konto, wypełnij formularz aby się zalogować</p>
			<br><br>
			<?php
				if(isset($_SESSION['e_bad'])){
					echo $_SESSION['e_bad'];
					unset($_SESSION['e_bad']);
				}
			?>
			<br>
			<form style="padding-top: 10px;" method="POST">
			  <div class="form-group">
				<label for="exampleInputEmail1">Login</label>
				<input name="login" type="text" class="form-control" style="max-width: 350px;" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Login" required>
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Hasło</label>
				<input name="password" type="password" class="form-control" style="max-width: 350px;" id="exampleInputPassword1" placeholder="Hasło" required>
			  </div>
			  <button type="submit" class="btn btn-primary" style="max-width: 350px; width: 100%;">Zaloguj</button>
			</form>
			
			<br>
			<br>
			<p>Jeśli nie posiadasz jeszcze konta, zapisz się na kurs</p>
		</div>
		
	</main>

	<?php
		include_once('footer.php');
		footer();
	?>