<?php

class UserImagesController extends Controller {

	public function index () {
        $images=$this->model('UserImages');
        $viewbag["initialUserImages"]=$images->loadInitialImages();
        $this->view('home/userImages', $viewbag);
    }


    public function getimages(){
        $images=$this->model('UserImages');
        $images->getimages();
    }

    public function removeImage(){
        $images=$this->model('UserImages');
        $viewbag["removeImageResponse"]=$images->removeImage();
        header("Location: /magle17/mvc/public/UserImages/");
    }

 
    
}