<?php

class LoginController extends Controller {
	
	public function index ($param) {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /raglu16/mvc/public/home/');
		} else {
			$this->view('login/index');
		}
	}
	
}