<?php
namespace App\Core;


use App\Core\Response\ResponseObject;
use App\Core\Routing\Router;

class App
{

    /** @var App\Core\Router\Router */
    private $_router;

    public function __construct()
    {

    }

    public function init()
    {
        // Start session
        session_start();

        // Include helpers
        require_once('helpers.php');

        // Register class aliases
        foreach ($this->alias() as $alias => $original) {
            class_alias($original, $alias);
        }

        // Init the router
        $this->_router = Router::getInstance();
    }

    public function run() {
        $routeReponse = $this->_router->run();

        // Set response
        if($routeReponse) {
            $responseObject = new ResponseObject($routeReponse);

            // Set response headers
            foreach ($responseObject->getHeaders() as $key => $value) {
                header("{$key}: {$value}");
            }

            // Return response string
            return $responseObject->getResponse();
        }
    }

    private function alias()
    {
        return [
            'Route'     => 'App\Core\Routing\Route',
            'Input'     => 'App\Core\Utility\Input',
            'User'      => 'App\User',
            'Picture'   => 'App\Picture',
        ];
    }

}