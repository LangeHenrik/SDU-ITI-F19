<?php
include "init.php";

use DependencyInjector\DependencyInjectionContainer;


use Routing\Router;
use Routing\Request;

use Repositories\Interfaces\IUserRepository;
use Repositories\Interfaces\IPhotoRepository;

use Database\Interfaces\IDatabaseConnection;

use Middleware\RequiresAuthMiddleware;

$diContainer = new DependencyInjectionContainer($config);

$diContainer->register(IDatabaseConnection::class, "Database\\DatabaseConnection");
$diContainer->register(IUserRepository::class, "Repositories\\UserRepository");
$diContainer->register(IPhotoRepository::class, "Repositories\\PhotoRepository");

$router = new Router(new Request(), $diContainer, $config);

// Parameters: route, "Fully\\Namespaced\\Controller@method", [middlewareObjects]
$router->get("/", "Controllers\\IndexController@index", [] );
$router->get("/photos", "Controllers\\PhotoController@index", [new RequiresAuthMiddleware()] );
$router->get("/profile", "Controllers\\ProfileController@index", [new RequiresAuthMiddleware()] );

$router->post("/photos/delete", "Controllers\\PhotoController@deletePhoto", [new RequiresAuthMiddleware()] );
$router->post("/photos/new", "Controllers\\PhotoController@uploadPhoto", [new RequiresAuthMiddleware()] );

$router->get("/login", "Controllers\\AuthController@getLogin", [] );
$router->post("/login", "Controllers\\AuthController@postLogin", [] );
$router->get("/logout", "Controllers\\AuthController@logout", [] );

$router->get("/register", "Controllers\\AuthController@getRegister", [] );
$router->post("/register", "Controllers\\AuthController@postregister", [] );
