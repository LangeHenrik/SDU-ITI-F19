<?php

namespace controllers;
use core\Controller;
use models\HomeModel;
use services\ImageConversionService;

class HomeController extends Controller {
	
	public function index () {
	    $homeModel = new HomeModel();
	    $posts = $homeModel->getImages();
	    $imageService = new ImageConversionService();
	    $newarray = $imageService->convertArray($posts);
		return $this->view("home/Home", array("pictures" => $newarray));
	}

    public function log_out(){
        session_destroy();
        header("location: /mifor16/mvc/public/home");
    }

    public function get_latest_images() {

    }
	
}