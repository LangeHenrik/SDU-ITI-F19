<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
?>

<html>
<head>
    <title>PHP Test</title>
</head>
<body>
<?php echo '<p>Hello World</p>'; ?>
<nav id="nav">
    <ul>
        <!--<li><a href="#" data-target="feed">Feeds</a></li>-->
        <!--<li><a href="#" data-target="upload">Upload/View</a></li></ul>-->
        <li><a href="users.php" data-target="users">Users</a></li>
        <li><a href="logout.php" data-target="logout" >Logout</a></li>
    </ul>
</nav>
</body>
</html>