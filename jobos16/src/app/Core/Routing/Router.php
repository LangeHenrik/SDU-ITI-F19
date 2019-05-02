<?php

namespace App\Core\Routing;

use App\Core\Routing\Exception\RouteNotFoundException;
use App\Core\Routing\Exception\RouteRequestMethodNotValidException;
use ReflectionClass;

class Router
{
    private static $instance = null;

    private $_routes = [];
    private $_methods = ['GET', 'HEAD', 'POST', 'PUT'];

    protected function __construct()
    {

    }

    /**
     * @return Router
     */
    public static function getInstance() : Router
    {
        if (self::$instance === null) {
            self::$instance = new Router();
            require_once __DIR__ . '/../../routes.php';
        }

        return self::$instance;
    }

    /**
     * Add route to list of routes
     *
     * @param $method
     * @param $route
     * @param $callback
     * @throws RouteRequestMethodNotValidException
     */
    public function addRoute($method, $route, $callback)
    {
        if(in_array($method, $this->_methods)) {
            $this->_routes[$method]["#^{$route}\$#"] = $callback;
        } else {
            // Throw exception if request method is not valid
            throw new RouteRequestMethodNotValidException($method);
        }
    }


    /**
     * Match current URI to a route
     *
     * @return mixed
     * @throws RouteNotFoundException
     */
    public function run()
    {
        $uri = str_replace("jobos16", "", $_SERVER["REQUEST_URI"]);

        foreach ($this->_routes[$_SERVER['REQUEST_METHOD']] as $route => $callback) {
            if (preg_match($route, strtok($_SERVER["REQUEST_URI"], '?'), $matches)) {
                return $this->call($this->_routes[$_SERVER['REQUEST_METHOD']][$route]);
            }
        }

        // Throw exception if no route was found for request uri
        throw new RouteNotFoundException($_SERVER["REQUEST_URI"]);
    }


    /**
     * Call the callback
     *
     * @param $callback
     * @return mixed
     */
    private function call($callback)
    {
        if($callback) {
            if(is_array($callback)) {
                $rc = (new ReflectionClass($callback[0]))->newInstanceWithoutConstructor();

                // Run middleware if the callback is a function inside a controller
                if($rc instanceof Controller) {
                    /** @var Controller $c */
                    $c = $rc;

                    foreach ($c->getMiddleware() as $middleware) {
                        /** @var Middleware $middlewareRC */
                        $middlewareRC = (new ReflectionClass($middleware))->newInstance();

                        // Invoke middleware
                        $middlewareResult = $middlewareRC->handle();
                        if($middlewareResult !== null) {
                            return $middlewareResult;
                        }
                    }
                }

                $res = call_user_func([new $callback[0](), $callback[1]]);
            } else if(is_callable($callback)) {
                $res = call_user_func($callback);
            }
        }

        return $res;
    }


}