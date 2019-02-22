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

$router = new Router(new Request(), $diContainer, $config);

$diContainer->register(IUserRepository::class,  new UserRepository());
$diContainer->register(IPhotoRepository::class, new PhotoRepository());

// Parameters: route, "Fully\\Namespaced\\Controller@method", [middlewareObjects]
$router->get("/", "Controllers\\IndexController@index", [] );
$router->get("/photos", "Controllers\\PhotoController@index", [] );
$router->get("/users", "Controllers\\UserController@users", [new RequiresAuthMiddleware()] );

$router->get("/login", "Controllers\\AuthController@getLogin", [] );
$router->get("/logout", "Controllers\\AuthController@logout", [] );
$router->post("/login", "Controllers\\AuthController@postLogin", [] );
