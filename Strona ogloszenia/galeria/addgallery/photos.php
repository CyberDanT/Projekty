<!DOCTYPE html>
<html style="widht: 100%; height: 100%; overflow: hidden;">
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel ="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body style="margin: 0px; padding: 0px;">
	<?php
	session_start();
	if(isset($_POST['submit'])){
		if($_POST['submit'] != 'delete'){
			if(@$_SESSION['addogl_category2'] != 'Motocykle i skutery'){
				$loop = 8;
			}else{
				$loop = 3;
			}
			for($i=1; $i<=$loop; $i++){
				if(@$_FILES['Photo'.$i]['error'] != 0 ){//jeśli napotkano błąd
					echo '<span class="erroraddogl">Wystąpił błąd:</span></br>';
					switch ($_FILES['Photo'.$i]['error']){
						case 1: {$location = "form".$i.".php"; echo '<span class="erroraddogl">Rozmiar pliku jest za duży! (Maks. 5MB)</span>'; echo '</br><a href="'.$location.'">Powrót</a>'; break;} 
						case 2: {$location = "form".$i.".php"; echo '<span class="erroraddogl">Rozmiar pliku jest za duży! (Maks: 5MB)</span>'; echo '</br><a href="'.$location.'">Powrót</a>'; break;}
						case 3: {$location = "form".$i.".php"; echo '<span class="erroraddogl">Plik nie został wysłany w całości!</span>'; echo '</br><a href="'.$location.'">Powrót</a>'; break;}
						case 4: {$location = "form".$i.".php"; echo '<span class="erroraddogl">Nie wysłano żadnego pliku.</span>'; echo '</br><a href="'.$location.'">Powrót</a>'; break;}
						default: {$location = "form".$i.".php"; echo '<span class="erroraddogl">Wystąpił błąd podczas wysyłania.</span>'; echo '</br><a href="'.$location.'">Powrót</a>'; break;}
					}
				}else{
					//if(isset($_SESSION['Photo'.$i])){
					//	$unlink = '../galeria/tymczasowe/'.$_SESSION['Photo'.$i];
					//	echo $_SESSION['Photo'.$i];
					//	if(file_exists($unlink)){
					//		unlink($unlink);
					//	}
				//		unset($_SESSION['Photo'.$i]);
					//}
					//echo "SESJA pliku ".$i." NIE USTALONA Uploadowany plik: ".$_FILES['Photo'.$i]['tmp_name']."</br>";
					//Sprawdzenie pliku
					if(@!file_exists($_FILES['Photo'.$i]['tmp_name']) || !is_uploaded_file($_FILES['Photo'.$i]['tmp_name'])){
						//echo $i." nie ma pliku</br>";
						// podaj plik 1,2,3,4...
					}else{
						$name = strrpos($_FILES['Photo'.$i]['name'], "=");
						if($name !== false) {
							echo '<span class="erroraddogl">Nazwa pliku zawiera niedozwolone znaki</span>';
							$location = "form".$i.".php";
							echo '</br><a href="'.$location.'">Powrót</a>';
						}else{
							$name = strrpos($_FILES['Photo'.$i]['name'], "?");
							if($name !== false) {
								echo '<span class="erroraddogl">Nazwa pliku zawiera niedozwolone znaki</span>';
								$location = "form".$i.".php";
								echo '</br><a href="'.$location.'">Powrót</a>';
							}else{
								$name = strrpos($_FILES['Photo'.$i]['name'], "<");
								if($name !== false) {
									echo '<span class="erroraddogl">Nazwa pliku zawiera niedozwolone znaki</span>';
									$location = "form".$i.".php";
									echo '</br><a href="'.$location.'">Powrót</a>';
								}else{
									$name = strrpos($_FILES['Photo'.$i]['name'], ">");
									if($name !== false) {
										echo '<span class="erroraddogl">Nazwa pliku zawiera niedozwolone znaki</span>';
										$location = "form".$i.".php";
										echo '</br><a href="'.$location.'">Powrót</a>';
									}else{
										$name = strrpos($_FILES['Photo'.$i]['name'], "/");
										if($name !== false) {
											echo '<span class="erroraddogl">Nazwa pliku zawiera niedozwolone znaki</span>';
											$location = "form".$i.".php";
											echo '</br><a href="'.$location.'">Powrót</a>';
										}else{
											$type = $_FILES['Photo'.$i]['type'];
											if(!(($type == 'image/jpeg') || ($type == 'image/jpg') || ($type == 'image/png'))){
												echo '<span class="erroraddogl">Niepoprawny format pliku. Pliki poprawne: .jpeg, .jpg, .png</span>';
												$location = "form".$i.".php";
												echo '</br><a href="'.$location.'">Powrót</a>';
											}else{
												if($_FILES['Photo'.$i]['size'] > 5242880){
													echo '<span class="erroraddogl">Rozmiar pliku jest za duży! (Maks. 5MB)</span>'; 
													$location = "form".$i.".php";
													echo '</br><a href="'.$location.'">Powrót</a>';
												}else{
													$plik = $_FILES['Photo'.$i]['name'];
													$odczyt = pathinfo($plik);
													if(!($odczyt['extension'] == "jpg" || $odczyt['extension'] == "png" || $odczyt['extension'] == "jpeg")){
														echo '<span class="erroraddogl">Niepoprawny format pliku. Pliki poprawne: .jpeg, .jpg, .png</span>';
														$location = "form".$i.".php";
														echo '</br><a href="'.$location.'">Powrót</a>';
													}else{
														$uname = md5(uniqid(time(), true));
														$unsetname = $uname.$_FILES['Photo'.$i]['name'];
														$_SESSION['Photo'.$i] = $unsetname;
														echo '<form method="post"><input type="hidden" name="delit" value='.$unsetname.'><label><input type="submit" style="display: none;" name="delete"><div class="delete"><img src="../img/trash.png" class="img"/></form></div></label><div style="width: 150px; height: 150px; line-height: 150px;"><a href="../galeria/tymczasowe/'.$unsetname.'" target="_blank"><img style="width: 150px; vertical-align: middle;" src="../galeria/tymczasowe/'.$unsetname.'"/></a></div>';
														move_uploaded_file($_FILES['Photo'.$i]['tmp_name'], '../galeria/tymczasowe/'.$unsetname);
														$dane=strip_tags(file_get_contents('../galeria/tymczasowe/'.$unsetname));
														$file=fopen('../galeria/tymczasowe/'.$unsetname,'r');
														fwrite($file, $dane);
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
?>
<?php 
	@session_start();
	if(isset($_POST['delete'])){
		for($i=1; $i<=8; $i++){
			$file = '../galeria/tymczasowe/'.$_POST['delit'];
			if($file === '../galeria/tymczasowe/'.$_SESSION['Photo'.$i]){
				if($_POST['delit'] === $_SESSION['Photo'.$i]){
					if(@file_exists($file)){
						unlink($file);
						unset($_SESSION['Photo'.$i]);
						$location = "form".$i.".php";
						header("Location:".$location);
						exit();
					}else{
						echo '<span class="erroraddogl">Wystąpił BŁĄD!</span></br></br>';
						echo '<a href="form1.php">Powrót</a>';
					}
				}
			}else{
				echo '<span class="erroraddogl">Wystąpił BŁĄD!</span></br></br>';
				echo '<a href="form1.php">Powrót</a>';
			}
		}
	}
?>
	</body>
</html>