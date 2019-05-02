<?php

class PictureController extends Controller {

	public function index ($param) {
header('Content-Type: Application/json');
	}

	public function all(){
		$viewbag['pictures'] = $this -> model('pictures')->getAllPictures();
		$this -> view('pictures/picture_site', $viewbag);
	}
	public function byUserId($id){
		$viewbag['pictures']= $this -> model('pictures')->getById($id);
		$this -> view('pictures/picture_site', $viewbag);
	}
public function upload(){
	$this -> model('pictures')->uploadPicture();

}
public function view_upload(){
	$this -> view('pictures/uploade_picture');
}
}
