<?php

namespace App\Core\Routing;

use App\Core\Routing\Exception\RouteRequestMethodNotValidException;
use App\Core\Routing\Router;

class Route
{

    /**
     * GET convenience method
     *
     * @param $path
     * @param $callback
     */
    public static function get($path, $callback)
    {
        static::addRoute("GET", $path, $callback);
    }

    /**
     * POST convenience method
     *
     * @param $path
     * @param $callback
     */
    public static function post($path, $callback)
    {
        static::addRoute("POST", $path, $callback);
    }

    /**
     * Add route
     *
     * @param $method
     * @param $path
     * @param $callback
     */
    public static function addRoute($method, $path, $callback)
    {
        try {
            if(is_string($callback)) {
                $parts = explode("@", $callback);
                $callback = ["App\\Controllers\\{$parts[0]}", $parts[1]];
            }

            Router::getInstance()->addRoute($method, $path, $callback);
        } catch (RouteRequestMethodNotValidException $exception) {
            die($exception);
        }
    }

}