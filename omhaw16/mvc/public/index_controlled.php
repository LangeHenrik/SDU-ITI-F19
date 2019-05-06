<!DOCTYPE html>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> PhotoPost </title>
  <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
  <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>
</head>

<body>

<h1> Welcome to PhotoPost! </h1>

<p class = 'tagline'> - Your photo-sharing website </p>

    <?php $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);?>     
    <?php include $pathroot . '/omhaw16/mvc/app/controllers/HomeController.php';?>

</body>

</html>