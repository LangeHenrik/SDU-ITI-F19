<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 23-04-2019
 * Time: 21:28
 */

include_once("../Models/feed.php");


class feedController{

    private $model;

    public function __construct($model){
        $this->model = $model;
    }

public function liketoggle(){
    $this->model->likebtn();
}

    public function getimages(){
        $this->model->feeds();
    }


}
