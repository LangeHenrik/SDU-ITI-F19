<?php


namespace app\repository;


use app\model\User;

interface IPictureRepository
{
    function findAll(int $limit = 999999999999999): array;

    function findByUserId(int $userId): array;

    function uploadPicture(string $base64SEncodedImage, string $title, string $description, User $user): int;
}