<?php
namespace framework\routing;

use framework\dependencyInjection\DependencyInjectionContainer;

class Router
{
    private $request;
    private $supportedMethods = [
        "GET", "POST"
    ];
    private $di;
    private $config;

    function __construct(IRequest $request, DependencyInjectionContainer $di, $config)
    {
        $this->request = $request;
        $this->di = $di;
        $this->config = $config;
    }

    function __call($name, $args)
    {
        list($route, $classMethodName, $middlewares) = $args;

        $objectMethod = explode("@", $classMethodName);
        $method = [new $objectMethod[0]($this->di, $this->config), $objectMethod[1]];

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
        header($this->request->serverProtocol." 405 Method Not Allowed", true, 405);
        header("Location: /405");
        die();
    }
    private function defaultRequestHandler()
    {
        header($this->request->serverProtocol." 404 Not Found", true, 404);
        //header("Location: /404");
        die();
    }

    /**
     * Resolves a route
     */
    function resolve()
    {
        list($method, $routeArguments) = $this->getMethod($this->request);
        if(is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        $middlewares = $this->getMiddlewares($this->request);
        list($middlewaresPassed, $middlewaresFailed) = $this->middlewareHandler($middlewares);
        if ($middlewaresPassed) {
            echo call_user_func_array($method, array($this->request, $routeArguments));
        } else {
            die($middlewaresFailed);
        }
    }

    private function middlewareHandler($middlewares)
    {
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

       return [$middlewaresPassed, $middlewareFailed];
    }

    private function getMiddlewares($request)
    {
        $middlewaresDictionary = $this->{strtolower($this->request->requestMethod."-middleware")};
        $formattedRoute = $this->formatRoute($request->requestUri);
        $middlewares = [];
        foreach($middlewaresDictionary as $definedRoute => $wares) {
            $definedRouteAsRegex = $this->regexizeRoute($definedRoute);
            if (preg_match($definedRouteAsRegex, $formattedRoute)) {
                $middlewares = $wares;
                break;
            }
        }

        return $middlewares;
    }

    private function getMethod($request)
    {
        $methodDictionary = $this->{strtolower($request->requestMethod)};
        $requestedRoute = $this->formatRoute($request->requestUri);
        $routeArguments = [];
        $method = null;
        foreach ($methodDictionary as $definedRoute => $definedMethod) {
            $definedRouteAsRegex = $this->regexizeRoute($definedRoute);
            if (preg_match($definedRouteAsRegex, $requestedRoute)) {
                $method = $definedMethod;
                $routeArguments = $this->getRouteArguments($definedRoute, $request);
                break;
            }
        }

        return [$method, $routeArguments];
    }

    private function regexizeRoute($route) {
        $parts = [];
        foreach (explode("/", $route) as $part) {
            if (strpos($part, "{") !== false) {
                $regexedPart = preg_replace("/\{(.*)\}/", "(.*)", $part);
                array_push($parts, $regexedPart);
            } else {
                array_push($parts, $part);
            }
        }

        $joinedParts = join("/", $parts);
        $regexedRoute =  "/^".str_replace("/", "\/", $joinedParts)."$/";

        return $regexedRoute;
    }

    private function getRouteArguments($route, $request) {
        $keys = [];
        foreach(explode("/", $route) as $part) {
            if (strpos($part, "{") !== false) {
                $pattern = "/\{|\}/";
                $partWithoutBrackets = preg_replace($pattern, "", $part);
                array_push($keys, $partWithoutBrackets);
            } else {
                array_push($keys, $part);
            }
        }

        $values = explode("/", $request->requestUri);
        unset($keys[0]);
        unset($values[0]);
        $combinedArray = [];
        if (count($keys) === count($values)) {
            $combinedArray = array_combine($keys, $values);
        }

        return $combinedArray;
    }

    function __destruct()
    {
        $this->resolve();
    }
}
