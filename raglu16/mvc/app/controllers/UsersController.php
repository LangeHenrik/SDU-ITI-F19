<?php

class UsersController extends Controller {
	
	public function index () {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			$this->view('users/index');
		} else {
			header('Location: /raglu16/mvc/public/login/');
		}
	}
	
}