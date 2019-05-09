<?php
require_once('../app/models/Image.php');
class ImageController extends Controller {
	
	public function index ($param) {
		
		if ( isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true )
	{
	$viewbag['images']=(new Image)->listAllImages();
		$this->view('Images/Images', $viewbag);
	}
	else 
	{
	
	header('Location: /uojon16/mvc/public/home/');
			
	}	
	}
	public function upload() {
		if ( isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true )
	{
	(new Image)->uploadImage($_SESSION['user_id']);
		$this->view('Images/Images');
	}
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
		$_SESSION['logged_in'] = true;
		$this->view('home/login');
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