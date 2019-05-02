<?php

require_once '../app/models/User.php';

class UserController extends Controller {

	public function index() {
        if(isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true) {
			$viewbag['users'] = $this->model('User')->getUsers();
			$this->view('user/index', $viewbag);
        } else {
            header('Location: home');
        }
	}
	
	public function create() {
		$this->view('user/create');
	}

	public function save() {
		if ( ! empty( $_POST ) ) {
			if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) && isset( $_POST['firstname'] ) && isset( $_POST['lastname'] )
				&& isset( $_POST['zip'] ) && isset( $_POST['city'] ) && isset( $_POST['email'] ) && isset( $_POST['number'] ) ) {
				// sanitize and then validate data
				if($this->validate()) {
					require_once('../app/core/Database.php');
					$conn = (new Database)->conn;
					//or die("Connect failed: %s\n". $conn -> error);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					// check if username already exists
					$stmt = $conn->prepare("SELECT userid FROM user WHERE username =:username");
					$stmt->bindParam(':username',$_POST['username']);
					$stmt->execute();
					if(!$stmt->rowcount() < 1) {
						$_SESSION['error'] = "Username already exists";
						header("Location: create");
					}

					// insert user data
					$st = $conn->prepare("INSERT INTO user(username, password_hash, firstname, lastname, zip, city, email, number)
						VALUES(:username, :password, :firstname, :lastname, :zip, :city, :email, :number)");
					$st->bindParam(':username', $_POST['username']);
					$hashedPw = password_hash($_POST['password'],PASSWORD_DEFAULT);
					$st->bindParam(':password', $hashedPw);
					$st->bindParam(':firstname', $_POST['firstname']);
					$st->bindParam(':lastname', $_POST['lastname']);
					$st->bindParam(':zip', $_POST['zip']);
					$st->bindParam(':city', $_POST['city']);
					$st->bindParam(':email', $_POST['email']);
					$st->bindParam(':number', $_POST['number']);
					$st->execute();
					$_SESSION['error'] = "Registration successful";
					header("Location: ../home");
				} else {
					header("Location: create");
				}
			}
		}
	}

	public function validate() {
		require_once('../app/services/validationregex.php');
		$_POST['email'] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
		$_POST['username'] = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
		$_POST['password'] = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
		$_POST['repeatPassword'] = filter_var($_POST['repeatPassword'],FILTER_SANITIZE_STRING);
		$_POST['firstname'] = filter_var($_POST['firstname'],FILTER_SANITIZE_STRING);
		$_POST['lastname'] = filter_var($_POST['lastname'],FILTER_SANITIZE_STRING);
		$_POST['zip'] = filter_var($_POST['zip'],FILTER_SANITIZE_NUMBER_INT);
		$_POST['city'] = filter_var($_POST['city'],FILTER_SANITIZE_STRING);
		$_POST['number'] = filter_var($_POST['number'],FILTER_SANITIZE_NUMBER_INT);
		// Validation
		if($password === $repeatPassword) {	
			if(!filter_var($_POST['username'], FILTER_VALIDATE_REGEXP,array(
			"options" => array("regexp"=>$unR)))) {
				$_SESSION['error'] = "Username not valid.";
			return false;
			} else if(!filter_var($_POST['password'],FILTER_VALIDATE_REGEXP,array(
			"options" => array("regexp"=>$pwR)))) {
				$_SESSION['error'] = "Password not valid";
			return false;
			} else if(!filter_var($_POST['firstname'],FILTER_VALIDATE_REGEXP,array(
			"options" => array("regexp"=>$nameR)))) {
				$_SESSION['error'] = "First name not valid";
			return false;
			} else if(!filter_var($_POST['lastname'],FILTER_VALIDATE_REGEXP,array(
			"options" => array("regexp"=>$nameR)))) {
				$_SESSION['error'] = "Last name not valid";
			return false;
			} else if(!filter_var($_POST['zip'],FILTER_VALIDATE_REGEXP,array(
			"options" => array("regexp"=>$zipR)))) {
				$_SESSION['error'] = "Zip code not valid";
			return false;
			}else if(!filter_var($_POST['city'],FILTER_VALIDATE_REGEXP,array(
				"options" => array("regexp"=>$cityR)))) {
				$_SESSION['error'] = "City not valid";
			return false;
			}else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
				$_SESSION['error'] = "Email not valid.";
			return false;
			}else if(!filter_var($_POST['number'],FILTER_VALIDATE_REGEXP,array(
			"options" => array("regexp"=>$phoneR)))) {
				$_SESSION['error'] = "Phone number not valid";
			return false;
			} else {
				return true;
			}
		} else {
			$_SESSION['error'] = "Passwords do not match.";
			return false;
		}
	}

}
