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
  <link rel="javascript" href="ajax.js"/> <!-- link to javascript -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!--meta tag that makes this website scalable on different devices -->


</head>

<body>


<div class="wrapperscale">
	<article class="articlescaletop">
	<p>
		<h1>The fourth semester of the Diploma in Robottechnology on SDU</h1>
		This section will give a brief idea of the content of the fourth semester.
		<br/> The semseter consisted of following courses: <b>Regulation technique</b>, <b>Applied Automation</b>, <b>Simulation</b> and <b>Internet Technlogy</b>.
		<br/> During the semester we make a project in groups of five-six students. This semester the project was to balance an inverted pendulum.
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
      $server_name = "localhost";
      $dB_username = "root";
      $dB_password = "";
      $dB_name = "lafab16";
      $dB_port = "3308";

      $connect = new PDO("mysql:host=$server_name;port=$dB_port;dbname=$dB_name", $dB_username, $dB_password);

     if (isset($_SESSION['userId'])) { // do we have session variables avalable, then we are logged in
       echo '<form action="Includes/uploade_inc.php?page=4" method="post" enctype="multipart/form-data">
      <input type="hidden" name="size" value="10000">

      <input type="file" name="file" value="">

      <div>
        <textarea name="text" cols="40" rows="4" placeholder="Say something about your image/project"></textarea>
      </div>

      <div>
        <button type="submit" name="upload_button">Upload</button>
      </div>
    </form>'; }
    else {
      echo "Login to upload..";
    }
    ?>
  </article>
</div>

<script src="ajax4.js"> //Ajax call

</script>

<?php
echo "<div id='ajax'>";

$sql = "SELECT * FROM images4 ORDER BY idPic desc limit 4";
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
<!--
  <p>
		<img class="img-article" src="Assignment1/invertpendulum.png" alt="URCaps">
		<h1>The inverted pendulum</h1>

		The pendulum is located on a cart, which is controlled by a DC-motor in each end.
		To balance the pendulum we need to find some relationship between the angle of the rod and the acceleration of the cart.

	</p>
	</article>
</div>

<div class="wrapperscale">
	<article class="articlescale">
	<p>
		<video class="video-article" poster "image.gif" autoplay controls>
			<source src="Assignment1/sorting.mp4" type="video/mp4">
		</video>
		<h1> Sorting facility</h1>
		A simulation of a sorting facility made in <i>Experior 6</i>. The three sensors and three actuators are controlled by a PLC
		simulated in <i>Automation Studio</i> from B&ampR.
		The little program is written in Structured Text.
		</p>
	</article>
</div>

<div class="wrapperscale">
	<article class="articlescale">
	<p>
		<video class="video-article" poster "image.gif" autoplay controls>
			<source src="Assignment1/invertsimscape.mp4" type="video/mp4">
		</video>
		<h1>Inverted pendulum simulated</h1>
		A simulation of the inverted pendulum system made in <i>Matlab Simscape</i>.
		<br>
		The pendulum is started in a upwards position and the simulation shows the behavior of the pendulum and the cart.
  </p> -->


</body>
</html>
