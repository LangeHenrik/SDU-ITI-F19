<?php

class ApiController extends Controller {

	public function index () {

	}

	public function users () {
		$users = $this->model('Api') -> selectUsers();
		$json = json_encode($users);
		header("Content-Type: application/json");
		echo $json;
	}


	public function pictures($user, $userID) {

		//header("Content-Type: application/json");
		if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$input 				= json_decode($_POST['json'],true);
			$image 				= $input['image'];
			$title 				= $input['title'];
			$description	= $input['description'];
			$username			=	$input['username'];
			$password			= $input['password'];

			$returnedID = $this->model('User')->validateUser($username,$password);
			if($returnedID ==$id) {
				$image_id = $this->model('Api')->uploadPicture($image, $title, $description, $username);
				$image_id = array('image_id' => $image_id);
				$json = json_encode($image_id, JSON_PRETTY_PRINT);
				echo $json;
			} else {
				$image_id = -1;
				$image_id = array('image_id'=>$imageID);
				$json = json_encode($imageID,JSON_PRETTY_PRINT);
			}

		} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
			$pictures = $this->model('Api')->selectPictures($userID);
			$json = json_encode($pictures, JSON_PRETTY_PRINT);
			echo $json;
		}

	}

}
