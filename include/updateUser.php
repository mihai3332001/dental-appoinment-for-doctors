<?php

include("../include/load.php");



class updateUser extends adminView {

		public function selectUserByIDCount($id) {

		$con = $this->mysqliConnect();

    	$sql = "SELECT id FROM user WHERE id = $id";

    	$res= $con->query($sql);

      	$row = mysqli_num_rows($res);   	

    	$con = $this->closeConnect(); 

    	return $row;

	}

	public function action($var) {

		extract($var);

		$valid = new validation();

		$validation = $valid->valid($var);

		$check = $this->checkEmailUser($email, $user);

		$initialPassword = $this->hashPassword($password);

		$passVerified = password_verify($password2 , $initialPassword);

		if($passVerified == true){

			$pass = $initialPassword;

		}



		if(isset($id)) {

			$count = $this->selectUserByIDCount($id);

			if($count == 1) {

			echo $this->update($user, $pass, $email, $id);

			} 

		}	

		else {
			if($validation == null) {
			$token = bin2hex(openssl_random_pseudo_bytes(16));

			if($check == true) {
			echo $this->insert($user, $pass, $email, $token);

			$this->sendEmail($user, $email, $token);
				} else {
				echo "Eroare. Username sau emailul exista deja.";
				}
			} else  {
				echo $validation;
			}

		}

	}



	private function update($user, $password, $email, $id) {	
		$checkUpdate = $this->checkupdateEmailUser($id, $user, $email);

		if($checkUpdate == null) {
		$con = $this->mysqliConnect();

    	$sql = "UPDATE user SET user = '$user', pass = '$password', email = '$email' WHERE id = $id";

    	$res= $con->query($sql);

      	if($res = $con->query($sql)) {

      		return "Modificarile au fost facute.<br />";

      		}  else {

			return "ERROR: Could not able to execute $sql. " . mysqli_error($this->mysqliConnect());

      	}   	

    	$con = $this->closeConnect(); 
		} else {
			return $checkUpdate;
		}
		

	}

	private function checkupdateEmailUser($id, $user, $email) {
		$con = $this->mysqliConnect();	
		$sql = "SELECT email, user FROM user WHERE id != '$id'";
		$res = $con->query($sql);
		while($row = $res->fetch_object()) {
			if($row->email == $email) {
				return 'Eroare. Adresa de email exista deja.';
			} 
			else if($row->user == $user) {
				return 'Eroare. Userul exista deja.';
			} 
		}
		//$check = $res->num_rows;
	}

	private function insert($user, $password, $email, $token) {		

		$con = $this->mysqliConnect();	

    	$sql = "INSERT INTO user (user, pass, email, visible, token) VALUES ('$user', '$password', '$email', 0, '$token')";	

      	if($res = $con->query($sql)) {

      		echo "User adaugat.<br />Urmeaza instructiunile din email pentru validare.";

      		}  else {

			echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->mysqliConnect());

      	} 

    	$con = $this->closeConnect(); 

	}

	private function checkEmailUser($email, $user) {
		$con = $this->mysqliConnect();	
		$sql = "SELECT email, user FROM user WHERE email = '$email' OR user = '$user'";
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



	public function sendEmail($user, $email, $token) {

		$url = "http://prog.dentalteo.ro/activare.php?token=$token&user=$user";
		$to = $email;

		$subject = "Confirmare inregistrare user Programari DentalTeo.ro";

		$message = '<html><head><title>Confirmare inregistrare user Programari DentalTeo.ro</title></head>';

		$message .= '<body>';

		$message .= '<table>';

		$message .= '<tr><th>User</th><th>Parola</th></tr>';

		$message .= '<tr><td>' . $user . '</td><td>Parola aleasa de tine</td></tr>';

		$message .= '</table>';

		$message .= '<p>Pentru confirmare apasa pe linkul urmator:</p>';

		$message .= '<a href=" ' . $url . '">' . $url . '</a>';

		$message .= '</body></html>';  

		$headers  = 'MIME-Version: 1.0' . "\r\n";

		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($to, $subject, $message, $headers);

	}



	public function verifyUserByToken($user, $token) {

		$con = $this->mysqliConnect();

		

    	$sql = "SELECT id FROM user WHERE token = '$token' AND user = '$user'";

    	$res= $con->query($sql);

    	//var_dump($res);

   		$row = mysqli_num_rows($res);  

    	if($row == 1) {

    		$sql = "UPDATE user SET visible = 1 WHERE user = '$user'";

    		if($res = $con->query($sql)) {

      		$confirm =  'Confirmarea fost facuta.<br />';
		
		$confirm .= '<a href="admin/login.php">Click aici</a> pentru logare.';
			
		return $confirm;

      		}  else {

			return "ERROR: Could not able to execute $sql. " . mysqli_error($this->mysqliConnect());

      	}   	

    

    	}

    		$con = $this->closeConnect(); 

	}



}




$updateUser = new updateUser();

if(!empty($_POST)) {

	$updateUser->action($_POST);	

}



?>