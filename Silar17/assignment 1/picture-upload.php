<?php
session_start();
if (isset($_SESSION['username'])){
	
} else {
	header('Location: login.php');
}
?>

<html>
<title>Silar17-assignment1</title>
<!-- may not be neseary <meta charset="UTF-8"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="javaScript.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<!-- Navgiation bar (sit on top) -->
<div class="-top">
  <div class="-nav">
    <a href="index.php" class="-bar-item -button">
	<b>Larsen</b> Solutions</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="-right">
	<?php if(!isset($_SESSION['preload'])){ ?>
	  <a href="fun-preload-image.php" class="-bar-item -buttion">Preload pictures</a>
	<?php } ?>
	  <a href="picture.php" class="-bar-item -button">Pictures</a>
      <a href="picture-upload.php" class="-bar-item -button">Upload</a>
      <a href="user.php" class="-bar-item -button">Users</a>
      <a href="contact.php" class="-bar-item -button">Contact</a>
	  <a href="login.php" class="-bar-item -button"> Login</a>
	  <a href="fun-logout.php" class="-bar-item -button"> logout</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

<!-- upload Section -->
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">Upload pictures</h3>
    <p>Here you can opload picture to the page</p>
    <form action="fun-upload.php" method="POST" enctype="multipart/form-data" id="upload-picture">
	  <input class="-input -border" type="file" name="imageToUpload" id="imageToUpload">
      <input class="-input -section -border" type="text" placeholder="Title" required name="title">
      <textarea class="-input -section -border -comment" placeholder="Comment" name="comment" form="upload-picture" id="comment"></textarea>
	  <button class="-button -black -section" type="submit">
       <i></i> Upload picture
      </button>
    </form>
  </div>



<!-- End page content -->
</div>

<!-- Footer -->
<footer class="-center -black -padding-16">
  <p>Solution by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">Larsen</a></p>
</footer>

</body>
</html>