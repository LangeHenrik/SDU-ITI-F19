<?php

namespace app;

use app\repositories\IOtherRepository;
use app\repositories\IPictureRepository;
use app\services\IPictureService;
use app\util\Config;
use framework\database\IDatabaseConnection;
use framework\dependencyInjection\DependencyInjectionContainer;
use framework\routing\Router;
use framework\util\IConfig;

class App
{
    private $router;
    private $di;

    public function __construct()
    {
        $this->di = new DependencyInjectionContainer();
        $this->registerDependencies();

        $this->router = new Router($this->di);
        $this->setRoutes();
    }

    public function start()
    {
        $this->setRoutes();
        $this->registerDependencies();
    }

    private function setRoutes()
    {
        $this->router->get("/bla/{id}/{name}/", "app\\controllers\\HomeController@index");
        $this->router->get("/api/users", "app\\controllers\\UserController@getUsers");
        $this->router->get("/api/pictures/user/{userId}",
            "app\\controllers\\PictureController@getImagesForUser");
        $this->router->post("/api/pictures/user/{userId}",
            "app\\controllers\\PictureController@uploadImage");
    }

    private function registerDependencies()
    {
        $this->di->register(IConfig::class, "app\\util\\Config");
        $this->di->register(IDatabaseConnection::class, "framework\\database\\DatabaseConnection");
        $this->di->register(IOtherRepository::class, "app\\repositories\\OtherRepository");
        $this->di->register(IPictureRepository::class, "app\\repositories\\PictureRepository");
        $this->di->register(IPictureService::class, "app\\services\\PictureService");
    }
}