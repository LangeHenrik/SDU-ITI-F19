<?php

class ApiController extends Controller {
	
	public function index () {

	}
	
	public function __construct(){
		header('Content-Type: application/json');
	}

	public function users() {
		$result = $this->service('userAPI')->users();
		print_r($result);
	}

	public function pictures($user = dommy, $image_id = -1){
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			$result = $this->service('imageAPI')->post();
			print_r ($result);
			
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$result = $this->service('imageAPI')->get($user, $image_id);
			print_r($result);
		}
	
	}


	
}