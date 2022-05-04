<!DOCTYPE html>
<html style="widht: 100%; height: 100%; overflow: hidden;">
	<head>
		<title></title>
		<meta charset="utf-8">
		<style type="text/css">
			.a1{
				height: 500px;
				display: inline-flex;
				background-color: darkgray;
				color: white;
				cursor: pointer;
			}
			.a1:hover{
				filter: brightness(50%);
			}
			.galleryimg{
				height: 500px; 
				max-width: 600px;
			}
			.galleryimg:hover{
				cursor: zoom-in;
			}
		</style>
	</head>
	<body style="margin: 0 auto; padding: 0px; background-color: #CCC;">
<?php
	session_start();
	if($_SESSION['info_ogl'] == 'motoryzacja'){
		if($_SESSION['info_ogl2'] == 'motocykle i skutery' || $_SESSION['info_ogl2'] == 'felgi i opony' || $_SESSION['info_ogl2'] == 'sprzet audio'
			|| $_SESSION['info_ogl2'] == 'pozostale'){
			$num = 3;
		}else{
			$num = 8;
		}
	}
	if($_SESSION['info_ogl'] == 'elektronika'){
		$num = 3;
	}
	if($_SESSION['info_ogl'] == 'nieruchomosci'){
		$num = 8;
	}
	if($_SESSION['info_ogl'] == 'dom i ogrod'){
		$num = 3;
	}
	if($_SESSION['info_ogl'] == 'praca'){
		$num = 1;
	}
	if($_SESSION['info_ogl'] == 'odziez'){
		$num = 3;
	}
	if($_SESSION['info_ogl'] == 'zwierzeta'){
		$num = 3;
	}
	if($_SESSION['info_ogl'] == 'oddam za darmo'){
		$num = 1;
	}
	if($_SESSION['info_ogl'] == 'pozostale'){
		$num = 3;
	}
	

	$stop = false;
	$number = 1;
	for($p = 1; $p<=$num; $p++){
		if(isset($_SESSION['Photo'.$p])){
			$file = '../galeria/aktywne/'.$_SESSION['Photo'.$p];
			if(@file_exists($file)){
				$exists = true;
				if($stop == false){
					echo '<div id="Photo'.$number.'"><div class="a1" onclick="ocgp('.$number.')"><img style="width: 50px;" src="../img/prev.png"/></div><a target="_blank" href="../galeria/aktywne/'.$_SESSION['Photo'.$p].'"><img class="galleryimg" src ="../galeria/aktywne/'.$_SESSION['Photo'.$p].'"/></a><div class="a1" onclick="ocgn('.$number.')"><img style="width: 50px;" src="../img/next.png"/></div></div>';
					$number = $number + 1; 
					$stop = true;
				}else{
					echo '<div style="display: none;" id="Photo'.$number.'"><div class="a1" onclick="ocgp('.$number.')"><img style="width: 50px;" src="../img/prev.png"/></div><a target="_blank" href="../galeria/aktywne/'.$_SESSION['Photo'.$p].'"><img class="galleryimg" src ="../galeria/aktywne/'.$_SESSION['Photo'.$p].'"/></a><div class="a1" onclick="ocgn('.$number.')"><img style="width: 50px;" src="../img/next.png"/></div></div>';
					$number = $number + 1; 
					$stop = true;
				}
			}
		}
	}
	if(@$exists != true){
		echo '<center><div style="background: #CCC;"><img src="../img/camera.png"/></div></center>';
	}
	
	//echo '<div style="display: inline-block;" onclick="ocgp('.$number.');"><div class="a1"><</div></div>';
	//echo '<div style="display: inline-block;" onclick="ocgn('.$number.');"><div class="a1">></div></div>';
	?>
	<script type="text/javascript">
		function ocgn(num){
			var x = 'Photo' + num;
			var n = num + 1;
			var y = 'Photo' + n;
			if(document.getElementById(y)){
				document.getElementById(x).style="display: none;";
				document.getElementById(y).style="display: block;";
			}
		}
	</script>
	<script type = "text/javascript">
		function ocgp(num) {
			var x = 'Photo' + num;
			var n = num - 1;
			var y = 'Photo' + n;
			if(document.getElementById(y)){
				document.getElementById(x).style="display: none;";
				document.getElementById(y).style="display: block;";
			}
		}
	</script>
	</body>
</html>