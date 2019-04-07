<?php

namespace app;

use app\repository\IOtherRepository;
use app\repository\IPictureRepository;
use app\service\IPictureService;
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
        $this->router->get("/bla/{id}/{name}/", "app\\controller\\HomeController@index");
        $this->router->get("/api/users", "app\\controller\\UserController@getUsers");
        $this->router->get("/api/pictures/user/{userId}",
            "app\\controller\\PictureController@getImagesForUser");
        $this->router->post("/api/pictures/user/{userId}",
            "app\\controller\\PictureController@uploadImage");
    }

    private function registerDependencies()
    {
        $this->di->register(IConfig::class, "app\\util\\Config");
        $this->di->register(IDatabaseConnection::class, "framework\\database\\DatabaseConnection");
        $this->di->register(IPictureRepository::class, "app\\repository\\PictureRepository");
        $this->di->register(IPictureService::class, "app\\service\\PictureService");
    }
}