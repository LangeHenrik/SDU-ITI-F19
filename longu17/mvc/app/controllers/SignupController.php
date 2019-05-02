<?php

class SignupController extends Controller {
	
	public function index() { 
		$this->view('signup/signup');
		
		if(isset($_POST['signup']))  //if signup button is clicked
		{
			$user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$pw = filter_var($_POST['password']);
			$rPw = filter_var($_POST['repeat-password']);
			$fName = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
			$lName = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
			$zip = filter_var($_POST['zip'], FILTER_SANITIZE_NUMBER_INT);
			$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			$phone = filter_var($_POST['phonenumber'], FILTER_SANITIZE_NUMBER_INT);

			$image = (addslashes($_FILES['file']['tmp_name']));
			
			if($image) 
			{
				$profileImage = file_get_contents($image);
			}
			//$profileImage = "data:image/jpeg;base64," . base64_encode($profileImage);
			$profileImage = base64_encode($profileImage);
			
			$this->signup($user, $pw, $rPw, $fName, $lName, $zip, $city, $email, $phone, $profileImage);
			//$this->uploadImage($image, $title, $desc);
		} 
	}

	public function signup($user, $pw, $rPw, $fName, $lName, $zip, $city, $email, $phone, $profileImage) {
		$register = $this->model('Register');
		$register->signup($user, $pw, $rPw, $fName, $lName, $zip, $city, $email, $phone, $profileImage);
	}

	public function uploadImage($image, $title, $desc) {
		$userID = $_SESSION['user_id'];
		$image = $image;
		$title = $title;
		$description = $desc;

		$user = $this->model('User');
		$user->upload($userID, $image, $title, $description);
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