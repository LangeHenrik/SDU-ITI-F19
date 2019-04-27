<?php


namespace app\model\dto;


class UserLoginDto
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * UserLoginDto constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public static function fromArray(array $arr): UserLoginDto
    {
        return new UserLoginDto(
            $arr["username"],
            $arr["password"]
        );
    }


}