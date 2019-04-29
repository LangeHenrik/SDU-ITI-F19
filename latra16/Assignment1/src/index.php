<?php

include "init.php";

use Router\Router;
use Router\Request;

$router = new Router(new Request);

// Routes
$router->get("/", "Controllers\\HomeController@render");
$router->get("/photos", "Controllers\\PhotosController@render");

$router->get("/users", "Controllers\\UsersController@render");

$router->get("/photos/upload", "Controllers\\PhotosController@getUpload");
$router->get("/photos/details", "Controllers\\PhotosController@getDetails");
$router->post("/photos/upload", "Controllers\\PhotosController@uploadPhoto");

$router->get("/login", "Controllers\\LoginController@render");
$router->post("/login", "Controllers\\LoginController@login");
$router->get("/logout", "Controllers\\LoginController@logout");

$router->get("/signup", "Controllers\\SignUpController@render");
$router->post("/signup", "Controllers\\SignUpController@register");