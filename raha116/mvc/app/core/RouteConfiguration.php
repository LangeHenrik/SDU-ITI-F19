<?php
declare(strict_types=1);

namespace core;


use controllers\CommentController;
use controllers\FeedController;
use controllers\HorribleApiController;
use controllers\ImageController;
use controllers\TestController;
use controllers\UserController;
use framework\RequestResolver;

class RouteConfiguration
{
    /**
     * @var RequestResolver
     */
    private $resolver;

    public function __construct(RequestResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function configure()
    {

        // Configure user routes
        $this->resolver->register_handler("GET", "/api/user", UserController::class, "index");
        $this->resolver->register_handler("POST", "/api/user", UserController::class, "post");
        $this->resolver->register_handler("POST", "/api/user/login", UserController::class, "login");
        $this->resolver->register_handler("POST", "/api/user/logout", UserController::class, "logout");
        $this->resolver->register_handler("GET", "/api/user/isLoggedIn", UserController::class, "isLoggedIn");

        // Configure feed routes
        $this->resolver->register_handler("GET", "/api/feed", FeedController::class, "index");
        $this->resolver->register_handler("POST", "/api/feed", FeedController::class, "post");
        $this->resolver->register_handler("DELETE", "/api/feed/(?<id>\d+)", FeedController::class, "delete");

        // Configure image routes
        $this->resolver->register_handler("GET", "/api/image/(?<id>\d+)", ImageController::class, "get");

        // Configure comment routes
        $this->resolver->register_handler("POST", "/api/comment", CommentController::class, "post");

        $this->resolver->register_handler("GET", "/api/test/(?<foo>\w+)/(?<bar>\w)", TestController::class, "test");

        $this->resolver->register_handler("GET", "/api/users", HorribleApiController::class, "getUsers");
        $this->resolver->register_handler("GET", "/api/pictures/user/(?<userId>\d+)", HorribleApiController::class, "getPicturesForUser");
    }
}