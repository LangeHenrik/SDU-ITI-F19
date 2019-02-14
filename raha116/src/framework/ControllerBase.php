<?php


namespace framework;

use stdClass;

/**
 * A base for other controllers to implement and expand on
 * @package framework
 */
abstract class ControllerBase
{
    const PATTERN = "/controllers\\\\(\w+)Controller/";

    public function __toString()
    {
        return static::class;
    }

    /**
     * Gets the path handle
     * e.g. "/api/foo" for FooController
     *
     * @return string
     */
    public function get_controller_path_handle(): string
    {
        $className = static::class;

        $matches = array();

        if (!preg_match(self::PATTERN, $className, $matches)) {
            die("$className doesn't follow the controller form of (Name)Controller");
        }

        $name = $matches[1];

        return strtolower($name);
    }

    protected function Ok($response): ActionResult
    {
        return new ActionResult($response, 200);
    }

    protected function NotFound(): ActionResult
    {
        return new ActionResult(new stdClass(), 404);
    }
}