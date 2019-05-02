<?php

class APIController extends Controller {

	public function index () {
	}

	public function users () {
		$users = $this->model('User')->apiGetUsers();
		$users_json = json_encode($users, JSON_PRETTY_PRINT);
		header("Content-Type:application/json");
		echo $users_json;
	}

	public function pictures ($user, $userID) {
		header("Content-Type:application/json");

		if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$input = json_decode($_POST['json'], true);
			$imageBlob = $input['image'];
			$title = $input['title'];
			$description = $input['description'];
			$username = $input['username'];
			$password = $input['password'];
			$returnedUserId = $this->model('User')->apiValidateUsers($username, $password);

			if ($returnedUserId == $userID) {
				$image_id = $this->model('Picture')->apiUpload($imageBlob, $userID, $title, $description);

				$image_id = array('image_id' => $image_id);

				$users_json = json_encode($image_id, JSON_PRETTY_PRINT);
				echo $users_json;
			} else {
				$image_id = -1;

				$image_id = array('image_id' => $image_id);

				$users_json = json_encode($image_id, JSON_PRETTY_PRINT);
				echo $users_json;
			}
		} else if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $json = $this->model('picture')->apiGetPicturesFromUser($userID);
            echo json_encode($json);
        }
	}
}
