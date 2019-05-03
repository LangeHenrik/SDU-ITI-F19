<?php
require_once('../app/models/user.php');
class APIController extends Controller {
	public function __construct(){
		header('Contect-Type: application/json');
	}
	
	public function index ($param) {
	
	}
	
	public function users(){
		$users = $this-> Model('User')->getAllUsers();
		$jsonUsers = json_encode($users);
		echo $jsonUsers;
	}
		
	public function pictures($userpec, $userID){
		if($this->post()){
			$postJson = $_POST['json'];
			$postContent = json_decode($postJson);
			
			
			if ($this->Model('User')->apiValidateUsers($postContent->username,$postContent->password)){
				
				$imageId = $this->Model('image')->postPicture($postContent->title,$postContent->description,$postContent->image);
				$jsonImageId = json_encode($imageId);
				echo '{"image_id": "'.$jsonImageId.'"}';
				
			}
		}else{
			$pictures = $this->Model('image')->getUserPictures($userID);
			$jsonPictures = json_encode($pictures);
			echo $jsonPictures;
		}	
	}
	
			
	/*public function users () {
        $users = $this->model('User')->apiGetUsers();
        $users_json = json_encode($users, JSON_PRETTY_PRINT);
        header("Content-Type:application/json");
        echo $users_json;
    }*/
	
}