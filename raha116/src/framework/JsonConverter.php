<?php
declare(strict_types=1);

namespace framework;


use Exception;
use ReflectionClass;
use ReflectionType;

/**
 * Converts an associative array into the given model class
 *
 * @package framework
 */
class JsonConverter
{
    /**
     * Converts the given associative array into the given type
     *
     * @param array $arr
     * @param ReflectionType $type
     * @return mixed
     */
    public static function convert_to_object(array $arr, ReflectionType $type)
    {
        $className = $type->getName();
        $instance = new $className;


        try {
            $reflection = new ReflectionClass($className);

            $props = $reflection->getProperties();


            foreach ($props as $prop) {
                $key = $prop->getName();

                $value = $arr[$key];

                $prop->setValue($instance, $value);
            }


        } catch (Exception $e) {
            die('Failed to reflection on $arr');
        }

        return $instance;
    }
}