<?php
namespace Controllers;

use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\UserDto;
use Repositories\Interfaces\IPhotoRepository;
use Repositories\Interfaces\IUserRepository;
use Routing\IRequest;

class IndexController extends BaseController
{

    /**
     * @var IPhotoRepository;
     */
    private $photoRepository;

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
        $this->photoRepository = $di->get(IPhotoRepository::class);
        $this->userRepository = $di->get(IUserRepository::class);
    }

    public function index(IRequest $request): string
    {
        return $this->html("index", ["page_title" => "Home", "photos" => $this->photoRepository->getAll(20)]);
    }
}