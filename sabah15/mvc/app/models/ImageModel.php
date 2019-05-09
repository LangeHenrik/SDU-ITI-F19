<?php

class ImageModel
{
    public $idGallery;
    public $userId;
    public $imageTitle;
    public $imageDesc;
    public $imageName;

    public function __construct($idGallery, $userId, $imageTitle, $imageDesc, $imageName)
    {
        $this->idGallery = $idGallery;
        $this->userId = $userId;
        $this->imageTitle = $imageTitle;
        $this->imageDesc = $imageDesc;
        $this->imageName = $imageName;
    }

}