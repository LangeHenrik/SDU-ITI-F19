<?php

namespace app\controllers;

use framework\controllers\BaseController;
use framework\responses\IResponse;
use framework\routing\IRequest;

class HomeController extends BaseController
{
    public function index(IRequest $request, $id, $name): IResponse
    {
        return $this->html("index", ["id" => $id, "name" => $name]);
    }

    public function jsonTest(IRequest $request): IResponse
    {
        return $this->json($request);
    }
}