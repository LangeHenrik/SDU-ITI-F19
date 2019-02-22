<?php


namespace Repositories;

use DateTime;
use Models\Photo;
use Models\User;
use Repositories\Interfaces\IPhotoRepository;

class PhotoRepository implements IPhotoRepository
{
    private $photos;

    public function __construct()
    {
        $this->photos = [
            new Photo(1, "Look at this cute cat", "https://picsum.photos/900/600", (new DateTime("now"))->getTimestamp(), new User(1, "bob", "secret")),
            new Photo(2,  "Look at this aklsm kla mdklamskdmasld ma alsde cat", "https://picsum.photos/800/600", (new DateTime("now"))->getTimestamp(), new User(2, "SuperBob", "secret")),
            new Photo(3, "Look at this aklsm kla mdklamskdmasld ma alsde cat", "https://picsum.photos/700/600", (new DateTime("now"))->getTimestamp(), new User(3, "notBob", "secret")),
        ];
    }

    public function getAll(): array
    {
        return $this->photos;
    }
}