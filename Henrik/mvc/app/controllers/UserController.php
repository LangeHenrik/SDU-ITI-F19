<?php

class UserController extends Controller {
	
	public function index () {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /Henrik/mvc/public/picture/all');
		} else {
			$this->view('user/login');
		}
	}

	public function login () {
		if($this->model('User')->login($_POST['username'], $_POST['password'])){
			header('Location: /Henrik/mvc/public/picture/all');
		} else {
			echo "I don't think so!";
		}
	}

	public function logout () {
		session_unset();
		header('Location: /Henrik/mvc/public/user');
	}
	
	
}