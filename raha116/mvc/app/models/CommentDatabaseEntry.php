<?php


namespace models;


class CommentDatabaseEntry
{
    /**
     * The id of the user who made the comment
     *
     * @var int
     */
    public $user_id;

    /**
     * The text of the comment
     *
     * @var string
     */
    public $text;

    /**
     * @var int
     */
    public $comment_id;

    /**
     * Id of the feed entry this comment belongs to
     * @var int
     */
    public $feed_entry_id;

    public function __construct()
    {
        settype($this->user_id, 'int');
        settype($this->comment_id, 'int');
        settype($this->feed_entry_id, 'int');
    }


}