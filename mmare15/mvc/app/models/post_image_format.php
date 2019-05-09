<?php



namespace models;
class post_image_format
{
    public $image_id;
    public function __construct($id)
    {
        $this->image_id = $id;
    }
}