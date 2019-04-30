<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 09:50
 */


namespace models;

use core\Database;
use PDO;

class Register extends Database
{

    function registerUser($username, $password, $firstname, $lastname, $city, $zip, $mail, $phone) {
        $statement = $this->conn->prepare('insert into users (username, password, first, last, zip, city, mail, phone) values (:username, :password, :first, :last, :zip, :city, :mail, :phone);');

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        /* Bind Parameters*/
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $hashpassword);

        $statement->bindParam(':first', $firstname);
        $statement->bindParam(':last', $lastname);

        $statement->bindParam(':zip', $zip);
        $statement->bindParam(':city', $city);

        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':phone', $phone);

        $statement->execute();
    }

}