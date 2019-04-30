<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class HomeController extends Controller {
	
	public static function index () {
		$this->view('home/index');
	}
	
	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
	public function loginCheck() {

		if ($_SESSION['isLogged'] == false && isset($_POST['username']) && isset($_POST['password'])){

			$match = $this->model('User')->checkPassword();

			if ($match == true) {
				$_SESSION['isLogged'] = true;
				$_SERVER['REQUEST_URI'] = 'localhost:8080/flore17/mvc/public/pictures/';
				$Router = new Router();
			} else {
				$_SESSION['passwordMismatch'] = true;
				$this->view('home/index');
			}
		} else {
			$_SERVER['REQUEST_URI'] = 'localhost:8080/flore17/mvc/public/pictures/';
			$Router = new Router();
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