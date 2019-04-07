<?php

namespace framework\dependencyInjection;

class DependencyInjectionContainer implements IDependencyInjectionContainer
{
    private $interfaceImplementationMap = [];

    /**
     * DependencyInjectionContainer constructor.
     */
    public function __construct()
    {
        // Manually register this instance
        $this->interfaceImplementationMap[IDependencyInjectionContainer::class] = $this;

    }


    public function register($clazz, $implString)
    {
        $this->interfaceImplementationMap[$clazz] = $this->resolve($implString);
    }

    public function get($clazz)
    {
        $impl = $this->interfaceImplementationMap[$clazz];
        return  $impl;
    }

    public function has($clazz)
    {
        return array_key_exists($clazz, $this->interfaceImplementationMap);
    }

    /**
     * Some inspiration from https://petersuhm.com/recursively-resolving-dependencies-with-phps-reflection-api-part-1/
     * @param $class
     * @return mixed|object
     * @throws \ReflectionException
     */
    private function resolve($class)
    {
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();
        $interfaces = $reflection->getInterfaceNames();

        if (!$constructor && count($interfaces) > 0) {
            if ($this->has($interfaces[0])) {
                return $this->get($interfaces[0]);
            } else {
                return new $class;
            }
        }

        if (!$constructor) {
            if ($this->has($reflection->name)) {
                return $this->get($reflection->name);
            } else {
                return new $class;
            }
        }

        $params = $constructor->getParameters();
        if (count($params) === 0 && count($interfaces) > 0 && $this->has($interfaces[0])) {
            return $this->get($interfaces[0]);
        }

        $instanceParams = [];

        foreach ($params as $param) {
            if (is_null($param->getClass())) {
                $instanceParams = null;
                continue;
            }

            array_push($instanceParams, $this->resolve($param->getClass()->getName()));
        }

        return $reflection->newInstance(...$instanceParams);
    }

// This worked, but only with single parameter constructors :-(
//    private function testingReflectionStuff($implString)
//    {
//        $reflectionClass = new \ReflectionClass($implString);
//        return $this->resolveDependencies($reflectionClass);
//    }
//
//    private function resolveDependencies(\ReflectionClass $reflectClass)
//    {
//        if (!is_null($reflectClass->getConstructor()) && $reflectClass->getConstructor()->getNumberOfParameters() > 0) {
//            foreach ($reflectClass->getConstructor()->getParameters() as $param) {
//                if (!$param->isArray() && !is_null($param->getClass())) {
//                    return $this->resolveDependencies($param->getClass());
//                }
//            }
//            return null;
//        } else {
//            if ($this->has($reflectClass->name)) {
//                return $this->get($reflectClass->name);
//            } else {
//                return null;
//            }
//        }
//    }
}