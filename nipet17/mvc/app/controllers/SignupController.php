<?php

class SignupController extends Controller {

	public function index () {
		$this->view('signup/register');
	}

	public function register() {
		$this->model('Signup')->register($_POST["username"], $_POST['email'], $_POST['name'],
																												$_POST['password'], $_POST['password2'], $_POST['phone'],
																												 $_POST['zip'], $_POST['city']);
		 $this->view('signup/register');
	}

}
