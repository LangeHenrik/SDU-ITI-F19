<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;

class UserController extends ControllerBase
{
    public function get(): ActionResult
    {
        return $this->Ok(null);
    }
}