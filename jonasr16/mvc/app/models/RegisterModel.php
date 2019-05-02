<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 29-04-2019
 * Time: 15:22
 */

namespace models;
use core\Database;

class RegisterModel extends Database
{
    function create_user($username, $password, $firstname, $lastname, $zip, $city, $email, $phonenumber){
        if($this->check_if_user_exist($username, $this->conn)){
            return false;
        } else {
            $statement = $this->conn->prepare('insert into users (username, password, firstname, lastname, zip, city, email, phonenumber) values (:username, :password, :firstname, :lastname, :zip, :city, :email, :phonenumber);');
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $hashpassword);
            $statement->bindParam(':firstname', $firstname);
            $statement->bindParam(':lastname', $lastname);
            $statement->bindParam(':zip', $zip);
            $statement->bindParam(':city', $city);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':phonenumber', $phonenumber);

            $statement->execute();
            return true;
        }
    }
}