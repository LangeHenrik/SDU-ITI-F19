<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);
include $pathroot . '/omhaw16/mvc/app/core/Controller.php';
include $pathroot . '/omhaw16/mvc/app/models/User.php';   
// require $pathroot . '/omhaw16/mvc/app/core/User.php';

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
	
	public function login($username,$password) {

//		echo "Log in present";

		$_SESSION['login'] == 0;

//		echo " - Session set to 0";

		$objectOfUser = new User();
		
//		echo " - object of user initiated.";

		$setUser = $objectOfUser->login($username,$password);

//		echo " - user set.";

		if ($username != null && $password != null) {
//			echo " - they are not null";
			if ($objectOfUser->login($username,$password)) {
				$_SESSION['login'] == 1;
//				echo " - session set to 1";
				$this->view('home/login');
				echo "true";
				return true;
				$_SESSION['userName'] = $username;
			} else { 
//				echo " - posted info doesn't match db - ";
			}
		} else {
//			echo " - username & pass are null - ";
			return false;
		}
	}
	
	public function register($username,$password,$firstname,$lastname,$zip,$city,$phone,$email) {

		$_SESSION['login'] == 0;

//		echo " - Session set to 0";

		$objectOfUser = new User();
		
//		echo " - object of user initiated.";

		$setUser = $objectOfUser->register($username,$password,$firstname,$lastname,$zip,$city,$phone,$email);

			}
	


	public function logout() {
		
		if($this->post()) {
			session_unset();
			header('Location: /mvc/public/home/index.php');
		} else {
			echo 'You can only log out with a post method';
		}
	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
}