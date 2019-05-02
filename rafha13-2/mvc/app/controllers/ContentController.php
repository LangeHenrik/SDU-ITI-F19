<?php

class ContentController extends Controller {
	
	public function index () {
		//$content = $this->model('Content')->loadContent();
		$_SESSION['page'] = 'content';
        $this->view('content_page/content_page');
	}

	public function restricted () {
		echo 'Welcome - you must be logged in';
	}

	public function create () {
		$this->model('Content')->createPost();
	}
}