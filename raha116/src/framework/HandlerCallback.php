<?php


namespace framework;


use ReflectionClass;
use ReflectionMethod;

class HandlerCallback
{
    /**
     * @var ControllerBase
     */
    private $controller;
    /**
     * @var string
     */
    private $verb;


    public function __construct(ControllerBase $controller, string $verb)
    {
        $this->controller = $controller;
        $this->verb = $verb;
    }


    public function __invoke()
    {
        $method = $this->get_controller_method();
        return $method->invoke($this->controller);
    }

    private function get_controller_method(): ReflectionMethod
    {
        $reflection = new ReflectionClass($this->controller);

        return $reflection->getMethod(strtolower($this->verb));
    }

}