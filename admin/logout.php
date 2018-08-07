<?php 
include("../include/load.php");
session_start();
if(session_destroy()) {
	$basspath = new basspath();
    $basspath->redirect('admin/login.php');
}
?>