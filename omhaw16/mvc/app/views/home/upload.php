<!DOCTYPE html>
<html>
<head>

        <title> Upload </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
        <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>

</head>

<body>

<h1> PhotoPost - Upload </h1>
<p class = 'tagline'> - Your photo-sharing website </p>

 <?php $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);?>     
    <?php include $pathroot . '/omhaw16/mvc/app/controllers/HomeController.php';?>

    <?php $hc = new HomeController();
    $postedby = $_SESSION['userID'];
    $imgname = basename($_FILES["fileToUpload"]["name"]);
    $imgtitle = $_POST["imgtitle"];
    $imgdesc = $_POST["imgdesc"];
    $hc->uploadPic($postedby,$imgname,$imgtitle,$imgdesc);?>

<p> Here you can upload any image you desire! </p>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <p class ="guide"> Select image to upload: </p>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <br>
    <label for="imgtitle">Image title</label>
    <br>
    <input type="text" name="imgtitle" id="imgtitle">
    <br>
    <br>
    <label for="imgtitle">Additional text</label>
    <br>
    <textarea name="imgdesc" id="imgdesc"> </textarea>
    <br>
    <br>
    <input type="submit" value="Upload Image" style="color: black" name="submitimg">
</form>

</body>
</html>