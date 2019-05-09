<?php
require "../app/services/GalleryService.php";
require "../app/services/UserService.php";
require "../app/services/LoginService.php";

class ApiController extends Controller
{
    private $username;
    private $password;

    public function users()
    {
        $userService = new UserService();
        $users = $userService->APIGetUsers();
        $usersJSON = array();
        foreach ($users as $user) {

            $obj = new StdClass();
            $obj->user_id = $user->idUser;
            $obj->username = $user->uidUser;
            array_push($usersJSON, $obj);
        }
        echo json_encode($usersJSON);
    }

    public function pictures($var, $userIdPar2)
    {
        $galleryService = new GalleryService();
        $loginService = new LoginService();


        if ($this->get()) {
            $images = $galleryService->loadImageFromUser($userIdPar2);
            $imagesJSON = array();
            foreach ($images as $image) {
                $obj = new StdClass();
                $obj->image_id = $image->idGallery;
                $obj->title = $image->imageTitle;
                $obj->description = $image->imageDesc;
                $obj->image = "/sabah15/mvc/public/resources/gallery/" . $image->imageName;
                array_push($imagesJSON, $obj);
            }
            echo json_encode($imagesJSON);
        }

        if ($this->post()) {
            $json = json_decode($_POST["json"]);


            if ($loginService->login($json->username, $json->password)) {
                $pos = strpos($json->image,';');
                $type = explode('/', explode(':', substr($json->image,0,$pos))[1])[1];

                $imageFullName = "apiTest." . uniqid("", false) . "." . $type;

                $imagePath = "../public/resources/gallery/" . $imageFullName;

                $data = explode(',',$json->image);
                $content = base64_decode($data[1]);

                $galleryService->APIBase64ToPath($imagePath, $content);

                $imageId = $galleryService->APIImageUpload($_SESSION['userId'], $json->title,$json->description, $imageFullName);

                $obj = new StdClass();
                $obj->image_id = (int) $imageId;

                echo json_encode($obj);
            }

        }
    }

}