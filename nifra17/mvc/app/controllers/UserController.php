<?php

class UserController extends Controller {
	
	public function index() {
		$viewbag = $this->model('User')->getAllUsers();
		$this->view('getusers/index', $viewbag);
		
	}
	
	/*public function index () {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /nifra17/mvc/public/picture/all');
		} else {
			$this->view('user/login');
		}
	}*/

	/*public function login () {
		if($this->model('User')->login($_POST['username'], $_POST['password'])){
			header('Location: /nifra17/mvc/public/picture/all');
		} else {
			echo "I don't think so!";
		}
	}*/

	/*public function logout () {
		session_unset();
		header('Location: /nifra17/mvc/public/user');
	}*/
	
	public function getPictureAjax($input) {
	  $request = $input."%";
		$result = $this->model('User')->getUserPictures($request);
		
		echo '<div class="boxInside">';
		foreach($result as $value){
		
	
		
		echo '<form>';
		echo '<fieldset>';
		echo '<h2>' . [$value]['title'] . '</h2>';
		echo '<h5>' . 'Submitted by: ' .[$value]['username']. '</h5>';
		echo '<div class="resize">';
		echo '<img src="' .[$value]['image']. '"/>';
		echo '</div>';
		echo '<h4>' . 'Description:' . '</h4>' . [$value]['description'];
		echo '</form>';
		echo '</fieldset>';
	
		echo '</div>';

	
	}
	echo '</div>';


	
	
	}
}

