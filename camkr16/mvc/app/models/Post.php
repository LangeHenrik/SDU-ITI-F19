<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 25-04-2019
 * Time: 16:01
 */

namespace models;


class Post
{
    public $id;
    public $title;
    public $description;
    public $extension;
    public $userid;
    public $file;

    /**
     * Post constructor.
     * @param $id
     * @param $title
     * @param $description
     * @param $extension
     * @param $userid
     */
    public function __construct($id, $title, $description, $extension, $userid, $file)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->extension = $extension;
        $this->userid = $userid;
        $this->file = $file;
    }

    public function getImageFile()
    {
        if ($this->file) {
            return $this->file;
        } else {
            return '/camkr16/mvc/public/pictures/' . htmlspecialchars($this->id) . "." . htmlspecialchars($this->extension);
        }
    }

}