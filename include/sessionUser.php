<?php
include('load.php');


class sessionUser {
	private $user;
	private $pacient;
	public function __construct() {
		if(isset($_SESSION['login_user'])){
		$this->user = $_SESSION['login_user'];
		} 
		if(isset($_SESSION['pacient_id'])){
		$this->pacient = $_SESSION['pacient_id'];
		} 
	}
	public function checkUser() {
		if(!isset($_SESSION['login_user'])) {
		$basspath = new basspath();
    	$basspath->redirect('admin/login.php');
		} 
	}

	public function redirectToDashboard() {
		if(isset($_SESSION['login_user'])) {
		$basspath = new basspath();
    	$basspath->redirect('admin/welcome.php');
		} 
	}
	public function viewUser() {
		 return $this->user;
	}
	public function editPacient() {
		$adminView = new adminView();
		$editPacient = $adminView->selectPacientbyID($this->pacient);
		return $editPacient;
	}

}


?>