<?php

class ApiController extends Controller {
	
	public function __construct(){
		header('Content-Type: application/json');
	}
	
	public function index ($param) {
	}
	
	public function users(){
		$users = $this->Model('User')->getAllUsers();
		$jsonUsers = json_encode($users);
		echo $jsonUsers;
	}
	
	public function pictures($userSpec, $userId){
	
		if($this->post()){
			
			$postJson = $_POST['json'];
			$postContent = json_decode($postJson);
			
			if($this->Model('User')->login($postContent->username, $postContent->password)){
				
				$this->Model('Picture')->postPicture($postContent->title, $postContent->description, $postContent->image);
				$jsonImageId = json_encode($imageId);
				echo '{"image_id": '.$jsonImageId.'}';
			}
			
		}else{
			
			$pictures = $this->Model('Picture')->getUserPictures($userId);
			$jsonPictures = json_encode($pictures);
			echo $jsonPictures;
			
		}
	}
	
	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {

	}

}