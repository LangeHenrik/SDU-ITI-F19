
<!DOCTYPE html>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> PhotoPost </title>
  <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
  <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>
</head>

<body>

<h1> Welcome to PhotoPost! </h1>

<p class = 'tagline'> - Your photo-sharing website </p>

<div id="imgs">

<?php 



include dirname(__DIR__) . '/app/views/partials/navi.php';

// FOR TESTING PURPOSES: include 'index_old.php';

include dirname(__DIR__) . '/app/views/partials/logout.php';

require dirname(__DIR__) . '/app/core/serverconn.php';

            echo "<h1> * </h1>";
            echo "<h2> All photos </h2>";
                       echo "<p class = 'intro'> The posts are sorted by time, with the newest being at the top. </p><br>";


$sqlposts = "SELECT * FROM posts INNER JOIN user ON postedby = userID ORDER BY postID DESC";

        $result = mysqli_query($conn,$sqlposts);
    //    $result = $conn->query($sqlposts);
    //    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //    $active = $row['active'];
      
//		$count = mysqli_num_rows($result);
        
        if ($result->num_rows > 0) {

        	while ($row = $result->fetch_assoc()) {
        		
        		echo "<div class = 'imgs'> <img align = centre width = 100% border = '0'  src='/omhaw16/mvc/app/models/uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "' onclick='imgInfo(" . $row['postID'] . ")'> </div>";
        	  	echo "<h3>" . $row['imgTitle'] . "</h3>";
            	echo "<p class = 'imgdesc'>" . $row['imgDesc'] . "</p>";
            	echo "<p class = 'postedby'> <b> Posted by </b>" . $row['userName'] . "</a> </p>";
              echo "<hr>";

            	       }

        $conn->close();

        
} else {
	echo "No posts yet.";
}
  
  // require 'serverconn.php';

$sqlusers = "SELECT userID, userName FROM user";
  $resultusers = mysqli_query($conn,$sqlusers);
        
echo "<h1 class='allusers'> All users </h1>";

        if ($resultusers->num_rows > 0) {
            while ($row = $resultusers->fetch_assoc()) {
         /*     echo "User ID: " . $row['userID'];
              echo "<br>";
              echo "<br>"; */
              echo "<p> | ". $row['userName'] . " | </p>";
              // echo "<br>";
              // echo "<br>";
              // echo "" . $row['userName'] . "";
}
} else {
  echo "<p> <b> No users </b> </p>";
}


?>

</div>

<script> 
	function imgInfo(int) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("imgs").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getposts.php?q="+int, true);
  xhttp.send();
}
	</script>

<br>
<br>
</body>

</html>