<?php

class HomeController extends Controller {
	
	public function index ($param) {
		Controller::view($param);
	}

	public function controller($param){
	    Controller::controllers($param);
    }
	
	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
		$user = $this->model('User');
		$user->name = $param1;
		$viewbag['username'] = $user->name;
		$this->view('index', $viewbag);
	}
	
	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
	public function login() {
		$_SESSION['logged_in'] = true;
		$this->view('home/login');
	}
	
	public function logout() {
        session_unset();
        header('Location: other');
	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
}