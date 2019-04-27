<?php


namespace app\repository\impl;


use app\model\User;
use app\repository\DbResultMapper;
use app\repository\IPictureRepository;
use framework\database\IDatabaseConnection;

class PictureRepository implements IPictureRepository
{
    /**
     * @var IDatabaseConnection
     */
    private $db;

    /**
     * UserRepository constructor.
     * @param IDatabaseConnection $db
     */
    public function __construct(IDatabaseConnection $db)
    {
        $this->db = $db;
    }

    function findAll(int $limit = 999999999999999): array
    {
        $sql = "SELECT photo_id, title, caption, imgData, uploadDate, author_id, photo.created_at AS photo_created_at, photo.updated_at AS photo_updated_at, username, hashedPassword, user_id, firstName, lastName, zip, city, email, phone, user.created_at AS user_created_at, user.updated_at AS user_updated_at FROM photo JOIN user ON author_id = user_id ORDER BY photo.created_at DESC LIMIT ? ";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$limit]);
        $dbData = $stmt->fetchAll();
        $photos = [];
        foreach ($dbData as $photoData) {
            $user = DbResultMapper::toUser($photoData);
            $photo = DbResultMapper::toPicture($photoData, $user);
            array_push($photos, $photo);
        }
        return $photos;
    }

    function findByUserId(int $userId): array
    {
        $sql = "SELECT photo_id, title, caption, imgData, uploadDate, author_id, photo.created_at AS photo_created_at, photo.updated_at AS photo_updated_at, username, hashedPassword, user_id, firstName, lastName, zip, city, email, phone, user.created_at AS user_created_at, user.updated_at AS user_updated_at FROM photo JOIN user ON author_id = user_id AND author_id = ? ORDER BY photo.created_at DESC";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$userId]);
        $dbData = $stmt->fetchAll();
        $photos = [];
        foreach ($dbData as $photoData) {
            $user = DbResultMapper::toUser($photoData);
            $photo = DbResultMapper::toPicture($photoData, $user);
            array_push($photos, $photo);
        }
        return $photos;
    }

    function uploadPicture(string $base64SEncodedImage, string $title, string $description, User $user): int
    {
        $stmt = $this->db->getPDO()->prepare(
            "INSERT INTO photo (title, caption, imgData, author_id) VALUES (?, ?, ?, ?) "
        );
        $stmt->execute([$title, $description, $base64SEncodedImage, $user->user_id]);
        $lastId = $this->db->getPDO()->lastInsertId();
        return $lastId;
    }
}