<?php


namespace app\repository\impl;


use app\model\Picture;
use app\repository\IPictureRepository;

class PictureRepository implements IPictureRepository
{


    function findAll(): array
    {
        // TODO: Implement findAll() method.
        return [];
    }

    function findByUserId(int $userId): array
    {
        // TODO: Implement findByUserId() method.
        return [
            new Picture(1, "title1", "descr1", "http://url.com/jpeg", new \DateTime("NOW"), new \DateTime("NOW")),
            new Picture(2, "title2", "descr2", "http://url.com/jpeg", new \DateTime("NOW"), new \DateTime("NOW"))
        ];
    }

    function uploadPicture(string $base64SEncodedImage, string $title, string $description): bool
    {
        // TODO: Implement uploadPicture() method.
        return true;
    }
}