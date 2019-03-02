<?php


namespace Repositories;

use Database\Interfaces\IDatabaseConnection;
use DateTime;
use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\PhotoDto;
use Models\Photo;
use Models\User;
use Repositories\Interfaces\IPhotoRepository;

class PhotoRepository implements IPhotoRepository
{
    private $di;
    private $config;

    /**
     * @var IDatabaseConnection;
     */
    private $db;

    public function __construct($config, DependencyInjectionContainer $di)
    {
        $this->config = $config;
        $this->di = $di;
        $this->db = $di->get(IDatabaseConnection::class);
    }

    public function getAll(int $limit = 999999999999999): array
    {
        $sql = "SELECT photos.id as photo_id, title, caption, imgName, uploadDate, author_id, username, hashedPassword, firstName, lastName, zip, city, email, phone FROM photos JOIN users ON author_id = users.id ORDER BY photos.created_at DESC LIMIT ? ";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$limit]);
        $dbData = $stmt->fetchAll();

        $photos = [];
        foreach($dbData as $photoData) {
            $user = Helper::createUser($photoData, "author_id");
            $photo = Helper::createPhoto($photoData, $user);
            array_push($photos, $photo);
        }

        return $photos;
    }

    public function addPhoto(PhotoDto $photoDto): bool
    {
        $stmt = $this->db->getPDO()->prepare("INSERT INTO photos (title, caption, imgName, author_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$photoDto->title, $photoDto->caption, $photoDto->imgName, $photoDto->authorId]);
    }

    public function getPhotoForUser(string $username): array
    {
        $sql = "SELECT photos.id as photo_id, title, caption, imgName, uploadDate, author_id, username, hashedPassword, firstName, lastName, zip, city, email, phone FROM photos JOIN users ON author_id = users.id WHERE username = ? ORDER BY photos.created_at DESC";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$username]);
        $dbData = $stmt->fetchAll();

        $photos = [];
        foreach($dbData as $photoData) {
            $user = Helper::createUser($photoData, "author_id");
            $photo = Helper::createPhoto($photoData, $user);
            array_push($photos, $photo);
        }

        return $photos;
    }

    public function deletePhoto(int $photoId): bool
    {
        $sql = "DELETE FROM photos WHERE id = ?";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$photoId]);
    }

    public function getById(int $photoId): ?Photo
    {
        $sql = "SELECT photos.id as photo_id, title, caption, imgName, uploadDate, author_id, username, hashedPassword, firstName, lastName, zip, city, email, phone FROM photos JOIN users ON author_id = users.id WHERE photos.id = ? ORDER BY photos.created_at DESC";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$photoId]);
        $dbData = $stmt->fetch();

        $photo = null;
        if (count($dbData) > 0) {
            $user = Helper::createUser($dbData, "author_id");
            $photo = Helper::createPhoto($dbData, $user);
        }

        return $photo;
    }
}