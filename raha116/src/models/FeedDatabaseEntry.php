<?php


namespace models;


class FeedDatabaseEntry
{
    /**
     * @var int
     */
    public $entry_id;
    /**
     * @var int
     */
    public $user_id;
    /**
     * @var int
     */
    public $image_id;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $title;

    /**
     * FeedDatabaseEntry constructor.
     */
    public function __construct()
    {
        settype($this->entry_id, 'int');
        settype($this->user_id, 'int');
        settype($this->image_id, 'int');
    }


}