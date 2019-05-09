<?php

class HomeController extends Controller {
	
	public function index () {
		$user = $this->model('User');
		$viewbag=[];
		$this->view('home/Index', $viewbag);
	}
	
	public function restricted () {
		echo 'Login to access this page';
	}
	
	public function logout() {
		
		if(! $this->post()) {
			session_unset();
			header('Location: michc15/mvc/public');
		} else {
			echo '';
		}
	}
}