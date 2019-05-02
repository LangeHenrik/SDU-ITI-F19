<?php

class PicturesController extends Controller {

	public function index () {
		$_SESSION['page_name'] = "Pictures";

		$viewbag['pictures'] = $this->model('Picture') -> getAllPictures();
		$viewbag['users'] = $this->model('User') -> getAllUsersInfo();
		$viewbag['user'] = $this->model('User') -> getUserInfo();

		$this->view('pictures/index', $viewbag);
	}

}
