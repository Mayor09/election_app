<?php
Class Connection{
	public function connect(){

		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "election_app";

		$conn = new mysqli($servername, $username, $password, $db);
		if (!$conn){
			die("unable to connect to db");
		}
		return $conn;

	}
}
?>