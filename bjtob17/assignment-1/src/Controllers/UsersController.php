<?php
namespace Controllers;

use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\UserDto;
use Repositories\Interfaces\IPhotoRepository;
use Repositories\Interfaces\IUserRepository;
use Routing\IRequest;

class UsersController extends BaseController
{

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * IndexController constructor.
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);
        $this->userRepository = $di->get(IUserRepository::class);
    }

    public function index(IRequest $request): string
    {
        return $this->html("users", ["page_title" => "Users", "users" => $this->userRepository->getAll()]);
    }
}