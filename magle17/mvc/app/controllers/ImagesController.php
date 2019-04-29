<?php

class ImagesController extends Controller {
    private $viewbag=[];


    public function getimages(){
        $images=$this->model('Images');
        $images->getimages();
    }

    public function uploadImage(){
        $images=$this->model('Images');
        $images->uploadImage();
    }

}
