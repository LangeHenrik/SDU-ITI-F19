<?php
declare(strict_types=1);

namespace framework;


class RequestResolver
{
    private $handlers;

    public function __construct()
    {
        $this->handlers = array();
    }


    /**
     * Register a handler for the given $path and $verb
     *
     * @param string $path
     * @param string $verb
     * @param callable $callback
     */
    public function register_handler(string $path, string $verb, callable $callback)
    {
        $verb = strtolower($verb);

        $verbs = $this->handlers[$path] ?? array();

        $verbs[$verb] = $callback;

        $this->handlers[$path] = $verbs;
    }

    /**
     * Get a handler for the given $path and $verb
     * Will return null if no handler is available
     *
     * @param string $path
     * @param string $verb
     * @return callable|null
     */
    public function get_handler(string $path, string $verb)
    {
        if ($this->handlers[$path]) {
            return $this->handlers[$path][$verb];
        }
        return null;
    }
}