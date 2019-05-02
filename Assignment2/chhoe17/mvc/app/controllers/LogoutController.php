<?php

//var_dump($_POST);

include_once("../Models/logout.php");
//Use model
$model = new Logout();


if(isset($_POST)){
    $model->logoutUser();
}