<?php
namespace Controllers;

use DependencyInjector\DependencyInjectionContainer;
use Routing\IRequest;

class PhotoController extends BaseController
{

    /**
     * PhotoController constructor.
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);
    }

    public function index(IRequest $request)
    {
        return $this->html("photos");
    }
}