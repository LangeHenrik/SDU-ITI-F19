<?php

class HomeController extends Controller {
	
	public function index () {
		$this->view('home/index');
	}
	
	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
		$this->view('home/index');
	}
	
	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
	public function login() {
		$this->view('home/login');
	}
	
	public function loginAuth() {
		if ( ! empty( $_POST ) ) {
			if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
				//filter input variables
				$filteredUn = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
				$filteredPw = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
				// validate the input real quick
				if(!$this->validate($filteredUn,$filteredPw)){
					header("Location: login");
				} else {
					require_once('../app/core/Database.php');
					$conn = (new Database)->conn;
					//or die("Connect failed: %s\n". $conn -> error);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					// retrieve password using username
					$stmt = $conn->prepare("SELECT * FROM user WHERE username=:username");
					$stmt->bindParam(':username', $filteredUn);
					$stmt->execute();
					$temp = $stmt->fetch();
					$hashedPw = $temp['password_hash'];
					$userid = $temp['userid'];

					// Verify user password and set $_SESSION
					//if ( password_verify($_POST['password'],$hashedPw) ) {
					if ( password_verify($filteredPw,$hashedPw) ) {
						$_SESSION['username'] = $filteredUn;
						$_SESSION['user_id'] = $userid;
						$_SESSION['valid'] = true;
						$_SESSION['timeout'] = time();
						$_SESSION['logged_in'] = true;
						header("Location: ../home");
					} else {
						$_SESSION['error'] = "Wrong username or password.";
						session_unset();
						header("Location: login");
					}
				}
			}
		}
	}

	public function validate($u, $p) {
		require_once('../app/services/validationregex.php');
		if(!filter_var($u, FILTER_VALIDATE_REGEXP,array( // validate username
        "options" => array("regexp"=>$unR)))) {
			session_unset();
			$_SESSION['error'] = "Username not valid.";
			return false;
		} else if(!filter_var($p,FILTER_VALIDATE_REGEXP,array( // validate username
        "options" => array("regexp"=>$pwR)))) {
			session_unset();
			$_SESSION['error'] = "Password not valid";
			return false;
		} else {
			return true;
		}
	}
	
	public function logout() {
		if($this->post()) {
			session_unset();
			header('Location: ..');
		} else {
			echo 'You can only log out with a post method';
		}
	}
}
