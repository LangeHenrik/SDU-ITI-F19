<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

include_once("../Models/login.php");

$model = new login();

$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($_POST)){
    $model->VerifyUser($_POST['username'],$_POST['password']);
}
?>
