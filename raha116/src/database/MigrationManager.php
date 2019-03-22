<?php
declare(strict_types=1);

namespace database;

use Exception;
use utilities\IO;
use utilities\strings;


class MigrationManager
{
    private const MIGRATION_DIRECTORY = "migrations";
    /**
     * @var DatabaseConnection
     */
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function run_migrations()
    {
        $this->create_migration_table();

        $migration_files = $this->get_migration_files();

        foreach ($migration_files as $file) {
            $this->execute_migration($file);
        }
    }

    private function create_migration_table()
    {
        $result = $this->connection->run_query("
CREATE TABLE IF NOT EXISTS migrations(
      name varchar(200) primary key,
      date timestamp default (now())
    );");

        if ($result == false) {
            throw new Exception("Failed to create migration table: " . $this->connection->get_last_error());
        }

        $result->fetchAll();
    }

    private function get_migration_files()
    {
        $files = scandir(IO::join_paths(__DIR__, self::MIGRATION_DIRECTORY));

        $files = array_filter($files, function ($file) {
            return strings::ends_with($file, ".sql");
        });

        if (!$files) {
            die("No migration files found");
        }

        sort($files);

        return $files;
    }

    private function execute_migration(string $file)
    {
        if (!$this->connection->begin_transaction()) {
            throw new Exception("Failed to begin transaction for migration: " . $this->connection->get_last_error());
        }

        // Check if we need to run the given migration
        $migration = $this->connection->query_single_row("select name from migrations where name = ?", Migration::class, $file);

        if ($migration != null) {
            error_log("Migration already run: $file");
            $this->connection->rollback_transaction();
            return;
        }


        // Actually load the migration to run
        $file_path = IO::join_paths(__DIR__, self::MIGRATION_DIRECTORY, $file);


        // Run the migration
        $migration_content = file_get_contents($file_path);

        $result = $this->connection->run_multi_query($migration_content);
        if ($result == false) {
            $message = "Failed to run migration $file: " . $this->connection->get_last_error();
            error_log($message);
            throw new Exception($message);
        }
        $result->fetchAll();

        $result = $this->connection->execute_prepared_query("insert into migrations(name) values(?)", $file);
        $result->fetchAll();

        // Commit the changes
        if (!$this->connection->commit_transaction()) {
            $message = "Failed to commit migration transaction: " . $this->connection->get_last_error();
            error_log($message);
            throw new Exception($message);
        }

        error_log("Ran migration $file");
    }

}