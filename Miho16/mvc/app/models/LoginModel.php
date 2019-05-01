<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:38
 */
namespace models;
use core\Database;
use PDO;
class LoginModel extends Database
{
    public function login($username, $password){
        if($this->checkUserExist($username)) {
            $statement = $this->conn->prepare('SELECT password FROM users where username = :username');
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
