<?php
declare(strict_types=1);

namespace framework;


class RequestResolver
{
    private $handlers;

    /**
     * @var DependencyContainer
     */
    private $di;

    public function __construct(DependencyContainer $di)
    {
        $this->handlers = array();
        $this->di = $di;
    }


    /**
     * Register a handler for the given $path and $verb
     *
     * @param string $verb The verb this method is invoked on
     * @param string $path The path the method is invoked on
     * @param string $controllerName The name of the controller to invoke
     * @param string $methodName The method to invoke on the controller
     */
    public function register_handler(string $verb, string $path, string $controllerName, string $methodName)
    {
        $callbacks = $this->handlers[strtolower($verb)] ?? array();

        $callbacks[$path] = new HandlerCallback($controllerName, $methodName, $path, $this->di);

        $this->handlers[strtolower($verb)] = $callbacks;
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
        if (!isset($this->handlers[$verb])) {
            error_log("Unknown verb: '$verb'");
            return null;
        }

        $verbs = $this->handlers[$verb];

        foreach ($verbs as $p => $callback) {
            /**
             * @var string $regexPath
             */
            $regexPath = preg_replace("/\//", "\\/", $p);

            if (preg_match("/^$regexPath$/", $path)) {
                return $callback;
            }
        }

        return null;
    }
}