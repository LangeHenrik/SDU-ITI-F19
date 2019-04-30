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
use models\picture_format;

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

        } else {
            $images = $apiModel->get_pictures_from_id($user_id);
            $all_nice_format = array();
            for ($x = 0; $x < sizeof($images); $x++) {
                echo $images[$x]['datablob'];
                $picture = base64_encode($images[$x]['datablob']);
                $nice_format = new picture_format($images[$x]['id'], $images[$x]['title'], $picture, $images[$x]['description']);
                $all_nice_format[] = $nice_format;
            }
            echo json_encode($all_nice_format);
        }
    }
}