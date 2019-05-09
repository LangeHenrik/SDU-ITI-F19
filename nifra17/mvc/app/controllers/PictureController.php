<?php

class PictureController extends Controller {
	
	public function index(){
		
		$viewbag = $this->model('Picture')->getAllPictures();
		$this->view('picture/index', $viewbag);
	}
	
	/*public function index ($param) {
		
		$viewbag = $this->model('Picture')->getAllPictures();
		$this->view('picture/index', $viewbag);
		
	}
	
	public function all(){
		$viewbag['pictures'] = $this->model('Picture')->getAllPictures();
		$this->view('picture/all', $viewbag);
	}

}*/
}