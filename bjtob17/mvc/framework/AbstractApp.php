<?php


namespace framework;


use framework\dependencyInjection\DependencyInjectionContainer;
use framework\dependencyInjection\IDependencyInjectionContainer;
use framework\routing\Router;

abstract class AbstractApp
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var IDependencyInjectionContainer
     */
    protected $di;

    /**
     * AbstractApp constructor.
     */
    public function __construct()
    {
        $this->di = new DependencyInjectionContainer();
        $this->registerDependencies();

        $this->router = new Router($this->di);
        $this->setRoutes();
    }

    protected abstract function setRoutes();

    protected abstract function registerDependencies();


}