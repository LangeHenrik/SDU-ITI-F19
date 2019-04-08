<?php


namespace app\model;


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
    public $image;

    /**
     * Picture constructor.
     * @param int $image_id
     * @param string $title
     * @param string $description
     * @param string $image
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct(int $image_id, string $title, string $description, string $image, \DateTime $createdAt, \DateTime $updatedAt)
    {
        parent::__construct($createdAt, $updatedAt);
        $this->image_id = $image_id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

}