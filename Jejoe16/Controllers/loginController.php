<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 23-04-2019
 * Time: 15:10
 */

include_once("../Models/login.php");

$model = new login();

$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($_POST)){
    $model->VerifyUser($_POST['username'],$_POST['password']);
}


?>


