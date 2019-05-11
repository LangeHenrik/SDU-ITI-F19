<?php

class ApiController extends Controller {
	
	public function __construct() {
		header("Content-Type: application/json, charset=UTF-8");
		echo 'apicontroller constructed. ';
	}
	
	public function pictures ($designation = 'user', $designation_id = 1) {
		if ($this->get){

		} else if ($this->post){
			
		}
		echo "someone is looking for " .$designation. " " . $designation_id;
		
		
		$pictures = $this->Model('Picture')->all();
		$jsonPictures = json_encode($pictures);
		echo $jsonPictures;
		
	}
	

	//function to be used when the api for getting user accounts is in use.
	public function users() {
		echo 'user method entered. ';
		/*
		$method = $_SERVER['REQUEST_METHOD'];
		$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
		switch ($method) {
			case 'GET':
				read();
				break;
			default:
				echo 'Default switch case';
				break;
		}*/
		if($this->get){
			include_once(__DIR__ . '/../models/readuser.php');
			$dbarray = read(); 
			$userList_size = $dbarray[1];
			$userList = $dbarray[0];

			echo json_encode('size of userlist array: ' . $userList_size /*$userList->sizeof*/);
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
				$json = json_encode($users, JSON_PRETTY_PRINT);
				http_response_code(200);
				echo($json);
			} else {
				http_response_code(404); //find correct response code
				echo json_encode('no users found.');
			}
		} 

		
		
		
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