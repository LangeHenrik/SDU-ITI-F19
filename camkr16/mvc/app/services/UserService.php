<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 25-04-2019
 * Time: 17:08
 */

namespace services;

use core\Database;
use models\User;
use PDO;

class UserService extends Database
{
    /**
     * @return User[]
     */
    public function loadUsers(){
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        $users = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user = new User($row['user_id'], $row['username'], $row['password'], $row['firstname'], $row['lastname'], $row['zip'], $row['city'], $row['email'], $row['phone']);
            $users[] = $user;
        }
        return $users;
    }
}