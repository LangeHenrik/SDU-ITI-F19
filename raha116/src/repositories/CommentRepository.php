<?php


namespace repositories;


use database\DatabaseConnection;
use Exception;
use models\CommentDatabaseEntry;

class CommentRepository
{

    /**
     * @var DatabaseConnection
     */
    private $conn;

    /**
     * CommentRepository constructor.
     * @param DatabaseConnection $conn
     */
    public function __construct(DatabaseConnection $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Loads the comment with the given id
     *
     * @param int $comment_id
     * @return null|CommentDatabaseEntry
     */
    public function get_comment(int $comment_id)
    {
        return $this->conn->query_single_row("select comment_id, text, user_id, feed_entry_id from comments where comment_id = ?", CommentDatabaseEntry::class, $comment_id);
    }

    public function add_comment(int $user_id, string $text, int $feed_entry_id): CommentDatabaseEntry
    {
        if (!$this->conn->begin_transaction()) {
            throw new Exception("Failed to start transaction: " . $this->conn->get_last_error());
        }
        $this->conn->execute_prepared_query("insert into comments(text, user_id, feed_entry_id) values(?, ?, ?)", $text, $user_id, $feed_entry_id);

        $id = $this->conn->get_last_inserted_id();

        if (!$this->conn->commit_transaction()) {
            throw new Exception("Failed to commit new comment to database: " . $this->conn->get_last_error());
        }

        $entry = new CommentDatabaseEntry();
        $entry->user_id = $user_id;
        $entry->comment_id = $id;
        $entry->text = $text;
        $entry->feed_entry_id = $feed_entry_id;

        return $entry;
    }

    /**
     * @param int $feed_entry_id
     * @return CommentDatabaseEntry[]
     */
    public function get_comments_for_feed_entry(int $feed_entry_id): array
    {
        return $this->conn->query_multiple_rows("select comment_id, text, user_id, feed_entry_id from comments where feed_entry_id = ?", CommentDatabaseEntry::class, $feed_entry_id);
    }
}