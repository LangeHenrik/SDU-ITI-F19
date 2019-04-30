<?php

class HomeController extends Controller {

	public function index () {
		$this->cleanUpResponses();

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /ernie17/mvc/public/pictures');
		} else {
			$this->view('home/index');
		}
	}

	public function login () {
		$inputUsername = filter_input(INPUT_POST, "login-username", FILTER_SANITIZE_STRING);
		$inputPassword = filter_input(INPUT_POST, "login-password", FILTER_SANITIZE_STRING);

		$this->model('User')->login($inputUsername, $inputPassword);
	}

	public function register () {
		$inputUsername = filter_input(INPUT_POST, "register-username", FILTER_SANITIZE_STRING);
		$inputPassword = filter_input(INPUT_POST, "register-password", FILTER_SANITIZE_STRING);
		$inputPasswordRepeat = filter_input(INPUT_POST, "register-password-repeat", FILTER_SANITIZE_STRING);
		$inputFirstname = filter_input(INPUT_POST, "register-firstname", FILTER_SANITIZE_STRING);
		$inputLastname = filter_input(INPUT_POST, "register-lastname", FILTER_SANITIZE_STRING);
		$inputZip = filter_input(INPUT_POST, "register-zip", FILTER_SANITIZE_NUMBER_INT);
		$inputCity = filter_input(INPUT_POST, "register-city", FILTER_SANITIZE_STRING);
		$inputEmail = filter_input(INPUT_POST, "register-email", FILTER_SANITIZE_EMAIL);
		$inputPhone = filter_input(INPUT_POST, "register-phone", FILTER_SANITIZE_NUMBER_INT);

		$this->model('User')->register($inputUsername, $inputPassword, $inputPasswordRepeat, $inputFirstname, $inputLastname, $inputZip, $inputCity, $inputEmail, $inputPhone);
	}

	public function logout () {
		session_unset();
		header('Location: /ernie17/mvc/public/home');
	}

	private function cleanUpResponses () {
		if (isset($_SESSION["loginResult"])) {
			unset($_SESSION["loginResult"]);
		}

		if (isset($_SESSION["registerResult"])) {
			unset($_SESSION["registerResult"]);
		}
	}

	/*public function index ($param) {
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

		if($this->post()) {
			session_unset();
			header('Location: /mvc/public/home/loggedout');
		} else {
			echo 'You can only log out with a post method';
		}
	}

	public function loggedout() {
		echo 'You are now logged out';
	}*/

}
