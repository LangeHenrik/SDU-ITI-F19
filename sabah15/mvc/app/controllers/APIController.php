<?php
require "../app/services/GalleryService.php";
require "../app/services/UserService.php";

class APIController extends Controller
{
    public function usersAPI()
    {
        $userService = new UserService();
        $users = $userService->getUsers();
        $usersJSON = array();
        foreach ($users as $user) {
            $usersJSON[] = new UserModel($user->username, $user->email, $user->firstname, $user->lastname, $user->telephone);
        }
        echo json_encode($usersJSON);
    }

    public function pictures($user, $userId) {
        $galleryService = new GalleryService();
        $images = $galleryService->loadImageFromUser($userId);
        $imagesJSON = array();
        foreach ($images as $image) {
            $obj = new StdClass();
            $obj->image_id = $image->idGallery;
            $obj->title = $image->imageTitle;
            $obj->description = $image->imageDesc;
            $obj->image = "/sabah15/mvc/public/resources/gallery/".$image->imageName;
            array_push($imagesJSON, $obj);
        }
        echo json_encode($imagesJSON);
    }

}