<?php


namespace app\repository;


use app\model\Picture;
use app\model\User;
use DateTime;

class DbResultMapper
{
    public static function toUser(array $dbRow): User
    {
        return new User($dbRow["user_id"], $dbRow["username"], $dbRow["hashedPassword"], $dbRow["firstName"],
            $dbRow["lastName"], $dbRow["zip"], $dbRow["city"], $dbRow["email"], $dbRow["phone"], $dbRow["user_created_at"], $dbRow["user_updated_at"]);
    }

    public static function toPicture(array $dbRow, User $user): Picture
    {
        return new Picture($dbRow["photo_id"], $dbRow["title"], $dbRow["caption"], $dbRow["imgData"], $dbRow["uploadDate"], $user, $dbRow["photo_created_at"], $dbRow["photo_updated_at"] );
    }
}