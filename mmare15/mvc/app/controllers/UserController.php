<?php


namespace controllers;
use core\Controller;
use models\UsersModel;
class UsersController extends Controller
{
    public function index() {
        return $this->view("home/Users");
    }
    public function get_users() {
        $usersService = new UsersModel();
        $users = $usersService->getUsers();
        for ($x = 0; $x < sizeof($users); $x++) {
            echo '<div class="boxyInside">';
            echo $users[$x]['username'];
            echo '</div>';
        }
    }
}