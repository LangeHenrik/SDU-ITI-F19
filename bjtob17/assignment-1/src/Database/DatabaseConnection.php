<?php

namespace Database;

use Database\Interfaces\IDatabaseConnection;
use DependencyInjector\DependencyInjectionContainer;
use PDO;

class DatabaseConnection implements IDatabaseConnection
{
    private $config;
    private $di;
    private $pdo;

    /**
     * DatabaseConnection constructor.
     * @param $config
     * @param DependencyInjectionContainer $di
     */
    public function __construct($config, DependencyInjectionContainer $di)
    {
        $this->config = $config;
        $this->di = $di;
        $this->pdo = $this->createPdo();
    }

    private function createPdo(): PDO
    {
        $dsn = "mysql:host=".$this->config['db_host'].";dbname=".$this->config['db_database'].";port=".$this->config['db_port'].";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            return new PDO($dsn, $this->config["db_username"], $this->config["db_password"], $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }

}