<?php

class LoginController extends Controller {
	
	public function index ($param = null) {
		require_once "../app/models/User.php";
		
		$this->view("login/Login");
	}
	function __construct () {
		require_once "../app/models/User.php";
	}	
	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
	public function login() {
		
		if(isset($_POST['submit']) && strlen($_POST["login"])>0 && User::authenticate($_POST['login'], $_POST['password'])) {
			$_SESSION["user_name"] = $_POST['login'];
			header('Location: ../home', true, 302);
			die();
		} else if (isset($_POST['submit'])) {
			header('Location: ..', true, 302);
			echo "Wrong username or password!";
		}
	}
	
	public function logout() {
		
		if($this->post()) {
			session_unset();
			header('Location: /mvc/public/home/loggedout');
		} else {
			echo 'You can only log out with a post method';
		}
	}
	
	public function register() {
		$this->view("login/Register");
	}
	
	public function registerUser() {
		if($this->post()) {
			$username = $_POST['login'];
			$password = $_POST['password'];
			$firstName = $_POST['first_name'];
			$lastName = $_POST['last_name'];
			$zip = $_POST['zip'];
			$city = $_POST['city'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			
			User::registerUser($username, $password, $firstName, $lastName, $zip, $city, $email, $phone);
			
			
			$authenticated = User::authenticate($username, $password);
			
			
			if($authenticated) {
				header('Location: ..', true, 302);
				die();
			}
		}
	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
}



