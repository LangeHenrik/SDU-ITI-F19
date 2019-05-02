<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 30-04-2019
 * Time: 11:26
 */

namespace controllers;
use core\Controller;
use models\AjaxModel;

class AjaxController extends Controller
{
    public function ajax_call(){
        $database = new AjaxModel();
        $result = $database->get_all_usernames();
        for ($x = 0; $x < sizeof($result); $x++) {
            echo "User: ";
            echo $result[$x]["username"];
            echo "<br>";
        }
    }
}
