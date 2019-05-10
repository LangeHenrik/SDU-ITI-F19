<?php

include_once("../Models/register.php");

public function index(){

  $registerModel = new Register();

  if(isset($_POST)){
    $registerModel->registerUser($_POST['username'], $_POST['password'],
     $_POST['firstName'], $_POST['lastName'],$_POST['zipcode'], $_POST['city'],
     $_POST['phoneNumber'] $_POST['email']);

  }
}
