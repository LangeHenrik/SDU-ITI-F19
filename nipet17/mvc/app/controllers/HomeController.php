<?php

class HomeController extends Controller {

	public function index () {

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
		$this->view('login/login');
	}

	public function logout() {

		if($this->post()) {
			session_unset();
			header('Location: /nipet17/mvc/public/home/loggedout');
		} else {
			echo 'You can only log out with a post method';
		}
	}

	public function loggedout() {
		echo 'You are now logged out';
	}

}
