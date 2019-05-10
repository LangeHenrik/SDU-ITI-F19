<?php

class UserController extends Controller {

	public function index () {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /mahes17/mvc/public/picture/all');
		} else {
			$this->view('user/login');
		}
	}

	public function login () {
		if($this->model('User')->login($_POST['username'], $_POST['password'])){
			header('Location: /mahes17/mvc/public/picture/all');
		} else {
			echo "Login failed!";
		}
	}

	public function logout () {
		session_unset();
		header('Location: /mahes17/mvc/public/user');
	}


}
