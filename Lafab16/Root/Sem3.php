<?php
  require 'header.php';
 ?>



<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<title>
	Assignment One
	</title>
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<link rel="stylesheet" href="style.css"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!--meta tag that makes this website scalable on different devices -->

  <!--<script type="text/javascript" src='ajax.js'> </script> -->

</head>

<body>

<div class="wrapperscale">
	<article class="articlescaletop">
	 <p>
		<h1>The third semester of the Diploma in Robottechnology on SDU</h1>
		This section will give a brief idea of the content of the third semester.
		<br/> The semseter consisted of following courses: <b>Higher Software Developement</b>, <b>Physics</b>, <b>Digital Signal Processing</b> and <b>Computer Vision</b>.
		<br/> During the semester we make a project in groups of five-six students. This semester the project was to locate a onbject with a camera, pick it up with a UR5 manipulator and
			throw it in a calculated arc.
		<br/><br/>
		The following posts will describe the progress of the semester, from the beginning(top) to the end(buttom).
	</p>
	</article>
</div>

<!-- uploade and comment -->
<div class="wrapperscale">
  <article class="articlescaleupload">

    <?php

    //Connect to db
      include 'Includes/dbh_inc.php';

     if (isset($_SESSION['userId'])) { // do we have session variables avalable, then we are logged in
       echo '<form action="Includes/uploade_inc.php?page=3" method="post" enctype="multipart/form-data">
      <input type="hidden" name="size" value="10000">

      <input type="file" name="file" value="">

      <div>
        <textarea name="text" cols="40" rows="4" placeholder="Say something about your image/project"></textarea>
      </div>

      <div>
        <button type="submit" name="upload_button">Upload</button>
      </div>
    </form>';
  } else {
    echo "Login to upload..";
  }
    ?>
  </article>
</div>

<script src="ajax3.js"> //Ajax call

</script>


<?php
echo "<div id='ajax'>";

$sql = "SELECT * FROM images3 ORDER BY idPic desc limit 4";
$stmt = $connect->prepare($sql);

$stmt->execute();
//Execute the statement
if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $fileExt = explode('.', $row['path']);
    if ($fileExt[3] == 'mp4') {
      echo "<div class='wrapperscale'>";
      echo "<article class='articlescale'>";
      echo "<video class='video-article' poster 'image.gif' autoplay controls>";
      echo "<source src='Assignment1/".$row['path']."'type='video/mp4'>";
      echo "</video>";
      echo "<p><b>".$row['uidusers']."</b></p>";
      echo "<p>".$row['tex']."</p>";
      echo "</article>";
      echo "</div>";
    }
    else {
      echo "<div class='wrapperscale'>";
      echo "<article class='articlescale'>";
      echo "<p><b>".$row['uidusers']."</b></p>";
      echo "<img class='img-article' src='Assignment1/".$row['path']."'>";
      echo "<p>".$row['tex']."</p>";
      echo "</article>";
      echo "</div>";
    }
  }
}

echo "</div>";
?>

<!--	<p>
		<img class="img-article" src="Assignment1/opstilling.jpg" alt="URCaps">
		<h1>The lineup</h1>
		This was the lineup for the project. A camera was placed above the table, pointing down.
	</p>
	</article>
</div>

<div class="wrapperscale">
	<article class="articlescale">
	<p>
		<video class="video-article" poster "image.gif" autoplay controls>
			<source src="Assignment1/detect.mp4" type="video/mp4">
		</video>
		<h1> Computer Vision</h1>
		A big part of the project was to detect and locate the object with the camera. We wrote the program in C++ with the <i> OpenCV</i> libary.
		<br/> <br/>
		The method shown, uses the a set of HUE parameters to detect the object based on the color, convert the image to a binary image and return a centerpoint(x,y in the image plane).
		</p>
	</article>
</div>

<div class="wrapperscale">
	<article class="articlescale">
	<p>
		<video class="video-article" poster "image.gif" autoplay controls>
			<source src="Assignment1/ros.mp4" type="video/mp4">
		</video>
		<h1> ROS</h1>
		We needed a way to control the UR5 manipulator. We desided to use ROS(Robot Operating System).
		<br/>
		ROS already had a package for Universal Robots, <i>UR mordern driver</i> and a package to communicate with the endeffector.
		<br/><br/>
		We used <i>UR-sim</i> to simulate our program before we tested it on the real robot.
		</p>
	</article>
</div>

<div class="wrapperscale">
	<article class="articlescale">
	<p>
		<img class="img-article" src="Assignment1/trow.jpg" alt="URCaps">
		<h1>The calculated arc</h1>
		When you want to calculate the arc of a thrown object you need to calculate the Jacobian.
		<br/>
		You detemine the jointposition when the griber releases the object, calculate the Jacobian, and calculate the velocity and acceleration
		the joints must have to reach the desired piont.  When you have a velocity vector you can calculate the off-set that satisfy the requirements.
		The picture shows the off-set for our throw.
	</p>
	</article>
</div>

<div class="wrapperscale">
	<article class="articlescale">
	<p>
		<video class="video-article" poster "image.gif" autoplay controls>
			<source src="Assignment1/finalthrow.mp4" type="video/mp4">
		</video>
		<h1> The system all together</h1>
		The system tested together.
		The coordinates from the object detection is translated from the image frame to the robot frame, so the robot can pick it up.
		The off-set is calculated and the object is thrown.
		<br/>
		The jointpositions and joint velocities are saved in a database we made in <i>SQL Workbench</i>.
		</p>

  -->

</body>
</html>
