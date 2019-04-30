<?php


namespace Repositories\Interfaces;


use Models\Dto\PhotoDto;
use Models\Photo;

interface IPhotoRepository
{
    public function getById(int $photoId): ?Photo;
    public function getAll(int $limit = 999999999999999): array;
    public function addPhoto(PhotoDto $photoDto): bool;
    public function getPhotoForUser(string $username): array;
    public function deletePhoto(int $photoId): bool;
}