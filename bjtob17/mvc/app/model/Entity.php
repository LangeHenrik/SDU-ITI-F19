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
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct(string $createdAt, string $updatedAt)
    {
        $this->createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $createdAt);
        $this->createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $updatedAt);
    }
}