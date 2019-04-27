<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class PicturesController extends Controller {

	public static function index () {
		$this->getPosts();
		$this->view('pictures/Pictures');
	}

	public function getPosts(){
		$viewbag['posts'] = $this->model('Picture')->getAllPosts();
		$_SESSION['posts'] = $viewbag['posts'];
		$this->view('pictures/Pictures', $viewbag);
	}

	public function makePost(){
		$this->model('Picture')->uploadPic();
		$this->getPosts();
	}

}
?>