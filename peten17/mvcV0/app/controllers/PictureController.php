<?php

class PictureController extends Controller {
	
	public function index() {
		$this->view('home/login');
	}

	public function all(){
		$viewbag['pictures'] = $this->model('Picture')->getAllPictures();
		$this->view('home/home',$viewbag);
		
}
	public function byId($id){
		$viewbag['pictures'] = $this->model('Picture')->getPicById($id);
		$this->view('picture/all',$viewbag);

	
	}
	
}