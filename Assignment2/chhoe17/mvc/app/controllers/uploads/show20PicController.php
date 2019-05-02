<?php


include_once("../../Models/showPicModel.php");

//Use model
$model = new show20PicModel();



 if(isset($_SESSION['u_id'])){
    $model->show20Pic();
}