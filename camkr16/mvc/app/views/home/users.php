<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>User list</title>
    <link href="/camkr16/mvc/public/style/feed.css" rel="stylesheet">

</head>
<body>

<?php
require "../app/views/partials/menu.php"
?>

<h1 class="headertitle">User list</h1>

<?php
/**
 * @var \models\User $user
 */

foreach ($viewbag["users"] as $user) {
    ?>
    <div class="entry">
        <?= htmlspecialchars($user->username) ?>
    </div>
<?php

}


/*
 * for ($x = 0; $x < sizeof($users); $x++) {
    echo '<div class="entry">';
    echo htmlspecialchars($users[$x]['username']);
    echo '</div>';
 }
 *
 */


?>


</body>

</html>
