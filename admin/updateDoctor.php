<?php
include("../include/load.php");
session_start();
$doctor_id = $_GET['doctor_id'];
$adminView = new adminView();
$doctor = $adminView->selectDoctorByID($doctor_id);
$session = new sessionUser();

if($session->viewUser() != null) {
	$title = "Modifica doctorul " . $doctor->Doctor;
}
else {
	$session->checkUser();
}


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
  <a href="viewDoctor.php"><li class="list-group-item active">Afiseaza doctori</li></a>
  <a href="createDoctor.php"><li class="list-group-item">Adauga doctori</li></a>
  <a href="viewUser.php"><li class="list-group-item">Vizualizeaza useri</li></a>
  <a href="createUser.php"><li class="list-group-item">Adauga useri</li></a>
</ul>
		</div>
		<div class="col-12 col-md-9">
			<div id="updateMessage" class="alert-success"></div>
<form id="updateDoctor">
  <div class="form-group">
    <label for="username">Nume</label>
    <input type="text" class="form-control" id="doctor" name="doctor" value="<?php echo $doctor->Doctor; ?>">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" value="<?php echo $doctor->Email; ?>">
  </div>
    

    <input type="hidden" class="form-check-input" name="id" value="<?php echo $doctor->ID; ?>">


  <button type="submit" class="btn btn-primary" id="buttonSend">Submit</button>
</form>
		</div>
	</div>
</div>
<?php echo $html->getFooter(); ?>