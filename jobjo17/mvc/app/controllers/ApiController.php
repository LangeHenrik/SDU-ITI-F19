<?php
 require_once('../app/models/image.php');
  require_once('../app/models/LoginUser.php');
class ApiController extends Controller {

	
	public function index ($param) {

	}
	// get for api
	public function users() {
		header("Content-Type:application/json");
		if($_SERVER['REQUEST_METHOD'] === 'GET') {
			$userarray = $this->model('apiuser')->retrieveAll();
			$myJSON = json_encode($userarray);
			echo $myJSON;
		}
	}
	public function pictures($input1,$user_id){
		header("Content-Type:application/json");
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$json = json_decode($_POST['json']);
			$loginUser = new LoginUser;
			$loginUser->create($json->username,$json->password);
			if($loginUser->login()) {
			$image = new Image;
			$image->create($json->title,$json->description,$_SESSION['user_id'],$json->image);
			$image->image_id = $image->upload();
			$json = json_encode($image);
			echo $json;
			}
		}
		if($_SERVER['REQUEST_METHOD'] === 'GET') {
			$json2 = $this->model('image')->apiRetrieveForUser($user_id);
			echo json_encode($json2);
			
		}
				
	}
	
	
}