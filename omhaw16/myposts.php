
<!DOCTYPE html>

<html>

<head>

<title> PhotoPost - My Posts </title>

</head>

<body>

<h1> My posts </h1>

<p> Here are your posts: </p>

<?php 

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
        		echo "<img src='uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "'>";
        	  	echo "<h3>" . $row['imgTitle'] . "</h3>";
            	echo "<p>" . $row['imgDesc'] . "</p>";
        }

        $conn->close();

        
} else {
	echo "No posts yet.";
}
}

?>

</body>

</html>

