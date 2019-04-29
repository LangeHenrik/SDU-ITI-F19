<?php

session_start();
if (!isset($_SESSION['login_user'])){
    header("location: login.php");
}

?>

<html>

<head>


    <link href="css/global.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/index.js"></script>

    <script>
        $(document).ready(function(){

            $('#content').load("feed.php");

        });
    </script>

</head>
<body>
<nav id="nav">
<ul>
    <li><a href="#" data-target="feed">Feeds</a></li>
    <li><a href="#" data-target="upload">Upload/View</a></li>
    <li><a href="#" data-target="users">Users</a></li>
    <li><a href="logout.php" data-target="logout" >Logout</a></li>
</ul>
</nav>

<div id="content" class="container">

</div>

</body>


</html>