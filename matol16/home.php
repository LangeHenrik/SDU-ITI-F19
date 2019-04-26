<?php

if (isset($_SESSION["loggedin"])){

}else{
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="homeStyle.css">

</head>
<body>
<div class="welcome">
<h1> Welcome home <?php echo $_SESSION['username']?></h1>
<p>You are logged in!</p>
<p>Click here to <a href="logout.php">Logout</a></p>
    <p><a href="gallery.php">Do you feel like looking at some pictures?</a></p>
    <p><a href="upload.php">Or maybe uploading one?</a></p>
</div>
</body>
</html>
