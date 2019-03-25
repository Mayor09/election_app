<?php

include "connection.php";
class Models extends Connection{
	public $conn;

	public function __construct(){
		$this->conn = (new Connection)->connect();
	}

	public function candidateRegister($firstname, $lastname, $party, $position, $nickname){
		$sql = "INSERT into candidate (firstname, lastname, party, position, nickname) VALUES ('$firstname', '$lastname', '$party', '$position', '$nickname')";

		$result = $this->conn->query($sql) or die("Could not register".$this->conn->error);

		//if ($result == true){

		return "Candidate Registered Successfully";
		//			}
		//else {
		//	return "Could not register User";
		//}
	}



	public function candidateProfile($nickname){
		$sql = "SELECT * from candidate where nickname = '$nickname'";

		$result = $this->conn->query($sql);

		if($result->num_rows == 1){
        		while($row=$result->fetch_assoc()){
        			$firstname = $row['firstname'];
        			$lastname = $row['lastname'];
        			$party = $row['party'];
        			$position = $row['position'];
        		}
        $details_array = array('FirstName' => $firstname, 'LastName'=>$lastname, 'Party'=>$party, 'Position'=>$position);

        return is_array($details_array) ? $details_array : false; 

	}
}
	public function VoterRegister($bvn, $securityquestion, $firstname, $lastname){
        $sql1 = "SELECT * from voters where bvn = '$bvn'";
        $checker = $this->conn->query($sql1) or die("error in database connection".$this->conn->error);
        if ($checker->num_rows == 1){
            return "User Already have an account";
        }
        else {

		$sql = "INSERT into voters(`bvn`, `securitykey`, `firstname`, `lastname`) VALUES ('$bvn', '$securityquestion', '$firstname', '$lastname')";

		$result = $this->conn->query($sql) or die("could not register".$this->conn->error);

		if ($result == true){
			return "Voter registered Successfully";
			//return "<script>window.location.href='login.php'</script>";
		}
		else {
			return "Could not register voter";
		}
    }
	}

	public function vote($bvn, $securityquestion){
		$sql = "SELECT * from voters where bvn = '$bvn' and securitykey = '$securityquestion'";

		$result = $this->conn->query($sql);
		if(!$result){
   			die("Could not reach server".$conn->error);
  		}else{
   	   		if($result->num_rows == 1){
                while ($row = $result->fetch_assoc()){
                    # code...
                    $bvn = $row['bvn'];
                    //$firstname = $row['firstname'];
                }


               // $details = array($bvn, $firstname);

              //return is_array($details) ? $details: false; 
                return intval($bvn);
        	

        
   	   }else{
       		return "Invalid BVN or SecurityQuestion";
   	   }
   }
	}

	public function voterDetails($bvn){
		$sql = "SELECT * from voters where bvn = '$bvn'";

		$result = $this->conn->query($sql);

		if($result->num_rows == 1){
        		while($row=$result->fetch_assoc()){
        			$firstname = $row['firstname'];
        			$lastname = $row['lastname'];
        			$bvn = $row['bvn'];
        			$sq = $row['securityquestion'];
        		}
        $details_array = array('FirstName' => $firstname, 'LastName'=>$lastname, 'BVN'=>$bvn, 'SecurityQuestion'=>$sq);

        return is_array($details_array) ? $details_array : false;

		}
	}

	 public function nameSearch($name){
        	$sql = "SELECT * FROM candidate WHERE `firstname`LIKE '%$name%' OR `lastname` LIKE '%$name%'";
        	$result = $this->conn->query($sql) or die($this->conn->error);
        	if($result->num_rows >= 1){
        		$i = 0;
        		while($row=$result->fetch_assoc()){
        			$party= $row['party'];
        			$firstname = $row['firstname'];
        			$lastname = $row['lastname'];
        			$position = $row['position'];
        			$details_array[$i] = array("position"=>$position,"firstname"=>$firstname,"lastname"=>$lastname, "party"=>$party);
        			$i++; 
        		}

        		return is_array($details_array) ? $details_array : false;

        		
        	}
        }
		public function voterSearch($name){
        	$sql = "SELECT * FROM voters WHERE `firstname`LIKE '%$name%' OR `lastname` LIKE '%$name%'";
        	$result = $this->conn->query($sql) or die($this->conn->error);
        	if($result->num_rows >= 1){
        		$i = 0;
        		while($row=$result->fetch_assoc()){
        			$bvn= $row['bvn'];
        			$firstname = $row['firstname'];
        			$lastname = $row['lastname'];
        			$sq = $row['securitykey'];
        			$details_array[$i] = array("bvn"=>$bvn,"firstname"=>$firstname,"lastname"=>$lastname, "securityquestion"=>$sq);
        			$i++; 
        		}

        		return is_array($details_array) ? $details_array : false;

        		
        	}
        }

     public function Allcandidates(){
     	$sql = "SELECT * from candidate";
     	$result = $this->conn->query($sql) or die ($this->conn->error);
     	if ($result->num_rows >= 1){
     		$i = 0;
     		while($row=$result->fetch_assoc()){
        			$party= $row['party'];
        			$firstname = $row['firstname'];
        			$lastname = $row['lastname'];
        			$position = $row['position'];
        			$details_array[$i] = array("position"=>$position,"firstname"=>$firstname,"lastname"=>$lastname, "party"=>$party);
     	              $i++;
     	}
     	return is_array($details_array) ? $details_array : false;

     }
     }

     public function Allvoters(){
     	$sql = "SELECT * from voters";
     	$result = $this->conn->query($sql) or die ($this->conn->error);
     	if ($result->num_rows >= 1){
     		$i = 0;
     		while($row=$result->fetch_assoc()){
     			
        			$bvn= $row['bvn'];
        			$firstname = $row['firstname'];
        			$lastname = $row['lastname'];
        			$sq = $row['securitykey'];
        			$details_array[$i] = array("bvn"=>$bvn,"firstname"=>$firstname,"lastname"=>$lastname, "securityquestion"=>$sq);
        			$i++;
     	}
     	return is_array($details_array) ? $details_array : false;

     }
     }

     public function session($bvn){
        $sql = "SELECT * from voters where bvn = '$bvn'";

        $result = $this->conn->query($sql) or die ("User information not found".$this->conn->error);
        if ($result->num_rows == 1){
            while ($row = $result->fetch_assoc()){
                    $bvn= $row['bvn'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $sq = $row['securitykey'];
            }
            $details_array = array($firstname,$lastname,$bvn,$sq);
        //$firstname = $_SESSION['firstname'];
        //$bvn = $_SESSION['bvn'];
            return is_array($details_array) ? $details_array : false;
        }
     }

     public function voteindatabase($bvn, $party){
        $sql = "SELECT * from voting where bvn = '$bvn'";
        $result = $this->conn->query($sql) or die($this->conn->error);
        if ($result->num_rows == 1){
            return "User has already voted";
        }
        else {
        $sql1 = "INSERT into voting(bvn, governor) VALUES ('$bvn','$party')";
        $result1 = $this->conn->query($sql1);
        if($result1 == true){
            return "Voting was Successfull";
        }
        else{
            return "Please try again later";
        }
        


        }
     }

     public function votecount($party){
        $sql = "SELECT governor from voting where governor = '$party'";
        $result = $this->conn->query($sql) or die($this->conn->error);
        if($result == true){
           return $result->num_rows;
            }
            else{
                return "No Result Found Yet";
            }
        }

    public function votepartycount(){
        $sql = "SELECT * from candidate";
        $result = $this->conn->query($sql);
        if ($result->num_rows >= 1){
            $i = 0;
            while ($row = $result->fetch_assoc()){
                $party = $row['party'];
                $array[$i] = array('party'=>$party);
                $i++;
            }

            return is_array($array) ? $array : false;

                
        }
    }



}

?>