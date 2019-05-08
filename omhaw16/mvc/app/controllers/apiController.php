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

}

?>