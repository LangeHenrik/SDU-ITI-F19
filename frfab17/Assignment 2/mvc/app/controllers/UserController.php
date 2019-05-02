<?php

class UserController extends Controller
{

	public function index()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /frfab17/mvc/public/picture/all');
		} else {
			$this->view('user/login');
		}
	}

	public function login()
	{
		if ($this->model('User')->login($_POST['username'], $_POST['password'])) {
			header('Location: /frfab17/mvc/public/picture/all');
		} else {
			echo "I don't think so!";
		}
	}

	public function logout()
	{
		session_unset();
		header('Location: /frfab17/mvc/public/user');
	}

	public function register()
	{
		$this->view('user/login');
		$regex_fullname = "/[a-z|A-Z]{1,}\\s[a-z|A-Z]{1,}/";
		$regex_username = "/^[a-z0-9]+$/";
		$regex_password = "/^(?=.+\d).{8,}$/";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = $_POST["username"];
			$password = $_POST["password"];
			$fullname = $_POST["fullname"];
			$reenter = $_POST["newpass"];

			$isUsernameFilled = False;
			if (empty(!$username) && preg_match($regex_username, $username)) {
				$isUsernameFilled = True;
			} else {
				echo '<br> <div>Illegal characters in username</div>';
			}

			$isPasswordFilled = False;
			if (empty(!$password) && preg_match($regex_password, $password)) {
				$isPasswordFilled = True;
			} else {
				'<br> <div>Password must be 8 characters long</div>';
			}

			$isFullnameFilled = False;
			if (empty(!$fullname) && preg_match($regex_fullname, $fullname)) {
				$isFullnameFilled = True;
			}

			$isReenterFilled = False;
			if (empty(!$reenter) && $password == $reenter) {
				$isReenterFilled = True;
			} else {
				echo '<br> <div>Password is not the same</div>';
			}

			if ($isUsernameFilled && $isPasswordFilled && $isFullnameFilled && $isReenterFilled) {
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$this->model('User')->register($username, $hashed_password, $fullname);
			}
		}
	}
}
