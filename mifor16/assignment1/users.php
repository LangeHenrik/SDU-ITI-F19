<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-03-20
 * Time: 09:52
 */
?>

<html lang="en">
<head>
    <link href="mystylesheet.css" type="text/css" rel="stylesheet">
    <title>users</title>
</head>
<body>


<h1>List of Registered Users</h1>
<nav id="nav">
    <a href="index.php">INDEX</a>
    <a href="users.php">USERS</a>
    <a href="logout.php">LOGOUT</a>
</nav>
<br><br><br>
<?php
require "dbmanager.php";

$users = getUsers();
for ($x = 0; $x < sizeof($users); $x++) {
    echo '<div class="boxyInside">';
    echo $users[$x]['username'];
    echo '</div>';
}
?>

</body>


</html>