<?php

class ApiController extends Controller {

	public function __construct() {
		header("Content-Type: application/json");
	}

	public function index () {

	}

	public function users () {
		$users = $this->model('Api') -> selectUsers();
		$json = json_encode($users);
		echo $json;
	}


	public function pictures($user, $userID) {
		if ($this->post()) {
			$postJson = $_POST['json'];
			$postContent = json_decode($postJson);

			if ($this->Model('User')->login($postContent->username, $postContent->password)) {
				$image_id = $this->Model('Api')->uploadPicture($postContent->image, $postContent->title, $postContent->description, $postContent->username);
				$jsonImageId = json_encode($image_id);
				echo '{"image_id": '.$jsonImageId.'}';
			}

		} else {
			$pictures = $this->model('Api')->selectPictures($userID);
			$jsonPictures = json_encode($pictures);
			echo $jsonPictures;
		}
	}

}
