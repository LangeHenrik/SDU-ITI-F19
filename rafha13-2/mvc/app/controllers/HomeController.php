<?php

class HomeController extends Controller {
	
	public function index () {
		$this->view('login_page/login_page');
	}

	public function logout () {
		unset($_SESSION['logged_in']);
		
		echo 'You have cleaned session';
		header('Location: /rafha13-2/mvc/public');
	}

	/*
	public function index2 () {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /Henrik/mvc/public/pictures/all');
		} else {
			$this->view('home/login');
		}
	}
	*/

}