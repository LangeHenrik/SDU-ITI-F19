<?php


class Image
{
    public $image_id;
    public $image;
    public $title;
    public $description;

    public function __construct($img_id, $img, $title, $description)
    {
        $this->image_id=$img_id;
        $this->image = $img;
        $this->title = $title;
        $this->description = $description;
    }
}