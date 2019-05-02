<?php

namespace framework\routing;

use framework\dependencyInjection\IDependencyInjectionContainer;
use framework\response\HtmlResponse;
use framework\response\IResponse;
use framework\util\IConfig;

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
     * @var IDependencyInjectionContainer
     */
    private $di;

    /**
     * @var array
     */
    private $config;

    function __construct(IDependencyInjectionContainer $di)
    {
        $this->request = new Request();
        $this->methodHandler = new MethodHandler();
        $this->middlewareHandler = new MiddlewareHandler();
        $this->di = $di;
        $this->config = $this->di->get(IConfig::class)->getConfig();
    }

    public function get(string $route, string $class, string $method, array $middlewareClasses = [])
    {
        $this->setupRoute("GET", $route, $class, $method, $middlewareClasses);
    }

    public function post(string $route, string $class, string $method, array $middlewareClasses = [])
    {
        $this->setupRoute("POST", $route, $class, $method, $middlewareClasses);
    }

    private function setupRoute(string $httpMethod, string $route, string $class, string $method, array $middlewareClasses)
    {
        $method = [$this->register($class), $method];
        $middlewares = $this->instantiateMiddlewareClasses($middlewareClasses);

        $offsetRoute = $this->config["route_offset"] . $route;
        $this->methodHandler->addMethod($httpMethod, $offsetRoute, $method);
        $this->middlewareHandler->addMiddleware($httpMethod, $offsetRoute, $middlewares);
    }

    private function instantiateMiddlewareClasses($middlewareClasses): array
    {
        return array_map(function ($mw) {
            return $this->register($mw);
        }, $middlewareClasses);
    }

    private function register($class)
    {
        $this->di->register($class, $class);
        return $this->di->get($class);
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

        list($middlewaresPassed, $mwRequest, $failedMiddlewareResponse) = $this->middlewareHandler->handleMiddlewares($this->request);
        //$this->request = $mwRequest;
        if ($middlewaresPassed) {
            $args = array_merge([$mwRequest], array_values($routeArguments));

            if (!$this->isArgumentsCorrectLength($args, $method)) {
                $this->defaultRequestHandler();
                return;
            }

            $response = call_user_func_array($method, $args);
            $this->handleResponse($response);
        } else {
            $this->handleResponse($failedMiddlewareResponse);
            die();
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
