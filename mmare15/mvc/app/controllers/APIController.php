<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 * Date: 09/05/2019
 * Time: 09.54
 */

namespace controllers;


class APIController
{

    public function users(){
        $apiModel = new APIModel();
        $id_and_usernames = $apiModel->id_and_usernames();
        echo json_encode($id_and_usernames);
    }

    public function pictures($nothing, $user_id){
        $apiModel = new APIModel();
        if ($this->post()) {
            $loginModel = new LoginModel();
            $json = $_POST["json"];
            $textArray = json_decode($json, true);
            $wholeimagestring = $textArray["image"];
            $title = $textArray["title"];
            $description = $textArray["description"];
            $username = $textArray["username"];
            $password = $textArray["password"];
            if (!$loginModel->login($username, $password)) {
                http_response_code(401);
                return;

            } else {
                $type = "string";
                $id = $apiModel->upload_picture_and_return_id($username, $wholeimagestring, $title, $description, $type);
                $postImageFormat = new post_image_format($id[0]["image_id"]);
                echo json_encode($postImageFormat, JSON_UNESCAPED_SLASHES);
            }

        } else {
            $temp_images = $apiModel->get_pictures_from_id($user_id);
            $imageService = new imageConverter();
            $images = $imageService->convertArray($temp_images);
            $all_nice_format = array();
            for ($x = 0; $x < sizeof($images); $x++) {
                $nice_format = new picture_format($images[$x]['image_id'], $images[$x]['title'], $images[$x]['description'], $images[$x]['imageString']);
                $all_nice_format[] = $nice_format;
            }
            echo json_encode($all_nice_format, JSON_UNESCAPED_SLASHES);
        }
    }

}