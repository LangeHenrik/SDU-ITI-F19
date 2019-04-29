<?php
declare(strict_types=1);

namespace framework;


use utilities\strings;

class RequestResolver
{
    private $handlers;

    private const SIMPLE_ROUTE_REGEX = "/^\/[\w\d]+\/[\w\d]+\/$/";

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
        $verbs = $this->handlers[$path] ?? array();

        $verbs[$verb] = $callback;

        $this->handlers[$path] = $verbs;

//        echo "Registered path: '$path' with verb: '$verb'\n";
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
        if (preg_match(self::SIMPLE_ROUTE_REGEX, $path)) {
            return $this->get_simple_route_handler($path, $verb);
        } else {
            return $this->get_complex_route_handler($path, $verb);
        }


    }

    /**
     * Handles more complex routes, like POST /api/user/login => UserController->post_login
     *
     * @param string $path
     * @param string $verb
     * @return callable|null
     */
    private function get_complex_route_handler(string $path, string $verb)
    {
        $verb_prefix = $verb . "_";
        foreach ($this->handlers as $key => $value) {
            if (strings::starts_with($path, $key)) {
                foreach ($value as $handled_verb => $handler) {
                    if (strings::starts_with($handled_verb, $verb_prefix)) {
                        if ($this->handler_matches_route($path, $handled_verb)) {
                            return $handler;
                        }
                    }
                }
            }
        }
    }

    private function handler_matches_route(string $path, string $handler): bool
    {
        $path_segments = array_values(array_filter(explode("/", $path), function ($p, $index) {
            // Matches the "/api/user/" part, which we don't care about anymore
            if ($index <= 2) {
                return false;
            }

            return $p != "";
        }, ARRAY_FILTER_USE_BOTH));


        $handler_segments = array_values(array_filter(explode("_", $handler), function ($index) {
            // Get rid of the verb itself
            return $index >= 1;
        }, ARRAY_FILTER_USE_KEY));

        return $path_segments == $handler_segments;
    }

    private function get_simple_route_handler(string $path, string $verb)
    {
        if ($this->handlers[$path]) {
            return $this->handlers[$path][$verb];
        }
        return null;
    }
}