<?php

class HomeController extends Controller {

	public function index () {
		$user = $this->model('User');
		$viewbag=[];
		$this->view('home/Index', $viewbag);
	}

	public function restricted () {
		echo 'Welcome - you must be logged in';
	}

	public function logout() {

		if(! $this->post()) {
			session_unset();
			header('Location: Asdoe17/mvc/public');
		} else {
			echo 'You can not only log out with a post method';
		}
	}

}
