<?php

include("include/load.php");




if(isset($_GET['token']) && isset($_GET['user'])) {

	$token = $_GET['token'];

	$user = $_GET['user'];

	$title = "Confirmarea userului " .$user;

	$update = new updateUser();

	$confirmation = $update->verifyUserByToken($user, $token);

$html = new html_preview();

$html->setTitle($title);

echo $html->getHeader();

echo $confirmation;

echo $html->getFooter();

}

?>