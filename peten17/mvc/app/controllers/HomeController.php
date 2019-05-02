<?php

class HomeController extends Controller {
	
	public function index(){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /peten17/mvc/public/picture/all');
		} else {
			$this->view('user/login');
		}
	}

	public function login(){
		$username = filter_input(INPUT_POST, $_POST['username'], FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, $_POST['username'], FILTER_SANITIZE_STRING);
		$this->model('User')->login($username, $password);
	//	$this->view('picture/all');
	}

	public function register() {
		//filter_input(INPUT_POST,"pictureTitle", FILTER_SANITIZE_STRING);
		$username = 	filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
		$password = 	filter_input(INPUT_POST,"password", FILTER_SANITIZE_STRING);
		$password_conf =filter_input(INPUT_POST,"confirm_password", FILTER_SANITIZE_STRING);
		$firstname = 	filter_input(INPUT_POST,"firstname", FILTER_SANITIZE_STRING);
		$lastname = 	filter_input(INPUT_POST,"lastname", FILTER_SANITIZE_STRING);
		$zipcode = 		filter_input(INPUT_POST,"zipcode", FILTER_SANITIZE_STRING);
		$city = 		filter_input(INPUT_POST,"city", FILTER_SANITIZE_STRING);
		$email = 		filter_input(INPUT_POST,"email", FILTER_SANITIZE_STRING);
		$phonenumber =  filter_input(INPUT_POST,"phone", FILTER_SANITIZE_STRING);
		if($password == $password_conf){
			//echo "Passwords match";
		$this->model('User')->register($username, $password, $firstname, $lastname, $zipcode, $city, $email, $phonenumber);
		}else{
			echo "Passwords doesn't match!";
		}
	}

	public function profile(){
		$this->view('user/profile');
	}

	public function logout() {
		session_unset();
		session_destroy();
		header('Location: /peten17/mvc/public/home');
	}

	public function addPost(){
		$this->view('picture/uploadPicture');
	}

	
}