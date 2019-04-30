<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-29
 * Time: 12:30
 */

namespace models;

use core\Database;
use PDO;

class LoginModel extends Database
{
    public function checkCredentials($ausername, $apassword) {


        $statement = $this->conn->prepare('select username, password from users where username = :username');



        $statement->bindParam(':username', $ausername);


        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();

        $collectedusername = $result[0]["username"];
        $collectedpassword = $result[0]["password"];
        $unhashpw = password_verify($apassword, $collectedpassword);

        if($ausername == $collectedusername && $unhashpw == 1) {
            return true;
        } else {
            return false;
        }

    }
}