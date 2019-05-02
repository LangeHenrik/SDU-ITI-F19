<?php

class UserController extends Controller {

	public function index () {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			$this->view('picture/');
		} else {
			$this->view('user/login');
		}
	}

	public function users() {
		$viewbag['usersAPI'] = $this->model('Api')->selectUsers($_GET['json']);
		$this->view('services/ApiService');
	}

	public function pictureUpload() {
		$this->model('Api')->uploadPicture($_POST['json']);
	}

	public function pictureSelect() {
		$viewbag['picturesAPI'] = $this->model('Api')->selectPictures($_GET['json']);
	}

}
