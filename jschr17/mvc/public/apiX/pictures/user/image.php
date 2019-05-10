<?php
class Image {
    public $image;
    public $title;
    public $description;

    //constructor
    public function __construct($image, string $title, string $description){
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
    }
}

?>