<?php
//session_start();
include "controller.php";
$bvn = $_SESSION['bvn'];

if (!isset($_SESSION['bvn'])){
	echo "<script>window.location.href='login.php'</script>";
}
?>
<!DOCTYPE html>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
<form action="votedashboard.php" method="POST">
			<table class="center">
                  <tr>
					<td><input type="text" name="search" placeholder="Search for Candidate Name"></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="search"></td>
				</tr>
			</table>

			<br>
			<?php
//include "controller.php";
if(isset($_POST['submit'])){
	$search = htmlspecialchars($_POST['search']);
	$control = new Controller;
	$control->searchCandidate($search);
}
?>
</form>
<?php
//include "controller.php";
if(isset($_POST['vote'])){
	$party = htmlspecialchars($_POST['governor']);
	$control = new Controller;
	$control->votenow($bvn, $party);
}
?>
	<form method="post" action="votedashboard.php">
		<table border="1" cellpadding="7">
			<tr>
				<th colspan="5">GOVERNOR</th>
			</tr>
			<?php
			$control = new Controller;
			$control->voting();
			?>
			

		</table>
		<input type="submit" name="vote" value="vote">
	</form>

</div>
</body>
</html>