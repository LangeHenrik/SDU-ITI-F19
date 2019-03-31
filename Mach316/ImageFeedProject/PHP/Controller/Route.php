<?php


/**
 * Class Route
 * Based on https://steampixel.de/en/simple-and-elegant-url-routing-with-php/
 * - Simple and Elegant URL Routing with PHP by Christoph Stitz
 */

class Route
{
    private static $routes = Array();
    private static $pathNotFound = null;
    private static $mthodNotAllowed = null;

    public static function add($expression, $function, $method = 'get')
    {
        array_push(self::$routes, Array(
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ));
    }

    public static function pathNotFound($function)
    {
        self::$pathNotFound = $function;
    }

    public static function methodNotAllowed($function) {
        self::$mthodNotAllowed = $function;
    }

    public  static function run($basepath = '/')
    {
        $requestedURL = parse_url($_SERVER['REQUEST_URI']);
        $requestMethod = $_SERVER['REQUEST_METHOD'];


        if(isset($parsed_url['path'])){
            $path = $requestedURL['path'];
        }else{
            $path = '/';
        }
        $pathFound = false;
        $routeFound = false;



        foreach (self::$routes as $route) {
            //TODO: handle the request by looking up the route -> function

            if(preg_match('#'.$route['expression'].'#',$path,$matches)){

                $pathFound = true;
                if(strtolower($requestMethod) == strtolower($route['method'])) {

                }

                $expression = "Something"; //TODO: This has to the function expression (Not the full URL) ?

                call_user_func_array($route['function'], $expression);


            }


            break;
        }
        if(!$routeFound){

            // But a matching path exists
            if($pathFound){
                header("HTTP/1.0 405 Method Not Allowed");
                if(self::$methodNotAllowed){
                    call_user_func_array(self::$methodNotAllowed, Array($path,$requestMethod));
                }
            }else{
                header("HTTP/1.0 404 Not Found");
                if(self::$pathNotFound){
                    call_user_func_array(self::$pathNotFound, Array($path));
                }
            }

        }

    }

}
