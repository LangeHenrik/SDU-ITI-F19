<?php

namespace framework\dependencyInjection;

class DependencyInjectionContainer
{
    private $interfaceImplementationMap = [];


    public function register($interfaceClass, $implString)
    {
        $dep = $this->testingReflectionStuff($implString);
        //$this->interfaceImplementationMap[$interfaceClass] = new $implString($this->config, $this);
        $this->interfaceImplementationMap[$interfaceClass] = new $implString($dep);
    }

    public function get($interfaceClass)
    {
        return $this->interfaceImplementationMap[$interfaceClass];
    }

    public function hasImplementation($interfaceClass)
    {
        return array_key_exists($interfaceClass, $this->interfaceImplementationMap);
    }


    private function testingReflectionStuff($implString)
    {
        $reflectionClass = new \ReflectionClass($implString);
        return $this->resolveDependencies($reflectionClass);
    }

    private function resolveDependencies(\ReflectionClass $reflectClass)
    {
        if (!is_null($reflectClass->getConstructor()) && $reflectClass->getConstructor()->getNumberOfParameters() > 0) {
            foreach ($reflectClass->getConstructor()->getParameters() as $param) {
                if (!$param->isArray() && !is_null($param->getClass())) {
                    return $this->resolveDependencies($param->getClass());
                }
            }
            return null;
        } else {
            if ($this->hasImplementation($reflectClass->name)) {
                return $this->get($reflectClass->name);
            } else {
                return null;
            }
        }
    }
}