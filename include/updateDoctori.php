<?php 
include('load.php');

class updateDoctori extends adminView{
	public function selectDoctorByIDCount($id) {
		$con = $this->mysqliConnect();
    	$sql = "SELECT id FROM doctor WHERE id = $id";
    	$res= $con->query($sql);
      	$row = mysqli_num_rows($res);   	
    	$con = $this->closeConnect(); 
    	return $row;
	}
	public function update($variables) {
		extract($variables);
		$valid = new validation();
		$validation = $valid->valid($variables);
		$check = $this->checkDoctorEmailUser($email, $doctor);
		if(isset($id)) {
			if($validation == null) {
			$count = $this->selectDoctorByIDCount($id);
				if($count == 1) {
			echo $this->saveDoctor($id, $doctor, $email);
				} else {
				echo "Eroare. Doctorul sau adresa de email exista deja";
				}
			} else {
				echo $validation;
			}
		}	
		else {
			if($validation == null){
				if($check == true) {
				echo $this->insertDoctor($doctor, $email);
				}
			else {
				echo "Eroare. Doctorul sau adresa de email exista deja.";
				}
			} else {
				echo $validation;
			}
			

		}
	}
	private function saveDoctor($id, $doctor, $email) {	
	$checkDoctorUpdate = $this->checkupdateDoctorEmailUser($id, $doctor, $email);
		if($checkDoctorUpdate == null) {
			$con = $this->mysqliConnect();
    	$sql = "UPDATE doctor SET doctor = '$doctor', email = '$email' WHERE id = $id";
    	$res= $con->query($sql);
      		if($res = $con->query($sql)) {
      		return "Modificarile au fost facute.<br />";
      		}  else {
			return "ERROR: Could not able to execute $sql. " . mysqli_error($this->mysqliConnect());
      		}   	
    	$con = $this->closeConnect(); 
		}else {
			return $checkDoctorUpdate;
		}
		
	}
	private function insertDoctor($doctor, $email) {		
		$con = $this->mysqliConnect();
    	$sql = "INSERT INTO doctor (doctor, email, visible) VALUES ('$doctor', '$email', 1)";	
      	if($res = $con->query($sql)) {
      		echo "Doctor adaugat.<br />";
      		}  else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->mysqliConnect());
      	} 
    	$con = $this->closeConnect(); 
	}

	private function checkDoctorEmailUser($email, $doctor) {
		$con = $this->mysqliConnect();	
		$sql = "SELECT email, doctor FROM doctor WHERE email = '$email' OR doctor = '$doctor'";
		$res = $con->query($sql);
		$row = $res->fetch_object(); 
		$check = $res->num_rows;
		if($check == 0) {
			return true;
		} else {
			return false;
		}
		$con = $this->closeConnect(); 
		//var_dump($content);
	}

	private function checkupdateDoctorEmailUser($id, $doctor, $email) {
		$con = $this->mysqliConnect();	
		$sql = "SELECT email, doctor FROM doctor WHERE id != '$id'";
		$res = $con->query($sql);
		while($row = $res->fetch_object()) {
			if($row->email == $email) {
				return 'Eroare. Adresa de email exista deja.';
			} 
			else if($row->doctor == $doctor) {
				return 'Eroare. Userul exista deja.';
			} 
		}
		//$check = $res->num_rows;
	}
}

$updateDoctori = new updateDoctori();
$updateDoctori->update($_POST);
?>