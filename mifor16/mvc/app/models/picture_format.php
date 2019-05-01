<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-05-01
 * Time: 18:40
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