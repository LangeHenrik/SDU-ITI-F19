<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 24-04-2019
 * Time: 09:01
 */

include_once($_SERVER['DOCUMENT_ROOT'] . "/Jejoe16/Models/Users.php");


class userController
{

    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getUserList()
    {
        $this->model->getUsers();
    }

    public function getJsonUsers()
    {
        $this->model->getApiUsers();
    }

    public function getimageFromID($id)
    {
        $this->model->getimageFromID($id);
    }

    public function VerifyUser($myusername, $mypassword){

        $result = checkUser($myusername, $mypassword);
        $count = count($result);

        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }

}