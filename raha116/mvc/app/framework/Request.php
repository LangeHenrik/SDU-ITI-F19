<?php
declare(strict_types=1);

namespace framework;


class Request
{
    /**
     * The path that was invoked
     *
     * @var string
     */
    public $requestPath;
    /**
     * The prefix for the request, e.g., 'raha116/mvc/public'
     *
     * @var string
     */
    public $prefix;
}