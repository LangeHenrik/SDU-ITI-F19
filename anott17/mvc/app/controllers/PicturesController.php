<?php

class PicturesController extends Controller {

	// private $db;
	//
	// public function __construct() {
	// 	header('Content-Type: application/json');
	// 	$this->db = new Database();
	// }

	public function index () {

		$viewbag = $this->model('Picture')->getAllPictures();
		$this->view('picture/index', $viewbag);

	}

}
