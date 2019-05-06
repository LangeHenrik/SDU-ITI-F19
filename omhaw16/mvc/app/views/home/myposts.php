
<!DOCTYPE html>

<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
    <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>

<title> PhotoPost - My Posts </title>

</head>

<body>

<h1> PhotoPost - My Posts </h1>
<p class = 'tagline'> Your photo-sharing website. </p>

    <?php $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);?>     
    <?php include $pathroot . '/omhaw16/mvc/app/controllers/MyPostsController.php';?>
    <?php include $pathroot . '/omhaw16/mvc/app/controllers/DeletionController.php';?>


</body>

</html>

