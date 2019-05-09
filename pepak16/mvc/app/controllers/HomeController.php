<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/core/Controller.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/models/User.php';


class HomeController extends Controller {

	private $user;
	
	// Personal note:
	// An issue i used hours to solve, was that when initializing any local scoped variable, it has to be written in this way:
	// e.g. $this->userObject = new User(); and not $this->$userObject = new User(); with the dollar sign, since it wont recognize it in that way.
	// Pretty weird though, as i thought i could just do the same as you would declare a variable, e.g. $variablename, but its different in this situation.
	
	public function __construct() {
	}

	public function index () {
		//This is a proof of concept - we do NOT want HTML in the controllers!
		// echo '<br><br>Home Controller Index Method<br>';
		// echo 'Param: ' . $param . '<br><br>';
		header('Location: app/views/home/index.php');
	}

	public function test() {
		echo "hej jeg hedder bjarke paludan!";
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
	
	public function login($username,$password) {
		$userObject = new User();
		if ($username != null && $password != null) {
			$userid = $userObject->getUserIdByUsername($username);
			$hashed_password = $this->getHashPassword($userid);
			if(password_verify($password, $hashed_password)) {
				if ($userid != null) {
					$_SESSION['logged_in'] = true;
					//$this->view('home/login');
					return $userid;
				} else {
					return null;
				}
			}
		} else {
			return null;
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

	public function changeMenuOptionTo($name) {
		switch ($name) {
			case "home":
				// $_SESSION["disable_searchbar"] = false;
				header('Location: /pepak16/mvc/public');
				break;
			case "searchPage":
				// $_SESSION["disable_searchbar"] = false;
				header('Location: /pepak16/mvc/app/views/home/search_page.php');
				break;
			case "showAllUsers":
				// $_SESSION["disable_searchbar"] = true;
				header('Location: /pepak16/mvc/app/views/home/list_of_all_users.php');
				break;
			case "login":
				header('Location: /pepak16/mvc/app/views/home/login.php');
				break;
			case "register":
				header('Location: /pepak16/mvc/app/views/home/register.php');
				break;
			case "logout":
				session_destroy();
				header('Location: /pepak16/mvc/public');
				break;
			default:
				break;
		}
	}

	public function showAllPosts() {
		// require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/models/User.php';
		$userObject = new User();
		return $userObject->fetchAllPosts();
	}

	public function register($username, $password, $phone, $email, $zipcode) {
		$userObject = new User();
		return $userObject->insertUser($username, $password, $phone, $email, $zipcode);
	}

	public function postAPicture($header,$desc,$url,$postbyid) {
		$userObject = new User();
        if ($userObject->insertPost($header,$desc,$url,$postbyid)) {
            return true;
        } else {
            return false;
        }
	}

	public function showAllUsers() {
		// require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/models/User.php';
		$userObject = new User();
		return $userObject->getUsers();
	}

	//private method
	private function getHashPassword($userid) {
		// require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/models/User.php';
		$userObject = new User();
		return $userObject->getHashedPasswordById($userid);
	}
	
}