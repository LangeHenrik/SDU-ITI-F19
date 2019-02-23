<?php
/**
 * Created by IntelliJ IDEA.
 * User: bt
 * Date: 22/02/19
 * Time: 19:41
 */

namespace Models\Dto;


use Models\User;

class UserDto
{
    public $username;
    public $hashedPassword;

    /**
     * UserDto constructor.
     * @param $username
     * @param $plainTextPassword
     */
    public function __construct($username, $plainTextPassword)
    {
        $this->username = $username;
        $this->hashedPassword = User::generateHash($plainTextPassword);
    }

}