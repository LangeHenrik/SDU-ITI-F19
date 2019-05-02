<?php    
class ProfileController extends Controller {
	
	public function index () { 
		$user = $this->model('User');
		$viewbag = $user->getCurrentUser($_SESSION['user_id']);
		$this->view('profile/profile', $viewbag);

		
	}

	public function login($username, $password) {
		$user = $this->model('User');
		if($user->login($username, $password)) 
		{
			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $user->getUserID();
			//header('Location: longu17/mvc/public/homepage');
			$URL="/longu17/mvc/public/homepage";
			echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
		
		} else {
			//$URL="/longu17/mvc/public/home";
			//echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			echo '<p style="color: red;">You have entered invalid use name and password </p>';
		}
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