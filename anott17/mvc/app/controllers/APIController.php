<?php

class APIController extends Controller {

	public function index () {
	}

	public function users () {
		$users = $this->model('User') -> getUserNamesAndIDs();

		$json_users = json_encode($users, JSON_PRETTY_PRINT);
		header("Content-Type:application/json");
		echo $json_users;
	}

	public function pictures ($user, $userID) {
		header("Content-Type:application/json");
		// print_r($_SERVER['REQUEST_METHOD']);
		if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
			//$input = $_POST['json'];

			$input = json_decode($_POST['json'], true);
			$imageBlob = $input['image'];
			$title = $input['title'];
			$description = $input['description'];
			$username = $input['username'];
			$password = $input['password'];

			$returnedUserID = $this->model('User') -> validateUsers($username, $password);
			//print_r($returnedUserID);
			//print('as');
			//print_r($userID);
			if ($returnedUserID == $userID) {
				// print('asasdasdasdsdas');
				$image_id = $this->model('Picture') -> APIUploadPicture($imageBlob, $title, $description, $userID);

				$image_id = array('image_id' => $image_id);

				$json_users = json_encode($image_id, JSON_PRETTY_PRINT);
				echo $json_users;
			} else {
				$image_id = -1;

				$image_id = array('image_id' => $image_id);

				$json_users = json_encode($image_id, JSON_PRETTY_PRINT);
				echo $json_users;

			}
		} else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
			// print('asasdasdasdsdas');
			$pictures = $this->model('Picture') -> getPicturesFromUser($userID);

			$json_users = json_encode($pictures, JSON_PRETTY_PRINT);
			echo $json_users;
		}
	}
}
