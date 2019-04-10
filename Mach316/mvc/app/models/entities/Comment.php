<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 11:01
 */

class Comment{
    public $comment;
    public $authorID;
    public $imageID;
    public $postDate;
    public $authorUsername;

    /**
     * @return mixed
     */
    public function getAuthorUsername()
    {
        return $this->authorUsername;
    }

    /**
     * @param mixed $authorUsername
     */
    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;
    }



    public function __toString()
    {
        return $this->comment . " : " . $this->authorID;
    }

    public function getComment() {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }


    /**
     * @return mixed
     */
    public function getAuthorID()
    {
        return $this->authorID;
    }

    /**
     * @param mixed $authorID
     */
    public function setAuthorID($authorID)
    {
        $this->authorID = $authorID;
    }

    /**
     * @return mixed
     */
    public function getImageID()
    {
        return $this->imageID;
    }

    /**
     * @param mixed $imageID
     */
    public function setImageID($imageID)
    {
        $this->imageID = $imageID;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * @param mixed $postDate
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
    }



}