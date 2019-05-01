<?php

class UserController extends Controller {
	
	// public function index() {
	// 	//This is a proof of concept - we do NOT want HTML in the controllers!
	// 	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
	// 		header('location: /peten17/mvc/public/');
	// 	} else{
	// 		$this->view('user/login');
	// 	}
	
	// }

	public function index(){
		$viewbag = $this->model('User')->getUserList();
		$this->view('home/showusers',$viewbag);
	}


	// public function login(){
	// 	if($this->model('user')->login($_POST['username'],$_POST['password'])){
	// 		header("Location: /peten17/mvc/public/home/home");
	// 	}else{

	// 		header("Location:/peten17/mvc/public");
	// 		echo "Wrong username or password";

	// 	}

	// }

	// public function logout(){
	// 	$this->model('user')->logout();
	// 	header('location: peten17/mvc/public/');
		
	// }


	// public function showAll(){
	// 	$this->view('partials/headerHome');
	// 	$viewbag['userList'] = $this->model('user')->showUsers();
	// 	$this->view('home/showusers',$viewbag);
		
	

	// }

	// public function profile(){
	// 	$_SESSION['firstname'] = "Peter";
	// 	$this->view('partials/headerHome');
	// 	$this->view('home/profile');
	// 	$this->view('partials/footer');
		

	// }

	// public function registerUser(){
	// 	$this->view('home/registerUser');


	// }
		


}