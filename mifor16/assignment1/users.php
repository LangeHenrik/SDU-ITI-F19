<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: Login.php");
}
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>List of Registered Accounts</title>
    <link href="mystylesheet.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('a#button').click(function () {
                $.ajax({
                    url: 'ajax_call.php',
                    success: function (response) {
                        $('#container').html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
<h1>List of Accounts</h1>
<nav id="nav">
    <a href="index.php">INDEX</a>
    <a href="users.php">USERS</a>
    <a href="uploadimage.php">UPLOAD</a>
    <a href="logout.php">LOGOUT</a>
</nav>
<br><br><br><br>
<button><a id="button">Fetch Users</a></button>

<p id="container"><!-- currently it's empty --></p>


</body>
</html>