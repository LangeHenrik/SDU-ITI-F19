<?php

class UploadService{

    
public function upload($UploadImageModel){    
    if(isset($_POST['upload'])){    
        $image_description =$_POST['description'];

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $title = basename( $_FILES["fileToUpload"]["name"]);

        if($title == null){
        header("Location: /todah16/mvc/public/home/other");
        }
    
    
    
            $user_name = $_SESSION['user_name'];

    
             
        
            if($this->uploadImage($target_dir, $target_file, $imageFileType)){
                $uploadImage = new uploadImage($title, $user_name, $image_description);
                return $uploadImage;
            }
               

               } else {
            header("Location: /todah16/mvc/public/home/other");
                   exit();
               } 

}       


private function uploadImage($target_dir, $target_file, $imageFileType) {
$uploadOk = 1;
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}  else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    return true;
    
        /* header("Location: ../Dankify_feed.php");
        exit();
        */
    
    
    
}
    
}

