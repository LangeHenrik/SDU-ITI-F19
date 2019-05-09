<?php
class UsersController extends Controller {
	
	public function index () {
		$user = $this->model('User');
		
		$viewbag['Users'] = $user->getUsers();
		
		$this->view('home/Users', $viewbag);
	}

}