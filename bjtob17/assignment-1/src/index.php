<?php
include "init.php";

use Routing\Router;
use Routing\Request;
use Routing\IRequest;

use Controllers\IndexController;
use Controllers\ValuesController;
use Controllers\AuthController;

use Middleware\RequiresAuthMiddleware;

$router = new Router(new Request());

// Parameters: route, [controllerObject, controllerMethod], [middlewareObjects]
$router->get("/", [new IndexController(), "index"], [new RequiresAuthMiddleware()] );
$router->get("/values", [new ValuesController(), "values"], [] );
$router->get("/login", [new AuthController(), "getLogin"], [] );
$router->post("/login", [new AuthController(), "postLogin"], [] );

$router->get("/logout", [new AuthController(), "logout"], [] );

$router->get("/profile", function(IRequest $request) {
    return "hello";
}, [] );
