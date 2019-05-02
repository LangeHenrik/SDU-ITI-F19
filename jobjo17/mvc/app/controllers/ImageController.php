<?php
require_once('../app/models/image.php');
class ImageController extends Controller {
	
	public function index ($param) {
		if(isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true) {
		 $viewbag['images'] = $this->model('image')->retrieveAll();
		 $this->view('image/index',$viewbag);
		} else {
			$_SESSION['error'] = "Please register/login to access other pages";
			header('Location: /jobjo17/mvc/public/app/home/');

		}
	}
	public function uploadPicture(){
		if(isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true) {
		if(isset($_FILES["image"])) {
		$imageData = file_get_contents($_FILES["image"]["tmp_name"]);
		$Image = new Image;
		$Image->create($_POST['title'],$_POST['description'],$_SESSION['user_id'],$imageData);
		$Image->upload();
		}
		$this->view('image/upload');
		} else {
			$_SESSION['error'] = "Please register/login to access other pages";
			header('Location: /jobjo17/mvc/public/app/home/');

		}


		
	}
	
	
}