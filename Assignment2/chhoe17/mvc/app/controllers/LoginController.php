<?php

//var_dump($_POST);

include_once("../Models/login.php");
//Use model
$model = new Login();


if(isset($_POST)){
    $model->loginUser($_POST['name'],$_POST['password']);
}