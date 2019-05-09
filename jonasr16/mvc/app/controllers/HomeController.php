<?php
namespace controllers;
use core\Controller;
use models\HomeModel;
use services\imageConverter;

class HomeController extends Controller {

	public function index () {
        $homeModel = new HomeModel();
        $imageService = new imageConverter();
        $posts = $homeModel->get_20_posts();
        $newArray = $imageService->convertArray($posts);
        return $this->view("home/home", array("pictures" => $newArray));
	}


	public function post_picture(){
	    $homeModel = new HomeModel();
        $imageService = new imageConverter();
        $posts = $homeModel->get_20_posts();
        $newArray = $imageService->convertArray($posts);
	    $type = $_FILES["fileToUpload"]["type"];
        $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if(!$check) {
                return $this->view("home/Home", array("pictures" => $newArray, "error_msg" => "File is not an image."));
            }
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return $this->view("home/Home", array("pictures" => $newArray, "error_msg" => "Sorry, only JPG, JPEG, & PNG files are allowed."));
        }
        $username = $_SESSION['login_user'];
        $data = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $username_stripped = strip_tags($username,"<b>");
        $title_stripped = strip_tags($title,"<b>");
        $description_stripped = strip_tags($description,"<b>");
        $type_stripped = strip_tags($type, "<b>");
        $homeModel->upload_picture($username_stripped, $data, $title_stripped, $description_stripped, $type_stripped);

        header("location: /jonasr16/mvc/public/");
        return;
    }

    public function log_out(){
	    session_destroy();
        header("location: /jonasr16/mvc/public/login");
    }
}