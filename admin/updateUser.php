<?php
include("../include/load.php");
session_start();
$user_id = $_GET['user_id'];

$session = new sessionUser(); 
if($session->viewUser() != null) {
  $title = "Modifica " . $session->viewUser();
}
else {
  $session->checkUser();
}

$user = new User();
$modifyUser = $user->getUserID($user_id);
//var_dump($modifyUser);


$html = new html_preview();
$html->setTitle($title);
echo $html->getHeader();
//$updateProgramari->Update($_POST);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-md-3 pb-5">
			<ul class="list-group">
  <a href="welcome.php"><li class="list-group-item">Dashboard</li></a>
  <a href="viewProg.php"><li class="list-group-item">Programari</li></a>
  <a href="createProg.php"><li class="list-group-item">Adauga programare</li></a>
  <a href="viewDoctor.php"><li class="list-group-item">Afiseaza doctori</li></a>
  <a href="createDoctor.php"><li class="list-group-item">Adauga doctori</li></a>
  <a href="viewUser.php"><li class="list-group-item active">Vizualizeaza useri</li></a>
  <a href="createUser.php"><li class="list-group-item">Adauga useri</li></a>
</ul>
		</div>
		<div class="col-12 col-md-9">
			<div id="messageUser" class="alert-success"></div>
<form id="updateUser">
  <div class="form-group">
    <label for="username">Nume</label>
    <input type="text" class="form-control" id="user" name="user" value="<?php echo $modifyUser->User; ?>">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="">
  </div>

  <div class="form-group">
    <label for="password2">Repeat Password</label>
    <input type="password" class="form-control" id="password2" name="password2" value="">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" value="<?php echo $modifyUser->Email; ?>">
  </div>
    

    <input type="hidden" class="form-check-input" name="id" value="<?php echo $modifyUser->ID; ?>">


  <button type="submit" class="btn btn-primary" id="buttonSend">Submit</button>
</form>
		</div>
	</div>
</div>
<?php echo $html->getFooter(); ?>