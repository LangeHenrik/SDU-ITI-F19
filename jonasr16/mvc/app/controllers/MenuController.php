<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 30-04-2019
 * Time: 10:14
 */

namespace controllers;


use core\Controller;
class MenuController extends Controller
{
    public function index () {
        header("location: /jonasr16/mvc/public/home");
    }
}