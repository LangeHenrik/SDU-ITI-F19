
<!DOCTYPE html>

<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/style.css">
    <link rel="shortcut icon" type="image/png" href="styling/favicon.png"/>

<title> PhotoPost - My Posts </title>

</head>

<body>

<h1> PhotoPost - My Posts </h1>
<p class = 'tagline'> Your photo-sharing website. </p>

<?php 

include 'navi.php';

echo "<br><br>";

include "logout.php";

require_once 'serverconn.php';

if(session_status() == PHP_SESSION_NONE) {
session_start();
}

$postedby = $_SESSION["userID"];

$sqlposts = "SELECT * FROM posts WHERE postedby = '$postedby' ORDER BY postID DESC";

if ($_SESSION["login"] == 1) {

        $result = mysqli_query($conn,$sqlposts);
    //    $result = $conn->query($sqlposts);
    //    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //    $active = $row['active'];
      
//		$count = mysqli_num_rows($result);
        
        if ($result->num_rows > 0) {

        	while ($row = $result->fetch_assoc()) {
        		echo "<div class = 'imgs'> <img align = centre width = 100% border = '0' src='uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "'> </div>";
        	  	echo "<h3>" . $row['imgTitle'] . "</h3>";
            	echo "<p class = 'imgdesc'>" . $row['imgDesc'] . "</p>";
                echo "<a href = deletepost.php?postID=" . $row['postID'] . "> Delete image </a>";
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

</body>

</html>

