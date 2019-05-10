<?php

class PictureController extends Controller {

	public function index ($param) {

	}

	public function all(){
		$viewbag['pictures'] = $this->model('Picture')->getAllPictures();
		$this->view('picture/all', $viewbag);
	}

}
