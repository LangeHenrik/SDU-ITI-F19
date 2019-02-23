<?php

namespace Controllers;


use DependencyInjector\DependencyInjectionContainer;
use Repositories\Interfaces\IPhotoRepository;
use Services\Auth;

class ProfileController extends BaseController
{
    /**
     * @var IPhotoRepository
     */
    private $photoRepository;

    /**
     * IndexController constructor.
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);

        $this->photoRepository = $di->get(IPhotoRepository::class);
    }

    public function index()
    {
        return $this->html("profile", ["page_title" => "Profile", "photos" => $this->photoRepository->getPhotoForUser(Auth::getLoggedinUsername())]);
    }
}