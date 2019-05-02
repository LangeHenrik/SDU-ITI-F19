<?php

class PostsController extends Controller {
		

	public function index () {
		//This is a proof of concept - we do NOT want HTML in the controllers!
		
		$picturemodel = $this->model("Picture");
		
		$viewbag['pictures'] = $picturemodel->getPictures(0);
		
		$this->view('posts/index', $viewbag);
		
	}
	
	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
		$user = $this->model('User');
		$user->name = $param1;
		$viewbag['username'] = $user->name;
		$this->view('posts/index', $viewbag);
	}
	
	public function loadpictures($offset = 0){
		
		$picturemodel = $this->model("Picture");

		
		$viewbag['pictures'] = $picturemodel->getPictures($offset);
		
		$this->view('partials/ajaxcaller',$viewbag);
	
				
	
	}
	
	public function login() {
		$_SESSION['logged_in'] = true;
		
	}

	
	
	public function upload_picture(){
		$this->view('posts/upload_picture');
	}
	
	public function upload(){
		
	$picturemodel = $this->model('Picture');
	$user_id = $_SESSION['user_id'];
	$image = tmlentities(filter_var($_POST["fileToUpload"], FILTER_SANITIZE_STRING));
	$pictureTitle = htmlentities(filter_var($_POST["pictitle"], FILTER_SANITIZE_STRING));
	$pictureDescription = htmlentities(filter_var($_POST["picture_description"], FILTER_SANITIZE_STRING));
		
	$picturemodel->postPicture($user_id, $image, $pictureTitle, $pictureDescription);
	}
}

