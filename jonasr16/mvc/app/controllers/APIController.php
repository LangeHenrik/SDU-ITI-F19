<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 30-04-2019
 * Time: 13:12
 */

namespace controllers;


use core\Controller;
use models\APIModel;
use models\LoginModel;
use models\picture_format;
use models\HomeModel;
use models\post_image_format;

class APIController extends Controller
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
            $text = json_decode($json, true);
            $wholeimagestring = $text["image"];
            $title = $text["title"];
            $description = $text["description"];
            $username = $text["username"];
            $password = $text["password"];
            if (!$loginModel->login($username, $password)) {
                #http_response_code(401);
                return;
            } else {

                $explodedStringArray = explode(",", $wholeimagestring);
                $rest = $explodedStringArray[0];
                $image = $explodedStringArray[1];
                $explodedRestArray = explode(":", $rest);
                $close = $explodedRestArray[1];
                $explodedCloseArray = explode(";", $close);
                $type = $explodedCloseArray[0];
                $id = $apiModel->upload_picture_and_return_id($username, $image, $title, $description, $type);
                $postImageFormat = new post_image_format($id[0]["image_id"]);
                echo json_encode($postImageFormat, JSON_PRETTY_PRINT);
                #echo "<br>";

                #$response = new AddPostResponse($id);
                #echo json_encode($response);
            }
        } else {
            $images = $apiModel->get_pictures_from_id($user_id);
            $all_nice_format = array();
            for ($x = 0; $x < sizeof($images); $x++) {
                $image = imagecreatefromstring(base64_decode($images[$x]['image']));
                ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                imagejpeg($image, null, 80);
                $data = ob_get_contents();
                ob_end_clean();
                $imageString = 'data:' .  $images[$x]['extension'] .  ';base64,' .  base64_encode($data);
                $nice_format = new picture_format($images[$x]['image_id'], $images[$x]['title'], $images[$x]['description'], $imageString);
                $all_nice_format[] = $nice_format;
            }
            echo json_encode($all_nice_format, JSON_UNESCAPED_SLASHES);
        }
    }
}
