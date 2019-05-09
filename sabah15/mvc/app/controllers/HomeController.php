<?php
    require "../app/services/GalleryService.php";
    require "../app/services/UserService.php";
    require "../app/services/SignupService.php";
    require "../app/services/LoginService.php";

class HomeController extends Controller
{


    public function index()
    {
        $galleryService = new GalleryService();
        $images = $galleryService->loadImages();
        return $this->view("home/index", array("images"=>$images) );
    }

    public function portfolio() {
        if (isset($_SESSION['userId'])) {
            $galleryService = new GalleryService();
            $images = $galleryService->loadImageFromUser($_SESSION['userId']);
            return $this->view("home/portfolio", array("images" => $images));
        }
        else {
            return $this->view("home/portfolio");
        }
    }

    public function users(){
        $userService = new UserService();
        $users = $userService->getUsers();
        return $this->view("home/users", array("users"=>$users));
    }

    public function signup() {
        return $this->view("home/signup");
    }

    public function login() {
        $loginService = new LoginService();
        $mailuid = $_POST["mailuid"];
        $password = $_POST["pwd"];
        if ($loginService->login($mailuid, $password)) {
            header("Location: /sabah15/mvc/public/home/");
        }
        else {
            header("Location: /sabah15/mvc/public/home/");
        }

    }




    public function logout()
    {
        session_unset();
        session_destroy();
        $galleryService = new GalleryService();
        $images = $galleryService->loadImages();
        return $this->view("home/index", array("images"=>$images) );
    }

    public function uploadImage()
    {
        $newImage = new GalleryService();

        $userId = $_SESSION["userId"];

        if ($this->post()) {
            $imageTitle = $_POST["imagetitle"];
            $imageDesc = $_POST["imagedesc"];
            $image = $_FILES["image"];

            $newImage->uploadImage($userId, $imageTitle, $imageDesc, $image);

            header("Location: /sabah15/mvc/public/home/");
        }
    }

    public function deleteImage()
    {
        $galleryService = new GalleryService();
        if($galleryService->deleteImage($_POST["deleteId"])) {
            echo 1;
        }
        else {
            echo 0;
        }
        //header("Location: /sabah15/mvc/public/home/");
    }



    public function test()
    {
        echo 'This is a test';
    }
}