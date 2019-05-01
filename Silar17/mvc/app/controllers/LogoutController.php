<?php

class LogoutController extends Controller {
	
	public function index () {
		$this->logout();
	}
	
	public function logout() {
			session_unset();
			header('Location: /silar17/mvc/public/home');
	}   
}