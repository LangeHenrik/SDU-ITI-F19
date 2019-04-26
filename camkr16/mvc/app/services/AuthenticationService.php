<?php
namespace services;

use core\Database;
use PDO;

class AuthenticationService extends Database {

    public function authenticate($username, $password): bool {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $existingUser = $data[0];
        $password_hash = $existingUser['password'];
        //print_r($existingUser['password']);
        if (password_verify($password, $password_hash)) {
            $id = $existingUser['id'];
            settype($id, 'int');

            $_SESSION["id"] = $id;
            return true;

        } else {
            return false;
        }
    }
}