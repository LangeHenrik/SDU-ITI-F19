<?php
class LoginController extends Controller {
	
	public function index () {
		$viewbag['userbox_correct'] = true;
		$viewbag['passwordbox_correct'] = true;
		$viewbag['username'] = "";
		
		$this->view('home/Login', $viewbag);
	}
	
	public function login() {
		$viewbag['userbox_correct'] = true;
		$viewbag['passwordbox_correct'] = true;
		$viewbag['username'] = "";
		
		if($this->post()) {
			$entered_username=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$entered_password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
	
			$user = $this->model('User');
			
			$user_id = $user->getID($entered_username);
	
			if (!empty($user_id)){
				$hashed_password = $user->getPassword($entered_username);
				if (password_verify($entered_password, $hashed_password)) {
					$_SESSION['logged_in'] = true;
					$_SESSION['username'] = $entered_username; 
					$_SESSION['userid'] = $user_id; 
					header("Location: /michc15/mvc/public/Posts");
				} else {
					$viewbag['passwordbox_correct'] = false;
					$viewbag['username'] = $entered_username;
				}
			} else {
				$viewbag['userbox_correct'] = false;
			}
			
		}
		$this->view('home/Login', $viewbag);
	}
}
?>	