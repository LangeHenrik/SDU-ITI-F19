<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 24-04-2019
 * Time: 09:02
 */

include_once($_SERVER['DOCUMENT_ROOT'] . "/Jejoe16/Core/database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Jejoe16/Models/UserModel.php");

class Users
{

    public function getUsers()
    {

        $usersl = getallusers();

        for ($x = 0; $x < sizeof($usersl); $x++) {

            echo '<div class="containerInside">';
            echo $usersl[$x]['username'];
            echo '</div>';
        }
    }

    public function getApiUsers()
    {
        $usersl = getallusers();

        $user = array();

        for ($x = 0; $x < sizeof($usersl); $x++) {
            array_push($user, ["user_id" => $usersl[$x]['uuid'], "username" => $usersl[$x]['username']]);
        }

        $myjson = json_encode(array_values($user));

        echo $myjson;
    }

    public function getimageFromID($id)
    {

        $pictures = getDetailsFromID($id);
        //print_r($pictures);
        $images = array();

        for ($i = 0; $i < sizeof($pictures); $i++) {

            $imagepath = substr($pictures[$i]['imagepath'], 2);

            $path = $_SERVER['DOCUMENT_ROOT'] . "/Jejoe16" . $imagepath;

            $type = pathinfo($path, PATHINFO_EXTENSION);
            $imgdata = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($imgdata);

            $title = $pictures[$i]['headertext'];
            $description = $pictures[$i]['imagetext'];

            array_push($images, ["image" => $base64, "title" => $title, "description" => $description]);

        }

        echo json_encode(array_values($images));

    }
}

?>