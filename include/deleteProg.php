<?php 
include('load.php');

class deleteProg {
	public function delete($variables) {
		
		if(isset($variables)) {
		extract($variables);
		//var_dump($id);
		//die();
		$adminView =  new adminView();		

		$con = $adminView->mysqliConnect();
		if(isset($id)) {
	
		$sql = "UPDATE pacient SET Visible = 0 WHERE id = '$id'";
		
      	if($res = $con->query($sql)) { 
      		echo "Stergerea pacientului a fost efectuata.<br />";
      		}  else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($adminView->mysqliConnect());
      		} 
      	}
		
      	$con = $adminView->closeConnect();
		}

	}
}

$deleteProg = new deleteProg();
$deleteProg->delete($_POST);


?>