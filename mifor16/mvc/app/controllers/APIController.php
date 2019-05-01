<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 12:04
 */

namespace controllers;

use core\Controller;
use models\UsersModel;
use models\ApiGetImages;

class APIController extends Controller
{
    public function users() {
        $userModel = new UsersModel();

        $users_in_system = $userModel->getUsersAndID();

        echo json_encode($users_in_system);
    }

    public function pictures($_, $user_id) {
        header("Content-Type:application/json");
        if($this->post()) {
            #post a picture
        }else {
            #get pictures
            $userModel = new UsersModel();
            $result = $userModel->getPicturesFromID($user_id);
            $formatted_stuff = array();
            for($item = 0; $item <= sizeof($result)-1; $item++) {
                $image_id = $result[$item]['counter'];
                $title = $result[$item]['title'];
                $description = $result[$item]['description'];
                $blob_data = $result[$item]['blob_data'];
                //$image = imagecreatefromstring(base64_decode($images[$x]['image']));
                //ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                //imagejpeg($image, null, 80);
                //$data = ob_get_contents();
                //ob_end_clean();

                $formatted_stuff[] = new ApiGetImages($image_id, $title, $description, $blob_data);
            }
            #echo print_r($result);
            #echo print_r($formatted_stuff);
            echo json_encode($formatted_stuff);
        }
    }
}

//
//$image = imagecreatefromstring(base64_decode($images[$x]['image']));
//ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
//imagejpeg($image, null, 80);
//$data = ob_get_contents();
//ob_end_clean();
//$imageString = 'data:' .  $images[$x]['extension'] .  ';base64,' .  base64_encode($data);
//$nice_format = new picture_format($images[$x]['image_id'], $images[$x]['title'], $images[$x]['description'], $imageString);
//$all_nice_format[] = $nice_format;