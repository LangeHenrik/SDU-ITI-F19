<?php


namespace app\model;


use DateTime;

abstract class Entity
{
    /**
     * @var DateTime
     */
    public $createdAt;

    /**
     * @var DateTime
     */
    public $updatedAt;

    /**
     * Entity constructor.
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(DateTime $createdAt, DateTime $updatedAt)
    {
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}