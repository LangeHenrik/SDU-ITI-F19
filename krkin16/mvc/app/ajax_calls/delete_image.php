<?php


function deleteImageById($imageId=null) {
    if($imageId!=null) {
		$user = $_SESSION["user_name"];
        if($user!=null) {
            $image = getImage($imageId);
            if(getId($user) == $image->user) {
                
                unlink("../" . $image->imagePath);
                
                deleteImage($imageId);
            }
        }
    }
}



?>