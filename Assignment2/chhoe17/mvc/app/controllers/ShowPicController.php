<?php


include_once("../../Models/showPicModel.php");

//Use model
$model = new showPicModel();



 if(isset($_SESSION['u_id'])){
    $model->showPic();
}