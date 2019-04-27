<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class UsersController extends Controller {

	public static function index () {
		$this->getUsers();
		$this->view('users/Users');
	}

	public function getUsers() {
		$viewbag['users'] = $this->model('User')->getAllUsers();
		$this->view('users/Users', $viewbag);
	}

	public function makeUser() {
		$this->model('User')->createUser();
		$this->view('home/index');
	}

}
?>