<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
require_once $pathroot . '/omhaw16/mvc/app/core/Database.php';

class Pictures extends Database {

public function uploadDBThruAPI($postedby,$imgname,$imgtitle,$imgdesc) {

     $dbc = new Database();

        $dbc->connectToDB();
        
        $sqlinsapi="INSERT INTO posts (postedby, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc', NOW())";

        if ($dbc->connectToDB()->query($sqlinsapi)) {

            echo " - Connected to SQL database! ";

            $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);

            $imageFileType = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));

            $target_dir = $pathroot . "/omhaw16/mvc/app/models/uploads/";
            $target_file = $target_dir . $imgname;

            move_uploaded_file($imgname);

            echo "Picture uploaded to database!";

            echo mysqli_insert_id();


            $dbc->connectToDB()->close();
            } else {
                echo "DB-upload not done. " . $dbc->connectToDB()->error();
            }


}

public function uploadPic($postedby,$imgname,$imgtitle,$imgdesc) {
        $imgtitle = "";
        $imgdesc = "";
        $imgname = "";
        $postedby = "";

if(session_status() == PHP_SESSION_NONE) {
session_start();
}

$dbc = new Database();

    $dbc->connectToDB();

$postedby = $_SESSION["userID"];

if ($_SESSION["login"] == 1) {

if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitimg'])) {

$imgtitle = $_POST["imgtitle"];
$imgdesc = $_POST["imgdesc"];
$imgname = basename($_FILES["fileToUpload"]["name"]);

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);
$target_dir = $pathroot . "/omhaw16/mvc/app/models/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submitimg"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "<p class='guide'>File is an image - " . $check["mime"] . ". </p>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    echo "<p class='status'> Sorry, file already exists. </p>";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "<p class='status'> Sorry, your file is too large. </p>";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<p class = 'status'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "<p class = 'status'> Sorry, your file was not uploaded. UploadOK = 0 by mistake. </p>";

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p class = 'success'> The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded. <p>";

        $dbc = new Database();

        $dbc->connectToDB();

        $sqlinsimg="INSERT INTO posts (postedby, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc', NOW())";

        if ($dbc->connectToDB()->query($sqlinsimg)) {

            $dbc->connectToDB()->close();
            } else {
                echo "DB-upload not done. " . $dbc->connectToDB()->error();
            }

    } else {
   
        echo "<p class='guide'> Target file: " . $target_file;
        echo $_FILES["tmp_name"];
        echo "Sorry, there was an error uploading your file.";
    }
}
} 
} else if ($_SESSION['login'] == 0) {
    echo "<p class='guide'> Please log in, before you upload. </p>";
}
    }

    public function getPostsAPI($base64_string, $output_file) {

        $ifp = fopen( $output_file, 'wb' ); 

        $data = explode( ',', $base64_string );

        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        fclose( $ifp ); 

        return $output_file; 

    }

    public function getAllPosts() {

        $dbc = new Database();

        $dbc->connectToDB();

        $sqlposts = "SELECT * FROM posts INNER JOIN user ON postedby = userID ORDER BY postID DESC";

        $result = mysqli_query($dbc->connectToDB(),$sqlposts);
        
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                
                echo "<div class = 'imgs'> <img align = centre width = 100% border = '0'  src='/omhaw16/mvc/app/models/uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "' onclick='imgInfo(" . $row['postID'] . ")'> </div>";
                echo "<h3>" . $row['imgTitle'] . "</h3>";
                echo "<p class = 'imgdesc'>" . $row['imgDesc'] . "</p>";
                echo "<p class = 'postedby'> <b> Posted by </b>" . $row['userName'] . "</a> </p>";
              echo "<hr>";

                       }

        $dbc->connectToDB()->close();

        
} else {
    echo "<p align='center' class = 'success'> <b> No posts yet. </b>";
}

}

    public function getMyPosts($userID) {
	
	if(session_status() == PHP_SESSION_NONE) {
session_start();
}

	$dbc = new Database();
	
	$dbc->connectToDB();

$sqlposts = "SELECT * FROM posts WHERE postedby = '$userID' ORDER BY postID DESC";

        $result = mysqli_query($dbc->connectToDB(),$sqlposts);

        if ($result->num_rows > 0) {

        	while ($row = $result->fetch_assoc()) {

                $onePost['image_id'] = $row['postID'];
                $onePost['userID'] = $userID;
                $onePost['title'] = $row['imgTitle'];
                $onePost['description'] = $row['imgDesc'];
                $onePost['image'] = $row['imgName'];

                $postObject[] = $onePost;
        } 

        return $postObject;
			
			}

        $dbc->connectToDB()->close();

}

public function showMyPosts($userID) {

        $dbc = new Database();

    $dbc->connectToDB();

$sqlposts = "SELECT * FROM posts WHERE postedby = '$userID' ORDER BY postID DESC";

        $result = mysqli_query($dbc->connectToDB(),$sqlposts);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo "<div class = 'imgs'> <img align = centre width = 100% border = '0' src='/omhaw16/mvc/app/models/uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "'> </div>";
                echo "<h3>" . $row['imgTitle'] . "</h3>";
                echo "<p class = 'imgdesc'>" . $row['imgDesc'] . "</p>";
                echo "<p align='center'> <a class='deletion' href = /omhaw16/mvc/app/controllers/DeletionController.php?postID=" . $row['postID'] . " > Delete image. </a></p>";

                echo "<hr>";
        }
 
     } else { echo "<p class = 'success'> Oopsie! You have no posts. Make one today! </p>";
}
}
}