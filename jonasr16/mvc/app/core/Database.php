<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 29-04-2019
 * Time: 12:21
 */

namespace core;
use PDO;
class Database extends DB_Config
{
    public $conn;

    public function __construct() {
        try {

            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
                $this->username,
                $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn = null;
    }

    function check_if_user_exist($username, $conn){
        $statement = $conn->prepare('SELECT *, count(*) as NUM FROM users where username = :username');
        $statement->bindParam(':username', $username);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result[0]["NUM"] > 0){
            return true;
        } else {
            return false;
        }
    }


    function get_all_usernames(){
        $conn = getConnection();
        $statement = $conn->prepare('SELECT username FROM users');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}