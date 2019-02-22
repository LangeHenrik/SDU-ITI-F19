<?php


namespace Controllers;


use DependencyInjector\DependencyInjectionContainer;
use Repositories\Interfaces\IUserRepository;
use Repositories\UserRepository;

class UserController extends BaseController
{
    private $userRepo;

    /**
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);
        $this->userRepo = $di->get(IUserRepository::class);
    }

    public function users()
    {
        return $this->json($this->userRepo->getAll());
    }
}