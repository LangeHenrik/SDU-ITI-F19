<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: Login.php");
}
require 'dbmanager.php';
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Index</title>
<link href="mystylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<h1>Index</h1>
<nav id="nav">
    <a href="index.php">INDEX</a>
    <a href="users.php">USERS</a>
    <a href="uploadimage.php">UPLOAD</a>
    <a href="logout.php">LOGOUT</a>
</nav>
<br><br><br><br>

<?php
$latestimages = getImages();

for($item = 0; $item <= sizeof($latestimages)-1; $item++) {
    echo '<div class="boxyInside">';
    echo '<h2>' . $latestimages[$item]['title'] . '</h2>';
    echo '<h5>' . 'Submitted by: ' . $latestimages[$item]['username'] . '</h5>';

    echo '<div class="resize">';
    echo '<img src="' . $latestimages[$item]['path'] . '"/>';
    echo '</div>';
    echo '<h4>' . 'Description:' . '</h4>' . $latestimages[$item]['description'];
    echo '</div>';
}
?>


</body>
</html>