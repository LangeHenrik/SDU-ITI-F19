<?php

namespace controllers;
use core\Controller;
use models\HomeModel;

class HomeController extends Controller {
	
	public function index () {
	    $homeModel = new HomeModel();
		return $this->view("home/Home", array("pictures" => $homeModel->getImages()));
	}

    public function log_out(){
        session_destroy();
        header("location: /mifor16/mvc/public/home");
    }

    public function get_latest_images() {

    }
	
}