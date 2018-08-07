<?php 
include('load.php'); 


class html_preview {
	private $ccc;
	private $titlePage;

	public function __construct()
    {
       $dentalConfig =  new dentalConfig();
		$this->setConfig($dentalConfig);
    }

	public function setConfig($data) {
		$this->ccc = $data;
	}

	public function setTitle($title) {
		if(isset($title)) {
			$this->titlePage = $title;
			//var_dump($title);
		}
	}

	private function getTitle() {
		return $this->titlePage;
	}

	public function getText($text) {
					//var_dump($this->ccc);
		$varText = $this->ccc;
		//var_dump($varText);
		foreach($varText as $key=> $value) {
			if($key == $text) {
				if(!empty($value)) {
					return $value;
				} else {
					return $key;
				}
				
			}
		}
		
	}

	public function path() {
		$basePath = new bassPath();
		return $basePath->Path();
	}

	public function getHeader() {
		$session = new sessionUser();

		?>
		<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->path() . 'css/style.css'; ?>">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <title><?php echo $this->getText('header_title') . ' - ' . $this->getTitle(); ?></title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js "></script>


  </head>
  <body>
    <header>
    <div class="container-fluid mb-5">
      <div class="row">
        <div class="titleHeader w-100 pt-5">
    <h1 class="text-center pr-5"><?php  echo $this->getTitle(); ?></h1>
      <p class="adminLogin text-right w-100 pr-5 ">
      	 <a href="<?php echo $this->path() . 'index.php'; ?>" class="btn btn-primary">Site</a>
      		<?php
      		if($session->viewUser() != null) {
      			?>
      			  <a href="<?php echo $this->path() . 'admin/logout.php'; ?>" class="btn btn-primary">Logout</a>
      			  <?php
      		} else {
      		 ?>
      		
      		
          <a href="<?php echo $this->path() . $this->getText('admin_button_link'); ?>" class="btn btn-primary"><?php echo $this->getText('admin_button_text'); ?></a>
      <?php } ?>
        </p>
        </div>
      </div>
    </div>
</header>
		<?php
	}
	public function getFooter() {
		?>
		    <footer class="py-3">
  
        <div class="footerCopyright w-100">
    <p class="copyright text-center my-0"><?php echo $this->getText('copyright'); ?> <a href="https://www.nuntadj.ro/" class="madeBy">DMA Expert IT</a></p>

    </div>
 </footer>
     


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ro.js"></script>
 
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?php  echo $this->path() . 'js/script.js'; ?>"></script>
  </body>
</html>
		<?php
	}
}

?>