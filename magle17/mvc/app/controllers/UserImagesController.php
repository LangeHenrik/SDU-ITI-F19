<?php

class UserImagesController extends Controller {
    private $viewbag=[];
	public function index () {
        $images=$this->model('UserImages');
        $this->viewbag["initialUserImages"]=$images->loadInitialImages();
        $this->view('home/userImages', $this->viewbag);
    }


    public function getimages(){
        $images=$this->model('UserImages');
        $images->getimages();
    }

    public function removeImage(){
        $images=$this->model('UserImages');
        $this->viewbag["removeImageResponse"]=$images->removeImage();
        $this->index();
    }

 
    
}