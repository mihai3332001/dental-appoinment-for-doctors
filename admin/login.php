<?php 
include("../include/load.php");
session_start();

$session = new sessionUser(); 
if($session->viewUser() != null) {
      $title = "Welcome";
      $session->redirectToDashboard();
} else {
      $title = "Login";
}


 	$html = new html_preview();

  	$html->setTitle($title);
    echo $html->getHeader();
  
?>
<div class="container">
	<div class="row">
		<div class="col-12 pb-5">
			<div id="result" class="alert-danger"></div>
<form id="userForm">
  <div class="form-group">
   <label for="username">Username or Email</label>

    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter username or email" name="username">

    <small id="emailHelp" class="form-text text-muted">Login administrator</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary" id="buttonSend">Submit</button>
</form>
</div>
</div>
</div>

<?php echo $html->getFooter();

 ?>
