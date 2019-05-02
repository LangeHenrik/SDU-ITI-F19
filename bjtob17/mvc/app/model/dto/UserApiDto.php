<?php


namespace app\model\dto;


use app\model\User;

class UserApiDto
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
     * UserApiDto constructor.
     * @param int $user_id
     * @param string $username
     */
    public function __construct(int $user_id, string $username)
    {
        $this->user_id = $user_id;
        $this->username = $username;
    }

    public static function fromUser(User $user): UserApiDto
    {
        return new UserApiDto($user->user_id, $user->username);
    }


}