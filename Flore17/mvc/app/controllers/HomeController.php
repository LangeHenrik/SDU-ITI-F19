<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class HomeController extends Controller {
	
	public static function index () {
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
	
	public function loginCheck() {

		$match = $this->model('User')->checkPassword();

		if ($match == true) {
			$_SESSION['isLogged'] = true;
			$_SERVER['REQUEST_URI'] = 'localhost:8080/flore17/mvc/public/pictures/';
			$Router = new Router();
		} else {
			$_SESSION['passwordMismatch'] = true;
			$this->view('home/index');
		}
	}
	
	public function logout() {

		$_SESSION['username'] = '';
		$_SESSION['password'] = '';
		$_SESSION['isLogged'] = false;
		session_unset();
		$this->view('home/index');
	}

	
}
?>