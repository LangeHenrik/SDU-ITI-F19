<?php

namespace app\controller;

use app\service\IPictureService;
use framework\controller\BaseController;
use framework\response\IResponse;
use framework\routing\IRequest;

class HomeController extends BaseController
{

    /**
     * @var IPictureService
     */
    private $pictureService;

    /**
     * HomeController constructor.
     * @param IPictureService $pictureService
     */
    public function __construct(IPictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }


    public function index(IRequest $request): IResponse
    {
        return $this->html("index",[
            "page_title" => "Home",
            "photos" => $this->pictureService->findAll(20)
        ]);
    }

}