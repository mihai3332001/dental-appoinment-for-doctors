<?php 
include('load.php');

class updateProgramari extends adminView{

	public function checkIDbyProgramari($id) {
		$con = $this->mysqliConnect();
    	$sql = "SELECT id FROM pacient WHERE id = $id";
    	$res= $con->query($sql);
      	$row = mysqli_num_rows($res);   	
    	$con = $this->closeConnect(); 
    	return $row;
	}

	public function Update($variables) {
		extract($variables);
		$valid = new validation();
		$validation = $valid->valid($variables);
		if(isset($id)) {
			if($validation == null) {
			$count = $this->checkIDbyProgramari($id);
				if($count == 1) {
			echo $this->updatePro($variables);
				}
			}else {
				echo $validation;
			}
      	}
      	else {
      		
      			//var_dump($variables);
      		if($validation == null) {
      		echo $this->create($variables);
 			echo $this->prepareSendProgEmailDoctors($variables);
      		} else {
      			echo $validation;
      		}

      	}		
	}

	public function prepareSendProgEmailDoctors($variables) {
		extract($variables);
		$to = '';
		$adminView = new adminView();
		$all = $adminView->selectAllDoctor();
		foreach($all as $key=>$value) {		
			if($value->ID != $doctorID){
				$to .= $value->Email . ', '; 
			} else if ($value->ID == $doctorID){
				$doctor = $value->Doctor;
			}
		}
		$to = rtrim($to, ', ');
		$this->sendProgEmailsToDoctors($to, $nume, $data, $ora, $doctor);
	}

	private function sendProgEmailsToDoctors($emailDoctors, $nume, $data, $ora, $doctor) {
		//var_dump($emailDoctors, $nume, $data, $ora, $doctor);
		//die();
		$to = $emailDoctors;

		$subject = "Programare Dentalteo.ro " . $data . " : " . $ora . " Doctor -" . $doctor;

		$message = '<html><head><title>Programare pacient</title></head>';

		$message .= '<body>';

		$message .= '<table>';

		$message .= '<tr><th>Nume</th><th>Data</th><th>Ora</th><th>Doctor</th></tr>';

		$message .= '<tr><td>' . $nume . '</td><td>' . $data .'</td>';

		$message .= '<td>' . $ora . '</td><td>' . $doctor . '</td>';

		$message .= '</tr>';

		$message .= '</table>';

		$message .= '</body></html>';  

		$headers  = 'MIME-Version: 1.0' . "\r\n";

		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($to, $subject, $message, $headers);
	}

	public function updatePro ($variables) {
		extract($variables);
		$con = $this->mysqliConnect();
		array_pop($variables);
		if(isset($variables['achitatTehnic'])) {
			$variables['achitatTehnic'] = 1;
		}  else {
			$variables['achitatTehnic'] = 0;
		}
		if(isset($variables['achitatCabinet'])) {
			$variables['achitatCabinet'] = 1;
		}  else {
			$variables['achitatCabinet'] = 0;
		}
		$sql = "UPDATE pacient SET ";
		foreach ($variables as $key => $value) {
			switch ($key) {
				case 'achitatCabinet' :
					$sql .= "$key = $value, ";	
					break;

				case 'achitatTehnic' :
					$sql .= "$key = $value, ";	
					break;

				default:
				$sql .= "$key = '$value',  ";
				break;	
					
			}

		
		}
		$sql = substr_replace($sql, "", -2);
		$sql .= " WHERE ID = '$id'";	  
			   
 		//$sql = "UPDATE pacient SET nume = '$nume', telefon = '$telefon', data = '$data', ora = '$ora',  observatii = '$observatii', manopera = '$manopera', achitatTehnic = 1, achitatCabinet = 1 WHERE ID = '$int'";
 		 //var_dump($sql);
 	
		
      	if($res = $con->query($sql)) {
      		return "Modificarile au fost facute.<br />";
      		}  else {
			return "ERROR: Could not able to execute $sql. " . mysqli_error($adminView->mysqliConnect());
      	} 
      		$con = $this->closeConnect();
	} 

	public function create($variables) {
		$con = $this->mysqliConnect();
		extract($variables);
		    $achitatTehnic = isset($achitatTehnic) ?  1 :  0;
			$achitatCabinet = isset($achitatCabinet) ?  1 :  0;
      		$sql = "INSERT INTO pacient (nume, telefon, data, ora, doctorID, observatii, manopera, achitatTehnic, achitatCabinet, visible) VALUES ('$nume', '$telefon', '$data', '$ora', '$doctorID', '$observatii', '$manopera', $achitatTehnic, $achitatCabinet, 1)";
      		//var_dump($sql);
      		//die();
 		
      	if($res = $con->query($sql)) {
      		return "Pacient adaugat.<br />";
      		}  else {
			return "ERROR: Could not able to execute $sql. " . mysqli_error($adminView->mysqliConnect());
      	}
      	$con = $this->closeConnect();

	}

	

}

$updateProgramari = new updateProgramari();
//if(isset($_POST['id'])){
	$updateProgramari->Update($_POST);
//}

?>