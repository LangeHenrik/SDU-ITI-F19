<?php

class PictureController extends Controller {
	
	public function index() {
		$this->getImage4Picture();
		$this->view('picture/picture', $viewbag);
	}
	
	public function getImage4Picture() {
		$viewbag['data'] = $this->model('User')->getImage4Picture();
		$this->view('picture/picture', $viewbag);
	}

	public function getImage($index = 1){
		$this->model('User')->getImage($index);
	}

}