<?php

class Post
{
    public $id;
    public $owner;
    public $file_name;
    public $uploaded_on;
    public $title;
    public $description;
    public $image;

    /**
     * Post constructor.
     * @param $id
     * @param $owner
     * @param $file_name
     * @param $uploaded_on
     * @param $title
     * @param $description
     */
    public function __construct($id, $owner, $file_name, $uploaded_on, $title, $description, $base64img=null)
    {
        $this->id = $id;
        $this->owner = $owner;
        $this->file_name = $file_name;
        $this->base64img = $base64img;
        $this->uploaded_on = $uploaded_on;
        $this->title = $title;
        $this->description = $description;
    }

}
