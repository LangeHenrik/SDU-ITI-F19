<?php

namespace services;

use core\Database;
use PDO;

class SignUpService extends Database
{

    public function signUp($username, $password, $firstname, $lastname, $zip, $city, $email, $phone)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        $has_error = false;

        if ($existingUser) {
            $username_error = "Username already exist";
            $has_error = true;
            die($username_error);
        }
        if (!$has_error) {
            $stmt = $this->conn->prepare("INSERT INTO user(username, password, firstname, lastname, zip, city, email, phone) 
VALUES(:username, :password, :firstname, :lastname, :zip, :city, :email, :phone)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":zip", $zip);
            $stmt->bindParam(":city", $city);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":phone", $phone);

            $stmt->execute();

            $id = $this->conn->lastInsertId();

            $_SESSION["id"] = $id;
            return true;
        }
        return false;

    }

}