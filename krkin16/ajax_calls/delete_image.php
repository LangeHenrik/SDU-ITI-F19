<?php
    require "../database.php";

    
    echo $_GET["image_id"];
    $user = $_SESSION["user_name"];


    if(isset($_GET["image_id"])) {
        if($user!=null) {
            $imageId = $_GET["image_id"];
            $image = getImage($imageId);
            if(getId($user) == $image->user) {
                
                unlink("../" . $image->imagePath);
                
                deleteImage($imageId);
            }
        }
    }




?>