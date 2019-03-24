<?php

namespace app;

use framework\database\IDatabaseConnection;
use framework\dependencyInjection\DependencyInjectionContainer;
use framework\routing\Router;

class App
{
    private $router;
    private $di;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->di = new DependencyInjectionContainer($this->config);
        $this->router = new Router($this->di, $this->config);
    }

    public function start()
    {
        $this->setRoutes();
        $this->registerDependencies();
    }

    private function setRoutes()
    {
        $this->router->get("/bla/{id}/{name}/", "app\\controllers\\HomeController@index");
        $this->router->get("/json", "app\\controllers\\HomeController@jsonTest");
    }

    private function registerDependencies()
    {
        $this->di->register(IDatabaseConnection::class, "framework\\database\\DatabaseConnection");
    }
}