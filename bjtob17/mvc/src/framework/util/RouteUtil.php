<?php


namespace framework\util;


use framework\routing\Request;

class RouteUtil
{
    /**
     * @param string $route
     * @return string a regex'd version of the route
     */
    public static function regexizeRoute(string $route): string
    {
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
        $regexedRoute = "/^" . str_replace("/", "\/", $joinedParts) . "$/";

        return $regexedRoute;
    }

    /**
     * @param string $route
     * @param Request $request
     * @return array associative array of path arguments
     */
    public static function getRouteArguments(string $route, Request $request): array
    {
        $keys = [];
        $startIndex = 0;
        foreach (explode("/", $route) as $part) {
            if (empty($part)) {
                continue;
            }

            if (strpos($part, "{") !== false) {
                $pattern = "/\{|\}/";
                $partWithoutBrackets = preg_replace($pattern, "", $part);
                array_push($keys, $partWithoutBrackets);
            } else {
                array_push($keys, $part);
                $startIndex++;
            }
        }

        $values = [];
        foreach (explode("/", $request->requestUri) as $v) {
            if (empty($v)) {
                continue;
            }

            if (strpos($v, "?") !== false) {
                $v = explode("?", $v)[0];
            }

            array_push($values, filter_var($v, FILTER_SANITIZE_STRING));
        }
        $combinedArray = [];
        if (count($keys) === count($values)) {
            $combinedArray = array_combine($keys, $values);
        }

        return array_slice($combinedArray, $startIndex);
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param string $route
     * @return string
     */
    public static function formatRoute(string $route): string
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }
}