<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 22-03-2019
 * Time: 10:40
 */



require 'DB_manager.php';
$result = userdb();
for ($x = 0; $x < sizeof($result); $x++) {
    echo "User: ";
    echo $result[$x]["username"];
    echo "<br>";
}

?>
