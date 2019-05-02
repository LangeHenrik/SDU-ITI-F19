<?php
require_once('../app/models/user.php');
require_once('../app/models/image.php');
class APIController extends Controller {
	
	public function index ($param) {
		
		
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
			$returnedUserID = (new User)-> apiValidateUsers($username, $password);
			if ($returnedUserID == $userID) {
				$image_id = (new Image)-> APIUploadImage($imageBlob, $title, $description, $userID);
				$image_id = array('image_id' => $image_id);
				$json_users = json_encode($image_id, JSON_PRETTY_PRINT);
				echo $json_users;
			} else {
				$image_id = -1;
				$image_id = array('image_id' => $image_id);
				$json_users = json_encode($image_id, JSON_PRETTY_PRINT);
				echo $json_users;
			}
		} /*else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
			$pictures = (new Image)-> getPicturesFromUser($userID);
			$json_users = json_encode($pictures, JSON_PRETTY_PRINT);
			
			
			echo $json_users;
		}*/
		if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $json2 = $this->model('image')->getPicturesFromUser($userID);
            echo json_encode($json2,JSON_PRETTY_PRINT);

        }
	}
	
	
}