<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
?>

<html>
<head>
    <title>Main Feed</title>
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
</body>
</html>