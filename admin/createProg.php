<?php
include("../include/load.php");
session_start();


$session = new sessionUser();
if($session->viewUser() != null) {
		$title = "Adauga pacient";
}
else {
	$session->checkUser();
}

$adminView = new adminView();
$doctor = $adminView->selectAllDoctor();
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
  <a href="createProg.php"><li class="list-group-item active">Adauga programare</li></a>
  <a href="viewDoctor.php"><li class="list-group-item">Afiseaza doctori</li></a>
  <a href="createDoctor.php"><li class="list-group-item">Adauga doctori</li></a>
  <a href="viewUser.php"><li class="list-group-item">Vizualizeaza useri</li></a>
  <a href="createUser.php"><li class="list-group-item">Adauga useri</li></a>
</ul>
		</div>
		<div class="col-12 col-md-9">
			<div id="messageProg" class="alert-success"></div>
<form id="updateProg">
  <div class="form-group">
    <label for="username">Nume</label>
    <input type="text" class="form-control" id="nume" name="nume" value="">
  </div>
    <div class="form-group">
    <label for="telefon">Telefon</label>
    <input type="text" class="form-control" id="telefon" name="telefon" value="">
  </div>
    <div class="form-group">
    <label for="date">Data</label>
    <input type="date" class="form-control" id="data" name="data" value="">
  </div>
  <div class="form-group">
    <label for="time">Ora Programari</label>
    <input type="time" class="form-control" id="ora" name="ora" value="">
  </div>
  <div class="form-group">
    <label for="doctor">Doctor</label>
    <select class="form-control" id="doctor" name="doctorID">
    	<?php foreach($doctor as $key=>$value) {
    
    			echo '<option value="' . $value->ID . '">' . $value->Doctor . '</option>';

    	}
    	?>
    </select>
  </div>
  <div class="form-group">
   <label for="observatii">Observatii</label>
    <textarea class="form-control" id="observatii" rows="3" name="observatii"></textarea>
  </div>
  <div class="form-group">
   <label for="manopera">Manopera</label>
    <textarea class="form-control" id="manopera" rows="3" name="manopera"></textarea>
  </div>
  <div class="form-check">
  	<div class="row">
  	<div class="col-md-6">
    <input type="checkbox" class="form-check-input" id="achitatTehnic" name="achitatTehnic">
    <label class="form-check-label" for="achitatTehnic">Achitat Tehnic</label>
	</div>
	<div class="col-md-6">
    <input type="checkbox" class="form-check-input" id="achitatCabinet" name="achitatCabinet">
    <label class="form-check-label" for="achitatTehnic">Achitat Cabinet</label>

	</div>
	</div>
  </div>
  <button type="submit" class="btn btn-primary" id="buttonSend">Submit</button>
</form>
		</div>
	</div>
</div>
<?php echo $html->getFooter(); ?>