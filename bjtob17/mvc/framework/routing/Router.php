<?php

namespace framework\routing;

use framework\dependencyInjection\DependencyInjectionContainer;
use framework\responses\HtmlResponse;
use framework\responses\IResponse;

class Router
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var MethodHandler
     */
    private $methodHandler;

    /**
     * @var MiddlewareHandler
     */
    private $middlewareHandler;

    /**
     * @var DependencyInjectionContainer
     */
    private $di;

    /**
     * @var array
     */
    private $config;

    function __construct(DependencyInjectionContainer $di, array $config)
    {
        $this->request = new Request();
        $this->methodHandler = new MethodHandler();
        $this->middlewareHandler = new MiddlewareHandler();
        $this->di = $di;
        $this->config = $config;
    }

    public function get($route, $classAndMethod, $middlewares = [])
    {
        $this->setupRoute("GET", $route, $classAndMethod, $middlewares);
    }

    public function post($route, $classAndMethod, $middlewares = [])
    {
        $this->setupRoute("POST", $route, $classAndMethod, $middlewares);
    }

    private function setupRoute($httpMethod, $route, $classAndMethod, $middlewares)
    {
        $classMethodArray = explode("@", $classAndMethod);
        $method = [new $classMethodArray[0]($this->config, $this->di), $classMethodArray[1]];

        $offsetRoute = $this->config["route_offset"] . $route;
        $this->methodHandler->addMethod($httpMethod, $offsetRoute, $method);
        $this->middlewareHandler->addMiddleware($httpMethod, $offsetRoute, $middlewares);
    }


    private function defaultRequestHandler()
    {
        $this->handleResponse(HtmlResponse::create404Response());
        die();
    }

    /**
     * Resolves a route
     * @throws \ReflectionException
     */
    private function resolve()
    {
        list($method, $routeArguments) = $this->methodHandler->getMethod($this->request);
        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        list($middlewaresPassed, $middlewaresFailed) = $this->middlewareHandler->handleMiddlesware($this->request);
        if ($middlewaresPassed) {
            $args = array_merge([$this->request], array_values($routeArguments));

            if (!$this->isArgumentsCorrectLength($args, $method)) {
                $this->defaultRequestHandler();
                return;
            }

            $response = call_user_func_array($method, $args);
            $this->handleResponse($response);
        } else {
            die($middlewaresFailed);
        }
    }

    /**
     * @param array $suppliedArguments
     * @param $method
     * @return bool
     * @throws \ReflectionException
     */
    private function isArgumentsCorrectLength(array $suppliedArguments, $method): bool
    {
        $reflectionController = new \ReflectionClass($method[0]);
        return count($suppliedArguments) === $reflectionController->getMethod($method[1])->getNumberOfParameters();
    }

    private function handleResponse(IResponse $response)
    {
        http_response_code($response->getResponseCode());
        header("Content-Type: " . $response->getContentType());
        echo $response->getContent();
    }

    /**
     * @throws \ReflectionException
     */
    function __destruct()
    {
        $this->resolve();
    }
}
