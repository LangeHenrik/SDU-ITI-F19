<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use models\CreateUserRequest;

class UserController extends ControllerBase
{
    public function get(): ActionResult
    {
        return $this->Ok(null);
    }

    public function post(CreateUserRequest $body)
    {
        return $this->Ok($body);
    }
}