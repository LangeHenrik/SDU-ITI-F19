<?php

require_once '../app/models/User.php';

class HomeController extends Controller {
	
	public function index () {
		// unset($_SESSION['ID']);
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
		if($this -> isPost()) {
			$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$password = $_POST['password'];

			$username = htmlentities($username);
			$password = htmlentities($password);

			if(!empty($username) && !empty($password)) {
				try {
					$id = User::login($username, $password);

					if($id != null) {
						$_SESSION['ID'] = $id;
						$_SESSION['USERNAME'] = $username;
						header('Location: dashboard');
					} else {
						$_SESSION['MESSAGE'] = 'Username and Password do not match.';
						header('Location: ../');
					}
				} catch (PDOException $e) {
					$_SESSION['MESSAGE'] = 'Error: ' . $e -> getMessage();
					header('Location: ../');
				}
			} else {
				$_SESSION['MESSAGE'] = 'Atleast one field is empty!';
				header('Location: ../');
			}
		}
	}

	public function register() {
		if($this -> isPost()) {
			$user = new User();
			
			$user -> name = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$user -> password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
			$user -> firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
			$user -> lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
			$user -> zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_STRING);
			$user -> city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
			$user -> email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
			$user -> phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
		
			$user -> name = htmlentities($user -> name);
			$user -> password = htmlentities($user -> password);
			$user -> firstname = htmlentities($user -> firstname);
			$user -> lastname = htmlentities($user -> lastname);
			$user -> zip = htmlentities($user -> zip);
			$user -> city = htmlentities($user -> city);
			$user -> email = htmlentities($user -> email);
			$user -> phone = htmlentities($user -> phone);

			$repeat_password = filter_input(INPUT_POST, "repeat_password", FILTER_SANITIZE_STRING);
			$repeat_password = htmlentities($repeat_password);

			if($user -> isEmpty()) {
				$_SESSION['MESSAGE'] = 'One field is empty!';
			} else if($user -> password !== $repeat_password) {
				$_SESSION['MESSAGE'] = 'Passwords do not match!';
			} else {
				$user -> password = password_hash($user -> password, PASSWORD_DEFAULT);

				try {
					$registered = User::register($user);

					if($registered) {
						$_SESSION['MESSAGE'] = $user -> name . ' is now registered!';
					} else {
						$_SESSION['MESSAGE'] = 'Something went wrong.. Try again.';
					}
				} catch(PDOException $e) {
					$_SESSION['MESSAGE'] = 'Error: ' . $e -> getMessage();
				}
			}

			header('Location: ../');
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
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
}