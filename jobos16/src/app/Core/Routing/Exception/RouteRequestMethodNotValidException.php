<?php

namespace App\Core\Routing\Exception;

use Exception;

class RouteRequestMethodNotValidException extends Exception
{

    /**
     * RouteRequestMethodNotValidException constructor.
     */
    public function __construct($method = null)
    {
        if($method) {
            parent::__construct("Request method for route is not valid: {$method}");
        } else {
            parent::__construct("Request method for route is not valid");
        }
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}