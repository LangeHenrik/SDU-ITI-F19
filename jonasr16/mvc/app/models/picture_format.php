<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 30-04-2019
 * Time: 14:10
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