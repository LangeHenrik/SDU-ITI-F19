<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST["submit_image"])) {
    $path = $_FILES["file_to_upload"]["tmp_name"];
    $name = $_FILES["file_to_upload"]["name"];
    
    if(!is_uploaded_file($path) || !exif_imagetype($path)) {
        echo "Please only upload images";
        header("Location: index.php"); //Make sure the same form can't be sent twice!
        exit();
    }

    $newName = explode(".", $name);
    $newName = generateRandomString(5) . "." .$newName[1];

    $newPath = "user_images\\".$newName;
    require "database.php";

    rename($path, $newPath);

    uploadImage($_POST["file_name"], $_POST["file_description"], $newPath);
    
    header("Location: index.php"); //Make sure the same form can't be sent twice!
    exit; // Location header is set, pointless to send HTML, stop the script
}
?>