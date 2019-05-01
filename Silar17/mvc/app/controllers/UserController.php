<?php

class UserController extends Controller {
	
	public function index () {
		//This is a proof of concept - we do NOT want HTML in the controllers!
		$this->getImage4Users();
		$this->view('user/user');
	}
	
	public function getImage4Users() {
		$viewbag['names'] = $this->model('User')->getImage4User();
		$this->view('user/user', $viewbag);
	}

	public function getImage($index = 1){
		$this->model('User')->getImage($index);
	}
	public function userImage($user = -1){
		$this->model('User')->userImage($user);
	}

	public function checkUsername($username){
		$result = $this->model('CheckUsername')->check_username($username);
		print_r($result);
		return $result;
	}
	
}