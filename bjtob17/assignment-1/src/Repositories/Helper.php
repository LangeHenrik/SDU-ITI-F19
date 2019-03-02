<?php

namespace Repositories;


use Models\Photo;
use Models\User;

class Helper
{
    public static function createUser(array $dbRow, string $idColName = "id"): User
    {
        return new User($dbRow[$idColName], $dbRow["username"], $dbRow["hashedPassword"], $dbRow["firstName"],
            $dbRow["lastName"], $dbRow["zip"], $dbRow["city"], $dbRow["email"], $dbRow["phone"]);
    }

    public static function createPhoto(array $dbRow, User $user): Photo
    {
        return new Photo($dbRow["photo_id"], $dbRow["title"], $dbRow["caption"], $dbRow["imgName"], $dbRow["uploadDate"], $user);
    }

}