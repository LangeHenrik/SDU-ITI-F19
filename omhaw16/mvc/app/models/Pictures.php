<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
require_once $pathroot . '/omhaw16/mvc/app/core/Database.php';

class Pictures extends Database {

public function uploadPicThruAPI($postedby,$imgname,$imgtitle,$imgdesc) {

    $ext= 'png';

            $image_name = "Lmaobruh";
            $image_name_with_ext = $image_name.'.'.$ext;

            $path = '../app/models/uploads/'.$image_name_with_ext;

            $insertion_url = $image_name_with_ext;

            $decoded_img = base64_decode($img_base64);
            $insertCheck = $this->uploadB64ThruAPI($postedby,$imgname,$imgtitle,$imgdesc);
            if ($insertCheck != null) {

                    $imgstring = $img_base64;
                    $imgstring = trim( str_replace('data:image/'.$ext.';base64,', "", $imgstring ) );
                    $imgstring = str_replace( ' ', '+', $imgstring );
                    $data = base64_decode( $imgstring );
                    
                    $status = file_put_contents($path, $data );

                    if($status){

                echo "Picture uploaded successfully!";
            } else {
                echo "Cannot upload...";
            }

        
}
}

public function uploadB64ThruAPI($postedby,$imgname,$imgtitle,$imgdesc) {

    echo " - Upload template. - ";

     $dbc = new Database();

        $dbc->connectToDB();
        
        $sqlinsapi="INSERT INTO posts (postedby, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc', NOW())";

        if ($dbc->connectToDB()->query($sqlinsapi)) {

            echo "Say yes! SQL done. - ";

            $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);

            $imageFileType = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));

            $target_dir = $pathroot . "/omhaw16/mvc/app/models/uploads/";
            $target_file = $target_dir . $imgname;

            move_uploaded_file($imgname);

            echo " - Picture uploaded!";


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

// Check if file already exists
if (file_exists($target_file)) {
    echo "<p class='status'> Sorry, file already exists. </p>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "<p class='status'> Sorry, your file is too large. </p>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<p class = 'status'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<p class = 'status'> Sorry, your file was not uploaded. UploadOK = 0 by mistake. </p>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p class = 'success'> The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded. <p>";

        $dbc = new Database();

        $dbc->connectToDB();

/*              $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
       require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';
       // echo $sqlinsimg; */
        
        $sqlinsimg="INSERT INTO posts (postedby, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc', NOW())";
        // echo $sqlinsimg;


 //       echo $sqlinsimg;

        if ($dbc->connectToDB()->query($sqlinsimg)) {
        //    echo " Upload to database done! ";
            $dbc->connectToDB()->close();
            } else {
                echo "DB-upload not done. " . $dbc->connectToDB()->error();
            }

     //       echo "database stuff done.";

    } else {
        // echo $_FILES["fileToUpload"];
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

            // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp ); 

        return $output_file; 

    }

    public function getAllPosts() {

        $dbc = new Database();

        $dbc->connectToDB();

        $sqlposts = "SELECT * FROM posts INNER JOIN user ON postedby = userID ORDER BY postID DESC";

        $result = mysqli_query($dbc->connectToDB(),$sqlposts);
    //    $result = $conn->query($sqlposts);
    //    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //    $active = $row['active'];
      
//      $count = mysqli_num_rows($result);
        
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
  
// require 'serverconn.php'; HERE HERE HERE

// require dirname(__DIR__) . '/app/core/serverconn.php';

    public function getMyPosts($userID) {
	
	if(session_status() == PHP_SESSION_NONE) {
session_start();
}

	$dbc = new Database();
	
	$dbc->connectToDB();

$sqlposts = "SELECT * FROM posts WHERE postedby = '$userID' ORDER BY postID DESC";

// if ($_SESSION['login'] == 1) {

        $result = mysqli_query($dbc->connectToDB(),$sqlposts);

        if ($result->num_rows > 0) {

        	while ($row = $result->fetch_assoc()) {

                $onePost['image_id'] = $row['postID'];
                $onePost['userID'] = $userID;
                $onePost['title'] = $row['imgTitle'];
                $onePost['description'] = $row['imgDesc'];
                $onePost['image'] = $row['imgName'];
                // $onePost['Date'] = $row['imgDate'];

                $postObject[] = $onePost;
        } 

        return $postObject;
			
			}

        $dbc->connectToDB()->close();

//	}
}

public function showMyPosts($userID) {

        $dbc = new Database();

    $dbc->connectToDB();

$sqlposts = "SELECT * FROM posts WHERE postedby = '$userID' ORDER BY postID DESC";

// if ($_SESSION['login'] == 1) {

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