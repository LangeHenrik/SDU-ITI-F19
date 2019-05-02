<?php


namespace models;


class IsLoggedInResponse
{
    public $isLoggedIn;

    /**
     * IsLoggedInResponse constructor.
     * @param $isLoggedIn
     */
    public function __construct($isLoggedIn)
    {
        $this->isLoggedIn = $isLoggedIn;
    }


}