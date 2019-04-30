<?php
namespace controllers;
use core\Controller;
use models\HomeModel;

class HomeController extends Controller {

	public function index () {
        $home_service = new HomeModel();
        return $this->view("home/Home", array("pictures" => $home_service->get_20_posts()));
	}

	public function post_picture(){
	    $home_service = new HomeModel();
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                session_start();
                $username = $_SESSION['login_user'];
                $path = $target_file;
                $title = $_POST['title'];
                $description = $_POST['description'];
                $username_stripped = strip_tags($username,"<b>");
                $path_stripped = strip_tags($path,"<b>");
                $title_stripped = strip_tags($title,"<b>");
                $description_stripped = strip_tags($description,"<b>");
                $home_service->upload_picture($username_stripped, $path_stripped, $title_stripped, $description_stripped);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function get_pictures(){
        $home_service = new HomeModel();
        return $this->view("home/Home", array("pictures" => $home_service->get_20_posts()));
    }

    public function log_out(){
	    session_destroy();
        header("location: /jonasr16/mvc/public/home");
    }

















//	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
//		$user = $this->model('User');
//		$user->name = $param1;
//		$viewbag['username'] = $user->name;
//		$this->view('home/index', $viewbag);
//	}
//
//	public function restricted () {
//		echo 'Welcome - you must be logged in';
//	}
//
//	public function login() {
//		$_SESSION['logged_in'] = true;
//		$this->view('home/login');
//	}
//
//	public function logout() {
//
//		if($this->post()) {
//			session_unset();
//			header('Location: /mvc/public/home/loggedout');
//		} else {
//			echo 'You can only log out with a post method';
//		}
//	}
//
//	public function loggedout() {
//		echo 'You are now logged out';
//	}
	
}