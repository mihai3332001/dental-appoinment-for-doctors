<?php 
include('load.php');

class adminView extends mysqli{
	private $result;
	private $host;
	private $username;
	private $password;
	private $database;
  private $_page;


	public function __construct() {
		$dentalTeo =  new dentalConfig();
		$this->host = $dentalTeo->host;
		$this->username = $dentalTeo->username;
		$this->password = $dentalTeo->password;
		$this->database = $dentalTeo->database;		
    }

    public function mysqliConnect() {
    	$mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
    	 if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        return $mysqli;       
    }

    public function closeConnect() {
    	$close = $this->mysqliConnect();
    	return $close->close();
    }

    public function findUser($verify) {
          //var_dump($verify);
    	if(isset($verify['username'])) {
    		$username = $verify['username'];
    	}
    	if(isset($verify['password'])) {
    	$password = $verify['password'];    
    	}

    	$con = $this->mysqliConnect();
    	$sql = "SELECT * FROM user WHERE User = '$username' OR Email = '$username'";
      	$res= $con->query($sql);

      	$count = mysqli_num_rows($res);
      	if($count == 1) {
          $row = mysqli_fetch_object($res);
          if(password_verify($password, $row->Pass)){
            session_start();
            $_SESSION['login_user'] = $row->User;
           // $basspath = new basspath();
            //$basspath->redirect('admin/welcome.php');
          } else {
            echo "Parola gresita";
          }
      	} else {
      		echo "Username sau parola gresita";
      	}
      	$con = $this->closeConnect();
     	
    }

  public function getData($limit = 10, $page = 1) {
    $this->_page = $page;
  $pages = ceil($limit / 10);
  return $pages;    
  }

  public function setPage() {
    $pagenumber = $this->_page;
    if(isset($pagenumber)) {
      $page = ($pagenumber - 1) * 10;
      return $page;
    } else {
      $page = 0;
      return $page;
    }

  }

    public function viewProg() {
    	$con = $this->mysqliConnect();
      $limit = $this->setPage();
      $sql = "SELECT pacient.*, doctor.Doctor FROM pacient JOIN doctor ON doctorID = doctor.ID WHERE pacient.Visible = 1 AND pacient.Data >= DATE_SUB(CURDATE(), INTERVAL 4 WEEK) ORDER BY pacient.Ora LIMIT $limit, 10 ";
      $res= $con->query($sql);
      while($row = $res->fetch_object("ViewProg")) {
        //  if($row->Visible == true) {
      $content[] = $row;
        //  }       
      }

      $con = $this->closeConnect();
      return $content;
    }

    public function searchDate($date) {
      $con = $this->mysqliConnect();
      $limit = $this->setPage();
       $sql = "SELECT pacient.*, doctor.Doctor FROM pacient JOIN doctor ON doctorID = doctor.ID WHERE pacient.Visible = 1 AND pacient.Data = '$date' ORDER BY pacient.Ora LIMIT $limit, 10 ";
      $res= $con->query($sql);
      while($row = $res->fetch_object("ViewProg")) {
        //  if($row->Visible == true) {
        //var_dump($row);
      $content[] = $row;
        //  }       
      }

      $con = $this->closeConnect();
            if(isset($content)) {
             return $content;
      } else {
        return null;
      }
    }

    //  public function viewProgbyDate($date) {
    //   $con = $this->mysqliConnect();
    //   extract($date);

    //   $sql = "SELECT pacient.*, doctor.Doctor FROM pacient JOIN doctor ON doctorID = doctor.ID WHERE pacient.Data = '$Data'" ;
    //   $res= $con->query($sql);
    //   while($row = $res->fetch_object()) {
    //     //  if($row->Visible == true) {
    //   $content[] = $row;
    //   //var_dump($row);
    //     //  }       
    //   }

    //   $con = $this->closeConnect();
    //   echo $content;

    // }

    public function getCount() {
      $con = $this->mysqliConnect();
      $sql = "SELECT pacient.*, doctor.Doctor FROM pacient JOIN doctor ON doctorID = doctor.ID WHERE pacient.Visible = 1 AND pacient.Data >= DATE_SUB(CURDATE(), INTERVAL 4 WEEK) ORDER BY pacient.Ora";
      $res= $con->query($sql);
      $count = mysqli_num_rows($res);
      $con = $this->closeConnect();
      return $count;
    }

    public function selectPacientbyID($int) {
    	$con = $this->mysqliConnect();
    	$sql = "SELECT * FROM pacient WHERE ID = {$int}";
      	$res= $con->query($sql);
      	//$row = $res->fetch_object("ViewProg");
      	while($row = $res->fetch_object("ViewProg")) {
      		if($row->Visible == true) {
      			return $row;
      		}   		
      	}
      	$con = $this->closeConnect();     	
    }

    public function selectAllDoctor() {
    	$con = $this->mysqliConnect();
    	$sql = "SELECT * FROM doctor";
    	$res= $con->query($sql);
      	//$row = $res->fetch_object("ViewProg");
      	while($row = $res->fetch_object("ViewDoctor")) {
      		if($row->Visible == true) {
      			$content[] = $row;
      		}   		
      	}
    	$con = $this->closeConnect(); 
    	return $content;
    }

    public function selectDoctorByID($id) {
		$con = $this->mysqliConnect();
    	$sql = "SELECT * FROM doctor WHERE id = $id";
    	$res= $con->query($sql);
      	$row = $res->fetch_object();      	
    	$con = $this->closeConnect(); 
    	return $row;
    }

    public function hashPassword($password) {
      $passHash = password_hash($password, PASSWORD_BCRYPT);
      return $passHash;
    }

    public function verifyPassword() {
      $con = $this->mysqliConnect();
      $sql = "SELECT Pass FROM user WHERE id = $username";
      $res= $con->query($sql);
        $row = $res->fetch_object();        
      $con = $this->closeConnect(); 
      return $row;
    }

}

class ViewProg {
	public $ID;
	public $doctorID;
	public $Nume;
	public $Telefon;
	public $Data;
	public $Ora;
	public $AchitatTehnic;
	public $Visible;
	public $AchitatCabinet;
}

class ViewDoctor {
	public $ID;
	public $Doctor;
	public $Visible;
}


$adminView = new adminView();

if(isset($_POST['username'])) {
	$adminView->findUser($_POST);
} else if(isset($_POST['Data'])) {
  $adminView->viewProgbyDate($_POST);
 // $content->viewObjects();
}

?>