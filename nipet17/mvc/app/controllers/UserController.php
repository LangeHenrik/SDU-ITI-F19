<?php

class UserController extends Controller {

	public function index () {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			$this->view('picture/');
		} else {
			$this->view('user/login');
		}
	}

	public function login () {
		if($this->model('User')->login($_POST["username"], $_POST["password"])){
			header('Location: /nipet17/mvc/public/picture/');
		} else {
			$this->view('user/login');
		}
	}

	public function logout() {
		session_unset();
		header('Location: /nipet17/mvc/public/user/');
	}

	public function all() {
		$this->model('User')->getAllUsers();
		$viewbag['users'] = $this->model('User')->getAllUsers();
		$this->view('user/all', $viewbag);
	}
}
