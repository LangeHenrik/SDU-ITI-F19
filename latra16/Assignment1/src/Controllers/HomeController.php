<?php

namespace Controllers;

use Router\IRequest;

class HomeController extends Controller{


    public function __construct(){
       parent::__construct();
    }

    /**
     * 
     */
    public function render(IRequest $request) : string {
        return $this->html("Home");
    }
    
}

?>