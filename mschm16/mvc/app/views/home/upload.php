<!DOCTYPE html>
<html>
<head>
<title>Upload</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/mschm16/mvc/app/assets/css/style.css">
</head>
<body>

    <?php $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     
        include $pathroot . '/mschm16/mvc/app/views/partials/navi.php';
        include $pathroot . '/mschm16/mvc/app/views/partials/logout.php';
        include $pathroot . '/mschm16/mvc/app/controllers/HomeController.php';
    ?>
    <h1>Upload</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $hc = new HomeController();
        $postedby = $_SESSION['userID'];
        $imgname = basename($_FILES["fileToUpload"]["name"]);
        $imgtitle = $_POST["imgtitle"];
        $imgdesc = $_POST["imgdesc"];
        $hc->uploadPic($postedby,$imgname,$imgtitle,$imgdesc);
    }
    ?>

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