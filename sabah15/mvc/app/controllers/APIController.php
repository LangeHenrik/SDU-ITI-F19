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

}