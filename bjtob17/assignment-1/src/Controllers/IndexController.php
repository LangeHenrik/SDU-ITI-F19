<?php
namespace Controllers;

use DependencyInjector\DependencyInjectionContainer;
use Repositories\Interfaces\IPhotoRepository;
use Routing\IRequest;

class IndexController extends BaseController
{

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

    public function index(IRequest $request): string
    {
        return $this->html("index", ["photos" => $this->photoRepository->getAll()]);
    }
}