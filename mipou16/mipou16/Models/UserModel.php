<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */


class UserModel
{
    private $username = "";
    private $uuid = "";

    function __construct($usernameS, $uuidS)
    {
        $this->username = $usernameS;
        $this->uuid = $uuidS;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}