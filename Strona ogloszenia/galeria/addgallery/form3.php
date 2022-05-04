<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel ="stylesheet" href="../style.css" type="text/css"/>
	</head>
	<body style="background-color: white; overflow: hidden;">
		<form enctype="multipart/form-data" action="photos.php" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
			<label><div class="forminp"><div class="file1">+</div><input onChange="document.getElementById('submit').click()" class="file2" type="file" name="Photo3" accept="image/png, image/jpeg, image/jpg"></div></label>
			<input type="submit" id="submit" style="display: none;" name="submit">
		</form>
	</body>
</html>

