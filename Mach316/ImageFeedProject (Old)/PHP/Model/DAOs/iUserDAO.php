<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 12:25
 */

interface iUserDAO{

    public function getUserName($id);
    public function getCurrentUser();
    public function getAllUsers();
    public function searchUsers($searchParam);
    public function registerUser($user);

}