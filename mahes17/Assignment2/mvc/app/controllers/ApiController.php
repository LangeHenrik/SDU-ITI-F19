<?php


include_once("../../Models/ApiModel.php");

$model = new API();


if(isset($_SESSION['u_id'])){
    $model->getApi();
}
