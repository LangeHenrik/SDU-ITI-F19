<?php

namespace framework\database;

use framework\util\IConfig;
use PDO;

class DatabaseConnection implements IDatabaseConnection
{
    private $config;
    private $pdo;

    /**
     * DatabaseConnection constructor.
     * @param IConfig $config
     */
    public function __construct(IConfig $config)
    {
        $this->config = $config->getConfig();
        $this->pdo = $this->createPdo($this->config);
    }

    private function createPdo($config): PDO
    {
        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_database']};port={$config['db_port']};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
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