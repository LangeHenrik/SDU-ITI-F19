<?php
namespace Routing;

class Router
{
    private $request;
    private $supportedMethods = [
        "GET", "POST"
    ];

    function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    function __call($name, $args)
    {
        list($route, $method, $middlewares) = $args;

        if (!in_array(strtoupper($name), $this->supportedMethods))
        {
            $this->invalidMethodHandler();
        }
        $formattedRoute = $this->formatRoute($route);

        $this->{strtolower($name)}[$formattedRoute] = $method;

        if (!is_null($middlewares) && is_array($middlewares)) {
            $this->{strtolower($name)."-middleware"}[$formattedRoute] = $middlewares;
        }
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param string $route
     * @return string
     */
    private function formatRoute(string $route): string
    {
        $result = rtrim($route, '/');
        if ($result === '')
        {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
        echo "Method not allowed";
    }
    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
        echo "Not found";
    }

    /**
     * Resolves a route
     */
    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $middlewaresDictionary = $this->{strtolower($this->request->requestMethod."-middleware")};
        $formattedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formattedRoute];
        $middlewares = $middlewaresDictionary[$formattedRoute];
        if(is_null($method))
        {
            $this->defaultRequestHandler();
            return;
        }
        $middlewaresPassed = true;
        $middlewareFailed = "Middleware failed";
        if (!is_null($middlewares) && is_array($middlewares)) {
            foreach ($middlewares as $middleware) {
                list($returnVal, $msg) = call_user_func_array([$middleware, "apply"], array($this->request));
                if ($returnVal === false) {
                    $middlewaresPassed = false;
                    $middlewareFailed = $msg;
                    break;
                }
            }
        }

        if ($middlewaresPassed) {
            echo call_user_func_array($method, array($this->request));
        } else {
            die($middlewareFailed);
        }
    }

    function __destruct()
    {
        $this->resolve();
    }
}