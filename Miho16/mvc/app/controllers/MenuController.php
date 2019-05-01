<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:35
 */

namespace controllers;
use core\Controller;
class MenuController extends Controller
{
    public function index () {
        header("location: /Miho16/mvc/public/home");
    }
}
