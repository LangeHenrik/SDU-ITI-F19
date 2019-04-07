<?php

namespace framework\controller;


use framework\response\HtmlResponse;
use framework\response\IResponse;
use framework\response\JsonResponse;

abstract class BaseController
{

    protected function html(string $viewName, array $viewBag = [], int $responseCode = 200): IResponse
    {
        return new HtmlResponse($viewName, $viewBag, $responseCode);
    }

    protected function json($data, int $responseCode = 200): IResponse
    {
        return new JsonResponse($data, $responseCode);
    }

    function redirect($url, $responseCode = 303)
    {
        header('Location: ' . $url, true, $responseCode);
        die();
    }
}
