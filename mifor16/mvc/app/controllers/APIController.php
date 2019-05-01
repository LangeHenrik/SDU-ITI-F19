<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 12:04
 */

namespace controllers;

use core\Controller;
use models\LoginModel;
use models\picture_format;
use models\post_image_format;
use models\UsersModel;
use services\ImageConversionService;

class APIController extends Controller
{
    public function users() {
        $userModel = new UsersModel();

        $users_in_system = $userModel->getUsersAndID();

        echo json_encode($users_in_system);
    }

    public function pictures($_, $user_id) {
        $usersModel = new UsersModel();
        if($this->post()) {
            $loginModel = new LoginModel();
            $json = $_POST["json"];
            $text = json_decode($json, true);

            $fullImage = $text["image"];
            $title = $text["title"];
            $description = $text["description"];
            $username = $text["username"];
            $password = $text["password"];

            if($loginModel->checkCredentials($username, $password)) {
                $type = "string";
                $id = $usersModel->upload_picture_and_return_id($username, $fullImage, $title, $description, $type);
                $formatPost = new post_image_format($id[0]["image_id"]);

                echo json_encode($formatPost, JSON_UNESCAPED_SLASHES);
            } else {
                echo json_encode(new post_image_format("why is this needed"));
                #return;
            }

        }else {
            #get pictures
            $userModel = new UsersModel();
            $imageService = new ImageConversionService();
            $resultbad = $userModel->getPicturesFromID($user_id);
            $result = $imageService->convertArray($resultbad);

            $formatted_stuff = array();
            for($item = 0; $item <= sizeof($result)-1; $item++) {
                $formatted = new picture_format($result[$item]['image_id'], $result[$item]['title'], $result[$item]['description'], $result[$item]['imageString']);
                $formatted_stuff[] = $formatted;
            }
            echo json_encode($formatted_stuff, JSON_UNESCAPED_SLASHES);
        }
    }
}
