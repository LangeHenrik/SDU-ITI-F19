<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 22-03-2019
 * Time: 10:40
 */



require 'DB_manager.php';
$result = userdb();


for($item = 0; $item <= sizeof($result)-1; $item++) {
    echo '<h3> id: ' . $result[$item]['user_id'] . '<br>username: '. $result[$item]['username'] . '</h3>';

}

?>
<html>
<form action="gallery.php">
    <input type="Submit" value="back">
</form>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</html>