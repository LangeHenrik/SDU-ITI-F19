<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:37
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

    function checkUserExist($username){
        $conn = connect();
        $statement = $conn->prepare('select username from userdb where username = :username;');
        $statement->bindParam(':username',$username);
        $statement->setFetchmode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        $count = count($result);
        if($count == 1 ) {
            return true;
        }else{
            return false;
        }

    }
}
