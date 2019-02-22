<?php


namespace Controllers;


use Repositories\UserRepository;

class UserController extends BaseController
{
    private $userRepo;

    /**
     * @param $userRepo UserRepository
     * @param $config
     */
    public function __construct(UserRepository $userRepo, $config)
    {
        parent::__construct($config);
        $this->userRepo = $userRepo;
    }

    public function users()
    {
        return $this->json($this->userRepo->getAll());
    }
}