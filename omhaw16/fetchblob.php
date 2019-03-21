<?php

$name=$_GET['name'];

       require 'serverconn.php';
        
        $sql = "SELECT image FROM posts WHERE postID = 5";

        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
      
        $count = mysqli_num_rows($result);
        
   if ($count == 1) {

 $image_name=$row["imgName"];
 $image_content=$row["image"];
 echo $image_content;

} else {
	echo "Error.";
}


?>
