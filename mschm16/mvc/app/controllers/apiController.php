<?php 

class APIController extends Controller {
	public function __construct() { 

	}

	public function testMe() {
		echo " - Hello, world!";
	}

	public function users() {
		if ($this->get()) {
			$objectOfUser = $this->model('User');
			$userArray = $objectOfUser->getAllUsers();							
			echo json_encode($userArray);	
		}
	}

	public function pictures($userID) {
		if ($this->get()) {
			$objectOfPics = $this->model('Pictures');
			$picJSON = $objectOfPics->getMyPosts($userID);
			echo json_encode($picJSON);
		}

		if ($this->post()) {
			header("Content-Type:application/json");
			
			if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
				$strJsonFileContents = file_get_contents("php://input");
				$decoder = json_decode($strJsonFileContents, true);
				
				$username = $decoder["username"];
				$password = $decoder["password"];
				$postedby = $userID;
				$imgname = $decoder["imgurl"];
				$imgtitle = $decoder["title"];
				$imgdesc = $decoder["desc"];
				echo $imgname . " - ";
				
				$objectOfUser = $this->model('User');
				$objectOfPics = $this->model('Pictures');
				echo "- test - ";
					
				if($objectOfUser->login($username,$password)) {
					echo "Logged in";
					$objectOfPics->uploadThruAPI($postedby,$imgname,$imgtitle,$imgdesc);
				} else { 
					echo "Not logged in";
				}
			}
		}
	}
}
?>