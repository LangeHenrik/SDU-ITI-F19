<?php

namespace App\Core\Routing\Exception;

use Exception;

class RouteNotFoundException extends Exception
{

    /**
     * RouteNotFoundException constructor.
     */
    public function __construct($uri = null)
    {
        if($uri) {
            parent::__construct("No route found for request URI: {$uri}");
        } else {
            parent::__construct("No route found for request URI");
        }
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}