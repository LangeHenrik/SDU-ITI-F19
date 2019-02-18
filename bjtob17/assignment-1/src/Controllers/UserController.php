<?php


namespace Controllers;


use Repositories\UserRepository;

class UserController extends BaseController
{
    private $userRepo;

    /**
     * @param $userRepo UserRepository
     */
    public function __construct($userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function users()
    {
        return $this->json($this->userRepo->getAll());
    }
}