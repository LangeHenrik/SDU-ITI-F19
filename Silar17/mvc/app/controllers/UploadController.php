<?php

class UploadController extends Controller {
	
	public function index () {
		//This is a proof of concept - we do NOT want HTML in the controllers!
		
		$this->view('upload/upload');
	}
	
	public function preloadImage() {
		$this->model('User')->preloadImage();
		$_SESSION['preload'] = TRUE;
		header('location: /silar17/mvc/public/picture');
	}
	
	public function upload(){
		$this->model('User')->upload();
		header('location: /silar17/mvc/public/picture');
	}

	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
}