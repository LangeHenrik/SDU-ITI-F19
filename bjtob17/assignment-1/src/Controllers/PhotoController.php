<?php
namespace Controllers;

use Routing\IRequest;

class PhotoController extends BaseController
{

    /**
     * PhotoController constructor.
     * @param $config
     */
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function index(IRequest $request)
    {
        return $this->html("photos");
    }
}