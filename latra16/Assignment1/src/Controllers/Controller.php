<?php

namespace Controllers;

class Controller{

    public function __construct(){

    }
    
    protected function html(string $view, $data = []) : string {
        header('Content-Type: text/html');
        include __DIR__ . "/../" . "/Views/".$view.".php";
        return "";
    }
    
}

?>