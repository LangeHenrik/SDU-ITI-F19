<?php

function comparator($object1, $object2) { 
	return $object1->image_id < $object2->image_id; 
} 

class ApiController extends Controller {
	
	public function index ($param = null) {
		echo "These are the params: " . $param;
		$this->view("login/Login");
	}
	
	function __construct() {
		$this->model("User");
		$this->model("Image");
	}
	
	public function users() {
		if($this->get()) {
			echo json_encode(User::getUser());
		}
	}
	
	
	
	public function pictures($param1, $id) {
		
		if(strtolower($param1)=="user") {
			if($this->get()) {
				//Use enormous amount of images to get all. No user has 1 million images anyways.
				
				$images = Image::imagesInRange(0, 3000, (int) $id);
				$output = array();
				foreach($images as $image) {
					$obj = new StdClass();
					$obj->image_id = $image->id;
					$obj->description = $image->description;
					$obj->title = $image->title;
					$obj->image = "/krkin16/mvc/public/" . $image->imagePath;
					
					array_push($output, $obj);
				}
				usort($output, 'comparator');
				echo json_encode($output);
			}
			
			if($this->post()) {
				$json = json_decode($_POST["json"]);
				if(User::authenticate($json->username, $json->password)) {
					$user_id = User::getId($json->username);
					$randomFileName = $this->generateRandomString();
					
					$pos  = strpos($json->image, ';');
					$type = explode('/', explode(':', substr($json->image, 0, $pos))[1])[1];
					
					$newPath = "user_images\\".$randomFileName . "." . $type;
					
					$data = explode(',', $json->image);
					$content = base64_decode($data[1]);
					
					file_put_contents($newPath, $content);
					
					$_SESSION["user_name"] = $json->username;
					
					$imageId = Image::uploadImage($json->title, $json->description, $newPath);
					
					unset($_SESSION["user_name"]);
					$obj = new StdClass();
					$obj->image_id = $imageId;
					
					
					echo json_encode($obj);
				}
			}
			
		}
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}



