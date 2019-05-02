<?php

class PictureController extends Controller {
		
	public function index(){
		$viewbag = $this->model('Picture')->getAllPictures();
		$this->view('picture/all', $viewbag);
	}

	public function uploadPicture(){
		$pictureTitle = 		filter_input(INPUT_POST,"pictureTitle", FILTER_SANITIZE_STRING);
		$pictureDescription = 	filter_input(INPUT_POST, "pictureDesc", FILTER_SANITIZE_STRING);
		$pictureLoaded = isset($_FILES['pictureFile']);
		$this->model('Picture')->uploadPicture($pictureTitle,$pictureDescription,$pictureLoaded);
	}

}