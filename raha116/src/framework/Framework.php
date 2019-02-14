<?php


namespace framework;


/**
 * A custom hacked framework, just for this project
 * @package framework
 */
class Framework
{
    private $di;

    public function __construct()
    {
        $this->di = new DependencyContainer();
    }

    /**
     * Leaves the rest of the execution to the framework
     */
    public function handle()
    {
        $router = $this->di->get_service(Router::class);

        $router->handle_current_request();
    }
}