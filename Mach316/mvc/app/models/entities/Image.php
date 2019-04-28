<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 11:01
 */



class Image {
    public $image_id;
    public $title;
    public $description;
    public $userId;
    public $fileName;
    public $comments;

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->image_id;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->image_id = $id;
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->title;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header)
    {
        $this->title = $header;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->description;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->description = $text;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function _toString()
    {
        return "$this->title : $this->description : $this->fileName";
    }
}