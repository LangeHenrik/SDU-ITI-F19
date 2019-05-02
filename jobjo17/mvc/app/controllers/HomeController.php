<?php
require_once('../app/models/LoginUser.php');
require_once('../app/models/User.php');
class HomeController extends Controller {
	
	public function index ($param) {
		$this->view('home/index');
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
		
		$loginUser = new LoginUser;
		$loginUser->create($_POST['username'],$_POST['password']);
		if($loginUser->login() == false) {
			header('Location: /jobjo17/mvc/public/home/');
		} else {
			header('Location: /jobjo17/mvc/public/users/');
		}

		$_SESSION['logged_in'] = true;
		//$this->view('home/login');
	}
	
	public function logout() {
		
			session_unset();
			header('Location: /jobjo17/mvc/public/home/');
	}
	
	public function register() {

		$this->view('home/register');
	}
	public function registerUser() {
		$tempUser = new User();
		$tempUser->first_name = $_POST['firstname'];
		$tempUser->last_name = $_POST['lastname'];
		$tempUser->user_name = $_POST['username'];
		$tempUser->password = $_POST['password'];
		$tempUser->zip = $_POST['zip'];
		$tempUser->city = $_POST['city'];
		$tempUser->email = $_POST['email'];
		$tempUser->phone = $_POST['phonenumber'];
		$tempUser->register();
		
		$this->view('home/index');
	}
	
}












