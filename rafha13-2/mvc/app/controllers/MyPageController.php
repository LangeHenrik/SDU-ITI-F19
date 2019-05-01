<?php

class MyPageController extends Controller {
	
	public function index () {
		$_SESSION['page'] = 'mypage';
		$this->view('my_page/my_page');
	}

	public function restricted () {
		echo 'Welcome - you must be logged in';
	}

	public function change () {
		$this->model('Mypage')->changePicture();
	}

	public function delete () {
		$this->model('Mypage')->deleteUser();
	}

}