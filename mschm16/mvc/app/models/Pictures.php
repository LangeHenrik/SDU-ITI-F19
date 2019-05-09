<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
require_once $pathroot . '/mschm16/mvc/app/core/Database.php';

class Pictures extends Database {

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
    $target_dir = $pathroot . "/mschm16/mvc/app/assets/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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

            $sqlinsimg="INSERT INTO posts (fk_userId, postImg, postName, postText) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc')";

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
    } //function end

public function getAllPosts() {
    $dbc = new Database();

    $dbc->connectToDB();

    $sqlposts = "SELECT * FROM posts INNER JOIN users ON fk_userId = userId ORDER BY postId DESC";

    $result = mysqli_query($dbc->connectToDB(),$sqlposts);        
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<div class = 'imgs'> <img border = '0'  src='/mschm16/mvc/app/assets/img/" . $row['postImg'] . "' alt='" . $row['postName'] . "' onclick='imgInfo(" . $row['postId'] . ")'> </div>";
            echo "<h2>" . $row['postName'] . "</h2>";
            echo "<h3>" . $row['postText'] . "</h3>";
            echo "<p class = 'postedby'> <b> Posted by </b>" . $row['userName'] . "</a> </p>";
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
    $sqlposts = "SELECT * FROM posts WHERE fk_userId = '$userID' ORDER BY postId DESC";
    $result = mysqli_query($dbc->connectToDB(),$sqlposts);
    
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $onePost['PostID'] = $row['postId'];
            $onePost['PostedBy'] = $row['fk_userId'];
            $onePost['Image'] = $row['postImg'];
            $onePost['Title'] = $row['postName'];
            $onePost['Description'] = $row['postText'];
            $postObject[] = $onePost;
        } 
        return $postObject;	
	} else {
        echo 'No posts here.';
    }
    $dbc->connectToDB()->close();
}

public function showMyPosts($userID) {

    $dbc = new Database();
    $dbc->connectToDB();
    $sqlposts = "SELECT * FROM posts WHERE fk_userId = '$userID' ORDER BY postId DESC";
    $result = mysqli_query($dbc->connectToDB(),$sqlposts);

    if (!empty($result)) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class = 'imgs'> <img border = '0' src='/mschm16/mvc/app/assets/img/" . $row['postImg'] . "' alt='" . $row['postName'] . "'> </div>";
            echo "<h2>" . $row['postName'] . "</h2>";
            echo "<h3>" . $row['postText'] . "</h3>";
            echo "<p align='center'> <a class='deletion' href = /mschm16/mvc/app/controllers/DeletionController.php?postID=" . $row['postId'] . " > Delete image. </p>";
        }
    } else { 
        echo "<p class = 'success'> No posts </p>";
    }
}
} // class end