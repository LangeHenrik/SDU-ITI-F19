<?php


namespace models;


class Comment
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var string
     */
    public $byThisUser;

    /**
     * @var int
     */
    public $commentId;

    /**
     * @var int
     */
    public $feedEntryId;

    /**
     * Comment constructor.
     * @param string $text
     * @param int $userId
     * @param string $byThisUser
     * @param int $commentId
     * @param int $feedEntryId
     */
    public function __construct(string $text, int $userId, string $byThisUser, int $commentId, int $feedEntryId)
    {
        $this->text = $text;
        $this->userId = $userId;
        $this->byThisUser = $byThisUser;
        $this->commentId = $commentId;
        $this->feedEntryId = $feedEntryId;
    }


}