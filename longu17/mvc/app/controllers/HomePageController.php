<?php

class HomePageController extends Controller {
	
	public function index() { 
		$user = $this->model('User');
		$viewbag = $user->getUploads();
		$this->view('homepage/homepage', $viewbag);
		
		if(isset($_POST['upload'])) 
		{
			$image = addslashes($_FILES['file']['tmp_name']);
			$name = addslashes($_FILES['file']['name']); // nødvendig? bruges ikke
			$image = file_get_contents($image);

			//$image = "data:image/jpeg;base64," . base64_encode($image);
			$image = base64_encode($image);
			$title = filter_var($_POST['title']);
			$desc = filter_var($_POST['description']);
			
			$this->uploadImage($image, $title, $desc);
		} 
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