<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once $pathroot . '/mschm16/mvc/app/core/Controller.php';
require_once $pathroot . '/mschm16/mvc/app/models/User.php';
require_once $pathroot . '/mschm16/mvc/app/models/Pictures.php';

class HomeController extends Controller {

	public function __construct() {

	}
	
	public function index () {
		header ('Location: /mschm16/mvc/app/views/home/index.php');
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
		$_SESSION['login'] = '';
		if (!isset($_SESSION['login']) && $_SESSION['login'] == 1) {
			$_SESSION['login'] == 0;
		}
		$objectOfUser = new User();
		$setUser = $objectOfUser->login($username,$password);

		if ($username != null && $password != null) {
			if ($objectOfUser->login($username,$password)) {
				$_SESSION['login'] == 1;
				$this->view('home/login');
				echo "true";
				return true;
				$_SESSION['userName'] = $username;
			}
		} else {
			return false;
		}
	}
	
	public function register($username,$password,$firstname,$lastname,$zip,$city,$phone,$email) {
		if (!isset($_SESSION['login']) && $_SESSION['login'] == 1) {
			$_SESSION['login'] == 0;
		}
		$objectOfUser = new User();
		$setUser = $objectOfUser->register($username,$password,$firstname,$lastname,$zip,$city,$phone,$email);
	}

	public function getAllPosts() {
		$objectOfPics = new Pictures();
		$objectOfPics->getAllPosts();
	}

	public function getAllUsers() {
		$objectOfUser = new User();
		$objectOfUser->getAllUsers();
	}

	public function showAllUsers() {
		$objectOfUser = new User();
		$objectOfUser->showAllUsers();
	}

	public function getMyPosts($userID) {
		$objectOfPics = new Pictures();
		$objectOfPics->getMyPosts($userID);
	}

	public function showMyPosts($userID) {
		$objectOfPics = new Pictures();
		$objectOfPics->showMyPosts($userID);
	}

	public function uploadPic($postedby,$imgname,$imgtitle,$imgdesc) {
		$objectOfPics = new Pictures();
		$uploadPic = $objectOfPics->uploadPic($postedby,$imgname,$imgtitle,$imgdesc);
	}

	public function logout() {		
		if($this->post()) {
			session_unset();
			header('Location: /mschm16/mvc/public/home/index.php');
		} else {
			echo 'log out with post method';
		}
	}
	
	public function loggedout() {
		echo 'You are logged out';
	}
}