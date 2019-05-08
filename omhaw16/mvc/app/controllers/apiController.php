<?php 

class APIController extends Controller {

public function __construct() { 

// echo "I am the API Controller!";

}

public function testMe() {

	echo " - Here I am!";
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

//				echo json_encode($picJSON);

				echo json_encode($picJSON);
//				echo json_encode($objectOfPics);

			}

			else if ($this->post($userID,$username,$password)) {
				$objectOfPics = $this->model('Pictures');
				$objectOfUser = $this->model('User');

				if ($objectOfUser->login($username,$password)) { 
				$objectOfPics->uploadPic($userID,$imgname,$imgtitle,$imgdesc);
			} else {
				echo "Couldn't log in with " . $username . "and " . $password;
			}
		}
}

}

?>