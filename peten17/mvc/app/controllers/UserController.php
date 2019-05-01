<?php

class UserController extends Controller {
	
	// lists the list of users
	public function index () {
		$viewbag = $this->model('User')->getUsers();
		$this->view('user/getusers', $viewbag);
	}




	public function login () {
		if($this->model('User')->login($_POST['username'], $_POST['password'])){
			header('Location: /peten17/mvc/public/picture/all');
		} else {
			//echo "I don't think so!";
		}
	}

	
	
}