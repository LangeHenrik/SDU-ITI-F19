<?php

class ApiController extends Controller {
	
	public function __construct() {
		header("Content-Type: application/json, charset=UTF-8");
	}
	
	public function pictures ($designation = 'user', $designation_id = 1) {
		echo "someone is looking for " .$designation. " " . $designation_id;
		
		$pictures = $this->Model('Picture')->all();
		$jsonPictures = json_encode($pictures);
		echo $jsonPictures;
		
	}
	
	public function user() {
		
		if($this->post){
			
		} else {
			
		}
		
	}
	
	
}