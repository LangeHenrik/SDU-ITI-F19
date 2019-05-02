<?php
session_start();     
$_SESSION['logged_in'] = false;       
class HomeController extends Controller {
	
	public function index () { 
		$this->view('home/index');

		if(isset($_POST['login'])) 
		{
			$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
			$this->login($username, $password);
		}
	}

	public function login($username, $password) {
		$user = $this->model('User');
		if($user->login($username, $password)) 
		{
			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $user->getUserID();
			//header('Location: longu17/mvc/public/homepage');
			$URL = "/longu17/mvc/public/homepage";
			echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
		
		} else {
			//$URL = "/longu17/mvc/public/home";
			//echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			echo '<p style="color: red;">You have entered invalid use name and password </p>';
		}
	}
	
	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
		$user = $this->model('User');
		$user->setFirst_Name($param1);
		$user->setLast_Name($param2);
		$viewbag['firstName'] = $user->getFirst_Name();
		$viewbag['lastName'] = $user->getLast_Name();
		//$this->view('home/index', $viewbag);

	}
	
	public function restricted () {
		echo 'Welcome - you must be logged in';
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