<?php 

$imgname = "";

$postID = $_GET['postID'];

$imgpath = 'uploads/';

require 'serverconn.php';

$sqlfind = "SELECT postID, imgName FROM posts WHERE postID = '$postID'";

$result = mysqli_query($conn,$sqlfind);
       
       if ($result->num_rows > 0) {

       	$row = $result->fetch_assoc();

        	$imgname = $row["imgName"];

        	$fullpath = $imgpath . $imgname;

        	if (!unlink($fullpath)) {
        		echo "Couldn't delete file.";
        		echo $fullpath;
        	} else {
        		echo "File deleted.";
        	}

$sqldel = "DELETE FROM posts WHERE postID = '$postID'";

if ($conn->query($sqldel)) {

	$conn->close();
	header("Location: myposts.php");
	exit;

} else { 
        		echo "Count not larger than 0";
        	}
        }
?>