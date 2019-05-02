<?php


function deleteImageById($imageId=null) {
	require_once "../app/models/Image.php";
	require_once "../app/models/User.php";
    if($imageId!=null) {
		$user = $_SESSION["user_name"];
        if($user!=null) {
            $image = Image::getImage($imageId);
            if(User::getId($user) == $image->user) {
                
                unlink("../" . $image->imagePath);
                
                Image::deleteImage($imageId);
            }
        }
    }
}



?>