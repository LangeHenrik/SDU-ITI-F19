
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

include "logout.php";

require_once 'serverconn.php';

$sqlposts = "SELECT * FROM posts INNER JOIN user ON postedby = userID ORDER BY postID DESC";

        $result = mysqli_query($conn,$sqlposts);
    //    $result = $conn->query($sqlposts);
    //    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //    $active = $row['active'];
      
//		$count = mysqli_num_rows($result);
        
        if ($result->num_rows > 0) {

        	while ($row = $result->fetch_assoc()) {
        		
        		echo "<img src='uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "' onclick='imgInfo(" . $row['postID'] . ")'>";
        	  	echo "<h3>" . $row['imgTitle'] . "</h3>";
            	echo "<p>" . $row['imgDesc'] . "</p>";
            	echo "<a class='reg' href='#'>Posted by " . $row['userName'] . "</a>";

            	       }

        $conn->close();

        
} else {
	echo "No posts yet.";
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

