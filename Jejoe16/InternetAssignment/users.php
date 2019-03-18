<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 15-03-2019
 * Time: 09:15
 */



?>
<html lang="en">
<head>
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <title>users</title>
</head>
<body>


<h1>Username List</h1>
<?php
include("database.php");

$users = getallusers();
for ($x = 0; $x < sizeof($users); $x++) {

    echo '<div class="containerInside">';
    echo $users[$x]['username'];
    echo '</div>';

}


?>

</body>



</html>