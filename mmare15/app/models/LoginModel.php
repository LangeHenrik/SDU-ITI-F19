<?php

namespace models;
use core\Database;
use PDO;

class loginModel extends Database
{

    public function login($username, $password){
        if($this->check_if_user_exist($username, $this->conn)) {

            $statement = $this->conn->prepare('SELECT id, username, password FROM users WHERE username = :username');
            $statement->bindParam(':username', $username);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            $hashed_password = $result[0]["password"];

            if (password_verify($password, $hashed_password) == 1) {
                return true;
            }

        }
        return false;
    }

}
