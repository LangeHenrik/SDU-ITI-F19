<?php

class ApiController extends Controller {
	
	public function index ($param = null) {
		echo "These are the params: " . $param;
		$this->view("login/Login");
	}
	
	public function users() {
		if($this->get()) {
			echo json_encode(getUser());
		}
	}
	
	public function pictures($param1, $id) {
		
		if(strtolower($param1)=="user") {
			if($this->get()) {
				//Use enormous amount of images to get all. No user has 1 million images anyways.
				echo json_encode(imagesInRange(0, 30, (int) $id));
			}
			
			if($this->post()) {
				$json = json_decode(file_get_contents('php://input'))[0];
				if(authenticate($json->username, $json->password)) {
					$user_id = getId($json->username);
					$randomFileName = $this->generateRandomString();
					
					$pos  = strpos($json->image, ';');
					$type = explode('/', explode(':', substr($json->image, 0, $pos))[1])[1];
					
					$newPath = "user_images\\".$randomFileName . "." . $type;
					
					$data = explode(',', $json->image);
					$content = base64_decode($data[1]);
					
					file_put_contents($newPath, $content);
					
					$_SESSION["user_name"] = $json->username;
					
					$imageId = uploadImage($json->title, $json->description, $newPath);
					
					unset($_SESSION["user_name"]);
					echo $imageId;
				} else {
					echo "Did not authenticate.";
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



