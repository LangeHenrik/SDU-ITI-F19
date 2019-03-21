<!DOCTYPE html>
<html>
<head>
	<title> PhotoPost Upload an image </title>
</head>
<body>
<?php

require_once 'serverconn.php';

include 'logout.php';

// -- DEBUG -- echo "Page loaded. -debug-flag-omhaw16- ";

$imagename=$_FILES["fileToUpload"]["name"]; 

//Get the content of the image and then add slashes to it 
$theimage=addslashes (file_get_contents($_FILES['fileToUpload']['tmp_name']));

    if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitimg'])) {
        
        // Define img desc & title placeholders
        $imgtitle = $_POST["imgtitle"];
        $imgdesc = $_POST["imgdesc"];

        if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
        // -- DEBUG -- echo "Hello, " . $_SESSION['userName'];


    // -- DEBUG -- echo "Image name: " . $imagename;

            //Insert the image name and image into DB

    $postedby = $_SESSION['userName'];
        
    $sqlinsimg="INSERT INTO posts (postedby, image, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby', '$theimage','$imagename', '$imgtitle', '$imgdesc', NOW())";

if (!empty($imagename)) { 

    if ($conn->query($sqlinsimg)) {
        echo " Upload done! ";
        $conn->close();
        } else {
            echo " Upload not done. " . $conn->error;
        }

} else { 
    echo "You didn't choose a picture!";
}
} else if ($_SESSION['login'] == 0) {
    echo "Please log in, before you upload.";
}
}

?>

<h1> Upload picture </h1>

<p> Here you can upload any image you desire! </p>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <br>

    <label for="imgtitle">Image title</label>
    <br>
    <input type="text" name="imgtitle" id="imgtitle">
    <br>
    <br>
    <label for="imgtitle">Additional text</label>
    <br>
    <textarea name="imgdesc" id="imgdesc"> </textarea>
    <br>
    <br>
    <input type="submit" value="Upload Image" name="submitimg">
</form>

</body>
</html>