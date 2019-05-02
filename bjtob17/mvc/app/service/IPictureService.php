<?php


namespace app\service;


use app\model\dto\PictureApiRequestDto;

interface IPictureService
{
    function findAll(int $limit = 999999999999999): array;

    function findByUserId(int $userId): array;

    function uploadImage(PictureApiRequestDto $picture): int;

    function getPicturesForUser(string $username): array;

    function uploadPictureForm(array $body);
}