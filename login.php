<!DOCTYPE html>
<?php
include "controller.php";
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="login">
<form method="post" target="login.php">
	<?php
	
	$control = new Controller;
	$control->validatelogin();
	?>
	<input type="text" name="bvn" required placeholder="BVN" class="form-control"><br>
	<input type="text" name="sq" required placeholder="Security Question" class="form-control"><br>
		
	<input type="submit" name="submit" value="Submit" class="btn btn-default submit-btn">
</form>
</div>
</body>
</html>