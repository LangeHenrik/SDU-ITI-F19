<?php

class HomeController extends Controller
{

	public function index()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /mahes17/mvc/public/picture');
		} else {
			$this->view('home/index');
		}
	}

	public function other($param1 = 'first parameter', $param2 = 'second parameter')
	{
		$user = $this->model('User');
		$user->name = $param1;
		$viewbag['username'] = $user->name;
		$this->view('home/index', $viewbag);
	}

	public function restricted()
	{
		echo 'Welcome - you must be logged in';
	}

	public function login()
	{
		$_SESSION['logged_in'] = true;
		$this->view('home/login');
	}

	public function logout()
	{

		if ($this->post()) {
			session_unset();
			header('Location: /mvc/public/home/loggedout');
		} else {
			echo 'You can only log out with a post method';
		}
	}

	public function loggedout()
	{
		echo 'You are now logged out';
	}
}
