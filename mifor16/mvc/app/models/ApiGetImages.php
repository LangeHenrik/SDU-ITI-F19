<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 13:53
 */

namespace models;

class ApiGetImages
{
    public $image_id;
    public $title;
    public $description;
    public $image;

    public function __construct($image_id, $title, $description, $blob_data)
    {
        $this->image_id = $image_id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $blob_data;

    }
}