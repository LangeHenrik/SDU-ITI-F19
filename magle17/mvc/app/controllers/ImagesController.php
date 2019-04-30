<?php

class ImagesController extends Controller {

    public function index(){
        $images=$this->model('Images');
        $viewbag["initialImages"]=$images->loadInitialImages();
        $this->view('home/index', $viewbag);
    }

    public function getimages(){
        $images=$this->model('Images');
        $images->getimages();
    }

    public function uploadImage(){
        $images=$this->model('Images');
        $viewbag["respons"]=$images->uploadImage();
        header("Location: /magle17/mvc/public/Images/");

    }

}
