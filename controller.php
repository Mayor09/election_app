<?php
session_start();
include "models.php";
Class Controller extends models{
	public $bvn;
	public $firstname;
	public $lastname;
	public $party;
	public $securityquestion;
	public $position;
	public $nickname;

	public function validateVoter(){
		if (isset($_POST['submit'])){
			$this->firstname = htmlentities($_POST['firstname']);
			$this->lastname = htmlentities($_POST['lastname']);
			$this->bvn = htmlspecialchars($_POST['bvn']);
			$this->securityquestion = htmlspecialchars($_POST['sq']);
			$error = array();


			if (empty($this->firstname) or empty($this->lastname)){
				$error[0] = "Firstname and Lastname fields cant be empty"; 
			}
			if (empty($this->bvn) and !ctype_digit($this->bvn)){
				$error[1] = "BVN number Field not correct";
			}

			if (empty($this->securityquestion)){
				$error[2] = "Type in your security question";

			}

			if(count($error) != 0){
				echo implode($error);
			}
			else {
				$this->registerVoter($this->bvn,$this->securityquestion,$this->firstname,$this->lastname);
			}

		}
		
	}

	public function validateCandidate(){

		if (isset($_POST['submit'])){
			$this->firstname = htmlentities($_POST['firstname']);
			$this->lastname = htmlentities($_POST['lastname']);
			$this->party = htmlentities($_POST['party']);
			$this->position = htmlentities($_POST['position']);
			$this->nickname = htmlentities($_POST['nickname']);
			$error = array();
		

		if (empty($this->firstname) or is_numeric($this->firstname)){
			$error[0] = "Firstname is required";
		}

		if (empty($this->lastname) or is_numeric($this->lastname)){
			$error[1] = "Firstname is required";
		}

		if (empty($this->party) or is_numeric($this->party)){
			$error[2] = "Party is required";
		}
		if (empty($this->position) or empty($this->nickname)){
			$error[3] = "All fields are required";
		}

		if (count($error) != 0){
			echo implode($error);
		}
		else {
			$this->registerCandidate($this->firstname, $this->lastname, $this->party, $this->position, $this->nickname);
		}
	}
}

	public function validatelogin(){
		if (isset($_POST['submit'])){
		$this->bvn = intval(htmlspecialchars($_POST['bvn']));
		$this->securityquestion = htmlspecialchars($_POST['sq']);
		$error = array();

		if (empty($this->bvn) or empty($this->securityquestion)){
			$error[0] = "All fields required";
		}
		if (count($error) != 0){
			echo implode($error);
		}
		else{
			$this->loginvoter($this->bvn, $this->securityquestion);
			//$this->sessionstart($this->bvn);
			
		}
	}
}

	public function registerVoter($bvn, $securityquestion, $firstname, $lastname){
		$models = new Models;
		$register = $models->VoterRegister($bvn, $securityquestion, $firstname, $lastname);
		
			echo $register;
		
		

	}

	public function registerCandidate($firstname, $lastname, $party, $position, $nickname){
		$models = new Models;
		$register = $models->candidateRegister($firstname, $lastname, $party, $position, $nickname);
		
			echo $register;
		
		

	}

	public function loginvoter($bvn, $securityquestion){
		$models  = new Models;
		$register  = $models->vote($bvn, $securityquestion);

			//var_dump($register);
			if (is_numeric($register)){

				$_SESSION['bvn'] = $register;
				echo "<script>window.location.href='votedashboard.php'</script>";
			}
			
			

			else{
				echo $register;
			}
		
	}

	public function searchCandidate($name){
		$models = new Models;
		$search_details = $models->nameSearch($name);

		if($search_details != false){
                	echo "<table class='result'><tr><th>Fname</th><th>Lname</th><th>Party</th><th>Position</th></tr>";//echo out distinct person;
                	//echo implode($search_details);
                	//echo json_encode($search_details);
                	foreach($search_details as $details){
                   echo "<tr><td>".$details['party']."</td><td>".$details['firstname']."</td><td>".$details['lastname']."</td><td>".$details['position']."</td></tr>";
       		
                	}
                	echo "</table>";
                }


	}

	public function searchVoter($name){
		$models = new Models;
		$search_details = $models->voterSearch($name);

		if ($search_details != false){
			echo "<table class='result'><tr><th>BVN</th><th>Firstname</th><th>Lastname</th><th>Security Question</th></tr>";

		foreach($search_details as $details){
                   echo "<tr><td>".$details['bvn']."</td><td>".$details['firstname']."</td><td>".$details['lastname']."</td><td>".$details['securityquestion']."</td></tr>";
       		
                	}
                	echo "</table>";
                }	
		}

	public function candidatelist(){
		$models = new Models;

		$search_details = $models->Allcandidates();
		//var_dump($search_details);
		if($search_details != false){
                	echo "<table class='result'><tr><th>Fname</th><th>Lname</th><th>Party</th><th>Position</th></tr>";
                	
                	foreach($search_details as $details){
                   echo "<tr><td>".$details['party']."</td><td>".$details['firstname']."</td><td>".$details['lastname']."</td><td>".$details['position']."</td></tr>";
       		
                	}
                	echo "</table>";
                }
	}

	public function voterlist(){
		$models = new Models;

		$search_details = $models->Allvoters();
		//echo implode ($search_details);
		//var_dump($search_details);
		if ($search_details != false){
			echo "<table class='result'><tr><th>BVN</th><th>Firstname</th><th>Lastname</th><th>Security Question</th></tr>";

		foreach($search_details as $details){
                   echo "<tr><td>".$details['bvn']."</td><td>".$details['firstname']."</td><td>".$details['lastname']."</td><td>".$details['securityquestion']."</td></tr>";
       		
                	}
                	echo "</table>";
                }	
		
	}

	public function sessionstart($bvn){

		$models = new Models;


		$details = $models->session($bvn);

		$details[0] = $_SESSION['firstname'];
		//$details[1] = 
		$details[2] = $_SESSION['bvn'];
		//$details[3] = 
	}
public function voting(){
	$models = new Models;

		$search_details = $models->Allcandidates();
		//var_dump($search_details);
		if($search_details != false){
                	//echo "<table class='result'><tr><th>Fname</th><th>Lname</th><th>Party</th><th>Position</th></tr>";
                	
                	foreach($search_details as $details){
                   echo "<tr><td>".$details['party']."</td><td>".$details['firstname']."</td><td>".$details['lastname']."</td><td>".$details['position']."</td><td>". "<input type='radio' required name='governor' value='". $details['party']. "'></td></tr>";
       		
                	}
                	//echo "</table>";
                }	
	}
public function votenow($bvn, $governor){
	$models = new Models;

	$vote = $models->voteindatabase($bvn, $governor);

	echo $vote;
}

public function votecounting($party){
	$models = new Models;

	$vote = $models->votecount($party);



	echo "<tr><td>". $vote . "</td></tr>";
}

public function partyvote(){
	$models = new Models;

	$partyvote = $models->votepartycount();
	//var_dump($partyvote);
	//$array = array($partyvote);
	//echo implode($partyvote);
	if($partyvote != false){
	foreach ($partyvote as $vote) {
		# code...
		echo "<tr><td>". $vote['party'] . "<td><td>". "<input type='submit' name='number' value='". $vote['party'] . "'></td></tr>";

	}
}
}
	
}
?>