<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class UserPicApi {

	public function users2json($viewbag){
		$users = array();
	
		foreach($viewbag['users'] as $Persons) :
			$user = new Person($Persons['user_id'], $Persons['username']);
			array_push($users, $user);
		endforeach;

		$json = json_encode($users, JSON_PRETTY_PRINT);

		header('Content-Type: application/json');
		echo $json;
	}

	public function image2json($viewbag){

		$imageArray = array();
	
		foreach($viewbag['images'] as $Images) :
			$tempImg = new Img($Images['imagetmp'], $Images['header'], $Images['comm']);
			array_push($imageArray, $tempImg);
		endforeach;

		$json = json_encode($imageArray, JSON_PRETTY_PRINT);

		header('Content-Type: application/json');
		echo $json;
	}

}

class Person {
	public $user_id;
	public $username;

	public function __construct($user_id, $username){
		$this->user_id = $user_id;
		$this->username = $username;
	}
}

class Img {
	public $image;
	public $title;
	public $description;

	public function __construct($img, $header, $comm){
	
		$this->image = $img;
		$this->title = $header;
		$this->description = $comm;
	}
}

?>
