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
		<h1>The first semester of the Diploma in Robottechnology on SDU</h1>
		This section will give a brief idea of the content of the first semester.
		<br/> The semseter consisted of following courses: <b>Basic Automation</b>, <b>Mathematics</b>, <b>PLC Programming in Structured Text</b> and <b>Objektorientated Programming in Java</b>.
		<br/> During the semester we make a project in groups of five-six students. This semester the project was to control a parallel robot with a PLC from B<amp>R. The parallel robot had a pencil mounted and the
		tast was to get the robot to draw a picture from some generated G-code.
		<br/><br/>
		The following posts will describe the progress of the semester, from the beginning(top) to the end(buttom).
	</p>
	</article>
</div>


<!-- uploade and comment -->
<div class="wrapperscale">
  <article class="articlescaleupload">

    <?php

    include 'Includes/dbh_inc.php';

     if (isset($_SESSION['userId'])) { // do we have session variables avalable, then we are logged in
       echo '<form action="Includes/uploade_inc.php?page=1" method="post" enctype="multipart/form-data">
      <input type="hidden" name="size" value="10000">

      <input class="comment" type="file" name="file" value="">

      <div>
        <textarea name="text" cols="50" rows="10" placeholder="Say something about your image/project"></textarea>
      </div>

      <div>
        <button class="combot" type="submit" name="upload_button">Upload</button>
      </div>
    </form>'; }
    else {
      echo "Login to upload..";
    }
    ?>
  </article>
</div>

<script src="ajax1.js"> //Ajax call

</script>
<?php
echo "<div id='ajax'>";

$sql = "SELECT * FROM images1 ORDER BY idPic desc limit 4";
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
</body>
<script src="ajax.js"></script>

</html>
