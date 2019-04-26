<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-13
 * Time: 12:26
 */

require 'DatabaseManager.php';

$imageId = (int)$_POST['imageId'];

$success = deleteImage($imageId);
if($success) {
    header('Location: http://localhost:8000/PHP/PictureManagement.php?');
} else {
    echo "Something went wrong..";
}

