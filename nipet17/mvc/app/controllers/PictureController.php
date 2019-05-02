<?php

class PictureController extends Controller {

	public function index () {
		$this->view('picture/upload');
	}

	public function all(){
		$viewbag['pictures'] = $this->model('Picture')->getAllPictures();
		$this->view('picture/all', $viewbag);
	}

	public function upload() {
		$this->model('Picture')->upload($_POST['header'], $_POST['text'], $_FILES["img"]["tmp_name"]);
		$this->view('picture/upload');
	}

	public function specific() {
		echo "string";
		$viewbag['specific'] = $this->model('Picture')->getAllPicturesSpecific($_GET['uname']);
		$this->view("picture/specific", $viewbag['specific']);
	}
}
