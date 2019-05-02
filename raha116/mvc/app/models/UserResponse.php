<?php
declare(strict_types=1);

namespace models;


class UserResponse
{

    /**
     * @var int
     */
    public $userId;

    /**
     * @var string
     */
    public $username;

    /**
     * UserResponse constructor.
     * @param int $user_id
     * @param string $username
     */
    public function __construct(int $user_id, string $username)
    {
        $this->userId = $user_id;
        $this->username = $username;
    }


}