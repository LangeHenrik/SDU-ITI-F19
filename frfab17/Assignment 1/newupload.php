<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(empty($_SESSION['user'])){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload Picture</title>
</head>
<body>
<div>
		<a href="imagepage.php">Pictures</a>
		<a href="displayusers.php">Show table of users</a>
		<a href="newupload.php">Upload picture</a>
		<span style="float:right">Current user: <?php echo $_SESSION['user'];?></span>
	</div>
<div>
	<h2>Upload</h2>
	<form action="upload.php" method="post" enctype="multipart/form-data">
	</br><textarea name="title" rows="2" cols="30" placeholder="Please enter a title for your image"></textarea></br>
	<textarea name="description" rows="5" cols="30" placeholder="Please enter a description for your image"></textarea></br></br>
	<input type="file" name="filePath">
	<input type="submit" value="Upload">
	</form></br>
	</br>
</div>
</html>