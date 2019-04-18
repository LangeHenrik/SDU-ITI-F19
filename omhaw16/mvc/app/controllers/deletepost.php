<?php 

$imgname = "";

$postID = $_GET['postID'];

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     

$imgpath = $pathroot . '/omhaw16/mvc/app/models/uploads/';

require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';

$sqlfind = "SELECT postID, imgName FROM posts WHERE postID = '$postID'";

$result = mysqli_query($conn,$sqlfind);
       
       if ($result->num_rows > 0) {

       	$row = $result->fetch_assoc();

        	$imgname = $row["imgName"];
            echo $imgname;
        	$fullpath = $imgpath . $imgname;
            echo $fullpath;
        	if (!unlink($fullpath)) {
        		echo "Couldn't delete file.";
        		echo $fullpath;
        	} else {
        		echo "File deleted.";
        	}

$sqldel = "DELETE FROM posts WHERE postID = '$postID'";

if ($conn->query($sqldel)) {

	$conn->close();
	               header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/omhaw16/mvc/app/views/home/myposts.php" . $location);
	exit;

} else { 
        		echo "Count not larger than 0";
        	}
        }
?>