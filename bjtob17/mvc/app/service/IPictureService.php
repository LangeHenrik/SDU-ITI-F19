<?php


namespace app\service;


use app\model\dto\PictureDto;

interface IPictureService
{
    function findAll(): array;

    function findByUserId(int $userId): array;

    function uploadImage(PictureDto $pictureDto): bool;
}