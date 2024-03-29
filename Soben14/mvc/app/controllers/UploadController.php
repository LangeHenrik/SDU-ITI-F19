<?php

class UploadController extends Controller {
	
	public function index () {
		$this->view('upload/index');
	}
  public function upload () {
    $pictureTitleInput = htmlentities(filter_input(INPUT_POST, "pictureName", FILTER_SANITIZE_STRING));
    $pictureDescInput = htmlentities(filter_input(INPUT_POST, "pictureDesc", FILTER_SANITIZE_STRING));
    $isPicUploaded = isset($_FILES['image']);
    $this->model('Picture')->uploadPicture($pictureTitleInput, $pictureDescInput, $isPicUploaded);
  }
}
