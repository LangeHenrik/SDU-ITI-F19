<?php


namespace app\util;


use framework\util\IConfig;

class Config implements IConfig
{

    /**
     * @var array
     */
    private $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = include $_SERVER["DOCUMENT_ROOT"] . "/app/config.php";
    }


    function getConfig(): array
    {
        return $this->config;
    }

    function get(string $key)
    {
        return $this->config["key"];
    }
}