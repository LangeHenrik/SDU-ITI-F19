<?php


namespace app\repository;


interface IPictureRepository
{
    function findAll(): array;

    function findByUserId(int $userId): array;

    function uploadPicture(string $base64SEncodedImage, string $title, string $description): bool;
}