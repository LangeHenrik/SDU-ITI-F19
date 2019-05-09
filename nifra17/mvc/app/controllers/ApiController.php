<?php
require_once('../app/models/Picture.php');
class ApiController extends Controller {
	
	/*public function __construct() {
		header('Content-Type: application/json');
	}*/
	
	public function index () {
		
	}
	
	public function users (){
		
		$users = $this->model('User')->getAllUsers();
		$jsonUsers = json_encode($users);
		header("Content-Type:application/json");
		echo $jsonUsers;
	}
	
	public function pictures ($userSpec, $userId) {
		header("Content-Type:application/json");
		
		
		if($this->post()){
			
			$postJson = $_POST['json'];
			$postContent = json_decode($postJson);
			
			if($this->model('User')->login($postContent->username, $postContent->password)){
				
				$image_id = $this->model('Picture')->postPicture($postContent->title, $postContent->description, $postContent->image);
				$jsonImageId = json_encode($image_id);
				echo '{"image_id":' .$jsonImageId;
				
			}
			
			
		}else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
			$pictures = $this->model('Picture')->getUserPictures($userId);
			
			
			$json_users = json_encode($pictures, JSON_PRETTY_PRINT);
			echo $json_users;
		}
		
		
		else{
			
		
			
			/*$pictures = $this->Model('Picture')->getUserPictures($userId);
			
			$post_list = array();
			foreach ($pictures as $aPicture){
				$tempPost['title']= $aPicture['title'];
				$tempPost['description']= $aPicture['description'];
				$tempPost['image']= $aPicture['image'];
				$post_list[] = $tempPost;
			}
			
			echo json_encode($post_list);
			//$jsonPictures = json_encode($pictures);
			//echo $jsonPictures;*/
			
			
		}
	
	}
	
	/*public function pictures ($user, $userID) {
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
				$image_id = $this->model('Picture') -> ApiUploadPicture($imageBlob, $title, $description, $userID);
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
	}*/
	
	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
		
	}
	
	
}

?>