<?php 

namespace Models\DTO;

class PhotoDTO{
    public $title;
    public $caption;
    public $photoName;
    public $uploaderId;


    public function __construct($photoName, $title, $caption, $uploaderId){
        $this->photoName = $photoName;
        $this->title = $title;
        $this->caption = $caption;
        $this->uploaderId = $uploaderId;

    }
}