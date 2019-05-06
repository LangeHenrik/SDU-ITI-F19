<?php 

include dirname(__DIR__) . '/views/partials/navi.php';
include dirname(__DIR__) . '/views/partials/logout.php';


    $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
require_once $pathroot . '/omhaw16/mvc/app/core/serverconn.php';

if(session_status() == PHP_SESSION_NONE) {
session_start();
}

$postedby = $_SESSION["userID"];

$sqlposts = "SELECT * FROM posts WHERE postedby = '$postedby' ORDER BY postID DESC";

if ($_SESSION["login"] == 1) {

        $result = mysqli_query($conn,$sqlposts);

        if ($result->num_rows > 0) {

        	while ($row = $result->fetch_assoc()) {
        		echo "<div class = 'imgs'> <img align = centre width = 100% border = '0' src='/omhaw16/mvc/app/models/uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "'> </div>";
        	  	echo "<h3>" . $row['imgTitle'] . "</h3>";
            	echo "<p class = 'imgdesc'>" . $row['imgDesc'] . "</p>";
                echo "<p class = 'deleteimg'> <a class='deletion' href = /omhaw16/mvc/app/controllers/DeletionController.php?postID=" . $row['postID'] . "> Delete image </a></p>";
                echo "<hr>";
        }

        $conn->close();

        
} else {
	echo "<p class = 'intro'> No posts yet. </p>";
}
} else {
    echo "<p class = 'intro'> You need to be logged in to view your posts. </p>";
}

?>