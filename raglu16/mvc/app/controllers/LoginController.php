<?php

class LoginController extends Controller {
	
	public function index ($param) {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			$this->view('home/index/');
		} else {
			$this->view('login/index/');
		}
	}
	
}