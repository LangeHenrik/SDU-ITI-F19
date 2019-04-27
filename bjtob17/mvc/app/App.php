<?php

namespace app;


use app\controller\HomeController;
use app\controller\PictureController;
use app\controller\ProfileController;
use app\controller\UserController;
use app\middleware\ApiAuthMiddleware;
use app\middleware\WebAuthMiddleware;
use app\repository\impl\PictureRepository;
use app\repository\impl\UserRepository;
use app\repository\IPictureRepository;
use app\repository\IUserRepository;
use app\service\IAuthService;
use app\service\IEntityService;
use app\service\impl\AuthService;
use app\service\impl\EntityService;
use app\service\impl\PictureService;
use app\service\impl\UserService;
use app\service\IPictureService;
use app\service\IUserService;
use app\util\Config;
use framework\AbstractApp;
use framework\database\DatabaseConnection;
use framework\database\IDatabaseConnection;
use framework\util\IConfig;

class App extends AbstractApp
{
    protected function setRoutes()
    {
        $this->router->post("/logout", UserController::class, "postLogout");
        $this->router->get("/login", UserController::class, "getLogin");
        $this->router->post("/login", UserController::class, "postLogin");
        $this->router->get("/register", UserController::class, "getRegister");
        $this->router->post("/register", UserController::class, "postRegister");
        $this->router->get("/bla/{id}/{name}/", HomeController::class, "index");
        $this->router->get("/profile", ProfileController::class, "index", [WebAuthMiddleware::class]);
        $this->router->post("/pictures", PictureController::class, "uploadPictureOld", [WebAuthMiddleware::class]);
        $this->router->get("/pictures", PictureController::class, "getAllPictures", [WebAuthMiddleware::class]);
        $this->router->get("/users", UserController::class, "getUsersHtml", [WebAuthMiddleware::class]);
        $this->router->get("/", HomeController::class, "index_", [WebAuthMiddleware::class]);

        $this->router->get("/api/users", UserController::class, "getUsers");
        $this->router->get("/api/pictures/user/{userId}", PictureController::class, "getImagesForUser");
        $this->router->post("/api/pictures/user/{userId}", PictureController::class, "uploadImage", [ApiAuthMiddleware::class]);
    }

    protected function registerDependencies()
    {
        $this->di->register(IConfig::class, Config::class);
        $this->di->register(IDatabaseConnection::class, DatabaseConnection::class);

        $this->di->register(IUserRepository::class, UserRepository::class);
        $this->di->register(IPictureRepository::class, PictureRepository::class);

        $this->di->register(IPictureService::class, PictureService::class);
        $this->di->register(IUserService::class, UserService::class);
        $this->di->register(IAuthService::class, AuthService::class);
    }
}
