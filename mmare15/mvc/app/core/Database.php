<?php



namespace core;
use PDO;
require_once 'DB_Config.php';

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

/** @var  $user
 *
 *
 *
 *        $user = 'root';
$password = 'root';
$db = 'inventory';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
$success = mysqli_real_connect(
$link,
$host,
$user,
$password,
$db,
$port
);
 *
 *
 *
 */


    

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
}