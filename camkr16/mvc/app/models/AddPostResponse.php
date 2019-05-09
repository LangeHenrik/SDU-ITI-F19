<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 26-04-2019
 * Time: 12:10
 */

namespace models;

class AddPostResponse {
    public $image_id;

    /**
     * AddPostResponse constructor.
     * @param $image_id
     */
    public function __construct($image_id)
    {
        $this->image_id = $image_id;
    }
}
