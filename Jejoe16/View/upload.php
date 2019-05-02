<html>
<head>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

<form action="../Controllers/uploadController.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <br>
    <label>Image Label</label>
    <input type="text" placeholder="Image Label" name="imagename">
    <label>Comment</label>
    <input type="text" placeholder="Image Comment" name="comment">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>


</html>
