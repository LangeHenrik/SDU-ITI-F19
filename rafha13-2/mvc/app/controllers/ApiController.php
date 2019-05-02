<?php

class ApiController extends Controller {
	
	public function index () {

	}
    
    public function __construct() {
        header('Content-Type: application/json');
    }

	public function restricted () {
		echo 'Welcome - you must be logged in';
	}

	public function users () {
		$result = $this->service('getUsers')->users();
		print_r($result);
	}

	public function pictures ($user, $userID) {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$result = $this->service('postImage')->post($user, $userID);
			//echo 'should be post';
			print_r($result);
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$result = $this->service('postImage')->get($user, $userID);
			//echo 'should be get';
			print_r($result);
		}
	}
	


}