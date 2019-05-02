<?php

class UserController extends Controller {
	
	public function index () {
		$_SESSION['page'] = 'user';
		$this->view('user_page/user_page');
	}
	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
}