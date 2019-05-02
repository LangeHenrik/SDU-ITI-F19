<?php
declare(strict_types=1);

namespace framework;

use Exception;
use ReflectionClass;
use ReflectionException;

/**
 * A very simple IOC container for instantiating class easily
 * @package framework
 */
class DependencyContainer
{
    /**
     * A cache of instantiated classes
     */
    private $services;

    public function __construct()
    {
        $this->services = array();

        // Register the DI itself, so we can dependency inject it later on
        $this->register($this);
    }

    /**
     * Manually register an instance
     * @param $instance
     */
    public function register($instance)
    {
        $this->services[get_class($instance)] = $instance;
    }

    /**
     * Provides an instance of the given class
     * @param $class
     * @return mixed An instance of the requested class An instance of the requested class
     */
    public function get_service($class)
    {
        if (isset($this->services[$class])) {
            return $this->services[$class];
        }

        try {
            $instance = $this->instantiate($class);
            $this->services[$class] = $instance;
            return $instance;
        } catch (Exception $e) {
            die("Failed to create instance: $e");
        }
    }

    /**
     * Attempts to create an instance of the given class
     * @param $class
     * @return mixed
     * @throws ReflectionException
     */
    private function instantiate($class)
    {
        $reflection = new ReflectionClass($class);
        $ctor = $reflection->getConstructor();
        // If the class don't have a constructor, then we can just instantiate it
        // without any ceremony
        if (!$ctor) {
            return new $class();
        }

        $params = $ctor->getParameters();

        $created_params = array();

        foreach ($params as $param) {
            $type = $param->getType();
            $created_params[] = $this->get_service($type->getName());
        }

        return new $class(...$created_params);
    }
}
