<?php

class HomeController extends Controller {

	// public function index ($param) {
	// 	// if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
	// 	// 	header('Location: /anott17/mvc/public/picture/all');
	// 	// } else {
	// 	// 	$this->view('home/login');
	// 	// }
	//
	// 	//This is a proof of concept - we do NOT want HTML in the controllers!
	// 	echo '<br><br>Home Controller Index Method<br>';
	// 	echo 'Param: ' . $param . '<br><br>';
	// }
	//
	// public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
	// 	$user = $this->model('User');
	// 	$user->name = $param1;
	// 	$viewbag['username'] = $user->name;
	// 	$this->view('home/index', $viewbag);
	// }
	//
	// public function restricted () {
	// 	echo 'Welcome - you must be logged in';
	// }
	//
	// public function login() {
	// 	$_SESSION['logged_in'] = true;
	// 	$this->view('home/login');
	// }
	//
	// public function logout() {
	//
	// 	if($this->post()) {
	// 		session_unset();
	// 		header('Location: /mvc/public/home/loggedout');
	// 	} else {
	// 		echo 'You can only log out with a post method';
	// 	}
	// }
	//
	// public function loggedout() {
	// 	echo 'You are now logged out';
	// }
	public function index () {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /anott17/mvc/public/picture/all');
		} else {
			$this->view('home/index');
		}
	}

	public function login () {
		$userNameLogin = filter_input(INPUT_POST, "userNameLogin", FILTER_SANITIZE_STRING);
		$passwordLogin = filter_input(INPUT_POST, "passwordLogin", FILTER_SANITIZE_STRING);

		$this->model('User')->login($userNameLogin, $passwordLogin);
	}

	public function register () {
		$userNameInput = htmlentities(filter_input(INPUT_POST, "userName", FILTER_SANITIZE_STRING));
		$passwordInput = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$frontNameInput = htmlentities(filter_input(INPUT_POST, "frontName", FILTER_SANITIZE_STRING));
		$lastNameInput = htmlentities(filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING));
		$zipInput = htmlentities(filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT));
		$cityInput = htmlentities(filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING));
		$phoneNumberInput = htmlentities(filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING));
		$emailAdressInput = htmlentities(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));

		$this->model('User')->register($userNameInput, $passwordInput, $frontNameInput, $lastNameInput, $zipInput, $cityInput, $phoneNumberInput, $emailAdressInput);

	}

	public function logout () {
		session_unset();
		session_destroy();
		header('Location: /anott17/mvc/public/home');
	}

}
