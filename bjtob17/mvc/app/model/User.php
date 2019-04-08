<?php


namespace app\model;


use DateTime;

class User extends Entity
{
    /**
     * @var int
     */
    public $user_id;

    /**
     * @var string
     */
    public $username;

    /**
     * User constructor.
     * @param int $user_id
     * @param string $username
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(int $user_id, string $username, DateTime $createdAt, DateTime $updatedAt)
    {
        parent::__construct($createdAt, $updatedAt);
        $this->user_id = $user_id;
        $this->username = $username;
    }


}