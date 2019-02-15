<?php


namespace controllers;


use database\UserRepository;
use framework\ActionResult;
use framework\ControllerBase;
use models\CreateUserRequest;

class UserController extends ControllerBase
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    public function get(): ActionResult
    {
        return $this->Ok(null);
    }

    public function post(CreateUserRequest $body)
    {
        return $this->Ok($body);
    }
}