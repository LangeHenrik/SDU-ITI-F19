<?php
include "init.php";

use Routing\Router;
use Routing\Request;
use Routing\IRequest;

use Controllers\IndexController;
use Controllers\AuthController;
use Controllers\UserController;

use Repositories\UserRepository;

use Middleware\RequiresAuthMiddleware;

$userRepo = new UserRepository();

$router = new Router(new Request());

// Parameters: route, [controllerObject, controllerMethod], [middlewareObjects]
$router->get("/", [new IndexController(), "index"], [] );
$router->post("/profile", [new IndexController(), "upload"], [new RequiresAuthMiddleware()] );
$router->get("/users", [new UserController($userRepo), "users"], [new RequiresAuthMiddleware()] );

$router->get("/login", [new AuthController($userRepo), "getLogin"], [] );
$router->get("/logout", [new AuthController($userRepo), "logout"], [] );
$router->post("/login", [new AuthController($userRepo), "postLogin"], [] );
