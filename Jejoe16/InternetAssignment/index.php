<?php

session_start();
if (!isset($_SESSION['login_user'])){
    header("location: login.php");
}

?>

<html>

<head>

<link href="css/global.css" type="text/css" rel="stylesheet">
<script src="js/login.js"></script>

</head>
<body>

<ul>
    <li><a class="active" href="#feeds">Feeds</a></li>
    <li><a href="#upload">Upload/View</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>



<div>



</div>

</body>


</html>