<?php

class PicturesController extends Controller {

	// private $db;
	//
	// public function __construct() {
	// 	header('Content-Type: application/json');
	// 	$this->db = new Database();
	// }

	public function index () {
		$_SESSION['page_name'] = "Pictures";

		$viewbag['pictures'] = $this->model('Picture') -> getAllPictures();
		$viewbag['users'] = $this->model('User') -> getAllUsersInfo(); 
		$viewbag['user'] = $this->model('User') -> getUserInfo();

		$this->view('pictures/index', $viewbag);
	}

	public function all() {
		$viewbag['pictures'] = $this->model('Picture') -> getAllPictures();
		//$this->view('picture/all', $viewbag);

		echo 'all pictures go here!';
	}

}
