<?php

class UploadController extends Controller {
	
	public function index () {
		$this->view('upload/index');
	}
	
	public function upload () {
		$inputTitle = htmlentities(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
		$inputDescription = htmlentities(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING));
		$isPicUploaded = isset($_FILES['fileToUpload']);
		
		$this->model('Picture')->uploadPicture($inputTitle, $inputDescription, $isPicUploaded);
	}
	
	
}