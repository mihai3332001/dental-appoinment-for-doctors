<?php
include("../include/load.php");
session_start();
$session = new sessionUser();
if($session->viewUser() != null) {
	$title = "Welcome " . $session->viewUser();
}
else {
	$session->checkUser();
}

$html = new html_preview();
$html->setTitle($title);
echo $html->getHeader();
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-md-3 pb-5">
			<ul class="list-group">
  <li class="list-group-item active">Dashboard</li>
  <a href="viewProg.php"><li class="list-group-item">Programari</li></a>
  <a href="createProg.php"><li class="list-group-item">Adauga programare</li></a>
  <a href="viewDoctor.php"><li class="list-group-item">Afiseaza doctori</li></a>
  <a href="createDoctor.php"><li class="list-group-item">Adauga doctori</li></a>
  <a href="viewUser.php"><li class="list-group-item">Vizualizeaza useri</li></a>
  <a href="createUser.php"><li class="list-group-item">Adauga useri</li></a>
</ul>
		</div>
		<div class="col-12 col-md-9">
			Bine ai venit la tabloul principal Dental Teo. Alege din meniul din stanga.<br />
			Daca ai intrebari email at: nuntadj@nuntadj.ro.
		</div>
	</div>
</div>
<?php echo $html->getFooter(); ?>