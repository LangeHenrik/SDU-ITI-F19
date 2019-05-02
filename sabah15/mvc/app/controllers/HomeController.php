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
        $galleryService = new GalleryService();
        $images = $galleryService->loadImageFromUser($_SESSION['userId']);
        return $this->view("home/portfolio", array("images"=>$images));
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
            $galleryService = new GalleryService();
            $images = $galleryService->loadImages();
            return $this->view("home/index", array("images"=>$images) );
        }
        else {
            $galleryService = new GalleryService();
            $images = $galleryService->loadImages();
            return $this->view("home/index", array("images"=>$images) );
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

    public function addImage()
    {
        $newImage = new GalleryService();

        $userId = $_SESSION["id"];

        if ($this->post()) {
            $imageTitle = $_POST["title"];
            $imageDesc = $_POST["description"];
            $image = $_FILES["image"];

            $newImage->uploadImage($userId, $imageTitle, $imageDesc, $image);

            header("Location: /sabah15/mvc/public/home/");
        }
    }

    public function deleteImage($idGallery)
    {
        $galleryService = new GalleryService();
        $galleryService->deleteImage($idGallery);
    }


    public function test()
    {
        echo 'This is a test';
    }
}