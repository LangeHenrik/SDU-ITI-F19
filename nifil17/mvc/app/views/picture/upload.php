<?php

include '../app/views/partials/menu.php';

if (session_status() == PHP_SESSION_NONE) {
	header("localhost:8080/nifil17/mvc/public/home");
}
?>

<!DOCTYPE html>
<style>
body {
	background-color: green;
}

.label{
	position: absolute;
	left:50%;
	top: 0px;
	font-size: 32px;
	transform: translateX(-50%) translateY(-50%);
}

.uploadForm{
	width: 80%;
	height: 80%;
	border-style: solid;
	background-color: white;
	padding: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);	
}

.upload{
	width:80%;
	height:80%;
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}

.field{
	width:35%;
	height:10%;
	margin-bottom: 3px;
	font-size: 32px;
}

.submit{
	width:35%;
	height:10%;
	margin-bottom: 3px;
	font-size: 32px;
}
</style>

<body>
<div class="uploadForm">
<p class="label"> Upload </p>
<form method="post" action="save">
	<input type="file" name="image" accept="image/gif, image/jpeg, image/png" name="image" placeholder="Choose an image" required>
	<br><br>
	<input type="text" name="header" class='field' placeholder="Enter your header" required>
	<br><br>
    <input type="text" name="description" class='field' placeholder="Enter a description">
	<br><br>
	<input type="submit" name="submit_image" class='submit'>
</form>
</body>
</html>
