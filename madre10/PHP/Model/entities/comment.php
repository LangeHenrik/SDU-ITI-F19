<?php

class Comment
{
    public $id;
    public $user_id;
    public $image_id;
    public $content;
    public $created_on;
    public $username;

    /**
     * Comment constructor.
     * @param $id
     * @param $user_id
     * @param $image_id
     * @param $content
     * @param $created_on
     */
    public function __construct($id, $user_id, $image_id, $content, $created_on, $username=null)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->image_id = $image_id;
        $this->content = $content;
        $this->created_on = $created_on;
        $this->username = $username;
    }

}
