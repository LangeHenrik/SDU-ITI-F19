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
     * @return array contains two elements: True if all middleware passed (bool) and a message (string)
     */
    public function handleMiddlesware(Request $request): array
    {
        $middlewares = $this->getMiddlewares($request);

        $middlewaresPassed = true;
        $middlewareFailedMessage = "Middleware failed";
        foreach ($middlewares as $middleware) {
            list($returnVal, $msg) = call_user_func_array([$middleware, "apply"], [$request]);
            if ($returnVal == false) {
                $middlewaresPassed = false;
                $middlewareFailedMessage = $msg;
                break;
            }
        }

        return [$middlewaresPassed, $middlewareFailedMessage];
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