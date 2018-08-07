<?php
include("../include/load.php");
session_start();
$session = new sessionUser();

if($session->viewUser() != null) {
	$title = "Doctori";
}
else {
	$session->checkUser();
}
$adminView = new adminView();
$all = $adminView->selectAllDoctor();

//var_dump($all);
$html = new html_preview();
$html->setTitle($title);
echo $html->getHeader();
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
  <a href="viewUser.php"><li class="list-group-item">Vizualizeaza useri</li></a>
  <a href="createUser.php"><li class="list-group-item">Adauga useri</li></a>
</ul>
		</div>
		<div class="col-12 col-md-9">
      <div id="messageDoctor" class="alert-success"></div> <br />
			<div class="table-responsive">
				<table class="table viewProg">
  <thead>
    <tr>
      <th scope="col">Nume</th>
      <th scope="col">Email</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
			foreach($all as $key=>$value) {
	?>
    <tr>
      <th scope="row"><?php echo $value->Doctor; ?></th>
      <th scope="row"><?php echo $value->Email; ?></th>
      <td>
      	<input type="hidden" class="form-check-input idDelete" name="id" id="idDeleteDoctor" value="<?php echo $value->ID; ?>">
      	<a href="updateDoctor.php?doctor_id=<?php echo $value->ID; ?>" class="btn btn-success">Update</a>
      	<a href="#" class="btn btn-warning deleteDoctor" id="deleteDoctor">Delete</a>
      </td>
    </tr>

   	<?php
			}
	?>
  </tbody>
</table>
</div>

		</div>
	</div>
</div>
<?php echo $html->getFooter(); ?>
