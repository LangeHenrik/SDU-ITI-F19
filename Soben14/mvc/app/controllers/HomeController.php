<?php

class HomeController extends Controller {
	public function index () {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /soben14/mvc/public/picture/all');
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
		$firstNameInput = htmlentities(filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING));
		$lastNameInput = htmlentities(filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING));
		$zipInput = htmlentities(filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT));
		$cityInput = htmlentities(filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING));
		$phoneNumberInput = htmlentities(filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING));
		$emailAdressInput = htmlentities(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
		$this->model('User')->register($userNameInput, $passwordInput, $firstNameInput, $lastNameInput, $zipInput, $cityInput, $phoneNumberInput, $emailAdressInput);
	}
	public function logout () {
		session_unset();
		session_destroy();
		header('Location: /soben14/mvc/public/home');
	}
}