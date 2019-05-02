<?php

include '../app/views/partials/menu.php';

if (session_status() == PHP_SESSION_NONE) {
	header("localhost:8080/uojon16/mvc/public/home");
}
?>

<!DOCTYPE html>
<body>
<div class="uploadForm">

<p class="label"> Upload  your Image</p>
<form method="post" action="/uojon16/mvc/public/image/upload" enctype="multipart/form-data">
	<input type="file" name="image" accept="image/gif, image/jpeg, image/png" id="image" placeholder="Choose an image" required>
	<br><br>
	<input type="text" name="title"  placeholder="Enter your header" required>
	<br><br>
    <input type="text" name="description"  placeholder="Enter a description">
	<br><br>
	<input type="submit" name="submit_image" class='submit'>

<a href = "/uojon16/mvc/public/home/"> Back to login page </a>

</form>
</body>
</html>

  