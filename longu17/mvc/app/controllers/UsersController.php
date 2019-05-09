<?php    
class UsersController extends Controller {
	
	public function index() { 
		$user = $this->model('User');
		$viewbag = $user->getAllProfiles();
		
		$this->view('users/users', $viewbag);
	}

	public function search($char) {
		$user = $this->model('User');
		//$viewbag = $user->getAllProfiles();
		$viewbag = $user->searchUser($char);
		//print_r($viewbag);
		
		$this->view('users/user-search', $viewbag);
	}

	public function logout() {
		
		if($this->post()) {
			session_unset();
			session_destroy();
			header('Location: home');
		} else {
			echo 'You can only log out with a post method';
		}
	}
	
}