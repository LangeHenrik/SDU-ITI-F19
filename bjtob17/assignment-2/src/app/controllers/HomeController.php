<?php

namespace app\controllers;

use framework\controllers\BaseController;
use framework\routing\IRequest;

class HomeController extends BaseController
{
    public function index(IRequest $request, array $routeArguments) {
        echo $routeArguments["id"];
        $this->html("index");
    }
}