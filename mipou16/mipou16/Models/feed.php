<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

include_once("../Core/database.php");


class Feed
{
    public function likeButton()
    {
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'true' :
                    toggleLike($_POST['image']);
                    echo("<script>console.log('PHP: " . $_POST['image'] . "');</script>");
                    break;
                case 'false' :
                    break;
            }
        }
    }
    public function feeds()
    {
        $feeds = getallimages();
        for ($x = sizeof($feeds) - 1; $x >= 0; $x--) {

            echo '<div class="containerInside">';
            echo '<h1>Image Title</h1>';
            echo '<h3>' . $feeds[$x]['headertext'] . '</h3>';
            $imagep = $feeds[$x]['imagepath'];
            $a = '\'';
            $imagep = $a . $imagep . $a;
            echo '<img src="' . $feeds[$x]['imagepath'] . '"/>';

            echo '<h1>Image Comment</h1>';
            echo '<h3>' . $feeds[$x]['imagetext'] . '</h3>';
            echo '<i id="' . $imagep . '" onclick="myFunction(this,' . $imagep . ')" class="fa fa-thumbs-up" style="font-size:48px"></i>';
            if ($feeds[$x]['likeS'] == 0) {
                echo '<script>document.getElementById("' . $imagep . '").classList.toggle("fa-thumbs-down");</script>';
            }
            echo '</div>';
        }
    }
}
?>