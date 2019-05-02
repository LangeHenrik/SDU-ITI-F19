<?php


include_once("../../Models/ApiModel.php");

$model = new ApiModel();


if(isset($_SESSION['u_id'])){
    $model->getApi();
}