<?php

namespace framework\controllers;


use framework\dependencyInjection\DependencyInjectionContainer;
use framework\responses\HtmlResponse;
use framework\responses\IResponse;
use framework\responses\JsonResponse;

class BaseController
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var DependencyInjectionContainer
     */
    protected $di;

    /**
     * BaseController constructor.
     * @param array $config
     * @param DependencyInjectionContainer $di
     */
    public function __construct(array $config, DependencyInjectionContainer $di)
    {
        $this->config = $config;
        $this->di = $di;
    }

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
