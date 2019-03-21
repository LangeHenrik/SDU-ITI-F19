<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-13
 * Time: 09:12
 */

require 'DatabaseManager.php';

$comment = htmlentities($_POST['comment']);
$authorID = htmlentities($_SESSION['id']);
$imageId = htmlentities($_POST['imageId']);

if(isset($_POST['submit'])) {

    $success = addImageComment($comment, $authorID, $imageId);
    if($success) {
        header('Location: http://localhost:8000/PHP/Feed.php?');
    } else {
        echo "Something went wrong";
    }

}