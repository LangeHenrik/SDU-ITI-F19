<?php

class PictureController extends Controller {
		
	public function index(){
		$viewbag = $this->model('Picture')->getAllPictures();
		$this->view('picture/all', $viewbag);
	}

	public function uploadPicture(){
		$pictureTitel = filter_input(INPUT_POST,$_POST['pictureTitel'],FILTER_SAINITIZE_STRING);
		$pictureDescription = filter_input(INPUT_POST,$_POST['pictureDescription'],FILTER_SAINITIZE_STRING);
		$this->model('Picture')->uploadPicture($pictureTitel,$pictureDescription);
	}

}