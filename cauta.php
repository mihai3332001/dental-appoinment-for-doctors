<?php
include("/include/load.php");
session_start();
$datepick = $_POST['datepick'];
if(isset($datepick)) {
	$title = "Cautari dupa data " . $datepick;
} else {
	$title = "Cauta";
}

  

if(isset($_GET['page'])) {
  $pagnr = $_GET['page'];
} else {
  $pagnr = 1;
}
//var_dump($_POST);

$adminView = new adminView();
$limit = $adminView->getCount();

$pag = $adminView->getData($limit, $pagnr);

$all = $adminView->searchDate($datepick);

$html = new html_preview();
$html->setTitle($title);
echo $html->getHeader();
?>

<div class="container-fluid">
  <div class="row">
    
    <div class="col-12 col-md-12">
      <div class="table-responsive">
        <table class="table viewProg">
  <thead>
    <tr>
      <th scope="col">Nume</th>
      <th scope="col">Telefon</th>
      <th scope="col">Data</th>
      <th scope="col">Ora Programari</th>
      <th scope="col">Doctor</th>
      <th scope="col">Observatii</th>
      <th scope="col">Manopera</th>
      <th scope="col">Achitat Tehnic</th>
      <th scope="col">Achitat Cabinet</th>
    </tr>
  </thead>
  <?php   if(isset($all)) { ?>
  <tbody>
    <?php 

  
      foreach($all as $key=>$value) {
     ?>

    <tr>
      <th scope="row" id="test"><?php echo $value->Nume; ?></th>
      <td><?php echo $value->Telefon; ?></td>
      <td><?php echo $value->Data; ?></td>
      <td><?php echo date('h:i A', strtotime($value->Ora)); ?></td>
      <td><?php echo $value->Doctor; ?></td>
      <td><?php echo $value->Observatii; ?></td>
      <td><?php echo $value->Manopera; ?></td>
      <td><?php echo $value->AchitatTehnic == true ? 'Da' : 'Nu'; ?></td>
      <td><?php echo $value->AchitatCabinet == true ? 'Da' : 'Nu'; ?></td>
      
    </tr>
    <?php
    	}
  ?>
  </tbody>
  <?php } else { 
      echo '<tr><td colspan="9"><p class="alert-danger text-center p-5 font-weight-bold">Nici o inregistrare gasita pentru data respectiva</p></td></tr>' ; 
      	  } ?>
</table>
</div>
 <div class="pages">
          <?php 
            echo '<ul class="pagination justify-content-center">';
            for($page = 1;  $page <= $pag; $page ++) {

              echo '<li class="page-item"><a href="index.php?page=' . $page . '" class="page-link">' . $page . ' </a> </li>'; 
            } 
              echo '</ul>';
          ?>
        </div>
    </div>
  </div>
</div>

<?php echo $html->getFooter(); ?>
