<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 01-05-2019
 * Time: 09:18
 */

namespace models;


class post_image_format
{
    public $image_id;

    public function __construct($id)
    {
        $this->image_id = $id;
    }
}