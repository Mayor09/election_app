<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="login" style="height:380px;">
<form method="post" target="candidateregister.php">
	<?php include("controller.php"); 
				$control = new Controller;
				$control->validateCandidate();
	?>
	<input type="text" name="firstname" required placeholder="Firstname" class="form-control">
	<input type="text" name="lastname" required placeholder="Lastname" class="form-control">
	
	
	<input required type="party" name="party" placeholder="Political Party" class="form-control">
	<input type="text" required name="nickname" placeholder="nickname" class="form-control">
	<p>Position</p><select name="position">
		<option>Governor</option>
		<option>House of Rep</option>
		<option>Senate</option>
	</select>
	
	<br><input type="submit" name="submit" value="register" class="btn btn-default submit-btn">
</form>
</div>
</body>
</html>