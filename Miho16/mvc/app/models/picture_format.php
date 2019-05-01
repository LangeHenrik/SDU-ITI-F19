<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:38
 */
namespace models;
class picture_format
{
    public $image_id;
    public $title;
    public $description;
    public $image;
    public function __construct($id ,$title, $description, $blob)
    {
        $this->image_id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $blob;
    }
}
