<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:38
 */

namespace models;
use core\Database;
class RegisterModel extends Database
{
    function create_user($username, $password, $firstname, $lastname, $zip, $city, $email, $phonenumber){
        if($this->checkUserExist($username)){
            return false;
        } else {
            $statement = $this->conn->prepare('insert into users (username, password) values (:username, :password);');
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $hashpassword);

            $statement->execute();
            return true;
        }
    }
}
