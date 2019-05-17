<?php

class ApiController extends Controller {
	
	public function __construct() {
		//header("Content-Type: application/json, charset=UTF-8");
        header("Content-Type: application/x-www-form-urlencoded");
	}
	
	// function for managing calls to api/pictures
	public function pictures ($usr = 'user', $userid = 1) {
		$method = $_SERVER['REQUEST_METHOD'];
		$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

		if($method == 'GET'){
			$this->getUserPictures($userid);
		} elseif ($method == 'POST'){
			$this->postUserPicture($userid);
		}
	}
	
	private function postUserPicture($userid){
		$json = json_decode($_POST['json']);

		$image = filter_var($json->image, FILTER_SANITIZE_STRING); //filters a variable with a filter, the filter removes tags and removes/encodes special characters in a string
		$title = filter_var($json->title, FILTER_SANITIZE_STRING);
		$description = filter_var($json->description, FILTER_SANITIZE_STRING);
		$username = filter_var($json->username, FILTER_SANITIZE_STRING);
		$password = filter_var($json->password, FILTER_SANITIZE_STRING);

		include_once(__DIR__ . '/../models/Picture.php');
		postValues($userid, $image, $title,
			$description, $username, $password);
	}

	private function getUserPictures($userid){
		include_once(__DIR__ . '/../models/Picture.php');
		$fetched = fetchImages($userid); //array of image tuples
		if (sizeof($fetched) > 0){
			$image_list = array();
			foreach ($fetched as $img) {
				$image = new Image(
                	$img[image], // index 1 of image
					$img[title], // index 3 of title
					$img[description]  // index 4 of description
				);
				array_push($image_list, $image);
			}
			//json encode array of images and return it
			$json = json_encode($image_list);
			http_response_code(200);
			echo $json;
		} else {
			http_response_code(404); //find correct response code
			echo json_encode('no images found.');		
		}
	}

	//function to be used when the api for getting user accounts is in use.
	public function users() {		
		$method = $_SERVER['REQUEST_METHOD'];
		$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
		if($method == 'GET'){
			include_once(__DIR__ . '/../models/readuser.php');
			$dbarray = read(); 
			$userList_size = $dbarray[1];
			$userList = $dbarray[0];
			$users = array();

			//check amount of users found
			if ($userList_size > 0) {
				foreach ($userList as $usr) {
					//for each tuple make new user object with the information
					$user = new Users($usr[0], $usr[1]);
					//add user to array of users
					array_push($users, $user);
				}
				//json encode array of users and return it
				$json = json_encode($users /*, JSON_PRETTY_PRINT*/);
				http_response_code(200);
				echo($json);
			} else {
				http_response_code(404); //find correct response code
				echo json_encode('no users found.');
			}
		}
	}
}
class Image {
    public $image;
    public $title;
	public $description;

    //constructor
    public function __construct($image, string $title, string $description){
        $this->image = $image;
        $this->title = $title;
		$this->description = $description;
    }
}

class Users{
	public $user_id;
	public $username;

	//constructor
	public function __construct(int $user_id, string $username){
		$this->user_id = $user_id;
		$this->username = $username;
	}
}