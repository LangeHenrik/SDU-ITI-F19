<?php


namespace models;


class ValidationError
{
    public $message;

    /**
     * ValidationError constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }


}