<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-03-21
 * Time: 13:13
 */
#use \mifor16\mvc\app\models\UsersModel;
#require $_SERVER['DOCUMENT_ROOT'] . '/mifor16/mvc/app/models/UsersModel';
echo get_include_path();
$usersModel = new UsersModel();
$users = $usersModel->getUsers();
for ($x = 0; $x < sizeof($users); $x++) {
    echo '<div class="boxyInside">';
    echo $users[$x]['username'];
    echo '</div>';
}