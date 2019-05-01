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
    public static function convert_to_object(array $arr, string $type)
    {
        $instance = new $type;

        return self::fill_instance($arr, $instance);
    }

    public static function fill_instance(array $arr, object $instance)
    {
        try {
            $reflection = new ReflectionClass($instance);

            $props = $reflection->getProperties();

            foreach ($props as $prop) {
                $key = $prop->getName();


                if (array_key_exists($key, $arr)) {
                    $value = $arr[$key];

                    $prop->setValue($instance, $value);
                }
            }


        } catch (Exception $e) {
            die('Failed to reflection on $arr');
        }

        return $instance;
    }
}