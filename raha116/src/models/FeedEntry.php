<?php


namespace models;


class FeedEntry
{
    public $entryId;

    /**
     * @var string
     */
    public $imageUrl;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * The id of the user who uploaded this image
     *
     * @var int
     */
    public $userId;

    /**
     * Indicates if the entry was added by this user
     *
     * @var bool
     */
    public $byThisUser;

    /**
     * The comments on this entry
     * @var Comment[]
     */
    public $comments;

    /**
     * FeedEntry constructor.
     * @param int $entryId
     * @param string $imageUrl
     * @param string $title
     * @param string $description
     * @param int $userId
     * @param bool $byThisUser
     * @param Comment[] $comments
     */
    public function __construct(int $entryId, string $imageUrl, string $title, string $description, int $userId, bool $byThisUser, array $comments)
    {
        $this->entryId = $entryId;
        $this->imageUrl = $imageUrl;
        $this->title = $title;
        $this->description = $description;
        $this->userId = $userId;
        $this->byThisUser = $byThisUser;
        $this->comments = $comments;
    }


}