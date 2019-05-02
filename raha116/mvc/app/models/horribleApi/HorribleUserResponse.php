<?php
declare(strict_types=1);

namespace models\horribleApi;


class HorribleUserResponse
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
     * HorribleUserResponse constructor.
     * @param int $user_id
     * @param string $username
     */
    public function __construct(int $user_id, string $username)
    {
        $this->user_id = $user_id;
        $this->username = $username;
    }


}