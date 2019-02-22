<?php


namespace DependencyInjector;


class DependencyInjectionContainer
{
    private $interfaceImplementationMap;

    public function register($interfaceClass, $impl)
    {
        $this->interfaceImplementationMap[$interfaceClass] = $impl;
    }

    public function get($interfaceClass)
    {
        return $this->interfaceImplementationMap[$interfaceClass];
    }
}