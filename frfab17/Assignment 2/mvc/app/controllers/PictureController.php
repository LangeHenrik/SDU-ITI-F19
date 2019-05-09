<?php

class PictureController extends Controller {
	
	public function index () {
		$viewbag['pictures'] = $this->model('Picture')->getAllPictures();
		$this->view('picture/all', $viewbag);
	}
	
	public function all(){
		$viewbag['pictures'] = $this->model('Picture')->getAllPictures();
		$this->view('picture/all', $viewbag);
	}

}