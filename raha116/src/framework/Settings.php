<?php
declare(strict_types=1);

namespace framework;


use models\Configuration;
use models\DatabaseConfiguration;

class Settings
{
    private $cached_settings;

    public $database;

    public function get_settings()
    {
        if (!$this->cached_settings) {

            $this->cached_settings = new Configuration();

            $dbconf = new DatabaseConfiguration();
            $dbconf->username = $GLOBALS['username'];
            $dbconf->password = $GLOBALS['password'];
            $dbconf->database = $GLOBALS['dbname'];
            $dbconf->server = $GLOBALS['servername'];

            $this->cached_settings->database = $dbconf;
        }

        return $this->cached_settings;
    }
}