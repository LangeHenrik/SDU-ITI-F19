<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:34
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
