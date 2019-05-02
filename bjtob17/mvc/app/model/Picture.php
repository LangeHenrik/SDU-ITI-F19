<?php


namespace app\model;


use DateTime;

class Picture extends Entity
{
    /**
     * @var int
     */
    public $image_id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;


    /**
     * @var string
     */
    public $imageData;

    /**
     * @var \DateTime
     */
    public $uploadDate;

    /**
     * @var string
     */
    public $formattedUploadDate;

    /**
     * @var User
     */
    public $user;

    /**
     * Picture constructor.
     * @param int $image_id
     * @param string $title
     * @param string $description
     * @param string $imageData
     * @param string $uploadDate
     * @param User $user
     * @param string $createdAt
     * @param string $updatedAt
     * @throws \Exception
     */
    public function __construct(int $image_id, string $title, string $description, string $imageData, string $uploadDate, User $user, string $createdAt, string $updatedAt)
    {
        parent::__construct($createdAt, $updatedAt);
        $this->image_id = $image_id;
        $this->title = $title;
        $this->description = $description;
        $this->imageData = $imageData;
        $this->uploadDate = $uploadDate;

        $dt = DateTime::createFromFormat('U', $this->uploadDate);
        $dt->setTimezone(new \DateTimeZone("Europe/Copenhagen"));
        $this->formattedUploadDate = $dt->format("M d Y, H:i");

        $this->user = $user;
    }

}