<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 25-04-2019
 * Time: 17:06
 */

namespace controllers;


use core\Controller;
use services\UserService;

class UserController extends Controller
{

 public function index(){
    $userservice = new UserService();
    $users = $userservice->loadUsers();

    return $this->view("home/users", array("users"=>$users));
 }

}