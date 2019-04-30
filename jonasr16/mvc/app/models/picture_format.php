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
    public $id;
    public $title;
    public $blob;
    public $description;

    public function __construct($id ,$title, $blob, $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->blob = $blob;
        $this->description = $description;
    }
}