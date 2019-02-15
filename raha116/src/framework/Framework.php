<?php


namespace framework;


use database\DatabaseConnection;
use database\MigrationManager;

/**
 * A custom hacked framework, just for this project
 * @package framework
 */
class Framework
{
    private $di;

    public function __construct()
    {
        $this->di = new DependencyContainer();
    }

    /**
     * Leaves the rest of the execution to the framework
     */
    public function handle()
    {
        $this->connect_to_database();

        $router = $this->di->get_service(Router::class);

        $router->handle_current_request();
    }

    private function connect_to_database()
    {
        /**
         * @var Settings $settings
         */
        $settings = $this->di->get_service(Settings::class);

        $database = $settings->get_settings()->database;

        if (!$database) {
            die("No database settings available");
        }

        $username = $database->username;
        $password = $database->password;
        $db_name = $database->database;
        $server = $database->server;

        $conn = new DatabaseConnection($server, $username, $password, $db_name);

        $this->di->register($conn);

        $this->run_migrations($conn);
    }

    private function run_migrations(DatabaseConnection $conn)
    {
        $migration_manager = new MigrationManager($conn);

        $migration_manager->run_migrations();
    }
}