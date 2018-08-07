<?php
include('load.php');

class User extends adminView {
	public function selectAllUser() {
		$con = $this->mysqliConnect();
		$sql = "SELECT * FROM user";
    	$res= $con->query($sql);
      	//$row = $res->fetch_object("ViewProg");
      	while($row = $res->fetch_object("ViewUseri")) {
      		if($row->Visible == true) {
      			$content[] = $row;
      		}   		
      	}
    	$con = $this->closeConnect(); 
    	return $content;
	}
	public function getUserID($id) {
		$con = $this->mysqliConnect();
    	$sql = "SELECT * FROM user WHERE id = $id";
    	$res= $con->query($sql);
		while($row = $res->fetch_object("ViewUseri")) {
      		if($row->Visible == true) {
      			return $row;
      		}   		
      	}
    	$con = $this->closeConnect(); 
	}

	public function deleteUser($user) {
		if(isset($user)) {
		extract($user);
		$con = $this->mysqliConnect();
		if(isset($id)) {
	
		$sql = "UPDATE user SET Visible = 0 WHERE id = '$id'";
		//var_dump($sql);
      	if($res = $con->query($sql)) { 
      		echo "Stergerea userului a fost efectuata.<br />";
      		}  else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->mysqliConnect());
      		} 
      	}
		
      	$con = $this->closeConnect();
		}
	} 
}

class ViewUseri {
	public $ID;
	public $User;
	public $Pass;
	public $Visible;
	public $Email;
}

$user = new User();
if(!empty($_POST)){
	$user->deleteUser($_POST);
}


?>