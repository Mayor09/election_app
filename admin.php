<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="admin.php" method="POST">
			<table class="login_table">
                  <tr>
					<td><input type="text" name="search" placeholder="Search for Candidate Name"></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit1" value="search"></td>
				</tr>
			</table>

			<br>
			<?php
include "controller.php";
if(isset($_POST['submit1'])){
	$search = htmlspecialchars($_POST['search']);
	$control = new Controller;
	$control->searchCandidate($search);
}
?>
<form action="admin.php" method="POST">
			<table class="login_table">
                  <tr>
					<td><input type="text" name="search" placeholder="Search for Voter"></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit2" value="search"></td>
				</tr>
			</table>

			<br>
			<?php
//include "controller.php";
if(isset($_POST['submit2'])){
	$search = htmlspecialchars($_POST['search']);
	$control = new Controller;
	$control->searchVoter($search);
}
?>


	<h1>List of Candidate</h1>
	


		<?php
		$control = new Controller;
		$control->candidatelist();
		?>
	

	<h1>List of Registered Voters</h1>
	 <?php
	 $control = new Controller;
	 $control->voterlist();
	 ?>
<div>
	<table>
		<form method="post" action="admin.php">
		<tr>
			<th>Party</th>
			
			<th>No of votes</th>
		</tr>
		<?php
		$control = new Controller;
		$control->partyvote();
		if (isset($_POST['number'])){
			$value = $_POST['number'];
			$control->votecounting($value);
		}
		?>
		</form>
	</table>
</div>
</body>
</html>