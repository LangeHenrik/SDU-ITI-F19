<?php


include_once("../../Models/userModel.php");

$model = new userModel();


if(isset($_SESSION['u_id'])){
    $model->showUser();
}