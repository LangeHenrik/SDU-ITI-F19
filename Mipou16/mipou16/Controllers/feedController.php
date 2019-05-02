<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */
include_once("../Models/feed.php");


class feedController{

    private $model;

    public function __construct($model){
        $this->model = $model;
    }
    public function liketoggle(){
        $this->model->likeButton();
    }
    public function getimages(){
        $this->model->feeds();
    }
}