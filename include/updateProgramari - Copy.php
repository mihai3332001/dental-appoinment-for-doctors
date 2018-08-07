<?php 
include('load.php');

class updateProgramari {
	public function Update($variables) {
		
		if(isset($variables)) {
		extract($variables);
		$adminView =  new adminView();		

		$con = $adminView->mysqliConnect();
		if(isset($id)) {
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
      		echo "Modificarile au fost facute.<br />";
      		}  else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($adminView->mysqliConnect());
      	} 
      	}
      	else {
      		$achitatTehnic = isset($achitatTehnic) ?  1 :  0;
			$achitatCabinet = isset($achitatCabinet) ?  1 :  0;
      		$sql = "INSERT INTO pacient (nume, telefon, data, ora, doctorID, observatii, manopera, achitatTehnic, achitatCabinet, visible) VALUES ('$nume', '$telefon', '$data', '$ora', '$doctorID', '$observatii', '$manopera', $achitatTehnic, $achitatCabinet, 1)";
      		//var_dump($sql);
      		//die();
 		
      	if($res = $con->query($sql)) {
      		echo "Pacient adaugat.<br />";
      		}  else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($adminView->mysqliConnect());
      	} 
      	}		
      	$con = $adminView->closeConnect();
		}

	}
}

$updateProgramari = new updateProgramari();
//if(isset($_POST['id'])){
	$updateProgramari->Update($_POST);
//}

?>