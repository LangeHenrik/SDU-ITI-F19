<?php

class ImagesController extends Controller {
    private $viewbag=[];
    public function index(){
        $images=$this->model('Images');
        $this->viewbag["initialImages"]=$images->loadInitialImages();
        $this->view('home/index', $this->viewbag);
    }

    public function getimages(){
        $images=$this->model('Images');
        $images->getimages();
    }

    public function uploadImage(){
        $images=$this->model('Images');
        $this->viewbag["respons"]=$images->uploadImage();
        header("Location: /magle17/mvc/public/Images/");

    }

}
