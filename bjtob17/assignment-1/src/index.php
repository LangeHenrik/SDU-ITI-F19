<?php
include "init.php";

use Routing\Router;
use Routing\Request;
use Routing\IRequest;

use Controllers\IndexController;
use Controllers\AuthController;
use Controllers\UserController;
use Controllers\PhotoController;

use Repositories\UserRepository;
use Repositories\PhotoRepository;

use Middleware\RequiresAuthMiddleware;

$userRepo = new UserRepository();
$photoRepo = new PhotoRepository();

$router = new Router(new Request());

// Parameters: route, [controllerObject, controllerMethod], [middlewareObjects]
$router->get("/", [new IndexController($config, $photoRepo), "index"], [] );
$router->get("/photos", [new PhotoController($config), "index"], [] );
$router->get("/users", [new UserController($userRepo, $config), "users"], [new RequiresAuthMiddleware()] );

$router->get("/login", [new AuthController($userRepo, $config), "getLogin"], [] );
$router->get("/logout", [new AuthController($userRepo, $config), "logout"], [] );
$router->post("/login", [new AuthController($userRepo, $config), "postLogin"], [] );
