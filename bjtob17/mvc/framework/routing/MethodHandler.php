<?php


namespace framework\routing;


use framework\util\RouteUtil;

class MethodHandler
{
    private $methodDictionary = [];


    public function addMethod($httpMethod, $route, $controllerMethod)
    {
        $formattedRoute = RouteUtil::formatRoute($route);

        $this->methodDictionary[strtolower($httpMethod)][$formattedRoute] = $controllerMethod;
    }

    /**
     * @param Request $request
     * @return array array containing two items: The controller method, and and array of arguments supplied in the route.
     */
    public function getMethod(Request $request): array
    {
        $requestedRoute = RouteUtil::formatRoute($request->requestUri);
        $routeArguments = [];
        $method = null;
        foreach ($this->methodDictionary[strtolower($request->requestMethod)] as $definedRoute => $definedMethod) {
            $definedRouteAsRegex = RouteUtil::regexizeRoute($definedRoute);
            if (preg_match($definedRouteAsRegex, $requestedRoute)) {
                $method = $definedMethod;
                $routeArguments = RouteUtil::getRouteArguments($definedRoute, $request);
                break;
            }
        }

        return [$method, $routeArguments];
    }


}