<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 26-04-2019
 * Time: 11:17
 */

namespace models;


class ImageResponse
{
    public $image_id;
    public $image;
    public $title;
    public $description;

    /**
     * ImageResponse constructor.
     * @param $image
     * @param $title
     * @param $description
     */
    public function __construct($image_id, $image, $title, $description)
    {
        $this->image_id = $image_id;
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
    }

}