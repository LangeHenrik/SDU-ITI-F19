<?php

class HomeController extends Controller {
	
	public function index ($param) {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			$this->view('home/index');
		} else {
			header('Location: /raglu16/mvc/public/login/');
		}
	}
	
}