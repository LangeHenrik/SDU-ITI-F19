<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 * Date: 02/05/2019
 * Time: 11.32
 */

namespace models;
use core\Database;


class RegisterUserModel
{

    function create_user($username, $password, $firstname, $lastname, $zip, $city, $email, $phonenumber){
        if($this->check_if_user_exist($username, $this->conn)){
            return false;
        } else {
            $statement = $this->conn->prepare('insert into users (username, password, firstname, lastname, zip, city, email, phonenumber) values (:username, :password, :firstname, :lastname, :zip, :city, :email, :phonenumber);');
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $hashpassword);

            $statement->execute();
            return true;
        }
    }

}