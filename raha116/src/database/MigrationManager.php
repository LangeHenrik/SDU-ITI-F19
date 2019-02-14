<?php
declare(strict_types=1);

namespace database;

use mysql_xdevapi\Exception;
use utilities\IO;


class MigrationManager
{
    private const MIGRATION_DIRECTORY = "./migrations";
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
        $stmt = $this->connection->prepare("
CREATE TABLE IF NOT EXISTS migrations(
      name varchar(200) primary key,
      date timestamp default (now())
    );");

        if (!$stmt->execute()) {
            throw new \Exception("Failed to create migration table");
        }
    }

    private function get_migration_files()
    {
        $files = scandir(self::MIGRATION_DIRECTORY);

        sort($files);

        return $files;
    }

    private function execute_migration($file)
    {
        $file_path = IO::join_paths(self::MIGRATION_DIRECTORY, $file);
        $migration_content = file_get_contents($file_path);

        $migration_stmt = $this->wrap_migration_statement($migration_content, $file);

        if (!$migration_stmt->execute()) {
            $err = $migration_stmt->error;
            throw new Exception("Failed to run migration: $err");
        }

    }

    private function wrap_migration_statement(string $sql, string $migration_name)
    {
        //language=sql
        $query = "
START TRANSACTION;

case when ((select null from migrations where name = ?) is empty)
  then
-- Run the action migration query
$sql

-- Add the migration to the migration table, so we don't run it the next time
insert into migrations(name) values (?);
  end;

COMMIT;";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $migration_name);

        return $stmt;
    }
}