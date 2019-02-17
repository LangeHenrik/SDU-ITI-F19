<?php


namespace repositories;


use database\DatabaseConnection;
use Exception;
use models\ImageDatabaseEntry;

class ImageRepository
{
    /**
     * @var DatabaseConnection
     */
    private $conn;

    public function __construct(DatabaseConnection $conn)
    {
        $this->conn = $conn;
    }


    /**
     * Gets the requested image entry
     *
     * @param int $id
     * @return ImageDatabaseEntry|null
     */
    public function get_image(int $id)
    {
        return $this->conn->query_single_row("select image_id, filehash, extension from images where image_id = ?", ImageDatabaseEntry::class, "i", $id);
    }

    public function add_image(string $filehash, string $extension): ImageDatabaseEntry
    {
        if (!$this->conn->begin_transaction()) {
            throw new Exception("Failed to begin transaction: " . $this->conn->get_last_error());
        }

        $this->conn->execute_prepared_query("insert into images(filehash, extension) values(?, ?)", "ss", $filehash, $extension);

        $image = $this->get_image_from_filehash($filehash);

        if (!$this->conn->commit_transaction()) {
            throw new Exception("Failed to commit transaction: " . $this->conn->get_last_error());
        }

        return $image;
    }

    /**
     * @param string $filehash
     * @return ImageDatabaseEntry|null
     */
    public function get_image_from_filehash(string $filehash)
    {
        return $this->conn->query_single_row("select image_id, filehash, extension from images where filehash = ?", ImageDatabaseEntry::class, "s", $filehash);
    }
}