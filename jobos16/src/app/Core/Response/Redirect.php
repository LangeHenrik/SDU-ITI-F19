<?php

namespace App\Core\Response;

class Redirect
{

    private $_url = "";

    /**
     * Redirect constructor.
     * @param string $url
     */
    protected function __construct(string $url)
    {
        $this->_url = $url;
    }

    /**
     * Continence method
     *
     * @param string $url
     * @return Redirect
     */
    public static function to(string $url)
    {
        return new Redirect($url);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->_url;
    }


}