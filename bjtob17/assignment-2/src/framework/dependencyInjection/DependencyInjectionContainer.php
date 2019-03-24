<?php

namespace framework\dependencyInjection;

class DependencyInjectionContainer
{
    private $interfaceImplementationMap;
    private $config;

    /**
     * DependencyInjectionContainer constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }


    public function register($interfaceClass, $implString)
    {
        $this->interfaceImplementationMap[$interfaceClass] = new $implString($this->config, $this);
    }

    public function get($interfaceClass)
    {
        return $this->interfaceImplementationMap[$interfaceClass];
    }
}