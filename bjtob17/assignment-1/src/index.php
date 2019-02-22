<?php
include "init.php";

use DependencyInjector\DependencyInjectionContainer;


use Routing\Router;
use Routing\Request;
use Routing\IRequest;

use Controllers\IndexController;
use Controllers\AuthController;
use Controllers\UserController;
use Controllers\PhotoController;

use Repositories\Interfaces\IUserRepository;
use Repositories\Interfaces\IPhotoRepository;
use Repositories\UserRepository;
use Repositories\PhotoRepository;

use Middleware\RequiresAuthMiddleware;

$diContainer = new DependencyInjectionContainer();

$userRepo = new UserRepository();
$photoRepo = new PhotoRepository();

$router = new Router(new Request(), $diContainer);

$diContainer->set(IUserRepository::class, $userRepo);
$diContainer->set(IPhotoRepository::class, $photoRepo);

// Parameters: route, [controllerObject, controllerMethod], [middlewareObjects]
$router->get("/", [new IndexController($config, $photoRepo), "index"], [] );
$router->get("/photos", [new PhotoController($config), "index"], [] );
$router->get("/users", [new UserController($userRepo, $config), "users"], [new RequiresAuthMiddleware()] );

$router->get("/login", [new AuthController($userRepo, $config), "getLogin"], [] );
$router->get("/logout", [new AuthController($userRepo, $config), "logout"], [] );
$router->post("/login", [new AuthController($userRepo, $config), "postLogin"], [] );
