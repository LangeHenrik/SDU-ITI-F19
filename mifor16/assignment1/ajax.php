<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

/* INSERT POINT*/


/*INSERT POINT*/
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>AJAX</title>
    <link href="mystylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<h1>Index</h1>
<nav id="nav">
    <a href="index.php">INDEX</a>
    <a href="users.php">USERS</a>
    <a href="uploadimage.php">UPLOAD</a>
    <a href="ajax.php">AJAX</a>
    <a href="logout.php">LOGOUT</a>
</nav>
<br><br><br><br>


</body>
</html>
