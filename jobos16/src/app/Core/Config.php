<?php

namespace App\Core;


use App\Core\Persistence\File\File;

class Config
{

    private static $instance;
    private $_data = [];

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->_data = json_decode(File::get("env.json"), true);
    }

    public static function instance() : Config
    {
        if (self::$instance === null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public static function get($path)
    {
        $config = static::instance()->getData();
        $path = explode("/", $path);

        foreach ($path as $seg) {
            if(isset($config[$seg])) {
                $config = $config[$seg];
            }
        }

        return $config;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->_data;
    }


}