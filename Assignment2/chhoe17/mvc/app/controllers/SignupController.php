<?php

include_once("../Models/signup.php");

//Use model
$model = new Signup();


if(isset($_POST)){
    $model->signUpUser($_POST['name'], $_POST['password'],
     $_POST['phone'], $_POST['zip'], $_POST['email']);
}