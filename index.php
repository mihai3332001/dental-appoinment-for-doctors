<?php
include("/include/load.php");
session_start();



  $title = "Programari";

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
 
<div class="container">
    <div class="row">
     
        <div class="col-12 mb-5">
          <form method="POST" class="form-inline" action="cauta.php" id="formIndex">
        <div class="col-md-9">
                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" id="datetimepick" name="datepick">
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                      <div id="messageIndex" class="alert-success"></div>
                </div>
        </div>
           <div class="col-md-3">
            <input type="submit" value="Submit" class="btn btn-success" name="submit">
          </div>
                </form>
        </div>


    </div>
</div>

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
