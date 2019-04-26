<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-03-21
 * Time: 13:13
 */
require 'dbmanager.php';

$users = getUsers();
for ($x = 0; $x < sizeof($users); $x++) {
    echo '<div class="boxyInside">';
    echo $users[$x]['username'];
    echo '</div>';
}