<?php 

namespace Models;

use Models\User;

class Photo{
    public $photoId;
    public $title;
    public $caption;
    public $uploadDate;
    public $photoName;
    public $uploader;


    public function __construct($photoId, $title, $caption, $uploadDate, $photoName, User $uploader){
        $this->photoId = $photoId;
        $this->title = $title;
        $this->caption = $caption;
        $this->uploadDate = $uploadDate;
        $this->photoName = $photoName;
        $this->uploader = $uploader;

    }
}