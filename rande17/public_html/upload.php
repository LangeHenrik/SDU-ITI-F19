<?php
require_once("class/loadall.php");
$function->enforceLogin();
$function->getMenu();
$function->getHeadline("Upload");
$function->drawLeft("latest");
$function->drawMain('upload');
$function->drawRight('upvoted');

if(isset($_FILES['fileToUpload'])){
    $target_dir = UPLOADPATH;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_file = $target_dir . basename($function->getUUID().".".$imageFileType);
    echo $imageFileType;
    $uploadOk = 1;
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
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
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $user = $_SESSION['name'];
            if(isset($_POST['name'])){
                $imagename = htmlentities($_POST['name']);
            }else{
                $imagename =  htmlentities(basename( $_FILES["fileToUpload"]["name"]));
            }
            $user = $_SESSION['ID'];
            $imageid = basename($target_file);
            $imagedescription = $_POST['desc'];
            $stmt = $DB->prepare("INSERT INTO image (image_id, name, description, user) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $imageid, $imagename, $imagedescription, $user);
            $stmt->execute();
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            header("Location: /myimage.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
