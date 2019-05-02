<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 26-04-2019
 * Time: 11:04
 */

namespace models;


class UserResponse
{
    public $user_id;
    public $username;

    /**
     * UserResponse constructor.
     * @param $user_id
     * @param $username
     */
    public function __construct($user_id, $username)
    {
        $this->user_id = $user_id;
        $this->username = $username;
    }

}