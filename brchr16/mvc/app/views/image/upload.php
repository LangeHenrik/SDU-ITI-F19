
<?php
/*
if (session_status() == PHP_SESSION_NONE ) {
	Header("localhost:8080/mvc/public/home/");
}
*/
require_once('../app/models/Image.php');
?>
<!DOCTYPE html>
<body>
<form onsubmit="" method="post" enctype="multipart/form-data" action="/brchr16/mvc/public/image/upload">
    
    <legend>Upload</legend>
    <label for="title">Title:</label>
	<br>
    <input type="text" name="title" required><br>
    <br>
	<label for="title">Description:</label>
	<br>
	<input type="text" name="description" id="description" class='field' placeholder="Enter a description">
	<br><br>
    <input type="file" name="imageuploader" id="imageuploader" accept="image/gif, image/jpeg, image/png">
	<br><br>
    <input type="submit" value="Upload picture" id="submit"/>
    
</form>
<a href = "Picture.php"> Back to picturepage </a>
</body>
</html>