<?php

class ApiController extends Controller {
	
	public function __construct() {
		header("Content-Type: application/json, charset=UTF-8");
		/*echo 'apicontroller constructed. ';*/
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
		/*echo "someone is looking for " .$usr. " " . $id;
		$pictures = $this->Model('Picture')->all();
		$jsonPictures = json_encode($pictures);
		echo $jsonPictures;*/
	}
	
	private function postUserPicture($userid){
		/*echo ' postuserpicture method entered. ';*/
		$data = file_get_contents("php://input");
		$json = json_decode($data, true);
		extract($json);

		$image = base64_decode($json['image']);
		$title = $json['title'];
		$description = $json['description'];
		$username = $json['username'];
		$password = $json['password'];

		include_once(__DIR__ . '/../models/Picture.php');
		postValues($userid, $image, $title, 
			$description, $username, $password);
	}

	private function getUserPictures($userid){
		include_once(__DIR__ . '/../models/Picture.php');
		$fetched = fetchImages($userid); //array of image array and the amount of images
		$images_size = $fetched[1];
		$images = $fetched[0];
		//check amount of images found
		if (sizeof($images) > 0){
			$image_list = array();
			echo json_encode("entering foerach to go through images and set them up. ");
			$it = 1;
			foreach ($images as $img) {
				echo json_encode("loop iteration: ". $it++ . ". \\");
				$image = new Image(
					base64_encode($img[1]), // index of image
					$img[3], // index of title
					$img[4]  // index of description
				);
				echo 'image blob is: ' . json_encode(base64_encode($img[1]));
				echo 'image title is: ' . json_encode($img[3]);
				echo 'image description is: ' . json_encode($img[4]);
				array_push($image_list, $image);
			}
			//json encode array of images and return it
			$json = json_encode($image_list /*JSON_PRETTY_PRINT*/);
			http_response_code(200);
			echo $json;
		} else {
			http_response_code(404); //find correct response code
			echo json_encode('no images found.');		
		}
	}

	//function to be used when the api for getting user accounts is in use.
	public function users() {
		/*echo 'user method entered. ';*/
		
		$method = $_SERVER['REQUEST_METHOD'];
		$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
		if($method == 'GET'){
			include_once(__DIR__ . '/../models/readuser.php');
			$dbarray = read(); 
			$userList_size = $dbarray[1];
			$userList = $dbarray[0];
			$users = array();
			//echo json_encode('size of userlist array: ' . $userList_size /*$userList->sizeof*/);
			//check amount of users found
			if ($userList_size > 0) {
				//print userlist to see what happens
				//echo json_encode(print_r($userList)); //prints all user data including passwords
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