<?php


namespace framework\routing;


use framework\util\RouteUtil;

class MiddlewareHandler
{
    private $middlewareDictionary = [];

    public function addMiddleware(string $httpMethod, string $route, array $middlewares)
    {
        $formattedRoute = RouteUtil::formatRoute($route);
        if (!is_null($middlewares) && is_array($middlewares)) {
            $this->middlewareDictionary[strtolower($httpMethod)][$formattedRoute] = $middlewares;
        }
    }

    /**
     * @param Request $request
     * @return array contains three elements: 1: (Boolean) True if all middlewares passed. 2: (IRequest) request object. 3: (IResponse) Response object of failed middleware
     */
    public function handleMiddlewares(Request $request): array
    {
        $middlewares = $this->getMiddlewares($request);

        $middlewaresPassed = true;
        $middlewareResponse = null;
        foreach ($middlewares as $middleware) {
            list($success, $mwRequest, $response) = call_user_func_array([$middleware, "handle"], [$request]);
            $request = $mwRequest;
            if ($success == false) {
                $middlewaresPassed = false;
                $middlewareResponse = $response;
                break;
            }
        }

        return [$middlewaresPassed, $request, $middlewareResponse];
    }

    private function getMiddlewares(Request $request): array
    {
        $formattedRoute = RouteUtil::formatRoute($request->requestUri);

        $middlewares = [];
        foreach ($this->middlewareDictionary[strtolower($request->requestMethod)] as $route => $wares) {
            $routeAsRegex = RouteUtil::regexizeRoute($route);
            if (preg_match($routeAsRegex, $formattedRoute)) {
                $middlewares = $wares;
                break;
            }
        }

        return $middlewares;
    }


}