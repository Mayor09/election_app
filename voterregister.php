<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="login" style="height:300px;">
<form method="post" target="voterregister.php">
	<?php include("controller.php"); 
				$control = new Controller;
				$control->validateVoter();
	?>
	<input type="text" name="firstname" required placeholder="Firstname" class="form-control">
	<input type="text" name="lastname" required placeholder="Lastname" class="form-control">
	
	
	<input required type="number" name="bvn" placeholder="BVN" class="form-control">
	<input type="text" required name="sq" placeholder="Security Question" class="form-control"><br>
	
	<input type="submit" name="submit" value="register" class="btn btn-default submit-btn">
</form>
</div>
</body>
</html>