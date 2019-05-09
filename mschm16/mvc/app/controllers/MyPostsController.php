<?php 

include dirname(__DIR__) . '/views/partials/navi.php';
include dirname(__DIR__) . '/views/partials/logout.php';
$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
require_once $pathroot . '/mschm16/mvc/app/core/serverconn.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$postedby = $_SESSION["userID"];
$sqlposts = "SELECT * FROM posts WHERE fk_userId = '$postedby' ORDER BY postId DESC";

if ($_SESSION["login"] == 1) {
    $result = mysqli_query($conn,$sqlposts);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class = 'imgs'> <img align = centre width = 100% border = '0' src='/mschm16/mvc/app/assets/img/" . $row['postImg'] . "' alt='" . $row['postName'] . "'> </div>";
            echo "<h3>" . $row['postName'] . "</h3>";
            echo "<p class = 'imgdesc'>" . $row['postText'] . "</p>";
            echo "<p class = 'deleteimg'> <a class='deletion' href = /mschm16/mvc/app/controllers/DeletionController.php?postID=" . $row['postId'] . "> Delete image </a></p>";
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