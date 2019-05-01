<?php

class HomeController extends Controller {
	private $viewbag=[];
	public function index () {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
			//$this->view('home/index', $this->viewbag);
			header("Location: /magle17/mvc/public/Images/");
		}else{
			$this->login();
		}
	}
	
	public function login() {
		$this->view('home/login', $this->viewbag);
	}

	public function doLogin(){
		$user = $this->model('User');
		$this->viewbag["loginMessage"]=$user->login();
		$this->index();
	}

	public function registerUser(){
		$user = $this->model('User');
		$this->viewbag["registerMessage"]=$user->registerUser();
		$this->index();
	}
	
	public function logout() {
		session_unset();
		header('Location: /magle17/mvc/public/Home/');
	}
}