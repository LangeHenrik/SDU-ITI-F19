<?php
include_once(__DIR__."\\..\\core\\Database.php");

class ImagesTable extends Database {

    public function __construct(){
        $this -> tablename = 'myImages';
        parent::__construct();
    }
}