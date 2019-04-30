<?php

class UploadController extends Controller {

	public function index () {
		$_SESSION['page_name'] = "Upload";

		// $viewbag['pictures'] = $this->model('Picture') -> getAllPictures();
		// $viewbag['users'] = $this->model('User') -> getAllUsersInfo();
		$viewbag['user'] = $this->model('User') -> getUserInfo();

		$this->view('upload/index', $viewbag);
	}

    public function uploadPicture () {
        $userId = $this->model('User') -> getUserInfo()['userId'];

        $inputHeader = filter_input(INPUT_POST, "header", FILTER_SANITIZE_STRING);
        $inputDescription = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
        $isFileChosen = isset($_FILES['image-upload']);

        $this->model('Picture')->upload($inputHeader, $inputDescription, $isFileChosen, $userId);
    }

}
