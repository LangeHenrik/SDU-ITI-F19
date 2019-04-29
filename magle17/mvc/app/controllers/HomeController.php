<?php

class HomeController extends Controller {
	private $viewbag=[];
	public function index () {
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
			$this->view('home/index', $this->viewbag);
		}else{
			$this->login();
		}
	}

	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
	public function login() {
		$this->view('home/login', $this->viewbag);
	}

	public function doLogin(){
		$user = $this->model('User');
		$this->viewbag["loginMessage"]=$user->login();
		$this->index();
	}

	public function registerUser(){
		$user = $this->model('User');
		$user->registerUser();
		$this->index();
	}
	
	public function logout() {
		unset($_SESSION['loggedin']);
		if($this->post()) {
			session_unset();
			header('Location: /mvc/public/home/loggedout');
		} else {
			echo 'You can only log out with a post method';
		}
	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
}