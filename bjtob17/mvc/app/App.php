<?php

namespace app;

use app\repository\IPictureRepository;
use app\service\IPictureService;
use framework\AbstractApp;
use framework\database\IDatabaseConnection;
use framework\util\IConfig;

class App extends AbstractApp
{
    protected function setRoutes()
    {
        $this->router->get("/bla/{id}/{name}/", "app\\controller\\HomeController@index");

        $this->router->get("/api/users", "app\\controller\\UserController@getUsers");
        $this->router->get("/api/pictures/user/{userId}",
            "app\\controller\\PictureController@getImagesForUser");
        $this->router->post("/api/pictures/user/{userId}",
            "app\\controller\\PictureController@uploadImage");
    }

    protected function registerDependencies()
    {
        $this->di->register(IConfig::class, "app\\util\\Config");
        $this->di->register(IDatabaseConnection::class, "framework\\database\\DatabaseConnection");
        $this->di->register(IPictureRepository::class, "app\\repository\\PictureRepository");
        $this->di->register(IPictureService::class, "app\\service\\PictureService");
    }
}