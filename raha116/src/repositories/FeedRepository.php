<?php


namespace repositories;


use database\DatabaseConnection;
use Exception;
use models\FeedDatabaseEntry;

class FeedRepository
{
    /**
     * @var DatabaseConnection
     */
    private $conn;

    public function __construct(DatabaseConnection $connection)
    {
        $this->conn = $connection;
    }


    /**
     * Get the full feed
     * @return array<FeedDatabaseEntry>
     */
    public function get_full_feed(): array
    {
        return $this->conn->query_multiple_rows("select entry_id, user_id, image_id, description, title from feed_entries", FeedDatabaseEntry::class, "");
    }

    /**
     * Creates a new entry in the database
     *
     * @param int $user_id
     * @param int $image_id
     * @param string $description
     * @param string $title
     * @return FeedDatabaseEntry
     */
    public function create_feed_entry(int $user_id, int $image_id, string $description, string $title)
    {
        if (!$this->conn->begin_transaction()) {
            throw new Exception("Failed to create transaction: " . $this->conn->get_last_error());
        }

        $this->conn->execute_prepared_query("insert into feed_entries(user_id, image_id, description, title) VALUES (?, ?, ?, ?)", "iiss", $user_id, $image_id, $description, $title);

        $inserted_id = $this->conn->query_single_row("select LAST_INSERT_ID() as entry_id", FeedDatabaseEntry::class, "");

        $inserted = $this->get_feed_entry($inserted_id->entry_id);

        if (!$this->conn->commit_transaction()) {
            throw new Exception("Failed to commit transaction: " . $this->conn->get_last_error());
        }

        return $inserted;
    }

    /**
     * Gets the specific entry, or null if it doesn't exist
     *
     * @param int $entry_id
     * @return FeedDatabaseEntry|null
     */
    public function get_feed_entry(int $entry_id)
    {
        return $this->conn->query_single_row("select entry_id, user_id, image_id, description, title from feed_entries where entry_id = ?", FeedDatabaseEntry::class, "i", $entry_id);
    }
}