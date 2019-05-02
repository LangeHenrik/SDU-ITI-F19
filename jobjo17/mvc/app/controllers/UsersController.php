<?php
require_once('../app/models/user.php');
class UsersController extends Controller {
	
	public function index ($param) {
		if(isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true) {
		 $viewbag['users'] = (new User)->retrieveAll();
		 $this->view('users/index', $viewbag);
		} else {
			$_SESSION['error'] = "Please register/login to access other pages";
			header('Location: /jobjo17/mvc/public/home/');

		}

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

	
}