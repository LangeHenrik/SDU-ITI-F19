<?php
$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
require_once $pathroot . '/mschm16/mvc/app/core/Database.php';

class Pictures extends Database {

public function uploadImgApi($postedby,$imgname,$imgtitle,$imgdesc) {
    $ext= 'png';
    $image_name = uniqid();
    $image_name_with_ext = $image_name.'.'.$ext;
    $path = '../app/assets/img/'.$image_name_with_ext;
    $insertion_url = $image_name_with_ext;
    $decoded_img = base64_decode($img_base64);
    $insertCheck = $this->uploadImg64Api($postedby,$imgname,$imgtitle,$imgdesc);
    if ($insertCheck != null) {
            $imgstring = $img_base64;
            $imgstring = trim( str_replace('data:image/'.$ext.';base64,', "", $imgstring ) );
            $imgstring = str_replace( ' ', '+', $imgstring );
            $data = base64_decode( $imgstring );
            
            $status = file_put_contents($path, $data );
            if($status){
                echo "Picture uploaded";
            } else {
                echo "Can't upload";
            } 
    }
}

public function uploadImg64Api($postedby,$imgname,$imgtitle,$imgdesc) {
    echo "Upload template";
    $dbc = new Database();
    $dbc->connectToDB();
        
    $sqlinsapi="INSERT INTO posts (fk_userId, postImg, postName, postText) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc')";
    if ($dbc->connectToDB()->query($sqlinsapi)) {
        $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);
        $imageFileType = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));
        $target_dir = $pathroot . "/mschm16/mvc/app/assets/img/";
        $target_file = $target_dir . $imgname;
        move_uploaded_file($imgname);
        echo "Picture uploaded";
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

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "<p class = 'status'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "<p class = 'status'>Sorry, your file was not uploaded.</p>";
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
        echo "<p class='guide'>Target file: " . $target_file;
        echo $_FILES["tmp_name"];
        echo "Sorry, there was an error uploading your file.";
    }
}
} 
    } else if ($_SESSION['login'] == 0) {
        echo "<p class='guide'>Log in</p>";
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
    $sqlposts = "SELECT * FROM posts INNER JOIN users ON fk_userId = userId ORDER BY postId DESC";
    $result = mysqli_query($dbc->connectToDB(),$sqlposts);
        
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo "<div class = 'imgs'> <img align = centre width = 100% border = '0'  src='/mschm16/mvc/app/assets/img/" . $row['postImg'] . "' alt='" . $row['postName'] . "'> </div>";
            echo "<h3>" . $row['postName'] . "</h3>";
            echo "<p class = 'imgdesc'>" . $row['postText'] . "</p>";
            echo "<p class = 'postedby'> <b> Posted by </b>" . $row['userName'] . "</a> </p>";
                    }
    $dbc->connectToDB()->close();
    
    } else {
        echo "<p class='success'>No posts</p>";
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
            $onePost['image_id'] = $row['postId'];
            $onePost['userID'] = $userID;
            $onePost['title'] = $row['postName'];
            $onePost['description'] = $row['postText'];
            $onePost['image'] = $row['postImg'];
            $postObject[] = $onePost;
        } 
        return $postObject;		
    }
    $dbc->connectToDB()->close();
}

public function showMyPosts($userID) {
    $dbc = new Database();
    $dbc->connectToDB();
    $sqlposts = "SELECT * FROM posts WHERE fk_userId = '$userID' ORDER BY postId DESC";
        $result = mysqli_query($dbc->connectToDB(),$sqlposts);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class = 'imgs'> <img src='/mschm16/mvc/app/assets/img/" . $row['postImg'] . "' alt='" . $row['postName'] . "'> </div>";
                echo "<h3>" . $row['postName'] . "</h3>";
                echo "<p class = 'imgdesc'>" . $row['postText'] . "</p>";
                echo "<p align='center'> <a class='deletion' href = /mschm16/mvc/app/controllers/DeletionController.php?postID=" . $row['postId'] . " > Delete image. </a></p>";
            } 
        } else { 
            echo "<p class='success'>No posts.</p>";
        }
}
}