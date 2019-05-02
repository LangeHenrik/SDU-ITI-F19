<?php

class AccountController extends Controller{
	
	
	public function Index(){
		return $this->view('account/index');
	}
	
	public function logout(){
		$_SESSION["logged_in"] = false;
		$_SESSION["user_id"] = -1;
		session_unset();
		
		header('Location: /mscho17/mvc/public/account');
		}

	public function login(){
	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

		$usermodel = $this->model('User');
		$result = $usermodel->authenticateUser2($username, $password);
		if($result > -1 ){
			if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
			$_SESSION["logged_in"] = true;
			$_SESSION["user_id"] = $result;
			
			header('Location: /mscho17/mvc/public/account/user');
		
		
		
	}
	}
	
	
	public function register(){
	$username = htmlentities(filter_var($_POST["username"], FILTER_SANITIZE_STRING));
	$password = htmlentities(filter_var($_POST["password"], FILTER_SANITIZE_STRING));
	$repeatPassword = htmlentities(filter_var($_POST["repeatPassword"], FILTER_SANITIZE_STRING));
	$userEmail = htmlentities(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
	$firstName = htmlentities(filter_var($_POST["firstName"], FILTER_SANITIZE_STRING));
	$lastName = htmlentities(filter_var($_POST["lastName"], FILTER_SANITIZE_STRING));
	$zipCode = htmlentities(filter_var($_POST["zipCode"], FILTER_SANITIZE_NUMBER_INT));
	$city = htmlentities(filter_var($_POST["city"], FILTER_SANITIZE_STRING));
	$phoneNumber = htmlentities(filter_var($_POST["city"], FILTER_SANITIZE_NUMBER_INT));
	
	
		$usermodel = $this->model('User');
	
		$result = $usermodel->registerUser($username, $password, $userEmail);
	
	header('Location: /mscho17/mvc/public/account');
		
	}
		
	public function user(){
		
		$usermodel = $this->model('User');
		
		$viewbag = $usermodel->getUsers();
		
		return $this->view('account/user', $viewbag);
	}	
	
	
}
