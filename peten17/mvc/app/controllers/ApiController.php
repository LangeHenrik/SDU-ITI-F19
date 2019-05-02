<?php

class ApiController extends Controller {
		
	public function index(){
		echo "ApiController";
		
	}

	public function users(){
		$userList = $this->model('User')->apiUsers();

		$json = json_encode($userList,JSON_PRETTY_PRINT);
		//header("Content-Type:application/json");
		echo $json;
	}

	public function pictures($user,$id){


		if(isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')){
			$input = json_decode($_POST['json'],true);
			$imageBlob = $input['image'];
			$imageTitle = $input['title'];
			$imageDesc = $input['description'];
			$username = $input['username'];
			$password = $input['password'];

			$returnedID = $this->model('User')->validateUser($username,$password);

			if($returnedID ==$id){
				$imageID = $this->model('Picture')->apiUploadPicture($imageBlob,$imageTitle,$imageDesc,$id);
				$imageID = array('image_id'=>$imageID);
				$jsonUsers = json_encode($imageID,JSON_PRETTY_PRINT);
				echo $jsonUsers;
			} else {
				$imageID = -1;
				$imageID = array('image_id'=>$imageID);
				$jsonUsers = json_encode($imageID,JSON_PRETTY_PRINT);
				echo $jsonUsers;
			}
		}else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
		
			$pictures = $this->model('Picture') -> pictreByUser($id);
			$json_users = json_encode($pictures, JSON_PRETTY_PRINT);
			echo $json_users;
		}
	}



}