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
    private $photos;
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
        $this->photos = [
            new Photo(1, "Dolor epicurei vis in", "Lorem ipsum dolor sit amet, denique conceptam philosophia mel cu.", "https://picsum.photos/900/600", (new DateTime("now"))->getTimestamp(), new User(1, "bob", "secret")),
            new Photo(2,  "Assueverit theophrastus in vel", "Probo cetero ad eos, sea ut iudico possim evertitur, cum cu nemore eirmod melius. Cum omnesque interesset ei. No magna ullum liber ius, vel ea epicuri quaerendum. ", "https://picsum.photos/800/600", (new DateTime("now"))->getTimestamp(), new User(2, "SuperBob", "secret")),
            new Photo(3, "Legere consequat et pri", "Eu ius solet ignota ancillae, nec vidisse omittam delectus ad. Audire scaevola petentium sea ne, sea aliquip sapientem evertitur ea, prompta discere quaestio et sea. Disputando vituperatoribus usu id, an sonet latine oporteat cum, eu est apeirian accusata definiebas.", "https://picsum.photos/700/600", (new DateTime("now"))->getTimestamp(), new User(3, "notBob", "secret")),
        ];
    }

    public function getAll(int $limit = 999999999999999): array
    {
        $sql = "SELECT photos.id as photo_id, title, caption, imgName, uploadDate, author_id, username, hashedPassword FROM photos JOIN users ON author_id = users.id ORDER BY photos.uploadDate DESC LIMIT ? ";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$limit]);
        $dbData = $stmt->fetchAll();

        $photos = [];
        foreach($dbData as $photoData) {
            $user = new User($photoData["author_id"], $photoData["username"], $photoData["hashedPassword"]);
            $photo = new Photo($photoData["photo_id"], $photoData["title"], $photoData["caption"], $photoData["imgName"], $photoData["uploadDate"], $user);
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
        $sql = "SELECT photos.id as photo_id, title, caption, imgName, uploadDate, author_id, username, hashedPassword FROM photos JOIN users ON author_id = users.id WHERE username = ? ORDER BY photos.uploadDate ASC ";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$username]);
        $dbData = $stmt->fetchAll();

        $photos = [];
        foreach($dbData as $photoData) {
            $user = new User($photoData["author_id"], $photoData["username"], $photoData["hashedPassword"]);
            $photo = new Photo($photoData["photo_id"], $photoData["title"], $photoData["caption"], $photoData["imgName"], $photoData["uploadDate"], $user);
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
        $sql = "SELECT photos.id as photo_id, title, caption, imgName, uploadDate, author_id, username, hashedPassword FROM photos JOIN users ON author_id = users.id WHERE photos.id = ? ORDER BY photos.uploadDate ASC ";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$photoId]);
        $dbData = $stmt->fetch();

        $photo = null;
        if (count($dbData) > 0) {
            $user = new User($dbData["author_id"], $dbData["username"], $dbData["hashedPassword"]);
            $photo = new Photo($dbData["photo_id"], $dbData["title"], $dbData["caption"], $dbData["imgName"], $dbData["uploadDate"], $user);
        }

        return $photo;
    }
}