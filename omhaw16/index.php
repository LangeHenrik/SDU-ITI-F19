
<!DOCTYPE html>

<html>

<head>

<title> PhotoPost </title>

</head>

<body>

<h1> Welcome to PhotoPost! </h1>

<p> Your photo-sharing website. </p>

<div id="imgs">

<?php 

include 'navi.php';

include "logout.php";

require 'serverconn.php';

$sqlposts = "SELECT * FROM posts INNER JOIN user ON postedby = userID ORDER BY postID DESC";

        $result = mysqli_query($conn,$sqlposts);
    //    $result = $conn->query($sqlposts);
    //    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //    $active = $row['active'];
      
//		$count = mysqli_num_rows($result);
        
        if ($result->num_rows > 0) {

        	while ($row = $result->fetch_assoc()) {
        		
            // echo "<br><br>";
            echo "<h2> All photos </h2>";
            echo "<p> The posts are sorted by time, with the newest being at the top. </p><br>";
        		echo "<img align = centre width = auto src='uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "' onclick='imgInfo(" . $row['postID'] . ")'>";
        	  	echo "<h3>" . $row['imgTitle'] . "</h3>";
            	echo "<p>" . $row['imgDesc'] . "</p>";
            	echo "<b> Posted by </b>" . $row['userName'] . "</a>";

            	       }

        $conn->close();

        
} else {
	echo "No posts yet.";
}
  
  require 'serverconn.php';

$sqlusers = "SELECT userID, userName FROM user";
  $resultusers = mysqli_query($conn,$sqlusers);
        
echo "<h1> All users </h1>";

        if ($resultusers->num_rows > 0) {
            while ($row = $resultusers->fetch_assoc()) {
         /*     echo "User ID: " . $row['userID'];
              echo "<br>";
              echo "<br>"; */
              echo "Username: " . $row['userName'];
              echo "<br>";
              echo "<br>";
              // echo "" . $row['userName'] . "";
}
} else {
  echo "<h2> No users </h2>";
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