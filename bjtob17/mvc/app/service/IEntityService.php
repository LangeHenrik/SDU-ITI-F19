<?php


namespace app\service;


use app\model\Entity;

interface IEntityService
{
    function formatDateFields(Entity $entity): Entity;

    function formatMultiple(array $entities): array;
}