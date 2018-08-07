<?php 
include('load.php');

class deleteDoctor {
	public function delete($doctor) {
		
		if(isset($doctor)) {
		extract($doctor);
		//var_dump($doctor);
		//die();
		$adminView =  new adminView();		

		$con = $adminView->mysqliConnect();
		if(isset($id)) {
	
		$sql = "UPDATE doctor SET Visible = 0 WHERE id = '$id'";
		//var_dump($sql);
      	if($res = $con->query($sql)) { 
      		echo "Stergerea doctorului a fost efectuata.<br />";
      		}  else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($adminView->mysqliConnect());
      		} 
      	}
		
      	$con = $adminView->closeConnect();
		}

	}
}


$deleteDoctor = new deleteDoctor();
$deleteDoctor->delete($_POST);


?>