<?php

class APIImageModel
{
    public $idGallery;
    public $imageTitle;
    public $imageDesc;
    public $imageName;

    public function __construct($idGallery, $imageTitle, $imageDesc, $imageName)
    {
        $this->idGallery = $idGallery;
        $this->imageTitle = $imageTitle;
        $this->imageDesc = $imageDesc;
        $this->imageName = $imageName;
    }

}