<?php
namespace App\Core\Routing;


abstract class Controller
{

    /**
     * Controller middlewares
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }



}