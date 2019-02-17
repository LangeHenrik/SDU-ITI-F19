<?php


namespace models;


class FeedEntry
{
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
     * FeedEntry constructor.
     * @param string $imageUrl
     * @param string $title
     * @param string $description
     * @param int $userId
     * @param bool $byThisUser
     */
    public function __construct(string $imageUrl, string $title, string $description, int $userId, bool $byThisUser)
    {
        $this->imageUrl = $imageUrl;
        $this->title = $title;
        $this->description = $description;
        $this->userId = $userId;
        $this->byThisUser = $byThisUser;
    }


}