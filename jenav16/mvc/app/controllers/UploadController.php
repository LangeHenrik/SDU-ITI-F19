<?php

class UploadController extends Controller{


    public function index ($param = "default") {
        //This is a proof of concept - we do NOT want HTML in the controllers!
        echo '<br><br>Default Upload controller<br>';
        echo 'Param: ' . $param . '<br><br>';
    }



    public function upload($param){
        //This is a proof of concept - we do NOT want HTML in the controllers!
        echo '<br><br>Upload method called<br>';
        echo 'Param: ' . $param . '<br><br>';
    }






}