<?php


include_once("../Models/uploadModel.php");

//Use model
$model = new uploadModel();


if(isset($_POST)){
    $model->uploadPic($_POST['filetitle'],$_POST['filedesc']);
}
