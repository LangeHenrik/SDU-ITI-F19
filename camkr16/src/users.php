<?php

require "connection.php";

session_start();
if (!isset($_SESSION["id"])) {
    header("location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>User list</title>
    <link href="style/feed.css" rel="stylesheet">

</head>
<body>
<div>
    <a href=index.php class="signout">Picturefeeding</a>
</div>
<div>
    <a href="logout.php" class="signout">Sign out</a>
</div>
<h1 class="headertitle">User list</h1>

<?php
$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

for ($x = 0; $x < sizeof($users); $x++) {
    echo '<div class="entry">';
    echo htmlspecialchars($users[$x]['username']);
    echo '</div>';
}

?>


</body>

</html>
