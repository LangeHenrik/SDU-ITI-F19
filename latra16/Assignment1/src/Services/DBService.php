<?php

namespace Services;

use config\Database;
use Models\DTO\UserDTO;
use Models\DTO\PhotoDTO;
use Models\User;
use Models\Photo;

class DBService{
    private $db;

    public function __construct(Database $dbconfig){
        $this->db = $dbconfig;
    }

    /**
     * Add user to database.
     */
    public function registerUser(UserDTO $user) : bool {
        $preparedStatement = $this->db->getConnection()->prepare("INSERT INTO user (username, hashPassword, firstName, lastName, zip, city, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $preparedStatement->execute([
            $user->username, $user->password_hashed, $user->firstname, $user->lastname, $user->zip, $user->city, $user->email, $user->phone
        ]);
        return $result;
    }

    /**
     * 
     */
    public function getUserByCredentials(string $username, string $password): ?User{
        $user = null;        
        $hashPassword = hash("ripemd160", $password);

        $preparedStatement = $this->db->getConnection()->prepare("SELECT user_id FROM user WHERE username = ? AND hashPassword = ?");
        $preparedStatement->execute([$username, $hashPassword]);
        $data = $preparedStatement->fetch();
        if($data){
            $user = $this->getUserByUsername($username);
        }

        return $user;


    }

    /**
     * 
     */
    public function getUserByUsername(string $username) : ?User{

        $user = null;

        $preparedStatement = $this->db->getConnection()->prepare("SELECT user_id, username, hashPassword, firstName, lastName, zip, city, email, phone FROM user WHERE username = ?");
        $preparedStatement->execute([$username]);
        $data = $preparedStatement->fetch();
        if($data){
            $user = new User($data["user_id"], $data["username"], $data["hashPassword"], $data["firstName"], $data["lastName"], $data["city"], $data["zip"], $data["email"], $data["phone"]);
        }

        return $user;

    }

    /**
     * Upload photo database
     */
    public function uploadPhoto(PhotoDTO $photo) : bool {
        $preparedStatement = $this->db->getConnection()->prepare("INSERT INTO photo (photo_name, title, caption, uploader_id) VALUES (?, ?, ?, ?)");
        $result = $preparedStatement->execute([
            $photo->photoName, $photo->title, $photo->caption, $photo->uploaderId
        ]);
        return $result;
    }

    /**
     * 
     */
    public function getPhotos(int $cap = NULL ) : array{
        $stmt = $this->db->getConnection()->prepare("SELECT photo_id, title, caption, upload_date, uploader_id, photo_name, username FROM photo JOIN user ON uploader_id = user_id ORDER BY photo.upload_date DESC LIMIT 20");
        $result = $stmt->execute();
        $rows = $stmt->fetchAll();

        $photos = [];
        if($rows){
            foreach($rows as $data){
                $user = $this->getUserByUsername($data['username']);
                $photo = new Photo($data['photo_id'], $data['title'], $data['caption'], $data['upload_date'], $data['photo_name'], $user);
                array_push($photos, $photo);
            }
        }
        return $photos;
    }

    /**
     * 
     */
    public function getUsers(int $cap = NULL) : array {
        $stmt = $this->db->getConnection()->prepare("SELECT * from user");
        $result = $stmt->execute();
        $rows = $stmt->fetchAll();

        $users = [];
        if($rows){
            foreach($rows as $data){
                $user = $this->getUserByUsername($data['username']);
                array_push($users, $user);
            }
        }
        return $users;
    }

    public function getPhotoById($id) : ?Photo {
        $photo = null;

        $stmt = $this->db->getConnection()->prepare("SELECT photo_id, title, caption, upload_date, uploader_id, photo_name, username FROM photo JOIN user ON uploader_id = user_id WHERE photo_id = ?");
        $result = $stmt->execute([$id]);
        $data = $stmt->fetch();

        if($data){
            $user = $this->getUserByUsername($data['username']);
            $photo = new Photo($data["photo_id"], $data["title"], $data["caption"], $data["upload_date"], $data["photo_name"], $user);
        }

        return $photo;


    }

}