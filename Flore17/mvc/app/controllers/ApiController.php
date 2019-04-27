<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class ApiController extends Controller {

	
	public static function index () {
		
	}

	public function users(){
		$viewbag['users'] = $this->model('User')->getAllUsers();
		$this->service('UserPicApi')->users2json($viewbag);
	}

	public function pictures($username, $user_id){

		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			
			$viewbag['images'] = $this->model('Picture')->getAllPosts();

			$this->service('UserPicApi')->image2json($viewbag);

		} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$_POST['json'] = '{"image": "blob","title": "some title", "description":"my description","username":"frederiklorenzen","password":"Frederik1243"}';
			
			$json_obj = json_decode($_POST['json']);

			$exists = $this->model('User')->checkPasswordDB($json_obj->username, $json_obj->password);

			$user_id_match = $this->model('User')->checkUserID($json_obj->username, $user_id);

			if ($exists == true && $user_id_match == true){
				$image_id = $this->model('Picture')->uploadPicDB($json_obj->title, $json_obj->description, $json_obj->image);
				$img_id->image_id = $image_id;
				$json = json_encode($img_id, JSON_PRETTY_PRINT);

				header('Content-Type: application/json');
				echo $json;
			}
		}
	}
}
?>

