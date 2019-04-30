<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 09:49
 */

namespace controllers;


use core\Controller;

class RegisterController extends Controller
{

    public function index() {
        return $this->view("home/Register");
    }

    public function register() {

    }
}