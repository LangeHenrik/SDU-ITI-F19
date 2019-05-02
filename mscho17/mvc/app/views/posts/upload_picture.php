
<html>
<head>

<link rel="stylesheet" type="text/css" href="/mscho17/mvc/public/css/styles.css">

</head>
<body>
<div>
	<?php include '../app/views/partials/topBar.php'; ?>
</div>

<form method="post" enctype="multipart/form-data" action="posts/upload">
    Select image to upload:
	<br>
    <input type="file" name="fileToUpload" id="fileToUpload">
	<br>
	<input type="text" name="picture_description" placeholder="description">
	<br>
	<input type="text" name="pictitle" placeholder="title">
	<br>
	<input type="text" name="picheader" placeholder="header">
	<br>
    <input type="submit" value="Upload Image" name="uploadImage">
</form>

</body>
</html>
