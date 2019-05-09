<?php
declare(strict_types=1);

namespace framework;


use core\RouteConfiguration;

class Router
{
    /**
     * @var DependencyContainer
     */
    private $di;
    /**
     * @var RequestResolver
     */
    private $resolver;
    /**
     * @var RouteConfiguration
     */
    private $routeConfiguration;
    /**
     * @var Request
     */
    private $request;

    public function __construct(DependencyContainer $di, RouteConfiguration $routeConfiguration, RequestResolver $resolver, Request $request)
    {
        $this->di = $di;
        $this->resolver = $resolver;
        $this->request = $request;
        $routeConfiguration->configure();
    }

    public function handle_current_request()
    {
        $uri = $this->get_request_uri();
        $path = $uri->path;

        $verb = strtolower($_SERVER['REQUEST_METHOD']);

        $this->request->requestPath = $path;
        $this->request->prefix = $uri->prefix;

        $handler = $this->resolver->get_handler($path, $verb);

        if (!$handler) {
            $this->no_handler_found();
            return;
        }


        /**
         * @var ActionResult $result
         */
        $result = $handler();

        $this->respond($result);

    }

    private function get_request_uri(): URI
    {

        $url = new URI($_SERVER['REQUEST_URI']);

        return $url;
    }


    private function respond(ActionResult $result)
    {
        // Manually handled
        if ($result->get_status() == -1) {
            return;
        }

        http_response_code($result->get_status());

        if ($result->has_body()) {
            header("Content-Type: application/json");
            echo $result->to_json();
            echo "\n";
        }
    }

    private function no_handler_found()
    {
        http_response_code(404);
        header("Content-Type: application/json");
        die('{"message": "Not Found"}' . "\n");
    }
}