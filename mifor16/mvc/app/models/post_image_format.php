<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-05-01
 * Time: 18:57
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