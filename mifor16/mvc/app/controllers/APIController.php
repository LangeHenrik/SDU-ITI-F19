<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 12:04
 */

namespace controllers;

use core\Controller;
use models\UsersModel;

class APIController extends Controller
{
    public function users() {
        $userModel = new UsersModel();

        $users_in_system = $userModel->getUsers();


    }
}