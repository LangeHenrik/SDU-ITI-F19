<?php

class HomeController extends Controller {
	
	public function index ($param) {
		//This is a proof of concept - we do NOT want HTML in the controllers!
		echo '<br><br>Home Controller Index Method<br>';
		echo 'Param: ' . $param . '<br><br>';
	}
	
	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
		$user = $this->model('User');
		$user->name = $param1;
		$viewbag['username'] = $user->name;
		$this->view('home/index', $viewbag);
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
		
	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
}