<?php


namespace app\service\impl;


use app\model\Entity;
use app\service\IEntityService;
use DateTime;

class EntityService implements IEntityService
{

    function formatDateFields(Entity $entity, string $dateFormat = DateTime::ISO8601): Entity
    {
        $entityCopy = $entity;
        $entityCopy->createdAt = $entityCopy->createdAt->format($dateFormat);
        $entityCopy->updatedAt = $entityCopy->updatedAt->format($dateFormat);

        return $entityCopy;
    }

    function formatMultiple(array $entities, string $dateFormat = DateTime::ISO8601): array
    {
        return array_map(function ($entity) use ($dateFormat) {
            return $this->formatDateFields($entity, $dateFormat);
        }, $entities);
    }
}