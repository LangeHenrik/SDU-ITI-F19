<?php

class UserController extends Controller
{

	public function index()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /mahes17/mvc/public/picture');
		} else {
			$this->view('user/login');
		}
	}

	public function login()
	{
		if ($this->model('User')->login($_POST['username'], $_POST['password'])) {
			header('Location: /mahes17/mvc/public/picture');
		} else {
			$this->view('user/login');
			echo "Wrong username or password! Try again.";
		}
	}

	public function logout()
	{
		session_unset();
		header('Location: /mahes17/mvc/public/user');
	}

	public function signUp()
	{
		$this->view('user/login');
		$error = "";

		$usernameRegex = "/^[a-z0-9_-]+$/i";
		$nameRegex = "/^[a-z ,.'-]+$/i";
		$numberRegex = "/^[0-9]+$/";
		$passwordRegex = "/^(?=.+\d).{8,}$/i";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//Checks if the entered username is empty / valid
			if (empty($_POST["username"])) {
				$error .= "Username required\n";
			} else if (!preg_match($usernameRegex, $_POST["username"])) {
				$error .= "Username contains illegal characters. Only letters, numbers, - and _ are allowed.\n";
			}
			//Checks if the entered password is empty / valid
			if (empty($_POST["password"])) {
				$error .= "Password required\n";
			} else if (!preg_match($passwordRegex, $_POST["password"])) {
				$error .= "Entered password is invalid. One upper case letter, one digit and at least 8 characters are required.\n";
			}
			//Checks if the repeated password is empty / matches the other password
			if (empty($_POST["passwordRepeat"])) {
				$error .= "Repeated password required\n";
			} else if ($_POST["passwordRepeat"] !== $_POST["password"]) {
				$error .= "Repeated password does not match the other password!\n";
			}
			//Checks if the firstname is empty / valid
			if (empty($_POST["firstName"])) {
				$error .= "First name required\n";
			} else if (!preg_match($nameRegex, $_POST["firstName"])) {
				$error .= "First name contains invalid characters. Only letters and following symbols are allowed: , . - '\n";
			}
			//Checks if the lastname is empty / valid
			if (empty($_POST["lastName"])) {
				$error .= "Last name required\n";
			} else if (!preg_match($nameRegex, $_POST["lastName"])) {
				$error .= "Last name contains invalid characters. Only letters and following symbols are allowed: , . - '\n";
			}
			//Checks if the zip code is empty / valid
			if (empty($_POST["zip"])) {
				$error .= "Zip code required\n";
			} else if (!preg_match($numberRegex, $_POST["zip"])) {
				$error .= "Zip code is invalid. Only numbers allowed.";
			}
			//Checks if the city is empty / valid
			if (empty($_POST["city"])) {
				$error .= "City name required\n";
			} else if (!preg_match($nameRegex, $_POST["city"])) {
				$error .= "City name contains invalid characters. Only letters and following symbols are allowed: , . - '\n";
			}
			//Checks if the email is empty / valid
			if (empty($_POST["email"])) {
				$error .= "E-mail required\n";
			} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
				$error .= "Entered e-mail address is not valid\n";
			}
			//Checks if the phone number is empty / valid
			if (empty($_POST["phoneNumber"])) {
				$error .= "Phone number required\n";
			} else if (!preg_match($numberRegex, $_POST["phoneNumber"])) {
				$error .= "Phone number is not valid. Only digits allowed.\n";
			}

			if (strlen($error) < 1) {
				if (!$this->model('User')->checkUsername($_POST["username"])) {
					$error .= "Username already exists\n";
				} else if (!$this->model('User')->checkEmail($_POST["email"])) {
					$error .= "Email already exists\n";
				}
			}

			if (strlen($error) < 1) {
				$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$this->model('User')->signUp($_POST['username'], $hashed_password, $_POST['firstName'], $_POST['lastName'], $_POST['zip'], $_POST['city'], $_POST['email'], $_POST['phoneNumber']);
			}

			echo nl2br($error);
			$error = "";
		}
	}
}
