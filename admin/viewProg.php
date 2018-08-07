<?php
include("../include/load.php");
session_start();
$session = new sessionUser();

if($session->viewUser() != null) {
	$title = "Programari";
}
else {
	$session->checkUser();
}

if(isset($_GET['page'])) {
  $pagnr = $_GET['page'];
} else {
  $pagnr = 1;
}

$adminView = new adminView();
$limit = $adminView->getCount();

$pag = $adminView->getData($limit, $pagnr);

$all = $adminView->viewProg();



$html = new html_preview();
$html->setTitle($title);
echo $html->getHeader();
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-md-3 pb-5">

			<ul class="list-group">
  <a href="welcome.php"><li class="list-group-item">Dashboard</li></a>
  <a href="viewProg.php"><li class="list-group-item active">Programari</li></a>
  <a href="createProg.php"><li class="list-group-item">Adauga programare</li></a>
  <a href="viewDoctor.php"><li class="list-group-item">Afiseaza doctori</li></a>
  <a href="createDoctor.php"><li class="list-group-item">Adauga doctori</li></a>
  <a href="viewUser.php"><li class="list-group-item">Vizualizeaza useri</li></a>
  <a href="createUser.php"><li class="list-group-item">Adauga useri</li></a>
</ul>
		</div>
		<div class="col-12 col-md-9">
			<div id="message" class="alert-success"></div> <br />
			<div class="table-responsive">
				<table class="table viewProg">
  <thead>
    <tr>
      <th scope="col">Nume</th>
      <th scope="col">Telefon</th>
      <th scope="col">Data</th>
      <th scope="col">Ora</th>
      <th scope="col">Doctor</th>
      <th scope="col">Observatii</th>
      <th scope="col">Manopera</th>
      <th scope="col">Achitat Tehnic</th>
      <th scope="col">Achitat Cabinet</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
			foreach($all as $key=>$value) {
	?>
    <tr>
      <th scope="row"><?php echo $value->Nume; ?></th>
      <td><?php echo $value->Telefon; ?></td>
      <td><?php echo $value->Data; ?></td>
      <td><?php echo date('h:i A', strtotime($value->Ora)); ?></td>
      <td><?php echo $value->Doctor; ?></td>
      <td><?php echo $value->Observatii; ?></td>
      <td><?php echo $value->Manopera; ?></td>
      <td><?php echo $value->AchitatTehnic == true ? 'Da' : 'Nu'; ?></td>
      <td><?php echo $value->AchitatCabinet == true ? 'Da' : 'Nu'; ?></td>
      <td>
      	<input type="hidden" class="form-check-input idDelete" name="id" id="idDelete" value="<?php echo $value->ID; ?>">
      	<a href="updateProg.php?pacient_id=<?php echo $value->ID; ?>" class="btn btn-success">Update</a>
      	<a href="#" class="btn btn-warning deleteProg" id="deleteProg">Delete</a>
      </td>
    </tr>

   	<?php
			}
	?>
  </tbody>
</table>
</div>
        <div class="pages">
          <?php 
            echo '<ul class="pagination justify-content-center">';
            for($page = 1;  $page <= $pag; $page ++) {

              echo '<li class="page-item"><a href="viewProg.php?page=' . $page . '" class="page-link">' . $page . ' </a> </li>'; 
            } 
              echo '</ul>';
          ?>
        </div>
		</div>
	</div>
</div>

<?php echo $html->getFooter(); ?>
