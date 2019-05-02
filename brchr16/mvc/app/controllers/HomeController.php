<?php
require_once('../app/models/user.php');
class HomeController extends Controller {
	
	public function index ($param) {
		//This is a proof of concept - we do NOT want HTML in the controllers!
		//echo '<br><br>Home Controller Index Method<br>';
		//echo 'Param: ' . $param . '<br><br>';
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
		/*$_SESSION['logged_in'] = true;
		$this->view('home/login');*/
		
		
		if ( ! empty( $_POST ) ) 
{
	if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) 
	{
		$tempPw = (new User)->loginUser($_POST['username']);
		if ( $_POST['password'] == $tempPw ) 
		{
    		$_SESSION['user_id'] = (new User)->getUserID($_POST['username']);
			$_SESSION['valid'] = true;
			$_SESSION['logged_in'] = true;
			$_SESSION['timeout'] = time();
			 header("Location: /brchr16/mvc/public/image/");
			 
		}
		else 
		{
			session_destroy();
			header("Location: /brchr16/mvc/public/signup/");
			
		}
	}
}

	}
	
	public function signup() {
		if ( !empty( $_POST ) ) 
	{
		(new User)->createUser();
		$this->view('home/signup');
	}
	}
	
	public function logout() {
		
			session_unset();
			header('Location: /brchr16/mvc/public/home/');

	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
}