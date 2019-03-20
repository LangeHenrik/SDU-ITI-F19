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

$anumber = 1;

    if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitimg'])) {

        if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
        // -- DEBUG -- echo "Hello, " . $_SESSION['userName'];


    // -- DEBUG -- echo "Image name: " . $imagename;

            //Insert the image name and image into DB

    $fullimagename = $_SESSION['userName'] . '-' . $imagename;
        
    $sqlinsimg="INSERT INTO posts (image, fileName, fileDate) VALUES('$theimage','$fullimagename', NOW())";


    if ($conn->query($sqlinsimg)) {
        echo " Upload done! ";
        $conn->close();
        } else {
            echo " Upload not done. " . $conn->error;
        }

} else if ($_SESSION['login'] == 0) {
    echo "Please log in, before you upload.";
}
}

?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submitimg">
</form>

</body>
</html>