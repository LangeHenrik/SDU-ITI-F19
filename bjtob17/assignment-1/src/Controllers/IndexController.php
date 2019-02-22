<?php
namespace Controllers;

use Repositories\PhotoRepository;
use Routing\IRequest;

class IndexController extends BaseController
{

    private $photoRepository;

    /**
     * IndexController constructor.
     * @param $config
     * @param $photoRepository
     */
    public function __construct($config, PhotoRepository $photoRepository)
    {
        parent::__construct($config);
        $this->photoRepository = $photoRepository;
    }

    public function index(IRequest $request): string
    {
        return $this->html("index", ["photos" => $this->photoRepository->getAll()]);
    }
}