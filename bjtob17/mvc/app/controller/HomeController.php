<?php

namespace app\controller;

use framework\controller\BaseController;
use framework\response\IResponse;
use framework\routing\IRequest;

class HomeController extends BaseController
{
    public function index(IRequest $request, int $id, string $name): IResponse
    {
        return $this->html("index", ["id" => $id, "name" => $name]);
    }

    public function index_(IRequest $request): IResponse
    {
        return $this->html("index",[
            "page_title" => "Home"
        ]);
    }

    public function jsonTest(IRequest $request): IResponse
    {
        return $this->json($request);
    }
}